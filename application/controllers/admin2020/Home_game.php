<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_game extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') !== true) {
            redirect($this->path_to_view_admin . 'login');
        }
        if (!$this->functions->check_permission('game')) {
            redirect($this->path_to_view_admin . 'login');
        }
        $this->con = $this->functions->mysql_connection();
        $this->load->library('upload');
        $this->load->helper('file');
        $this->load->library('image');

        $this->load->model($this->path_to_view_admin . 'Home_game_model', 'home_game');

        $this->game_image = 'uploads/game_image/';
        $this->game_logo_image = 'uploads/game_logo/';
    }

    function index()
    {
        $data['home_game'] = true;
        $data['btn'] = $this->lang->line('text_add_game');
        $data['title'] = $this->lang->line('text_game');
        if ($this->input->post('action') == "delete") {
            if (!$this->functions->check_permission('game_delete')) {
                $this->session->set_flashdata('error', $this->lang->line('text_err_delete_game'));
                redirect($this->path_to_view_admin . 'home_game/');
            } else {
                if ($result = $this->home_game->delete()) {
                    $this->session->set_flashdata('notification', $this->lang->line('text_succ_delete_game'));
                    redirect($this->path_to_view_admin . 'home_game/');
                }
            }
        } elseif ($this->input->post('action') == "change_publish") {
            if ($result = $this->home_game->changePublishStatus()) {
                $this->session->set_flashdata('notification', $this->lang->line('text_succ_status_game'));
                redirect($this->path_to_view_admin . 'home_game/');
            }
        }
        $data['game_data'] = $this->home_game->game_data();
        $this->load->view($this->path_to_view_admin . 'home_game_manage', $data);
    }

    function multi_action()
    {

        if ($this->input->post('action') == "delete") {
            if (!$this->functions->check_permission('game_delete')) {
                echo $this->lang->line('text_err_delete_game');
            } else {
                $this->home_game->multiDelete();
            }
        } elseif ($this->input->post('action') == "change_publish") {
            if (!$this->functions->check_permission('game')) {
                echo $this->lang->line('text_err_status');
            } else {
                $this->home_game->changeMultiPublishStatus();
            }
        }
    }

    function setDatatableGame()
    {
        $requestData = $_REQUEST;
        $columns = array(
            2 => 'game_name',
            3 => 'game_image',
            4 => 'status',
        );
        $totalData = $this->home_game->get_list_count_game();
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM home_game";
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql .= " WHERE  game_id LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR  game_name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR  game_image LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR  status LIKE '%" . $requestData['search']['value'] . "%' ";
        }
        $query = mysqli_query($this->con, $sql);
        $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        if (isset($requestData['order'][0]['column'])) {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        } else {
            $sql .= " ORDER BY `game_id` DESC LIMIT " . $requestData['start'] . " ," . $requestData['length'];
        }
        $query = mysqli_query($this->con, $sql);
        $data = array();
        $i = $requestData['start'] + 1;
        while ($row = mysqli_fetch_array($query)) {
            $nestedData = array();
            $nestedData[] = '<input type="checkbox" value="' . $row['game_id'] . '" class="all_inputs">';
            $nestedData[] = $i;
            $nestedData[] = $row['game_name'];

            $nestedData[] = '<img src="' . base_url() . $this->game_image . "thumb/100x100_" . $row['game_image'] . '">';

            if ($row['status'] == '1') {
                $nestedData[] = '<span class="badge badge-success" data-original-title="UnPublish" data-placement="top"   style="cursor: pointer" onClick="javascript: changePublishStatus(document.frmgamelist,' . $row['game_id'] . ',0);">Active</span>';
            } else {
                $nestedData[] = '<span class="badge badge-danger" data-original-title="Publish" data-placement="top"   style="cursor: pointer" border="0" onClick="javascript: changePublishStatus(document.frmgamelist,' . $row['game_id'] . ',1);">Inactive</span>';
            }

            $edit = '<a class="" style="font-size:18px;" data-original-title="Edit" data-placement="top"  href=' . base_url() . $this->path_to_view_admin . 'home_game/edit/' . $row['game_id'] . '><i class="fa fa-edit"></i></a>&nbsp;';

            $delete = '<a class="" data-original-title="Delete" data-placement="top"  style="cursor: pointer;font-size:18px;color:#007bff" onClick="javascript: confirmDeleteGame(document.frmgamelist,' . $row['game_id'] . ');"><i class="fa fa-trash-o"></i> </a>&nbsp; ';

            $nestedData[] = $edit . $delete;
            $data[] = $nestedData;
            $i++;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($json_data);
        exit;
    }

    public function file_check()
    {
        $allowed_mime_type_arr = array('image/jpeg', 'image/png');
        if (isset($_FILES['game_image']['name']) && $_FILES['game_image']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['game_image']['name']);
            if (!in_array($mime, $allowed_mime_type_arr)) {
                $this->form_validation->set_message('file_check', $this->lang->line('err_image_accept'));
                return false;
            } else if ($_FILES["game_image"]["size"] > 2000000) {
                $this->form_validation->set_message('file_check', $this->lang->line('err_image_size'));
                return false;
            } else {
                return true;
            }
        }
    }

    function insert()
    {
        $data['home_game'] = true;
        $data['btn'] = $this->lang->line('text_view_game');
        $data['Action'] = $this->lang->line('text_action_add');
        $data['title'] = $this->lang->line('text_add_game');
        if ($this->input->post('submit') == $this->lang->line('text_btn_submit')) {

            $data['game_name'] = $this->input->post('game_name');

            $this->form_validation->set_rules('game_image', 'lang:text_image', 'callback_file_check', array('required' => $this->lang->line('err_image_req')));
            $this->form_validation->set_rules('game_name', 'lang:text_game_name', 'required', array('required' => $this->lang->line('err_game_name_req')));

            if ($this->form_validation->run() == FALSE) {
                $this->load->view($this->path_to_view_admin . 'home_game_addedit', $data);
            } else {
                if ($result = $this->home_game->insert()) {
                    $this->session->set_flashdata('notification', $this->lang->line('text_succ_add_game'));
                    redirect($this->path_to_view_admin . 'home_game/');
                } else {
                    $this->load->view($this->path_to_view_admin . 'home_game_addedit', $data);
                }
            }
        } else {
            $this->load->view($this->path_to_view_admin . 'home_game_addedit', $data);
        }
    }

    function edit()
    {

        if (!$this->functions->check_permission('game_edit')) {
            $this->session->set_flashdata('error', $this->lang->line('text_err_edit_game'));
            redirect($this->path_to_view_admin . 'home_game');
        }

        $data['home_game'] = true;
        $game_id = $this->uri->segment('4');
        $data['Action'] = $this->lang->line('text_action_edit');
        $data['title'] = $this->lang->line('text_edit_game');
        if ($this->input->post('submit') == $this->lang->line('text_btn_submit')) {

            $data['game_name'] = $this->input->post('game_name');

            $this->form_validation->set_rules('game_image', 'lang:text_image', 'callback_file_check');
            $this->form_validation->set_rules('game_name', 'lang:text_game_name', 'required', array('required' => $this->lang->line('err_game_name_req')));

            if ($this->form_validation->run() == FALSE) {
                $this->load->view($this->path_to_view_admin . 'home_game_addedit', $data);
            } else {
                if ($result = $this->home_game->update()) {
                    $this->session->set_flashdata('notification', $this->lang->line('text_succ_edit_game'));
                    redirect($this->path_to_view_admin . 'home_game/');
                } else {
                    $this->load->view($this->path_to_view_admin . 'home_game_addedit', $data);
                }
            }
        } else {
            $data['game_detail'] = $this->home_game->getgameById($game_id);
            $this->load->view($this->path_to_view_admin . 'home_game_addedit', $data);
        }
    }

}
