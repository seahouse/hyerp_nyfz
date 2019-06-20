@extends('navbarerp')

@section('main')
    <h1>添加付款信息</h1>
    <hr/>
    
    {!! Form::open(['url' => 'finance/payments', 'class' => 'form-horizontal']) !!}
        @include('finance.payments._form',
            [
                'submitButtonText' => '添加',
                'attr'  => '',
            ])
    {!! Form::close() !!}
    

    @include('errors.list')
    @include('purchase.purchaseorders._selectpoheadmodal')
@stop

@section('script')
    @component('purchase.purchaseorders._selectpoheadjs')
        $("#pohead_name").val(field.name);
        $("#pohead_id").val(field.id);
    @endcomponent


@endsection