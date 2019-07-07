@extends('navbarerp')

@section('title', 'ASN')

@section('main')
    @can('sales_sohead_view')
    <div class="panel-heading">
        <a href="soheads/create" class="btn btn-sm btn-success">新建</a>
        {{--<a href="shipments/import" class="btn btn-sm btn-success">导入(Import)</a>--}}
    </div>

    <div class="panel-body">
        {{--{!! Form::open(['url' => '/shipment/shipments/export', 'class' => 'pull-right']) !!}--}}
            {{--{!! Form::submit('Export', ['class' => 'btn btn-default btn-sm']) !!}--}}
        {{--{!! Form::close() !!}--}}

        {{--{!! Form::open(['url' => '/shipment/shipments/search', 'class' => 'pull-right form-inline', 'id' => 'frmSearch']) !!}--}}
        {{--<div class="form-group-sm">--}}
            {{--{!! Form::label('createdatestartlabel', 'Create Date:', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::date('createdatestart', null, ['class' => 'form-control']) !!}--}}
            {{--{!! Form::label('createdatelabelto', '-', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::date('createdateend', null, ['class' => 'form-control']) !!}--}}

            {{--{!! Form::label('etdstartlabel', 'ETD:', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::date('etdstart', null, ['class' => 'form-control']) !!}--}}
            {{--{!! Form::label('etdlabelto', '-', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::date('etdend', null, ['class' => 'form-control']) !!}--}}

            {{--{!! Form::label('amount_for_customer', 'Amount for Customer:', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::select('amount_for_customer_opt', ['>=' => '>=', '<=' => '<=', '=' => '='], null, ['class' => 'form-control']) !!}--}}
            {{--{!! Form::text('amount_for_customer', null, ['class' => 'form-control', 'placeholder' => 'Amount for Customer']) !!}--}}

            {{--{!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => 'Invoice No.,Contact No.,Customer']) !!}--}}
            {{--{!! Form::submit('Search', ['class' => 'btn btn-default btn-sm']) !!}--}}
            {{--{!! Form::button('Export', ['class' => 'btn btn-default btn-sm', 'id' => 'btnExport']) !!}--}}
            {{--{!! Form::button('Export PVH', ['class' => 'btn btn-default btn-sm', 'id' => 'btnExportPVH']) !!}--}}
        {{--</div>--}}
        {{--{!! Form::close() !!}--}}

        @if ($soheads->count())
            <table class="table table-striped table-hover table-condensed ">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>客户名称</th>
                    <th>订单日期</th>
                    <th>销售金额</th>
                    <th>到期日期</th>
                    <th>创建时间</th>
                    {{--<th>Detail</th>--}}
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($soheads as $sohead)
                    <tr>
                        <td>
                            {{ $sohead->number }}
                        </td>
                        <td>
                            @if (isset($sohead->customer->name)) {{ $sohead->customer->name }}  @endif
                        </td>
                        <td>
                            @if (isset($sohead->orderdate)) {{ $sohead->orderdate }} @else @endif
                        </td>
                        <td>
                            @if (isset($sohead->total_amount)) {{ $sohead->total_amount }} @else @endif
                        </td>
                        <td>
                            @if (isset($sohead->duedate)) {{ $sohead->duedate }} @else @endif
                        </td>
                        <td>
                            {{ $sohead->created_at }}
                        </td>
                        {{--<td>--}}
                            {{--<a href="{{ URL::to('/shipment/shipments/' . $sohead->id . '/shipmentitems') }}" target="_blank">Detail</a>--}}
                        {{--</td>--}}
                        <td>
                            <a href="{{ URL::to('/sales/soheads/'.$sohead->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                            {{--<a href="{{ URL::to('/shipment/shipments/'.$sohead->id.'/export') }}" class="btn btn-success btn-sm pull-left">导出</a>--}}
                            {!! Form::open(array('route' => array('soheads.destroy', $sohead->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                            {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm pull-left']) !!}
                            {!! Form::close() !!}
                            <a href="{{ URL::to('/sales/soheads/'.$sohead->id.'/createreceipt') }}" class="btn btn-success btn-sm pull-left">收款</a>
                            <a href="{{ URL::to('/sales/soheads/'.$sohead->id.'/indexreceipt') }}" class="btn btn-success btn-sm pull-left">收款明细</a>
                        </td >
                    </tr>
                @endforeach
                </tbody>

            </table>
            {{--{!! $soheads->render() !!}--}}
            {!! $soheads->setPath('/shipment/shipments')->appends([
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
                {{'无记录', [], 'layouts'}}
            </div>
        @endif
    </div>
    @else
        无权限。
    @endcan
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
