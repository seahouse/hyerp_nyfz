@extends('navbarerp')

@section('main')
    <h1>添加收款信息</h1>
    <hr/>


    {!! Form::open(['url' => 'finance/receipts', 'class' => 'form-horizontal']) !!}

         {{--<div class="form-horizontal">--}}
            {{--{!! Form::label('sohead_number', '对应销售订单:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}--}}
            {{--<div class='col-xs-8 col-sm-10'>--}}
                {{--@if (isset($receipt) && isset($receipt->sohead->number))--}}
                    {{--{!! Form::text('sohead_number', $receipt ->sohead->number, ['class' => 'form-control', '', 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal', 'id' => 'sohead_number']) !!}--}}
                {{--@else--}}
                    {{--{!! Form::text('sohead_number', null, ['class' => 'form-control', '', 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal',  'id' => 'sohead_number']) !!}--}}
                {{--@endif--}}
                {{--{!! Form::hidden('sohead_id', null, ['id' => 'sohead_id']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            {!! Form::label('amount', '收款金额:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
            <div class='col-xs-8 col-sm-10'>
                {!! Form::text('amount', null, ['class' => 'form-control', '']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('receivedate', '收款日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
            <div class='col-xs-8 col-sm-10'>
                {!! Form::date('receivedate', null, ['class' => 'form-control', '']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('paymethod', '收款方式:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
            <div class='col-xs-8 col-sm-10'>
                {!! Form::select('paymethod', $paymethod_List, null, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('name', '经办人:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
            <div class='col-xs-8 col-sm-10'>
                {!! Form::select('operator_id', $user_List, null, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('remark', '备注:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
            <div class='col-xs-8 col-sm-10'>
                {!! Form::text('remark', null, ['class' => 'form-control', '']) !!}
            </div>
        </div>

        {!! Form::hidden('sohead_id', $sohead_id) !!}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('添加', ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
            </div>
        </div>

    {!! Form::close() !!}


    @include('errors.list')
@stop

