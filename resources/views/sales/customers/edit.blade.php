@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($customer, ['method' => 'PATCH', 'action' => ['Sales\CustomerController@update', $customer->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        @include('sales.customers._form', ['submitButtonText' => '保存'])
    {!! Form::close() !!}
    
    @include('errors.list')
@stop

