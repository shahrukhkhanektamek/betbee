<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Blog', 
						   	'table_name'=>'blog',
						   	'page_title'=>'Blog',
						   	"submit_url"=>'front/blog/update',
						   	"folder_name"=>'blog',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>'/blog',
						   	"btn_url"=>'/blog/add',
						   	"add_btn_url"=>'/blog/add',
						   	"edit_btn_url"=>'/blog/edit/',
						   	"view_btn_url"=>'/blog/view/',
						   	"controller_name"=>'blog',
						   ); 
   public function __construct()
    {
        parent::__construct(); 
        $this->load->model('Custom_model','custom');
        $this->load->model('Events_model','Plans');
    }	
	public function index()
	{
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$where_query = "";
		$order_by = "id desc";



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

		$full_url = base_url(strtolower($this->arr_values['back_btn'])."?order_by=$order_by&limit=$limit");
		$data['list'] = $this->Plans->allData($status,$page,$limit,$order_by,$offset,$this->arr_values['table_name']);
		$pagenation_data = pagination_custom(
			$this->arr_values['table_name'],
			$limit,
			$page1,
			$full_url,
			$where_query,
			'<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'<i class="fa fa-angle-right" aria-hidden="true"></i>'
		);
		$data['pagenation_data']=$pagenation_data;
		$data['title'] = $this->arr_values['title'];
		$data['page_title'] = $this->arr_values['page_title'].' list';
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = "";
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['view_url'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['edit_url'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['view_btn_url'] = $this->arr_values['view_btn_url'];
		$data['page_number'] = $page;
		$data['statuschange'] = $status;
		$data['orderbychange'] = $order_by;
		$data['limitchange'] = $limit;
		
		$data['pagenation'] = array('Dashboard',$this->arr_values['title']);
		$this->template->load('template2', 'front/'.$this->arr_values['folder_name'].'/index', $data);
	}
	public function detail($slug)
	{

		$row = $this->db->get_where("blog",array("slug"=>$slug,))->result_object();
		$data['row'] = $row;
		if(!empty($row))
		{
			$this->template->load('template2', 'front/'.$this->arr_values['folder_name'].'/detail', $data);
		}
		else
		{
			$this->template->load('template2', '404', $data);
		}
	}
}