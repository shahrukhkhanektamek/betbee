<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function index()
	{

		set_user_session();
		$device_id = $this->session->userdata('device_id');

		redirect(base_url('app/user/'));

		$data = array();
		$meta_data = $this->Custom_model->get_meta_tags();
		$data['meta_data'] = $meta_data;
		$data['contact_details'] = contact_details();
		$this->template->load('template2', 'web/index',$data);
	}
	
	public function all($page='',$app_page='')
	{
		set_user_session();
		$device_id = $this->session->userdata('device_id');
		$data = array();
		if(empty($page)) $page = 'dashboard.php';
		$count = explode(".", $page);
		if(count($count)==1)
			$page = $count[0].'.php';
		else
			$page = $count[0].'.'.$count[1];
		if(in_array($page, front_user_pages()))
		{
			is_user_logged_in();
		}
		else
		{
			// is_user_logged_in($page);
		}		
		$full_detail = [];
		$get_user = get_user();
		if(!empty($get_user))
		{
		    $full_detail = $get_user['full_detail'];			    
		}
		$data['get_user'] = $get_user;
		$data['full_detail'] = $full_detail;
		$meta_data = $this->Custom_model->get_meta_tags();
		$data['meta_data'] = $meta_data;
		$data['contact_details'] = contact_details();

		if(file_exists(APPPATH.'views/web/'.$page))
			$this->template->load('template2', 'web/'.$page,$data);
		else
		{
			$this->load->view('web/headers/header',$data);
			$this->template->load('template2', 'web/404',$data);
			$this->load->view('web/headers/footer',$data);
		}
	}



	public function user_app($page='')
	{		
		set_user_session();
		$device_id = $this->session->userdata('device_id');
		$data = array();
		if(empty($page)) $page = 'login.php';
		$count = explode(".", $page);
		if(count($count)==1)
			$page = $count[0].'.php';
		else
			$page = $count[0].'.'.$count[1];

		

		if(count($count)>0) $page_check = $count[0];
	    else $page_check = $count[0].'.'.$count[1];

	    $login_required_pages = array("dashboard","home","profile","wallet","edit-profile",'change-password','setting','my-referral','my-bets','transaction-history','diposit','withdraw','old-result');
	    $login_not_required_pages = array("login","reset-pass","newpass");

		$login_status = user_app_logged_in($page_check,$login_required_pages,$login_not_required_pages);
		if($login_status==6)
			redirect(base_url(user_app.'login'));
		if($login_status==7)
			redirect(base_url(user_app.'home'));

		$full_detail = [];
		$get_user = get_user_app();
		if(!empty($get_user))
		{
		    $full_detail = $get_user['full_detail'];
		}

		$data['get_user'] = $get_user;
		$data['full_detail'] = $full_detail;
		$meta_data = $this->Custom_model->get_meta_tags();
		$data['meta_data'] = $meta_data;
		$data['contact_details'] = contact_details();
		$data['setting'] = $this->db->get_where("setting")->result_object()[0];

		if(file_exists(APPPATH.'views/app/user/'.$page))
			$this->load->view('app/user/'.$page,$data);
		else
		{
			$this->load->view('app/user/404',$data);
		}
	}

	public function select_user()
	{
		$search = $this->input->post("search");
		$keys = 'fname,email,mobile,user_id';
		$list = $this->db
		->limit(10)
		->like('mobile', $search, 'both')
		->or_like('fname', $search, 'both')
		->or_like('email', $search, 'both')
		->or_like('user_id', $search, 'both')
		->get_where("users")->result_object();
		$return_data[] = [];
        foreach ($list as $key => $value) {
            $return_data[] = array("id"=>$value->id,"text"=>$value->fname,);
        }
        $data['results'] = $return_data;
        echo json_encode($data);
	}



	
	public function test()
	{


		$i=1;
		while ($i<=99)
		{
			$data = array(
				"number"=>$i,
				"add_date_time"=>date("Y-m-d H:i:s"),
				"update_date_time"=>date("Y-m-d H:i:s"),
				"is_delete"=>0,
				"status"=>1,
			);
			// $this->db->insert("jodi_digit",$data);
			$i++;
		}


		// $this->db->select("(SELECT id,password FROM admin ) AS amount_paid", FALSE);
		// 	$recieved_amount = $this->db->get('admin')->result_object();
		// 	print_r($recieved_amount);
	}
	
}
