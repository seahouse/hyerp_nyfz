@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>

    @can('sales_sohead_edit')
    {!! Form::model($sohead, ['method' => 'PATCH', 'action' => ['Sales\SoheadController@update', $sohead->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        @include('sales.soheads._form', ['readonly' => '', 'btnclass' => 'btn btn-primary', 'submitButtonText' => '保存'])
    {!! Form::close() !!}
    @else
        无权限。
    @endcan

    
    @include('errors.list')
    @include('sales.customers._selectcustomermodal')

    <div class="modal fade" id="clearAttachModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">删除文件</h4>
                </div>
                <div class="modal-body">
                    <p>
                        删除该文件？
                    </p>


                </div>
                <div class="modal-footer">
                    {!! Form::open(['url' => '/sales/soheads/clearfile', 'class' => 'form-horizontal', 'files' => true, 'id' => 'frmClear']) !!}
                    {!! Form::hidden('sohead_id', null, []) !!}
                    {!! Form::hidden('type', null, []) !!}
                    {!! Form::hidden('filename', null, []) !!}
                    {!! Form::button('取消', ['class' => 'btn btn-sm', 'data-dismiss' => 'modal']) !!}
                    {!! Form::button('删除', ['class' => 'btn btn-sm btn-primary', 'id' => 'btnClear']) !!}
                    {!! Form::close() !!}
                </div>
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

            $('#clearAttachModal').on('show.bs.modal', function (e) {
                var target = $(e.relatedTarget);
                // alert(text.data('id'));

                var modal = $(this);
                modal.find("input[name='sohead_id']").val(target.data('sohead_id'));
                modal.find("input[name='type']").val(target.data('type'));
                modal.find("input[name='filename']").val(target.data('filename'));
            });

            $("#btnClear").click(function() {
                var form = new FormData(document.getElementById("frmClear"));
                $.ajax({
                    type: "POST",
                    url: "{{ url('sales/soheads/clearfile') }}",
                    data: form,
                    contentType: false,
                    processData: false,
//                    dataType: "json",
                    error:function(xhr, ajaxOptions, thrownError){
                        alert('error');
                    },
                    success:function(result){
                        alert("Clear Success.");
                        window.location.reload();
//                        $('#clearAttachModal').modal('toggle');
//                        var id = "filehandler_" + $('#clearAttachModal').find("input[name='shipment_id']").val() + "_" + $('#clearAttachModal').find("input[name='type']").val();
//                        $("#filehandler_" + $('#clearAttachModal').find("input[name='shipment_id']").val() + "_" + $('#clearAttachModal').find("input[name='type']").val()).html(result.popoverhtml);
//                        $('[data-toggle="popover"]').popover();
                    },
                });
            });
        });
    </script>
@endsection