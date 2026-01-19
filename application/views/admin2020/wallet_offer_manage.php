<!DOCTYPE html>
<?php
if ($this->session->userdata('site_lang') && in_array($this->session->userdata('site_lang'), json_decode($this->system->rtl_supported_language, true))) {
    $dir = 'rtl';
} else {
    $dir = 'ltr';
}
?>
<html dir='<?php echo $dir; ?>'>

<head>
    <?php $this->load->view($this->path_to_view_admin . 'header'); ?>
</head>

<body>
    <?php $this->load->view($this->path_to_view_admin . 'header_body'); ?>
    <div class="d-flex" id="wrapper">
        <?php $this->load->view($this->path_to_view_admin . 'sidebar'); ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        <?php echo $title; ?>
                    </h1>
                    <?php if (isset($btn)) { ?>
                        <a class="btn btn-sm btn-outline-secondary"
                            href="<?php echo base_url() . $this->path_to_view_admin; ?>wallet_offer/insert">
                            <i class="fa fa-plus"></i>
                            <?php echo $btn; ?>
                        </a>
                    <?php } ?>
                </div>
                <?php if ($this->session->flashdata('notification')) { ?>
                    <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"
                            aria-label="Close"><span aria-hidden="true">×</span></button><button class="close"
                            data-close="alert"></button>
                        <span>
                            <?php echo $this->session->flashdata('notification'); ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"
                            aria-label="Close"><span aria-hidden="true">×</span></button><button class="close"
                            data-close="alert"></button>
                        <span>
                            <?php echo $this->session->flashdata('error'); ?>
                        </span>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <form name="frmofferlist" method="post"
                            action="<?php echo base_url() . $this->path_to_view_admin ?>wallet_offer">
                            <div class=" table-responsive">
                                <table id="manage_tbl" class="table  table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="7">
                                                <label>Action to perform</label>
                                                <select class="multi_action form-control d-inline w-auto ml-2">
                                                    <option value="">Select</option>
                                                    <option value="delete">Delete</option>
                                                    <option value="change_publish">Change Status</option>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th><input type="checkbox" class='checkall' id='checkall'> </th>
                                            <th>Sr No</th>
                                            <th>Offer Amount</th>
                                            <th>Extra Coins</th>
                                            <th>Best Deal</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Sr No</th>
                                            <th>Offer Amount</th>
                                            <th>Extra Coins</th>
                                            <th>Best Deal</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <input type="hidden" name="action" />
                                <input type="hidden" name="offerid" />
                                <input type="hidden" name="publish" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php $this->load->view($this->path_to_view_admin . 'footer_body'); ?>
        </div>
    </div>
    <?php $this->load->view($this->path_to_view_admin . 'footer'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#manage_tbl').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url() . $this->path_to_view_admin; ?>wallet_offer/setDatatableWalletOffer",
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 7],
                    "orderable": false
                }],
                "order": [[6, "desc"]]
            });
        });

        function confirmDeleteOffer(frm, id) {
            if (confirm("Are you sure you want to delete this offer?")) {
                frm.offerid.value = id;
                frm.action.value = 'delete';
                frm.submit();
            }
        }

        function changePublishStatus(frm, id, status) {
            frm.offerid.value = id;
            frm.publish.value = status;
            frm.action.value = 'change_publish';
            frm.submit();
        }

        $('.multi_action').change(function () {
            if ($(this).val() != "") {
                var action = $(this).val();
                var ids = [];
                $('.all_inputs:checked').each(function () {
                    ids.push($(this).val());
                });
                if (ids.length > 0) {
                    if (confirm("Are you sure you want to perform this action?")) {
                        $.ajax({
                            url: "<?php echo base_url() . $this->path_to_view_admin; ?>wallet_offer/multi_action",
                            type: "POST",
                            data: { action: action, ids: ids },
                            success: function (data) {
                                location.reload();
                            }
                        });
                    }
                } else {
                    alert("Please select at least one record.");
                    $(this).val("");
                }
            }
        });
    </script>
</body>

</html>
