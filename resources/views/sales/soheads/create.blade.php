@extends('navbarerp')

@section('main')
    <h1>添加销售订单</h1>
    <hr/>
    
    {!! Form::open(['url' => 'sales/soheads', 'class' => 'form-horizontal']) !!}
        @include('sales.soheads._form', ['submitButtonText' => '添加'])
    {!! Form::close() !!}

    
    @include('errors.list')
@stop
