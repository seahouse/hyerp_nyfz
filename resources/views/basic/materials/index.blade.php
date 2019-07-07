@extends('navbarerp')

@section('title', 'ASN')

@section('main')
    @can('basic_metrial_view')
    <div class="panel-heading">
        <a href="materials/create" class="btn btn-sm btn-success">新建</a>

    </div>

    <div class="panel-body">
    @if ($materials->count())
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th>编号</th>
                <th>名称</th>
                <th>物料类别名称</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>
                        {{ $material->number }}
                    </td>
                    <td>
                        {{ $material->name }}

                    </td>
                    <td>
                        {{ $material->material_cat->name }}
                    </td>
                    <td>
                        {{ $material->note }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/basic/materials/'.$material->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        {!! Form::open(array('route' => array('materials.destroy', $material->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                            {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $materials->render() !!}
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
