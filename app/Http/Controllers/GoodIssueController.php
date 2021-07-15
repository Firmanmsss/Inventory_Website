<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Checker;
use App\Customer;
use App\GoodIssue;
use App\Location;
use App\Part_Name;
use App\PersonInC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GoodIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = GoodIssue::query();
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
                                <a class="dropdown-item" href="' . route('goodissue.edit', $item->id) . '">
                                    Edit
                                </a>
                                <form action="' . route('goodissue.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>';
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('good_issue.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $checker   = Checker::all();
        $personinc = PersonInC::all();
        $partname  = Part_Name::all();
        $locat     = Location::all();
        $buyer     = Buyer::all();
        return view('good_issue.create',compact('partname','customers','checker','personinc','locat','buyer'));
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
            $goodIss = new GoodIssue;

            $goodIss->nomor_po = $request->nomor_po;

            $goodIss->save();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->withInput()->with('error-msg', 'Gagal Simpan PO');
        }

        try {
            // $purchaseD = new PurchaseDetail;
            foreach ($request->product as $key => $val) {
                $product_purchase[] = [
                    'nomor_po'    => $goodIss->nomor_po,
                    'id_partname' => $request->product[$key],
                    'price'       => $request->price[$key],
                    'qty'         => $request->qty[$key],
                    'total'       => $request->total[$key],
                    'created_at'  => \Carbon\Carbon::now(),
                    'updated_at'  => \Carbon\Carbon::now(),
                ];
            }
            $goodIss->details()->insert($product_purchase);
        } catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();

            return redirect()->route('good_issue.create')->with('error-msg', 'Gagal Simpan Good Issue');
        }

        DB::commit();
        return redirect()->route('good_issue.index')->with('success-msg', 'Berhasil Simpan Good Issue');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoodIssue  $goodIssue
     * @return \Illuminate\Http\Response
     */
    public function show(GoodIssue $goodIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoodIssue  $goodIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodIssue $goodIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoodIssue  $goodIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodIssue $goodIssue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoodIssue  $goodIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = GoodIssue::findOrFail($id);
        $item->delete();

        return redirect()->route('goodissue.index');
    }
}
