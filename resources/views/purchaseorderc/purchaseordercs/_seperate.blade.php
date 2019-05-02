    <div class="form-group">
        {!! Form::label('number', '采购订单编号:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
        <div class='col-xs-8 col-sm-10'>
            {!! Form::text('number', null, ['class' => 'form-control', $attr]) !!}
            {{--{!! Form::hidden('对应项目ID', 0, ['class' => 'btn btn-sm', 'id' => '对应项目ID']) !!}--}}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('descrip', '采购订单名称:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
        <div class='col-xs-8 col-sm-10'>
            {!! Form::text('descrip', null, ['class' => 'form-control', $attr]) !!}
        </div>
    </div>

<div class="form-group">
    {!! Form::label('vendor_name', '供应商:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::text('vendor_name', null, ['class' => 'form-control', $attr, 'data-toggle' => 'modal', 'data-target' => '#selectVendorModal', 'data-name' => 'vendor_name', 'data-id' => 'vendor_id']) !!}
        {!! Form::hidden('vendor_id', 0, ['class' => 'btn btn-sm', 'id' => 'vendor_id']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('orderdate', '采购订单日期:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
    <div class='col-xs-8 col-sm-10'>
        {!! Form::date('orderdate', null, ['class' => 'form-control', $attr]) !!}
    </div>
</div>

    <div class="form-group">
        {!! Form::label('分单明细', '分单明细:', ['class' => 'col-xs-4 col-sm-2 control-label']) !!}
        <div class='col-xs-8 col-sm-10'>
            <table id="tablePacking" class="table table-striped table-hover table-full-width">
                <thead>
                <tr>
                    <th>面料序列号</th>
                    <th>物料代码</th>
                    {{--<th>数量</th>--}}
                    {{--<th>单位</th>--}}
                    {{--<th>面料尺寸</th>--}}
                    {{--<th>运输方式</th>--}}
                    {{--<th>单价</th>--}}
                    {{--<th>发货日期</th>--}}
                    <th>余量</th>
                    <th>打包</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchaseorder->poitemcs as $poitem)
                    <tr>
                        <td>
                            {{ $poitem->fabric_sequence_no }}
                        </td>
                        <td>
                            {{ $poitem->material_code }}
                        </td>
                        {{--<td>--}}
                            {{--{{ $poitem->quantity }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ $poitem->unit }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ $poitem->fabric_width }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ $poitem->transportation_method_type_code }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ $poitem->unit_price }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ $poitem->shipment_date }}--}}
                        {{--</td>--}}
                        <td>
                            {{ $poitem->quantity - $poitem->poitems->sum('quantity') }}
                        {{--{{ $poitem->asnitems->sum('quantity') }}--}}
                        </td>
                        <td>
                            <div id="divTd_{{ $poitem->id }}" name="poitemcquantity_container" data-poitemc_id="{{ $poitem->id }}">
                                <div class="row">
                                    {{--{!! Form::text('roll_no', null, ['placeholder' => '卷号']) !!}--}}
                                    {!! Form::text('quantity', null, ['placeholder' => '数量']) !!}
                                    {{--{!! Form::button('+', ['name' => 'btnAddLine', 'data-seq' => $poitem->id]) !!}--}}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {!! Form::hidden('items_string', null, ['id' => 'items_string']) !!}
        </div>
    </div>

    {!! Form::hidden('poheadc_id', $purchaseorder->id, []) !!}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::button($submitButtonText, ['class' => $btnclass, 'id' => 'btnSubmit']) !!}
    </div>
</div>
