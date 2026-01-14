
<!--START TOP AREA-->
<header class="top-area" id="home">
    <div class="header-top-area" id="scroolup">
        <!--MAINMENU AREA-->
        <?php $this->load->view($this->path_to_view_front . 'header_body'); ?>
        <!--END MAINMENU AREA END-->
    </div>
    <?php
    $banner_image = "";
    $bg_dark = "";
    $side_image = "";
    if ($this->system->home_sec_bnr_image != "") {
        $banner_image = base_url() . $this->page_banner . $this->system->home_sec_bnr_image;
    } else {
        $bg_dark = "bm-dark-bg h-auto";
    }
    if ($this->system->home_sec_side_image != "") {
        $side_image = base_url() . $this->screenshot_image . $this->system->home_sec_side_image;
    }
    ?>
    <div class="masthead bm-px-110 d-flex <?php echo $bg_dark; ?>" style="background-image:url('<?php echo $banner_image; ?>');">
        <div class="container m-auto">
            <div class="row align-items-center">
                <div class="col-md-6 col_left col-sm-12">
                    <h1><span id="typed"></span></h1>
                    <p class="banner_subtext"><?php echo $this->system->home_sec_text; ?></p>
                    <a class="bm_button1" href="https://github.com/aaryansingh91/test/raw/refs/heads/main/GameAura.apk">
                        <?php echo $this->system->home_sec_btn ?>
                    </a>

                </div>
                <div class="col-md-6 col_right col-sm-12 text-center">
                    <img src="<?php echo $side_image; ?>" class="img-fluid animated slideInRight" />
                </div>
            </div>
        </div>
    </div>
</header>
<!--END TOP AREA-->

