<?php

namespace App\Http\Controllers;

use App\Part_Name;
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
            'id_partname'   => 'required|array',
            'id_partname.*' => 'required|integer',
            'price'         => 'required|array',
            'price.*'       => 'required|integer',
            'qty'           => 'required|array',
            'qty.*'         => 'required|integer',
            'total'         => 'required|array',
            'total.*'       => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            foreach($request->partname as $key => $val){
                $po = new PurchaseOrder;

                $po->id_partname = $request->partname[$key];
                $po->price       = $request->price[$key];
                $po->qty         = $request->qty[$key];
                $po->total       = $request->total[$key];

                // dd($po);
                $po->save();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('purchaseorder.create')->withInput()->with('error-msg', 'Data Gagal disimpan');
        }

        DB::commit();
        return redirect()->route('purchaseorder.index')->withInput()->with('success-msg', 'Data Berhasil disimpan');
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
