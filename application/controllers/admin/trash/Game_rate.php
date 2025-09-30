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
	public function index($id='')
	{
		$data['id'] = $id;
		$data['title'] = $this->arr_values['title']."";
		$data['page_title'] = "".$this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['submit_url'] = $this->arr_values['submit_url'].'/'.$id;
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['multipleimage'] = array();		
		$data['pagenation'] = array($this->arr_values['title']);
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/form', $data);
	}


	public function send($id="")
	{
	   $card_id = $this->input->post('card_id');
	   $win_price = $this->input->post('win_price');
	   if(!empty($card_id) && !empty($win_price))
	   {
	   	foreach ($card_id as $key => $value)
	   	{
	   		$update_data = array(
	   			"win_price"=>$win_price[$key],
	   		);
	   		$this->db->update("card",$update_data,array("id"=>$card_id[$key],));
	   	}
	   }
	   $result['message'] = "Update successfully";
      $result['status']  = "200";
      $result['action']  = "edit";
      echo json_encode($result);
	}


}







