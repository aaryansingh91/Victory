<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Telegram_support extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper('file');
        $this->load->library('image');
        if ($this->session->userdata('logged_in') !== true) {
            redirect($this->path_to_view_admin . 'login');
        }
        if (!$this->functions->check_permission('telegram_support')) {
            redirect($this->path_to_view_admin . 'login');
        }
        $this->con = $this->functions->mysql_connection();
        $this->load->model($this->path_to_view_admin . 'Telegram_support_model', 'telegram_support');
    }

    function index()
    {
        $data['telegram_support'] = true;
        $data['btn'] = 'Add Telegram Support';
        $data['title'] = 'Telegram Support';
        if ($this->input->post('action') == "delete") {
            if (!$this->functions->check_permission('telegram_support_delete')) {
                $this->session->set_flashdata('error', 'You do not have permission to delete.');
                redirect($this->path_to_view_admin . 'telegram_support/');
            } else {
                if ($result = $this->telegram_support->delete()) {
                    $this->session->set_flashdata('notification', 'Deleted successfully.');
                    redirect($this->path_to_view_admin . 'telegram_support/');
                }
            }
        } elseif ($this->input->post('action') == "change_publish") {
            if ($result = $this->telegram_support->changePublishStatus()) {
                $this->session->set_flashdata('notification', 'Status changed successfully.');
                redirect($this->path_to_view_admin . 'telegram_support/');
            }
        }
        $this->load->view($this->path_to_view_admin . 'telegram_support_manage', $data);
    }

    function multi_action()
    {
        if ($this->input->post('action') == "delete") {
            if (!$this->functions->check_permission('telegram_support_delete')) {
                echo 'You do not have permission to delete.';
            } else {
                $this->telegram_support->multiDelete();
            }
        } elseif ($this->input->post('action') == "change_publish") {
            $this->telegram_support->changeMultiPublishStatus();
        }
    }

    function insert()
    {
        $data['telegram_support_addedit'] = true;
        $data['btn'] = 'View Telegram Support';
        $data['title'] = 'Add Telegram Support';
        $data['Action'] = 'Add';
        if ($this->input->post('submit') == 'Submit') {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required|valid_url');
            $this->form_validation->set_rules('image', 'Image', 'callback_file_check');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view($this->path_to_view_admin . 'telegram_support_addedit', $data);
            } else {
                if ($result = $this->telegram_support->insert()) {
                    $this->session->set_flashdata('notification', 'Added successfully.');
                    redirect($this->path_to_view_admin . 'telegram_support/');
                } else {
                    $upload_error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something went wrong while adding. ' . $upload_error);
                    $this->load->view($this->path_to_view_admin . 'telegram_support_addedit', $data);
                }
            }
        } else {
            $this->load->view($this->path_to_view_admin . 'telegram_support_addedit', $data);
        }
    }

    function edit()
    {
        if (!$this->functions->check_permission('telegram_support_edit')) {
            $this->session->set_flashdata('error', 'You do not have permission to edit.');
            redirect($this->path_to_view_admin . 'telegram_support');
        }

        $data['telegram_support_addedit'] = true;
        $id = $this->uri->segment('4');
        $data['title'] = 'Edit Telegram Support';
        $data['Action'] = 'Edit';
        if ($this->input->post('submit') == 'Submit') {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required|valid_url');
            $this->form_validation->set_rules('image', 'Image', 'callback_file_check');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view($this->path_to_view_admin . 'telegram_support_addedit', $data);
            } else {
                if ($result = $this->telegram_support->update()) {
                    $this->session->set_flashdata('notification', 'Updated successfully.');
                    redirect($this->path_to_view_admin . 'telegram_support/');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong while updating.');
                    $this->load->view($this->path_to_view_admin . 'telegram_support_addedit', $data);
                }
            }
        } else {
            $data['detail'] = $this->telegram_support->getTelegramSupportById($id);
            $this->load->view($this->path_to_view_admin . 'telegram_support_addedit', $data);
        }
    }

    public function file_check()
    {
        $allowed_mime_type_arr = array('image/jpeg', 'image/png');
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['image']['name']);
            if (!in_array($mime, $allowed_mime_type_arr)) {
                $this->form_validation->set_message('file_check', 'Please select only jpg/png file.');
                return false;
            } else if ($_FILES["image"]["size"] > 2000000) {
                $this->form_validation->set_message('file_check', 'Image size should be less than 2MB.');
                return false;
            } else {
                return true;
            }
        }
        return true;
    }

    function setDatatableTelegramSupport()
    {
        $requestData = $_REQUEST;
        $columns = array(
            2 => 'name',
            3 => 'image',
            4 => 'url',
            5 => 'status',
            6 => 'date_created'
        );
        $totalData = $this->telegram_support->get_list_count_telegram_support();
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM telegram_support";
        if (!empty($requestData['search']['value'])) {
            $sql .= " WHERE name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR url LIKE '%" . $requestData['search']['value'] . "%' ";
        }
        $query = mysqli_query($this->con, $sql);
        $totalFiltered = mysqli_num_rows($query);
        if (isset($requestData['order'][0]['column'])) {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        } else {
            $sql .= " ORDER BY `date_created` DESC LIMIT " . $requestData['start'] . " ," . $requestData['length'];
        }
        $query = mysqli_query($this->con, $sql);
        $data = array();
        $i = $requestData['start'] + 1;
        while ($row = mysqli_fetch_array($query)) {
            $nestedData = array();
            $nestedData[] = '<input type="checkbox" value="' . $row['telegram_support_id'] . '" class="all_inputs">';
            $nestedData[] = $i;
            $nestedData[] = $row['name'];
            if ($row['image'] != '') {
                $nestedData[] = '<img src="' . base_url() . $this->telegram_support_image . "thumb/100x100_" . $row['image'] . '">';
            } else {
                $nestedData[] = '';
            }
            $nestedData[] = $row['url'];
            $nestedData[] = $row['date_created'];
            if ($row['status'] == '1') {
                $nestedData[] = '<span class="badge badge-success" data-original-title="UnPublish" data-placement="top" style="cursor: pointer" onClick="javascript: changePublishStatus(document.frmtelegramlist,' . $row['telegram_support_id'] . ',0);">Active <i class="fa fa-pencil"></i></span>';
            } else {
                $nestedData[] = '<span class="badge badge-danger" data-original-title="Publish" data-placement="top" style="cursor: pointer" border="0" onClick="javascript: changePublishStatus(document.frmtelegramlist,' . $row['telegram_support_id'] . ',1);">Inactive <i class="fa fa-pencil"></i></span>';
            }

            $edit = '<a class="" style="font-size:18px;" data-original-title="Edit" data-placement="top" href=' . base_url() . $this->path_to_view_admin . 'telegram_support/edit/' . $row['telegram_support_id'] . '><i class="fa fa-edit"></i></a>&nbsp;';
            $delete = '<a class="" data-original-title="Delete" data-placement="top" style="cursor: pointer;font-size:18px;color:#007bff" onClick="javascript: confirmDeleteTelegram(document.frmtelegramlist,' . $row['telegram_support_id'] . ');"><i class="fa fa-trash-o"></i> </a>&nbsp; ';

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
        echo json_encode($json_data);
    }

}
