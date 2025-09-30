<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {


	protected $table_name = "game_sessions";
	protected $controller_url = "sessions";
	protected $bet_table_name = "game_bet";
	protected $game_total_amount = "sessions_total_amount";
	protected $win_table_name = "game_wins";
	protected $duraton = 60000; // 60 sec
	protected $manual_table_name = "sessions_manual";
	protected $games = "sessions_game";


	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('Auth_model','auth');
        $this->load->model('Custom_model','custom');
    }
	public function list($id="")
	{
		$data['id'] = $id;

		$limit = 15;
		$page = 1;
		$page1 = 1;

		$offset = 0;

		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
			if ($page==1|| $page==0)
			{
				$offset = 0;
			}
			else
			{
				--$page;
				$offset = $limit * $page;
			}
		}

		$crtime = strtotime(date("Y-m-d H:i:s"));
		$where_query = "$this->table_name.date_time <= $crtime and game_id='$id'";


		$this->db->limit($limit,$offset);
		$this->db->order_by("id desc");
		$this->db->where($where_query);
		$data['list'] = $win_ids_data = $this->db->get_where($this->table_name)->result_object();	


		$data_count = count($this->db->select("id")->where($where_query)->get_where($this->arr_values['table_name'])->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);

		$data['pagination_list']=pagination_custom($this->table_name,$limit,$page,base_url(panel."/sessions"),$where_query,'<i class="fa fa-angle-double-left"></i>','<i class="fa fa-angle-double-right"></i>');

		$data['title'] = "1 Minute Parity";
		$data['button'] = "";
		$data['table_name'] = $this->table_name;
		$data['btn_url'] = '';
		$data['controller_url'] = $this->controller_url;
		$data['duraton'] = $this->duraton;
		$data['pagenation'] = array('Dashboard','1 Minute Parity');
		$this->template->load('templateadmin', 'admin/pages/sessions/index', $data);
	}
	public function betting($id="")
	{
		$data['id'] = $id;
		$this->db->order_by("id asc");

		$game_session = $this->db->get_where($this->table_name,array("session_id"=>$id,))->result_object();
		if(!empty($game_session))
		{
			$game_session = $game_session[0];
			$list = $this->db
			->select("users.name as name")
			->select("game_bet.p_id as p_id")
			->select("game_bet.user_id as user_id")
			->select("game_bet.bet_amount as bet_amount")
			->select("game_bet.win_amount as win_amount")
			->join("users as users","game_bet.user_id=users.id","LEFT")
			->get_where($this->bet_table_name,array("session_id"=>$id,"game_id"=>$game_session->game_id,))->result_object();

			
			$time = date("Y-m-d H:i:s");
			$time2 = $game_session->date." ".$game_session->time;
			$date1 = strtotime($time2);
			$date2 = strtotime($time);
			$diff = abs($date2 - $date1);
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24)
			                             / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 -
			           $months*30*60*60*24)/ (60*60*24));
			$hours = floor(($diff - $years * 365*60*60*24
			     - $months*30*60*60*24 - $days*60*60*24)
			                                 / (60*60));
			$minutes = floor(($diff - $years * 365*60*60*24
			       - $months*30*60*60*24 - $days*60*60*24
			                        - $hours*60*60)/ 60);
			$seconds = floor(($diff - $years * 365*60*60*24
			       - $months*30*60*60*24 - $days*60*60*24
			              - $hours*60*60 - $minutes*60));
			$mitset = $minutes.":".$seconds;
			$string = "00:".$mitset.",689";
			$time   = explode(":", $string);
			$hour   = $time[0] * 60 * 60 * 1000;
			$minute = $time[1] * 60 * 1000;
			$second = explode(",", $time[2]);
			$sec    = $second[0] * 1000;
			$milisec= $second[1];
			$sec = $hour + $minute + $sec + $milisec;
			$data['duration'] = $duraton = $this->duraton-$sec;
			$orders = array();		
			$data['list'] = $list;

			
			$data['title'] = "Bettings";
			$data['button'] = "";
			$data['btn_url'] = '';
			$data['controller_url'] = $this->controller_url;
			$data['game_name'] = $game_session->game_name;
			$data['game_id'] = $game_session->game_id;
			$data['pagenation'] = array('Dashboard','Bettings');
			$this->template->load('templateadmin', 'admin/pages/sessions/bettings', $data);
		}
		else
		{
			$this->template->load('templateadmin', 'admin/pages/404', $data);			
		}
	}
	public function wins($id="")
	{
		$data['id'] = $id;
		$win_ids_data_number = $win_ids_data = $this->db->get_where($this->win_table_name,array("session_id"=>$id,))->result_object();
		foreach ($win_ids_data as $key => $value)
		{
				$win_ids_data = $value;
				$win_user = $this->db->get_where("users",array("id"=>$win_ids_data->user_id,))->result_object();
			    if(!empty($win_user))
			    {
			        $win_user = $win_user[0];
			        $name = $win_user->name;
			        $amount = $value->amount;
			        $user_id = $win_user->user_id;
			    }
			    else
			    {
			        $name = "Default";
			        $amount = $value->amount;
			        $user_id = "0000";
			    }
			    $win_lose = "1";
			    if($win_ids_data->p_id=="red")
					$color_code = red_color_code;
				else if($win_ids_data->p_id=="blue")
					$color_code = blue_color_code;
				else if($win_ids_data->p_id=="green")
					$color_code = green_color_code;	
				else
					$color_code = "";
				$win_data1 = array(
					"user_id"=>$win_ids_data->user_id,
					"p_id"=>$win_ids_data->p_id,
					"name_user"=>$name,
					"amount_user"=>$amount,
					"win_lose"=>$win_lose,
					"type"=>$win_ids_data->p_type,
					"color_code"=>$color_code,
				);
			$win_data2[] = $win_data1;
		}


		$win_ids_data_number[0]->p_id;
		if($win_ids_data_number[0]->p_id=="red")
			$color_code = red_color_code;
		else if($win_ids_data_number[0]->p_id=="blue")
			$color_code = blue_color_code;
		else if($win_ids_data_number[0]->p_id=="green")
			$color_code = green_color_code;	

		$data['list'] = $win_data2;
		$data['win_color'] = $color_code;
		$data['win_number'] = $win_ids_data_number[0]->p_id;

		// print_r($data['list']);
		$data['title'] = "Win Usesr";
		$data['button'] = "";
		$data['table_name'] = "$this->win_table_name";
		$data['btn_url'] = '';
		$data['controller_url'] = $this->controller_url;
		$data['pagenation'] = array('Dashboard','Win Usesr');
		$this->template->load('templateadmin', 'admin/pages/sessions/wins', $data);
	}
	public function manual($id="")
	{	
		$session_id = $this->input->post('session_id');
		$number = $this->input->post('number');
		$color = $this->input->post('color');
		$size = $this->input->post('size');
		$type = $this->input->post('type');
		
		if(empty($size))
		{
			$number_data = array("p_id"=>$number,"session_id"=>$session_id,"type"=>"number",);
			$color_data = array("p_id"=>$color,"session_id"=>$session_id,"type"=>"color",);
			if(empty($this->db->get_where($this->manual_table_name,array("session_id"=>$session_id,))->result_object()))
			{
				$this->db->insert($this->manual_table_name,$number_data);
				$this->db->insert($this->manual_table_name,$color_data);			
			}
			else
			{
				$this->db->update($this->manual_table_name,$number_data,array("session_id"=>$session_id,"type"=>"number",));
				$this->db->update($this->manual_table_name,$color_data,array("session_id"=>$session_id,"type"=>"color",));
			}
		}
		else
		{
			$size_data = array("p_id"=>$size,"session_id"=>$session_id,"type"=>"size",);
			if(empty($this->db->get_where($this->manual_table_name,array("session_id"=>$session_id,"type"=>"size",))->result_object()))
			{
				$this->db->insert($this->manual_table_name,$size_data);
			}
			else
			{
				$this->db->update($this->manual_table_name,$size_data,array("session_id"=>$session_id,"type"=>"size",));
			}
		}		
	}
	public function amount_detail()
	{
		$session_id = $this->input->post('session_id');
		$game_id = $this->input->post('game_id');
		$bet_total_amount = 0;
		$profit_loss_amount = 0;
		$win_total_amount = 0;
		$game_sessions = $this->db->get_where("game_sessions",array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();
		if(!empty($game_sessions))
		{
			$game_sessions = $game_sessions[0];
			$bet_total_amount = $game_sessions->total_amount;
			$result = $game_sessions->result;
			$win_numbers = explode(",",$result);

			$game_bet = $this->db->select_sum('bet_amount')->get_where("game_bet",array("p_id"=>$result,))->result_object()[0];
			if(!empty($game_bet->bet_amount)) $win_total_amount = $game_bet->bet_amount*10;

			$profit_loss_amount = $bet_total_amount-$win_total_amount;
			$data = array(
				"bet_total_amount"=>$bet_total_amount,
				"win_total_amount"=>$win_total_amount,
				"profit_loss_amount"=>$profit_loss_amount,
				"win_numbers"=>$win_numbers,
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



		// $session_id = 20230370001;
		// $result = have_to_pay_color_30($session_id,$this->bet_table_name,$this->win_table_name,$this->game_total_amount,$this->manual_table_name);
		// echo json_encode($result);
	}
	public function live_session_id()
	{
		$crtime = strtotime(date("Y-m-d H:i:s"));
		$this->db->limit(1);	
		$this->db->order_by("id desc");
		$this->db->where("$this->table_name.date_time <= ",$crtime);
		$game_session = $this->db->get($this->table_name)->result_object()[0];
		echo json_encode(array("session_id"=>$game_session->session_id,));
	}
}