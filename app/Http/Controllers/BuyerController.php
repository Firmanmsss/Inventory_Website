<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Buyer::query();
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
                                    <a class="dropdown-item" href="' . route('buyer.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('buyer.destroy', $item->id) . '" method="POST">
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
        return view('buyer.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buyer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name'    => 'required|min:3',
        //     'no_telp' => 'required|min:9|max:12|numeric',
        //     'alamat'  => 'required|min:5'
        // ]);

        DB::beginTransaction();

        try {
            $buyer = new Buyer;

            $buyer->name    = $request->name;
            $buyer->no_telp = $request->no_telp;
            $buyer->alamat  = $request->alamat;
            // $buyer->slug = Str::slug($request->name);

            $buyer->save();
            // dd($buyer);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('buyer.create')->withInput()->with(
                'error-msg',
                // $e->getMessage() = digunakan untuk pengecekan eror
                'Data Gagal disimpan'
            );
        }

        DB::commit();

        return redirect()->route('buyer.index')
            // ->withInput() jika berhasil input tampil kembali
            ->with('success-msg', 'Data berhasil disimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Buyer::with([

        ])->findOrFail($id);

        return view('buyer.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Buyer::findOrFail($id);

        // $item = Buyer::with([
        //     // 'items',
        // ])->findOrFail($id);

        $this->validate($request, [
            'name'    => 'required|min:3',
            'no_telp' => 'required|min:10,max:12',
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
            return redirect()->route('buyer.edit')->withInput()->with('error-msg', 
            // $e->getMessage() = digunakan untuk pengecekan eror
            'Data Gagal di edit');
        }

        DB:: commit();

        return redirect()->route('buyer.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil di edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Buyer::findOrFail($id);
        $item->delete();

        return redirect()->route('buyer.index');
    }
}
