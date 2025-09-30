<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_session extends CI_Controller {
	 
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('Auth_model','auth');
        $this->load->model('Custom_model','custom');
    }

	public function index()
	{
	    
		$game_id = $this->input->post('game_id');
		$session_table_name = "game_sessions";
		$date = date("Y-m-d");
		$games = $this->db->get_where("game",array("status"=>1,))->result_object();
		foreach ($games as $key => $value)
		{
			$game_id = $value->id;
			$type = $value->type;
			$type2 = $value->type2;
			$total_minute = 0;
			$stop_before_minute = 0;
			$betting_value = '';
			$data = $this->db->get_where("game",array("id"=>$game_id,))->result_object();
			if(!empty($data))
			{
				$total_minute = $data[0]->total_minute;
				$stop_before_minute = $data[0]->stop_before_minute;
				$betting_value = $data[0]->betting_value;
				$game_name = $data[0]->name;
				$total_minute_dd = $total_minute;
				$time_add_type = '';
				$time_add_type2 = '';
				if($type==1) $time_add_type = 'second';
				if($type==2) $time_add_type = 'minute';
				if($type2==1) $time_add_type2 = 'second';
				if($type2==2) $time_add_type2 = 'minute';
				$session_id2 = $game_session = $this->db->order_by("id desc")->limit(1)->get($session_table_name,array("date"=>$date,"game_id"=>$game_id,))->result_object();
				if(empty($session_id2))
				{
					$session_id2 = date("Ym");
					$session_id2 .=+date("d")*10000+1;
				}
				else
				{
					$session_id2 =$session_id2[0]->session_id+1;
				}
				$i = 1;
				$sec = 300;
				$date = date("Y-m-d");				
				if($type==1)
				{
					$count = 86400/$total_minute_dd;
					if(!86400/$total_minute_dd) die;
				}
				if($type==2)
				{
					$count = 1440/$total_minute_dd;
					if(!1440/$total_minute_dd) die;
				}
				// $count = 1;
				// $date_time = date("Y-m-d H:i:s");
				$date_time = date("Y-m-d 00:00:00");
				while ($i <= $count)
				{
				  	if($i>1)
					    $date_time = date('Y-m-d H:i:s', strtotime($date_time. " +$total_minute $time_add_type"));
					$string_date_time = strtotime($date_time);
					$date_time2 = $date_time;
					$date = date("Y-m-d",strtotime($date_time));
					$time = date("H:i:s",strtotime($date_time));
					$bet_start_date_time = $date_time2;
					if($type==1 && $type2==1)
					{
						$bet_stop_date_time = date("Y-m-d H:i:s",strtotime($bet_start_date_time."+$total_minute second"));
						$bet_stop_before_date_time = date("Y-m-d H:i:s",strtotime($bet_stop_date_time."-$stop_before_minute second"));
					}
					else if($type==2 && $type2==1)
					{
						$bet_stop_date_time = date("Y-m-d H:i:s",strtotime($bet_start_date_time."+$total_minute minute"));
						$bet_stop_before_date_time = date("Y-m-d H:i:s",strtotime($bet_stop_date_time."-$stop_before_minute second"));
					}
					else if($type==2 && $type2==2)
					{
						$bet_stop_date_time = date("Y-m-d H:i:s",strtotime($bet_start_date_time."+$total_minute minute"));
						$bet_stop_before_date_time = date("Y-m-d H:i:s",strtotime($bet_stop_date_time."-$stop_before_minute minute"));
					}
					else
					{}
					if(empty($this->db->get_where($session_table_name,array("session_id"=>$session_id2,"game_id"=>$game_id,))->result_object()))
					{
						$result = '';
						$result = rand(1,3).','.rand(0,9);
						$this->db->insert($session_table_name,array("type"=>$type,"type2"=>$type2,"game_id"=>$game_id,"session_id"=>$session_id2,"date_time"=>$string_date_time,"date_time2"=>$date_time2,"date"=>$date,"time"=>$time,"total_minute"=>$total_minute,"stop_before_minute"=>$stop_before_minute,"bet_stop_before_date_time"=>$bet_stop_before_date_time,"betting_value"=>$betting_value,"game_name"=>$game_name,"result"=>$result,"is_delete"=>0,"status"=>1,"bet_start_date_time"=>$bet_start_date_time,"bet_stop_date_time"=>$bet_stop_date_time,));
						$session_id2 +=1;							
					}
					$i++;			
				}
			}
		}
		$this->db->update("game",array("game_status"=>1,),array("id"=>$game_id));
	}

	public function declare_result()
	{
		$this->load->model('Game_model');
		$game_id = 1;
		$session_id = 202401272004;
		$game_session_data = $this->Game_model->session_data($game_id);
		$result = $game_session_data['result'];
		$is_result_declare = $game_session_data['is_result_declare'];
		
		$session_id = $game_session_data['session_id']-1;
		$this->declare_result_session($session_id,$game_session_data);

		$session_id = $game_session_data['session_id']-2;
		$this->declare_result_session($session_id,$game_session_data);		
	}



	public function declare_result_session($session_id,$game_session_data)
	{

		$this->load->model('Game_model');
		$game_id = 1;
		$result = $game_session_data['result'];
		$is_result_declare = $game_session_data['is_result_declare'];

		
		$color_win = 0;
		$number_win = 0;
		$color_black_amount = 0;
		$color_blue_amount = 0;
		$color_red_amount = 0;
		if(!empty($result))
		{
			$number_win = $result[1];
		}
		if(!empty($result))
		{
			$color_win = $result[0];
		}


		$game_bet_black = $this->db->select_sum('amount')->get_where("game_bet",array("p_id"=>1,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0];
		if(!empty($game_bet_black->amount))
		{
			$color_black_amount = $game_bet_black->amount*2;
		}
		$game_bet_blue = $this->db->select_sum('amount')->get_where("game_bet",array("p_id"=>2,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0];
		if(!empty($game_bet_blue->amount))
		{
			$color_blue_amount = $game_bet_blue->amount*5;
		}
		$game_bet_red = $this->db->select_sum('amount')->get_where("game_bet",array("p_id"=>3,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0];
		if(!empty($game_bet_red->amount))
		{
			$color_red_amount = $game_bet_red->amount*2;			
		}




		if($color_black_amount==0 && $color_blue_amount==0 && $color_red_amount==0)
		{
			$color_win = $color_win;
		}
		if($color_black_amount<$color_blue_amount && $color_black_amount<$color_red_amount)
		{
			$color_win = 1;
		}
		else if($color_blue_amount<$color_black_amount && $color_blue_amount<$color_red_amount)
		{
			$color_win = 2;
		}
		else if($color_red_amount<$color_blue_amount && $color_blue_amount<$color_black_amount)
		{
			$color_win = 3;
		}
		else if($color_black_amount==$color_blue_amount || $color_black_amount==$color_red_amount)
		{
			$a=array("1","3");
			$color_win = $a[array_rand($a)];
		}
		else if($color_blue_amount==$color_black_amount || $color_blue_amount==$color_red_amount)
		{
			$a=array("1","3");
			$color_win = $a[array_rand($a)];
		}
		else if($color_red_amount==$color_black_amount || $color_red_amount==$color_blue_amount)
		{
			$a=array("1","3");
			$color_win = $a[array_rand($a)];
		}



		$result = $color_win.','.$number_win;
		$this->db->update("game_sessions",array("is_result_declare"=>1,"result"=>$result,),array("session_id"=>$session_id,"game_id"=>$game_id,));
		if($is_result_declare==0)
		{
			$into = 0;
			if($color_win==1 || $color_win==3) $into = 2;
			if($color_win==2) $into = 5;
			$color_bet_users = $this->db->select('id,p_id,amount,user_id')->get_where("game_bet",array("game_id"=>$game_id,"p_type"=>1,"session_id"=>$session_id,"p_id"=>$color_win,))->result_object();
			foreach ($color_bet_users as $key => $value)
			{
				$final_amount = $value->amount*$into;
				$win_data = array(
					"win_amount"=>$final_amount,
				);
				$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
				$message = 'Game Win Amount';
				$this->custom->wallet_credit_debit($value->user_id,"credit",$final_amount,$message,0);
			}



			// $number_bet_users = $this->db->select('id,p_id,amount,user_id')->get_where("game_bet",array("game_id"=>$game_id,"p_type"=>2,"session_id"=>$session_id,"p_id"=>$number_win,))->result_object();
			// foreach ($number_bet_users as $key => $value)
			// {
			// 	$final_amount = $value->amount*2;
			// 	$win_data = array(
			// 		"win_amount"=>$final_amount,
			// 	);
			// 	$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
			// 	$message = 'Game Win Amount';
			// 	$this->custom->wallet_credit_debit($value->user_id,"credit",$final_amount,$message,0);
			// }
		}
	}


}