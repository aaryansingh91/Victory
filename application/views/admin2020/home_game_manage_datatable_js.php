<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        var dataTable = $('#manage_tbl').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "columnDefs": [
                {
                    "targets": [0, 1, 3, 4, 5],
                    "orderable": false,
                },
            ],
            "ajax": {
                url: "<?php echo base_url() . $this->path_to_view_admin; ?>home_game/setDatatableGame",
                type: "POST"
            }
        });

        $('#checkall').click(function () {
            if ($(this).prop('checked')) {
                $('.all_inputs').prop('checked', true);
            } else {
                $('.all_inputs').prop('checked', false);
            }
        });

        $('.multi_action').change(function () {
            if ($(this).val() != "") {
                var ids = [];
                $('.all_inputs:checked').each(function () {
                    ids.push($(this).val());
                });
                if (ids.length > 0) {
                    if (confirm("<?php echo $this->lang->line('text_confirm_multi_action'); ?>")) {
                        $.ajax({
                            url: "<?php echo base_url() . $this->path_to_view_admin; ?>home_game/multi_action",
                            type: "POST",
                            data: { ids: ids, action: $(this).val() },
                            success: function (data) {
                                if (data == "") {
                                    location.reload();
                                } else {
                                    alert(data);
                                }
                            }
                        });
                    }
                } else {
                    alert("<?php echo $this->lang->line('text_err_no_selected'); ?>");
                    $(this).val("");
                }
            }
        });

    });

    function changePublishStatus(form, id, status) {
        form.action.value = "change_publish";
        form.gameid.value = id;
        form.publish.value = status;
        form.submit();
    }

    function confirmDeleteGame(form, id) {
        if (confirm("<?php echo $this->lang->line('text_confirm_delete_game'); ?>")) {
            form.action.value = "delete";
            form.gameid.value = id;
            form.submit();
        }
    }
</script>