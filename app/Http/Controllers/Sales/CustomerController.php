<?php

namespace App\Http\Controllers\Sales;

use App\Models\Sales\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::latest('created_at')->paginate(10);
        return view('sales.customers.index', compact('customers'));
    }

    public function getitemsbykey($key)
    {
        // $salesorders = Salesorder::latest('created_at')->where('number', 'like', '%' . $key . '%')
        //     ->orWhere('descrip', 'like', '%'.$key.'%')->paginate(20);
        // $vendinfos = Vendinfo::where('name', 'like', '%' . $key . '%')->paginate(20);
        $customers = Customer::where('name', 'like', '%' . $key . '%')
            ->orWhere('number', 'like', '%' . $key . '%')->paginate(20);
        return $customers;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sales.customers.create');
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
        Customer::create($input);

        return redirect('sales/customers');
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
        $customer = Customer::findOrFail($id);
        return view('sales.customers.edit', compact('customer'));
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
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());


        return redirect('sales/customers');
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
        Customer::destroy($id);
        return redirect('sales/customers');
    }
}
