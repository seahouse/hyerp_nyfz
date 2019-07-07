@extends('navbarerp')

@section('title', '采购订单')

@section('main')
    @can('purchase_pohead_view')
    <div class="panel-heading">
        <a href="purchaseorders/create" class="btn btn-sm btn-success">新建</a>
{{--        <div class="pull-right" style="padding-top: 4px;">
            <a href="{{ URL::to('purchase/vendtypes') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> {{'客户类型管理', [], 'layouts'}}</a>
        </div> --}}
    </div>
    

    @if ($purchaseorders->count())
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>编号</th>
                <th>采购订单名称</th>
                <th>供应商</th>
                <th>对应销售订单</th>
                <th>订单金额</th>
                <th>物料</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseorders as $purchaseorder)
                <tr>
                    <td>
                        {{ $purchaseorder->number }}
                    </td>
                    <td>
                        {{ $purchaseorder->descrip }}
                    </td>
                    <td>
                        {{ $purchaseorder->vendor->name }}
                    </td>
                    <td>
                        @if(isset($purchaseorder->soheads->first()->name)) {{ $purchaseorder->soheads->first()->name }} @else - @endif
                    </td>
                    <td>
                        {{ $purchaseorder->total_amount }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/purchase/purchaseorders/' . $purchaseorder->id . '/detail') }}" target="_blank">明细</a>
                    </td>
                    <td>
                        <a href="{{ URL::to('/purchase/purchaseorders/'.$purchaseorder->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>

                        {{--<a href="{{ URL::to('/purchase/purchaseorders/' . $purchaseorder->id . '/packing') }}" class="btn btn-success btn-sm pull-left" target="_blank">打包</a>--}}
                        {{--<a href="{{ URL::to('/purchase/purchaseorders/' . $purchaseorder->id . '/payments') }}" target="_blank" class="btn btn-success btn-sm pull-left">付款</a>--}}
                        {!! Form::open(array('route' => array('purchaseorders.destroy', $purchaseorder->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                        {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm pull-left']) !!}
                        {!! Form::close() !!}
                        <a href="{{ URL::to('/purchase/purchaseorders/'.$purchaseorder->id.'/createpayment') }}" class="btn btn-success btn-sm pull-left">付款</a>
                        <a href="{{ URL::to('/purchase/purchaseorders/'.$purchaseorder->id.'/indexpayment') }}" class="btn btn-success btn-sm pull-left">付款明细</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $purchaseorders->render() !!}
    @else
    <div class="alert alert-warning alert-block">
        <i class="fa fa-warning"></i>
        {{'无记录', [], 'layouts'}}
    </div>
    @endif

    @else
        无权限。
    @endcan

@stop
