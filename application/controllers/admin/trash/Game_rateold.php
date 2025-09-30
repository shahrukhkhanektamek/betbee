<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_rate extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Game Rate', 
						   	'table_name'=>'game_rate',
						   	'page_title'=>'Game Rate',
						   	"submit_url"=>panel.'/game_rate/send',
						   	"folder_name"=>'game_rate',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/game_rate',
						   	"btn_url"=>panel.'/game_rate/add',
						   	"add_btn_url"=>panel.'/game_rate/add',
						   	"edit_btn_url"=>panel.'/game_rate/edit/',
						   	"view_btn_url"=>panel.'/game_rate/view/',
						   	"controller_name"=>'game_rate',
						   	"page_name"=>'game_rate-detail.php',
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
		$data['title'] = $this->arr_values['title']."";
		$data['page_title'] = "".$this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['submit_url'] = $this->arr_values['submit_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['multipleimage'] = array();		
		$data['pagenation'] = array($this->arr_values['title']);
		$data['row'] = $row = $this->db->get_where($this->arr_values['table_name'])->result_object();
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/form', $data);
	}


	public function send($id="")
	{
		$id = 1;
		$result = array();
      $user_data = array();
     	$name = $this->input->post('name');
     	$shop_name = '';
      $slug = slug($name.'-'.$shop_name);
      $old_slug = '';
	   $status = 1;
	   $user_data = array(
			"single_digit"=>$this->input->post('single_digit'),
			"jodi_digit"=>$this->input->post('jodi_digit'),
			"single_pana"=>$this->input->post('single_pana'),
			"double_pana"=>$this->input->post('double_pana'),
			"triple_pana"=>$this->input->post('triple_pana'),
			"half_sangam"=>$this->input->post('half_sangam'),
			"full_sangam"=>$this->input->post('full_sangam'),
			"status"=>$status,
	   );
      $add_update_ok = 0;        
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


}







