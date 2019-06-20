<div class="form-group">
    {!! Form::label('sohead_number', '对应销售订单:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($receipt) && isset($receipt->sohead->number))
            {!! Form::text('sohead_number', $receipt ->sohead->number, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal', 'id' => 'sohead_number']) !!}
        @else
            {!! Form::text('sohead_number', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal',  'id' => 'sohead_number']) !!}
        @endif
        {!! Form::hidden('sohead_id', null, ['id' => 'sohead_id']) !!}
    </div>
</div>

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
        {!! Form::date('paymethod', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', '经办人:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($receipt) && isset($receipt->user->name))
            {!! Form::text('$receipt->user->name', null, ['class' => 'form-control', $attr]) !!}
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

