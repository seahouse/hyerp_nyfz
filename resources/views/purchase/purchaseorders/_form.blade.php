<div class="form-group">
    {!! Form::label('number', '采购订单编号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('number', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('descrip', '采购订单名称:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('descrip', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('sohead_name', '对应销售订单:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($purchaseorder) && isset($purchaseorder->soheads->first()->name))
            {!! Form::text('sohead_name', $purchaseorder->soheads->first()->name, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal', 'data-name' => 'sohead_name', 'data-id' => 'sohead_id']) !!}
        @else
            {!! Form::text('sohead_name', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal', 'data-name' => 'sohead_name', 'data-id' => 'sohead_id']) !!}
        @endif
            {!! Form::hidden('sohead_id', null, ['id' => 'sohead_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('vendor_name', '供应商:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($purchaseorder))
            {!! Form::text('vendor_name', $purchaseorder->vendor->name, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectVendorModal', 'data-name' => 'vendor_name', 'data-id' => 'vendor_id']) !!}
        @else
            {!! Form::text('vendor_name', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectVendorModal', 'data-name' => 'vendor_name', 'data-id' => 'vendor_id']) !!}
        @endif
        {!! Form::hidden('vendor_id', null, ['id' => 'vendor_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('total_amount', '订单金额:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('total_amount', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('orderdate', '采购订单日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('orderdate', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('vendinfo_id', '供应商:') !!}--}}
    {{--{!! Form::select('vendinfo_id', $vendinfoList, null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}



{{--<div class="form-group">--}}
    {{--{!! Form::label('term_id', '付款方式:') !!}--}}
    {{--{!! Form::select('term_id', $termList, null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}


{{--<div class="form-group">--}}
    {{--{!! Form::label('vend_contact_id', '供应商联系人:') !!}--}}
    {{--{!! Form::select('vend_contact_id', $contactList, null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}



<div class="form-group">
    {!! Form::label('files', '文件:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($purchaseorder))
            @foreach ($purchaseorder->files() as $file)
                <a href="{!! Storage::url($purchaseorder->poheadattachments->where('type', 'file')->where('filename', $file->filename)->first()->path) !!}" target="_blank">{{ $file->filename }}</a>
                <button class='btn btn-sm' data-toggle='modal' data-target='#clearAttachModal' data-pohead_id='{!! $purchaseorder->id !!}' data-type='file' data-filename="{!! $file->filename !!}" type='button'>删除</button><br>
            @endforeach
            {!! Form::file('files[]', ['multiple']) !!}
        @else
            {!! Form::file('files[]', ['multiple']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('images', '图片:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}

    <div class='col-xs-8 col-sm-10'>
        <div class="row" id="previewimage">
        </div>
        @if (isset($purchaseorder))
            <div class="row" id="previewimage2">
                @foreach ($purchaseorder->images() as $image)
                    <div class="col-xs-6 col-md-3">
                        <div class="thumbnail">
                            <img src="{!! Storage::url($purchaseorder->poheadattachments->where('type', 'image')->where('filename', $image->filename)->first()->path) !!}" />
                            <button class='btn btn-sm' data-toggle='modal' data-target='#clearAttachModal' data-pohead_id='{!! $purchaseorder->id !!}' data-type='image' data-filename="{!! $image->filename !!}" type='button'>删除</button>
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

