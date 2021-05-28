<?php

namespace App\Http\Controllers;

use App\Part_Name;
use App\PurchaseDetail;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use function GuzzleHttp\Promise\all;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = PurchaseOrder::query();
            // dd($query);
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
                                    <a class="dropdown-item" href="' . route('po-detail', $item->id) . '">
                                        Detail
                                    </a>
                                    <a class="dropdown-item" href="' . route('purchaseorder.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('purchaseorder.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->make();
        }
        return view('purchase_order.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partname = Part_Name::all();
        return view('purchase_order.create',compact('partname'));
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
            'nomor_po'  => 'required|unique:purchase_orders,nomor_po',
            'product'   => 'required|array',
            'product.*' => 'required',
            'price'     => 'required|array',
            'price.*'   => 'required|numeric',
            'qty'       => 'required|array',
            'qty.*'     => 'required|numeric',
            'total'     => 'required|array',
            'total.*'   => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $purchaseO = new PurchaseOrder;

            $purchaseO->nomor_po = 'PO/INV/'.$request->nomor_po;

            $purchaseO->save();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->withInput()->with('error-msg', 'Gagal Simpan Pembelian');
        }

        try {
            // $purchaseD = new PurchaseDetail;
            foreach($request->product as $key => $val) {
                $product_purchase[] = [
                    'nomor_po'    => $purchaseO->nomor_po,
                    'id_partname' => $request->product[$key],
                    'price'       => $request->price[$key],
                    'qty'         => $request->qty[$key],
                    'total'       => $request->total[$key],
                    'created_at'  => \Carbon\Carbon::now(),
                    'updated_at'  => \Carbon\Carbon::now(),
                ];
            }
            $purchaseO->details()->insert($product_purchase);

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
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PurchaseOrder::findorFail($id);
        return view('purchase_order.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PurchaseOrder::findorFail($id);
        $item->delete();

        return redirect()->route('purchaseorder.index');
    }
}
