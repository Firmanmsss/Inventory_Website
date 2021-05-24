<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Location::query();
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
                                    <a class="dropdown-item" href="' . route('locat.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('locat.destroy', $item->id) . '" method="POST">
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
        return view('location.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = array('amount' => array('match:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/'));

        $this->validate($request, [
            'location_name' => 'required|min:3|unique:locations,location_name',
        ]);

        DB:: beginTransaction();

        try{
            $location = new Location;
            
            $location->location_name = $request->location_name;

            $location->save();
            // dd($location);

        }
        catch(\Exception $e){
            DB:: rollBack();
            return redirect()->route('locat.create')->withInput()->with('error-msg', 
            // $e->getMessage());
            'Data Gagal disimpan');
        }

        DB:: commit();

        return redirect()->route('locat.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil disimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Location::findorFail($id);
        return view('location.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $locatio = Location::findOrFail($id);

        $this->validate($request, [
            'location_name'  => [
                'required',
                'min:3',
                Rule:: unique('locations')->ignore($locatio->id)
            ],
        ]);

        DB:: beginTransaction();

        try{
            $locatio->location_name = $request->location_name;
            // dd($locatio);
            $locatio->update();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('locat.destroy')->withInput()->with('error-msg', 'Location Gagal disimpan');
        }

        DB::commit();

        return redirect()->route('locat.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Berhasil simpan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Location::findorFail($id);
        $item->delete();

        return redirect()->route('locat.index');
    }
}
