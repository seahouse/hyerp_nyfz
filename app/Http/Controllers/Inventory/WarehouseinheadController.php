<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\warehouseinhead;
use App\Models\Inventory\warehouseinitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarehouseinheadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warehouseinheads = warehouseinhead::latest('created_at')->paginate(10);
        return view('inventory.warehouseinheads.index', compact('warehouseinheads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inventory.warehouseinheads.create');
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
        $input = $request->all();
        //dd($input);
        warehouseinhead::create($input);

        return redirect('inventory/warehouseinheads');
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
        $warehouseinhead = warehouseinhead::findOrFail($id);
        return view('inventory.warehouseinheads.edit', compact('warehouseinhead'));
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
        $warehouseinhead = warehouseinhead::findOrFail($id);
        $warehouseinhead->update($request->all());


        return redirect('inventory/warehouseinheads');
    }

    public function detail($id)
    {
        $warehouseinitems = warehouseinitem::latest('created_at')->where('warehouseinhead_id', $id)->paginate(10);
        return view('inventory.warehouseinitems.index', compact('warehouseinitems', 'id'));
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
        warehouseinhead::destroy($id);
        return redirect('inventory/warehouseinheads');
    }
}
