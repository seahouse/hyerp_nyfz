<script type="text/javascript">
    jQuery(document).ready(function(e) {
        $('#selectMaterial_catModal').on('show.bs.modal', function (e) {
            $("#listmaterial_cat").empty();

            var text = $(e.relatedTarget);
            // alert(text.data('id'));

            var modal = $(this);
            modal.find('#name').val(text.data('name'));
            modal.find('#id').val(text.data('id'));
            // alert(modal.find('#id').val());
        });

        $("#btnSearchMaterial_cat").click(function() {
            if ($("#keyMaterial_cat").val() == "") {
                alert('请输入关键字');
                return;
            }
            $.ajax({
                type: "GET",
                url: "{!! url('/basic/material_cats/getitemsbykey/') !!}" + "/" + $("#keyMaterial_cat").val(),
                success: function(result) {
                    var strhtml = '';
                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectMaterial_cat_' + String(i);
                        strhtml += "<button type='button' class='list-group-item' id='" + btnId + "'>" + "<h4>" + field.number + "</h4><p>" + field.name + "</p></button>"
                    });
                    if (strhtml == '')
                        strhtml = '无记录。';
                    $("#listmaterial_cat").empty().append(strhtml);

                    $.each(result.data, function(i, field) {
                        btnId = 'btnSelectMaterial_cat_' + String(i);
                        addBtnClickEventMaterial_cat(btnId, field);
                    });
                    // addBtnClickEvent('btnSelectOrder_0');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('error');
                }
            });
        });

        function addBtnClickEventMaterial_cat(btnId, field)
        {
            $("#" + btnId).bind("click", function() {
                $('#selectMaterial_catModal').modal('toggle');
                // $("#" + $("#selectSalesorderModal").find('#name').val()).val(field.name);
                // $("#" + $("#selectSalesorderModal").find('#id').val()).val(field.id);
                // $("#sohead_number").val(field.number);
                {{ $slot }}
            });
        }
    });
</script>