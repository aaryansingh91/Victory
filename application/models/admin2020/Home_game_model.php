<?php

class Home_game_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'home_game';
        $this->game_image = 'uploads/game_image/';
        $this->game_logo_image = 'uploads/game_logo/';
        $this->img_size_array = array(100 => 100, 1000 => 500, 350 => 350, 500 => 500);
    }

    public function get_list_count_game()
    {
        $this->db->select('*');
        $this->db->order_by("game_id", "Desc");
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function game_data()
    {
        $this->db->select('*');
        $this->db->order_by("game_id", "Desc");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function insert()
    {
        $thumb_sizes = $this->img_size_array;
        if ($_FILES['game_image']['name'] == "") {
            $image = '';
        } else {
            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image = $unique . '_' . preg_replace("/\s+/", "_", $_FILES['game_image']['name']);
            $config['file_name'] = $image;
            $config['upload_path'] = $this->game_image;
            $config['allowed_types'] = 'jpg|png|jpeg';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('game_image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return false;
            } else {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
                foreach ($thumb_sizes as $key => $val) {
                    list($width_orig, $height_orig, $image_type) = getimagesize($this->game_image . $image);

                    if ($width_orig != $key || $height_orig != $val) {
                        $this->image->initialize($this->game_image . $image);
                        $this->image->resize($key, $val);
                        $this->image->save($this->game_image . "thumb/" . $key . "x" . $val . "_" . $image);
                    } else {
                        copy($this->game_image . $image, $this->game_image . "thumb/" . $key . "x" . $val . "_" . $image);
                    }
                }
            }
        }

        $data = array(
            'game_name' => $this->input->post('game_name'),
            'game_image' => $image,
            'status' => '1'
        );
        if ($this->db->insert($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $thumb_sizes = $this->img_size_array;
        if ($_FILES['game_image']['name'] == "") {
            $image = $this->input->post('old_game_image');
        } else {
            if ($this->input->post('old_game_image') != "" && file_exists($this->game_image . $this->input->post('old_game_image'))) {
                @unlink($this->game_image . $this->input->post('old_game_image'));
            }
            foreach ($thumb_sizes as $width => $height) {
                if ($this->input->post('old_game_image') != "" && file_exists($this->game_image . "thumb/" . $width . "x" . $height . "_" . $this->input->post('old_game_image'))) {
                    @unlink($this->game_image . "thumb/" . $width . "x" . $height . "_" . $this->input->post('old_game_image'));
                }
            }
            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image = $unique . '_' . preg_replace("/\s+/", "_", $_FILES['game_image']['name']);
            $config['file_name'] = $image;
            $config['upload_path'] = $this->game_image;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('game_image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return false;
            } else {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
                foreach ($thumb_sizes as $key => $val) {
                    list($width_orig, $height_orig, $image_type) = getimagesize($this->game_image . $image);

                    if ($width_orig != $key || $height_orig != $val) {
                        $this->image->initialize($this->game_image . $image);
                        $this->image->resize($key, $val);
                        $this->image->save($this->game_image . "thumb/" . $key . "x" . $val . "_" . $image);
                    } else {
                        copy($this->game_image . $image, $this->game_image . "thumb/" . $key . "x" . $val . "_" . $image);
                    }
                }
            }
        }

        $data = array(
            'game_name' => $this->input->post('game_name'),
            'game_image' => $image
        );
        $this->db->where('game_id', $this->input->post('game_id'));
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getgameById($game_id)
    {
        $this->db->select('*');
        $this->db->where('game_id', $game_id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function changePublishStatus()
    {
        $this->db->set('status', $this->input->post('publish'));
        $this->db->where('game_id', $this->input->post('gameid'));
        if ($query = $this->db->update($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $thumb_sizes = $this->img_size_array;

        $data = $this->getgameById($this->input->post('gameid'));

        if (file_exists($this->game_image . $data['game_image'])) {
            @unlink($this->game_image . $data['game_image']);
        }
        foreach ($thumb_sizes as $width => $height) {
            if (file_exists($this->game_image . "thumb/" . $width . "x" . $height . "_" . $data['game_image'])) {
                @unlink($this->game_image . "thumb/" . $width . "x" . $height . "_" . $data['game_image']);
            }
        }
        $this->db->where('game_id', $this->input->post('gameid'));
        if ($query = $this->db->delete($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    public function multiDelete()
    {
        $thumb_sizes = $this->img_size_array;

        foreach ($this->input->post('ids') as $key => $game_id) {
            $data = $this->getgameById($game_id);

            if (file_exists($this->game_image . $data['game_image'])) {
                @unlink($this->game_image . $data['game_image']);
            }
            foreach ($thumb_sizes as $width => $height) {
                if (file_exists($this->game_image . "thumb/" . $width . "x" . $height . "_" . $data['game_image'])) {
                    @unlink($this->game_image . "thumb/" . $width . "x" . $height . "_" . $data['game_image']);
                }
            }
            $this->db->where('game_id', $game_id);
            $this->db->delete($this->table);
        }

        return true;
    }

    public function changeMultiPublishStatus()
    {

        foreach ($this->input->post('ids') as $key => $game_id) {
            $game_data = $this->getgameById($game_id);

            if ($game_data['status'] == '0')
                $status = '1';
            else
                $status = '0';

            $this->db->set('status', $status);
            $this->db->where('game_id', $game_id);
            $this->db->update($this->table);
        }
        return true;
    }

}
