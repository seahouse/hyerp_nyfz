<?php

namespace App\Http\Controllers\Sales;

use App\Models\Sales\Sohead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoheadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $inputs = $request->all();
//        $shipments = $this->searchrequest($request)->paginate(10);
//        $shipments = Shipment::latest('created_at')->paginate(15);
        $soheads = Sohead::latest('created_at')->paginate(10);
        return view('sales.soheads.index', compact('soheads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sales.soheads.create');
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
            'number' => 'required|unique:soheads|max:255',
            'customer_id'=>'required',
            'orderdate'=>'required',
        ]);

        $input = $request->all();
//        dd($input);
        Sohead::create($input);

        return redirect('sales/soheads');
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
        $sohead = Sohead::findOrFail($id);
        return view('sales.soheads.edit', compact('sohead'));
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
        $sohead = Sohead::findOrFail($id);
        $sohead->update($request->all());


        return redirect('sales/soheads');
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
        Sohead::destroy($id);
        return redirect('sales/soheads');
    }
}
