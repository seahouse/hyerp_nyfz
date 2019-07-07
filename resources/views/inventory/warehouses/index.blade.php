@extends('navbarerp')

@section('title', 'ASN')

@section('main')
    @can('inventory_warehouse_view')
    <div class="panel-heading">
        <a href="warehouses/create" class="btn btn-sm btn-success">新建</a>
    </div>

    <div class="panel-body">
    @if ($warehouses->count())
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>名称</th>
                <th>地址</th>
                <th>保管员</th>
                <th>联系电话</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warehouses as $warehouse)
                <tr>
                    <td>
                        {{ $warehouse->name }}
                    </td>
                    <td>
                        {{ $warehouse->address }}
                    </td>
                    <td>
                        {{ $warehouse->contact_name }}
                    </td>
                    <td>
                        {{ $warehouse->contact_phone }}
                    </td>
                    <td>
                        {{ $warehouse->note }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/inventory/warehouses/'.$warehouse->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        {!! Form::open(array('route' => array('warehouses.destroy', $warehouse->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                            {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $warehouses->render() !!}
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
