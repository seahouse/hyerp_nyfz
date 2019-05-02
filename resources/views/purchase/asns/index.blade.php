@extends('navbarerp')

@section('title', 'ASN')

@section('main')
    <div class="panel-heading">
        <a href="asns/create" class="btn btn-sm btn-success">新建</a>
    </div>

    @if ($asns->count())
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>编号</th>
                <th>传输控制号</th>
                <th>测试标记</th>
                <th>交易控制号</th>
                {{--<th>产品类型</th>--}}
                {{--<th>编织类型</th>--}}
                {{--<th>目的地</th>--}}
                {{--<th>供应商名称</th>--}}
                <th>创建时间</th>
                <th>明细</th>
                {{--<th>Shipment</th>--}}
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asns as $asn)
                <tr>
                    <td>
                        {{ $asn->asn_number }}
                    </td>
                    <td>
                        {{ $asn->interchange_control_number }}
                    </td>
                    <td>
                        {{ $asn->test_indicator }}
                    </td>
                    <td>
                        {{ $asn->transaction_set_control_no }}
                    </td>
                    {{--<td>--}}
                        {{--{{ $purchaseorder->product_type }}--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--{{ $purchaseorder->weave_type }}--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--{{ $purchaseorder->destination_country }}--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--{{ $purchaseorder->supplier_name }}--}}
                    {{--</td>--}}
                    <td>
                        {{ $asn->created_at }}
                    </td>
                    <td>
                        {{--{{ $asn->asnshipments->first() }}--}}
                        <a href="{{ URL::to('/purchase/asnshipments/' . $asn->asnshipments->first()->id . '/asnorders') }}" target="_blank">明细</a>
                    </td>
                    {{--<td>--}}
                        {{--<a href="{{ URL::to('/purchase/asns/' . $asn->id . '/asnshipments') }}" target="_blank">Shipment</a>--}}
                    {{--</td>--}}
                    <td>
                        <a href="{{ URL::to('/purchase/asns/'.$asn->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        <a href="{{ URL::to('/purchase/asns/'.$asn->id.'/export') }}" class="btn btn-success btn-sm pull-left">导出</a>
                        {!! Form::button('打印', ['class' => 'btn btn-success btn-sm pull-left', 'id' => 'btnPrint']) !!}
                        {!! Form::button('打印2', ['class' => 'btn btn-success btn-sm pull-left', 'id' => 'btnPrint2']) !!}
                        {!! Form::button('打印3', ['class' => 'btn btn-success btn-sm pull-left', 'id' => 'btnPrint3']) !!}
                        {{--<a href="{{ URL::to('/purchase/asns/'.$asn->id.'/labelpreprint') }}" class="btn btn-success btn-sm pull-left" target="_blank">标签预览</a>--}}
                        {!! Form::open(array('route' => array('asns.destroy', $asn->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                        {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $asns->render() !!}
    @else
    <div class="alert alert-warning alert-block">
        <i class="fa fa-warning"></i>
        {{'无记录', [], 'layouts'}}
    </div>
    @endif
@endsection

@section('script')
    <script type="text/javascript">
        jQuery(document).ready(function(e) {

            $("#btnPrint").click(function() {
                var objfs = new ActiveXObject("Scripting.FileSystemObject");
                var objprinter = objfs.createtextfile("LPT1:", true);
                objprinter.writeline("^XA");
                objprinter.writeline("^FO50,50");
                objprinter.writeline("^AON,36,20");
                objprinter.writeline("^FD12345678^FS");
                objprinter.writeline("^PQ1,0,1,Y");
                objprinter.writeline("^XZ");
                objprinter.writeline();
                objfs = null;

            });

            $("#btnPrint2").click(function() {
                var zpl = "${^XA\
                    ^FXTest ZPL^FS\
                ^FO50,100\
                ^A0N,89^FDHello ZPL^FS\
                ^XZ}$";
                var printWindow = window.open();
                printWindow.document.open('text/plain')
                printWindow.document.write(zpl);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            });

            $("#btnPrint3").click(function() {
                var zpl = "${^XA\
                    ^FXTest ZPL^FS\
                ^FO50,100\
                ^A0N,89^FDHello ZPL^FS\
                ^XZ}$";
                var printWindow = window.open();
                printWindow.document.open('text/plain');
                printWindow.document.write(zpl);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            });
        });
    </script>
@endsection