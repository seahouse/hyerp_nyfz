@extends('navbarerp')

@section('main')
    <h1>添加付款信息</h1>
    <hr/>


    {!! Form::open(['url' => 'finance/payments', 'class' => 'form-horizontal']) !!}

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
             {!! Form::label('amount', '付款金额:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
             <div class='col-xs-8 col-sm-10'>
                 {!! Form::text('amount', null, ['class' => 'form-control', '']) !!}
             </div>
         </div>

        <div class="form-group">
            {!! Form::label('paydate', '付款日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
            <div class='col-xs-8 col-sm-10'>
                {!! Form::date('paydate', null, ['class' => 'form-control', '']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('paymethod', '付款方式:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
            <div class='col-xs-8 col-sm-10'>
                {!! Form::select('paymethod', array('电汇'=>'电汇', '汇票'=>'汇票', '本票'=>'本票','支票'=>'支票','现金'=>'现金',), null, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}
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

        {!! Form::hidden('pohead_id', $pohead_id) !!}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('添加', ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
            </div>
        </div>

    {!! Form::close() !!}


    @include('errors.list')
@stop

