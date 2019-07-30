@extends('navbarerp')

@section('main')
    @can('sales_sohead_view')
        {!! Form::model($sohead, ['class' => 'form-horizontal', 'files' => true]) !!}
        @include('sales.soheads._form', ['readonly' => 'readonly', 'btnclass' => 'hidden', 'submitButtonText' => '保存'])
        {!! Form::close() !!}
    @else
        无权限。
    @endcan
@endsection
