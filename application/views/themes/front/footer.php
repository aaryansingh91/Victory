<!--====== SCRIPTS JS ======-->
<!--script src="<?php //echo $this->template_js; ?>jquery-3.4.1.min.js"></script-->
<!--script src="<?php //echo $this->template_js; ?>jquery.validate.min.js"></script-->
<!--script src="<?php //echo $this->template_js; ?>bootstrap.min.js"></script-->
<!--script src="<?php //echo $this->template_js; ?>owl.carousel.min.js"></script-->
<!--script src="<?php //echo $this->template_js; ?>jquery.magnific-popup.min.js"></script-->
<!--script src="<?php //echo $this->template_js; ?>custom.js"></script-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.7.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            <?php
                if($this->session->userdata('site_lang') && in_array($this->session->userdata('site_lang'),json_decode($this->system->rtl_supported_language,true))) {
            ?>
            rtl:true,
            <?php
                } else {
            ?>
            rtl:false,
            <?php
                }
            ?>
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 20
                }
            }
        });
        $('.popup-link').magnificPopup({
            removalDelay: 300,
            type: 'image',
            callbacks: {
                beforeOpen: function () {
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure ' + this.st.el.attr('data-effect'));
                },
                beforeClose: function () {
                    $('.mfp-figure').addClass('fadeOut');
                }
            },
            gallery: {
                enabled: true //enable gallery mode
            }
        });
        
        $("#contact-form1").validate({
            rules: {
                'fname': {
                    required: true,
                },
                'email': {
                    required: true,
                },
                'subject': {
                    required: true,
                },
                'message': {
                    required: true,
                }
            },
            messages: {
                'fname': {
                    required: '<?php echo $this->lang->line('err_fname_req'); ?>',
                },
                'email': {
                    required: '<?php echo $this->lang->line('err_email_req'); ?>',
                },
                'subject': {
                    required: '<?php echo $this->lang->line('err_subject_req'); ?>',
                },
                'message': {
                    required: '<?php echo $this->lang->line('err_message_req'); ?>',
                }
            },
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            },
        });
    });
    
    $(document).on('submit', '#contact-form', function () {
        $.ajax({
            url: '<?php echo base_url(); ?>page/contact',
            type: 'post',
            data: $(this).serialize(),
            success: function (data) {
                console.log(data);

                if (data)
                {
                    $("#success").html('<div class="alert alert-success"><?php echo $this->lang->line('text_succ_msg');?></div>');
                    $('#fname').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    $('#subject').val('');
                    $('#msg').val('');
                } else {
                    $('#success').html('<div class="alert alert-danger"><?php echo $this->lang->line('text_err_msg');?></div>');
                }
            }
        });
        return false;
    });
</script>
<?php 
    if($this->system->footer_script != '') {
        echo $this->system->footer_script;
    }
?>