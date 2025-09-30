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
		$response_data['bet_end_date_time'] = '';
		$response_data['bell_before_date_time'] = '';
		$response_data['result'] = '';
		$response_data['winner_data'] = [];
		$response_data['betting_value'] = [];
		$response_data['game_status'] = '0'; // 0=data table empty, 1=running, 2=connecting, 3=stop, 4=result pending

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
			$session_start_date_time = $game_session->bet_start_date_time;
			$session_end_date_time = $game_session->bet_stop_date_time;
			$bet_end_date_time = $game_session->bet_stop_before_date_time;
			$bell_before_date_time = $game_session->bell_before_date_time;
			

			/*total duration*/
				$date1_temp = $date1 = date("Y-m-d H:i:s");
				$date2 = $game_session->bet_stop_date_time;
				$date1=date_create($date1);
				$date2=date_create($date2);
				$diff=date_diff($date1,$date2);
				// echo $diff_time = $diff->i.":".$diff->s;
				$milisec = ($diff->h)+($diff->i*60 * 1000)+($diff->s*1000);			
			/*total duration end*/


			/*stop betting duration*/		
				$date1 = $date1_temp;
				$date2 = $game_session->bet_stop_before_date_time;
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
			$response_data['bet_end_date_time'] = $bet_end_date_time;
			$response_data['bell_before_date_time'] = $bell_before_date_time;
			$response_data['result'] = $game_session->result;
			$response_data['is_result_declare'] = $game_session->is_result_declare;
			$response_data['winner_data'] = $winner_data;
			$response_data['betting_value'] = $betting_value;
			if($game_status==1)
			{
				if($milisec>0) $game_status = 1;
				else $game_status = 2;

				if($game_session->is_result_declare==0 && $game_status==2)
				{
					$game_status = 4;
				}
				$response_data['game_status'] = $game_status;
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
		
		$game_session = $this->db->get_where("game_sessions",array("session_id"=>$old_session_id,))->result_object()[0];
		
		
		$win_data = $this->db
	        ->select("game_bet.user_id as user_id")
	        ->select_sum("game_bet.win_amount")
	        ->group_by('game_bet.user_id')
	        ->where(" game_bet.win_amount>0 ")
	        ->where(array("game_bet.session_id"=>$old_session_id,"game_bet.game_id"=>$game_id,"game_bet.user_id"=>$user_id,))
	        ->get_where("game_bet as game_bet")
	        ->result_object();		
		
		
		if(!empty($win_data))
		{
			foreach ($win_data as $key => $value)
			{
				$response_data[] = array(
					"session_id"=>strval($old_session_id),
					"win_name"=>'',
					"result"=>$game_session->result,
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
					"result"=>$game_session->result,
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
					"result"=>$game_session->result,
					"user_id"=>'0',
					"win_amount"=>'',
				);
		}
		return $response_data;
	}

	public function color_wise_bets($user_id,$session_id,$game_id)
	{
		$my_black_bet = 0;
	        $my_blue_bet = 0;
	        $my_red_bet = 0;

	        $data = $this->db->get_where("game_bet",array("user_id"=>$user_id,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object();

	        return $data;
	}

	public function about_to_pay_amount($session_id,$game_id)
	{
		/*check number start*/
			$number = 0;
			$p_type = 2;
			$nbamount0 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount0 = $number_bets[0]->bet_amount;
			}
		/*check number end*/


		/*check number start*/
			$number = 1;
			$p_type = 2;
			$nbamount1 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount1 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 2;
			$p_type = 2;
			$nbamount2 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount2 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 3;
			$p_type = 2;
			$nbamount3 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount3 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 4;
			$p_type = 2;
			$nbamount4 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount4 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 5;
			$p_type = 2;
			$nbamount5 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount5 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 6;
			$p_type = 2;
			$nbamount6 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount6 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 7;
			$p_type = 2;
			$nbamount7 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount7 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 8;
			$p_type = 2;
			$nbamount8 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount8 = $number_bets[0]->bet_amount;
			}
		/*check number end*/

		/*check number start*/
			$number = 9;
			$p_type = 2;
			$nbamount9 = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>$p_type,"p_id"=>$number,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount9 = $number_bets[0]->bet_amount;
			}
		/*check number end*/


		/*check color violet start*/
			$cbamountv = 0;
			$color_betsv = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>2,])->result_object();
			if(!empty($color_betsv[0]->bet_amount))
			{
				$cbamountv = $color_betsv[0]->bet_amount;
			}
		/*check color violet end*/


		/*check color red start*/
			$cbamountr = 0;
			$color_betsr = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>3,])->result_object();
			if(!empty($color_betsr[0]->bet_amount))
			{
				$cbamountr = $color_betsr[0]->bet_amount;
			}
		/*check color red end*/


		/*check color red start*/
			$cbamountg = 0;
			$color_betsg = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>1,])->result_object();
			if(!empty($color_betsg[0]->bet_amount))
			{
				$cbamountg = $color_betsg[0]->bet_amount;
			}
		/*check color red end*/

		$win_total_amount0 = ($cbamountv*4.5)+($cbamountr*1.5)+($nbamount0*9);
		$win_total_amount1 = ($cbamountg*2)+($nbamount1*9);
		$win_total_amount2 = ($cbamountr*2)+($nbamount2*9);
		$win_total_amount3 = ($cbamountg*2)+($nbamount3*9);
		$win_total_amount4 = ($cbamountr*2)+($nbamount4*9);
		$win_total_amount5 = ($cbamountv*4.5)+($cbamountg*1.5)+($nbamount5*9);
		$win_total_amount6 = ($cbamountr*2)+($nbamount6*9);
		$win_total_amount7 = ($cbamountg*2)+($nbamount7*9);
		$win_total_amount8 = ($cbamountr*2)+($nbamount8*9);
		$win_total_amount9 = ($cbamountg*2)+($nbamount9*9);

		$win_arr = [
			"0"=>["amount"=>$win_total_amount0,"p_id"=>0,],
			"1"=>["amount"=>$win_total_amount1,"p_id"=>1,],
			"2"=>["amount"=>$win_total_amount2,"p_id"=>2,],
			"3"=>["amount"=>$win_total_amount3,"p_id"=>3,],
			"4"=>["amount"=>$win_total_amount4,"p_id"=>4,],
			"5"=>["amount"=>$win_total_amount5,"p_id"=>5,],
			"6"=>["amount"=>$win_total_amount6,"p_id"=>6,],
			"7"=>["amount"=>$win_total_amount7,"p_id"=>7,],
			"8"=>["amount"=>$win_total_amount8,"p_id"=>8,],
			"9"=>["amount"=>$win_total_amount9,"p_id"=>9,],
		];
		// Extract the "amount" column
		$amounts = array_column($win_arr, 'amount');
		// Sort by the "amount" column in ascending order
		array_multisort($amounts, SORT_ASC, $win_arr);

		

		return $win_arr;
	}
}