<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Withdraw', 
						   	'table_name'=>'withdraw_request',
						   	'page_title'=>'Withdraw',
						   	"submit_url"=>panel.'/withdraw/update',
						   	"folder_name"=>'withdraw',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/withdraw',
						   	"btn_url"=>panel.'/withdraw/add',
						   	"add_btn_url"=>panel.'/withdraw/add',
						   	"edit_btn_url"=>panel.'/withdraw/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/withdraw/view/',
						   	"controller_name"=>'withdraw',
						   	"page_name"=>'withdraw-detail.php',
						   	"keys"=>'withdraw_request.id,withdraw_request.user_id,users.fname,users.mobile,users.user_id',
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
		->select("$table_name.*")
		->join("users as users","$table_name.user_id=users.id","LEFT");
		$data['list'] = $this->db->get($this->arr_values['table_name'])->result_object();
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
		if(!empty($this->arr_values['all_image_column_names']) && is_array($this->arr_values['all_image_column_names']))
			$data['all_image_column_names'] = implode(",", $this->arr_values['all_image_column_names']);
		else
			$data['all_image_column_names'] = '';
		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data);
	}


	public function add($id="") 
	{
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
	
	public function update($id="")
	{
		$result = array();
      	$user_data = array();
     	$id = $this->input->post('id');
     	$status = $this->input->post('status');
     	$message = $this->input->post('message');

     	$withdraw_data = $this->db->get_where($this->arr_values['table_name'],array("id"=>$id,))->result_object();
     	if(empty($withdraw_data))
     	{
     		$result['message'] = "Wrong id";
            $result['status']  = "400";
            $result['action']  = "add";
            echo json_encode($result);
            die;
     	}
     	$withdraw_data = $withdraw_data[0];
     	$amount = $withdraw_data->amount;
     	$user = $this->db->select("id,wallet")->get_where("users",array("id"=>$withdraw_data->user_id,))->result_object();
     	if(empty($user))
     	{
     		$result['message'] = "User Not Found";
            $result['status']  = "400";
            $result['action']  = "add";
            echo json_encode($result);
            die;
     	}
     	$user = $user[0];
     	$wallet = $user->wallet;
     	$user_id = $user->id;

     	if($withdraw_data->status!=0)
     	{
     		$result['message'] = "Allready Done...";
            $result['status']  = "400";
            $result['action']  = "add";
            echo json_encode($result);
            die;
     	}
     	// if($wallet<$amount)
     	// {
     	// 	$result['message'] = "Low Balance";
      //       $result['status']  = "400";
      //       $result['action']  = "add";
      //       echo json_encode($result);
      //       die;
     	// }

     	if($this->db->update($this->arr_values['table_name'],array("status"=>$status,"comment"=>$message,),array("id"=>$id,)))
     	{
     		if($status!=1)
     		{
     			// $win_amount = $this->custom->win_amount($user_id);
	            // $this->custom->win_amount_credit_debit($user_id,'credit',$amount);

	            $message = 'Withdraw Reject';
	            $this->custom->win_amount_credit_debit($user_id,'credit',$amount,$message,0,2);
     		}
     		$result['message'] = "Success";
			$result['status']  = "200";
			$result['action']  = "add";
     	}
     	else
     	{
     		$result['message'] = "Error";
			$result['status']  = "400";
			$result['action']  = "add";
     	}
       
        echo json_encode($result);
	}
	


}







