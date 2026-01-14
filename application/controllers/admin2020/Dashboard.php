<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // if (YES != 'yes') {
        //     redirect($this->path_to_view_admin . 'license');
        // }
        if ($this->session->userdata('logged_in') !== true) {
            redirect($this->path_to_view_admin . 'login');
        }
        $this->load->model($this->path_to_view_admin . 'Dashboard_model', 'dashboard');
    }
    
    public function index() {
        $data['breadcrumb_title'] = $this->lang->line('text_dashboard');
        $data['title'] = $this->lang->line('text_dashboard');
        
        // Always show total users and total matches
        $data['tot_member'] = $this->dashboard->get_tot_member();
        $data['tot_match'] = $this->dashboard->get_tot_match();
        
        // Check if user has permission to view all stats
        $data['show_all_stats'] = $this->functions->check_permission('show_all_stats');
        
        // Only load earning-related data if user has permission
        if ($data['show_all_stats']) {
            $data['tot_payment'] = $this->dashboard->get_total_received_payment();
            $data['tot_withdraw'] = $this->dashboard->get_total_withdraw();
            $data['tot_day_wise'] = $this->dashboard->get_day_wise_income();
            $data['tot_week_wise'] = $this->dashboard->get_week_wise_income();
            $data['tot_month_wise'] = $this->dashboard->get_month_wise_income();
            $data['tot_year_wise'] = $this->dashboard->get_year_wise_income();
            $data['total_lottery'] = $this->dashboard->get_total_lottery();
            $data['per_day_lottery'] = $this->dashboard->get_per_day_lottery();
            $data['per_week_lottery'] = $this->dashboard->get_per_week_lottery();
            $data['per_month_lottery'] = $this->dashboard->get_per_month_lottery();
            $data['year_lottery'] = $this->dashboard->get_year_lottery();
            $data['total_match'] = $this->dashboard->get_total_match();
            $data['per_day_match'] = $this->dashboard->get_per_day_match();
            $data['per_week_match'] = $this->dashboard->get_per_week_match();
            $data['per_month_match'] = $this->dashboard->get_per_month_match();
            $data['year_match'] = $this->dashboard->get_year_match();
            $data['total_ludo'] = $this->dashboard->get_total_ludo();
            $data['per_day_ludo'] = $this->dashboard->get_per_day_ludo();
            $data['per_week_ludo'] = $this->dashboard->get_per_week_ludo();
            $data['per_month_ludo'] = $this->dashboard->get_per_month_ludo();
            $data['year_ludo'] = $this->dashboard->get_year_ludo();
        }
        
        $this->load->view($this->path_to_view_admin . 'dashboard', $data);
    }
}