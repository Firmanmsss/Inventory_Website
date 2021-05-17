<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Category::query();
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
                                    <a class="dropdown-item" href="' . route('category.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('category.destroy', $item->id) . '" method="POST">
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
        return view('category.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB:: beginTransaction();

        try {
            $category = new Category();

            $category->category_name = $request->name;
            // $category->slug = Str::slug($request->name);

            $category->save();
        } catch (\Exception $e) {
            DB:: rollBack();
            return redirect()->route('category.create')->withInput()->with(
                'error-msg',
                // $e->getMessage() = digunakan untuk pengecekan eror
                'Data Gagal disimpan'
            );
        }

        DB:: commit();

        return redirect()->route('category.index')
            // ->withInput() jika berhasil input tampil kembali
            ->with('success-msg', 'Data berhasil disimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Category::with([

        ])->findOrFail($id);

        return view('category.edit',['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Category::findOrFail($id);

        // $item = Category::with([
        //     // 'items',
        // ])->findOrFail($id);

        $this->validate($request, [
            'name'    => 'required|min:3',
        ]);

        DB:: beginTransaction();
        
        try{

            $item->category_name    = $request->name;
            // $item->slug = Str::slug($request->name);

            $item->update();

        }
        catch(\Exception $e){
            DB:: rollBack();
            return redirect()->route('category.edit')->withInput()->with('error-msg', 
            // $e->getMessage() = digunakan untuk pengecekan eror
            'Data Gagal di edit');
        }

        DB:: commit();

        return redirect()->route('category.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findorFail($id);
        $item->delete();

        return redirect()->route('category.index');
    }
}
