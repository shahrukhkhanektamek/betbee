<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Report', 
						   	'table_name'=>'users',
						   	'page_title'=>'Report',
						   	"controller_name"=>'report',
						   );  
   public function __construct()
   {
      parent::__construct(); 
      is_logged_in();
      is_admin_logged_in();
      $this->load->model('Custom_model','custom');
      $this->load->model('Events_model','Plans');
   }	
	public function recharge_history()
	{
		$user_id = $this->session->userdata("id");
		$back_btn = "admin/report/recharge_history";
		$folder_name = "admin/report/recharge";
		$table_name = "recharge";


		$retailer = "";
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$where_query = "";
		$order_by = "id desc";

		if(isset($_GET['retailer']))
			$retailer = $_GET['retailer'];		
		if(isset($_GET['limit']))
			$limit = $_GET['limit'];
		if(isset($_GET['status']))
			$status = $_GET['status'];
		if(isset($_GET['order_by']))
			$order_by = $_GET['order_by'];
		if(isset($_GET['page']))
		{
			$page = $page1 = $_GET['page'];
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
		$where_query .= " status='$status' ";
		if(!empty($retailer))
		$where_query .= " and vendor_id='$retailer' ";
		$full_url = base_url(strtolower($back_btn)."?status=$status&order_by=$order_by&limit=$limit&retailer=$retailer");
		$pagenation_data = pagination_custom(
			$table_name,
			$limit,
			$page1,
			$full_url,
			$where_query,
			'<i class="mdi mdi-chevron-left"></i>',
			'<i class="mdi mdi-chevron-right"></i>'
		);
		$data['pagenation_data']=$pagenation_data;
		$this->db->order_by("id desc");
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$data['list'] = $this->db->get($table_name)->result_object();	


		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = "All ".$this->arr_values['page_title'].'s';
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $table_name;
		$data['back_btn'] = "";
		$data['page_number'] = $page;
		$data['statuschange'] = $status;
		$data['orderbychange'] = $order_by;
		$data['limitchange'] = $limit;
		$data['retailer_id'] = $retailer;
		
		$data['pagenation'] = array('Dashboard',$this->arr_values['title']);
		$this->template->load('template', $folder_name, $data);
	}



	public function money_transfer_history()
	{
		$user_id = $this->session->userdata("id");
		$back_btn = "admin/report/money_transfer_history";
		$folder_name = "admin/report/money_transfer_history";
		$table_name = "money_transfer";


		$retailer = "";
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$where_query = "";
		$order_by = "id desc";

		if(isset($_GET['retailer']))
			$retailer = $_GET['retailer'];		
		if(isset($_GET['limit']))
			$limit = $_GET['limit'];
		if(isset($_GET['status']))
			$status = $_GET['status'];
		if(isset($_GET['order_by']))
			$order_by = $_GET['order_by'];
		if(isset($_GET['page']))
		{
			$page = $page1 = $_GET['page'];
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
		$where_query .= " status='$status' ";
		if(!empty($retailer))
		$where_query .= " and user_id='$retailer' ";
		$full_url = base_url(strtolower($back_btn)."?status=$status&order_by=$order_by&limit=$limit&retailer=$retailer");
		$pagenation_data = pagination_custom(
			$table_name,
			$limit,
			$page1,
			$full_url,
			$where_query,
			'<i class="mdi mdi-chevron-left"></i>',
			'<i class="mdi mdi-chevron-right"></i>'
		);
		$data['pagenation_data']=$pagenation_data;
		$this->db->order_by("id desc");
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$data['list'] = $this->db->get($table_name)->result_object();	


		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = "All ".$this->arr_values['page_title'].'s';
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $table_name;
		$data['back_btn'] = "";
		$data['page_number'] = $page;
		$data['statuschange'] = $status;
		$data['orderbychange'] = $order_by;
		$data['limitchange'] = $limit;
		$data['retailer_id'] = $retailer;
		
		$data['pagenation'] = array('Dashboard',$this->arr_values['title']);
		$this->template->load('template', $folder_name, $data);
	}




	public function distibutor_wallet_history()
	{
		$user_id = $this->session->userdata("id");
		$back_btn = "admin/report/wallet_history";
		$folder_name = "admin/report/distibutor_wallet";
		$table_name = "user_history";


		$retailer = "";
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$where_query = "";
		$order_by = "id desc";

		if(isset($_GET['retailer']))
			$retailer = $_GET['retailer'];		
		if(isset($_GET['limit']))
			$limit = $_GET['limit'];
		if(isset($_GET['status']))
			$status = $_GET['status'];
		if(isset($_GET['order_by']))
			$order_by = $_GET['order_by'];
		if(isset($_GET['page']))
		{
			$page = $page1 = $_GET['page'];
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
		// $where_query .= " status='$status' ";
		// if(!empty($retailer))
		$where_query .= " user_id='$retailer' ";
		$full_url = base_url(strtolower($back_btn)."?status=$status&order_by=$order_by&limit=$limit&retailer=$retailer");
		$pagenation_data = pagination_custom(
			$table_name,
			$limit,
			$page1,
			$full_url,
			$where_query,
			'<i class="mdi mdi-chevron-left"></i>',
			'<i class="mdi mdi-chevron-right"></i>'
		);
		$data['pagenation_data']=$pagenation_data;
		$this->db->order_by("id desc");
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$data['list'] = $this->db->get($table_name)->result_object();	


		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = "All ".$this->arr_values['page_title'].'s';
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $table_name;
		$data['back_btn'] = "";
		$data['page_number'] = $page;
		$data['statuschange'] = $status;
		$data['orderbychange'] = $order_by;
		$data['limitchange'] = $limit;
		$data['retailer_id'] = $retailer;
		
		$data['pagenation'] = array('Dashboard',$this->arr_values['title']);
		$this->template->load('template', $folder_name, $data);
	}


	public function retailer_wallet_history()
	{
		$user_id = $this->session->userdata("id");
		$back_btn = "admin/report/wallet_history";
		$folder_name = "admin/report/retailer_wallet";
		$table_name = "user_history";


		$retailer = "";
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$where_query = "";
		$order_by = "id desc";

		if(isset($_GET['retailer']))
			$retailer = $_GET['retailer'];		
		if(isset($_GET['limit']))
			$limit = $_GET['limit'];
		if(isset($_GET['status']))
			$status = $_GET['status'];
		if(isset($_GET['order_by']))
			$order_by = $_GET['order_by'];
		if(isset($_GET['page']))
		{
			$page = $page1 = $_GET['page'];
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
		// $where_query .= " status='$status' ";
		// if(!empty($retailer))
		$where_query .= " user_id='$retailer' ";
		$full_url = base_url(strtolower($back_btn)."?status=$status&order_by=$order_by&limit=$limit&retailer=$retailer");
		$pagenation_data = pagination_custom(
			$table_name,
			$limit,
			$page1,
			$full_url,
			$where_query,
			'<i class="mdi mdi-chevron-left"></i>',
			'<i class="mdi mdi-chevron-right"></i>'
		);
		$data['pagenation_data']=$pagenation_data;
		$this->db->order_by("id desc");
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$data['list'] = $this->db->get($table_name)->result_object();	


		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = "All ".$this->arr_values['page_title'].'s';
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $table_name;
		$data['back_btn'] = "";
		$data['page_number'] = $page;
		$data['statuschange'] = $status;
		$data['orderbychange'] = $order_by;
		$data['limitchange'] = $limit;
		$data['retailer_id'] = $retailer;
		
		$data['pagenation'] = array('Dashboard',$this->arr_values['title']);
		$this->template->load('template', $folder_name, $data);
	}



}







