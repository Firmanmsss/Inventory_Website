<?php

namespace App\Http\Controllers;

use App\Part_Name;
use App\PurchaseDetail;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $nomor = PurchaseDetail::select('select nomor_po from purchase_details where active = ?', [1]);
        if (request()->ajax()) {
            $query = PurchaseDetail::with(['namepart'])->findOrFail($id);
            // dd($query);
            return DataTables::of($query)
                
                ->make();
        }
        return view('purchase_order.detail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        //
    }
}
