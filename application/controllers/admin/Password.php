<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Password', 
						   	'table_name'=>'users',
						   	'page_title'=>'Password',
						   	"submit_url"=>'admin/password/update',
						   	"folder_name"=>'password',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>'admin',
						   	"btn_url"=>'admin/add',
						   	"add_btn_url"=>'admin/add',
						   	"edit_btn_url"=>'admin/edit/',
						   	"view_btn_url"=>'admin/view/',
						   	"controller_name"=>'users',
						   );  
   public function __construct()
    {
        parent::__construct(); 
        is_logged_in();
        is_admin_logged_in();
        $this->load->model('Custom_model','custom');
    }	
	public function index($id='')
	{
		$data = array();
		$role = $this->session->userdata("role");
		if(empty($id))
		{
			$id = $this->session->userdata('id');
			$id2 = '/'.$id;
		}

		$table_name = "users";
		if($role==1)
		{
			$table_name = "admin";
		}
		else if($role==2 || $role==3)
		{
			$table_name = "users";
		}
		$data['title'] = $this->arr_values['title']." || Edit";
		$data['page_title'] = $this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['submit_url'] = $this->arr_values['submit_url'].$id2;
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['pagenation'] = array($this->arr_values['title'],'Edit');
		$row = $this->db->get_where($table_name,array("id"=>$id,))->result_object();
		$data['row'] = $row;
		if(!empty($row))
			$this->template->load('template', 'admin/password'.'/index', $data);
		else
			$this->template->load('template', panel.'/404', $data);
	}
	public function update($id="")
	{
		$result = array();
        $user_data = array();


        $role = $this->session->userdata("role");
		$table_name = "users";
		if($role==1)
		{
			$table_name = "admin";
		}
		else if($role==2 || $role==3)
		{
			$table_name = "users";
		}




        $id = $this->session->userdata("id");
     	$old_password = $this->input->post('old_password');
     	$new_password = $this->input->post('new_password');
     	$confirm_password = $this->input->post('confirm_password');


     	$user = $this->db->get_where("admin",array("id"=>$id,))->result_object();
     	if(empty($user))
     	{
     		$result['message'] = "Error";
            $result['status']  = "400";
            $result['action']  = "edit";
            echo json_encode($result);
            die;
     	}
     	$user = $user[0];



     	if($old_password!=$user->password)
     	{
     		$result['message'] = "Old password not match...";
            $result['status']  = "400";
            $result['action']  = "edit";
            echo json_encode($result);
            die;
     	}
     	if($new_password!=$confirm_password)
     	{
     		$result['message'] = "Confirm password not match...";
            $result['status']  = "400";
            $result['action']  = "edit";
            echo json_encode($result);
            die;
     	}



        $status = 1;
        $user_data = array(
			"password"=>$new_password,
        );
        
        

		

	    $add_update_ok = 0;
    	if($this->db->update($table_name,$user_data,array('id' => $id, )))
        {
    		$last_id = $id;
    		$add_update_ok = 1;
    		$data = [
                'username' => $user->username,
                'role' => $user->role,
                'id' => $user->id,
                'password' => $new_password,
            ];
            $this->session->set_userdata($data);
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

	public function test_mail()
	{
		$setting = setting();
		$mailusername = $setting->mailusername;
		$to = implode(",", explode("||", $setting->main_mail));
		$cc = implode(",", explode("||", $setting->cc_mail));
		$bcc = implode(",", explode("||", $setting->bcc_mail));


		$data = array();
		$body = $this->parser->parse('mailtamplate/testmail', $data,true);
		$mail_data = array(
			"to"=>$to,
			"subject"=>"Test Mail",
			"body"=>$body,
			"cc"=>$cc,
			"bcc"=>$bcc,
		);
		if($this->Custom_model->sendEmail($mail_data))
		{
			$result['status'] = '200';
			$result['message'] = 'Sent successfully!';
		}
		else
		{
			$result['status'] = '200';
			$result['message'] = 'Sent successfully!';
		}
		echo json_encode($result);
	}


}