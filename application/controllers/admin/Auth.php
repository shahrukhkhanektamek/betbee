<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	 
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	public function index()
	{
		echo "string";
		// $data['title'] = "About";
		// $data['button'] = "About";
		// $data['pagenation'] = array('Dashboard','About');

		// $this->template->load('template', 'admin/pages/About/list', $data);
	}
	public function login()
	{
		$username = strtolower($this->input->post('username'));
        $password = $this->input->post('password');
        $user = $this->db->get_where("admin",array('username'=>$username,))->result_array();
        


        
        
        if(captcha==true)
        {
            $recaptcha = $_POST['g-recaptcha-response'];
            $secret_key = captcha_secretekey;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
                . $secret_key . '&response=' . $recaptcha;
            $response = file_get_contents($url);
            $response = json_decode($response);
            if ($response->success != true) {
                $result['message'] = "Invailid Captcha...";
                $result['status']  = "400";
                $result['action']  = "login";
                $result['data']  = '<script src="https://www.google.com/recaptcha/api.js" async defer></script><div class="g-recaptcha" data-sitekey="'.captcha_sitekey.'"></div>';
                echo json_encode($result);
                die;
            }
        }



        if(!empty($username)&&!empty($password))
        {
            if(count($user) > 0)
            {
                $user = $user[0];
            	if($username==$user['username'] && $password==$user['password'])
            	{
            		if($user['status']=="Active" || $user['status']==1)
            		{
            			$data = [
                            'username' => $user['username'],
                            'role' => $user['role'],
                            'id' => $user['id'],
                            'password' => $user['password'],
                        ];
                        $this->session->set_userdata($data);
                        $user_id = $user['id'];
                        $result['message'] = "Login successfully";
                        $result['status']  = "200";
                        $result['action']  = "login";
                        $result['url']  = base_url('admin');
            		}
            		else
            		{
                        $result['message'] = "Your Account Is Deativated . . .";
                        $result['status']  = "400";
                        $result['action']  = "login";
                        $result['url']  = base_url('admin');
            		}
            	}
            	else
            	{
                    $result['message'] = "Wrong Password . . .";
                    $result['status']  = "400";
                    $result['action']  = "login";
                    $result['url']  = base_url('admin');
            	}
            }
            else
            {
                $result['message'] = "Wrong Username Or Email . . .";
                $result['status']  = "400";
                $result['action']  = "login";
                $result['url']  = base_url('admin');
            }
        }
        else
        {
            $result['message'] = "User Name and Password Mandatory...";
            $result['status']  = "400";
            $result['action']  = "login";
            $result['url']  = base_url('admin');
        }
        echo json_encode($result);
	}
	public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('id');
        redirect(base_url("admin"));
    }
	
}
