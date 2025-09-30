<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct(); 
        // is_logged_in();
        $this->load->model('Custom_model','custom');
    }	

	public function index($session_id="",$game_id='')
	{
		$data['page_title'] = "Dashboard";
		$data['title'] = "Dashboard";
		$data['button'] = "Dashboard";
		$data['table_name'] = "users";
		$data['btn_url'] = "";
		$data['id'] = '';
		$data['user_data'] = "dfsf";	
		$data['pagenation'] = array();

		if(!empty($this->session->userdata('id')))
		{
			is_admin_logged_in();
			    
			if($this->session->userdata('id')==2)
		    redirect(base_url('admin/video'));
			
			
			$data['setting'] = $setting = $this->db->get_where("setting")->result_object();
			if(empty($game_id))
			{
				$game = $this->db->select('id')->limit(1)->order_by("id asc")->get_where("game")->result_object();
				if(!empty($game)) $game_id = $game[0]->id;
			}
			$data['game_id'] = $game_id;
			$data['session_id'] = $session_id;
			$data['vendors'] = 0;
			$data['machines'] = 0;
			$data['cards'] = 0;
		}		
		$this->template->load('template', 'admin/dashboard', $data);
	}
	public function bid_amount()
	{
		is_admin_logged_in();
		$id = $this->input->post('id');
		$where = array("time_id"=>$id,);
		if($id!='all')
			$this->db->where($where);
		$amount = $this->db
        ->select_sum("amount")
        ->get_where("game_bet as game_bet",array("is_delete"=>0,))->result_object()[0]->amount;
        if(empty($amount)) $amount = 0;
		$result['status'] = "200";
		$result['data'] = array("amount"=>$amount,);
		echo json_encode($result);
	}
	public function single_ank()
	{
		is_admin_logged_in();
		$time_id = $this->input->post('time_id');
		$session_id = $this->input->post('session_id');
		$date = date("Y-m-d");

		$year = date("Y",strtotime($date));
	    $month = date("m",strtotime($date));
	    $day = date("d",strtotime($date));

	    if($month[0]==0)$month = $month[1];
	    if($day[0]==0)$day = $day[1];
	    $date = $year.'-'.$month.'-'.$day;
	    $where_query = " CONCAT(YEAR(game_bet.add_date_time),'-',MONTH(game_bet.add_date_time),'-',DAY(game_bet.add_date_time))='$date' ";

        $html = '';
        foreach (single_bid_digits() as $key => $value)
        {
        	$data = array("ank"=>$value,"amount"=>0,);
        	$amount = $this->db
	        ->select_sum("amount")
	        ->where($where_query)
	        ->get_where("game_bet as game_bet",array("is_delete"=>0,"time_id"=>$time_id,"session_id"=>$session_id,"card_id"=>1,"bid"=>$value,))->result_object()[0]->amount;
	        if(!empty($amount)) $data['amount'] = $amount;        		
        	$html .= $this->load->view("admin/ank-card",$data,true);
        }

        if(empty($amount)) $amount = 0;
		$result['status'] = "200";
		$result['data'] = $html;
		echo json_encode($result);
	}
	
}
