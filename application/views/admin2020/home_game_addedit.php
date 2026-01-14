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
                    <h1 class="h2"><?php echo $this->lang->line('text_game'); ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <?php if (isset($btn)) { ?>
                            <a class="btn btn-sm btn-outline-secondary"
                                href="<?php echo base_url() . $this->path_to_view_admin; ?>home_game/">
                                <i class="fa fa-eye"></i> <?php echo $btn; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($this->session->flashdata('notification')) { ?>
                    <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"
                            aria-label="Close"><span aria-hidden="true">×</span></button><button class="close"
                            data-close="alert"></button>
                        <span><?php echo $this->session->flashdata('notification'); ?></span>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"
                            aria-label="Close"><span aria-hidden="true">×</span></button><button class="close"
                            data-close="alert"></button>
                        <span><?php echo $this->session->flashdata('error'); ?></span>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-light text-dark">
                            <div class="card-header"><strong><?php echo $this->lang->line('text_game'); ?></strong>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form class="needs-validation" enctype="multipart/form-data" id="validate"
                                        novalidate="" method="POST"
                                        action="<?php if ($Action == $this->lang->line('text_action_add')) { ?><?php echo base_url() . $this->path_to_view_admin ?>home_game/insert<?php } elseif ($Action == $this->lang->line('text_action_edit')) { ?><?php echo base_url() . $this->path_to_view_admin ?>home_game/edit<?php } ?>">
                                        <div class="row">
                                            <input type="hidden" class="form-control" name="game_id" value="<?php if (isset($game_id))
                                                echo $game_id;
                                            elseif (isset($game_detail['game_id']))
                                                echo $game_detail['game_id'] ?>">
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="game_name"><?php echo $this->lang->line('text_game_name'); ?><span
                                                        class="required" aria-required="true"> * </span></label>
                                                <input type="text" class="form-control" name="game_name" value="<?php if (isset($game_name))
                                                    echo $game_name;
                                                elseif (isset($game_detail['game_name']))
                                                    echo $game_detail['game_name'] ?>">
                                                <?php echo form_error('game_name', '<em style="color:red">', '</em>'); ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="game_image"><?php echo $this->lang->line('text_image'); ?><span
                                                        class="required" aria-required="true"> * </span></label><br>
                                                <input id="game_image" type="file" class="file-input d-block"
                                                    name="game_image">
                                                <?php echo form_error('game_image', '<em style="color:red">', '</em>'); ?>
                                                <p><b><?php echo $this->lang->line('text_image_note'); ?> : </b>
                                                    <?php echo "Upload 500x500 size of image for better view in app."; ?>
                                                </p>
                                                <input type="hidden" id="file-input" name="old_game_image"
                                                    value="<?php echo (isset($game_detail['game_image'])) ? $game_detail['game_image'] : ''; ?>"
                                                    class="form-control-file">
                                                <?php if (isset($game_detail['game_image']) && $game_detail['game_image'] != '' && file_exists($this->game_image . $game_detail['game_image'])) { ?>
                                                    <br>
                                                    <img
                                                        src="<?php echo base_url() . $this->game_image . "thumb/100x100_" . $game_detail['game_image'] ?>">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary" type="submit"
                                                value="<?php echo $this->lang->line('text_btn_submit'); ?>"
                                                name="submit"><?php echo $this->lang->line('text_btn_submit'); ?></button>
                                            <a class="btn btn-secondary"
                                                href="<?php echo base_url() . $this->path_to_view_admin; ?>home_game/"
                                                name="cancel"><?php echo $this->lang->line('text_btn_cancel'); ?></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view($this->path_to_view_admin . 'footer_body'); ?>
        </div>
    </div>
    <?php $this->load->view($this->path_to_view_admin . 'footer'); ?>
    <script>
        $.validator.addMethod('filesize', function (value, element, arg) {
            if (element.files[0] == undefined || (element.files[0].size <= arg)) {
                return true;
            } else {
                return false;
            }
        }, '<?php echo $this->lang->line('err_image_size'); ?>');
        $("#validate").validate({
            rules: {
                game_name: {
                    required: true,
                },
                game_image: {
                    <?php if ($Action == $this->lang->line('text_action_add')) { ?>
                                required: true,
                    <?php } ?>
                        accept: "jpg|png|jpeg",
                    // filesize : 2000000,
                },
            },
            messages: {
                game_name: {
                    required: '<?php echo $this->lang->line('err_game_name_req'); ?>',
                },
                game_image: {
                    required: '<?php echo $this->lang->line('err_image_req'); ?>',
                    accept: '<?php echo $this->lang->line('err_image_accept'); ?>',
                },
            },
            errorPlacement: function (error, element) {
                if (element.is(":radio")) {
                    element.parent().append(error);
                } else {
                    error.insertAfter(element);
                }
            },
        });
    </script>
</body>

</html>