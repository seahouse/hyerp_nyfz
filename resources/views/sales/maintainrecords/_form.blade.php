<div class="form-group">
    {!! Form::label('seq', '序号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('seq', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('raisedate', '提出日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('raisedate', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('descrip', '问题描述:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('descrip', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('handler', '处理人员:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('handler', null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('customer_name', '客户:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}--}}
    {{--<div class='col-xs-8 col-sm-10'>--}}
        {{--@if (isset($sohead->customer->name))--}}
            {{--{!! Form::text('customer_name', $sohead->customer->name, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectCustomerModal', 'id' => 'customer_name']) !!}--}}
        {{--@else--}}
            {{--{!! Form::text('customer_name', null, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectCustomerModal', 'id' => 'customer_name']) !!}--}}
        {{--@endif--}}
        {{--{!! Form::hidden('customer_id', null, ['id' => 'customer_id']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    {!! Form::label('handlerdate', '处理日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('handlerdate', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('handlemethod', '处理方案:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::textarea('handlemethod', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('result', '处理结果:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('result', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('remark', '备注:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
</div>

{!! Form::hidden('sohead_id', $sohead_id, ['class' => 'form-control']) !!}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
    </div>
</div>

