<div class="form-group">
    {!! Form::label('number', '编号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', '客户名:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group">--}}
{{--{!! Form::label('customer_id', '客户:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}--}}
{{--<div class='col-xs-8 col-sm-10'>--}}
{{--{!! Form::text('customer_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}
{{--</div>--}}


<div class="form-group">
    {!! Form::label('contact_name', '联系人:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('contact_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('comments', '备注:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('comments', null, ['class' => 'form-control']) !!}
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

