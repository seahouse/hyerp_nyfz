<?php

namespace App\Http\Controllers\Purchaseorderc;

use App\Models\Purchaseorderc\Poheadc;
use App\Models\Purchaseorderc\Poitemc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseordercController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchaseorders = Poheadc::latest('created_at')->paginate(10);
        return view('purchaseorderc.purchaseordercs.index', compact('purchaseorders'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $purchaseorder = Poheadc::findOrFail($id);
        return view('purchaseorderc.purchaseordercs.show', compact('purchaseorder'));
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
        $purchaseorder = Poheadc::findOrFail($id);
        return view('purchaseorderc.purchaseordercs.edit', compact('purchaseorder'));
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
    }

    public function detail($id)
    {
        $poitems = Poitemc::where('poheadc_id', $id)->orderBy('fabric_sequence_no')->paginate(10);
        return view('purchaseorderc.poitemcs.index', compact('poitems', 'id'));
    }

    public function seperate($id)
    {
        $purchaseorder = Poheadc::findOrFail($id);
        return view('purchaseorderc.purchaseordercs.seperate', compact('purchaseorder'));
    }
}
