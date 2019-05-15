@extends('navbarerp')

@section('title', 'ASN')

@section('main')
    <div class="panel-heading">
        <a href="material_cats/create" class="btn btn-sm btn-success">新建</a>

    </div>

    <div class="panel-body">
    @if ($material_cats->count())
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>编号</th>
                <th>名称</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($material_cats as $material_cat)
                <tr>
                    <td>
                        {{ $material_cat->number }}
                    </td>
                    <td>
                        {{ $material_cat->name }}
                    </td>
                    <td>
                        {{ $material_cat->note }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/basic/material_cats/'.$material_cat->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        {!! Form::open(array('route' => array('material_cats.destroy', $material_cat->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                            {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $material_cats->render() !!}
    @else
    <div class="alert alert-warning alert-block">
        <i class="fa fa-warning"></i>
        {{'无记录', [], 'layouts'}}
    </div>
    @endif
    </div>
@endsection
