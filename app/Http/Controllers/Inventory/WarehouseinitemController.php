<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\warehouseinitem;
use App\Models\Inventory\warehouseinv;
use App\Models\Inventory\warehouseinvaccount;
use App\Models\Inventory\warehouseinhead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarehouseinitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warehouseinitems = warehouseinitem::latest('created_at')->paginate(10);
        return view('inventory.warehouseinitems.index', compact('warehouseinitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($warehouseinhead_id)
    {
        //
        return view('inventory.warehouseinitems.create', compact('warehouseinhead_id'));
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
        $warehouseitem=warehouseinitem::create($input);


        if ($request->has('warehouseinhead_id') && $request->input('warehouseinhead_id')> 0 && isset($warehouseitem))
        {
            $material_id=$request->input('material_id');

            $warehouseinv = warehouseinv::where('material_id', $material_id)->first();
            if (!isset($warehouseinv))
            {
                $warehouseinv = new warehouseinv();
                $warehouseinv_quantity = 0;
            }
            else
                $warehouseinv_quantity=$warehouseinv->quantity;


            $warehouseinv->material_id = $request->input('material_id');
            $warehouseinv->quantity = $request->input('quantity') + $warehouseinv_quantity;
            $warehouseinv->remark = 'warehouseinsheet:' . $request->input('warehouseinhead_id') ;

            $warehouseinhead_id=$request->input('warehouseinhead_id');
//            $warehouseinhead = warehouseinhead::latest('created_at')->where('id', $warehouseinhead_id)->first();
            $warehouseinhead = warehouseinhead::find($warehouseinhead_id);
//            dd($warehouseinheads);
            if(isset($warehouseinhead))
                $warehouseinv->warehouse_id = $warehouseinhead->warehouse_id;



            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $request->input('material_id');
            $warehouseinvaccount->warehouseoutin_id = $warehouseinhead_id;
            $warehouseinvaccount->quantity = $request->input('quantity');
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=1;
            $warehouseinvaccount->remark='warehouseinsheet:'. $warehouseinhead_id;
            $warehouseinvaccount->warehouse_id=$warehouseinhead->warehouse_id;

            $warehouseinvaccount->save();
        }

        return redirect('inventory/warehouseinheads/' . $input['warehouseinhead_id'] . '/detail');
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
        $warehouseinitem = warehouseinitem::findOrFail($id);
        $warehouseinhead_id = $warehouseinitem->warehouseinhead_id;
        return view('inventory.warehouseinitems.edit', compact('warehouseinitem','warehouseinhead_id'));
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
        $warehouseinitem = warehouseinitem::findOrFail($id);
        $warehouseinitem->update($request->all());

        if ($request->has('warehouseinhead_id') && $request->input('warehouseinhead_id')> 0 && isset($warehouseinitem))
        {
            $warehouseinhead_id=$request->input('warehouseinhead_id');

            $warehouseinv = warehouseinv::where('material_id', $warehouseinhead_id)->first();
            if (!isset($warehouseinv))
            {
                $warehouseinv = new warehouseinv();
                $warehouseinv_quantity = 0;
            }
            else
                $warehouseinv_quantity=$warehouseinv->quantity;

            $warehouseinv_oldquantity=$request->old('quantity');

            $warehouseinv->material_id = $request->input('material_id');
            $warehouseinv->quantity = $request->input('quantity') + $warehouseinv_quantity - $warehouseinv_oldquantity;
            $warehouseinv->remark = 'update warehouseinsheet:' . $request->input('warehouseinhead_id') ;

            $warehouseinhead_id=$request->input('warehouseinhead_id');
            $warehouseinheads = warehouseinhead::find($warehouseinhead_id);
            if(isset($warehouseinheads))
                $warehouseinv->warehouse_id = $warehouseinheads->warehouse_id;


            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $request->input('material_id');
            $warehouseinvaccount->warehouseoutin_id = $id;
            $warehouseinvaccount->quantity = $request->input('quantity');
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=1;
            $warehouseinvaccount->remark='update warehouseinsheet:'. $id;
            $warehouseinvaccount->warehouse_id=$warehouseinhead->warehouse_id;

            $warehouseinvaccount->save();
        }

        return redirect('inventory/warehouseinheads/' . $request->get('warehouseinhead_id') . '/detail');
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

        $warehouseinitem = warehouseinitem::findOrFail($id);
        $warehouseinhead_id = $warehouseinitem->warehouseinhead_id;
        $material_id=$warehouseinitem->material_id;

        if ( isset($warehouseoutitem))
        {
            $warehouseinv = warehouseinv::where('material_id', $material_id)->first();

            $warehouseinitem_quantity=$warehouseinitem->quanttity;
            if($warehouseinv->quantity<$warehouseinitem_quantity)
            {
                $errormesssage='库存不足';
                dd($errormesssage);
            }
            $warehouseinv->material_id = $material_id;
            $warehouseinv->quantity =  $warehouseinv->quantity- $warehouseinitem_quantity;
            $warehouseinv->remark = 'delete warehouseoutsheet:' . $warehouseinhead_id ;

            $warehouseinheads = warehouseinhead::find($warehouseinhead_id);
            if(isset($warehouseinheads))
                $warehouseinv->warehouse_id = $warehouseinheads->warehouse_id;

            $warehouseinv->save();

            $warehouseinvaccount = new warehouseinvaccount;
            $warehouseinvaccount->material_id = $material_id;
            $warehouseinvaccount->warehouseoutin_id = $warehouseinheads;
            $warehouseinvaccount->quantity = $warehouseinitem_quantity;
            $warehouseinvaccount->date = Carbon::now();
            $warehouseinvaccount->flag=-1;
            $warehouseinvaccount->remark='delete warehouseoutsheet:'. $warehouseinhead_id;
            $warehouseinvaccount->warehouse_id = $warehouseinheads->warehouse_id;

            $warehouseinvaccount->save();
        }
        warehouseinitem::destroy($id);
        return redirect('inventory/warehouseinheads/' . $warehouseinhead_id . '/detail');
    }
}
