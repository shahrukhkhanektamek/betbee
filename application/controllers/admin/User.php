<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'User', 
						   	'table_name'=>'users',
						   	'page_title'=>'User',
						   	"submit_url"=>panel.'/user/update',
						   	"folder_name"=>'user',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/user',
						   	"btn_url"=>panel.'/user/add',
						   	"add_btn_url"=>panel.'/user/add',
						   	"edit_btn_url"=>panel.'/user/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/user/view/',
						   	"controller_name"=>'user',
						   	"page_name"=>'user-detail.php',
						   	"keys"=>'id,fname',
						   	"all_image_column_names"=>array("image","shop_image"),
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
		$data['type'] = $this->input->get('type');
		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = "All ".$this->arr_values['page_title'].'s';
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = base_url($this->arr_values['back_btn']);
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['view_url'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['edit_url'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['folder_name'] = panel.'/'.$this->arr_values['folder_name'].'/';
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['view_btn_url'] = $this->arr_values['view_btn_url'];
		$data['plan_btn_url'] = $this->arr_values['plan_btn_url'];
		$data['keys'] = $this->arr_values['keys'];			
		$data['pagenation'] = array($this->arr_values['title']);
		$data['trash'] = $this->input->get("trash");
		if(!empty($this->arr_values['all_image_column_names']) && is_array($this->arr_values['all_image_column_names']))
			$data['all_image_column_names'] = implode(",", $this->arr_values['all_image_column_names']);
		else
			$data['all_image_column_names'] = '';
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/index', $data);
	}

	public function load_data()
	{
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$table_id = 1;
		$kyc_step = 0;
		$listcheckbox = [];
		$filter_search_value = '';
		$keys = '';
		$where_query = "";
		$order_by = "id desc";
		$is_delete = 0;
		$type = 0;
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->limit))
				$limit = $post_data->limit;

			// if(!empty($post_data->status))
				$status = $post_data->status;

			if(!empty($post_data->order_by))
				$order_by = $post_data->order_by;

			if(!empty($post_data->page))
				$page = $post_data->page;

			// $kyc_step = $post_data->kyc_step;


			if(!empty($post_data->filter_search_value))
				$filter_search_value = $post_data->filter_search_value;
			if(!empty($post_data->keys))
				$keys = $post_data->keys;

			if(!empty($post_data->table_id))
				$table_id = $post_data->table_id;

			if(!empty($post_data->listcheckbox))
				$listcheckbox = $post_data->listcheckbox;

			if(!empty($post_data->is_delete))
				$is_delete = $post_data->is_delete;

			if(!empty($post_data->type))
				$type = $post_data->type;
		}
		if(isset($page))
		{
			$page = $page1 = $page;
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

		$date = date("Y-m-d");
		$year = date("Y",strtotime($date));
		$month = date("m",strtotime($date));
		$day = date("d",strtotime($date));
		if($month[0]==0)$month = $month[1];
		if($day[0]==0)$day = $day[1];
		$date = $year.'-'.$month.'-'.$day;
		
		$where_query .= " status='$status' and is_delete='$is_delete' and role='2' ";

		if($type==1)
		{
			$where_query .= " and CONCAT(YEAR(users.date_time),'-',MONTH(users.date_time),'-',DAY(users.date_time))='$date' ";
		}
		else if($type==3)
		{
			$where_query .= " and status='0' and is_delete='$is_delete' and role='2' ";
		}

		if(!empty($filter_search_value))
		{
			$limit = 100;
			$this->db->where(" concat($keys) like '%$filter_search_value%' ");
		}
		$this->db->order_by($order_by);
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$data['list'] = $this->db->get($this->arr_values['table_name'])->result_object();
		$extra_data = array("table_id"=>$table_id,);
		$data_count = count($this->db->select("id")->where($where_query)->get_where($this->arr_values['table_name'])->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_name'] = $this->arr_values['table_name'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['view_btn_url'] = $this->arr_values['view_btn_url'];
		$data['plan_btn_url'] = $this->arr_values['plan_btn_url'];
		$data['table_id'] = $table_id;
		$data['listcheckbox'] = $listcheckbox;
		$data['is_delete'] = $is_delete;
		$data['page_name'] = $this->arr_values['page_name'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		if(!empty($this->arr_values['all_image_column_names']) && is_array($this->arr_values['all_image_column_names']))
			$data['all_image_column_names'] = implode(",", $this->arr_values['all_image_column_names']);
		else
			$data['all_image_column_names'] = '';
		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/table',$data);
	}

	public function withdraw_data()
	{
		
		$data = [];
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$table_id = 1;
		$where_query = "";
		$order_by = "id desc";
		$is_delete = 0;
		$user_id = 0;
		$url = '';
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->page))
				$page = $post_data->page;
			if(!empty($post_data->table_id))
				$table_id = $post_data->table_id;
			if(!empty($post_data->user_id))
				$user_id = $post_data->user_id;
			if(!empty($post_data->url))
				$url = $post_data->url;
		}
		if(isset($page))
		{
			$page = $page1 = $page;
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
		$where_query .= "is_delete='0' and user_id='$user_id' ";
		$this->db->order_by($order_by);
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$data['list'] = $this->db->get("withdraw_request")->result_object();
		$extra_data = array("table_id"=>$table_id,"url"=>$url,);
		$data_count = count($this->db->select("id")->where($where_query)->get_where("withdraw_request")->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_id'] = $table_id;
		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/withdraw_table',$data);
	}

	public function wallet_data()
	{		
		$data = [];
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$table_id = 1;
		$where_query = "";
		$order_by = "id desc";
		$is_delete = 0;
		$user_id = 0;
		$url = '';
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->page))
				$page = $post_data->page;
			if(!empty($post_data->table_id))
				$table_id = $post_data->table_id;
			if(!empty($post_data->user_id))
				$user_id = $post_data->user_id;
			if(!empty($post_data->url))
				$url = $post_data->url;
		}
		if(isset($page))
		{
			$page = $page1 = $page;
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
		$where_query .= "is_delete='0' and user_id='$user_id' ";
		$this->db->order_by($order_by);
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$data['list'] = $this->db->get("user_history")->result_object();
		$extra_data = array("table_id"=>$table_id,"url"=>$url,);
		$data_count = count($this->db->select("id")->where($where_query)->get_where("user_history")->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_id'] = $table_id;
		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/wallet_history_table',$data);
	}
	public function bid_data()
	{
		$table_name = "game_bet";
		$data = [];
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$table_id = 1;
		$where_query = "";
		$order_by = "$table_name.id desc";
		$is_delete = 0;
		$user_id = 0;
		$url = '';
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->page))
				$page = $post_data->page;
			if(!empty($post_data->table_id))
				$table_id = $post_data->table_id;
			if(!empty($post_data->user_id))
				$user_id = $post_data->user_id;
			if(!empty($post_data->url))
				$url = $post_data->url;
		}
		if(isset($page))
		{
			$page = $page1 = $page;
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
		$where_query .= " $table_name.user_id='$user_id' ";


		
		$this->db->order_by($order_by);
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$this->db
		->select("users.fname as fname")
		->select("users.image as image")
		->select("users.mobile as mobile")
		->select("users.wallet as wallet")
		->select("users.user_id as user_id")


		->select("$table_name.id as id")
		->select("$table_name.amount as amount")
		->select("$table_name.p_id as p_id")		
		->select("$table_name.session_id as session_id")		
		->select("$table_name.p_type as type")
		->select("$table_name.date as add_date_time")

		->join("users as users","$table_name.user_id=users.id","LEFT");
		$data['list'] = $this->db->get("game_bet")->result_object();




		$extra_data = array("table_id"=>$table_id,"url"=>$url,);
		$data_count = count($this->db->select("id")->where($where_query)->get_where("game_bet")->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_id'] = $table_id;
		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/bid_history_table',$data);
	}


	public function winning_data()
	{
		
		$data = [];
		$limit = 12;
		$page = 1;
		$page1 = 1;
		$offset = 0;
		$status = 1;
		$table_id = 1;
		$where_query = "";
		$order_by = "id desc";
		$is_delete = 0;
		$user_id = 0;
		$url = '';
		$post_data = $this->input->post('post_data');
		if(!empty($post_data))
		{
			$post_data = json_decode($post_data);
			if(!empty($post_data->page))
				$page = $post_data->page;
			if(!empty($post_data->table_id))
				$table_id = $post_data->table_id;
			if(!empty($post_data->user_id))
				$user_id = $post_data->user_id;
			if(!empty($post_data->url))
				$url = $post_data->url;
		}
		if(isset($page))
		{
			$page = $page1 = $page;
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


		$where_query .= "win_amount>'0' and user_id='$user_id' ";
		$this->db->order_by($order_by);
		$this->db->where($where_query);
		$this->db->limit($limit,$offset);
		$list = $this->db
		->join("game_sessions as game_sessions","game_sessions.session_id = game_bet.session_id","left")
		->select("game_bet.*,
			game_sessions.result as result
			")
		->get("game_bet")->result_object();
		$data['list'] = $list;


		$extra_data = array("table_id"=>$table_id,"url"=>$url,);
		$data_count = count($this->db->select("id")->where($where_query)->get_where("game_bet")->result_object());
		$pagenation_data = pagination_custom(
			$data_count,
			$limit,
			$page1,
			$extra_data
		);
		$data['pagenation_data']=$pagenation_data;
		$data['table_id'] = $table_id;
		$this->load->view(panel.'/'.$this->arr_values['folder_name'].'/winning_table',$data);
	}


	public function add($id="") 
	{
		$data['title'] = $this->arr_values['title']." || Add";
		$data['page_title'] = "Add ".$this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['submit_url'] = $this->arr_values['submit_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['multipleimage'] = array();		
		$data['pagenation'] = array($this->arr_values['title'],'Add');
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/form', $data);
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
		{
			
			$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/form', $data);
		}
		else
			$this->template->load('template', panel.'/404', $data);
	}


	public function view($id="")
	{
		$data['title'] = $this->arr_values['title']." || View";
		$data['page_title'] = $this->arr_values['page_title'];
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['table_name'] = $this->arr_values['table_name'];
		$data['upload_path'] = $this->arr_values['upload_path'];
		$data['submit_url'] = $this->arr_values['submit_url'].'/'.$id;
		$data['back_btn'] = $this->arr_values['back_btn'];
		$data['btn_url'] = $this->arr_values['btn_url'];
		$data['add_btn_url'] = $this->arr_values['add_btn_url'];
		$data['edit_btn_url'] = $this->arr_values['edit_btn_url'];
		$data['pagenation'] = array($this->arr_values['title'],'View');
		$row = $this->db->get_where($this->arr_values['table_name'],array("id"=>$id,"is_delete"=>0,))->result_object();
		$data['row'] = $row;
		if(!empty($row))
			$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/view', $data);
		else
			$this->template->load('template', panel.'/404', $data);
	}


	
	public function update($id="")
	{
		$result = array();
      	$user_data = array();
     	$shop_name = $this->input->post('shop_name');
      

      	$slug = slug($shop_name);
      	$old_slug = '';
      	$mobile = $this->input->post('mobile');

	   	$status = 1;
	   	$user_data = array(
			"fname"=>$this->input->post('fname'),
			"lname"=>$this->input->post('lname'),
			"email"=>$this->input->post('email'),
			"mobile"=>$mobile,
			"password"=>$this->input->post('password'),
			"status"=>$status,
			"role"=>2,
	   	);

	   	
	   	$image = $this->input->post('shop_image');
	   	if (!empty($_FILES['shop_image_check']['name']))
      	{

          $image_content = base64_decode(explode(",", $image)[1]);
          $image_time = time().'user_profile.png';
          if(file_put_contents(APPPATH.'../upload/'.$image_time,$image_content))
          {
              $user_data['profile_image'] = $image_time;              
          }
     	}


	   if(!empty($this->db->select("id")->limit(1)->where(" id!='$id' ")->get_where($this->arr_values['table_name'],array("mobile"=>$mobile,"is_delete"=>0,))->result_object()))
	   {
	   	$result['message'] = "Mobile No. Allready exist...";
         $result['status']  = "400";
         $result['action']  = "add";
         echo json_encode($result);
         die;
	   }
			   


	     $add_update_ok = 0;
        if(empty($id))
        {        		
    		 $user_id = 100;
    		 $vendor = $this->db->select("user_id")->limit(1)->order_by("user_id desc")->get_where("users",array("is_delete"=>0,))->result_object();
    		 if(!empty($vendor))
    			$user_id = $vendor[0]->user_id+1;
    		 $user_data['user_id'] = $user_id;
    		 $user_data['date_time'] = date('Y-m-d H:i:s');
             $user_data['profile_image'] = 'user.png';              

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
        if($add_update_ok)
        {
		      $all_image_column_names = $this->arr_values['all_image_column_names'];
		      $return_image_array = $this->Image_model->upload_image($all_image_column_names,$this->arr_values['table_name'],$insert_id);
		      if(!empty($return_image_array))
		      {
			      foreach ($return_image_array as $key => $value)
			      {
			         $update_data[$key] = $value;
			      }
		      }







	        $slug = $this->Custom_model->insert_slug($slug,$insert_id,$this->arr_values['table_name'],$this->arr_values['controller_name']."/detail",$old_slug,$this->arr_values['page_name']);
	        $this->Custom_model->insert_meta_tags($slug,$old_slug);
        	  $update_data['slug'] = $slug;
	        $this->db->update($this->arr_values['table_name'],$update_data,array("id"=>$insert_id,));
        }
        echo json_encode($result);
	}
	
	public function bulk_action()
	{
		$bulkactiontype = $this->input->post("bulkactiontype");
		$table_id = $this->input->post("table_id");
		$status = false;
		$status_html = '';

		if($bulkactiontype=='delete')
			$status = $this->bulk_delete();
		if($bulkactiontype=='active' || $bulkactiontype=='inactive')
		{
			$status = $this->bulk_status();
			if($bulkactiontype=='active')
				$status_html = status_get(1,'');
			if($bulkactiontype=='inactive')
				$status_html = status_get(0,'');
		}
		if($bulkactiontype=='export')
			$status = $this->bulk_export();

		if($status==true)
		{
		   $result['message'] = "Successfully";
	      $result['status']  = "200";
	      $result['action']  = $bulkactiontype;
	      $result['data'] = array("status"=>$status_html,);
		}
		else
		{
			$result['message'] = "Not successfully";
	      $result['status']  = "400";
	      $result['action']  = $bulkactiontype;
	      $result['data'] = array("status"=>$status_html,);
		}
		echo json_encode($result);
	}


	public function bulk_delete()
	{
		$listcheckbox = $this->input->post("listcheckbox");
		$trashd = $this->input->get("trashd");
		$cols = explode(",", $this->input->get("cols"));
		$images_path = [];
		foreach ($cols as $key => $value)
		{
		  if(!empty($value))
		  {
		      $this->db->where_in("id",$listcheckbox);
		      $old_img_data_key = $this->db->select($value)->get_where($this->arr_values['table_name'])->result_object();
		      if(!empty($old_img_data_key))
		      {
		      	foreach ($old_img_data_key as $keyiimmgg => $old_img_data)
		      	{
			          $images = $old_img_data->$value;
			          if(!empty($images))
			          {
			              if(json_decode($images))
			              {
			                  foreach (json_decode($images) as $key5 => $value_img)
			                      $images_path[] = $value_img->image_path;
			              }
			          }
			      }
		      }
		  }
		}
		$slug = [];
	   $old_slug_data = $this->db->select("slug")->where_in("id",$listcheckbox)->get_where($this->arr_values['table_name'])->result_object();
	   if(!empty($old_slug_data))
	   {
	   	foreach ($old_slug_data as $key => $value)
	   	{
	   		$slug[] = $value->slug;
	   	}
	   }
		if(trash==false || !empty($trashd))
		{
			$this->db->where_in("id",$listcheckbox);
			if($this->db->delete($this->arr_values['table_name']))
			{
				foreach ($images_path as $key5 => $value_img)
            {
               if(file_exists(FCPATH.'upload/'.$value_img))
                   unlink(FCPATH.'upload/'.$value_img);
            }
				$this->db->where_in("slug",$slug);
				$this->db->delete("meta_tags");
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$this->db->where_in("id",$listcheckbox);
			if($this->db->update($this->arr_values['table_name'],array("is_delete"=>1,)))
			{
				$this->db->where_in("slug",$slug);
				$this->db->delete("slugs");
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	public function bulk_status()
	{
		$listcheckbox = $this->input->post("listcheckbox");
		$bulkactiontype = $this->input->post("bulkactiontype");
		$status = 0;
		if($bulkactiontype=='active')
			$status = 1;
		if($bulkactiontype=='inactive')
			$status = 0;


		$this->db->where_in("id",$listcheckbox);
		if($this->db->update($this->arr_values['table_name'],array("status"=>$status)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function bulk_export()
	{
		$listcheckbox = $this->input->post("listcheckbox");
		$bulkactiontype = $this->input->post("bulkactiontype");
		
		return false;
	}

	public function kyc_status_change()
	{
		$id = $this->input->post("id");
		$status = $this->input->post("status");
		$message = $this->input->post("message");
		
		$user_data['status'] = $status;
		$user_data['message'] = $message;
		$user_data['action_date_time'] = date("Y-m-d H:i:s");

		$data = $this->db->get_where("users",array("id"=>$id,))->result_object();
		if(!empty($data))
		{
			$data = $data[0];
			$user_id = $data->id;
			if(1==1)
	      {
	      	$this->db->update("users",array("kyc_step"=>$status,"message"=>$message,),array("id"=>$user_id,));
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
	   else
      {
         $result['message'] = "Wrong ID...";
         $result['status']  = "400";
         $result['action']  = "edit";
      }
      echo json_encode($result);
	}



}







