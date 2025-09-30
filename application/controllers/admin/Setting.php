<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Setting', 
						   	'table_name'=>'users',
						   	'page_title'=>'Setting',
						   	"submit_url"=>'admin/setting/update',
						   	"folder_name"=>'setting',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>'admin',
						   	"btn_url"=>'admin/add',
						   	"add_btn_url"=>'admin/add',
						   	"edit_btn_url"=>'admin/edit/',
						   	"view_btn_url"=>'admin/view/',
						   	"controller_name"=>'setting',
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
			$this->template->load('template', 'admin/setting'.'/index', $data);
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
     	$header_emails_title = $this->input->post('header_emails_title');
     	$header_emails_value = $this->input->post('header_emails_value');
     	$header_emails = json_encode(array("header_emails_title"=>$header_emails_title,"header_emails_value"=>$header_emails_value,));
     	$header_mobiles_title = $this->input->post('header_mobiles_title');
     	$header_mobiles_value = $this->input->post('header_mobiles_value');
     	$header_mobiles = json_encode(array("header_mobiles_title"=>$header_mobiles_title,"header_mobiles_value"=>$header_mobiles_value,));
     	$header_address_title = $this->input->post('header_address_title');
     	$header_address_value = $this->input->post('header_address_value');
     	$header_address = json_encode(array("header_address_title"=>$header_address_title,"header_address_value"=>$header_address_value,));





     	$footer_emails_title = $this->input->post('footer_emails_title');
     	$footer_emails_value = $this->input->post('footer_emails_value');
     	$footer_emails = json_encode(array("footer_emails_title"=>$footer_emails_title,"footer_emails_value"=>$footer_emails_value,));
     	$footer_mobiles_title = $this->input->post('footer_mobiles_title');
     	$footer_mobiles_value = $this->input->post('footer_mobiles_value');
     	$footer_mobiles = json_encode(array("footer_mobiles_title"=>$footer_mobiles_title,"footer_mobiles_value"=>$footer_mobiles_value,));
     	$footer_address_title = $this->input->post('footer_address_title');
     	$footer_address_value = $this->input->post('footer_address_value');
     	$footer_address = json_encode(array("footer_address_title"=>$footer_address_title,"footer_address_value"=>$footer_address_value,));



     	$contact_emails_title = $this->input->post('contact_emails_title');
     	$contact_emails_value = $this->input->post('contact_emails_value');
     	$contact_emails = json_encode(array("contact_emails_title"=>$contact_emails_title,"contact_emails_value"=>$contact_emails_value,));
     	$contact_mobiles_title = $this->input->post('contact_mobiles_title');
     	$contact_mobiles_value = $this->input->post('contact_mobiles_value');
     	$contact_mobiles = json_encode(array("contact_mobiles_title"=>$contact_mobiles_title,"contact_mobiles_value"=>$contact_mobiles_value,));
     	$contact_address_title = $this->input->post('contact_address_title');
     	$contact_address_value = $this->input->post('contact_address_value');
     	$contact_address = json_encode(array("contact_address_title"=>$contact_address_title,"contact_address_value"=>$contact_address_value,));



     	$main_mail = $this->input->post('main_mail');
     	if(!empty($main_mail)) $main_mail = implode("||", $main_mail);
     	$cc_mail = $this->input->post('cc_mail');
     	if(!empty($cc_mail)) $cc_mail = implode("||", $cc_mail);
     	$bcc_mail = $this->input->post('bcc_mail');
     	if(!empty($bcc_mail)) $bcc_mail = implode("||", $bcc_mail);     	
        $status = 1;
        $setting_data = array(
        	"header_emails"=>$header_emails,
			"header_mobiles"=>$header_mobiles,
			"header_address"=>$header_address,
			"footer_emails"=>$footer_emails,
			"footer_mobiles"=>$footer_mobiles,
			"footer_address"=>$footer_address,
			"contact_emails"=>$contact_emails,
			"contact_mobiles"=>$contact_mobiles,
			"contact_address"=>$contact_address,
			"mail_type"=>$this->input->post('mail_type'),
			"mailhost"=>$this->input->post('mailhost'),
			"mailusername"=>$this->input->post('mailusername'),
			"mailpassword"=>$this->input->post('mailpassword'),
			"inquiry_mail"=>$this->input->post('inquiry_mail'),
			"main_mail"=>$main_mail,
			"cc_mail"=>$cc_mail,
			"bcc_mail"=>$bcc_mail,
			"signup_reward"=>$this->input->post('signup_reward'),
			"signup_reward_status"=>$this->input->post('signup_reward_status'),
			"diposit_reward_status"=>$this->input->post('diposit_reward_status'),
			"demo_number"=>$this->input->post('demo_number'),
			"min_deposit"=>$this->input->post('min_deposit'),
			"min_withdraw"=>$this->input->post('min_withdraw'),
			"upi"=>$this->input->post('upi'),
			"rz_key"=>$this->input->post('rz_key'),
			"merchant"=>$this->input->post('merchant'),
			"upi_2"=>$this->input->post('upi_2'),
			"merchant_2"=>$this->input->post('merchant_2'),
			"upi_3"=>$this->input->post('upi_3'),
			"merchant_3"=>$this->input->post('merchant_3'),
			"whatsapp_active"=>$this->input->post('whatsapp_active'),
			"rz_setting"=>$this->input->post('rz_setting'),
			"spin_game"=>$this->input->post('spin_game'),
			"dice_game"=>$this->input->post('dice_game'),
			"number_game"=>$this->input->post('number_game'),
			"whatsapp"=>$this->input->post('whatsapp'),
			"withdrawOpenTime"=>$this->input->post('withdrawOpenTime'),
			"withdrawCloseTime"=>$this->input->post('withdrawCloseTime'),
			"auto_verify"=>$this->input->post('auto_verify'),
			"chat_support"=>$this->input->post('chat_support'),
			"verify_upi_payment"=>$this->input->post('verify_upi_payment'),
			"telegram"=>$this->input->post('telegram'),
			"telegram_details"=>$this->input->post('telegram_details'),
			"welcome_msg"=>$this->input->post('welcome_msg'),
			"home_line"=>$this->input->post('home_line'),
			"how_to_play"=>$this->input->post('how_to_play'),
        );
		$this->load->model('Image_model');
	    $all_image_column_names = array("logo","favicon");
        $return_image_array = $this->Image_model->upload_image($all_image_column_names,"setting",1);
        if(!empty($return_image_array))
        {
            foreach ($return_image_array as $key => $value)
            {
                $setting_data[$key] = $value;
            }
        }
	    $add_update_ok = 0;
    	if($this->db->update("setting",$setting_data,array("id"=>1,)))
        {
    		$last_id = $id;
    		$add_update_ok = 1;



    		$diposit_reward_from = $this->input->post('diposit_reward_from');
    		$diposit_reward_to = $this->input->post('diposit_reward_to');
    		$diposit_reward_percent = $this->input->post('diposit_reward_percent');
    		$diposit_reward_self_percent = $this->input->post('diposit_reward_self_percent');
    		$this->db->empty_table('reward_amount');  
    		foreach ($diposit_reward_percent as $key => $value)
    		{
    			$insert_data = array(
    				"fromamount"=>$diposit_reward_from[$key],
    				"toamount"=>$diposit_reward_to[$key],
    				"percent"=>$diposit_reward_percent[$key],
    				"percent_self"=>$diposit_reward_self_percent[$key],
    			);
    			$this->Custom_model->insert_data("reward_amount",$insert_data);
    		}




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


	public function header_emails()
	{
		$this->load->view("admin/setting/header_emails");
	}
	public function main_max_deposit()
	{
		$this->load->view("admin/setting/main_max_deposit");
	}
	public function header_mobiles()
	{
		$this->load->view("admin/setting/header_mobiles");
	}
	public function header_address()
	{
		$this->load->view("admin/setting/header_address");
	}

	public function footer_emails()
	{
		$this->load->view("admin/setting/footer_emails");
	}
	public function footer_mobiles()
	{
		$this->load->view("admin/setting/footer_mobiles");
	}
	public function footer_address()
	{
		$this->load->view("admin/setting/footer_address");
	}


	public function contact_emails()
	{
		$this->load->view("admin/setting/contact_emails");
	}
	public function contact_mobiles()
	{
		$this->load->view("admin/setting/contact_mobiles");
	}
	public function contact_address()
	{
		$this->load->view("admin/setting/contact_address");
	}



}