<?php

namespace App\Http\Controllers\Sales;

use App\Models\Sales\Maintainrecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaintainrecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $inputs = $request->all();
        $maintainrecords = $this->searchrequest($request);
//        $shipments = Shipment::latest('created_at')->paginate(15);
//        $soheads = Sohead::latest('created_at')->paginate(10);
        $sohead_id = null;
        if ($request->has('sohead_id') && $request->input('sohead_id') > 0)
            $sohead_id = $request->input('sohead_id');
        return view('sales.maintainrecords.index', compact('maintainrecords', 'inputs', 'sohead_id'));
    }

    private function searchrequest(Request $request)
    {
        $query = Maintainrecord::latest('created_at');

        if ($request->has('sohead_id') && $request->input('sohead_id') > 0)
            $query->where('sohead_id', $request->input('sohead_id'));

        $items = $query->paginate(10);

        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sohead_id)
    {
        //
        return view('sales.maintainrecords.create', compact('sohead_id'));
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
        Maintainrecord::create($input);

        return redirect('sales/soheads/' . $request->input('sohead_id') . '/maintainrecords');
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
        $maintainrecord = Maintainrecord::findOrFail($id);
        $sohead_id = $maintainrecord->sohead_id;
        return view('sales.maintainrecords.edit', compact('maintainrecord', 'sohead_id'));
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
        $maintainrecord = Maintainrecord::findOrFail($id);
        $maintainrecord->update($request->all());
        return redirect('sales/soheads/' . $request->input('sohead_id') . '/maintainrecords');
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
        $maintainrecord = Maintainrecord::findOrFail($id);
        $sohead_id = $maintainrecord->sohead_id;
        Maintainrecord::destroy($id);
        return redirect('sales/soheads/' . $sohead_id . '/maintainrecords');
    }
}
