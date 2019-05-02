@extends('navbarerp')

@section('main')
    <h1>添加Asnpackaging</h1>
    <hr/>

    {!! Form::open(['url' => 'purchase/asnpackagings', 'class' => 'form-horizontal']) !!}
    @include('purchase.asnpackagings._form', ['submitButtonText' => '添加'])
    {!! Form::close() !!}

    @include('errors.list')

    @include('purchase.poitems._selectpoitemmodal')
@endsection

@section('script')
    @include('purchase.poitems._selectpoitemjs')
@endsection
