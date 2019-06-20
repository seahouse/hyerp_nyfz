<div class="form-group">
    {!! Form::label('pohead_number', '对应采购订单:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($payment) && isset($payment->pohead->number))
            {!! Form::text('pohead_number', $payment ->pohead->number, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectPurchaseorderModal', 'id' => 'pohead_number']) !!}
        @else
            {!! Form::text('pohead_number', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectPurchaseorderModal',  'id' => 'pohead_number']) !!}
        @endif
        {!! Form::hidden('pohead_id', null, ['id' => 'pohead_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('amount', '付款金额:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::decimal('amount', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('paydate', '付款日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('paydate', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('payment', '支付方式:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('payment', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', '经办人:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($payment) && isset($payment->user->name))
            {!! Form::text('$payment->user->name', null, ['class' => 'form-control', $attr]) !!}
        @else
            {!! Form::text('unknown', null, ['class' => 'form-control', $attr]) !!}
        @endif
        {!! Form::hidden('operator_id', null, ['id' => 'operator_id']) !!}
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

