<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Customer::query();
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
                                    <a class="dropdown-item" href="' . route('customer.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('customer.destroy', $item->id) . '" method="POST">
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
        return view('customer.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
        //     'name'    => 'required',
        //     'no_telp' => 'required|min:9|max:12|numeric',
        //     'alamat'  => 'required'
        // ]);

        DB::beginTransaction();

        try {
            $customer = new Customer();

            $customer->name    = $request->name;
            $customer->no_telp = $request->no_telp;
            $customer->alamat  = $request->alamat;
            // $customer->slug = Str::slug($request->name);

            $customer->save();
            // dd($customer);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.create')->withInput()->with(
                'error-msg',
                // $e->getMessage() = digunakan untuk pengecekan eror
                'Data Gagal disimpan'
            );
        }

        DB::commit();

        return redirect()->route('customer.index')
            // ->withInput() jika berhasil input tampil kembali
            ->with('success-msg', 'Data berhasil disimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Customer::with([

        ])->findOrFail($id);

        return view('customer.edit',['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Customer::findOrFail($id);

        // $item = Customer::with([
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
            return redirect()->route('customer.edit')->withInput()->with('error-msg', 
            // $e->getMessage() = digunakan untuk pengecekan eror
            'Data Gagal di edit');
        }

        DB:: commit();

        return redirect()->route('customer.index')
        // ->withInput() jika berhasil input tampil kembali
        ->with('success-msg', 'Data berhasil di edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Customer::findorFail($id);
        $item->delete();

        return redirect()->route('customer.index');
    }
}
