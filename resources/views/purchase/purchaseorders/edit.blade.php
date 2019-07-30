@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>

    @can('purchase_pohead_edit')
    {!! Form::model($purchaseorder, ['method' => 'PATCH', 'action' => ['Purchase\PurchaseorderController@update', $purchaseorder->id], 'class' => 'form-horizontal', 'files' => true]) !!}
        @include('purchase.purchaseorders._form',
            [
                'submitButtonText' => '保存',
                'attr' => '',
                'btnclass' => 'btn btn-primary',
            ])
    {!! Form::close() !!}
    @else
        无权限。
    @endcan

    @include('errors.list')

    @include('sales.soheads._selectsalesordermodal')
    @include('purchase.vendors._selectvendormodal')

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
                    {!! Form::open(['url' => '/sales/purchaseordercs/clearfile', 'class' => 'form-horizontal', 'files' => true, 'id' => 'frmClear']) !!}
                    {!! Form::hidden('pohead_id', null, []) !!}
                    {!! Form::hidden('type', null, []) !!}
                    {!! Form::hidden('filename', null, []) !!}
                    {!! Form::button('取消', ['class' => 'btn btn-sm', 'data-dismiss' => 'modal']) !!}
                    {!! Form::button('删除', ['class' => 'btn btn-sm btn-primary', 'id' => 'btnClear']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @component('sales.soheads._selectsalesorderjs')
        $("#sohead_name").val(field.name);
        $("#sohead_id").val(field.id);
    @endcomponent

    {{--@include('sales.soheads._selectsalesorderjs')--}}

    @include('purchase.vendors._selectvendorjs')

    <script type="text/javascript">
        jQuery(document).ready(function(e) {



            $('#clearAttachModal').on('show.bs.modal', function (e) {
                var target = $(e.relatedTarget);
                // alert(text.data('id'));

                var modal = $(this);
                modal.find("input[name='pohead_id']").val(target.data('pohead_id'));
                modal.find("input[name='type']").val(target.data('type'));
                modal.find("input[name='filename']").val(target.data('filename'));
            });

            $("#btnClear").click(function() {
                alert('aaa');
                var form = new FormData(document.getElementById("frmClear"));
                $.ajax({
                    type: "POST",
                    url: "{{ url('purchase/purchaseorders/clearfile') }}",
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
