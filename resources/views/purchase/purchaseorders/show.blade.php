@extends('navbarerp')

@section('main')
    @can('purchase_pohead_view')
        {!! Form::model($purchaseorder, ['class' => 'form-horizontal', 'files' => true]) !!}
        @include('purchase.purchaseorders._form', ['attr' => 'readonly', 'btnclass' => 'hidden', 'submitButtonText' => '保存'])
        {!! Form::close() !!}
    @else
        无权限。
    @endcan
@endsection
