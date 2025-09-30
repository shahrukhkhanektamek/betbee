<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Diposit points request', 
						   	'table_name'=>'recharge_request',
						   	'page_title'=>'Diposit points request',
						   	"submit_url"=>panel.'/recharge/update',
						   	"folder_name"=>'recharge',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/recharge',
						   	"btn_url"=>panel.'/recharge/add',
						   	"add_btn_url"=>panel.'/recharge/add',
						   	"edit_btn_url"=>panel.'/recharge/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/recharge/view/',
						   	"controller_name"=>'recharge',
						   	"page_name"=>'recharge-detail.php',
						   	"keys"=>'recharge_request.id,recharge_request.user_id,users.fname,users.mobile,users.user_id',
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
     	$user = $this->db->select("id,wallet,referral_id,total_diposit")->get_where("users",array("id"=>$withdraw_data->user_id,))->result_object();
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


     	


     	if($this->db->update($this->arr_values['table_name'],array("status"=>$status,"comment"=>$message,),array("id"=>$id,)))
     	{
     		if($status==1)
     		{
     			


				// $user_data['date_time'] = date('Y-m-d H:i:s');
				// $user_data['status'] = 1;
				// $user_data['is_delete'] = 0;
		    	// $this->Custom_model->update_data("user_history",$user_data,array('id' => $insert_id, ));




     			$setting = $this->db->get_where("setting")->result_object()[0];
     			$diposit_reward_status = $setting->diposit_reward_status;
     			$signup_reward_status = $setting->signup_reward_status;
     			$percent_self = 0;
			   $refferal = $this->db->select("id,wallet")->get_where("users",array("user_id"=>$user->referral_id,))->result_object();
			   // && $user->total_diposit==0 && $diposit_reward_status==1
		     	if(!empty($refferal) )
		     	{
		     		$refferal = $refferal[0];
		     		$reward_amount = $this->db
		     		->where(" fromamount<='$amount' and toamount>='$amount' ")
		     		->get_where("reward_amount")->result_object();
		     		if(!empty($reward_amount))
		     		{
		     			$reward_amount = $reward_amount[0];
		     			$percent = $reward_amount->percent;
		     			if(!empty($percent))
		     			{
			     			$percent_self = $reward_amount->percent_self;
			     			$ramount = $amount*$percent/100;
				     		$type = 'credit';
					   	$message = "Refferal amount";
					   	$insert_id = $this->custom->wallet_credit_debit($refferal->id,$type,$ramount,$message,0,6);
					   }
		     		}
		     	}


		     	$type = 'credit';
			   $message = "Recharge by self";
			   $insert_id = $this->custom->wallet_credit_debit($user_id,$type,$amount,$message,0,1);



			   if($percent_self>0 && $user->total_diposit==0 && $signup_reward_status==1)
			   {
			   	$type = 'credit';
				   $message = "Recharge bonus";
				   if(!empty($percent_self))
				   {
					   $ramount2 = $amount*$percent_self/100;
					   $insert_id = $this->custom->wallet_credit_debit($user_id,$type,$ramount2,$message,0,5);				   	
				   }
			   }


		     	$this->db->update("users",array("total_diposit"=>$user->total_diposit+$amount,),array("id"=>$user_id,));



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







