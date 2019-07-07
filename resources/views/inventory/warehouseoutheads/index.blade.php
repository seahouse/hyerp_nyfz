@extends('navbarerp')

@section('title', '出库单')

@section('main')
    @can('inventory_warehouse_view')
    <div class="panel-heading">
        <a href="warehouseoutheads/create" class="btn btn-sm btn-success">新建</a>
{{--        <div class="pull-right" style="padding-top: 4px;">
            <a href="{{ URL::to('purchase/vendtypes') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> {{'客户类型管理', [], 'layouts'}}</a>
        </div> --}}
    </div>
    

    @if ($warehouseoutheads->count())
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>编号</th>
                <th>出库日期</th>
                <th>对应仓库</th>
                <th>备注</th>
                <th>物料</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warehouseoutheads as $warehouseouthead)
                <tr>
                    <td>
                        {{ $warehouseouthead->number }}
                    </td>
                    <td>
                        {{ $warehouseouthead->date }}
                    </td>
                    <td>
                        @if(isset($warehouseouthead->warehouse->name)) {{ $warehouseouthead->warehouse->name }} @else - @endif
                    </td>
                    <td>
                        {{ $warehouseouthead->remark }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/inventory/warehouseoutheads/' . $warehouseouthead->id . '/detail') }}" target="_blank">明细</a>
                    </td>
                    <td>
                        <a href="{{ URL::to('/inventory/warehouseoutheads/'.$warehouseouthead->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        {!! Form::open(array('route' => array('warehouseoutheads.destroy', $warehouseouthead->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                            {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $warehouseoutheads->render() !!}
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
