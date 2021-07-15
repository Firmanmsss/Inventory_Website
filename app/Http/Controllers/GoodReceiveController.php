<?php

namespace App\Http\Controllers;

use App\Checker;
use App\Customer;
use App\GoodReceive;
use App\GRDetail;
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
            $query = GoodReceive::with(['customer','checker', 'personinc'])->select('good_receives.*');
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
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id_po . '">
                                <a class="dropdown-item" href="' . route('grdetail', $item->id_po) . '">
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
            ->addcolumn('id_po', function ($kodenya) {
                return 'PO/INV/' . $kodenya->id_po;
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('good_receipt.list_gr');
    }

    public function detail($id_po)
    {
        if (request()->ajax()) {

            $query   = PurchaseDetail::with(['namepart', 'purchaseorder'])->where('nomor_po', '=', $id_po)->get();
            // return $query;
            return DataTables::of($query)
                ->addcolumn('nomor_po', function ($kodenya) {
                    return 'PO/INV/' . $kodenya->nomor_po;
                })
                ->make();
        }
        return view('good_receipt.detail_gr');
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
            'id_po'         => 'required|unique:good_receives,id_po',
            'id_cust'       => 'required',
            'po_supplier'   => 'required',
            'pic'           => 'required',
            'checker'       => 'required',
            'location_name' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $goodReceive = new GoodReceive;

            $goodReceive->id_po    = $request->id_po;
            $goodReceive->id_cust  = $request->id_cust;
            $goodReceive->nomor_po = $request->po_supplier;
            $goodReceive->checker  = $request->checker;
            $goodReceive->pic      = $request->pic;

            $goodReceive->save();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
            return redirect()->withInput()->with('error-msg', 'Gagal Simpan Good Receive');
        }

        try {
            $grDetail = [
                'id_gr'      => $goodReceive->id,
                'id_po'      => $goodReceive->id_po,
                'location'   => $request->location_name,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];
            $goodReceive->details()->insert($grDetail);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();

            return redirect()->route('goodreceipt.create')->with('error-msg', 'Gagal Simpan Good Receipt');
        }

        DB::commit();
        return redirect()->route('goodreceipt.index')->with('success-msg', 'Berhasil simpan Good Receipt');
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
    public function destroy($id)
    {
        $item = GoodReceive::findorFail($id);
        $item->delete();
        $item->details()->delete($id);

        return redirect()->route('goodreceipt.index');
    }
}
