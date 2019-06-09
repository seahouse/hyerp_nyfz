<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\warehouseinv;
use App\Models\Inventory\warehouseinvaccount;
use App\Models\Inventory\warehouseouthead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\warehouseoutitem;
use Log;

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
        $warehouseinv_quantity = 0.0;
        if ($request->has('material_id') && $request->input('material_id') > 0)
        {
            $warehouseinv = warehouseinv::where('material_id', $request->input('material_id'))->first();
            if (isset($warehouseinv))
                $warehouseinv_quantity=$warehouseinv->quantity;

            $this->validate($request, [
                'quantity' => 'numeric|max:' . $warehouseinv_quantity,
            ]);
        }

        $input = $request->all();
//        dd($input);
        $warehouseitem=warehouseoutitem::create($input);

        if ($request->has('warehouseouthead_id') && $request->input('warehouseouthead_id')> 0 && isset($warehouseitem))
        {
           $warehouseinv->material_id = $request->input('material_id');
            $warehouseinv->quantity =  $warehouseinv_quantity- $request->input('quantity');
            $warehouseinv->remark = 'warehouseoutsheet:' . $request->input('warehouseouthead_id') ;

            $warehouseouthead_id=$request->input('warehouseouthead_id');
            $warehouseoutheads = warehouseouthead::find($warehouseouthead_id);
            if(isset($warehouseoutheads))
                $warehouseinv->warehouse_id = $warehouseoutheads->warehouse_id;

            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $request->input('material_id');
            $warehouseinvaccount->warehouseoutin_id = $warehouseouthead_id;
            $warehouseinvaccount->quantity = $request->input('quantity');
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=-1;
            $warehouseinvaccount->remark='warehouseoutsheet:'.$warehouseouthead_id;
            $warehouseinvaccount->warehouse_id = $warehouseoutheads->warehouse_id;

            $warehouseinvaccount->save();
        }
        return redirect('inventory/warehouseoutheads/' . $input['warehouseouthead_id'] . '/detail');
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

            $material_id=$request->input('material_id');
            $warehouseinv = warehouseinv::where('material_id', $material_id)->first();
            $warehouseinv_quantity=$warehouseinv->quantity;

            $this->validate($request, [
                'quantity' => 'number|between:0,$warehouseinv_quantity',
            ]);
            $warehouseinv_oldquantity=$request->old('quantity');

            $warehouseinv->material_id = $request->input('material_id');
            $warehouseinv->quantity =  $warehouseinv_quantity - $request->input('quantity') - $warehouseinv_oldquantity;
            $warehouseinv->remark = 'update warehouseoutsheet:' . $request->input('warehouseouthead_id') ;

            $warehouseouthead_id=$request->input('warehouseouthead_id');
            $warehouseoutheads = warehouseouthead::find($warehouseouthead_id);
            if(isset($warehouseoutheads))
                $warehouseinv->warehouse_id = $warehouseoutheads->warehouse_id;

            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $request->input('material_id');
            $warehouseinvaccount->warehouseoutin_id = $warehouseouthead_id;
            $warehouseinvaccount->quantity = $request->input('quantity');
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=-1;
            $warehouseinvaccount->remark='udpate warehouseoutsheet:'. $warehouseouthead_id;
            $warehouseinvaccount->warehouse_id = $warehouseoutheads->warehouse_id;

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
        $material_id=$warehouseoutitem->material_id;


        if ( isset($warehouseoutitem))
        {
            $warehouseinv = warehouseinv::where('material_id', $material_id)->first();

            $warehouseoutitem_quantity=$warehouseoutitem->quanttity;

            $warehouseinv->material_id = $material_id;
            $warehouseinv->quantity =  $warehouseinv->quantity +  $warehouseoutitem_quantity;
            $warehouseinv->remark = 'delete warehouseoutsheet:' . $warehouseouthead_id ;

            $warehouseoutheads = warehouseouthead::find($id);
            if(isset($warehouseoutheads))
                $warehouseinv->warehouse_id = $warehouseoutheads->warehouse_id;

            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $material_id;
            $warehouseinvaccount->warehouseoutin_id = $warehouseouthead_id;
            $warehouseinvaccount->quantity = $warehouseoutitem_quantity;
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=-1;
            $warehouseinvaccount->remark='delete warehouseoutsheet:'. $warehouseouthead_id;
            $warehouseinvaccount->warehouse_id = $warehouseoutheads->warehouse_id;

            $warehouseinvaccount->save();
        }

        warehouseoutitem::destroy($id);

        return redirect('inventory/warehouseoutitems/'. $warehouseouthead_id . '/detail');
    }
}
