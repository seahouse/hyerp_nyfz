@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($sohead, ['method' => 'PATCH', 'action' => ['Sales\CustinfoController@update', $custinfo->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        @include('sales.custinfos._form', ['submitButtonText' => '保存'])
    {!! Form::close() !!}
    
    @include('errors.list')
@stop

