@extends('navbarerp')

@section('main')
    <h1>添加销售订单</h1>
    <hr/>
    
    {!! Form::open(['url' => 'sales/soheads', 'class' => 'form-horizontal']) !!}
        @include('sales.soheads._form', ['submitButtonText' => '添加'])
    {!! Form::close() !!}

    
    @include('errors.list')

    <div class="modal fade" id="selectCustomerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">选择客户</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => '客户名称', 'id' => 'key']) !!}
                        <span class="input-group-btn">
                   		{!! Form::button('查找', ['class' => 'btn btn-default btn-sm', 'id' => 'btnSearchCustomer']) !!}
                   	</span>
                    </div>
                    {!! Form::hidden('name', null, ['id' => 'name']) !!}
                    {!! Form::hidden('id', null, ['id' => 'id']) !!}
                    <p>
                    <div class="list-group" id="listcustomer">

                    </div>
                    </p>
            </div>
        </div>
    </div>

@stop

@section('script')
            <script type="text/javascript">
                jQuery(document).ready(function(e) {
                    $('#selectCustomerModal').on('show.bs.modal', function (e) {
                        $("#listcustomer").empty();

                        var text = $(e.relatedTarget);
                        // alert(text.data('id'));

                        var modal = $(this);
                        modal.find('#name').val(text.data('name'));
                        modal.find('#id').val(text.data('id'));
                        // alert(modal.find('#id').val());
                    });

                    $("#btnSearchCustomer").click(function() {
                        if ($("#key").val() == "") {
                            alert('请输入关键字');
                            return;
                        }
                        $.ajax({
                            type: "GET",
                            url: "{!! url('/sales/customers/getitemsbykey/') !!}" + "/" + $("#key").val(),
                            success: function(result) {
                                var strhtml = '';
                                $.each(result.data, function(i, field) {
                                    btnId = 'btnSelectCustomer_' + String(i);
                                    strhtml += "<button type='button' class='list-group-item' id='" + btnId + "'>" + "<h4>" + field.number + "</h4><p>" + field.name + "</p></button>"
                                });
                                if (strhtml == '')
                                    strhtml = '无记录。';
                                $("#listcustomer").empty().append(strhtml);

                                $.each(result.data, function(i, field) {
                                    btnId = 'btnSelectCustomer_' + String(i);
                                    addBtnClickEventCustomer(btnId, field);
                                });
                                // addBtnClickEvent('btnSelectOrder_0');
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert('error');
                            }
                        });
                    });

                    function addBtnClickEventCustomer(btnId, field)
                    {
                        $("#" + btnId).bind("click", function() {
                            $('#selectCustomerModal').modal('toggle');
                            $("#customer_name").val(field.name);
                            $("#customer_id").val(field.id);
                            // $("#sohead_number").val(field.number);
                        });
                    }
                });
            </script>
@endsection