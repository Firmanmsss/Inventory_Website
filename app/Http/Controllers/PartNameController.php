<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Part_Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PartNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Part_Name::query();
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
                                    <a class="dropdown-item" href="' . route('partname.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('partname.destroy', $item->id) . '" method="POST">
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
        return view('part_name.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('part_name.create', compact('customers'));
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
     * @param  \App\Part_Name  $part_Name
     * @return \Illuminate\Http\Response
     */
    public function show(Part_Name $part_Name)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Part_Name  $part_Name
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Part_Name::with([

        ])->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Part_Name  $part_Name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $item = Part_Name::findOrFail($id);

        $item = Part_Name::with([
            'customer',
        ])->findOrFail($id);

        $this->validate($request, [
            'name'    => 'required|min:3',
            'no_telp' => 'required|min:10 max:12',
            'alamat'  => 'required|min:3'
        ]);

        DB:: beginTransaction();
        
        try{

            $item->name    = $request->name;
            $item->no_telp = $request->no_telp;
            $item->Alamat  = $request->alamat;
            // $item->slug = Str::slug($request->name);

            $item->update();

        }
        catch(\Exception $e){
            DB:: rollBack();
            return redirect()->route('partname.edit')->withInput()->with('error-msg', 
            // $e->getMessage() = digunakan untuk pengecekan eror
            'Data Gagal di edit');
        }

        DB:: commit();

        return redirect()->route('partname.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil di edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Part_Name  $part_Name
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part_Name $part_Name)
    {
        //
    }
}
