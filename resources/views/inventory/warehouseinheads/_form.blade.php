<div class="form-group">
    {!! Form::label('number', '入库单号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('number', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('date', '入库日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('date', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pohead_name', '对应采购订单:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($warehouseinhead) && isset($warehouseinhead->pohead->number))
            {!! Form::text('pohead_number', $warehouseinhead->pohead->number, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectPurchaseorderModal', 'id' => 'pohead_number']) !!}
        @else
            {!! Form::text('pohead_number', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectPurchaseorderModal',  'id' => 'pohead_number']) !!}
        @endif
            {!! Form::hidden('pohead_id', null, ['id' => 'pohead_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('vendor_name', '供应商:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($warehouseinhead))
            {!! Form::text('vendor_name', $warehouseinhead->vendor->name, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectVendorModal', 'data-name' => 'vendor_name', 'data-id' => 'vendor_id']) !!}
        @else
            {!! Form::text('vendor_name', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectVendorModal', 'data-name' => 'vendor_name', 'data-id' => 'vendor_id']) !!}
        @endif
        {!! Form::hidden('vendor_id', null, ['id' => 'vendor_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('warehouse_name', '储存地:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::select('warehouse_id', $warehouse_List, null, ['class' => 'form-control', 'placeholder' => '--请选择--']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('remark', '备注:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('remark', null, ['class' => 'form-control', $attr]) !!}
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


{{--<div class="form-group">--}}
    {{--{!! Form::label('shipto_account_id', '收货联系人:') !!}--}}
    {{--{!! Form::select('shipto_account_id', $contactList, null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}


{{--<div class="form-group">--}}
    {{--{!! Form::label('sohead_id', '销售订单:') !!}--}}
    {{--{!! Form::select('sohead_id', $soheadList, null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
    </div>
</div>

