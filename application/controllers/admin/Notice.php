<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Notice', 
						   	'table_name'=>'notice',
						   	'page_title'=>'Notice',
						   	"submit_url"=>panel.'/notice/update',
						   	"folder_name"=>'notice',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/notice',
						   	"btn_url"=>panel.'/notice/add',
						   	"add_btn_url"=>panel.'/notice/add',
						   	"edit_btn_url"=>panel.'/notice/edit/',
						   	"view_btn_url"=>panel.'/notice/view/',
						   	"controller_name"=>'notice',
						   	"page_name"=>'notice-detail.php',
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
     	$vendor_id = $this->input->post('vendor_id');

     	$shop_name = '';
      

      $slug = slug($name.'-'.$shop_name);
      $old_slug = '';

	   $status = 1;
	   $user_data = array(
			"description"=>$this->input->post('description'),
			"status"=>$status,
	   );
	     $add_update_ok = 0;
        if(empty($id))
        {        		
        	   if($this->Custom_model->insert_data($this->arr_values['table_name'],$user_data))
	         {
					$insert_id = $this->db->insert_id();
					$add_update_ok = 1;
					$result['message'] = "Add successfully";
					$result['status']  = "200";
					$result['action']  = "add";
	         }
	         else
	         {
	            $result['message'] = "Add not successfully";
	            $result['status']  = "400";
	            $result['action']  = "add";
	         }
        }
        else
        {
	        	$old_slug_data = $this->db->select("slug")->get_where($this->arr_values['table_name'],array("id"=>$id,))->result_object();
	        	if(!empty($old_slug_data))
	        	{
	        		$old_slug = $old_slug_data[0]->slug;
	        	}
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
        }
        echo json_encode($result);
	}



}







