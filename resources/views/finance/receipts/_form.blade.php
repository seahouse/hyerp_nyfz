

<div class="form-group">
    {!! Form::label('amount', '收款金额:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('amount', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('receivedate', '收款日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('receivedate', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('paymethod', '收款方式:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($receipt) && isset($receipt->paymethod))
            {!! Form::select('paymethod', array('电汇'=>'电汇', '汇票'=>'汇票', '本票'=>'本票','支票'=>'支票','现金'=>'现金',), $receipt->paymethod, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}
            {{--            {!! Form::select('paymethod', $paymethod_List, $payment->paymethod, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}--}}
        @else
            {!! Form::select('paymethod', array('电汇'=>'电汇', '汇票'=>'汇票', '本票'=>'本票','支票'=>'支票','现金'=>'现金',), null, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}
        @endif
        {{--{!! Form::hidden('paymethod', null, ['id' => 'id']) !!}--}}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', '经办人:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($receipt) && isset($receipt->operator_id))
            {!! Form::select('operator_id', $user_List, $receipt->operator_id, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}

        @else
            {!! Form::select('operator_id', $user_List, null, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('remark', '备注:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('remark', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
    </div>
</div>

