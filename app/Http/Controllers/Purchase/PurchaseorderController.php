<?php

namespace App\Http\Controllers\Purchase;

use App\Models\Finance\Payment;
use App\Models\Purchase\Poheadattachment;
use App\Models\Purchase\Poitem;
use App\Models\Purchase\Purchaseorder;
use App\Models\Purchase\Sohead_Pohead;
use App\Models\Purchaseorderc\Poitemc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class PurchaseorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchaseorders = Purchaseorder::latest('created_at')->paginate(10);
        return view('purchase.purchaseorders.index', compact('purchaseorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('purchase.purchaseorders.create');
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
            'vendor_id'=>'required',
            'orderdate'=>'required',
        ]);

        $input = $request->all();
        //dd($input);
        $pohead = Purchaseorder::create($input);

        if ($request->has('sohead_id') && $request->input('sohead_id')> 0 && isset($pohead))
        {
            $sohead_pohead = new Sohead_Pohead;
            $sohead_pohead->sohead_id = $request->input('sohead_id');
            $sohead_pohead->pohead_id = $pohead->id;
            $sohead_pohead->save();
        }

        if ($pohead)
        {
            $files = array_get($request->all(), 'files');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        $path = $file->store('public/poheads/' . $pohead->id);

                        $poheadattachment = Poheadattachment::where('pohead_id', $pohead->id)->where('type', 'file')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($poheadattachment))
                            $poheadattachment = new Poheadattachment();
                        $poheadattachment->pohead_id = $pohead->id;
                        $poheadattachment->type = 'file';
                        $poheadattachment->filename = $file->getClientOriginalName();
                        $poheadattachment->path = $path;     // add a '/' in the head.
                        $poheadattachment->save();
                    }
                }
            }

            $files = array_get($request->all(), 'images');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        $path = $file->store('public/poheads/' . $pohead->id);

                        $poheadattachment = Poheadattachment::where('pohead_id', $pohead->id)->where('type', 'image')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($poheadattachment))
                            $poheadattachment = new Poheadattachment();
                        $poheadattachment->pohead_id = $pohead->id;
                        $poheadattachment->type = 'image';
                        $poheadattachment->filename = $file->getClientOriginalName();
                        $poheadattachment->path = $path;     // add a '/' in the head.
                        $poheadattachment->save();
                    }
                }
            }
        }

        return redirect('purchase/purchaseorders');
    }

    public function storeseperate(Request $request)
    {
        $this->validate($request, [
            'number'                    => 'required',
//            'descrip'                   => 'required',
            'vendor_id'                 => 'required|integer|min:1',
            'orderdate'                 => 'required',
            'poheadc_id'                => 'required|integer|min:1',
//            'items_string'               => 'required',
//            'tonnage'               => 'required|numeric',
//            'drawingchecker_id'     => 'required|integer|min:1',
//            'drawingcount'          => 'required|integer|min:1',
//            'drawingattachments.*'  => 'required|file',
//            'images.*'                => 'required|image',
        ]);

        $input = $request->all();

        // 判断明细数量是否超量，前端已有余量显示，但如果存在多人操作系统，前端的显示不会实时刷新，所以这里继续判断
        $items_string = json_decode($input['items_string']);
        foreach ($items_string as $value) {
            if ($value->poitemc_id > 0 && $value->quantity > 0)
            {
                $poitemc = Poitemc::find($value->poitemc_id);
                if (isset($poitemc))
                {
                    if ($poitemc->quantity < ($poitemc->poitems->sum('quantity') + $value->quantity))
                        dd($poitemc->material_code . '超出了最大量，无法继续分单。');
                }
            }
        }

//        dd($input);
        $purchaseorder = Purchaseorder::create($input);
        // 创建明细信息
        if (isset($purchaseorder))
        {
            $items_string = json_decode($input['items_string']);
            foreach ($items_string as $value) {
                if ($value->poitemc_id > 0 && $value->quantity > 0)
                {
                    $item_array = json_decode(json_encode($value), true);
                    $item_array['pohead_id'] = $purchaseorder->id;
                    Poitem::create($item_array);
                }
            }
        }

        return redirect('purchase/purchaseorders');
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
        $purchaseorder = Purchaseorder::findOrFail($id);
        return view('purchase.purchaseorders.show', compact('purchaseorder'));
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
        $purchaseorder = Purchaseorder::findOrFail($id);
        return view('purchase.purchaseorders.edit', compact('purchaseorder'));
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
        $pohead = Purchaseorder::findOrFail($id);
        $pohead->update($request->all());

        if ($request->has('sohead_id') && $request->input('sohead_id')> 0)
        {
            $sohead_pohead = new Sohead_Pohead;
            $sohead_pohead->sohead_id = $request->input('sohead_id');
            $sohead_pohead->pohead_id = $pohead->id;
            $sohead_pohead->save();
        }

        if ($pohead)
        {
            $files = array_get($request->all(), 'files');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        dd($file);
                        $path = $file->store('public/poheads/' . $pohead->id);

                        $poheadattachment = Poheadattachment::where('pohead_id', $pohead->id)->where('type', 'file')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($poheadattachment))
                            $poheadattachment = new Poheadattachment();
                        $poheadattachment->pohead_id = $pohead->id;
                        $poheadattachment->type = 'file';
                        $poheadattachment->filename = $file->getClientOriginalName();
                        $poheadattachment->path = $path;     // add a '/' in the head.
                        $poheadattachment->save();
                    }
                }
            }

            $files = array_get($request->all(), 'images');
            if ($files)
            {
                foreach ($files as $key => $file) {
                    if ($file)
                    {
                        $path = $file->store('public/poheads/' . $pohead->id);

                        $poheadattachment = Poheadattachment::where('pohead_id', $pohead->id)->where('type', 'image')->where('filename',$file->getClientOriginalName()) ->first();
                        if (!isset($poheadattachment))
                            $poheadattachment = new Poheadattachment();
                        $poheadattachment->pohead_id = $pohead->id;
                        $poheadattachment->type = 'image';
                        $poheadattachment->filename = $file->getClientOriginalName();
                        $poheadattachment->path = $path;     // add a '/' in the head.
                        $poheadattachment->save();
                    }
                }
            }
        }

        return redirect('purchase/purchaseorders');
    }

    public function createpayment($pohead_id)
    {
        //
        return view('purchase.purchaseorders.createpayment',compact('pohead_id'));
    }

    public function indexpayment($pohead_id)
    {
        //
        //dd($pohead_id);
        $payments=Payment::where('pohead_id',$pohead_id)->paginate(10);
        return view('purchase.purchaseorders.indexpayment',compact('payments'));
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
        Purchaseorder::destroy($id);
        return redirect('purchase/purchaseorders');
    }

    public function detail($id)
    {
        $poitems = Poitem::latest('created_at')->where('pohead_id', $id)->paginate(10);
        return view('purchase.poitems.index', compact('poitems', 'id'));
    }

    public function packing($id)
    {
        $poitems = Poitem::where('pohead_id', $id)->paginate(10);
        return view('purchase.purchaseorders.packing', compact('poitems', 'id'));
    }

    public function getitemsbyorderkey($key = "")
    {
        //
        $purchaseorders = Purchaseorder::where(function ($query) use ($key) {
                $query->where('number', 'like', '%'.$key.'%')
//                    ->orWhere('descrip', 'like', '%'.$key.'%')
                ;
            })
            ->paginate(20);
        return $purchaseorders;
    }

    public function clearfile(Request $request)
    {
        //
//        Log::info($request->all());
        $popoverhtml = '';
        Log::info($request->all());
        if ($request->has('pohead_id') && $request->has('type') && $request->has('filename'))
        {
            $pohead = Purchaseorder::find($request->input('pohead_id'));
            if (isset($pohead))
            {
                $type = $request->input('type');
                $filename = $request->input('filename');

                $poheadattachments = Poheadattachment::where('pohead_id', $pohead->id)->where('type', $type)->where('filename', $filename)->get();
//                Log::info($poheadattachments);
                foreach ($poheadattachments as $poheadattachment)
                {
                    if (isset($poheadattachment))
                    {
//                        $path = $shipmentattachment->path;
                        $poheadattachment->delete();

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
