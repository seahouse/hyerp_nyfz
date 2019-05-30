@extends('navbarerp')

@section('main')
    <div class="panel-heading">
        <a href="{{ URL::to('inventory/warehouseoutitems/' . $id . '/create') }}" class="btn btn-sm btn-success">新建</a>
{{--        <div class="pull-right" style="padding-top: 4px;">
            <a href="{{ URL::to('purchase/vendtypes') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> {{'客户类型管理', [], 'layouts'}}</a>
        </div> --}}
    </div>
    

    @if ($warehouseoutitems->count())
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>物料代码</th>
                {{--<th>到期日</th>--}}
                <th>数量</th>
                <th>对应销售订单</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warehouseoutitems as $warehouseoutitem)
                <tr>
                    <td>
                        {{ $warehouseoutitem->material->name }}
                    </td>
                    {{--<td>--}}
                        {{--{{ $poitem->duedate }}--}}
                    {{--</td>--}}
                    <td>
                        {{ $warehouseoutitem->quantity }}
                    </td>
                    <td>
                        @if(isset($warehouseoutitem->sohead->number)) {{ $warehouseoutitem->sohead->number }} @else - @endif
                    </td>
                    <td>
                        {{ $warehouseoutitem->remark }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/inventory/warehouseoutitems/'.$warehouseoutitem->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        {!! Form::open(array('route' => array('warehouseoutitems.destroy', $warehouseoutitem->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                            {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $warehouseoutitems->render() !!}
    @else
    <div class="alert alert-warning alert-block">
        <i class="fa fa-warning"></i>
        {{'无记录', [], 'layouts'}}
    </div>
    @endif    


@stop
