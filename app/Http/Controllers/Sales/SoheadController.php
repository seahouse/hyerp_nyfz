<?php

namespace App\Http\Controllers\Sales;

use App\Models\Finance\Receipt;
use App\Models\Sales\Maintainrecord;
use App\Models\Sales\Sohead;
use App\Models\Sales\Soheadattachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

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

    public function getitemsbykey($key = '')
    {
        $soheads = Sohead::latest('created_at')->where('number', 'like', '%' . $key . '%')
            ->orWhere('name', 'like', '%'.$key.'%')->paginate(20);
        return $soheads;
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
        $sohead = Sohead::create($input);

        if ($sohead)
        {
            $files = array_get($request->all(), 'files');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        $path = $file->store('public/soheads/' . $sohead->id);

                        $soheadattachment = Soheadattachment::where('sohead_id', $sohead->id)->where('type', 'file')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($soheadattachment))
                            $soheadattachment = new Soheadattachment();
                        $soheadattachment->sohead_id = $sohead->id;
                        $soheadattachment->type = 'file';
                        $soheadattachment->filename = $file->getClientOriginalName();
                        $soheadattachment->path = $path;     // add a '/' in the head.
                        $soheadattachment->save();
                    }
                }
            }

            $files = array_get($request->all(), 'images');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        $path = $file->store('public/soheads/' . $sohead->id);

                        $soheadattachment = Soheadattachment::where('sohead_id', $sohead->id)->where('type', 'image')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($soheadattachment))
                            $soheadattachment = new Soheadattachment();
                        $soheadattachment->sohead_id = $sohead->id;
                        $soheadattachment->type = 'image';
                        $soheadattachment->filename = $file->getClientOriginalName();
                        $soheadattachment->path = $path;     // add a '/' in the head.
                        $soheadattachment->save();
                    }
                }
            }
        }

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
        $sohead = Sohead::findOrFail($id);
        return view('sales.soheads.show', compact('sohead'));
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

        if ($sohead)
        {
            $files = array_get($request->all(), 'files');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        $path = $file->store('public/soheads/' . $sohead->id);

                        $soheadattachment = Soheadattachment::where('sohead_id', $sohead->id)->where('type', 'file')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($soheadattachment))
                            $soheadattachment = new Soheadattachment();
                        $soheadattachment->sohead_id = $sohead->id;
                        $soheadattachment->type = 'file';
                        $soheadattachment->filename = $file->getClientOriginalName();
                        $soheadattachment->path = $path;     // add a '/' in the head.
                        $soheadattachment->save();
                    }
                }
            }

            $files = array_get($request->all(), 'images');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        $path = $file->store('public/soheads/' . $sohead->id);

                        $soheadattachment = Soheadattachment::where('sohead_id', $sohead->id)->where('type', 'image')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($soheadattachment))
                            $soheadattachment = new Soheadattachment();
                        $soheadattachment->sohead_id = $sohead->id;
                        $soheadattachment->type = 'image';
                        $soheadattachment->filename = $file->getClientOriginalName();
                        $soheadattachment->path = $path;     // add a '/' in the head.
                        $soheadattachment->save();
                    }
                }
            }
        }

        return redirect('sales/soheads');
    }


    public function createreceipt($sohead_id)
    {
        //
        return view('sales.soheads.createreceipt',compact('sohead_id'));
    }

    public function indexreceipt($sohead_id)
    {
        //
        $receipts=Receipt::where('sohead_id',$sohead_id)->paginate(10);
        return view('sales.soheads.indexreceipt',compact('receipts'));
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

    public function maintainrecords($sohead_id)
    {
        //
        $maintainrecords = Maintainrecord::where('sohead_id',$sohead_id)->paginate(10);
        $inputs = [];
        return view('sales.maintainrecords.index',compact('maintainrecords', 'sohead_id', 'inputs'));
    }

    public function clearfile(Request $request)
    {
        //
//        Log::info($request->all());
        $popoverhtml = '';
        Log::info($request->all());
        if ($request->has('sohead_id') && $request->has('type') && $request->has('filename'))
        {
            $sohead = Sohead::find($request->input('sohead_id'));
            if (isset($sohead))
            {
                $type = $request->input('type');
                $filename = $request->input('filename');

                $soheadattachments = Soheadattachment::where('sohead_id', $sohead->id)->where('type', $type)->where('filename', $filename)->get();
                Log::info($soheadattachments);
                foreach ($soheadattachments as $soheadattachment)
                {
                    if (isset($soheadattachment))
                    {
//                        $path = $shipmentattachment->path;
                        $soheadattachment->delete();

//                        // add record
//                        $shipmentattachmentrecord = new Shipmentattachmentrecord();
//                        $shipmentattachmentrecord->shipment_id = $shipment->id;
//                        $shipmentattachmentrecord->type = $type;
//                        $shipmentattachmentrecord->filename = $filename;
//                        $shipmentattachmentrecord->path = $path;     // add a '/' in the head.
//                        $shipmentattachmentrecord->operation_type = 'Delete';
//                        $shipmentattachmentrecord->operator = Auth::user()->name;
//                        $shipmentattachmentrecord->save();
                    }
                }

//                $popoverhtml = '<button class="btn btn-sm" data-toggle="modal" data-target="#uploadAttachModal" data-shipment_id="' . $shipment->id . '" data-type="' . $type . '" type="button">+</button>';

                Log::info($popoverhtml);
            }
        }

        $data = [
            'errcode' => 0,
            'errmsg' => '删除成功。',
            'popoverhtml' => $popoverhtml,
        ];
        return response()->json($data);
    }
}
