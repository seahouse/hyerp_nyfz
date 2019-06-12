<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\warehouseouthead;
use App\Models\Inventory\warehouseoutitem;

class WarehouseoutheadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warehouseoutheads = warehouseouthead::latest('created_at')->paginate(10);
        return view('inventory.warehouseoutheads.index', compact('warehouseoutheads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inventory.warehouseoutheads.create');
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
        warehouseouthead::create($input);

        return redirect('inventory/warehouseoutheads');
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
        $warehouseouthead = warehouseouthead::findOrFail($id);
        return view('inventory.warehouseoutheads.edit', compact('warehouseouthead'));
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
        $warehouseouthead = warehouseouthead::findOrFail($id);
        $warehouseouthead->update($request->all());


        return redirect('inventory/warehouseoutheads');
    }

    public function detail($id)
    {
        $warehouseoutitems = warehouseoutitem::latest('created_at')->where('warehouseouthead_id', $id)->paginate(10);
        return view('inventory.warehouseoutitems.index', compact('warehouseoutitems', 'id'));
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
        $warehouseoutitem=warehouseoutitem::where('warehouseouthead_id', $id)->first();
        if(isset($warehouseoutitem))
        {
            $errormessags='此单据有明细，请删除明细之后，才能删除此单据';
            dd($errormessags);
        }
        warehouseouthead::destroy($id);
        return redirect('inventory/warehouseoutheads');
    }
}
