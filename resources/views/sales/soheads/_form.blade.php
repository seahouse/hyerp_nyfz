<div class="form-group">
    {!! Form::label('number', '编号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('number', null, ['class' => 'form-control', $readonly]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', '订单名称:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('name', null, ['class' => 'form-control', $readonly]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('customer_name', '客户:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($sohead->customer->name))
            {!! Form::text('customer_name', $sohead->customer->name, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectCustomerModal', 'id' => 'customer_name', $readonly]) !!}
        @else
            {!! Form::text('customer_name', null, ['class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#selectCustomerModal', 'id' => 'customer_name', $readonly]) !!}
        @endif
        {!! Form::hidden('customer_id', null, ['id' => 'customer_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('total_amount', '订单金额:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('total_amount', null, ['class' => 'form-control', $readonly]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('duedate', '到期日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('duedate', null, ['class' => 'form-control', $readonly]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('orderdate', '订单日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('orderdate', null, ['class' => 'form-control', $readonly]) !!}
    </div>
</div>


{{--<div class="form-group">--}}
    {{--{!! Form::label('salesmanager_id', '销售经理:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}--}}
    {{--<div class='col-xs-8 col-sm-10'>--}}
        {{--{!! Form::text('salesmanager_id', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    {!! Form::label('drawing_completed', '图纸完成状态:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::select('drawing_completed', array('1'=>'是', '0'=>'否'), null, ['class' => 'form-control', $readonly]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('files', '文件:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($sohead))
            @foreach ($sohead->files() as $file)
                <a href="{!! Storage::url($sohead->soheadattachments->where('type', 'file')->where('filename', $file->filename)->first()->path) !!}" target="_blank">{{ $file->filename }}</a>
                <button class='btn btn-sm' data-toggle='modal' data-target='#clearAttachModal' data-sohead_id='{!! $sohead->id !!}' data-type='file' data-filename="{!! $file->filename !!}" type='button'>删除</button><br>
            @endforeach
            {!! Form::file('files[]', ['multiple', $readonly]) !!}
        @else
            {!! Form::file('files[]', ['multiple', $readonly]) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('images', '图片:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}

    <div class='col-xs-8 col-sm-10'>
        <div class="row" id="previewimage">
        </div>
        @if (isset($sohead))
            <div class="row" id="previewimage2">
                @foreach ($sohead->images() as $image)
                    <div class="col-xs-6 col-md-3">
                        <div class="thumbnail">
                            <img src="{!! Storage::url($sohead->soheadattachments->where('type', 'image')->where('filename', $image->filename)->first()->path) !!}" />
                            <button class='btn btn-sm' data-toggle='modal' data-target='#clearAttachModal' data-sohead_id='{!! $sohead->id !!}' data-type='image' data-filename="{!! $image->filename !!}" type='button'>删除</button>
                        </div>
                    </div>
                @endforeach
            </div>
            {!! Form::file('images[]', ['multiple']) !!}
        @else
            {!! Form::file('images[]', ['multiple']) !!}
        @endif

    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit($submitButtonText, ['class' => $btnclass, 'id' => 'btnSubmit']) !!}
    </div>
</div>

