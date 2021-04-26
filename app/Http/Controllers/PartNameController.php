<?php

namespace App\Http\Controllers;

use App\Part_Name;
use Illuminate\Http\Request;

class PartNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('part_name.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(Part_Name $part_Name)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Part_Name  $part_Name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part_Name $part_Name)
    {
        //
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
