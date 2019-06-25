@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($payment, ['method' => 'PATCH', 'action' => ['Finance\PaymentController@update', $payment->id], 'class' => 'form-horizontal']) !!}
        @include('finance.payments._form',
            [
                'submitButtonText' => '保存',
                'attr' => '',
                'btnclass' => 'btn btn-primary',
            ])
    {!! Form::close() !!}
    
    @include('errors.list')

@endsection

@section('script')
    {{--@component('purchase.purchaseorders._selectpoheadjs')--}}
        {{--$("#pohead_name").val(field.name);--}}
        {{--$("#pohead_id").val(field.id);--}}
    {{--@endcomponent--}}


@endsection