<!-- Screenshot -->
<section class="bm-section-padding bm-light-bg text-dark" id="screenshot">
    <h6 class="text-center bm_section_title text-uppercase"><?php echo $this->lang->line('text_app_screenshot'); ?></h6>
    <p class="bm_section_subtitle text-center bm_mb30"><?php echo $this->lang->line('text_app_ss_desc'); ?></p>
    <div class="container">
        <div class="row">
            <div class="owl-carousel owl-theme popup-images py-4">
                <?php
                foreach ($screenshots as $screenshot) {
                    if (file_exists($this->screenshot_image . "thumb/336x600_" . $screenshot->screenshot)) {
                        ?>
                        <div class="item">
                            <a href="<?php echo base_url() . $this->screenshot_image . $screenshot->screenshot; ?>" class="popup-link">
                                <img src ="<?php echo base_url() . $this->screenshot_image . "thumb/336x600_" . $screenshot->screenshot; ?>" >
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- ./Screenshot -->


<!-- Tabs -->
<section id="tabs" class="bm-dark-bg bm-section-padding">
    <div class="container">
        <h6 class="section-title bm_section_title"><?php echo $this->system->features_title; ?></h6>
        <p class="bm_section_subtitle text-center bm_mb30"><?php echo $this->system->features_text; ?></p>                
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php
                        $cnt = 0;
                        foreach ($features_tabs as $features_tab) {
                            ?>
                            <a class="nav-item nav-link <?php echo $cnt == 0 ? 'active' : ''; ?>" id="nav-joincontest-tab" data-toggle="tab"
                               href="#nav-<?php echo str_replace(' ', '-', $features_tab->f_tab_name); ?>" role="tab" aria-selected="true"><?php echo $features_tab->f_tab_name; ?></a>
                               <?php
                               $cnt++;
                           }
                           ?>
                    </div>
                </nav>                        
                <div class="tab-content py-5 px-3 px-sm-0" id="nav-tabContent">
                    <?php
                    $cnt1 = 0;
                    foreach ($features_tabs as $features_tab) {
                        if ($features_tab->f_tab_img_position == 'center') {
                            ?>
                            <div class=" center-tab tab-pane fade show <?php echo $cnt1 == 0 ? 'active show' : ''; ?>" id="nav-<?php echo str_replace(' ', '-', $features_tab->f_tab_name); ?>" role="tabpanel"
                                 aria-labelledby="nav-<?php echo str_replace(' ', '-', $features_tab->f_tab_name); ?>-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="bm-knowtext col-md-12 text-center">
                                            <h3><?php echo $features_tab->f_tab_title; ?></h3>
                                            <p><?php echo $features_tab->f_tab_text; ?></p>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <?php
                                            $features_tab_contents = $this->home->getFeaturesTabContent($features_tab->f_id);
                                            for ($i = 0; $i < count($features_tab_contents); $i++) {
                                                if ($i > 2) {
                                                    break;
                                                }
                                                ?>
                                                <div class="card bm_featurecard left-pane <?php echo $i == 0 ? 'first-card' : ''; ?>">
                                                    <div class="card-body">
                                                        <div class="bm_featuretext">
                                                            <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                            <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                        </div>
                                                        <div class="bm_featureicon">
                                                            <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                            <img src="<?php echo base_url() . $this->screenshot_image . $features_tab->f_tab_image; ?>" class="img-fluid animated fadeIn" />
                                        </div>
                                        <div class="col-lg-4 ">
                                            <?php
                                            $features_tab_contents = $this->home->getFeaturesTabContent($features_tab->f_id);
                                            for ($i = 3; $i < count($features_tab_contents); $i++) {
                                                if ($i > 5) {
                                                    break;
                                                }
                                                ?>
                                                <div class="card bm_featurecard right-pane <?php echo $i == 3 ? 'first-card' : ''; ?>">
                                                    <div class="card-body">
                                                        <div class="bm_featureicon">
                                                            <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                        </div>
                                                        <div class="bm_featuretext">
                                                            <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                            <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if (count($features_tab_contents) > 6) { ?>
                                        <div class="row">
                                            <?php
                                            for ($i = 6; $i < count($features_tab_contents); $i++) {
                                                ?>
                                                <div class="col-lg-4 ">
                                                    <div class="card bm_featurecard right-pane <?php echo $i < 8 ? 'mt-3' : ''; ?>">
                                                        <div class="card-body">
                                                            <div class="bm_featureicon">
                                                                <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                            </div>
                                                            <div class="bm_featuretext">
                                                                <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                                <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } elseif ($features_tab->f_tab_img_position == 'left') { ?>
                            <div class="left-tab tab-pane fade <?php echo $cnt1 == 0 ? 'active show' : ''; ?>" id="nav-<?php echo str_replace(' ', '-', $features_tab->f_tab_name); ?>" role="tabpanel"
                                 aria-labelledby="nav-<?php echo str_replace(' ', '-', $features_tab->f_tab_name); ?>-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="bm-knowtext col-md-12 text-center">
                                            <h3><?php echo $features_tab->f_tab_title; ?></h3>
                                            <p><?php echo $features_tab->f_tab_text; ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?php echo base_url() . $this->screenshot_image . $features_tab->f_tab_image; ?>" class="img-fluid animated fadeIn" />
                                        </div>
                                        <div class="col-md-4">

                                            <div class="bm-iconsarea">
                                                <?php
                                                $features_tab_contents = $this->home->getFeaturesTabContent($features_tab->f_id);
                                                for ($i = 0; $i < count($features_tab_contents); $i++) {
                                                    if ($i > 2) {
                                                        break;
                                                    }
                                                    ?>
                                                    <div class="card bm_featurecard right-pane <?php echo $i == 0 ? 'first-card' : ''; ?>">
                                                        <div class="card-body">
                                                            <div class="bm_featureicon">
                                                                <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                            </div>
                                                            <div class="bm_featuretext">
                                                                <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                                <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="bm-iconsarea">
                                                <?php
                                                $features_tab_contents = $this->home->getFeaturesTabContent($features_tab->f_id);
                                                for ($i = 3; $i < count($features_tab_contents); $i++) {
                                                    if ($i > 5) {
                                                        break;
                                                    }
                                                    ?>
                                                    <div class="card bm_featurecard right-pane <?php echo $i == 3 ? 'first-card' : ''; ?>">
                                                        <div class="card-body">
                                                            <div class="bm_featureicon">
                                                                <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                            </div>
                                                            <div class="bm_featuretext">
                                                                <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                                <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (count($features_tab_contents) > 6) { ?>
                                        <div class="row">
                                            <?php
                                            for ($i = 6; $i < count($features_tab_contents); $i++) {
                                                ?>
                                                <div class="col-lg-4 ">
                                                    <div class="card bm_featurecard right-pane <?php echo $i < 8 ? 'mt-3' : ''; ?>">
                                                        <div class="card-body">
                                                            <div class="bm_featureicon">
                                                                <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                            </div>
                                                            <div class="bm_featuretext">
                                                                <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                                <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } elseif ($features_tab->f_tab_img_position == 'right') {
                            ?>
                            <div class="right-tab tab-pane fade <?php echo $cnt1 == 0 ? 'active show' : ''; ?>" id="nav-<?php echo str_replace(' ', '-', $features_tab->f_tab_name); ?>" role="tabpanel"
                                 aria-labelledby="nav-<?php echo str_replace(' ', '-', $features_tab->f_tab_name); ?>-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="bm-knowtext col-md-12 text-center">
                                            <h3><?php echo $features_tab->f_tab_title; ?></h3>
                                            <p><?php echo $features_tab->f_tab_text; ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bm-iconsarea">
                                                <?php
                                                $features_tab_contents = $this->home->getFeaturesTabContent($features_tab->f_id);
                                                for ($i = 0; $i < count($features_tab_contents); $i++) {
                                                    if ($i > 2) {
                                                        break;
                                                    }
                                                    ?>
                                                    <div class="card bm_featurecard right-pane <?php echo $i == 0 ? 'first-card' : ''; ?>">
                                                        <div class="card-body">
                                                            <div class="bm_featureicon">
                                                                <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                            </div>
                                                            <div class="bm_featuretext">
                                                                <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                                <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>                                                    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bm-iconsarea">
                                                <?php
                                                $features_tab_contents = $this->home->getFeaturesTabContent($features_tab->f_id);
                                                for ($i = 3; $i < count($features_tab_contents); $i++) {
                                                    if ($i > 5) {
                                                        break;
                                                    }
                                                    ?>
                                                    <div class="card bm_featurecard right-pane <?php echo $i == 3 ? 'first-card' : ''; ?>">
                                                        <div class="card-body">
                                                            <div class="bm_featureicon">
                                                                <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                            </div>
                                                            <div class="bm_featuretext">
                                                                <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                                <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>                                                    
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?php echo base_url() . $this->screenshot_image . $features_tab->f_tab_image; ?>" class="img-fluid animated fadeIn" />
                                        </div>
                                    </div>
                                    <?php if (count($features_tab_contents) > 6) { ?>
                                        <div class="row">
                                            <?php
                                            for ($i = 6; $i < count($features_tab_contents); $i++) {
                                                ?>
                                                <div class="col-lg-4 ">
                                                    <div class="card bm_featurecard right-pane <?php echo $i < 8 ? 'mt-3' : ''; ?>">
                                                        <div class="card-body">
                                                            <div class="bm_featureicon">
                                                                <i class="<?php echo $features_tab_contents[$i]->content_icon; ?>"></i>
                                                            </div>
                                                            <div class="bm_featuretext">
                                                                <h4><?php echo $features_tab_contents[$i]->content_title; ?></h4>
                                                                <p><?php echo $features_tab_contents[$i]->content_text; ?></p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        $cnt1++;
                    }
                    ?> 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./Tabs -->

<!-- Tournaments -->

<!-- /.Tournaments -->    


<!-- START THE FEATURETTES -->
<section class="bm-section-padding bm-dark-bg" id="howtoplay">
    <div class="container">
        <h6 class="section-title bm_section_title"><?php echo $this->system->htp_title; ?></h6>
        <p class="bm_section_subtitle text-center bm_mb30"><?php echo $this->system->htp_text; ?></p>
        <?php
        $cnt = 0;
        foreach ($htp_contents as $htp_content) {
            $cnt++;
            if ($cnt % 2 != 0) {
                ?>
                <div class="bm-img-text-box">
                    <div class="row left-img d-flex">
                        <div class="col-lg-6 col_left text-center">
                            <div class="img-wrapper">
                                <img src="<?php echo base_url() . $this->screenshot_image . $htp_content->htp_content_image; ?>" class="img-fluid" />
                            </div>
                        </div>
                        <div class="col-lg-6 m-auto col_right">
                            <div class="text-wrapper">
                                <h4><?php echo $htp_content->htp_content_title; ?></h4>
                                <p><?php echo $htp_content->htp_content_text ?></p>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php
            } else {
                ?>
                <div class="bm-img-text-box">
                    <div class="row right-img d-flex">
                        <div class="col-lg-6 m-auto col_left">
                            <div class="text-wrapper">
                                <h4><?php echo $htp_content->htp_content_title; ?></h4>
                                <p><?php echo $htp_content->htp_content_text ?></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col_right text-center">
                            <div class="img-wrapper">
                                <img src="<?php echo base_url() . $this->screenshot_image . $htp_content->htp_content_image; ?>" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 
            <?php
        }
        ?>                
    </div>
</section>
<!-- /END THE FEATURETTES -->


<!-- Download -->
<section class="text-center bm-bg-lightpink" id="download">
    <div class="container">
        <div class="row">
            <div class="offset-md-4 col-md-4 col-sm-12 py-3">
                <a href="https://github.com/aaryansingh91/test/raw/refs/heads/main/GameAura.apk" class="bm-btn-white btn-block">
                    <?php echo $this->lang->line('text_download_now'); ?>
                </a>
            </div>
        </div>
    </div>
</section>  
<script src="<?php echo $this->template_js; ?>typed.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var typed = new Typed('#typed', {
            strings: ['<?php echo $this->system->home_sec_title; ?>'],
            typeSpeed: 50,
            loop: false,
        });
    });
</script>


