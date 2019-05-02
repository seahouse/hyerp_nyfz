<?php

namespace App\Http\Controllers\Purchase;

use App\Models\Purchase\Asn;
use App\Models\Purchase\Asnitem;
use App\Models\Purchase\Asnshipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel, Log;

class AsnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $asns = Asn::latest('created_at')->paginate(10);
        return view('purchase.asns.index', compact('asns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('purchase.asns.create');
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
        if (!$request->has('interchange_datetime'))
            $input['interchange_datetime'] = Carbon::now()->toDateTimeString();
        $maxasn = Asn::OrderBy('interchange_control_number', 'desc')->first();
        $maxnum = 1;
        if (isset($maxasn))
            $maxnum = $maxasn->interchange_control_number + 1;
        $maxnum = str_pad($maxnum, 9, "0", STR_PAD_LEFT);
        $input['interchange_control_number'] = $maxnum;
        if (!$request->has('data_interchange_datetime'))
            $input['data_interchange_datetime'] = Carbon::now()->toDateTimeString();
        if (!$request->has('transaction_set_control_no'))
            $input['transaction_set_control_no'] = "0001";
//        dd($input);

        $asn = Asn::create($input);
        if (isset($asn))
        {
            $input['asn_id'] = $asn->id;
            Asnshipment::create($input);
        }

        return redirect('purchase/asns');
    }

    public function packingstore(Request $request)
    {
        //
        $input = $request->all();
        if (strlen($input['items_string']) < 1)
            dd('未设置任何打包数据，保存ASN失败。');

        $number = Carbon::now()->toDateTimeString();
        $input['number'] = $number;

        $asn = Asn::create($input);

        if (isset($asn))
        {
            $asnitems = json_decode($input['items_string']);
            foreach ($asnitems as $asnitem) {
                $item_array = json_decode(json_encode($asnitem), true);
                $item_array['asn_id'] = $asn->id;

                Asnitem::create($item_array);
            }
        }
        return redirect('purchase/asns');
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
        $asn = Asn::findOrFail($id);
        return view('purchase.asns.edit', compact('asn'));
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
        $asn = Asn::findOrFail($id);
        $asn->update($request->all());
        $asn->asnshipments->first()->update($request->all());
        return redirect('purchase/asns');
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
        Asn::destroy($id);
        return redirect('purchase/asns');
    }

    public function detail($id)
    {
        $asnitems = Asnitem::where('asn_id', $id)->paginate(10);
        return view('purchase.asnitems.index', compact('asnitems', 'id'));
    }

    public function asnshipments($id)
    {
        $asnshipments = Asnshipment::where('asn_id', $id)->paginate(10);
        return view('purchase.asnshipments.index', compact('asnshipments', 'id'));
    }

    public function labelpreprint($id)
    {
//        echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T");
//        echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");
//        echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';
//        echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T");

//        echo DNS1D::getBarcodeSVG("4445645656", "C39");
//        echo DNS2D::getBarcodeHTML("4445645656", "QRCODE");
//        echo DNS2D::getBarcodePNGPath("4445645656", "PDF417");
//        echo DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX");
//        echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG("4", "PDF417") . '" alt="barcode"   />';

        // Width and Height example
//        echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33);
//        echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33);
//        echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33) . '" alt="barcode"   />';
//        echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33);
//        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+",3,33) . '" alt="barcode"   />';

        // Color
//        echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33,"green");
//        echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33,"green");
//        echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1)) . '" alt="barcode"   />';
//        echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33,array(255,255,0));
//        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1)) . '" alt="barcode"   />';

        // Show Text
//        echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33,"green", true);
//        echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33,"green", true);
//        echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1), true) . '" alt="barcode"   />';
//        echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33,array(255,255,0), true);
//        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1), true) . '" alt="barcode"   />';
//        echo DNS1D::getBarcodeHTML("4445645656", "C128");

        // 2D Barcodes
//        echo DNS2D::getBarcodeHTML("4445645656", "QRCODE");
//        echo DNS2D::getBarcodePNGPath("4445645656", "PDF417");
//        echo DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX");

        // 1D Barcodes
//        echo DNS1D::getBarcodeHTML("4445645656", "C39");
//        echo DNS1D::getBarcodeHTML("4445645656", "C39+");
//        echo DNS1D::getBarcodeHTML("4445645656", "C39E");
//        echo DNS1D::getBarcodeHTML("4445645656", "C39E+");
//        echo DNS1D::getBarcodeHTML("4445645656", "C93");
//        echo DNS1D::getBarcodeHTML("4445645656", "S25");
//        echo DNS1D::getBarcodeHTML("4445645656", "S25+");
//        echo DNS1D::getBarcodeHTML("4445645656", "I25");
//        echo DNS1D::getBarcodeHTML("4445645656", "I25+");
//        echo DNS1D::getBarcodeHTML("4445645656", "C128");
//        echo DNS1D::getBarcodeHTML("4445645656", "C128A");
//        echo DNS1D::getBarcodeHTML("4445645656", "C128B");
//        echo DNS1D::getBarcodeHTML("4445645656", "C128C");
//        echo DNS1D::getBarcodeHTML("44455656", "EAN2");
//        echo DNS1D::getBarcodeHTML("4445656", "EAN5");
//        echo DNS1D::getBarcodeHTML("4445", "EAN8");
//        echo DNS1D::getBarcodeHTML("4445", "EAN13");
//        echo DNS1D::getBarcodeHTML("4445645656", "UPCA");
//        echo DNS1D::getBarcodeHTML("4445645656", "UPCE");
//        echo DNS1D::getBarcodeHTML("4445645656", "MSI");
//        echo DNS1D::getBarcodeHTML("4445645656", "MSI+");
//        echo DNS1D::getBarcodeHTML("4445645656", "POSTNET");
//        echo DNS1D::getBarcodeHTML("4445645656", "PLANET");
//        echo DNS1D::getBarcodeHTML("4445645656", "RMS4CC");
//        echo DNS1D::getBarcodeHTML("4445645656", "KIX");
//        echo DNS1D::getBarcodeHTML("4445645656", "IMB");
//        echo DNS1D::getBarcodeHTML("4445645656", "CODABAR");
//        echo DNS1D::getBarcodeHTML("4445645656", "CODE11");
//        echo DNS1D::getBarcodeHTML("4445645656", "PHARMA");
//        echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");

        $asn = Asn::findOrFail($id);
        $asnitems = Asnitem::where('asn_id', $id)->paginate(10);
        return view('purchase.asns.labelpreprint', compact('asn', 'asnitems', 'id'));
    }

    public function export(Request $request, $asn_id)
    {
        //
        $input = $request->all();
//        dd($input);

        Excel::load('exceltemplate/PACKING LIST.XLS', function ($reader) use ($asn_id) {
            $objExcel = $reader->getExcel();
            $sheet = $objExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $asn = Asn::find($asn_id);
            if (isset($asn))
            {
                $asnshipment = $asn->asnshipments->first();
                if ($asnshipment)
                {
                    $sheet->setCellValue('B4', $asnshipment->shipper_name);
                    $asnorder = $asnshipment->asnorders->first();
                    if (isset($asnorder))
                    {
                        $pohead = $asnorder->pohead;
                        if (isset($pohead))
                        {
                            $poheadc = $pohead->poheadc;
                            if (isset($poheadc))
                            {
                                $sheet->setCellValue('B15', $poheadc->ship_to);
                                $sheet->setCellValue('B16', $poheadc->ship_to_address1);
                                $sheet->setCellValue('B17', $poheadc->ship_to_address2);
                                $sheet->setCellValue('C25', $poheadc->purchase_order_number);
                            }
                            $sheet->setCellValue('B9', $pohead->number);
                        }

                        $asnpackagings = $asnorder->asnpackagings;
                        $rollcount = 0;
                        $grossweight_total = 0.0;
                        $netweight_total = 0.0;
                        $quantity_total = 0;
                        foreach ($asnpackagings as $asnpackaging)
                        {
                            $rollcount += $asnpackaging->asnitems->count();
                            foreach ($asnpackaging->asnitems as $asnitem)
                            {
                                $grossweight_total += $asnitem->poitemroll->gross_weight;
                                $netweight_total += $asnitem->poitemroll->net_weight;
                                $quantity_total += $asnitem->poitemroll->quantity_shipped;
                            }
                        }
                        $sheet->setCellValue('A25', $rollcount . 'ROLLS');
                        $sheet->setCellValue('E25', $netweight_total);
                        $sheet->setCellValue('F25', $quantity_total);
                        $sheet->setCellValue('G25', '@' . $grossweight_total / $quantity_total);
                        $sheet->setCellValue('H25', '@' . $netweight_total / $quantity_total);
                        $sheet->setCellValue('B27', $rollcount . 'ROLLS');
                        $sheet->setCellValue('F27', $quantity_total);
                        $sheet->setCellValue('G27', $grossweight_total . 'KGS');
                        $sheet->setCellValue('H27', $netweight_total . 'KGS');
                        $sheet->setCellValue('B29', 'TOTAL PACKED IN ' . $rollcount . ' ROLLS');
                        $sheet->setCellValue('B30', 'TOTAL QUANTITY: ' . $quantity_total . 'YDS');
                        $sheet->setCellValue('B31', 'TOTAL G.WT: ' . $grossweight_total . 'KGS');
                        $sheet->setCellValue('B32', 'TOTAL N.WT: ' . $netweight_total . 'KGS');
                    }
                    $sheet->setCellValue('G9', $asnshipment->ship_date);
                    $sheet->setCellValue('B18', $asnshipment->country_of_destination);
                }
            }

            $sheet = $objExcel->getSheet(1);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $asn = Asn::find($asn_id);
            if (isset($asn))
            {
                $asnshipment = $asn->asnshipments->first();
                if ($asnshipment)
                {
                    $asnorder = $asnshipment->asnorders->first();
                    if (isset($asnorder))
                    {
                        $pohead = $asnorder->pohead;
                        if (isset($pohead))
                        {
                            $poheadc = $pohead->poheadc;
                            if (isset($poheadc))
                            {
                            }
                        }

                        $asnpackagings = $asnorder->asnpackagings;
                        $rollcount = 0;
                        $grossweight_total = 0.0;
                        $netweight_total = 0.0;
                        $quantity_total = 0;
                        $item_row = 4;
                        foreach ($asnpackagings as $asnpackaging)
                        {
                            $rollcount += $asnpackaging->asnitems->count();
                            foreach ($asnpackaging->asnitems as $asnitem)
                            {
                                $sheet->setCellValue('B' . $item_row, '-' . $asnitem->poitemroll->roll_number);
                                $sheet->setCellValue('C' . $item_row, $asnpackaging->poitem->poitemc->material_code);
                                $sheet->setCellValue('D' . $item_row, $asnitem->poitemroll->quantity_shipped);
                                $sheet->setCellValue('E' . $item_row, $asnitem->poitemroll->net_weight);
                                $sheet->setCellValue('G' . $item_row, $asnitem->poitemroll->net_weight);
                                $grossweight_total += $asnitem->poitemroll->gross_weight;
                                $netweight_total += $asnitem->poitemroll->net_weight;
                                $quantity_total += $asnitem->poitemroll->quantity_shipped;
                                $item_row++;
                            }
                        }
                    }
                }
            }
        })->export('xlsx');

//        Excel::load('exceltemplate/DPL.XLS', function ($reader) use ($asn_id) {
//            $objExcel = $reader->getExcel();
//            $sheet = $objExcel->getSheet(0);
//            $highestRow = $sheet->getHighestRow();
//            $highestColumn = $sheet->getHighestColumn();
//
//            $asn = Asn::find($asn_id);
//            if (isset($asn))
//            {
//                $asnshipment = $asn->asnshipments->first();
//                if ($asnshipment)
//                {
//                    $asnorder = $asnshipment->asnorders->first();
//                    if (isset($asnorder))
//                    {
//                        $pohead = $asnorder->pohead;
//                        if (isset($pohead))
//                        {
//                            $poheadc = $pohead->poheadc;
//                            if (isset($poheadc))
//                            {
//                            }
//                        }
//
//                        $asnpackagings = $asnorder->asnpackagings;
//                        $rollcount = 0;
//                        $grossweight_total = 0.0;
//                        $netweight_total = 0.0;
//                        $quantity_total = 0;
//                        $item_row = 4;
//                        foreach ($asnpackagings as $asnpackaging)
//                        {
//                            $rollcount += $asnpackaging->asnitems->count();
//                            foreach ($asnpackaging->asnitems as $asnitem)
//                            {
//                                $sheet->setCellValue('B' . $item_row, '-' . $asnitem->poitemroll->roll_number);
//                                $sheet->setCellValue('C' . $item_row, $asnpackaging->poitem->poitemc->material_code);
//                                $sheet->setCellValue('D' . $item_row, $asnitem->poitemroll->quantity_shipped);
//                                $sheet->setCellValue('E' . $item_row, $asnitem->poitemroll->net_weight);
//                                $sheet->setCellValue('G' . $item_row, $asnitem->poitemroll->net_weight);
//                                $grossweight_total += $asnitem->poitemroll->gross_weight;
//                                $netweight_total += $asnitem->poitemroll->net_weight;
//                                $quantity_total += $asnitem->poitemroll->quantity_shipped;
//                                $item_row++;
//                            }
//                        }
//                    }
//                }
//            }
//
//        })->export('xlsx');



    }
}
