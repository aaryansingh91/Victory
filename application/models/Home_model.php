<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function getMatchdetail($gameid = '') {
        $this->db->select('*');
        if ($gameid != '') {
            $this->db->where('game_id', $gameid);
        }
        $this->db->order_by('m_id', 'DESC');
        $this->db->limit('3');
        $query = $this->db->get('matches');
        $result = $query->result();
        return $result;
    }

    public function getPlayerlistbyGame($gameid) {
        $this->db->select('SUM(`total_win`) as `t_win`,`member`.`user_name`');
        $this->db->join('member', '`match_join_member`.`member_id` = `member`.`member_id`');
        $this->db->join('matches', '`matches`.`m_id` = `match_join_member`.`match_id`', 'left');
        $this->db->join('game', '`game`.`game_id` = `matches`.`game_id`', 'left');
        $this->db->where('game.game_id', $gameid);
        $this->db->group_by('`match_join_member`.`member_id`');
        $this->db->order_by('t_win', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get('match_join_member');
        return $query->result();
    }

    public function getFeaturesTab() {
        $this->db->select('*');
        $this->db->where('f_tab_status', "1");
        $this->db->order_by('f_tab_order', 'ASC');
        $query = $this->db->get('features_tab');
        return $query->result();
    }

    public function getFeaturesTabContent($features_tab_id) {
        $this->db->select('*');
        $this->db->where('features_tab_id', $features_tab_id);
        $this->db->where('content_status', "1");
        $this->db->order_by('date_created', 'ASC');
        $query = $this->db->get('features_tab_content');
        return $query->result();
    }

}

?>