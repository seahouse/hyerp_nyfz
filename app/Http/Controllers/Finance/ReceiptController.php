<?php

namespace App\Http\Controllers\Finance;

use App\Models\Finance\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
//        $receipts = Receipt::latest('created_at')->paginate(10);
        $receipts = $this->searchrequest($request);
        $inputs = $request->all();
        return view('finance.receipts.index', compact('receipts', 'inputs'));
    }

    private function searchrequest(Request $request)
    {
        $query = Receipt::latest('created_at');

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
    public function create()
    {
        //
        return view('finance.receipt.create');
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
        Receipt::create($input);

        if ($request->has('sohead_id') && $request->input('sohead_id') > 0)
            return http_redirect(url('finace/receipts'), ['sohead_id' => $request->input('sohead_id')]);
        else
            return redirect('finance/receipts/');
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
        $receipt = Receipt::where(sohead_id,$id)->first();
        return view('finance.receipts.edit', compact('receipt'));
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
        $receipt = Receipt::findOrFail($id);
        $receipt->update($request->all());
        return redirect('finance/receipts/');
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
        $payment = Receipt::findOrFail($id);

        Receipt::destroy($id);

        return redirect('finance/receipts/');
    }
}
