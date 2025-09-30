<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Auth extends CI_Controller {

	 

	public function __construct()

    {

        parent::__construct();

        $this->load->library('form_validation');

        $this->load->model('Auth_model','auth');

    }
    public function login()
    {

        $username = strtolower($this->input->post('username'));
        $password = $this->input->post('password');
        $url = '';
        $this->db->where(" email='$username' || username='$username' ");
        $user = $this->db->get_where("users")->result_array();
        // print_r($user);
        if(!empty($username)&&!empty($password))
        {
            if(count($user) > 0)
            {
                $user = $user[0];
                if($password==$user['password'])
                {
                    if($user['status']=="Active" || $user['status']==1)
                    {
                        if($user['role']==2)
                        {
                            $data = [
                                'username' => $user['email'],
                                'role' => $user['role'],
                                'id' => $user['id'],
                            ];
                            $this->session->set_userdata($data);
                            if($user['role']==2)
                                $url = base_url('vendor/dashboard');
                            else
                                $url = base_url('retailer');
                            $user_id = $user['id'];
                            $result['message'] = "Login successfully";
                            $result['status']  = "200";
                            $result['action']  = "login";
                            $result['url']  = $url;
                        }
                        else
                        {
                            $result['message'] = "Under review by admin . . .";
                            $result['status']  = "400";
                            $result['action']  = "login";
                            $result['url']  = base_url('user');
                        }
                    }
                    else
                    {
                        $result['message'] = "Your Account Is Deativated . . .";
                        $result['status']  = "400";
                        $result['action']  = "login";
                        $result['url']  = base_url('user');
                    }
                }
                else
                {
                    $result['message'] = "Wrong Password . . .";
                    $result['status']  = "400";
                    $result['action']  = "login";
                    $result['url']  = base_url('user');
                }
            }
            else
            {
                $result['message'] = "Wrong Username Or Email . . .";
                $result['status']  = "400";
                $result['action']  = "login";
                $result['url']  = base_url('user');
            }
        }
        else
        {
            $result['message'] = "User Name and Password Mandatory...";
            $result['status']  = "400";
            $result['action']  = "login";
            $result['url']  = base_url('user');
        }
        echo json_encode($result);
    }

	public function logout()
    {

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('type');
        $this->session->unset_userdata('id');
        redirect(base_url());

    }

	

}

