@extends('navbarerp')

@section('title', 'ASN')

@section('main')
    <div class="panel-heading">
        <a href="shipments/create" class="btn btn-sm btn-success">新建(New)</a>
        <a href="shipments/import" class="btn btn-sm btn-success">导入(Import)</a>
    </div>

    <div class="panel-body">
        {{--{!! Form::open(['url' => '/shipment/shipments/export', 'class' => 'pull-right']) !!}--}}
            {{--{!! Form::submit('Export', ['class' => 'btn btn-default btn-sm']) !!}--}}
        {{--{!! Form::close() !!}--}}

        {!! Form::open(['url' => '/shipment/shipments/search', 'class' => 'pull-right form-inline', 'id' => 'frmSearch']) !!}
        <div class="form-group-sm">
            {!! Form::label('createdatestartlabel', 'Create Date:', ['class' => 'control-label']) !!}
            {!! Form::date('createdatestart', null, ['class' => 'form-control']) !!}
            {!! Form::label('createdatelabelto', '-', ['class' => 'control-label']) !!}
            {!! Form::date('createdateend', null, ['class' => 'form-control']) !!}

            {!! Form::label('etdstartlabel', 'ETD:', ['class' => 'control-label']) !!}
            {!! Form::date('etdstart', null, ['class' => 'form-control']) !!}
            {!! Form::label('etdlabelto', '-', ['class' => 'control-label']) !!}
            {!! Form::date('etdend', null, ['class' => 'form-control']) !!}

            {!! Form::label('amount_for_customer', 'Amount for Customer:', ['class' => 'control-label']) !!}
            {!! Form::select('amount_for_customer_opt', ['>=' => '>=', '<=' => '<=', '=' => '='], null, ['class' => 'form-control']) !!}
            {!! Form::text('amount_for_customer', null, ['class' => 'form-control', 'placeholder' => 'Amount for Customer']) !!}

            {{--{!! Form::select('paymentstatus', ['0' => '已付款', '-1' => '未付款'], null, ['class' => 'form-control', 'placeholder' => '--付款状态--']); !!}--}}
            {{--{!! Form::select('approvalstatus', ['1' => '审批中', '0' => '已通过', '-2' => '未通过'], null, ['class' => 'form-control', 'placeholder' => '--审批状态--']); !!}--}}
            {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => 'Invoice No.,Contact No.,Customer']) !!}
            {!! Form::submit('Search', ['class' => 'btn btn-default btn-sm']) !!}
            {!! Form::button('Export', ['class' => 'btn btn-default btn-sm', 'id' => 'btnExport']) !!}
            {!! Form::button('Export PVH', ['class' => 'btn btn-default btn-sm', 'id' => 'btnExportPVH']) !!}
        </div>
        {!! Form::close() !!}

        @if ($shipments->count())
            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>Dept</th>
                    <th>Customer</th>
                    <th>Invoice No.</th>
                    <th>Contact No.</th>
                    {{--<th>产品类型</th>--}}
                    {{--<th>编织类型</th>--}}
                    {{--<th>目的地</th>--}}
                    {{--<th>供应商名称</th>--}}
                    <th>Create Time</th>
                    <th>Detail</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shipments as $shipment)
                    <tr>
                        <td>
                            {{ $shipment->dept }}
                        </td>
                        <td>
                            {{ $shipment->customer_name }}
                        </td>
                        <td>
                            {{ $shipment->invoice_number }}
                        </td>
                        <td title="@if (isset($shipment->contract_number)) {{ $shipment->contract_number }} @else @endif">
                            {{ str_limit($shipment->contract_number, 60) }}
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
                            {{ $shipment->created_at }}
                        </td>
                        <td>
                            <a href="{{ URL::to('/shipment/shipments/' . $shipment->id . '/shipmentitems') }}" target="_blank">Detail</a>
                        </td>
                        <td>
                            <a href="{{ URL::to('/shipment/shipments/'.$shipment->id.'/edit') }}" class="btn btn-success btn-sm pull-left">Edit</a>
                            {{--<a href="{{ URL::to('/shipment/shipments/'.$shipment->id.'/export') }}" class="btn btn-success btn-sm pull-left">导出</a>--}}
                            {!! Form::open(array('route' => array('shipments.destroy', $shipment->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录(Delete this record)?");')) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            {{--{!! $shipments->render() !!}--}}
            {!! $shipments->setPath('/shipment/shipments')->appends([
                'createdatestart' => isset($inputs['createdatestart']) ? $inputs['createdatestart'] : null,
                'createdateend' => isset($inputs['createdateend']) ? $inputs['createdateend'] : null,
                'etdstart' => isset($inputs['etdstart']) ? $inputs['etdstart'] : null,
                'etdend' => isset($inputs['etdend']) ? $inputs['etdend'] : null,
                'amount_for_customer_opt' => isset($inputs['amount_for_customer_opt']) ? $inputs['amount_for_customer_opt'] : null,
                'amount_for_customer' => isset($inputs['amount_for_customer']) ? $inputs['amount_for_customer'] : null,
                'key' => isset($inputs['key']) ? $inputs['key'] : null,
            ])->links() !!}
        @else
            <div class="alert alert-warning alert-block">
                <i class="fa fa-warning"></i>
                {{'无记录(No Record)', [], 'layouts'}}
            </div>
        @endif
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        jQuery(document).ready(function(e) {
            $("#btnExport").click(function() {
                $.ajax({
                    type: "POST",
                    url: "{{ url('shipment/shipments/export') }}",
                    data: $("form#frmSearch").serialize(),
//                    dataType: "json",
                    error:function(xhr, ajaxOptions, thrownError){
                        alert('error');
                    },
                    success:function(result){
                        location.href = result;
//                        alert("导出成功.");
                    },
                });
            });

            $("#btnExportPVH").click(function() {
                $.ajax({
                    type: "POST",
                    url: "{{ url('shipment/shipments/exportpvh') }}",
                    data: $("form#frmSearch").serialize(),
//                    dataType: "json",
                    error:function(xhr, ajaxOptions, thrownError){
                        alert('error');
                    },
                    success:function(result){
//                        alert(result);
                        location.href = result;
//                        alert("导出成功.");
                    },
                });
            });
        });
    </script>
@endsection
