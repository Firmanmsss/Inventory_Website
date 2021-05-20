<?php

namespace App\Http\Controllers;

use App\PersonInC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PersonInCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = PersonInC::query();
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
                                    <a class="dropdown-item" href="' . route('personinc.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('personinc.destroy', $item->id) . '" method="POST">
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
        return view('pic.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pic.create');
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
            'name'   => 'required',
            'posisi' => 'required|unique:person_in_c_s,posisi',
        ]);

        DB:: beginTransaction();

        try {
            $pic = new PersonInC();

            $pic->name   = $request->name;
            $pic->posisi = $request->posisi;
            // $pic->slug = Str::slug($request->name);

            $pic->save();
            // dd($pic);
        } catch (\Exception $e) {
            DB:: rollBack();
            return redirect()->route('personinc.create')->withInput()->with(
                'error-msg',
                // $e->getMessage() = digunakan untuk pengecekan eror
                'Data Gagal disimpan'
            );
        }

        DB:: commit();

        return redirect()->route('personinc.index')
            // ->withInput() jika berhasil input tampil kembali
            ->with('success-msg', 'Data berhasil disimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonInC  $personInC
     * @return \Illuminate\Http\Response
     */
    public function show(PersonInC $personInC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonInC  $personInC
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PersonInC::findorFail($id);

        return view('pic.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonInC  $personInC
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = PersonInC::findOrFail($id);

        // $item = Customer::with([
        //     // 'items',
        // ])->findOrFail($id);

        $this->validate($request, [
            'name'   => 'required',
            'posisi' => 'required',
        ]);

        DB:: beginTransaction();
        
        try{

            $item->name   = $request->name;
            $item->posisi = $request->posisi;
            // $item->slug = Str::slug($request->name);

            $item->update();

        }
        catch(\Exception $e){
            DB:: rollBack();
            return redirect()->route('personinc.edit')->withInput()->with('error-msg', 
            // $e->getMessage() = digunakan untuk pengecekan eror
            'Data Gagal di edit');
        }

        DB:: commit();

        return redirect()->route('personinc.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil di edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonInC  $personInC
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PersonInC::findorFail($id);
        $item->delete();

        return redirect()->route('personinc.index');
    }
}
