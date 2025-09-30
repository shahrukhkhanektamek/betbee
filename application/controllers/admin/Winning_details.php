<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Winning_details extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Winning detail', 
						   	'table_name'=>'game_bet',
						   	'page_title'=>'Winning detail',
						   	"submit_url"=>panel.'/winning_details/update',
						   	"folder_name"=>'winning_details',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/winning_details',
						   	"btn_url"=>panel.'/winning_details/add',
						   	"add_btn_url"=>panel.'/winning_details/add',
						   	"edit_btn_url"=>panel.'/winning_details/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/winning_details/view/',
						   	"controller_name"=>'winning_details',
						   	"page_name"=>'winning_details-detail.php',
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
		$openpanna = 0;
		$closepanna = 0;
		$date = 0;
		$game_id = 0;
		$user_id = 0;
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

			if(!empty($post_data->session_id))
				$session_id = $post_data->session_id;

			if(!empty($post_data->openpannachange))
				$openpanna = $post_data->openpannachange;

			if(!empty($post_data->closepannachange))
				$closepanna = $post_data->closepannachange;

			if(!empty($post_data->game_id))
				$game_id = $post_data->game_id;

			if(!empty($post_data->user_id))
				$user_id = $post_data->user_id;
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
		if(!empty($session_id))
			$where_query .= " $table_name.session_id='$session_id' and ";
		if(!empty($user_id))
			$where_query .= " $table_name.user_id='$user_id' and ";

		// echo $user_id;

		
		if(!empty($date))
		{
			$year = date("Y",strtotime($date));
			$month = date("m",strtotime($date));
			$day = date("d",strtotime($date));

			if($month[0]==0)$month = $month[1];
			if($day[0]==0)$day = $day[1];
			$date = $year.'-'.$month.'-'.$day;
			$where_query .= " CONCAT(YEAR($table_name.date),'-',MONTH($table_name.date),'-',DAY($table_name.date))='$date' and ";
		}

		
		
		$where_query .= " $table_name.win_amount>0  ";
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


		->select("$table_name.id as id")
		->select("$table_name.session_id as session_id")
		->select("$table_name.amount as amount")
		->select("$table_name.p_id as p_id")
		->select("$table_name.p_type as type")
		->select("$table_name.win_amount as win_amount")
		->select("$table_name.date as add_date_time")


		->join("users as users","$table_name.user_id=users.id","LEFT");
		$data['list'] = $this->db->get($this->arr_values['table_name'])->result_object();

		// print_r($this->db->last_query());


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


		
		$total_bid_amount = $this->db->select_sum("amount")->where($where_query)->get_where("game_bet")->result_object()[0]->amount;
		if(empty($total_bid_amount)) $total_bid_amount = 0;

		$total_winning_amount = $this->db->select_sum("win_amount")->where($where_query)->get_where("game_bet")->result_object()[0]->win_amount;
		if(empty($total_winning_amount)) $total_winning_amount = 0;


		$data['total_bid_amount'] = $total_bid_amount;
		$data['total_winning_amount'] = $total_winning_amount;

		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data);
	}

	
	public function update()
	{
		$result = array();
        $user_data = array();
        $bid_id = $this->input->post('bid_id');
		$user_data = array(
			"bid"=>$this->input->post('bid'),
		);        	
        if($this->Custom_model->update_data($this->arr_values['table_name'],$user_data,array('id' => $bid_id, )))
        {
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


}







