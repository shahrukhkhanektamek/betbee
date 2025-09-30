<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Betting extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Betting', 
						   	'table_name'=>'game_sessions',
						   	'page_title'=>'Betting',
						   	"submit_url"=>panel.'/betting/update',
						   	"folder_name"=>'betting',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/betting',
						   	"btn_url"=>panel.'/betting/add',
						   	"add_btn_url"=>panel.'/betting/add',
						   	"edit_btn_url"=>panel.'/betting/edit/',
						   	"view_btn_url"=>panel.'/betting/view/',
						   	"controller_name"=>'betting',
						   	"page_name"=>'betting-detail.php',
						   	"keys"=>'id,name',
						   	"all_image_column_names"=>array("image"),
						   );  
   public function __construct()
    {
        parent::__construct(); 
        is_logged_in(); 
        is_admin_logged_in();
        create_importent_columns($this->arr_values['table_name']);
        $this->load->model('Custom_model','custom');
        $this->load->model('Image_model');
        $this->load->model('Game_model');
    }	
	public function index($session_id,$game_id)
	{
		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = "All ".$this->arr_values['page_title'].'s';
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = base_url($this->arr_values['back_btn']);
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['view_url'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['edit_url'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['folder_name'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['view_btn_url'] = $this->arr_values['view_btn_url'];
		$data['keys'] = $this->arr_values['keys'];			
		$data['pagenation'] = array($this->arr_values['title']);
		$data['trash'] = $this->input->get("trash");
		if(!empty($this->arr_values['all_image_column_names']) && is_array($this->arr_values['all_image_column_names']))
			$data['all_image_column_names'] = implode(",", $this->arr_values['all_image_column_names']);
		else
			$data['all_image_column_names'] = '';



		$bet_table_name = "game_bet";
		$game_session = $this->db->get_where("game_sessions",array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();
		if(!empty($game_session))
		{
			$game_session = $game_session[0];
			$game_id = $game_session->game_id;
			$list = $this->db
			->select("users.fname as name")
			->select("game_bet.p_id as p_id")
			->select("game_bet.user_id as user_id")
			->select("game_bet.bet_amount as bet_amount")
			->select("game_bet.win_amount as win_amount")
			->join("users as users","game_bet.user_id=users.id","LEFT")
			->get_where($bet_table_name,array("session_id"=>$session_id,"game_id"=>$game_session->game_id,))->result_object();

				
			$data['list'] = $list;


			$game_session_data = $this->Game_model->session_data($game_session->game_id,$session_id);
			$data['session_id'] = strval($game_session_data['session_id']);
			$data['session_name'] = strval($game_session_data['session_name']);
			$data['betting_price'] = strval($game_session_data['betting_price']);
			$data['session_start_date_time'] = strval($game_session_data['session_start_date_time']);
			$data['session_end_date_time'] = strval($game_session_data['session_end_date_time']);
			$data['duration'] = strval($game_session_data['total_duration']);
			$data['stop_betting_after'] = strval($game_session_data['stop_betting_after']);
			
			$data['game_name'] = $game_session->game_name;
			$data['game_id'] = $game_session->game_id;
			
			$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/index', $data);
		}
		else
		{
			$this->template->load('template', panel.'/404', $data);
		}


	}

	public function amount_detail()
	{
		$session_id = $this->input->post('session_id');
		$game_id = $this->input->post('game_id');
		$bet_total_amount = 0;
		$profit_loss_amount = 0;
		$win_total_amount = 0;
		$blackbet = 0;
		$bluebet = 0;
		$redbet = 0;
		$game_sessions = $this->db->get_where("game_sessions",array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();
		if(!empty($game_sessions))
		{
			$game_sessions = $game_sessions[0];
			$bet_total_amount = $game_sessions->total_amount;
			$result = $game_sessions->result;
			$win_numbers = explode(",",$result);
			$p_id = explode(",",$result)[0];

			$game_bet = $this->db->select_sum('bet_amount')->get_where("game_bet",array("p_id"=>$p_id,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0];
			if(!empty($game_bet->bet_amount))
			{
				if($p_id==1 || $p_id==3) $win_total_amount = $game_bet->bet_amount*2;
				if($p_id==2) $win_total_amount = $game_bet->bet_amount*5;
			}


			$black_game_bet = $this->db->select_sum('bet_amount')->get_where("game_bet",array("p_id"=>1,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0];
			if(!empty($black_game_bet->bet_amount)) $blackbet = $black_game_bet->bet_amount;

			$blue_game_bet = $this->db->select_sum('bet_amount')->get_where("game_bet",array("p_id"=>2,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0];
			if(!empty($blue_game_bet->bet_amount)) $bluebet = $blue_game_bet->bet_amount;

			$red_game_bet = $this->db->select_sum('bet_amount')->get_where("game_bet",array("p_id"=>3,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0];
			if(!empty($red_game_bet->bet_amount)) $redbet = $red_game_bet->bet_amount;
			

			$profit_loss_amount = $bet_total_amount-$win_total_amount;
			$data = array(
				"bet_total_amount"=>$bet_total_amount,
				"win_total_amount"=>$win_total_amount,
				"profit_loss_amount"=>$profit_loss_amount,
				"win_numbers"=>$win_numbers,
				"win_numbers"=>$win_numbers,
				"blackbet"=>number_format($blackbet),
				"bluebet"=>number_format($bluebet),
				"redbet"=>number_format($redbet),
			);
			$resultd['status'] = '200';
			$resultd['message'] = 'Success';
			$resultd['data'] = $data;

		}
		else
		{
			$resultd['status'] = '400';
			$resultd['message'] = 'Success';
			$resultd['data'] = [];
		}
		echo json_encode($resultd);
	}
	public function manual($id="")
	{	
		$session_id = $this->input->post('session_id');
		$game_id = $this->input->post('game_id');
		if(!empty($this->input->post('numbers')))
		{
			$numbers = implode(",",$this->input->post('numbers'));
			$this->db->update("game_sessions",array("result"=>$numbers,),array("session_id"=>$session_id,"game_id"=>$game_id,));			
		}
	}
	public function live_session_id()
	{
		$game_id = $this->input->post("game_id");
		$game_session_data = $this->Game_model->session_data($game_id);
		$session_id = strval($game_session_data['session_id']);
		echo json_encode(array("session_id"=>$session_id,));
	}

	



}







