<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Live extends CI_Controller {

	public function __construct()
    {
        parent::__construct(); 
        // is_logged_in();
        $this->load->model('Custom_model','custom');
    }	

	public function index($session_id="",$game_id='')
	{
		$data['page_title'] = "Live";
		$data['title'] = "Live";
		$data['button'] = "Live";
		$data['table_name'] = "users";
		$data['btn_url'] = "";
		$data['id'] = '';
		$data['user_data'] = "dfsf";	
		$data['pagenation'] = array();

		if(!empty($this->session->userdata('id')))
		{
			is_admin_logged_in();
			    
			if($this->session->userdata('id')==2)
		    redirect(base_url('admin/video'));
			
			
			$data['setting'] = $setting = $this->db->get_where("setting")->result_object();
			if(empty($game_id))
			{
				$game = $this->db->select('id')->limit(1)->order_by("id asc")->get_where("game")->result_object();
				if(!empty($game)) $game_id = $game[0]->id;
			}
			$data['game_id'] = $game_id;
			$data['session_id'] = $session_id;
			$data['vendors'] = 0;
			$data['machines'] = 0;
			$data['cards'] = 0;
		}		
		$this->template->load('template', 'admin/live/index', $data);
	}

}
