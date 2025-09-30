<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_manual extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Game Manual', 
						   	'table_name'=>'game_sessions',
						   	'page_title'=>'Game Manual',
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


   public function start_game()
	{
		$game_id = $this->input->post('game_id');
		$session_table_name = "game_sessions";
		$date = date("Y-m-d");
		$games = $this->db->get_where("game",array("status"=>1,))->result_object();

		$check_declare = $this->db->get_where("game_sessions",array("is_result_declare"=>0,))->result_object();
		if(!empty($check_declare))
		{
			$resultr['status'] = "400";
			$resultr['message'] = "Result Declare First...";
			$resultr['data'] = [];
			echo json_encode($resultr);
			die;
		}


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
				$count = 1;
				$date_time = date("Y-m-d H:i:s");
				$bell_before_date_time = '';
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
						$color = rand(1,3);
						$number = rand(1,9);

						if($color==1)
						{
							$narr = [1,3,7,9];
						}
						if($color==2)
						{
							$narr = [0,5];
						}
						if($color==3)
						{
							$narr = [2,4,6,8];
						}
						$randomKey = array_rand($narr);
						$number = $narr[$randomKey];

						$result = $color.','.$number;


						$date1 = new DateTime($bet_start_date_time);
						$date2 = new DateTime($bet_stop_date_time);
						$interval = ($date2->getTimestamp() - $date1->getTimestamp())/2;
						$bell_before_date_time = date("Y-m-d H:i:s",strtotime($bet_start_date_time."+$interval second"));

						$this->db->insert($session_table_name,array("type"=>$type,"type2"=>$type2,"game_id"=>$game_id,"session_id"=>$session_id2,"date_time"=>$string_date_time,"date_time2"=>$date_time2,"date"=>$date,"time"=>$time,"total_minute"=>$total_minute,"stop_before_minute"=>$stop_before_minute,"bet_stop_before_date_time"=>$bet_stop_before_date_time,"betting_value"=>$betting_value,"game_name"=>$game_name,"result"=>$result,"is_delete"=>0,"status"=>1,"bet_start_date_time"=>$bet_start_date_time,"bet_stop_date_time"=>$bet_stop_date_time,"bell_before_date_time"=>$bell_before_date_time,"black_amount"=>0,"blue_amount"=>0,"red_amount"=>0,));
						$session_id2 +=1;							
					}
					$i++;			
				}
			}
		}
		$this->db->update("game",array("game_status"=>1,),array("id"=>$game_id));
		$resultr['status'] = "200";
		$resultr['message'] = "Success...";
		$resultr['data'] = [];
		echo json_encode($resultr);

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


		$game_session = $this->db->get_where("game_sessions",array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();
		if(!empty($game_session))
		{
			$game_session = $game_session[0];
			$game_id = $game_session->game_id;

			$game_session_data = $this->Game_model->session_data($game_session->game_id,$session_id);
			$data['session_id'] = strval($game_session_data['session_id']);
			$data['session_name'] = strval($game_session_data['session_name']);
			$data['betting_price'] = strval($game_session_data['betting_price']);
			$data['session_start_date_time'] = strval($game_session_data['session_start_date_time']);
			$data['session_end_date_time'] = strval($game_session_data['session_end_date_time']);
			$data['duration'] = strval($game_session_data['total_duration']);
			$data['stop_betting_after'] = strval($game_session_data['stop_betting_after']);
			$data['bet_end_date_time'] = strval($game_session_data['bet_end_date_time']);
			$data['bell_before_date_time'] = strval($game_session_data['bell_before_date_time']);
			
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
		$p_id = $this->input->post('p_id');
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

			$blackbet = $game_sessions->black_amount;
			$bluebet = $game_sessions->blue_amount;
			$redbet = $game_sessions->red_amount;

			if($p_id!='') $win_numbers[1] = $p_id;


			/*total bet amount start*/
				$bet_total_amount = $this->db->where(array("session_id"=>$session_id,"game_id"=>$game_id,))->select_sum("bet_amount")->get_where("game_bet")->result_object();
				if(!empty($bet_total_amount[0]->bet_amount)) $bet_total_amount = $bet_total_amount[0]->bet_amount;
				else $bet_total_amount = 0;
			/*total bet amount end*/


			$nbamount = 0;
			$number_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>2,"p_id"=>$p_id,])->result_object();
			if(!empty($number_bets[0]->bet_amount))
			{
				$nbamount = $number_bets[0]->bet_amount;
			}

			if(in_array($p_id,[1,3,7,9]))
			{
				$cbamount = 0;
				$color_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>1,])->result_object();
				if(!empty($color_bets[0]->bet_amount))
				{
					$cbamount = $color_bets[0]->bet_amount;
				}

				$win_total_amount = ($cbamount*2)+($nbamount*9);
			}
			else if(in_array($p_id,[2,4,6,8]))
			{
				$cbamount = 0;
				$color_bets = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>3,])->result_object();
				if(!empty($color_bets[0]->bet_amount))
				{
					$cbamount = $color_bets[0]->bet_amount;
				}

				$win_total_amount = ($cbamount*2)+($nbamount*9);
			}
			else if(in_array($p_id,[0,5]))
			{
				if($p_id==0)
				{					
					$cbamountv = 0;
					$color_betsv = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>2,])->result_object();
					if(!empty($color_betsv[0]->bet_amount))
					{
						$cbamountv = $color_betsv[0]->bet_amount;
					}

					$cbamountr = 0;
					$color_betsr = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>3,])->result_object();
					if(!empty($color_betsr[0]->bet_amount))
					{
						$cbamountr = $color_betsr[0]->bet_amount;
					}
					$win_total_amount = ($cbamountv*4.5)+($cbamountr*1.5)+($nbamount*9);
				}
				else if($p_id==5)
				{					
					$cbamountv = 0;
					$color_betsv = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>2,])->result_object();
					if(!empty($color_betsv[0]->bet_amount))
					{
						$cbamountv = $color_betsv[0]->bet_amount;
					}

					$cbamountb = 0;
					$color_betsb = $this->db->select_sum("bet_amount")->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>1,])->result_object();
					if(!empty($color_betsb[0]->bet_amount))
					{
						$cbamountb = $color_betsb[0]->bet_amount;
					}
					$win_total_amount = ($cbamountv*4.5)+($cbamountb*1.5)+($nbamount*9);
				}
			}


			$color_group_record = $this->db
			->where(array("session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,))
			->order_by("bet_amount desc")
			->group_by("p_id")
			->select("p_id")
			->select_sum("bet_amount")
			->get_where("game_bet")
			->result_object();


			$number_group_record = $this->db
			->where(array("session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>2,))
			->order_by("bet_amount desc")
			->group_by("p_id")
			->select("p_id")
			->select_sum("bet_amount")
			->get_where("game_bet")
			->result_object();
			   


			$profit_loss_amount = $bet_total_amount-$win_total_amount;
			$data = array(
				"bet_total_amount"=>$bet_total_amount,
				"win_total_amount"=>$win_total_amount,
				"profit_loss_amount"=>$profit_loss_amount,
				"win_numbers"=>$win_numbers,
				"color_group_record"=>$color_group_record,
				"number_group_record"=>$number_group_record,
			);


			$bet_table_name = "game_bet";
			$bettings = $this->db
			->select("users.fname as name")
			->select("game_bet.p_id as p_id")
			->select("game_bet.user_id as user_id")
			->select("game_bet.bet_amount as bet_amount")
			->select("game_bet.win_amount as win_amount")
			->select("game_bet.p_type as p_type")
			->join("users as users","game_bet.user_id=users.id","LEFT")
			->get_where($bet_table_name,array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();				
			$data['bettings'] = $bettings;
			$data['about_to_pay_amount'] = $this->Game_model->about_to_pay_amount($session_id,$game_id);

			


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
	public function declare_result()
	{	
		$session_id = $this->input->post('session_id');
		$game_id = $this->input->post('game_id');
		$p_id = $this->input->post('p_id');

		$this->load->model('Game_model');
		$game_session_data = $this->Game_model->session_data($game_id,$session_id);


		$result = $game_session_data['result'];
		$is_result_declare = $game_session_data['is_result_declare'];
		
		$color_win = explode(",",$result)[0];
		$number_win = $p_id;
		$result = $color_win.','.$number_win;





		$this->db->update("game_sessions",array("is_result_declare"=>1,"result"=>$result,),array("session_id"=>$session_id,"game_id"=>$game_id,));
		
		$color_bets = [];
		$color_betsv = [];
		$color_betsb = [];



		/*number bets winners start*/
			$number_bets = $this->db->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>2,"p_id"=>$p_id,])->result_object();
			foreach ($number_bets as $key => $value)
			{
				$final_amount = $value->bet_amount*9;
				$win_data = array(
					"win_amount"=>$final_amount,
				);
				$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
				$message = 'Game Win Amount';
				$this->custom->win_amount_credit_debit($value->user_id,"credit",$final_amount,$message,0,4,0,$session_id);
			}
		/*number bets winners end*/

		


		if(in_array($p_id,[1,3,7,9]))
		{
			/*black color bets winners start*/
				$color_bets = $this->db->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>1,])->result_object();
				foreach ($color_bets as $key => $value)
				{
					$final_amount = $value->bet_amount*2;
					$win_data = array(
						"win_amount"=>$final_amount,
					);
					$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
					$message = 'Game Win Amount';
					$this->custom->win_amount_credit_debit($value->user_id,"credit",$final_amount,$message,0,4,0,$session_id);
				}
			/*black color bets winners end*/
		}
		else if(in_array($p_id,[2,4,6,8]))
		{
			/*red color bets winners start*/
				$color_bets = $this->db->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>3,])->result_object();
				foreach ($color_bets as $key => $value)
				{
					$final_amount = $value->bet_amount*2;
					$win_data = array(
						"win_amount"=>$final_amount,
					);
					$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
					$message = 'Game Win Amount';
					$this->custom->win_amount_credit_debit($value->user_id,"credit",$final_amount,$message,0,4,0,$session_id);
				}	
			/*red color bets winners end*/
		}
		else if(in_array($p_id,[0,5]))
		{
			if($p_id==0)
			{

				/*violet color bets winners start*/
					$color_betsv = $this->db->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>2,])->result_object();
					
					foreach ($color_betsv as $key => $value)
					{
						$final_amount = $value->bet_amount*4.5;
						$win_data = array(
							"win_amount"=>$final_amount,
						);
						$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
						$message = 'Game Win Amount';
						$this->custom->win_amount_credit_debit($value->user_id,"credit",$final_amount,$message,0,4,0,$session_id);
					}
				/*violet color bets winners end*/



				/*red color bets winners start*/
					$color_betsr = $this->db->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>3,])->result_object();
					foreach ($color_betsr as $key => $value)
					{
						$final_amount = $value->bet_amount*1.5;
						$win_data = array(
							"win_amount"=>$final_amount,
						);
						$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
						$message = 'Game Win Amount';
						$this->custom->win_amount_credit_debit($value->user_id,"credit",$final_amount,$message,0,4,0,$session_id);
					}
				/*red color bets winners end*/				
				
			}
			else if($p_id==5)
			{					
				
				/*violet color bets winners start*/
					$color_betsv = $this->db->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>2,])->result_object();
					foreach ($color_betsv as $key => $value)
					{
						$final_amount = $value->bet_amount*4.5;
						$win_data = array(
							"win_amount"=>$final_amount,
						);
						$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
						$message = 'Game Win Amount';
						$this->custom->win_amount_credit_debit($value->user_id,"credit",$final_amount,$message,0,4,0,$session_id);
					}
				/*violet color bets winners end*/


				/*black color bets winners end*/
					$color_betsb = $this->db->get_where('game_bet',["session_id"=>$session_id,"game_id"=>$game_id,"p_type"=>1,"p_id"=>1,])->result_object();
					foreach ($color_betsb as $key => $value)
					{
						$final_amount = $value->bet_amount*1.5;
						$win_data = array(
							"win_amount"=>$final_amount,
						);
						$this->db->update("game_bet",$win_data,array("id"=>$value->id,));
						$message = 'Game Win Amount';
						$this->custom->win_amount_credit_debit($value->user_id,"credit",$final_amount,$message,0,4,0,$session_id);
					}
				/*black color bets winners end*/
				
			}
		}


	}
	public function live_session_id()
	{
		$game_id = $this->input->post("game_id");
		$session_id = $this->input->post("session_id");
		$game_session_data = $this->Game_model->session_data($game_id,$session_id);
		$session_id = strval($game_session_data['session_id']);
		$bet_table_name = "game_bet";
		$game_session = $this->db->get_where("game_sessions",array("session_id"=>$session_id,"game_id"=>$game_id,))->result_object();
		if(!empty($game_session))
		{
			$game_session = $game_session[0];
			$game_id = $game_session->game_id;
			$data['session_id'] = strval($game_session_data['session_id']);
			$data['session_name'] = strval($game_session_data['session_name']);
			$data['betting_price'] = strval($game_session_data['betting_price']);
			
			
// 			$data['session_start_date_time'] = date("d M Y h:i:s a",strtotime(strval($game_session_data['session_start_date_time'])));
// 			$data['session_end_date_time'] = date("d M Y h:i:s a",strtotime(strval($game_session_data['session_end_date_time'])));
			
			$data['session_start_date_time'] = strval($game_session_data['session_start_date_time']);
			$data['session_end_date_time'] = strval($game_session_data['session_end_date_time']);
			
			
			$data['bet_end_date_time'] = strval($game_session_data['bet_end_date_time']);
			$data['bell_before_date_time'] = strval($game_session_data['bell_before_date_time']);
			$data['duration'] = strval($game_session_data['total_duration']);
			$data['stop_betting_after'] = strval($game_session_data['stop_betting_after']);			
			$data['result'] = explode(",",$game_session_data['result']);			
			$data['game_name'] = $game_session->game_name;
			$data['game_id'] = $game_session->game_id;
		}
		$data['game_status'] = $game_session_data['game_status'];
		echo json_encode($data);
	}
	public function stop_game()
	{
		$game_id = $this->input->post("game_id");
		$stopdatetime = $this->input->post("stopdatetime");
		$stopmessage = $this->input->post("stopmessage");

		$this->db->update("game",array("stop_date_time"=>$stopdatetime,"game_message"=>$stopmessage,"game_status"=>0,),array("id"=>$game_id));

		$result['status'] = '200';
		$result['message'] = 'Success';
		$result['data'] = [];
		echo json_encode($result);
	}

	



}







