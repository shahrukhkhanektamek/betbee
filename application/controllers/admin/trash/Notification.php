<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Notification', 
						   	'table_name'=>'notification',
						   	'page_title'=>'Notification',
						   	"submit_url"=>panel.'/notification/send',
						   	"folder_name"=>'notification',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/notification',
						   	"btn_url"=>panel.'/notification/add',
						   	"add_btn_url"=>panel.'/notification/add',
						   	"edit_btn_url"=>panel.'/notification/edit/',
						   	"view_btn_url"=>panel.'/notification/view/',
						   	"controller_name"=>'notification',
						   	"page_name"=>'notification-detail.php',
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
    }	
	public function index()
	{
		$data['title'] = $this->arr_values['title']." || Send";
		$data['page_title'] = "Send ".$this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['submit_url'] = $this->arr_values['submit_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['multipleimage'] = array();		
		$data['pagenation'] = array($this->arr_values['title'],'Send');
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/form', $data);
	}


	public function send($id="")
	{
	   $this->load->model("Firebase_model");
		$result = array();
      $user_data = array();
     	$name = $this->input->post('name');
     	$shop_name = '';
      $slug = slug($name.'-'.$shop_name);
      $old_slug = '';
	   $status = 1;
	   $title = $name;
	   $message = $this->input->post('description');

	   $users = $this->db->get_where("login_history",array("status"=>1,))->result_object();
	   foreach ($users as $key => $value)
	   {
	   	$token = $value->firebase_token;
	   	$this->Firebase_model->push_notification($token,$title,$message);
	   }
	   $result['message'] = "Add successfully";
		$result['status']  = "200";
		$result['action']  = "add";
      echo json_encode($result);

	   // $user_data = array(
		// 	"name"=>$name,
		// 	"date"=>$this->input->post('date'),
		// 	"description"=>$this->input->post('description'),
		// 	"status"=>$status,
	   // );	           		
  	   // if($this->Custom_model->insert_data($this->arr_values['table_name'],$user_data))
      // {
		// 	$insert_id = $this->db->insert_id();
		// 	$add_update_ok = 1;
		// 	$result['message'] = "Add successfully";
		// 	$result['status']  = "200";
		// 	$result['action']  = "add";
      // }
      // else
      // {
      //    $result['message'] = "Add not successfully";
      //    $result['status']  = "400";
      //    $result['action']  = "add";
      // }
	}


}







