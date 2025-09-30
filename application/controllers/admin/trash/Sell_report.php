<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell_report extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Customer Sell Report', 
						   	'table_name'=>'game_winners',
						   	'page_title'=>'Customer Sell Report',
						   	"submit_url"=>panel.'/sell_report/update',
						   	"folder_name"=>'sell_report',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/sell_report',
						   	"btn_url"=>panel.'/sell_report/add',
						   	"add_btn_url"=>panel.'/sell_report/add',
						   	"edit_btn_url"=>panel.'/sell_report/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/sell_report/view/',
						   	"controller_name"=>'sell_report',
						   	"page_name"=>'sell_report-detail.php',
						   	"keys"=>'game_winners.id,game_winners.user_id,users.fname,users.mobile,users.user_id',
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
		if(empty($id)) $id = 1;
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
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/index', $data);
	}

	public function load_data()
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
		$session_id = 0;
		$date = 0;
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->limit))
				$limit = $post_data->limit;

			$status = $post_data->status;

			if(!empty($post_data->order_by))
				$order_by = $post_data->order_by;

			if(!empty($post_data->page))
				$page = $post_data->page;

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

			if(!empty($post_data->session_id))
				$session_id = $post_data->session_id;
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


		if(!empty($time_id))
			$where_query .= " $table_name.time_id='$time_id' and  ";
		if(!empty($card_id))
			$where_query .= " $table_name.card_id='$card_id' and ";
		if(!empty($session_id))
			$where_query .= " $table_name.session_id='$session_id' and ";
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
		->select("users.user_id as user_id")

		->select("game_times.name as game_name")
		->select("card.name as game_type")

		->select("$table_name.id as id")
		->select("$table_name.amount as amount")
		->select("$table_name.bid as bid")
		->select("$table_name.bid2 as bid2")
		->select("$table_name.type as type")
		->select("$table_name.win_amount as win_amount")
		->select("$table_name.add_date_time as add_date_time")

		->join("users as users","$table_name.user_id=users.id","LEFT")
		->join("game_times as game_times","$table_name.time_id=game_times.id","LEFT")
		->join("game_card as game_card","$table_name.card_id=game_card.id","LEFT")
		->join("card as card","$table_name.card_id=card.id","LEFT");
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


		$card_html = '';
		$where = array("id"=>$card_id,);
		$card = $this->db->get_where("card",$where)->result_object();
		foreach ($card as $key => $value)
		{
			$digit_array = single_bid_digits();
			$data2 = array(
				"date"=>$date,
				"card_id"=>$card_id,
				"time_id"=>$time_id,
				"session_id"=>$session_id,
				"value"=>$value,
				"digit_array"=>$digit_array,
			);
			$card_html .= $this->load->view(panel.'/'.$this->arr_values['folder_name'].'/card',$data2,true);
		}

		echo $card_html;


		
		// $this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data);
	}

	



}







