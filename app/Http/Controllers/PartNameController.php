<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Part_Name;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;
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
            return DataTables:: of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div    class         = "btn-group">
                        <div    class         = "dropdown">
                        <button class         = "btn btn-primary dropdown-toggle mr-1 mb-1"
                                type          = "button" id = "action' .  $item->id . '"
                                data-toggle   = "dropdown"
                                aria-haspopup = "true"
                                aria-expanded = "false">
                                        Action
                                </button>
                                <div class = "dropdown-menu" aria-labelledby = "action' .  $item->id . '">
                                <a   class = "dropdown-item" href            = "' . route('partname.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action = "' . route('partname.destroy', $item->id) . '" method = "POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type = "submit" class = "dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })->editColumn('foto', function ($item) {
                    return $item->foto ? '<img src="' . Storage::url('assets/partname/'.$item->foto) . '" style="max-height: 80px;"/>' : '<img src="' . asset('/app-assets/images/no-image.png') . '" style="max-height: 80px;"/>';
                })
                ->rawColumns(['action','foto'])
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
        // $rules = array('amount' => array('match:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/'));

        $this->validate($request, [
            'partname' => 'required|min:3|unique:part__names,name',
            'unit'     => 'required|min:2',
            'std_qty'  => 'required|integer',
            'foto'     => 'image|mimes:png,jpg',
        ]);

        DB:: beginTransaction();

        try{
            $partname = new Part_Name;

            $img = $request->file('foto');
            if($img){
                $name      = $img->getClientOriginalName();
                $filename  = pathinfo($name, PATHINFO_FILENAME);
                $extension = $img->getClientOriginalExtension();

                $store_as = $filename.'_'.time().'.'.$extension;
                $img->storeAs('public/assets/partname/', $store_as);

                $partname->foto = $store_as;
            }
            
            $partname->id_cust = $request->id_cust;
            $partname->name    = $request->partname;
            $partname->satuan  = $request->unit;
            $partname->std_qty = $request->std_qty;
            $partname->stok    = '1';

            $partname->save();
            // dd($partname);

        }
        catch(\Exception $e){
            DB:: rollBack();
            return redirect()->route('partname.create')->withInput()->with('error-msg', 
            $e->getMessage());
            // 'Data Gagal disimpan');
        }

        DB:: commit();

        return redirect()->route('partname.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil disimpan data');
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
        $item = Part_Name::with(['customer'])->findOrFail($id);
        $customers = Customer::all();

        return view('part_name.edit',
        [
            'item' => $item, 
            'customers' => $customers
        ]);
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

        $partname = Part_Name::with([
            'customer',
        ])->findOrFail($id);

        $this->validate($request, [
            'name' => ['required','min:3',Rule::unique('part__names')->ignore($partname->id)],
            'unit'     => 'required|min:2',
            'std_qty'  => 'required|integer',
            'foto'     => 'image|mimes:png,jpg',
        ]);

        DB:: beginTransaction();

        try{

            $img = $request->file('foto');
            if($img){
                $name      = $img->getClientOriginalName();
                $filename  = pathinfo($name, PATHINFO_FILENAME);
                $extension = $img->getClientOriginalExtension();

                $store_as = $filename.'_'.time().'.'.$extension;
                $img->storeAs('public/assets/partname/', $store_as);

                $partname->foto = $store_as;
            }
            
            $partname->id_cust = $request->id_cust;
            $partname->name    = $request->name;
            $partname->satuan  = $request->unit;
            $partname->std_qty = $request->std_qty;
            $partname->stok    = '1';

            $partname->update();
            // dd($partname);

        }
        catch(\Exception $e){
            DB:: rollBack();
            return redirect()->route('partname.edit')->withInput()->with('error-msg', 
            // $e->getMessage());
            'Data Gagal di Update');
        }

        DB:: commit();

        return redirect()->route('partname.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Part_Name  $part_Name
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Part_Name::findorFail($id);
        $item->delete();

        return redirect()->route('partname.index');
    }
}
