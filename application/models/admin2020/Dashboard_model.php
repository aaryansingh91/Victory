<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function get_tot_member()
    {
        $this->db->select('count(member_id) as total_member');
        $query = $this->db->get('member');
        return $query->row_array();
    }

    public function get_tot_match()
    {
        $this->db->select('count(m_id) as total_match');
        $query = $this->db->get('matches');
        return $query->row_array();
    }

    public function get_total_received_payment()
    {
        $this->db->select('sum(deposit_amount) as total_payment');
        $this->db->where('deposit_status', '1');
        $query = $this->db->get('deposit');
        return $query->row_array();
    }

    public function get_total_withdraw()
    {
        // $myTime = new Time('now'); 
        $array = array('1', '9');
        $this->db->select('sum(withdraw) as total_withdraw');
        $this->db->where_in('note_id', $array);
        $query = $this->db->get('accountstatement');
        return $query->row_array();
    }
    
     public function get_day_wise_income()
    {
       date_default_timezone_set('Asia/Kathmandu');
        $today_date = date('Y-m-d');
        $today_start = $today_date . ' 00:00:00';
        $today_end = $today_date . ' 23:59:59';
       
        $this->db->select('sum(deposit_amount) as total_day_income');
        $this->db->where('deposit_status', '1');
        $this->db->where('deposit_dateCreated >=', $today_start);
        $this->db->where('deposit_dateCreated <=', $today_end);
        $query_today = $this->db->get('deposit');
        $today_income = $query_today->row()->total_day_income;
       return  $query_today->row()->total_day_income;
    }
    
     public function get_week_wise_income()
    {
        $current_datetime = date('Y-m-d H:i:s'); 
        $last_day_of_week = date('Y-m-d 23:59:59', strtotime("-1 week"));
        
        $this->db->select('sum(deposit_amount) as total_week_income');
        $this->db->where('deposit_status', '1');
        $this->db->where('deposit_dateCreated <=', $current_datetime);
        $this->db->where('deposit_dateCreated >=', $last_day_of_week);
        $query_week = $this->db->get('deposit');
        $last_week_income = $query_week->row()->total_week_income;
        return  $last_week_income;
    }
    
    public function get_month_wise_income()
    {
        $first_day_this_month = date('Y-m-01'). ' 00:00:00';
        $last_day_this_month  = date('Y-m-d'). ' 23:59:59';
        
        $this->db->select('sum(deposit_amount) as total_month_income');
        $this->db->where('deposit_status', '1');
        $this->db->where('deposit_dateCreated >=', $first_day_this_month);
        $this->db->where('deposit_dateCreated <=', $last_day_this_month);
        $query_month = $this->db->get('deposit');
        $month_income = $query_month->row()->total_month_income;
        return  $month_income;
    }
    
     public function get_year_wise_income()
    {
       $first_day_of_year = date('Y-01-01 00:00:00', strtotime('this year'));
       $last_day_of_year = date('Y-12-31 23:59:59', strtotime('this year'));
        
        $this->db->select('sum(deposit_amount) as total_year_income');
        $this->db->where('deposit_status', '1');
        $this->db->where('deposit_dateCreated >=', $first_day_of_year);
        $this->db->where('deposit_dateCreated <=', $last_day_of_year);
        $query_month = $this->db->get('deposit');
        $year_income = $query_month->row()->total_year_income;
        return $year_income;
    }
    
    public function get_total_lottery()
    {
      $this->db->select('sum(lottery_fees * total_joined - lottery_prize) as total');
      $this->db->where('lottery_status' , "2");
      $a=$this->db->get('lottery');
      $total_profit=$a->result();
      return $total_profit[0]->total;
    }
    
    public function get_per_day_lottery()
    {
        $today_date = date('Y-m-d');
        $today_start = $today_date . ' 00:00:00';
        $today_end = $today_date . ' 23:59:59';
        $this->db->select('sum(lottery_fees * total_joined - lottery_prize) as total');
        $this->db->where('lottery_status' , "2");
        $this->db->where('date_created >=' , $today_start);
        $this->db->where('date_created <=' , $today_end);
        $a=$this->db->get('lottery');
        $total_profit=$a->result();
        // print_r($total_profit);exit;
        return $total_profit[0]->total;
    }
    
     public function get_per_week_lottery()
    {
        $current_datetime = date('Y-m-d H:i:s'); 
        $last_day_of_week = date('Y-m-d 23:59:59', strtotime("-1 week"));
        // echo $current_datetime;echo "<br>";echo $last_day_of_week;exit;
        $this->db->select('sum(lottery_fees * total_joined - lottery_prize) as total');
        $this->db->where('lottery_status' , "2");
        $this->db->where('date_created <=' , $current_datetime);
        $this->db->where('date_created >=' , $last_day_of_week);
        $a=$this->db->get('lottery');
        $total_profit=$a->result();
        return $total_profit[0]->total;
    }
    
     public function get_per_month_lottery()
    {
        $first_day_this_month = date('Y-m-01'). ' 00:00:00';
        $last_day_this_month  = date('Y-m-d'). ' 23:59:59';
        $this->db->select('sum(lottery_fees * total_joined - lottery_prize) as total');
        $this->db->where('lottery_status' ,"2");
        $this->db->where('date_created >=' , $first_day_this_month);
        $this->db->where('date_created <=' , $last_day_this_month);
        $a=$this->db->get('lottery');
        $total_profit=$a->result();
        return $total_profit[0]->total;
    }
    
     public function get_year_lottery()
    {
         $first_day_of_year = date('Y-01-01 00:00:00', strtotime('this year'));
         $last_day_of_year = date('Y-12-31 23:59:59', strtotime('this year'));
         $this->db->select('sum(lottery_fees * total_joined - lottery_prize) as total');
         $this->db->where('lottery_status' , "2");
         $this->db->where('date_created >=' , $first_day_of_year);
         $this->db->where('date_created <=' , $last_day_of_year);
         $a=$this->db->get('lottery');
         $total_profit=$a->result();
         return $total_profit[0]->total;
    }
     public function get_total_match()
    {
        $this->db->select('sum(mj.total_win + mj.refund) as total,mj.match_id,(m.entry_fee * no_of_player - sum(mj.total_win + mj.refund)) as total_profit');
        $this->db->where('m.match_type','1');
        $this->db->where('m.match_status','2');
        $this->db->join('match_join_member as mj', 'm.m_id = mj.match_id');
        $this->db->group_by('mj.match_id');
        $a = $this->db->get('matches as m');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->total_profit;
        }
        return $total_profit;
    }
    
    public function get_per_day_match()
    {
        $today_date = date('Y-m-d');
        $today_start = $today_date . ' 00:00:00';
        $today_end = $today_date . ' 23:59:59';
        $this->db->select('sum(mj.total_win + mj.refund) as total,mj.match_id,(m.entry_fee * no_of_player - sum(mj.total_win + mj.refund)) as total_profit');
        $this->db->where('m.match_type','1');
        $this->db->where('m.match_status','2');
        $this->db->where('m.date_created >=' , $today_start);
        $this->db->where('m.date_created <=' , $today_end);
        $this->db->join('match_join_member as mj', 'm.m_id = mj.match_id');
        $this->db->group_by('mj.match_id');
        $a = $this->db->get('matches as m');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->total_profit;
        }
        return $total_profit;
     
    }
    
     public function get_per_week_match()
    {
        $current_datetime = date('Y-m-d H:i:s'); 
        $last_day_of_week = date('Y-m-d 23:59:59', strtotime("-1 week"));
        $this->db->select('sum(mj.total_win + mj.refund) as total,mj.match_id,(m.entry_fee * no_of_player - sum(mj.total_win + mj.refund)) as total_profit');
        $this->db->where('m.match_type','1');
        $this->db->where('m.match_status','2');
        $this->db->where('m.date_created <=' , $current_datetime);
        $this->db->where('m.date_created >=' , $last_day_of_week);
        $this->db->join('match_join_member as mj', 'm.m_id = mj.match_id');
        $this->db->group_by('mj.match_id');
        $a = $this->db->get('matches as m');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->total_profit;
        }
        return $total_profit;
    }
    
     public function get_per_month_match()
    {
        $first_day_this_month = date('Y-m-01'). ' 00:00:00';
        $last_day_this_month  = date('Y-m-d'). ' 23:59:59';
        $this->db->select('sum(mj.total_win + mj.refund) as total,mj.match_id,(m.entry_fee * no_of_player - sum(mj.total_win + mj.refund)) as total_profit');
        $this->db->where('m.match_type','1');
        $this->db->where('m.match_status','2');
        $this->db->where('m.date_created >=' , $first_day_this_month);
        $this->db->where('m.date_created <=' , $last_day_this_month);
        $this->db->join('match_join_member as mj', 'm.m_id = mj.match_id');
        $this->db->group_by('mj.match_id');
        $a = $this->db->get('matches as m');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->total_profit;
        }
        return $total_profit;
    }
    
     public function get_year_match()
    {
         $first_day_of_year = date('Y-01-01 00:00:00', strtotime('this year'));
         $last_day_of_year = date('Y-12-31 23:59:59', strtotime('this year'));
         $this->db->select('sum(mj.total_win + mj.refund) as total,mj.match_id,(m.entry_fee * no_of_player - sum(mj.total_win + mj.refund)) as total_profit');
         $this->db->where('m.match_type','1');
         $this->db->where('m.match_status','2');
         $this->db->where('m.date_created >=' , $first_day_of_year);
         $this->db->where('m.date_created <=' , $last_day_of_year);
         $this->db->join('match_join_member as mj', 'm.m_id = mj.match_id');
         $this->db->group_by('mj.match_id');
         $a = $this->db->get('matches as m');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->total_profit;
        }
        return $total_profit;
    }
    
    public function get_total_ludo()
    {
        $this->db->select('(coin * 2 - winning_price) as profit,ludo_challenge_id');
        $this->db->where('challenge_status','3');
        $a= $this->db->get('ludo_challenge');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->profit;
        }
        return $total_profit; 
    }
    
    public function get_per_day_ludo()
    {
        $today_date = date('Y-m-d');
        $today_start = $today_date . ' 00:00:00';
        $today_end = $today_date . ' 23:59:59';
        $this->db->select('(coin * 2 - winning_price) as profit,ludo_challenge_id');
        $this->db->where('challenge_status','3');
        $this->db->where('date_created >=' , $today_start);
        $this->db->where('date_created <=' , $today_end);
        $a= $this->db->get('ludo_challenge');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->profit;
        }
        return $total_profit; 
        
    }
    
     public function get_per_week_ludo()
    {
        $current_datetime = date('Y-m-d H:i:s'); 
        $last_day_of_week = date('Y-m-d 23:59:59', strtotime("-1 week"));
        $this->db->select('(coin * 2 - winning_price) as profit,ludo_challenge_id');
        $this->db->where('challenge_status','3');
         $this->db->where('date_created <=' , $current_datetime);
        $this->db->where('date_created >=' , $last_day_of_week);
        $a= $this->db->get('ludo_challenge');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->profit;
        }
        return $total_profit; 
 
    }
    
     public function get_per_month_ludo()
    {
        $first_day_this_month = date('Y-m-01'). ' 00:00:00';
        $last_day_this_month  = date('Y-m-d'). ' 23:59:59';
        $this->db->select('(coin * 2 - winning_price) as profit,ludo_challenge_id');
        $this->db->where('challenge_status','3');
        $this->db->where('date_created >=' , $first_day_this_month);
        $this->db->where('date_created <=' , $last_day_this_month);
        $a= $this->db->get('ludo_challenge');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->profit;
        }
        return $total_profit; 
        
    }
    
     public function get_year_ludo()
    {
         $first_day_of_year = date('Y-01-01 00:00:00', strtotime('this year'));
         $last_day_of_year = date('Y-12-31 23:59:59', strtotime('this year'));
         $this->db->select('(coin * 2 - winning_price) as profit,ludo_challenge_id');
         $this->db->where('challenge_status','3');
         $this->db->where('date_created >=' , $first_day_of_year);
         $this->db->where('date_created <=' , $last_day_of_year);
         $a= $this->db->get('ludo_challenge');
        
        $total_profit = 0;
        foreach ($a->result() as $row) {
            $total_profit += $row->profit;
        }
        return $total_profit; 
         
    }

}
