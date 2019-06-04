<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\warehouseinv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\warehouseoutitem;

class WarehouseoutitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warehouseoutitems = warehouseoutitem::latest('created_at')->paginate(10);
        return view('inventory.warehouseoutitems.index', compact('warehouseoutitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($warehouseouthead_id)
    {
        //
        return view('inventory.warehouseoutitems.create', compact('warehouseouthead_id'));
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
//        dd($input);
        $warehouseitem=warehouseoutitem::create($input);

        if ($request->has('warehouseouthead_id') && $request->input('warehouseouthead_id')> 0 && isset($warehouseitem))
        {
            $warehouseinv=new warehouseinv();
            $warehouseinv_quantity=$warehouseinv->quantity;


            $warehouseinv->material_id = $request->input('material_id');
            $warehouseinv->quantity =  $warehouseinv_quantity - $request->input('quantity');
            $warehouseinv->remark = 'warehouseoutsheet:' . $request->input('warehouseouthead_id') ;

            $id=$request->input('warehouseouthead_id');
            $warehouseoutheads = warehouseouthead::latest('created_at')->where('warehouseouthead_id', $id);
            $warehouseinv->warehouse_id = $warehouseoutheads->warehouse_id;

            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $request->input('material_id');
            $warehouseinvaccount->warehouseoutin_id = $warehouseoutheads->warehouse_id;
            $warehouseinvaccount->quantity = $request->input('quantity');
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=-1;
            $warehouseinvaccount->remark='warehouseoutsheet:'. $warehouseoutheads->warehouse_id;

            $warehouseinvaccount->save();
        }
        return redirect('inventory/warehouseoutitems/' . $input['warehouseouthead_id'] . '/detail');
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
        $warehouseoutitem = warehouseoutitem::findOrFail($id);
        $warehouseouthead_id = $warehouseoutitem->warehouseouthead_id;
        return view('inventory.warehouseoutitems.edit', compact('warehouseoutitem','warehouseouthead_id'));
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
        $warehouseoutitem = warehouseoutitem::findOrFail($id);
        $warehouseoutitem->update($request->all());

        if ($request->has('warehouseouthead_id') && $request->input('warehouseouthead_id')> 0 && isset($warehouseoutitem))
        {
            $warehouseinv=new warehouseinv();
            $warehouseinv_quantity=$warehouseinv->quantity;
            $warehouseinv_oldquantity=$request->old('quantity');

            $warehouseinv->material_id = $request->input('material_id');
            $warehouseinv->quantity =  $warehouseinv_quantity - $request->input('quantity') - $warehouseinv_oldquantity;
            $warehouseinv->remark = 'update warehouseoutsheet:' . $request->input('warehouseouthead_id') ;

            $id=$request->input('warehouseouthead_id');
            $warehouseoutheads = warehouseouthead::latest('created_at')->where('warehouseouthead_id', $id);
            $warehouseinv->warehouse_id = $warehouseoutheads->warehouse_id;

            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $request->input('material_id');
            $warehouseinvaccount->warehouseoutin_id = $warehouseoutheads->warehouse_id;
            $warehouseinvaccount->quantity = $request->input('quantity');
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=-1;
            $warehouseinvaccount->remark='udpate warehouseoutsheet:'. $warehouseoutheads->warehouse_id;

            $warehouseinvaccount->save();
        }
        return redirect('inventory/warehouseoutheads/'. $request->get('warehouseouthead_id') . '/detail');
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
        $warehouseoutitem = warehouseoutitem::findOrFail($id);
        $warehouseouthead_id = $warehouseoutitem->warehouseouthead_id;
        warehouseoutitem::destroy($id);
        return redirect('inventory/warehouseoutitems/'. $warehouseouthead_id . '/detail');
    }
}
