<div class="form-group">
    {!! Form::label('number', '编号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', '订单名称:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('customer_name', '客户:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($sohead->customer->name))
            {!! Form::text('customer_name', $sohead->customer->name, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectCustomerModal', 'id' => 'customer_name']) !!}
        @else
            {!! Form::text('customer_name', null, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectCustomerModal', 'id' => 'customer_name']) !!}
        @endif
        {!! Form::hidden('customer_id', null, ['id' => 'customer_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('total_amount', '订单金额:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('total_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('duedate', '到期日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('duedate', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('orderdate', '订单日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('orderdate', null, ['class' => 'form-control']) !!}
    </div>
</div>


{{--<div class="form-group">--}}
    {{--{!! Form::label('salesmanager_id', '销售经理:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}--}}
    {{--<div class='col-xs-8 col-sm-10'>--}}
        {{--{!! Form::text('salesmanager_id', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
    </div>
</div>

