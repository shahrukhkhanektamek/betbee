<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bid_revert extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Bid Revert', 
						   	'table_name'=>'game_bet',
						   	'page_title'=>'Bid Revert',
						   	"submit_url"=>panel.'/bid_revert/update',
						   	"folder_name"=>'bid_revert',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/bid_revert',
						   	"btn_url"=>panel.'/bid_revert/add',
						   	"add_btn_url"=>panel.'/bid_revert/add',
						   	"edit_btn_url"=>panel.'/bid_revert/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/bid_revert/view/',
						   	"controller_name"=>'bid_revert',
						   	"page_name"=>'bid_revert-detail.php',
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
		$data['plan_btn_url'] = $this->arr_values['plan_btn_url'];
		$data['keys'] = $this->arr_values['keys'];			
		$data['pagenation'] = array($this->arr_values['title']);
		$data['trash'] = $this->input->get("trash");
		if(!empty($this->arr_values['all_image_column_names']) && is_array($this->arr_values['all_image_column_names']))
			$data['all_image_column_names'] = implode(",", $this->arr_values['all_image_column_names']);
		else
			$data['all_image_column_names'] = '';
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/index', $data);
	}

	public function load_data_list()
	{
		$table_name = $this->arr_values['table_name'];
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
		$is_delete = 0;
		$time_id = 0;
		$card_id = 0;
		$date = 0;
		$amount = 0;
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->limit))
				$limit = $post_data->limit;

			// if(!empty($post_data->status))
				$status = $post_data->status;

			if(!empty($post_data->order_by))
				$order_by = $post_data->order_by;

			if(!empty($post_data->page))
				$page = $post_data->page;

			// $kyc_step = $post_data->kyc_step;


			if(!empty($post_data->filter_search_value))
				$filter_search_value = $post_data->filter_search_value;
			if(!empty($post_data->keys))
				$keys = $post_data->keys;

			if(!empty($post_data->table_id))
				$table_id = $post_data->table_id;

			if(!empty($post_data->listcheckbox))
				$listcheckbox = $post_data->listcheckbox;

			if(!empty($post_data->is_delete))
				$is_delete = $post_data->is_delete;

			if(!empty($post_data->time_id))
				$time_id = $post_data->time_id;

			if(!empty($post_data->card_id))
				$card_id = $post_data->card_id;

			if(!empty($post_data->date))
				$date = $post_data->date;

			if(!empty($post_data->amount))
				$amount = $post_data->amount;

			if(!empty($post_data->game_id))
				$game_id = $post_data->game_id;
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

		if(!empty($game_id))
			$where_query .= " $table_name.game_id='$game_id' and  ";
		if(!empty($time_id))
			$where_query .= " $table_name.time_id='$time_id' and  ";
		if(!empty($card_id))
			$where_query .= " $table_name.card_id='$card_id' and ";
		if(!empty($date))
		{
			$year = date("Y",strtotime($date));
			$month = date("m",strtotime($date));
			$day = date("d",strtotime($date));

			if($month[0]==0)$month = $month[1];
			if($day[0]==0)$day = $day[1];
			$date = $year.'-'.$month.'-'.$day;
			$where_query .= " CONCAT(YEAR($table_name.add_date_time),'-',MONTH($table_name.add_date_time),'-',DAY($table_name.add_date_time))='$date'  and ";
		}

		if(!empty($amount))
			$where_query .= " $table_name.amount='$amount' and  ";
		
		$where_query .= " $table_name.status='$status' and $table_name.is_delete='$is_delete' ";
		if(!empty($filter_search_value))
		{
			$limit = 100;
			$this->db->where(" concat($keys) like '%$filter_search_value%' ");
		}
		$this->db->order_by($order_by);
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$this->db
		->select("users.fname as fname")
		->select("users.image as image")
		->select("users.mobile as mobile")
		->select("users.wallet as wallet")
		->select("users.id as user_id")

		->select("game_times.name as game_name")
		->select('game_times.open_time as open_time')
		->select('game_times.close_time as close_time')
		->select("game.name as game_name2")
		->select("card.name as game_type")

		->select("$table_name.id as id")
		->select("$table_name.amount as amount")
		->select("$table_name.bid as bid")
		->select("$table_name.bid2 as bid2")
		->select("$table_name.type as type")
		->select("$table_name.add_date_time as add_date_time")

		->join("users as users","$table_name.user_id=users.id","LEFT")
		->join("game as game","$table_name.game_id=game.id","LEFT")
		->join("card as card","$table_name.card_id=card.id","LEFT")
		->join("game_card as game_card","$table_name.card_id=game_card.id","LEFT")
		->join("game_times as game_times","$table_name.time_id=game_times.id","LEFT");
		$data['list'] = $this->db->get($this->arr_values['table_name'])->result_object();

		// print_r($data['list']);

		$extra_data = array("table_id"=>$table_id,);
		$data_count = count($this->db->select("$table_name.id")->where($where_query)->get_where($this->arr_values['table_name'])->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_name'] = $this->arr_values['table_name'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['view_btn_url'] = $this->arr_values['view_btn_url'];
		$data['plan_btn_url'] = $this->arr_values['plan_btn_url'];
		$data['table_id'] = $table_id;
		$data['listcheckbox'] = $listcheckbox;
		$data['is_delete'] = $is_delete;
		$data['page_name'] = $this->arr_values['page_name'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		return $data;
	}
	public function load_data()
	{
		$data = $this->load_data_list();
		$html = $this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data,true);
		$result['message'] = "Update successfully";
        $result['status']  = "200";
        $result['action']  = "edit";
        $result['data']  = $html;
        echo json_encode($result);
	}

	
	public function send($id="")
	{
		$data = $this->load_data_list();
		$list = $data['list'];
		foreach ($list as $key => $value)
		{
		   	$type = 'credit';
		   	$message = "Refund by ".website_name;
		   	$this->custom->wallet_credit_debit($value->user_id,$type,$value->amount,$message,0);
		}
		$data['list'] = [];
		$html = $this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data,true);
		$result['message'] = "Update successfully";
        $result['status']  = "200";
        $result['action']  = "edit";
        $result['data']  = $html;
        echo json_encode($result);
	}


}







