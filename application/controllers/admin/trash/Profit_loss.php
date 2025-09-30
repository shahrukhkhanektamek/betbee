<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profit_loss extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Profit Loss', 
						   	'table_name'=>'user_history',
						   	'page_title'=>'Profit Loss',
						   	"submit_url"=>panel.'/profit_loss/update',
						   	"folder_name"=>'profit_loss',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/profit_loss',
						   	"btn_url"=>panel.'/profit_loss/add',
						   	"add_btn_url"=>panel.'/profit_loss/add',
						   	"edit_btn_url"=>panel.'/profit_loss/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/profit_loss/view/',
						   	"controller_name"=>'profit_loss',
						   	"page_name"=>'profit_loss-detail.php',
						   	"keys"=>'user_history.id,user_history.user_id,users.fname,users.mobile,users.user_id',
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
	public function index()
	{
		$data['title'] = $this->arr_values['title'];
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
		$table_name = "user_history";
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
		$from_date = 0;
		$to_date = 0;
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

			if(!empty($post_data->from_date))
				$from_date = $post_data->from_date;

			if(!empty($post_data->to_date))
				$to_date = $post_data->to_date;
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

		if(!empty($from_date) && !empty($to_date))
		{
			$year = date("Y",strtotime($from_date));
			$month = date("m",strtotime($from_date));
			$day = date("d",strtotime($from_date));

			if($month[0]==0)$month = $month[1];
			if($day[0]==0)$day = $day[1];
			// $from_date = $year.'-'.$month.'-'.$day;
		
			$year = date("Y",strtotime($to_date));
			$month = date("m",strtotime($to_date));
			$day = date("d",strtotime($to_date));

			if($month[0]==0)$month = $month[1];
			if($day[0]==0)$day = $day[1];
			// $to_date = $year.'-'.$month.'-'.$day;

			$from_date .= " 00:00:00";
			$to_date .= " 23:59:00";

			$where_query .= " $table_name.add_date_time>='$from_date' and ";
			$where_query .= " $table_name.add_date_time<='$to_date' and ";
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

		->select("$table_name.id as id")
		->select("$table_name.*")

		->join("users as users","$table_name.user_id=users.id","LEFT");
		$data['list'] = $this->db->get("$table_name")->result_object();

		$extra_data = array("table_id"=>$table_id,);
		$data_count = count($this->db->select("$table_name.id")->where($where_query)->get_where($table_name)->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_id'] = $table_id;
		$list = $this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data,true);

		$diposit = 0;
		$withdraw = 0;
		$p_and_l = 0;


		$where_query = " recharge_request.add_date_time>='$from_date' and recharge_request.add_date_time<='$to_date' ";
		$diposit = $this->db->where($where_query)->select_sum("amount")->get_where("recharge_request",array("is_delete"=>0,"status"=>1,))->result_object()[0]->amount;
		if(empty($diposit)) $diposit = 0;


		$where_query = " withdraw_request.add_date_time>='$from_date' and withdraw_request.add_date_time<='$to_date' ";
		$withdraw = $this->db->where($where_query)->select_sum("amount")->get_where("withdraw_request",array("is_delete"=>0,"status"=>1,))->result_object()[0]->amount;
		if(empty($withdraw)) $withdraw = 0;

		$p_and_l = $diposit-$withdraw;
		$result['message'] = "Found successfully";
        $result['status']  = "200";
        $result['diposit']  = $diposit;
        $result['withdraw']  = $withdraw;
        $result['p_and_l']  = $p_and_l;        
        $result['list']  = $list;
        echo json_encode($result);
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

	public function get_card_name()
	{
		$game_id = $this->input->post("game_id");
		$card_data = $this->db->get_where("game_card",array("game_id"=>$game_id,))->result_object();
		if(1==1)
		{
			$result['message'] = "Successfully";
            $result['status']  = "200";
            $result['data']  = $card_data;
		}
		else
        {
            $result['message'] = "not Successfully";
            $result['status']  = "400";
            $result['data']  = [];
        }
      	echo json_encode($result);
	}
	


}







