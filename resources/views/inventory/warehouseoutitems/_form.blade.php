<div class="form-group">
    {!! Form::label('material_name', '物料名称:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($warehouseoutitem->material->name))
            {!! Form::text('material_name', $warehouseoutitem->material->name, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectMaterialModal', 'id' => 'material_name']) !!}
        @else
            {!! Form::text('material_name', null, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectMaterialModal', 'id' => 'material_name']) !!}
        @endif
        {!! Form::hidden('material_id', null, ['id' => 'material_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('quantity', '数量:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('quantity', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('sohead_name', '对应销售订单:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($warehouseoutitem->material->name))
            {!! Form::text('sohead_name', $warehouseoutitem->material->name, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal', 'id' => 'sohead_name']) !!}
        @else
            {!! Form::text('sohead_name', null, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal', 'id' => 'sohead_name']) !!}
        @endif
        {!! Form::hidden('sohead_id', null, ['id' => 'sohead_id']) !!}
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

{!! Form::hidden('warehouseouthead_id', $warehouseouthead_id, ['class' => 'form-control']) !!}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
    </div>
</div>

