@extends('navbarerp')

@section('main')
    <h1>添加收款信息</h1>
    <hr/>

    {!! Form::open(['url' => 'finance/receipts', 'class' => 'form-horizontal']) !!}
    @include('finance.receipts._form',
        [
            'submitButtonText' => '添加',
            'attr'  => '',
        ])
    {!! Form::close() !!}


    @include('errors.list')
    @include('sales.soheads._selectsalesordermodal')
@stop

@section('script')
    @component('sales.soheads._selectsalesorderjs')
        $("#sohead_name").val(field.name);
        $("#sohead_id").val(field.id);
    @endcomponent

@endsection