<!--====== USEFULL META ======-->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $meta_description; ?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />

<!--====== TITLE TAG ======-->
<title><?php
    if (isset($title)) {
        echo $title . " | " . $this->system->company_name;
    } else {
        echo $this->system->company_name;
    }
    ?></title>

<!--====== FAVICON ICON =======-->
<link rel="shortcut icon" type="image/ico" href="<?php echo base_url() . $this->company_favicon . "thumb/40x40_" . $this->system->company_favicon ?>" />

<!--====== STYLESHEETS ======-->
<!--link href="<?php //echo $this->template_css; ?>bootstrap.min.css" rel="stylesheet"-->
<!--link href="<?php //echo $this->template_css; ?>animate.min.css" rel="stylesheet"-->
<!--link href="<?php //echo $this->template_css; ?>fontawesome/css/font-awesome.min.css" rel="stylesheet"-->
<!--link href="<?php //echo $this->template_css; ?>owl.carousel.min.css" rel="stylesheet"-->
<!--link href="<?php //echo $this->template_css; ?>owl.theme.default.min.css" rel="stylesheet" -->
<!--link href="<?php //echo $this->template_css; ?>magnific-popup.min.css" rel="stylesheet"-->

<?php
    if($this->session->userdata('site_lang') && in_array($this->session->userdata('site_lang'),json_decode($this->system->rtl_supported_language,true))) {        
?>
    <link href="<?php echo $this->template_css; ?>bootstrap_rtl.min.css" rel="stylesheet">    
<?php  
    } else {
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<?php     
    }
?>

<link href="<?php echo $this->template_css; ?>animate.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">

<!--====== MAIN STYLESHEETS ======-->
<link href="<?php echo $this->template_css; ?>style.min.css" rel="stylesheet">

<?php if ($this->system->google_analytics == 'yes') { ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $this->system->google_analytics_code; ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', '<?php echo $this->system->google_analytics_code; ?>');
    </script>
<?php } ?>