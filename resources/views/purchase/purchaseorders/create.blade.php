@extends('navbarerp')

@section('main')
    <h1>添加采购订单</h1>
    <hr/>

    @can('purchase_pohead_edit')
    {!! Form::open(['url' => 'purchase/purchaseorders', 'class' => 'form-horizontal']) !!}
        @include('purchase.purchaseorders._form',
            [
                'submitButtonText' => '添加',
                'attr'  => '',
                'btnclass' => 'btn btn-primary',
            ])
    {!! Form::close() !!}
    @else
        无权限。
    @endcan

    @include('errors.list')
    @include('sales.soheads._selectsalesordermodal')
    @include('purchase.vendors._selectvendormodal')
@stop

@section('script')
    @component('sales.soheads._selectsalesorderjs')
        $("#sohead_name").val(field.name);
        $("#sohead_id").val(field.id);
    @endcomponent

    @include('purchase.vendors._selectvendorjs')
@endsection