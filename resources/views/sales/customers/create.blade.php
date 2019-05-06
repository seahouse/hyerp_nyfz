@extends('navbarerp')

@section('main')
    <h1>添加客户信息</h1>
    <hr/>

    {!! Form::open(['url' => 'sales/customers', 'class' => 'form-horizontal']) !!}
    @include('sales.customers._form', ['submitButtonText' => '添加'])
    {!! Form::close() !!}


    @include('errors.list')
@stop
