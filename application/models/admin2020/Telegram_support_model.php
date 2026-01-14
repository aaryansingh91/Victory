<?php

class Telegram_support_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->img_size_array = array(100 => 100);
        $this->table = 'telegram_support';
    }

    public function get_list_count_telegram_support()
    {
        $this->db->select('*');
        $this->db->order_by("telegram_support_id", "Desc");
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function insert()
    {
        $thumb_sizes = $this->img_size_array;
        if ($_FILES['image']['name'] == "") {
            $image = "";
        } else {
            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image = $unique . '_' . preg_replace("/\s+/", "_", $_FILES['image']['name']);
            $config['file_name'] = $image;
            $upload_path = (isset($this->telegram_support_image) && !empty($this->telegram_support_image)) ? $this->telegram_support_image : 'uploads/telegram_support_image/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                log_message('error', 'Telegram Support Upload Error: ' . $this->upload->display_errors());
                return false;
            } else {
                foreach ($thumb_sizes as $key => $val) {
                    if (file_exists($upload_path . $image)) {
                        $this->image->initialize($upload_path . $image);
                        $this->image->resize($key, $val);
                        $this->image->save($upload_path . "thumb/" . $key . "x" . $val . "_" . $image);
                    } else {
                        log_message('error', 'Telegram Support Image File Not Found: ' . $upload_path . $image);
                    }
                }
            }
        }
        $data = array(
            'image' => $image,
            'name' => $this->input->post('name'),
            'url' => $this->input->post('url'),
            'status' => '1',
            'date_created' => date('Y-m-d H:i:s')
        );
        if ($this->db->insert($this->table, $data)) {
            return true;
        } else {
            $error = $this->db->error();
            log_message('error', 'Telegram Support Database Insert Error: ' . json_encode($error));
            return false;
        }
    }

    public function update()
    {
        $thumb_sizes = $this->img_size_array;
        if ($_FILES['image']['name'] == "") {
            $image = $this->input->post('old_image');
        } else {
            if (file_exists($this->telegram_support_image . $this->input->post('old_image'))) {
                @unlink($this->telegram_support_image . $this->input->post('old_image'));
            }
            foreach ($thumb_sizes as $width => $height) {
                if (file_exists($this->telegram_support_image . "thumb/" . $width . "x" . $height . "_" . $this->input->post('old_image'))) {
                    @unlink($this->telegram_support_image . "thumb/" . $width . "x" . $height . "_" . $this->input->post('old_image'));
                }
            }
            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image = $unique . '_' . preg_replace("/\s+/", "_", $_FILES['image']['name']);
            $config['file_name'] = $image;
            $upload_path = (isset($this->telegram_support_image) && !empty($this->telegram_support_image)) ? $this->telegram_support_image : 'uploads/telegram_support_image/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                log_message('error', 'Telegram Support Update Upload Error: ' . $this->upload->display_errors());
                return false;
            } else {
                foreach ($thumb_sizes as $key => $val) {
                    if (file_exists($upload_path . $image)) {
                        $this->image->initialize($upload_path . $image);
                        $this->image->resize($key, $val);
                        $this->image->save($upload_path . "thumb/" . $key . "x" . $val . "_" . $image);
                    } else {
                        log_message('error', 'Telegram Support Update Image File Not Found: ' . $upload_path . $image);
                    }
                }
            }
        }

        $data = array(
            'image' => $image,
            'name' => $this->input->post('name'),
            'url' => $this->input->post('url'),
        );
        $this->db->where('telegram_support_id', $this->input->post('telegram_support_id'));
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getTelegramSupportById($id)
    {
        $this->db->select('*');
        $this->db->where('telegram_support_id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function changePublishStatus()
    {
        $this->db->set('status', $this->input->post('publish'));
        $this->db->where('telegram_support_id', $this->input->post('telegramid'));
        if ($query = $this->db->update($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $thumb_sizes = $this->img_size_array;
        $data = $this->getTelegramSupportById($this->input->post('telegramid'));
        $upload_path = (isset($this->telegram_support_image) && !empty($this->telegram_support_image)) ? $this->telegram_support_image : 'uploads/telegram_support_image/';
        if (file_exists($upload_path . $data['image'])) {
            @unlink($upload_path . $data['image']);
        }
        foreach ($thumb_sizes as $width => $height) {
            if (file_exists($upload_path . "thumb/" . $width . "x" . $height . "_" . $data['image'])) {
                @unlink($upload_path . "thumb/" . $width . "x" . $height . "_" . $data['image']);
            }
        }
        $this->db->where('telegram_support_id', $this->input->post('telegramid'));

        if ($query = $this->db->delete($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    public function multiDelete()
    {
        $thumb_sizes = $this->img_size_array;
        $upload_path = (isset($this->telegram_support_image) && !empty($this->telegram_support_image)) ? $this->telegram_support_image : 'uploads/telegram_support_image/';
        foreach ($this->input->post('ids') as $key => $id) {
            $data = $this->getTelegramSupportById($id);
            if (file_exists($upload_path . $data['image'])) {
                @unlink($upload_path . $data['image']);
            }
            foreach ($thumb_sizes as $width => $height) {
                if (file_exists($upload_path . "thumb/" . $width . "x" . $height . "_" . $data['image'])) {
                    @unlink($upload_path . "thumb/" . $width . "x" . $height . "_" . $data['image']);
                }
            }
            $this->db->where('telegram_support_id', $id);
            $this->db->delete($this->table);
        }
        return true;
    }

    public function changeMultiPublishStatus()
    {
        foreach ($this->input->post('ids') as $key => $id) {
            $data = $this->getTelegramSupportById($id);
            if ($data['status'] == '0')
                $status = '1';
            else
                $status = '0';

            $this->db->set('status', $status);
            $this->db->where('telegram_support_id', $id);
            $this->db->update($this->table);
        }
        return true;
    }

}
