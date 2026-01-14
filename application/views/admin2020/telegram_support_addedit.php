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
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <?php if (isset($btn)) { ?>
                            <a class="btn btn-sm btn-outline-secondary"
                                href="<?php echo base_url() . $this->path_to_view_admin; ?>telegram_support/">
                                <i class="fa fa-eye"></i>
                                <?php echo $btn; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-light text-dark">
                            <div class="card-header"><strong>Telegram Support</strong></div>
                            <div class="card-body">
                                <form method="POST" id="validate" enctype="multipart/form-data"
                                    action="<?php if ($Action == 'Add') { ?><?php echo base_url() . $this->path_to_view_admin ?>telegram_support/insert<?php } elseif ($Action == 'Edit') { ?><?php echo base_url() . $this->path_to_view_admin ?>telegram_support/edit<?php } ?>">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name<span class="required" aria-required="true"> *
                                                </span></label>
                                            <input type="text" class="form-control" name="name"
                                                value="<?php if (isset($name))
                                                    echo $name;
                                                elseif (isset($detail['name']))
                                                    echo $detail['name'] ?>">
                                            <?php echo form_error('name', '<em style="color:red">', '</em>'); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="url">Telegram URL<span class="required" aria-required="true"> *
                                                </span></label>
                                            <input type="text" class="form-control" name="url"
                                                value="<?php if (isset($url))
                                                    echo $url;
                                                elseif (isset($detail['url']))
                                                    echo $detail['url'] ?>">
                                            <?php echo form_error('url', '<em style="color:red">', '</em>'); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="image">Image<span class="required" aria-required="true"> *
                                                </span></label><br>
                                            <input id="image" type="file" class="file-input d-block" name="image">
                                            <?php echo form_error('image', '<em style="color:red">', '</em>'); ?>
                                            <p><b>Note : </b> Image should be jpg/png and max 2MB.</p>
                                            <?php if (isset($detail['image']) && file_exists($this->telegram_support_image . $detail['image'])) { ?>
                                                <br>
                                                <img src="<?php echo base_url() . $this->telegram_support_image . "thumb/100x100_" . $detail['image'] ?>">
                                            <?php } ?>
                                            <input type="hidden" name="old_image"
                                                value="<?php echo (isset($detail['image'])) ? $detail['image'] : ''; ?>">
                                            <input type="hidden" name="telegram_support_id"
                                                value="<?php echo (isset($detail['telegram_support_id'])) ? $detail['telegram_support_id'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" value="Submit" name="submit" class="btn btn-primary ">
                                        <a class="btn btn-secondary"
                                            href="<?php echo base_url() . $this->path_to_view_admin; ?>telegram_support/"
                                            name="cancel">Cancel</a>
                                    </div>
                                </form>
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
        $(document).ready(function () {
            $("#validate").validate({
                rules: {
                    'name': {
                        required: true,
                    },
                    'url': {
                        required: true,
                        url: true
                    },
                    'image': {
                        required: function () {
                            if ($('input[name="old_image"]').val() == "") {
                                return true;
                            } else {
                                return false;
                            }
                        },
                        accept: "jpg|png|jpeg",
                    },
                },
                messages: {
                    'name': {
                        required: 'Name is required',
                    },
                    'url': {
                        required: 'URL is required',
                        url: 'Please enter a valid URL'
                    },
                    'image': {
                        required: 'Image is required',
                        accept: 'Please select only jpg/png file.',
                    },
                },
                errorPlacement: function (error, element) {
                    if (element.is(":file")) {
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        });
    </script>
</body>

</html>