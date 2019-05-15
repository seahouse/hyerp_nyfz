<?php

namespace App\Http\Controllers\Basic;

use App\Models\Basic\Material_cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Material_catController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $material_cats = Material_cat::latest('created_at')->paginate(10);
        return view('basic.material_cats.index', compact('material_cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('basic.material_cats.create');
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

        $this->validate($request, [
            'number' => 'required|unique:material_cats|max:255',
            'name'=>'required',
        ]);
        $input = $request->all();

        Material_cat::create($input);

        return redirect('basic/material_cats');
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
        //
        $material_cat = Material_cat::findOrFail($id);
        return view('basic.material_cats.edit', compact('material_cat'));
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
        //

        $material_cat = Material_cat::findOrFail($id);
        $material_cat->update($request->all());
        return redirect('basic/material_cats');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Material_cat::destroy($id);
        return redirect('basic/material_cats');
    }
}
