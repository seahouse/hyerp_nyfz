@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($warehouseouthead, ['method' => 'PATCH', 'action' => ['Inventory\WarehouseoutheadController@update', $warehouseouthead->id], 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseoutheads._form',
            [
                'submitButtonText' => '保存',
                'attr' => '',
                'btnclass' => 'btn btn-primary',
            ])
    {!! Form::close() !!}
    
    @include('errors.list')


@endsection


