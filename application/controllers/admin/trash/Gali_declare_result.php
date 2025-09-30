<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gali_declare_result extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Delhi Declare Result', 
						   	'table_name'=>'game_bet',
						   	'page_title'=>'Delhi Declare Result',
						   	"submit_url"=>panel.'/gali_declare_result/update',
						   	"folder_name"=>'gali_declare_result',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/gali_declare_result',
						   	"btn_url"=>panel.'/gali_declare_result/add',
						   	"add_btn_url"=>panel.'/gali_declare_result/add',
						   	"edit_btn_url"=>panel.'/gali_declare_result/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/gali_declare_result/view/',
						   	"controller_name"=>'gali_declare_result',
						   	"page_name"=>'gali_declare_result-detail.php',
						   	"keys"=>'game_bet.id,game_bet.user_id,users.fname,users.mobile,users.user_id',
						   	"all_image_column_names"=>array("image","shop_image"),
						   );  
   public function __construct()
    {
        parent::__construct(); 
        is_logged_in(); 
        is_admin_logged_in();
        create_importent_columns($this->arr_values['table_name']);
        $this->load->model('Custom_model','custom');
        $this->load->model('Image_model');
    }	
	public function index($id='')
	{
		if(empty($id))
		{
			$game = $this->db->select('id')->limit(1)->order_by("id asc")->get_where("game")->result_object();
			if(!empty($game)) $id = $game[0]->id;
		}
		$data['id'] = $id;
		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = $this->arr_values['page_title'];
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
		$data['plan_btn_url'] = $this->arr_values['plan_btn_url'];
		$data['keys'] = $this->arr_values['keys'];			
		$data['pagenation'] = array($this->arr_values['title']);
		$data['trash'] = $this->input->get("trash");
		if(!empty($this->arr_values['all_image_column_names']) && is_array($this->arr_values['all_image_column_names']))
			$data['all_image_column_names'] = implode(",", $this->arr_values['all_image_column_names']);
		else
			$data['all_image_column_names'] = '';

		$row = $this->db->get_where("game",array("id"=>$id,"is_delete"=>0,))->result_object();
		$data['row'] = $row;
		if(!empty($row))
			$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/index', $data);
		else
			$this->template->load('template', panel.'/404', $data);

	}

	public function get_about_to_winners()
	{
		$data = $this->about_to_win_list($this->arr_values['table_name']);		
		return $data;
	}
	public function get_about_to_winners_table()
	{
		$table_id = 1;
		$listcheckbox = 1;
		$is_delete = 0;
		
		$time_id = 0;
	    $game_id = 0;
	    $card_id = 0;
	    $is_delete = 0;
	    $session_id = 0;	
	    $post_data = $this->input->post('post_data');
	    if(!empty($post_data))
	    {
	        $post_data = json_decode($post_data);
	        if(!empty($post_data->game_id))
	          $game_id = $post_data->game_id;
	        if(!empty($post_data->time_id))
	          $time_id = $post_data->time_id;
	        if(!empty($post_data->session_id))
	          $session_id = $post_data->session_id;
	        if(!empty($post_data->panna))
	          $panna = $post_data->panna;
	        if(!empty($post_data->digit))
	          $digit = $post_data->digit;
	        if(!empty($post_data->date))
	          $date = $post_data->date;
	    }
	    $check_data = $this->db->get_where("game_result",array("game_id"=>$game_id,"time_id"=>$time_id,"date"=>$date,))->result_object();
	    if(empty($check_data) && $session_id==2)
	    {
	        $result['message'] = "Declare Open Session Result First";
	        $result['status']  = "400";
	        $result['action']  = "edit";
	        $result['data']  = "";
	        echo json_encode($result);
	        die;
	    }

		if(empty($game_id))
		{
			$result['message'] = "Select Game Name";
	        $result['status']  = "400";
	        $result['action']  = "edit"; 
	        $result['data']  = "";       
	        echo json_encode($result);
	        die;
		}
		else if(empty($time_id))
		{
			$result['message'] = "Select Game Name";
	        $result['status']  = "400";
	        $result['action']  = "edit"; 
	        $result['data']  = "";       
	        echo json_encode($result);
	        die;
		}
		else if(empty($session_id))
		{
			$result['message'] = "Select Session";
	        $result['status']  = "400";
	        $result['action']  = "edit"; 
	        $result['data']  = "";       
	        echo json_encode($result);
	        die;
		}
		else if(empty($panna))
		{
			$result['message'] = "Select Panna";
	        $result['status']  = "400";
	        $result['action']  = "edit"; 
	        $result['data']  = "";       
	        echo json_encode($result);
	        die;
		}
		$data = $this->about_to_win_list($this->arr_values['table_name']);
		$html = $this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data,true);
		$result['message'] = "Winners History";
        $result['status']  = "200";
        $result['action']  = "edit";
        $result['data']  = $html;
        echo json_encode($result);
	    die;

	}
	public function now_declare_result()
	{
		$table_id = 1;
		$listcheckbox = 1;
		$is_delete = 0;
		$data = $this->about_to_win_list($this->arr_values['table_name']);
		$list = $data['list'];
		$check_data = $this->db->get_where("game_result",array("game_id"=>$data['game_id'],"time_id"=>$data['time_id'],"date"=>$data['date'],))->result_object();


		if(empty($data['game_id']))
		{
			$result['message'] = "Select Game Name";
	        $result['status']  = "400";
	        $result['action']  = "edit";        
	        echo json_encode($result);
	        die;
		}
		else if(empty($data['time_id']))
		{
			$result['message'] = "Select Time Name";
	        $result['status']  = "400";
	        $result['action']  = "edit";        
	        echo json_encode($result);
	        die;
		}
		else if(empty($data['session_id']))
		{
			$result['message'] = "Select Session";
	        $result['status']  = "400";
	        $result['action']  = "edit";        
	        echo json_encode($result);
	        die;
		}
		else if(empty($data['panna']))
		{
			$result['message'] = "Select Panna";
	        $result['status']  = "400";
	        $result['action']  = "edit";        
	        echo json_encode($result);
	        die;
		}		
	    else if(empty($check_data) && $data['session_id']==2)
	    {
	        $result['message'] = "Declare Open Session Result First";
	        $result['status']  = "400";
	        $result['action']  = "edit";
	        $result['data']  = "";
	        echo json_encode($result);
	        die;
	    }
	    else if(!empty($check_data) && $data['session_id']==1)
	    {
	        $result['message'] = "Result already Declared";
	        $result['status']  = "400";
	        $result['action']  = "edit";
	        $result['data']  = "";
	        echo json_encode($result);
	        die;
	    }
	    else if(!empty($check_data) && $data['session_id']==2)
	    {
	    	if(!empty(trim($check_data[0]->close_number)))
	    	{
		        $result['message'] = "Result already Declared";
		        $result['status']  = "400";
		        $result['action']  = "edit";
		        $result['data']  = "";
		        echo json_encode($result);
		        die;
		    }
	    }

		
		$game_result_insert_data = array(
			"game_id"=>$data['game_id'],
			"time_id"=>$data['time_id'],
			"session_id"=>$data['session_id'],
			"open_number"=>$data['open_panna_win_number'],
			"jodi_number"=>$data['open_digit_win_number'].$data['close_digit_win_number'],
			"open_single_number"=>$data['open_digit_win_number'],
			"close_single_number"=>$data['close_digit_win_number'],
			"close_number"=>$data['close_panna_win_number'],
			"date"=>$data['date'],
			"status"=>1,
		);
		
		if(empty($check_data))
			$result_declare_id = $this->Custom_model->insert_data("game_result",$game_result_insert_data);
		else
		{
			$result_declare_id = $check_data[0]->id;
			$this->Custom_model->update_data("game_result",$game_result_insert_data,array("id"=>$check_data[0]->id,));
		}


		foreach ($list as $key => $value)
		{
			$win_amount = get_win_amount($value->card_id,$value->amount);
			$game_winners_insert_data = array(
				"result_declare_id"=>$result_declare_id,
				"user_id"=>$value->user_id,
				"session_id"=>$value->session_id,
				"type"=>$value->type,
				"bid"=>$value->bid,
				"bid2"=>$value->bid2,
				"amount"=>$value->amount,
				"card_id"=>$value->card_id,
				"win_amount"=>$win_amount,
				"game_id"=>$data['game_id'],
				"time_id"=>$data['time_id'],
				"status"=>1,
			);
			$this->Custom_model->insert_data("game_winners",$game_winners_insert_data);

			$this->custom->wallet_credit_debit($value->user_id,"credit",$win_amount,"Game Win",0);			
		}


		$this->load->model("Firebase_model");
		$open_panna_win_number = '***';
		$game_time = $this->db->select('name')->get_where("game_times",array("id"=>$data['time_id'],))->result_object();
		$game_name = $game_time[0]->name;
		if(trim($data['open_panna_win_number'])!='') $open_panna_win_number = $data['open_panna_win_number'];
		$title = $open_panna_win_number;
	  $message = $game_name." Result";
		$users = $this->db->get_where("login_history",array("status"=>1,))->result_object();
    foreach ($users as $key => $value)
    {
   		$token = $value->firebase_token;
   	 	$this->Firebase_model->push_notification($token,$message,$title);
    }

		
	    
    $result['message'] = "Result Declared";
    $result['status']  = "200";
    $result['action']  = "edit";        
    echo json_encode($result);
	}

	public function about_to_win_list($table_name)
	{
		
      $table_name = $table_name;
      $limit = 12;
      $page = 1;
      $page1 = 1;
      $offset = 0;
      $status = 1;
      $table_id = 1;
      $kyc_step = 0;
      $listcheckbox = [];
      $filter_search_value = '';
      $keys = '';
      $where_query = "";
      $order_by = "$table_name.id desc";
      $time_id = 0;
      $game_id = 0;
      $card_id = 0;
      $is_delete = 0;
      $session_id = 0;
      $panna = 0;
      $digit = 0;
      $post_data = $this->input->post('post_data');
      if(!empty($post_data))
      {
        $post_data = json_decode($post_data);
        if(!empty($post_data->limit))
          $limit = $post_data->limit;
        if(!empty($post_data->page))
          $page = $post_data->page;
        if(!empty($post_data->filter_search_value))
          $filter_search_value = $post_data->filter_search_value;
        if(!empty($post_data->keys))
          $keys = $post_data->keys;
        if(!empty($post_data->table_id))
          $table_id = $post_data->table_id;
        if(!empty($post_data->game_id))
          $game_id = $post_data->game_id;
        if(!empty($post_data->time_id))
          $time_id = $post_data->time_id;
        if(!empty($post_data->session_id))
          $session_id = $post_data->session_id;
        if(!empty($post_data->panna))
          $panna = $post_data->panna;
        if(!empty($post_data->digit))
          $digit = $post_data->digit;
        if(!empty($post_data->date))
          $date = $post_data->date;
      }
      

      $where_query .= " $table_name.time_id='$time_id' and $table_name.game_id='$game_id' and ";      
      $only_date = $date;

      $year = date("Y",strtotime($date));
      $month = date("m",strtotime($date));
      $day = date("d",strtotime($date));

      if($month[0]==0)$month = $month[1];
      if($day[0]==0)$day = $day[1];
      $date = $year.'-'.$month.'-'.$day;
      $where_query .= " CONCAT(YEAR($table_name.add_date_time),'-',MONTH($table_name.add_date_time),'-',DAY($table_name.add_date_time))='$date'  and ";
      $where_query .= " $table_name.status='$status' and $table_name.is_delete='$is_delete' ";



      
      $open_panna_win_number = "$panna";
      $close_panna_win_number =$panna;
      $jodi_win_number = '';
     	$open_digit_win_number = $panna[0];
      $close_digit_win_number = $panna[1];      
      $bid1_win_array = [];
      $jodi_digit_number = $open_digit_win_number.$close_digit_win_number; 


      $bid1_win_array = array_merge([$open_digit_win_number],[$jodi_digit_number]);
      $this->db->where_in("session_id",1);
      $this->db->where_in("bid",$bid1_win_array);
      $this->db->where_in("card_id",[1,2,3]);
      $this->db->order_by($order_by);
      $this->db->where($where_query);
      $this->db->limit($limit,$offset);
      $this->db
      ->select("users.fname as fname")
      ->select("users.image as image")
      ->select("users.mobile as mobile")
      ->select("users.wallet as wallet")
      ->select("users.id as user_id")

      ->select("game.name as game_name2")
      ->select("game_times.open_time as open_time")
      ->select("game_times.close_time as close_time")
      ->select("game_times.name as game_name")
      ->select("card.name as game_type")
      ->select("card.win_price as win_price")

      ->select("$table_name.id as id")
      ->select("$table_name.amount as amount")
      ->select("$table_name.bid as bid")
      ->select("$table_name.bid2 as bid2")
      ->select("$table_name.type as type")
      ->select("$table_name.session_id as session_id")
      ->select("$table_name.card_id as card_id")
      ->select("$table_name.add_date_time as add_date_time")

      ->join("game as game","$table_name.game_id=game.id","LEFT")
      ->join("users as users","$table_name.user_id=users.id","LEFT")
      ->join("game_times as game_times","$table_name.time_id=game_times.id","LEFT")
      ->join("card as card","$table_name.card_id=card.id","LEFT");
      $list = $this->db->get($table_name)->result_object();

      $bid1_win_array = array_merge([$close_digit_win_number],[$jodi_digit_number]);
      $this->db->where_in("session_id",2);
      $this->db->where_in("bid",$bid1_win_array);
      $this->db->where_in("card_id",[1,2,3]);
      $this->db->order_by($order_by);
      $this->db->where($where_query);
      $this->db->limit($limit,$offset);
      $this->db
      ->select("users.fname as fname")
      ->select("users.image as image")
      ->select("users.mobile as mobile")
      ->select("users.wallet as wallet")
      ->select("users.id as user_id")

      ->select("game.name as game_name2")
      ->select("game_times.open_time as open_time")
      ->select("game_times.close_time as close_time")
      ->select("game_times.name as game_name")
      ->select("card.name as game_type")
      ->select("card.win_price as win_price")

      ->select("$table_name.id as id")
      ->select("$table_name.amount as amount")
      ->select("$table_name.bid as bid")
      ->select("$table_name.bid2 as bid2")
      ->select("$table_name.type as type")
      ->select("$table_name.session_id as session_id")
      ->select("$table_name.card_id as card_id")
      ->select("$table_name.add_date_time as add_date_time")

      ->join("game as game","$table_name.game_id=game.id","LEFT")
      ->join("users as users","$table_name.user_id=users.id","LEFT")
      ->join("game_times as game_times","$table_name.time_id=game_times.id","LEFT")
      ->join("card as card","$table_name.card_id=card.id","LEFT");
      $list2 = $this->db->get($table_name)->result_object();



      

      $listd = array_merge($list,$list2);

      $data['game_id'] = $game_id;
      $data['time_id'] = $time_id;
      $data['session_id'] = $session_id;
      $data['panna'] = $panna;
      $data['open_panna_win_number'] = $open_panna_win_number;
      $data['close_panna_win_number'] = $close_panna_win_number;
      $data['open_digit_win_number'] = $open_digit_win_number;
      $data['close_digit_win_number'] = $close_digit_win_number;
      $data['jodi_win_number'] = $jodi_win_number;
      $data['date'] = $only_date;
      $data['list'] = $listd;
      return $data;
	}



	public function add($id="") 
	{
		$data['id'] = $id;
		$data['title'] = $this->arr_values['title']." || Add";
		$data['page_title'] = "Add ".$this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['submit_url'] = $this->arr_values['submit_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['multipleimage'] = array();		
		$data['pagenation'] = array($this->arr_values['title'],'Add');
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/form', $data);
	}
	public function edit($id="")
	{
		$data['title'] = $this->arr_values['title']." || Edit";
		$data['page_title'] = $this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['submit_url'] = $this->arr_values['submit_url'].'/'.$id;
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['pagenation'] = array($this->arr_values['title'],'Edit');

		$table_name = $this->arr_values['table_name'];
		$this->db
		->select("meta_tags.meta_title as meta_title")
		->select("meta_tags.meta_keyword as meta_keyword")
		->select("meta_tags.meta_auther as meta_auther")
		->select("meta_tags.meta_description as meta_description")


		->select("$table_name.id as id")
		->select("$table_name.*")


		->join("meta_tags as meta_tags"," $table_name.slug=meta_tags.slug ","LEFT");
		$row = $this->db->get_where($this->arr_values['table_name'],array("$table_name.id"=>$id,"$table_name.is_delete"=>0,))->result_object();

		$data['row'] = $row;
		if(!empty($row))
			$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/form', $data);
		else
			$this->template->load('template', panel.'/404', $data);
	}

	
	public function update($id="")
	{
		$result = array();
        $user_data = array();
     	$name = $this->input->post('name');

		$status = 1;
		$user_data = array(
			"bid"=>$this->input->post('bet'),
			"amount"=>$this->input->post('amount'),			
		);        	
        if($this->Custom_model->update_data($this->arr_values['table_name'],$user_data,array('id' => $id, )))
        {
        		$insert_id = $id;
        		$add_update_ok = 1;
            $result['message'] = "Update successfully";
            $result['status']  = "200";
            $result['action']  = "edit";
        }
        else
        {
            $result['message'] = "Update not successfully";
            $result['status']  = "400";
            $result['action']  = "edit";
        }
      	echo json_encode($result);
	}

	public function game_results()
	{
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$table_id = 1;
		$listcheckbox = [];
		$filter_search_value = '';
		$keys = '';
		$where_query = "";
		$order_by = "game_result.id desc";
		$is_delete = 0;
		$game_id = 0;
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->limit))
				$limit = $post_data->limit;

			if(!empty($post_data->order_by))
				$order_by = $post_data->order_by;

			if(!empty($post_data->page))
				$page = $post_data->page;

			if(!empty($post_data->table_id))
				$table_id = $post_data->table_id;

			if(!empty($post_data->game_id))
				$game_id = $post_data->game_id;

			if(!empty($post_data->date))
				$date = $post_data->date;
		}
		if(isset($page))
		{
			$page = $page1 = $page;
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

		$year = date("Y",strtotime($date));
    $month = date("m",strtotime($date));
    $day = date("d",strtotime($date));

    if($month[0]==0)$month = $month[1];
    if($day[0]==0)$day = $day[1];
    $date = $year.'-'.$month.'-'.$day;
    $where_query .= " CONCAT(YEAR(game_result.date),'-',MONTH(game_result.date),'-',DAY(game_result.date))='$date'  and ";

		$where_query .= " game_result.game_id='$game_id' and game_result.status='$status' and game_result.is_delete='$is_delete' ";
		if(!empty($filter_search_value))
		{
			// $limit = 100;
			$this->db->where(" concat($keys) like '%$filter_search_value%' ");
		}
		$this->db->order_by($order_by);
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$this->db
		->select("game.name as game_name2")
		->select('game_times.name as game_name')
		->select('game_times.open_time as open_time')
		->select('game_times.close_time as close_time')
		->select("game_result.*")
		->join("game as game","game_result.game_id=game.id","LEFT")
		->join("game_times as game_times","game_times.id=game_result.time_id ","LEFT");
		$data['list'] = $this->db->get("game_result")->result_object();
		$extra_data = array("table_id"=>$table_id,);
		$data_count = count($this->db->select("id")->where($where_query)->get_where("game_result")->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_name'] = "game_result";
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['view_btn_url'] = $this->arr_values['view_btn_url'];
		$data['table_id'] = $table_id;
		$data['listcheckbox'] = $listcheckbox;
		$data['is_delete'] = $is_delete;
		$data['page_name'] = $this->arr_values['page_name'];
		$data['game_id'] = $game_id;
		$data['controller_name'] = $this->arr_values['controller_name'];
		if(!empty($this->arr_values['all_image_column_names']) && is_array($this->arr_values['all_image_column_names']))
			$data['all_image_column_names'] = implode(",", $this->arr_values['all_image_column_names']);
		else
			$data['all_image_column_names'] = '';
		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table2',$data);
	}

	public function delete()
	{
		$id = $this->input->post('ids');
		$rowid = $this->input->post("rowid");
		 $id_html = '';
		foreach ($id as $key => $value)
        {
            if($key==0)
                $id_html .= "#".$rowid.$value;
            else
                $id_html .= ", #".$rowid.$value;
        }
		$game_winners = $this->db->where_in("result_declare_id",$id)->get_where("game_winners")->result_object();
		foreach ($game_winners as $key => $value) {
			$this->custom->wallet_credit_debit($value->user_id,"debit",$value->win_amount,"Deduct by admin",0);
		}
		$this->db->where_in("result_declare_id",$id)->delete("game_winners");
		$this->db->where_in("id",$id)->delete("game_result");
		$result['message'] = "Delete successfully";
	    $result['success']  = "200";
	    $result['id']  = $id_html;
	    echo json_encode($result);
	}
	


}







