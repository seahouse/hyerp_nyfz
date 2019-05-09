@extends('navbarerp')

@section('main')
    <h1>添加采购订单</h1>
    <hr/>
    
    {!! Form::open(['url' => 'purchase/purchaseorders', 'class' => 'form-horizontal']) !!}
        @include('purchase.purchaseorders._form',
            [
                'submitButtonText' => '添加',
                'attr'  => '',
            ])
    {!! Form::close() !!}
    

    @include('errors.list')
    @include('purchase.vendors._selectvendormodal')
@stop

@section('script')
    @include('purchase.vendors._selectvendorjs')
@endsection