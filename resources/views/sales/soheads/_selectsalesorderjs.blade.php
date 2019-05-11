<script type="text/javascript">
    jQuery(document).ready(function(e) {









        $('#selectSalesorderModal').on('show.bs.modal', function (e) {
            $("#listproject").empty();

            var text = $(e.relatedTarget);
            // alert(text.data('id'));

            var modal = $(this);
            modal.find('#name').val(text.data('name'));
            modal.find('#id').val(text.data('id'));
            // alert(modal.find('#id').val());
        });

        $("#btnSearchProject").click(function() {
            if ($("#keyProject").val() == "") {
                alert('请输入关键字');
                return;
            }
            $.ajax({
                type: "GET",
                url: "{!! url('/sales/salesorders/getitemsbykey/') !!}" + "/" + $("#keyProject").val(),
                success: function(result) {
                    var strhtml = '';
                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectProject_' + String(i);
                        strhtml += "<button type='button' class='list-group-item' id='" + btnId + "'>" + "<h4>" + field.number + "</h4><p>" + field.descrip + "</p></button>"
                    });
                    if (strhtml == '')
                        strhtml = '无记录。';
                    $("#listproject").empty().append(strhtml);

                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectProject_' + String(i);
                        addBtnClickEventProject(btnId, field.id, field.number, field);
                    });
                    // addBtnClickEvent('btnSelectOrder_0');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('error');
                }
            });
        });

        function addBtnClickEventProject(btnId, soheadid, name, field)
        {
            $("#" + btnId).bind("click", function() {
                $('#selectSalesorderModal').modal('toggle');
                $("#" + $("#selectSalesorderModal").find('#name').val()).val(field.descrip);
                $("#" + $("#selectSalesorderModal").find('#id').val()).val(soheadid);
                $("#sohead_number").val(field.number);
//					$("#supplier_bank").val(field.bank);
//					$("#supplier_bankaccountnumber").val(field.bankaccountnumber);
//					$("#vendbank_id").val(field.vendbank_id);
//					$("#selectSupplierBankModal").find("#vendinfo_id").val(supplierid);
            });
        }
    });
</script>
