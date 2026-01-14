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
                    <?php if($this->system->demo_user == 1) { ?>
                    <div class="alert alert-primary" role="alert">
                        <strong><?php echo stripslashes($this->lang->line('text_licence_note')); ?></strong>
                    </div>
                    <?php } ?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2"><?php echo $this->lang->line('text_dashboard');?></h1>
                        <div class="btn-toolbar mb-2 mb-md-0">                          
                        </div>
                    </div>
                    <div class="row">
                        <!-- Always show Total Users -->
                        <div class="col-lg-3 col-md-6 dash-box">
                            <a href="<?php echo base_url() . $this->path_to_view_admin ?>members/">
                                <div class="bg-lightpink small-box card card-sm-3">
                                    <div class="card-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo $this->lang->line('text_total_user');?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $tot_member['total_member']; ?>                                  
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Always show Total Matches -->
                        <div class="col-lg-3 col-md-6 dash-box">
                            <a href="<?php echo base_url() . $this->path_to_view_admin ?>matches/">
                                <div class="bg-lightgreen small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-gamepad"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo $this->lang->line('text_total_match');?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $tot_match['total_match']; ?>                                        
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <?php if(isset($show_all_stats) && $show_all_stats): ?>
                        <!-- Show earning-related stats only if user has permission -->
                        <div class="col-lg-3 col-md-6 dash-box">
                            <a href="<?php echo base_url() . $this->path_to_view_admin ?>pgorder/">
                                <div class="bg-lightblue small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo $this->lang->line('text_received_payment');?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $tot_payment['total_payment'])); ?>                                        
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <a href="<?php echo base_url() . $this->path_to_view_admin ?>withdraw/">
                                <div class="bg-lightpink small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo $this->lang->line('text_withdraw');?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $tot_withdraw['total_withdraw'])); ?>                                        
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <!--<a href="<?php echo base_url() . $this->path_to_view_admin ?>withdraw/">-->
                                <div class="bg-lightblue small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo "Today's Received Payment"; ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $tot_day_wise)); ?>                                        
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <!--<a href="<?php echo base_url() . $this->path_to_view_admin ?>withdraw/">-->
                                <div class="bg-lightpink small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo "Last 7 day's Received Payment"; ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $tot_week_wise)); ?>                                        
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <!--<a href="<?php echo base_url() . $this->path_to_view_admin ?>withdraw/">-->
                                <div class="bg-lightgreen small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo "Current Month's Received Payment"; ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $tot_month_wise)); ?>                                        
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <!--<a href="<?php echo base_url() . $this->path_to_view_admin ?>withdraw/">-->
                                <div class="bg-lightblue small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo "Current Year's Received Payment"; ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $tot_year_wise)); ?>                                        
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <div class="col-lg-3 col-md-6 dash-box">
                            <a href="<?php echo base_url() . $this->path_to_view_admin ?>profilesetting/">
                                <div class="bg-lightgreen small-box card card-sm-3">
                                    <div class="card-icon ">
                                        <i class="fa fa-cog"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4><?php echo $this->lang->line('text_contact_us_setting');?></h4>
                                        </div>
                                        <div class="card-body">                                                                                       
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <?php if(isset($show_all_stats) && $show_all_stats): ?>
                    <!-- Admin Profit Section - Only visible if user has permission -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h4>Admin Profit</h4>
                    </div>
                    
                    <!-- By Tournament Match -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h5><?php echo "By Tournament Match";?></h5>
                        <div class="btn-toolbar mb-2 mb-md-0">                          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightpink small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Total";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $total_match)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightpink small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Today's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_day_match)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightpink small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Last 7 day's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_week_match)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightpink small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Current Month's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_month_match)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightpink small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Current Year's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $year_match)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- By Challenge -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h5><?php echo "By Challenge";?></h5>
                        <div class="btn-toolbar mb-2 mb-md-0">                          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightblue small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Total";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $total_ludo)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightblue small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Today's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_day_ludo)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightblue small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Last 7 day's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_week_ludo)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightblue small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Current Month's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_month_ludo)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightblue small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Current Year's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $year_ludo)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- By Lottery -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h5><?php echo "By Lottery";?></h5>
                        <div class="btn-toolbar mb-2 mb-md-0">                          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightgreen small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Total";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $total_lottery)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightgreen small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Today's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_day_lottery )); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightgreen small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Last 7 day's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_week_lottery)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightgreen small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Current Month's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $per_month_lottery)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 dash-box">
                            <div class="bg-lightgreen small-box card card-sm-3">
                                <div class="card-icon ">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo "Current Year's Income";?></h4>
                                    </div>
                                    <div class="card-body"> 
                                        <?php echo $this->functions->getPoint() .' '. utf8_encode(sprintf('%.' . $this->functions->getCurrencyDecimal($this->system->currency) . 'F', $year_lottery)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                       
                </div>
                <?php $this->load->view($this->path_to_view_admin . 'footer_body'); ?>
            </div>
        </div>
        <?php $this->load->view($this->path_to_view_admin . 'footer'); ?>
    </body>
</html>