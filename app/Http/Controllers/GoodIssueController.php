<?php

namespace App\Http\Controllers;

use App\Checker;
use App\Customer;
use App\GoodIssue;
use App\Location;
use App\Part_Name;
use App\PersonInC;
use Illuminate\Http\Request;
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
        $customers     = Customer::all();
        $checker       = Checker::all();
        $personinc     = PersonInC::all();
        $partname      = Part_Name::all();
        $locat         = Location::all();
        return view('good_issue.create',compact('partname','customers','checker','personinc','locat'));
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
