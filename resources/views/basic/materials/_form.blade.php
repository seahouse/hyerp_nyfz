<div class="form-group">
    {!! Form::label('number', '编号:',['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
    {!! Form::text('number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', '名称:',['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('material_cat_name', '物料类别:',['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($material))
            {!! Form::text('material_cat_name', $material->material_cat->name, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectMaterial_catModal', 'id' => 'material_cat_name']) !!}
        @else
            {!! Form::text('material_cat_name', null, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectMaterial_catModal', 'id' => 'material_cat_name']) !!}
        @endif
        {!! Form::hidden('material_cat_id', null, ['id' => 'material_cat_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('note', '备注:',['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
    {!! Form::text('note', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
    </div>
</div>
