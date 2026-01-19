<?php
class Wallet_offer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'wallet_offers';
    }

    public function get_list_count_wallet_offer() {
        $this->db->select('*');
        $this->db->order_by("id", "Desc");
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function insert() {
        $data = array(
            'offer_amount' => $this->input->post('offer_amount'),
            'extra_coins' => $this->input->post('extra_coins'),
            'is_best_deal' => ($this->input->post('is_best_deal')) ? 1 : 0,
            'status' => '1',
            'created_at' => date('Y-m-d H:i:s')
        );
        return $this->db->insert($this->table, $data);
    }

    public function update() {
        $data = array(
            'offer_amount' => $this->input->post('offer_amount'),
            'extra_coins' => $this->input->post('extra_coins'),
            'is_best_deal' => ($this->input->post('is_best_deal')) ? 1 : 0,
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update($this->table, $data);
    }

    public function getWalletOfferById($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function changePublishStatus() {
        $this->db->set('status', $this->input->post('publish'));
        $this->db->where('id', $this->input->post('offerid'));
        return $this->db->update($this->table);
    }

    public function delete() {
        $this->db->where('id', $this->input->post('offerid'));
        return $this->db->delete($this->table);
    }

    public function multiDelete() {
        foreach ($this->input->post('ids') as $key => $id) {
            $this->db->where('id', $id);
            $this->db->delete($this->table);
        }
        return true;
    }

    public function changeMultiPublishStatus() {
        foreach ($this->input->post('ids') as $key => $id) {
            $data = $this->getWalletOfferById($id);
            if ($data['status'] == '0')
                $status = '1';
            else
                $status = '0';

            $this->db->set('status', $status);
            $this->db->where('id', $id);
            $this->db->update($this->table);
        }
        return true;
    }
}
