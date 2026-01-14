<?php

defined('BASEPATH') or exit('No direct script access allowed');
class CI_Controller
{
    private static $instance;
    public function __construct()
    {
        self::$instance =& $this;
        foreach (is_loaded() as $var => $class) {
            $this->{$var} =& load_class($class);
        }
        $this->load =& load_class('Loader', 'core');
        $this->load->initialize();
        $this->set_cookies();
        $this->path_to_view_admin = ADMINPATH . '/';
        $this->admin_js = base_url() . 'application/views/' . ADMINPATH . '/js/';
        $this->admin_img = base_url() . 'application/views/' . ADMINPATH . '/images/';
        $this->admin_css = base_url() . 'application/views/' . ADMINPATH . '/css/';
        $this->admin_fonts = base_url() . 'application/views/' . ADMINPATH . '/fonts/';
        $this->js = base_url() . 'application/views/' . ADMINPATH . '/js/';
        $this->path_to_view_front = 'themes/' . $this->system->template . '/';
        $this->template_js = base_url() . 'application/views/themes/' . $this->system->template . '/assest/js/';
        $this->template_img = base_url() . 'application/views/themes/' . $this->system->template . '/assest/img/';
        $this->template_css = base_url() . 'application/views/themes/' . $this->system->template . '/assest/css/';
        $this->template_fonts = base_url() . 'application/views/themes/' . $this->system->template . '/assest/fonts/';
        $this->screenshot_image = $this->system->admin_photo . '/screenshot_image/';
        $this->download_image = $this->system->admin_photo . '/download_image/';
        $this->match_banner_image = $this->system->admin_photo . '/match_banner_image/';
        $this->game_image = $this->system->admin_photo . '/game_image/';
        $this->game_logo_image = $this->system->admin_photo . '/game_logo_image/';
        $this->company_image = $this->system->admin_photo . '/company_image/';
        $this->company_favicon = $this->system->admin_photo . '/company_favicon/';
        $this->page_banner = $this->system->admin_photo . '/page_banner/';
        $this->notification_image = $this->system->admin_photo . '/notification_image/';
        $this->select_image = $this->system->admin_photo . '/select_image/';
        $this->lottery_image = $this->system->admin_photo . '/lottery_image/';
        $this->product_image = $this->system->admin_photo . '/product_image/';
        $this->slider_image = $this->system->admin_photo . '/slider_image/';
        $this->banner_image = $this->system->admin_photo . '/banner_image/';
        $this->profile_image = $this->system->admin_photo . '/profile_image/';
        $this->apk = $this->system->admin_photo . '/apk/';
        $this->telegram_support_image = $this->system->admin_photo . '/telegram_support_image/';
        date_default_timezone_set($this->system->timezone);
        log_message('info', 'Controller Class Initialized');
    }
    public static function &get_instance()
    {
        return self::$instance;
    }
    public static function &set_cookies()
    {
        $CI =& get_instance();
        return $CI;
    }
}