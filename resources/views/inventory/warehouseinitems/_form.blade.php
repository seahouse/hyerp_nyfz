<div class="form-group">
    {!! Form::label('material_name', '物料名称:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($warehouseinitem->material->name))
            {!! Form::text('material_name', $warehouseinitem->material->name, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectMaterialModal', 'id' => 'material_name']) !!}
        @else
            {!! Form::text('material_name', null, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectMaterialModal', 'id' => 'material_name']) !!}
        @endif
        {!! Form::hidden('material_id', null, ['id' => 'material_id']) !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('duedate', '到期日:') !!}--}}
    {{--{!! Form::input('date', 'duedate', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<div class="form-group">
    {!! Form::label('quantity', '数量:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('quantity', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('unitprice', '单价:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('unitprice', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('amount', '总价:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('amount', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('taxrate', '税率:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('taxrate', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('remark', '备注:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('remark', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('freight', '运费:') !!}--}}
    {{--{!! Form::text('freight', '0.0', ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{!! Form::hidden('warehouseinhead_id', $warehouseinhead_id, ['class' => 'form-control']) !!}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
    </div>
</div>

