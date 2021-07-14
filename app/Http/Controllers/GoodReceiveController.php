<?php

namespace App\Http\Controllers;

use App\Checker;
use App\Customer;
use App\GoodReceive;
use App\Location;
use App\Part_Name;
use App\PersonInC;
use App\PurchaseDetail;
use App\PurchaseOrder;
use Dotenv\Result\Result;
use GoodReceiveSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GoodReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = GoodReceive::with(['customer'])->select('good_receives.*');
            // dd($query->name);
            return DataTables::of($query)
            ->addColumn('action', function ($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                type="button" id="action' .  $item->id . '"
                                    data-toggle="dropdown" 
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                <a class="dropdown-item" href="' . route('gr-detail', $item->id) . '">
                                    Detail
                                </a>
                                <form action="' . route('goodreceipt.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>';
            })
            ->editcolumn('created_at', function ($request) {
                return $request->created_at->format('d M Y');
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('good_receipt.list_gr');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers     = Customer::all();
        $checker       = Checker::all();
        $personinc     = PersonInC::all();
        $partname      = Part_Name::all();
        $locat         = Location::all();
        $puchaseorders = PurchaseOrder::all();
        return view('good_receipt.create',compact('partname','customers','checker','personinc','locat','puchaseorders'));
    }

    public function po_number(Request $request){

        $id_po = $request->id_po;

        $po['array'] = PurchaseDetail::when($id_po, function($q) use($id_po){
            $q->where('nomor_po','=', $id_po);
        })
        ->with(['namepart','purchaseorder'])
        ->get();

        echo json_encode($po);
        exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_po'         => 'required',
            'id_cust'       => 'required',
            'po_supplier'   => 'required',
            'pic'           => 'required',
            'checker'       => 'required',
            'location_name' => 'required',
            'kode'          => 'required|array',
            'kode.*'        => 'required',
            'partname'      => 'required|array',
            'partname.*'    => 'required',
            'price'         => 'required|array',
            'price.*'       => 'required',
            'qty'           => 'required|array',
            'qty.*'         => 'required',
            'total'         => 'required|array',
            'total.*'       => 'required',
        ]);

        DB::beginTransaction();

        try {
            $goodReceive = new GoodReceive;

            $goodReceive->id_po       = $request->id_po;
            $goodReceive->id_cust     = $request->id_cust;
            $goodReceive->po_supplier = $request->po_supplier;
            $goodReceive->checker     = $request->checker;
            $goodReceive->pic         = $request->pic;

            $goodReceive->save();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->withInput()->with('error-msg', 'Gagal Simpan Pembelian');
        }

        try {
            // $purchaseD = new PurchaseDetail;
            foreach ($request->product as $key => $val) {
                $product_purchase[] = [
                    'nomor_po'    => $goodReceive->nomor_po,
                    'id_partname' => $request->product[$key],
                    'price'       => $request->price[$key],
                    'qty'         => $request->qty[$key],
                    'total'       => $request->total[$key],
                    'created_at'  => \Carbon\Carbon::now(),
                    'updated_at'  => \Carbon\Carbon::now(),
                ];
            }
            $goodReceive->details()->insert($product_purchase);
        } catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();

            return redirect()->route('purchaseorder.create')->with('error-msg', 'Gagal Simpan Pembelian Produk');
        }

        DB::commit();
        return redirect()->route('purchaseorder.index')->with('success-msg', 'Berhasil simpan Pembelian');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoodReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function show(GoodReceive $goodReceive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoodReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodReceive $goodReceive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoodReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodReceive $goodReceive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoodReceive  $goodReceive
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodReceive $goodReceive)
    {
        //
    }
}
