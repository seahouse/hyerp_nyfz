@extends('navbarerp')

@section('main')
    <h1>添加维护记录</h1>
    <hr/>
    
    {!! Form::open(['url' => 'sales/maintainrecords', 'class' => 'form-horizontal']) !!}
        @include('sales.maintainrecords._form', ['submitButtonText' => '添加'])
    {!! Form::close() !!}

    
    @include('errors.list')
    @include('sales.customers._selectcustomermodal')
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