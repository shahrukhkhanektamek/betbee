<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Game_model extends CI_Model
{

	public function session_data($game_id,$session_id='')
	{	
		date_default_timezone_set('Asia/Kolkata');
		$user_id = $this->input->post("user_id");

		$response_data['total_duration'] = '0';
		$response_data['stop_betting_after'] = '0';
		$response_data['session_id'] = '';
		$response_data['session_name'] = '';
		$response_data['betting_price'] = '';
		$response_data['session_start_date_time'] = '';
		$response_data['session_end_date_time'] = '';
		$response_data['result'] = '';
		$response_data['winner_data'] = [];
		$response_data['betting_value'] = [];
		$response_data['game_status'] = '2'; // 0=data table empty, 1=running, 2=connecting, 3=stop

		$game = $this->db->get_where("game",array("id"=>$game_id,))->result_object();
		


		$crtime = strtotime(date("Y-m-d H:i:s"));
		$date_time = date("Y-m-d H:i:s");
		$this->db->limit(1);
		$this->db->order_by("id desc");
		if(empty($session_id))
		{
			$where = array("game_id"=>$game_id,);		
			$this->db->where("game_sessions.date_time <= ",$crtime);
			// $this->db->where("game_sessions.bet_start_date_time >= ",$date_time);
		}
		else
		{
			$where = array("game_id"=>$game_id,"session_id"=>$session_id,);			
		}
		$game_session = $this->db->get_where("game_sessions",$where)->result_object();
		// print_r($game_session);


		$game_status = 0;
		if(!empty($game) && !empty($game_session))
		{	
			$game = $game[0];
			$game_session = $game_session[0];
			$game_status_game = $game->game_status;
			if($game_status_game==0) $game_status = 3;
			else $game_status = $game_status_game;

			$betting_price = $game->price;
			$betting_value =json_decode($game_session->betting_value);

			$type = $game_session->type;
			$total_minute = $game_session->total_minute;
			$stop_before_minute = $total_minute-$game_session->stop_before_minute;

			$time_add_type = '';
			if($type==1) $time_add_type = 'second';
			if($type==2) $time_add_type = 'minute';

			$session_id = $game_session->session_id;
			$session_start_date_time = date("Y-m-d H:i:s",strtotime($game_session->date_time2."+2 second "));
			$session_end_date_time = date("Y-m-d H:i:s",strtotime($session_start_date_time."+$total_minute $time_add_type "));
			

			/*total duration*/
				$date1 = date("Y-m-d H:i:s");
				$date2 = date("Y-m-d H:i:s",strtotime($game_session->date." ".$game_session->time."+$total_minute $time_add_type"));
				$date1=date_create($date1);
				$date2=date_create($date2);
				$diff=date_diff($date1,$date2);
				// echo $diff_time = $diff->i.":".$diff->s;
				$milisec = ($diff->h)+($diff->i*60 * 1000)+($diff->s*1000);			
			/*total duration end*/


			/*stop betting duration*/		
				$date1 = date("Y-m-d H:i:s");		
				$date2 = date("Y-m-d H:i:s",strtotime($game_session->date." ".$game_session->time."+$stop_before_minute $time_add_type"));
				$date1=date_create($date1);
				$date2=date_create($date2);
				$diff=date_diff($date1,$date2);
				// echo $diff_time = $diff->i.":".$diff->s;
				$stop_before_minute = ($diff->h)+($diff->i*60 * 1000)+($diff->s*1000);			
				$stop_before_minute = $stop_before_minute+1000;			
			/*stop betting duration end*/

			if($date_time>$session_end_date_time)
			{
				$milisec = 0;
				$stop_before_minute = 0;
			}
			if($game_session->bet_stop_date_time<$date_time) $stop_before_minute = 0;

			$winner_data = $this->winner_data($session_id,$game_id,$user_id);

			$response_data['total_duration'] = $milisec;
			$response_data['stop_betting_after'] = $stop_before_minute;
			$response_data['session_id'] = $session_id;
			$response_data['session_name'] = $game_session->game_name;
			$response_data['betting_price'] = $betting_price;
			$response_data['session_start_date_time'] = $session_start_date_time;
			$response_data['session_end_date_time'] = $session_end_date_time;
			$response_data['result'] = $game_session->result;
			$response_data['is_result_declare'] = $game_session->is_result_declare;
			$response_data['winner_data'] = $winner_data;
			$response_data['betting_value'] = $betting_value;
			if($game_status==1)
			{
				if($milisec>0) $response_data['game_status'] = 1;
				else $response_data['game_status'] = 2;
			}
			else
			{
				$response_data['game_status'] = $game_status;
			}


		}		
		return $response_data;
	}

	public function betting_amount($user_id,$session_id,$game_id)
	{
		$betting = $this->db->select_sum('bet_amount')->get_where("game_bet",array("user_id"=>$user_id,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object()[0]->bet_amount;
		if(empty($betting))$betting = 0;
		return $betting;
	}


	public function winner_data($session_id,$game_id,$user_id)
	{
		$current_session_id = $session_id;
		$old_session_id = $session_id-1;
		// $old_session_id = 202402131981;

		$win_data = $this->db
		->where(" win_amount>0 ")
		->get_where("game_bet",array("session_id"=>$old_session_id,"game_id"=>$game_id,"user_id"=>$user_id,))->result_object();
		if(!empty($win_data))
		{
			foreach ($win_data as $key => $value)
			{
				$response_data[] = array(
					"session_id"=>strval($old_session_id),
					"win_name"=>'',
					"user_id"=>$value->user_id,
					"win_amount"=>$value->win_amount,
				);
			}
		}

		$win_data = $this->db
		->where(" win_amount>0 and user_id!='$user_id' ")
		->get_where("game_bet",array("session_id"=>$old_session_id,"game_id"=>$game_id,))->result_object();
		if(!empty($win_data))
		{
			foreach ($win_data as $key => $value)
			{
				$response_data[] = array(
					"session_id"=>strval($old_session_id),
					"win_name"=>'',
					"user_id"=>$value->user_id,
					"win_amount"=>$value->win_amount,
				);
			}
		}
		else
		{
			$response_data[] = array(
					"session_id"=>strval($old_session_id),
					"win_name"=>'',
					"user_id"=>'0',
					"win_amount"=>'',
				);
		}
		return $response_data;

	}
}