@extends('navbarerp')

@section('main')
    <h1>编辑(Edit)</h1>
    <hr/>
    
    {!! Form::model($shipment, ['method' => 'PATCH', 'action' => ['Shipment\ShipmentController@update', $shipment->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        @include('shipment.shipments._form', ['submitButtonText' => '保存(Save)'])
    {!! Form::close() !!}
    
    @include('errors.list')
@stop

