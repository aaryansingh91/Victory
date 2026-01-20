<!DOCTYPE html>
<?php
    if($this->session->userdata('site_lang') && in_array($this->session->userdata('site_lang'),json_decode($this->system->rtl_supported_language,true))) {
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
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2"><?php echo $this->lang->line('text_bulk_duplicate'); ?></h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <a class="btn btn-sm btn-outline-secondary" href="<?php echo base_url() . $this->path_to_view_admin; ?>matches/">
                                <i class="fa fa-eye"></i> <?php echo $this->lang->line('text_view_match'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-light text-dark">
                                <div class="card-header"><strong><?php echo $this->lang->line('text_bulk_duplicate'); ?></strong></div>
                                <div class="card-body">
                                    <form class="needs-validation" id="validate" novalidate="" method="POST" action="<?php echo base_url() . $this->path_to_view_admin ?>matches/insert_bulk_duplicate">
                                        <input type="hidden" name="m_id" value="<?php echo $match_detail['m_id']; ?>">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="match_name"><?php echo $this->lang->line('text_source_match'); ?></label>
                                                <input type="text" class="form-control" value="<?php echo $match_detail['match_name']; ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="match_time"><?php echo $this->lang->line('text_match_schedule'); ?> (Current)</label>
                                                <input type="text" class="form-control" value="<?php echo $match_detail['match_time']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="no_of_matches"><?php echo $this->lang->line('text_no_of_matches'); ?> <span class="required" aria-required="true"> * </span></label>
                                                <input type="number" class="form-control" name="no_of_matches" id="no_of_matches" min="1" required>
                                                <?php echo form_error('no_of_matches', '<em style="color:red">', '</em>'); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="interval"><?php echo $this->lang->line('text_time_interval'); ?> <span class="required" aria-required="true"> * </span></label>
                                                <input type="number" class="form-control" name="interval" id="interval" min="1" required>
                                                <?php echo form_error('interval', '<em style="color:red">', '</em>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('text_btn_submit'); ?>" name="submit"><?php echo $this->lang->line('text_btn_submit'); ?></button>
                                            <a class="btn btn-secondary" href="<?php echo base_url() . $this->path_to_view_admin; ?>matches/" name="cancel"><?php echo $this->lang->line('text_btn_cancel'); ?></a>
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
            $("#validate").validate({
                rules: {
                    no_of_matches: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    interval: {
                        required: true,
                        number: true,
                        min: 1
                    }
                },
                messages: {
                    no_of_matches: {
                        required: "Please enter number of matches",
                    },
                    interval: {
                        required: "Please enter time interval",
                    }
                }
            });
        </script>
    </body>
</html>
