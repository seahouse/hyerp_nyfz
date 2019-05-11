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
    {!! Form::label('sohead_name', '对应项目:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($purchaseorder->sohead->name))
            {!! Form::text('sohead_name', $purchaseorder->sohead->name, ['class' => 'form-control', $attr]) !!}
        @else
            {!! Form::text('sohead_name', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectSalesorderModal', 'data-name' => 'project_name', 'data-id' => 'sohead_id']) !!}
        @endif
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

