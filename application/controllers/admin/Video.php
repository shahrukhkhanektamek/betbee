<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use BoogieFromZk\AgoraToken\RtcTokenBuilder2;

class Video extends CI_Controller {

   protected $arr_values = array(
						   	'title'=>'Video', 
						   	'table_name'=>'user_history',
						   	'page_title'=>'Video',
						   	"submit_url"=>panel.'/video/update',
						   	"folder_name"=>'video',
						   	"upload_path"=>'upload/',
						   	"back_btn"=>panel.'/video',
						   	"btn_url"=>panel.'/video/add',
						   	"add_btn_url"=>panel.'/video/add',
						   	"edit_btn_url"=>panel.'/video/edit/',
						   	"plan_btn_url"=>panel.'/booking/index/',
						   	"view_btn_url"=>panel.'/video/view/',
						   	"controller_name"=>'video',
						   	"page_name"=>'video-detail.php',
						   	"keys"=>'user_history.id,user_history.user_id,users.fname,users.mobile,users.user_id',
						   	"all_image_column_names"=>array("image","shop_image"),
						   );  
   public function __construct()
    {
        parent::__construct(); 
        is_logged_in(); 
        is_admin_logged_in();
        $this->load->model('Custom_model','custom');
        $this->load->model('Image_model');
    }	
	public function index()
	{
		$data['title'] = "".$this->arr_values['title'];
		$data['page_title'] = "Live Stream";
		$data['controller_name'] = $this->arr_values['controller_name'];
		$data['pagenation'] = array($this->arr_values['title']);
		$this->template->load('template', panel.'/'.$this->arr_values['folder_name'].'/index', $data);
	}
	public function start_video()
	{
		$stream = $this->db->get_where("stream",array("id"=>1,))->result_object();
		if(!empty($stream))
		{
			$stream = $stream[0];
			$token_generated_at = $stream->date_time;
			$date_time = date("Y-m-d H:i:s");
			$current_time = time();
			$appID = agora_appid;
			$appCertificate = agora_appcertificate;
			$channelName = str_replace(" ", "", $stream->channel_name);
			$user_name = $stream->user_name;
			$uid = 123;
			$expiresInSeconds = 86400;


			$date1=date_create($token_generated_at);
			$date2=date_create($date_time);
			$diff=date_diff($date1,$date2);

			

			if($diff->y>0 || $diff->m>0 || $diff->d>0 || $diff->h>24)
			{
				$role = RtcTokenBuilder2::ROLE_PUBLISHER;
				$token = RtcTokenBuilder2::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $expiresInSeconds);
				$uid = 0;
				$token = RtcTokenBuilder2::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $expiresInSeconds);
		      $this->db->update("stream",array("channel_token"=>$token,"date_time"=>$date_time,),array("id"=>1,));
			}
			else
			{
			   $token = $stream->channel_token;				
			}

	        $data['token'] = $token;
	        $data['channelName'] = $channelName;
	        $data['user_id'] = $uid;
	        $data['user_name'] = $user_name;
	        $data['appid'] = agora_appid;

	        if(!empty($token))
	        {
		        $result['status'] = '200';
		        $result['message'] = 'Success...';
		        $result['data'] = $data;	        	
	        }
	        else
	        {
	        	$result['status'] = '400';
		        $result['message'] = 'Token Error';
		        $result['data'] = [];
	        }
	    }
	    else
	    {
	        $result['status'] = '400';
	        $result['message'] = 'Database error...';
	        $result['data'] = [];
	    }
	    echo json_encode($result);
	}

}







