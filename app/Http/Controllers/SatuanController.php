<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Satuan::query();
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
                                    <a class="dropdown-item" href="' . route('satuan.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('satuan.destroy', $item->id) . '" method="POST">
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

        return view('unit.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $satuan = new Satuan();

            $satuan->name    = $request->name;
            // $satuan->slug = Str::slug($request->name);

            $satuan->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('satuan.create')->withInput()->with(
                'error-msg',
                // $e->getMessage() = digunakan untuk pengecekan eror
                'Data Gagal disimpan'
            );
        }

        DB::commit();

        return redirect()->route('satuan.index')
            // ->withInput() jika berhasil input tampil kembali
            ->with('success-msg', 'Data berhasil disimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Satuan::with([

            ])->findOrFail($id);

        return view('unit.edit',['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Satuan::findOrFail($id);

        // $item = Satuan::with([
        //     // 'items',
        // ])->findOrFail($id);

        $this->validate($request, [
            'name'    => 'required|min:2',
        ]);

        DB:: beginTransaction();
        
        try{

            $item->name    = $request->name;
            // $item->slug = Str::slug($request->name);

            $item->update();

        }
        catch(\Exception $e){
            DB:: rollBack();
            return redirect()->route('satuan.edit')->withInput()->with('error-msg', 
            // $e->getMessage() = digunakan untuk pengecekan eror
            'Data Gagal di edit');
        }

        DB:: commit();

        return redirect()->route('satuan.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil di edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Satuan::findorFail($id);
        $item->delete();

        return redirect()->route('satuan.index');
    }
}
