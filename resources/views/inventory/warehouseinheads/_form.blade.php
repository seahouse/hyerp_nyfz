<div class="form-group">
    {!! Form::label('number', '入库单号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('number', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('date', '入库日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('date', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pohead_name', '对应采购订单:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($wareshouseinhead) && isset($wareshouseinhead->poheads->first()->name))
            {!! Form::text('pohead_id', $wareshouseinhead->poheads->first()->name, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectpoheadModal', 'data-name' => 'pohead_name', 'data-id' => 'pohead_id']) !!}
        @else
            {!! Form::text('pohead_id', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectpoheadModal', 'data-name' => 'pohead_name', 'data-id' => 'pohead_id']) !!}
        @endif
            {!! Form::hidden('pohead_id', null, ['id' => 'pohead_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('vendor_name', '供应商:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        @if (isset($wareshouseinhead))
            {!! Form::text('vendor_name', $wareshouseinhead->vendor->name, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectVendorModal', 'data-name' => 'vendor_name', 'data-id' => 'vendor_id']) !!}
        @else
            {!! Form::text('vendor_name', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectVendorModal', 'data-name' => 'vendor_name', 'data-id' => 'vendor_id']) !!}
        @endif
        {!! Form::hidden('vendor_id', null, ['id' => 'vendor_id']) !!}
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

