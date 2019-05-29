@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($warehouseinitem, ['method' => 'PATCH', 'action' => ['Inventory\WarehouseinitemController@update', $warehouseinitem->id], 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseinitems._form',
            [
                'submitButtonText' => '保存',
                'attr' => '',
                'btnclass' => 'btn btn-primary',
            ])
    {!! Form::close() !!}
    
    @include('errors.list')
@stop

