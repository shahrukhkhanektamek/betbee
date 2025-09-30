<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {
	 
	

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Game_model');
        $this->load->model('Custom_model','custom');
        $this->token_data = token_auth();
    }
    

	public function list()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$data = $this->db->select('id,name,price,total_minute,stop_before_minute')->get_where("game",array("status"=>1,))->result_object();
		if(!empty($data))
		{
			$result['status'] = "200";
			$result['message'] = "Success";
			$result['data'] = $data;
		}
		else
		{
			$result['status'] = "200";
			$result['message'] = "Empty";
			$result['data'] = $data;
		}
		echo json_encode($result);
	}

	public function check_winner()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$session_id = $this->input->post("session_id");	
		$game_id = $this->input->post("game_id");	
		$game_session_data = $this->Game_model->session_data($game_id);	
		$result['status'] = "200";
		$result['message'] = "Success";
		$result['data'] = $game_session_data['winner_data'];
		$result['session_id'] = $game_session_data['session_id'];
		echo json_encode($result);
	}

	public function detail()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$game_id = $this->input->post("game_id");		
		$screen_size = $this->input->post("screen_size");		
		$user = $this->db->get_where("users",array("id"=>$user_id,))->result_object();
		$game = $this->db->select('id,stop_date_time')->get_where("game",array("id"=>$game_id,))->result_object();
		if(!empty($user))
		{
			$user = $user[0];
			if(empty($game))
			{
				$result['status'] = "200";
				$result['message'] = "Wrong game id";
				$result['data'] = [];
				echo json_encode($result);
				die;
			}
			$game = $game[0];

			$game_session_data = $this->Game_model->session_data($game_id);
			$data['session_id'] = $session_id = strval($game_session_data['session_id']);
			$data['session_name'] = strval($game_session_data['session_name']);
			$data['betting_price'] = strval($game_session_data['betting_price']);
			$data['session_start_date_time'] = strval($game_session_data['session_start_date_time']);
			$data['session_end_date_time'] = strval($game_session_data['session_end_date_time']);
			$data['bet_end_date_time'] = strval($game_session_data['bet_end_date_time']);
			$data['duration'] = strval($game_session_data['total_duration']);
			$data['stop_betting_after'] = strval($game_session_data['stop_betting_after']);
			$data['game_id'] = strval($game_id);
			$data['game_status'] = strval($game_session_data['game_status']);
			$data['stop_date_time'] = strval($game->stop_date_time);

			$data['winner_data'] = $game_session_data['winner_data'];
			$data['user_id'] = $user_id;
			$data['betting_amount'] = $this->Game_model->betting_amount($user_id,$session_id,$game_id);
			$old_session_id = $session_id-1;
			$data['old_betting_amount'] = $this->Game_model->betting_amount($user_id,$old_session_id,$game_id);

			if($screen_size>700) $limit = 50;
			else $limit = 15;
         	$offset = 0;
			$crtime = (date("Y-m-d H:i:s"));
	        $this->db->limit($limit,$offset);
	        $this->db->order_by("game_sessions.id desc");
	        $this->db->where("game_sessions.date_time2 < ",$crtime);
	        $tickets = $this->db
         	->select("game_sessions.result")
         	->select("game_sessions.session_id")
        //  	->where(" session_id!='$session_id' ")
            ->where(" is_result_declare='1' ")
         	->where(array('game_sessions.game_id'=>$game_id,))
         	->from('game_sessions as game_sessions')->get()->result_object();

			$data['last_win_ticket'] = $tickets;
			    
			   if($data['game_status']==3)
			   {
			       if(date("Y-m-d H:i:s")>$data['stop_date_time'])
			       {
			           $data['game_status'] = 5;
			       }
			   }
			

			$selected_games = $this->db
	        	->select("game_bet.p_id as p_id")
	        	->select("game_bet.amount as amount")
	        	->select("game_bet.p_type as type")
	         	->where(" game_bet.session_id='$session_id' ")
	         	->where(array('game_bet.game_id'=>$game_id,"user_id"=>$user_id,))
	         	->from('game_bet as game_bet')->get()->result_object();


	        $color_wise_bets = $this->Game_model->color_wise_bets($user_id,$session_id,$game_id);
	        $data['game_bets'] = $color_wise_bets;
	        


	        $data['selected_games'] = $selected_games;

	        $last_win_amount = 0;
	        $last_win_data = $this->db
	        ->select_sum('win_amount')
	        ->where(" win_amount>0 ")
	        ->limit(1)
	        ->order_by("id desc")
	        ->get_where("game_bet",["user_id"=>$user_id,"session_id"=>$old_session_id,"game_id"=>$game_id,])->result_object();
	        if(!empty($last_win_data))
	        {
	        	$last_win_amount = $last_win_data[0]->win_amount;
	        }

	        $data['last_win_amount'] = $last_win_amount;
	         
	         
	        $wallet_amt = $this->custom->wallet($user_id);

			$result['status'] = "200";
			$result['message'] = "Success";
			$result['data'] = $data;
			$result['wallet_amt'] = price_formate($wallet_amt+$this->custom->win_amount($user_id));
			$result['wallet_amt_string'] = $wallet_amt+$this->custom->win_amount($user_id);
		}
		else
		{
			$color_wise_bets = $this->Game_model->color_wise_bets($user_id,$session_id,$game_id);
	        $data['game_bets'] = $color_wise_bets;

			$result['status'] = "400";
			$result['message'] = "Wrong user id";
			$result['data'] = [];
		}
		echo json_encode($result);
	}

	public function ticket_list()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$game_id = $this->input->post("game_id");
		$response_data = array();
		$i = 1;
		while ($i<=75) {
			$response_data[] = array("name"=>'',"number"=>$i,);
			$i++;
		}
		$result['status'] = "200";
		$result['message'] = "Ticket list";
		$result['data'] = $response_data;
		echo json_encode($result);
	}

	public function select_number()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$game_id = $this->input->post("game_id");
		$session_id = $this->input->post("session_id");
		$number = $this->input->post("number");
		$response_data = array();
		$user_data = array(
			"user_id"=>$user_id,
			"game_id"=>$game_id,
			"session_id"=>$session_id,
			"number"=>$number,
		);
		$count = count($this->db->get_where("select_number",array("user_id"=>$user_id,"session_id"=>$session_id,"game_id"=>$game_id,))->result_object());
		if(empty($this->db->get_where("select_number",$user_data)->result_object()))
		{
			if($count<7)
			{
				$this->db->insert("select_number",$user_data);
			}
		}
		$data = $this->db->get_where("select_number",array("user_id"=>$user_id,"game_id"=>$game_id,"session_id"=>$session_id,))->result_object();		
		$result['status'] = "200";
		if($count<7)
			$result['message'] = "Add successfully";
		else
			$result['message'] = "Ticket limit only 7";
		$result['data'] = $data;		
		echo json_encode($result);
	}
	public function remove_select_number()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$game_id = $this->input->post("game_id");
		$session_id = $this->input->post("session_id");
		$id = $this->input->post("id");


		$this->db->delete("select_number",array("id"=>$id,));
		$data = $this->db->get_where("select_number",array("user_id"=>$user_id,"game_id"=>$game_id,"session_id"=>$session_id,))->result_object();		
		$result['status'] = "200";
		$result['message'] = "Remove successfully";
		$result['data'] = $data;		
		echo json_encode($result);
	}

	public function remove_all_select_number()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$game_id = $this->input->post("game_id");
		$session_id = $this->input->post("session_id");
		
		$this->db->delete("select_number",array("user_id"=>$user_id,"game_id"=>$game_id,"session_id"=>$session_id,));		
		$result['status'] = "200";
		$result['message'] = "Remove successfully";
		$result['data'] = [];		
		echo json_encode($result);
	}


	public function do_bet()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
       
       // $device_id = $this->session->userdata("device_id");
       //  $check_login = $this->db->order_by('id desc')->limit(1)->get_where("login_history",array('device_id'=>$device_id,"status"=>1,))->result_object();
       //  if(empty($check_login))
       //  {
       //    $result['status'] = "400";
       //    $result['message'] = "Invalid User!";
       //    $result['data'] = [];
       //    echo json_encode($result);
       //    die;
       //  }       
        
        
		$session_id = $this->input->post("session_id");
		$amount = $this->input->post("bet_amount");
		$p_id = $this->input->post("p_id");
		$game_id = $this->input->post("game_id");
		$p_type = $this->input->post("type");
		$type = "debit";
		$type2 = "game";
		$date = date("Y-m-d");
		$r_amount = $this->custom->wallet($user_id);
		$time = date("H:i:s");
		$date_time = date("Y-m-d H:i:s");
		$fees = $amount/100*feess;
		$amountb =$amount;
		$response_data = array(
			"user_id"=>$user_id,
			"amount"=>$amount,
			"p_id"=>$p_id,
		);		

		$user = $this->db->get_where("users",array("id"=>$user_id,))->result_object();
		$game = $this->db->get_where("game",array("id"=>$game_id,))->result_object();

		$get_user_wallet = $this->custom->wallet($user_id);
		$get_user_winning_amt = $this->custom->win_amount($user_id);

        $wallet_amount_deduct = 0;
        $win_amount_deduct = 0;
        $check_total_amount = 0;
        if($get_user_wallet>=$amount)
        {
            /*wallet section*/
            $check_total_amount = $wallet_amount_deduct = $amount;
        }
        else
        {
            /*win amount section*/
            if($get_user_wallet>0)
            {
                $wallet_amount_deduct = $get_user_wallet;
                if($get_user_winning_amt>0)
                {
                    if(($amount-$wallet_amount_deduct)>$get_user_winning_amt)
                        $win_amount_deduct = $get_user_winning_amt;
                    else
                        $win_amount_deduct = $amount-$wallet_amount_deduct;
                }
            }
            else
            {
                if(($amount-$wallet_amount_deduct)>$get_user_winning_amt)
                    $win_amount_deduct = $get_user_winning_amt;
                else
                    $win_amount_deduct = $amount-$wallet_amount_deduct;
            }
        }
        $check_total_amount = $wallet_amount_deduct+$win_amount_deduct;


        if($check_total_amount<$amount)
        {
            $result['status'] = '400';
            $result['message'] = 'Wallet Recharge First...';
            $result['data'] = [];
            echo json_encode($result);
            die;
        }


		
        $color = '';


		$game_session = $this->db->get_where('game_sessions',array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();
		if(empty($user))
		{
			$result['status'] = "400";
			$result['message'] = "Wrong user id";
			$result['data'] = $response_data;
			echo json_encode($result);
			die;
		}
		if(empty($game_session))
		{
			$result['status'] = "400";
			$result['message'] = "Wrong session id";
			$result['data'] = $response_data;
			echo json_encode($result);
			die;
		}
		if(empty($game))
		{
			$result['status'] = "400";
			$result['message'] = "Wrong Game id";
			$result['data'] = $response_data;
			echo json_encode($result);
			die;
		}
		$game_session = $game_session[0];
		$user = $user[0];


		if(date("Y-m-d H:i:s")>=$game_session->bet_stop_before_date_time)
		{
			$result['status'] = "400";
			$result['message'] = "Wait for next round";
			$result['data'] = $response_data;
			echo json_encode($result);
			die;
		}

		
		$session_total_amount = $game_session->total_amount;

		

		$wallet_amt = $this->custom->wallet($user_id);

		$date5 = date("Y-m-d");
		$game_success = false;
		$check_bet_session = $this->db->get_where('game_bet',array("session_id"=>$session_id,"user_id"=>$user_id,"p_id"=>$p_id,"game_id"=>$game_id,))->result_object();
		// if(!empty($check_bet_session))
		// {
		// 	$result['status'] = "400";
		// 	$result['message'] = "Allready Bet..";
		// 	$result['wallet_amt'] = $wallet_amt;
		// 	echo json_encode($result);
		// 	die;
		// }

		$insert_bet_data = array(
			"user_id"=>$user_id,
			"game_id"=>$game_id,
			"amount"=>$amountb,
			"bet_amount"=>$amount,
			"session_id"=>$session_id,
			"p_id"=>$p_id,
			"p_type"=>$p_type,
			"date"=>date("Y-m-d H:i:s"),
		);
		

	

		$check_betuex = $this->db->limit(1)->get_where('game_bet',["user_id"=>$user_id,"game_id"=>$game_id,"session_id"=>$session_id,"p_id"=>$p_id,"p_type"=>$p_type,])->result_object();

		if(empty($check_betuex))
		{
			if($this->db->insert('game_bet',$insert_bet_data))
			{
				$bet_insert_id = $this->db->insert_id();
				$game_success = true;
			}
		}
		else
		{
			$bet_insert_id = $check_betuex[0]->id;
			$insert_bet_data = array(
				"amount"=>$amountb+$check_betuex[0]->amount,
				"bet_amount"=>$amount+$check_betuex[0]->bet_amount,
				"date"=>date("Y-m-d H:i:s"),
			);
			if($this->db->update('game_bet',$insert_bet_data,["id"=>$bet_insert_id,]))
			{
				$game_success = true;
			}
		}
		

		if($game_success)
		{

			if($wallet_amount_deduct>0) $this->custom->wallet_credit_debit($user_id,$type,$wallet_amount_deduct,"Game Play",$bet_insert_id,3,1,$session_id);
	        if($win_amount_deduct>0) $this->custom->win_amount_credit_debit($user_id,"debit",$win_amount_deduct,"Game Play",$bet_insert_id,3,2,$session_id);


	        $color_wise_bets = $this->Game_model->color_wise_bets($user_id,$session_id,$game_id);
	        $data['game_bets'] = $color_wise_bets;

	        $data['bet_insert_id'] = $bet_insert_id;


			$wallet_amt = $this->custom->wallet($user_id);
			$data['betting_amount'] = $this->Game_model->betting_amount($user_id,$session_id,$game_id);

			$result['status'] = "200";
			$result['message'] = "Bet Success..";
			$result['wallet_amt'] = price_formate($wallet_amt+$this->custom->win_amount($user_id));
			$result['wallet_amt_string'] = $wallet_amt+$this->custom->win_amount($user_id);
			$result['data'] = $data;
		}
		else
		{

			$color_wise_bets = $this->Game_model->color_wise_bets($user_id,$session_id,$game_id);
	        $data['game_bets'] = $color_wise_bets;

			$wallet_amt = $this->custom->wallet($user_id);
			$result['status'] = "400";
			$result['message'] = "Bet Not Success..";
			$result['wallet_amt'] = price_formate($wallet_amt+$this->custom->win_amount($user_id));
			$result['wallet_amt_string'] = $wallet_amt+$this->custom->win_amount($user_id);
		}
		echo json_encode($result);			
	}
	public function wining_history()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$wallet_amt = $this->custom->wallet($user_id);
		$crtime = strtotime(date("Y-m-d H:i:s"));
		$this->db->limit(17,1);	
		$this->db->order_by("id desc");
		$this->db->where("game_sessions.date_time <= ",$crtime);
		$my_orders = $this->db->get_where('game_sessions')->result_object();
		$orders = array();
		foreach ($my_orders as $key => $value) {
			$orders[] = array(
	            "session_id"=>$value->session_id,
	            "ticket_numbers"=>$value->result,
	            "result"=>$value->result,
	            "user_id"=>'0',
	            "user_name"=>'',
	            "win_amount"=>'0',
	            "date_time"=>$value->date_time,
			);
		}
		$data['message'] = "Fetch";
		$data['status'] = "200";
		$data['wallet_amount'] = strval($wallet_amt+$this->custom->win_amount($user_id));
		$result['wallet_amt_string'] = $wallet_amt+$this->custom->win_amount($user_id);
		$data['my_orders'] = $orders;
		echo json_encode($data);
	}
	public function my_orders()
	{
		$token_data = $this->token_data;
        $user_id = $token_data->user_id;
		$wallet_amt = $this->custom->wallet($user_id);
		$crtime = strtotime(date("Y-m-d H:i:s"));
		$this->db->limit(50);	
		$this->db->order_by("id desc");
		$this->db->where("game_sessions.date_time <= ",$crtime);
		$my_orders = $this->db->get_where('game_sessions')->result_object();
		$orders = array();
		foreach ($my_orders as $key => $value) {
			$orders[] = array(
	            "session_id"=>$value->session_id,
	            "ticket_numbers"=>$value->result,
	            "result"=>$value->result,
	            "user_id"=>'',
	            "win_loss_type"=>'0',
	            "win_loss_amount"=>'0',
	            "bet_amount"=>'0',
	            "date_time"=>$value->date_time,
			);
		}
		$data['message'] = "Fetch";
		$data['status'] = "200";
		$data['wallet_amount'] = strval($wallet_amt+$this->custom->win_amount($user_id));
		$result['wallet_amt_string'] = $wallet_amt+$this->custom->win_amount($user_id);
		$data['my_orders'] = $orders;
		echo json_encode($data);
	}
	public function undo()
	{
		$token_data = $this->token_data; 
        $user_id = $token_data->user_id;
        $game_id = $this->input->post('game_id');
        $session_id = $this->input->post('session_id');
         $bet_insert_id = $this->input->post('bet_insert_id');
        $amount = $this->input->post('amount');
        $last_id = 0;


        $game_session = $this->db->get_where('game_sessions',array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();
        $game_session = $game_session[0];
        if(date("Y-m-d H:i:s")>=$game_session->bet_stop_before_date_time)
		{
			$result['status'] = "400";
			$result['message'] = "Wait for next round";
			$result['data'] = $response_data;
			echo json_encode($result);
			die;
		}





        $game_bet = $this->db->order_by('id desc')->limit(1)->get_where('game_bet',array("session_id"=>$session_id,"game_id"=>$game_id,"user_id"=>$user_id,"id"=>$bet_insert_id,))->result_object();
        $wallet_amt = $this->custom->wallet($user_id);
        if(!empty($game_bet))
        {
        	$game_bet = $game_bet[0];
        	$last_id = $game_bet->id;
        	$p_id = $game_bet->p_id;

        	if($game_bet->amount-$amount<1) $this->db->delete('game_bet',array("id"=>$last_id,));
	            
	        
	        $bet_data['amount'] = $game_bet->amount-$amount;
	        $bet_data['bet_amount'] = $game_bet->bet_amount-$amount;
	        $this->db->update("game_bet",$bet_data,["id"=>$last_id,]);


        	$new_amount = $wallet_amt+$amount;
        	$this->db->update("users",array("wallet"=>$new_amount,),array("id"=>$user_id,));


        	$check = $this->db->limit(1)->get_where('user_history',["user_id"=>$user_id,"session_id"=>$session_id,])->result_object();
        	if(!empty($check))
        	{
	        	$history_data['amount'] = $check[0]->amount-$amount;
	        	$history_data['balance'] = $check[0]->balance+$amount;
	            $this->db->update("user_history",$history_data,["id"=>$check[0]->id,]);        		

        	}

			$wallet_amt = $this->custom->wallet($user_id);
			$data['message'] = "Fetch";
			$data['status'] = "200";
			$data['data'] = array("p_id"=>$p_id,"betting_amount"=>$this->Game_model->betting_amount($user_id,$session_id,$game_id),);
			$data['wallet'] = strval(price_formate($wallet_amt+$this->custom->win_amount($user_id)));
			$result['wallet_amt_string'] = $wallet_amt+$this->custom->win_amount($user_id);
	
        }
        else
		{
			$data['message'] = "Eroor";
			$data['status'] = "400";
			$data['wallet'] = strval(price_formate($wallet_amt+$this->custom->win_amount($user_id)));
			$data['data'] = ["betting_amount"=>$this->Game_model->betting_amount($user_id,$session_id,$game_id)];
			$result['wallet_amt_string'] = $wallet_amt+$this->custom->win_amount($user_id);
		}
		
		$game_bet = $this->db->order_by('id desc')->limit(1)->get_where('game_bet',array("session_id"=>$session_id,"game_id"=>$game_id,"user_id"=>$user_id,))->result_object();
		if(!empty($game_bet)) $data['bet_status'] = 1;
		else $data['bet_status'] = 0;
		
		echo json_encode($data);
	}

	public function bet_detail()
	{
		$data = [];
		$id = $this->input->post("id");
		$type2 = $this->input->post("type2");

		$user_history = $this->db->get_where("user_history",["id"=>$id,])->result_object();
		if(!empty($user_history))
		{
			$user_history = $user_history[0];
			$session_id = $user_history->session_id;

			$game_session = $this->db->get_where('game_sessions',array("session_id"=>$session_id,))->result_object();
			if(!empty($game_session))
			{
				$game_session = $game_session[0];
				if($type2==4)
				{
					$this->db->where(" win_amount>0 ");
				}
				$game_bet = $this->db->get_where("game_bet",["session_id"=>$session_id,])->result_object();
				if(!empty($game_bet))
				{
					$data['message'] = "Success";
					$data['status'] = "200";
					$data['data'] = $game_bet;
					$data['type2'] = $type2;
					$data['session_id'] = $session_id;
					$data['is_result_declare'] = $game_session->is_result_declare;
				}
				else
				{
					$data['message'] = "Eroor";
					$data['status'] = "400";
					$data['data'] = [];
				}
			}
			else
			{
				$data['message'] = "Eroor";
				$data['status'] = "400";
				$data['data'] = [];
			}
		}
		else
		{
			$data['message'] = "Eroor";
			$data['status'] = "400";
			$data['data'] = [];
		}
		echo json_encode($data);
	}
	

	
}