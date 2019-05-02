<div class="form-group">
    {!! Form::label('number', '编号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('descrip', '描述:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('descrip', null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('customer_id', '客户:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}--}}
    {{--<div class='col-xs-8 col-sm-10'>--}}
        {{--{!! Form::text('customer_id', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}


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

