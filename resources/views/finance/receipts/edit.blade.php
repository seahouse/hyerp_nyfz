@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($receipt, ['method' => 'PATCH', 'action' => ['Finance\ReceiptController@update', $receipt->id], 'class' => 'form-horizontal']) !!}
        @include('finance.receipts._form',
            [
                'submitButtonText' => '保存',
                'attr' => '',
                'btnclass' => 'btn btn-primary',
            ])
    {!! Form::close() !!}
    
    @include('errors.list')


@endsection
