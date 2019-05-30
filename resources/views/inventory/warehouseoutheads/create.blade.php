@extends('navbarerp')

@section('main')
    <h1>添加出库单</h1>
    <hr/>
    
    {!! Form::open(['url' => 'inventory/warehouseoutheads', 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseoutheads._form',
            [
                'submitButtonText' => '添加',
                'attr'  => '',
            ])
    {!! Form::close() !!}
    

    @include('errors.list')
    
@stop
