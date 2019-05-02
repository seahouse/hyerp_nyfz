@extends('navbarerp')

@section('main')
    <h1>添加Order</h1>
    <hr/>

    {!! Form::open(['url' => 'purchase/asnorders', 'class' => 'form-horizontal']) !!}
    @include('purchase.asnorders._form', ['submitButtonText' => '添加'])
    {!! Form::close() !!}

    @include('errors.list')

    @include('purchase.purchaseorders._selectpoheadmodal')
    @include('purchase.poitemrolls._selectpoitemrollmodal')
@endsection

@section('script')
    @component('purchase.purchaseorders._selectpoheadjs')
        var item_num = 1;
        // alert(field.id);
        $.ajax({
            type: "GET",
            url: "{!! url('/purchase/poitems/getitemsbypoheadid/') !!}" + "/" + field.id,
            success: function(result) {
                var strhtml = '';
                $.each(result.data, function(i, value) {
                    {{--alert(value.id);--}}
                    strhtml += '<div name="container_item">\
                        <div class="form-group">\
                            <label for="poitemroll_numbers" class="col-xs-4 col-sm-2 control-label">' + value.material_code + ':</label>\
                            <div class="col-sm-10 col-xs-8">\
                                <input class="form-control" data-toggle="modal" data-target="#selectPoitemrollModal" name="poitemroll_numbers" type="text" id="poitemroll_numbers' + String(item_num) + '" data-poitem_id="' + value.id + '" data-num="' + String(item_num) + '">\
                                <input class="btn btn-sm" id="poitemroll_values' + String(item_num) + '" name="poitemroll_values" type="hidden" value="0">\
                                <input name="poitem_id" type="hidden" value="' + value.id + '">\
                            </div>\
                        </div>\
                    </div>';
                    item_num++;
                });
                if (strhtml == '')
                    strhtml = '无记录。';
                {{--alert(strhtml);--}}
                $("#items").empty().append(strhtml);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('error');
            }
        });
    @endcomponent
{{--    @include('purchase.purchaseorders._selectpoheadjs')--}}
    @include('purchase.poitemrolls._selectpoitemrolljs')

    <script type="text/javascript">
        jQuery(document).ready(function(e) {

            $("#btnSubmit").click(function() {
                var itemArray = new Array();

                $("div[name='container_item']").each(function(i){
                    var itemObject = new Object();
                    var container = $(this);

//                    itemObject.item_id = container.find("#item_id").val();
//                    itemObject.item_name = container.find("#item_name").val();
                    itemObject.poitem_id = container.find("input[name='poitem_id']").val();
                    itemObject.poitemroll_values = container.find("input[name='poitemroll_values']").val();
//                    itemObject.unitprice = container.find("input[name='unitprice']").val();
//                    if (itemObject.unitprice == "")
//                        itemObject.unitprice = 0.0;
//                    itemObject.unit_id = container.find("select[name='unit_id']").val();
//                    itemObject.unit_name = container.find("select[name='unit_id']").find("option:selected").text();

                    itemArray.push(itemObject);

//                    alert(JSON.stringify(itemArray));
//                    return false;
//                    alert($("form#formMain").serialize());
                });
                $("#items_string").val(JSON.stringify(itemArray));

//                alert($("#sohead_id").val());
                if ($("#sohead_id").val() != 7550)
                {
                    if ($("#issuedrawing_values").val() == "")
                    {
                        $('#submitModal').modal('toggle');
                        $("#dataDefine").empty().append('未选择下图单');
                        return false;
                    }
                }
                $("form#formMain").submit();

            });


























        });
    </script>
@endsection

