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

        $('#selectSalesorderModal').on('shown.bs.modal', function (e) {
            $("#listproject").empty();


            $.ajax({
                type: "GET",
                url: "{!! url('/sales/soheads/getitemsbykey/') !!}" + "/" + $("#keyProject").val(),
                success: function(result) {
                    var strhtml = '';
                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectProject_' + String(i);
                        strhtml += "<button type='button' class='list-group-item' id='" + btnId + "'>" + "<h4>" + field.number + "</h4><p>" + field.name + "</p></button>"
                    });
                    if (strhtml == '')
                        strhtml = '无记录。';
                    $("#listproject").empty().append(strhtml);

                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectProject_' + String(i);
                        addBtnClickEventProject(btnId, field);
                    });
                    // addBtnClickEvent('btnSelectOrder_0');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('error');
                }
            });

            });

        $("#btnSearchProject").click(function() {
//            if ($("#keyProject").val() == "") {
//                alert('请输入关键字');
//                return;
//            }
            $.ajax({
                type: "GET",
                url: "{!! url('/sales/soheads/getitemsbykey/') !!}" + "/" + $("#keyProject").val(),
                success: function(result) {
                    var strhtml = '';
                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectProject_' + String(i);
                        strhtml += "<button type='button' class='list-group-item' id='" + btnId + "'>" + "<h4>" + field.number + "</h4><p>" + field.name + "</p></button>"
                    });
                    if (strhtml == '')
                        strhtml = '无记录。';
                    $("#listproject").empty().append(strhtml);

                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectProject_' + String(i);
                        addBtnClickEventProject(btnId, field);
                    });
                    // addBtnClickEvent('btnSelectOrder_0');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('error');
                }
            });
        });

        function addBtnClickEventProject(btnId, field)
        {
            $("#" + btnId).bind("click", function() {
                $('#selectSalesorderModal').modal('toggle');
                // $("#" + $("#selectSalesorderModal").find('#name').val()).val(field.name);
                // $("#" + $("#selectSalesorderModal").find('#id').val()).val(field.id);
                // $("#sohead_number").val(field.number);
                {{ $slot }}
            });
        }
    });
</script>
