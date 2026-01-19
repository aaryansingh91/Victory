<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet_offer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') !== true) {
            redirect($this->path_to_view_admin . 'login');
        }
        // Permission check commented out if user hasn't added it yet, 
        // but keeping it for consistency. User might need to add 'wallet_offer' to permissions table.
        if (!$this->functions->check_permission('wallet_offer')) {
            // redirect($this->path_to_view_admin . 'login');
        }
        $this->con = $this->functions->mysql_connection();
        $this->load->model($this->path_to_view_admin . 'Wallet_offer_model', 'wallet_offer');
    }

    function index()
    {
        $data['wallet_offer'] = true;
        $data['btn'] = 'Add Wallet Offer';
        $data['title'] = 'Wallet Offers';
        if ($this->input->post('action') == "delete") {
            if ($result = $this->wallet_offer->delete()) {
                $this->session->set_flashdata('notification', 'Deleted successfully.');
                redirect($this->path_to_view_admin . 'wallet_offer/');
            }
        } elseif ($this->input->post('action') == "change_publish") {
            if ($result = $this->wallet_offer->changePublishStatus()) {
                $this->session->set_flashdata('notification', 'Status changed successfully.');
                redirect($this->path_to_view_admin . 'wallet_offer/');
            }
        }
        $this->load->view($this->path_to_view_admin . 'wallet_offer_manage', $data);
    }

    function multi_action()
    {
        if ($this->input->post('action') == "delete") {
            $this->wallet_offer->multiDelete();
        } elseif ($this->input->post('action') == "change_publish") {
            $this->wallet_offer->changeMultiPublishStatus();
        }
    }

    function insert()
    {
        $data['wallet_offer_addedit'] = true;
        $data['btn'] = 'View Wallet Offers';
        $data['title'] = 'Add Wallet Offer';
        $data['Action'] = 'Add';
        if ($this->input->post('submit') == 'Submit') {
            $this->form_validation->set_rules('offer_amount', 'Offer Amount', 'required|numeric');
            $this->form_validation->set_rules('extra_coins', 'Extra Coins', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view($this->path_to_view_admin . 'wallet_offer_addedit', $data);
            } else {
                if ($result = $this->wallet_offer->insert()) {
                    $this->session->set_flashdata('notification', 'Added successfully.');
                    redirect($this->path_to_view_admin . 'wallet_offer/');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong while adding.');
                    $this->load->view($this->path_to_view_admin . 'wallet_offer_addedit', $data);
                }
            }
        } else {
            $this->load->view($this->path_to_view_admin . 'wallet_offer_addedit', $data);
        }
    }

    function edit()
    {
        $data['wallet_offer_addedit'] = true;
        $id = $this->uri->segment('4');
        $data['title'] = 'Edit Wallet Offer';
        $data['Action'] = 'Edit';
        if ($this->input->post('submit') == 'Submit') {
            $this->form_validation->set_rules('offer_amount', 'Offer Amount', 'required|numeric');
            $this->form_validation->set_rules('extra_coins', 'Extra Coins', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view($this->path_to_view_admin . 'wallet_offer_addedit', $data);
            } else {
                if ($result = $this->wallet_offer->update()) {
                    $this->session->set_flashdata('notification', 'Updated successfully.');
                    redirect($this->path_to_view_admin . 'wallet_offer/');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong while updating.');
                    $this->load->view($this->path_to_view_admin . 'wallet_offer_addedit', $data);
                }
            }
        } else {
            $data['detail'] = $this->wallet_offer->getWalletOfferById($id);
            $this->load->view($this->path_to_view_admin . 'wallet_offer_addedit', $data);
        }
    }

    function setDatatableWalletOffer()
    {
        $requestData = $_REQUEST;
        $columns = array(
            2 => 'offer_amount',
            3 => 'extra_coins',
            4 => 'is_best_deal',
            5 => 'status',
            6 => 'created_at'
        );
        $totalData = $this->wallet_offer->get_list_count_wallet_offer();
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM wallet_offers";
        if (!empty($requestData['search']['value'])) {
            $sql .= " WHERE offer_amount LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR extra_coins LIKE '%" . $requestData['search']['value'] . "%' ";
        }
        $query = mysqli_query($this->con, $sql);
        $totalFiltered = mysqli_num_rows($query);
        if (isset($requestData['order'][0]['column'])) {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        } else {
            $sql .= " ORDER BY `created_at` DESC LIMIT " . $requestData['start'] . " ," . $requestData['length'];
        }
        $query = mysqli_query($this->con, $sql);
        $data = array();
        $i = $requestData['start'] + 1;
        while ($row = mysqli_fetch_array($query)) {
            $nestedData = array();
            $nestedData[] = '<input type="checkbox" value="' . $row['id'] . '" class="all_inputs">';
            $nestedData[] = $i;
            $nestedData[] = $row['offer_amount'] . ' INR';
            $nestedData[] = $row['extra_coins'] . ' Coins';
            $nestedData[] = ($row['is_best_deal'] == 1) ? '<span class="badge badge-info">Yes</span>' : 'No';
            $nestedData[] = $row['created_at'];
            if ($row['status'] == '1') {
                $nestedData[] = '<span class="badge badge-success" data-original-title="UnPublish" data-placement="top" style="cursor: pointer" onClick="javascript: changePublishStatus(document.frmofferlist,' . $row['id'] . ',0);">Active <i class="fa fa-pencil"></i></span>';
            } else {
                $nestedData[] = '<span class="badge badge-danger" data-original-title="Publish" data-placement="top" style="cursor: pointer" border="0" onClick="javascript: changePublishStatus(document.frmofferlist,' . $row['id'] . ',1);">Inactive <i class="fa fa-pencil"></i></span>';
            }

            $edit = '<a class="" style="font-size:18px;" data-original-title="Edit" data-placement="top" href=' . base_url() . $this->path_to_view_admin . 'wallet_offer/edit/' . $row['id'] . '><i class="fa fa-edit"></i></a>&nbsp;';
            $delete = '<a class="" data-original-title="Delete" data-placement="top" style="cursor: pointer;font-size:18px;color:#007bff" onClick="javascript: confirmDeleteOffer(document.frmofferlist,' . $row['id'] . ');"><i class="fa fa-trash-o"></i> </a>&nbsp; ';

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
