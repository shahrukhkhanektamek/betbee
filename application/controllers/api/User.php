<?php
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
     
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Custom_model','custom');
        $this->token_data = token_auth();

    }
    public function index()
    {
        echo "string";
    }


    public function set_lat_long()
    {
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $latitude = $this->input->post("lat");
        $longitude = $this->input->post("long");
        $user = $this->db->get_where("users",array("id"=>$user_id,))->result_object();          
        if(!empty($user))
        {
            $user = $user[0];

            $this->db->update("users",array("latitude"=>$latitude,"longitude"=>$longitude,),array("id"=>$user_id,));

            $result['status'] = "200";
            $result['message'] = "Set successfully...";
            $result['data'] = [];
        }
        else
        {
            $result['status'] = "400";
            $result['message'] = "Invailid user...";
            $result['data'] = [];
        }
        echo json_encode($result);
    }
    public function update_image()
    {
        $result = array();
        $user_data = array();        
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $image = $this->input->post('image');
       
        if(!empty($user_id))
        {
            if ($image)
            {
                $image_content = base64_decode(explode(",", $image)[1]);
                $image_time = time().$user_id.'user_profile.png';
                if(file_put_contents(APPPATH.'../upload/'.$image_time,$image_content))
                {
                    $user_data = array(
                        "profile_image"=>$image_time,
                    );
                    if($this->db->update("users",$user_data,array('id' => $user_id, )))
                    {
                        $result['message'] = "Update successfully";
                        $result['status']  = "200";
                    }
                    else
                    {
                        $result['message'] = "Update not successfully";
                        $result['status']  = "400";
                    }                   
                }
            }
            else
            {
                $result['message'] = "Upload Image first...";
                $result['status']  = "400";
            }            
        }
        else
        {
            $result['message'] = "Please Enter Crrect User ID.";
            $result['status']  = "400";
        }
        echo json_encode($result);      
    }
    public function update_avtar()
    {
        $result = array();
        $user_data = array();        
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $avtar_id = $this->input->post('avtar_id');
       
        if(!empty($user_id))
        {
            $avtar = $this->db->get_where("avtar",array("is_delete"=>0,"status"=>1,"id"=>$avtar_id,))->result_object();
            if ($avtar)
            {
                $avtar = $avtar[0];
                $image = '';
                if(!empty($avtar->image))
                    if(json_decode($avtar->image))
                        if(file_exists(FCPATH.'upload/'.json_decode($avtar->image)[0]->image_path))
                            $image = json_decode($avtar->image)[0]->image_path;  

                $image_time = $image;
                if(!empty($image))
                {
                    $user_data = array(
                        "profile_image"=>$image_time,
                    );
                    if($this->db->update("users",$user_data,array('id' => $user_id, )))
                    {
                        $result['message'] = "Update successfully";
                        $result['status']  = "200";
                        $result['data']  = array("image"=>base_url('upload/'.$image),);
                    }
                    else
                    {
                        $result['message'] = "Update not successfully";
                        $result['status']  = "400";
                    }                   
                }
                else
                {
                    $result['message'] = "Error...";
                    $result['status']  = "400";
                } 
            }
            else
            {
                $result['message'] = "Select Avtar first...";
                $result['status']  = "400";
            }            
        }
        else
        {
            $result['message'] = "Please Enter Crrect User ID.";
            $result['status']  = "400";
        }
        echo json_encode($result);      
    }
    public function update_profile()
    {
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $fname = $this->input->post("name");
        $mobile = $this->input->post("mobile");

        $user = $this->db->get_where("users",array('id'=>$user_id,))->result_object();
        if(!empty($user))
        {
            $user = $user[0];
            $data = array(
                "fname"=>$fname,
                "mobile"=>$mobile,
            );
            $this->db->update("users",$data,array("id"=>$user_id,));


            $result['status']  = "200";
            $result['message'] = "Update successfully...";
            $result['action']  = "userupdate";
            $result['modaltype']  = "hide";
            $result['modalid']  = "offcanvasBottom2";
            $result['data']    = $this->user_detail_item($user_id);
        }
        else
        {
            $result['message'] = "User not found";
            $result['status']  = "400";
            $result['balance']  = "0";
            $result['data']    = array();
        }
        echo json_encode($result);
    }
    public function user_detail_item($user_id)
    {
        $data = array();
        $user = $this->db->get_where("users",array('id'=>$user_id,))->result_object();
        if(!empty($user))
        {
            $user = $user[0];
            $document_status = 0;
            $data = array(
                "name"=>$user->fname.' '.$user->lname,
                "email"=>$user->email,
                "mobile"=>$user->mobile,
                "address"=>$user->address,
                "image"=>base_url('upload/'.$user->profile_image),
            );
        }
        return $data;
    }
    public function password_update()
    {
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $oldpassword = $this->input->post("oldpassword");
        $npassword = $this->input->post("npassword");
        $cpassword = $this->input->post("cpassword");
        $address = '';

        $user = $this->db->get_where("users",array('id'=>$user_id,))->result_object();
        if(!empty($user))
        {
            $user = $user[0];
            if($user->password!=$oldpassword)
            {
                $result['status']  = "400";
                $result['message'] = "Old password not match...";
                $result['data']    = array();
                echo json_encode($result);
                die;
            }
            if($npassword!=$cpassword)
            {
                $result['status']  = "400";
                $result['message'] = "Confirm password not match...";
                $result['data']    = array();
                echo json_encode($result);
                die;
            }


            $data = array(
                "password"=>$npassword,
            );
            $this->db->update("users",$data,array("id"=>$user_id,));
            $result['status']  = "200";
            $result['message'] = "Update successfully...";
            $result['action']  = "add";            
            $result['data']    = array();
        }
        else
        {
            $result['message'] = "User not found";
            $result['status']  = "400";
            $result['balance']  = "0";
            $result['data']    = array();
        }
        echo json_encode($result);
    }
    public function history()
    {
         $html = '';
         $type2 = 0;
         $token_data = $this->token_data;
         $user_id = $token_data->user_id;
         $page = $this->input->post("page");
         $type2 = $this->input->post("type2");
         $use_type = $this->input->post("use_type");
         $category_id = $this->input->post("category_id");
         $limit = 12;
         $offset = 0;
         if($page>0)
         {
            $offset = $page*$limit;
         }
        

        
        $this->db->limit($limit,$offset);
        $this->db->order_by("user_history.id desc");



        if(!empty($type2))
        {
            $this->db->where(array("type2"=>$type2,));
        }
        $data = $this->db
             ->select("user_history.*")
             ->where(" user_history.amount>0 ")
             ->where(array('user_history.user_id'=>$user_id,))
             ->from('user_history as user_history')->get()->result_object();

         if(!empty($data))
         {
            if($use_type==0)
            {
                $response_data['data'] = $data;
                $html = $this->load->view("app/user/cards/wallet",$response_data,true);
            }
            else
            {
                $html = $data;
            }

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $html;
         }
         else
         {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
         }
         echo json_encode($result);
    }
    public function my_bets()
    {
        $this->load->model('Game_model');
         $html = '';
         $token_data = $this->token_data;
         $user_id = $token_data->user_id;
         $page = $this->input->post("page");
         $game_id = $this->input->post("game_id");
         $use_type = $this->input->post("use_type");
         $limit = 12;
         $offset = 0;
         if($page>0)
         {
            $offset = $page*$limit;
         }
        

        $game_session_data = $this->Game_model->session_data($game_id);
        $session_id = strval($game_session_data['session_id']);

        $this->db->limit($limit,$offset);
        $this->db->order_by("game_bet.id desc");
        $data = $this->db
             ->select("game_bet.*")
            //  ->where(" session_id!='$session_id' ")
             ->where(array('game_bet.user_id'=>$user_id,))
             ->from('game_bet as game_bet')->get()->result_object();

         if(!empty($data))
         {
            if($use_type==0)
            {
                $response_data['data'] = $data;
                $html = $this->load->view("app/user/cards/my_bet",$response_data,true);
            }
            else
            {
                $html = $data;
            }

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $html;
         }
         else
         {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
         }
         echo json_encode($result);
    }
    public function old_result()
    {
         $html = '';
         $token_data = $this->token_data;
         $user_id = $token_data->user_id;
         $page = $this->input->post("page");
         $use_type = $this->input->post("use_type");
         $game_id = $this->input->post("game_id");
         $limit = 102;
         $offset = 1;
         if($page>0)
         {
            $offset = $page*$limit;
         }
        $crtime = strtotime(date("Y-m-d H:i:s"));
        $this->db->limit($limit,$offset);
        $this->db->order_by("game_sessions.id desc");
        $this->db->where("game_sessions.date_time < ",$crtime);
        $data = $this->db
             ->select("game_sessions.*")
             ->where(array('game_sessions.game_id'=>$game_id,))
             ->from('game_sessions as game_sessions')->get()->result_object();

         if(!empty($data))
         {
            if($use_type==0)
            {
                $response_data['data'] = $data;
                $html = $this->load->view("app/user/cards/old_result",$response_data,true);
            }
            else
            {
                $html = $data;
            }

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $html;
         }
         else
         {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
         }
         echo json_encode($result);
    }
    public function my_referral()
    {
         $html = '';
         $token_data = $this->token_data;
         $user_id = $token_data->user_id;
         $r_id = $this->db->select('user_id')->get_where("users",array("id"=>$user_id,))->result_object()[0]->user_id;
         $page = $this->input->post("page");
         $use_type = $this->input->post("use_type");
         $limit = 12;
         $offset = 0;
         if($page>0)
         {
            $offset = $page*$limit;
         }        
        $this->db->limit($limit,$offset);
        $this->db->order_by("users.id desc");
        $data = $this->db
             ->select("users.*")
             ->where(array('users.referral_id'=>$r_id,))
             ->from('users as users')->get()->result_object();


         if(!empty($data))
         {
            if($use_type==0)
            {
                $response_data['data'] = $data;
                $html = $this->load->view("app/user/cards/my-referral",$response_data,true);
            }
            else
            {
                $html = $data;
            }

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $html;
         }
         else
         {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
         }
         echo json_encode($result);
    }
    public function withdraw_history()
    {
         $html = '';
         $token_data = $this->token_data;
         $user_id = $token_data->user_id;
         $page = $this->input->post("page");
         $use_type = $this->input->post("use_type");
         $category_id = $this->input->post("category_id");
         $limit = 12;
         $offset = 0;
         if($page>0)
         {
            $offset = $page*$limit;
         }        
        $this->db->limit($limit,$offset);
        $this->db->order_by("withdraw_request.id desc");
        $data = $this->db
             ->select("withdraw_request.*")
             ->where(array('withdraw_request.user_id'=>$user_id,))
             ->from('withdraw_request as withdraw_request')->get()->result_object();

         if(!empty($data))
         {
            if($use_type==0)
            {
                $response_data['data'] = $data;
                $html = $this->load->view("app/user/cards/withdraw_history",$response_data,true);
            }
            else
            {
                $html = $data;
            }

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $html;
         }
         else
         {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
         }
         echo json_encode($result);
    }
    public function withdraw_request()
    {
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $request_id = time().$user_id;
        $pay_type = $this->input->post("type");
        $amount = $this->input->post("amount");
        $gpay_number = $this->input->post("gpay_number");
        $paytm_number = $this->input->post("paytm_number");
        $phonepe_number = $this->input->post("phonepe_number");
        $account_number = $this->input->post("account_number");
        $ifsc = $this->input->post("ifsc");
        $holder_name = $this->input->post("holder_name");
        $date_time = date("Y-m-d H:i:s");   
        $order_id = rand().$user_id;
        $user = $this->db->get_where("users",array('id'=>$user_id,))->result_object();
        if(!empty($user))
        {
            $user = $user[0];
            $wallet_amount = $user->wallet;
            $win_amount = $this->custom->win_amount($user_id);

            $setting = $this->db->select("min_withdraw")->get_where("setting")->result_object()[0];
            $min_withdraw = $setting->min_withdraw;

            if($amount<$min_withdraw)
            {
                $result['message'] = "Min Withdraw amount ".$min_withdraw;
                $result['status']  = "400";
                $result['action']  = "add";
                $result['data']    = array();
                echo json_encode($result);
                die;
            }

            if($win_amount<$amount)
            {
                $result['status']  = "400";
                $result['message'] = "Insufficient Fund...";
                $result['data']    = array();
                echo json_encode($result);
                die;
            }
            
            $data = array(
                "user_id"=>$user_id,
                "pay_type"=>$pay_type,
                "amount"=>$amount,
                "gpay_number"=>$gpay_number,
                "paytm_number"=>$paytm_number,
                "phonepe_number"=>$phonepe_number,
                "account_number"=>$account_number,
                "ifsc"=>$ifsc,
                "holder_name"=>$holder_name,
                "request_id"=>$request_id,
                "status"=>0,
                "is_delete"=>0,
                "date"=>date("Y-m-d"),
                "time"=>date("H:i:s"),
                "date_time"=>date("Y-m-d H:i:s"),
            );
            $this->db->insert("withdraw_request",$data);
            $insert_id = $this->db->insert_id();


            // $win_amount = $this->custom->win_amount($user_id);
            // if($win_amount>0) $this->custom->win_amount_credit_debit($user_id,'debit',$amount);

            // $this->custom->wallet_credit_debit($user_id,'debit',$amount,$message,0,2);

            $message = 'Withdraw';
            $this->custom->win_amount_credit_debit($user_id,'debit',$amount,$message,0,2);



            $result['message'] = "Withdraw request successfully...";
            $result['status']  = "200";
            $result['action']  = "add";
            $result['data']    = array("request_id"=>$request_id,);
        }
        else
        {
            $result['message'] = "User not found";
            $result['status']  = "400";
            $result['action']  = "add";
            $result['data']    = array();
        }
        echo json_encode($result);
    }
    public function document_update()
    {

        $token_data = $this->token_data;
        $user_id = $token_data->user_id;

        $result = array();

        $account_no = $this->input->post('account_no');
        $ifsc_code = $this->input->post('ifsc_code');
        $holder_name = $this->input->post('holder_name');
        $upi_id = $this->input->post('upi_id');
        
        $today = strtotime(date("Y-m-d"));
        $user_detail2 = array();
        $user_data = array(
            "account_no"=>$account_no,
            "ifsc_code"=>$ifsc_code,
            "holder_name"=>$holder_name,
            "upi_id"=>$upi_id,
            "kyc_step"=>1,
        );
        $row = $this->db->update("users",$user_data,array("id"=>$user_id,));
        if($row)
        {
            $result['message'] = "Update Successfully...";
            $result['status']  = "200";
            $result['action']  = "edit";
            $result['data']  = $user_detail2;
        }
        else
        {
            $result['message'] = "Update Not Successfully...";
            $result['status']  = "400";
            $result['data']    = $user_detail2;
        }               
        echo json_encode($result);
    }
    public function notification_status_change()
    {
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $result = array();        
        $user_detail2 = array();

        $user = $this->db->select('notification_status')->get_where("users",array("id"=>$user_id,))->result_object();
        if(empty($user))
        {
            $result['message'] = "User Not Found";
            $result['status']  = "400";
            $result['data']    = [];
            echo json_encode($result);
            die;
        }
        $user = $user[0];
        $status = $user->notification_status;
        if($status==0) $status = 1;
        else $status = 0;
        $user_data = array(
            "notification_status"=>$status,
        );
        
        if($this->db->update("users",$user_data,array("id"=>$user_id,)))
        {
            if($status==1)
                $result['message'] = "Notification ON";
            else
                $result['message'] = "Notification OFF";
            $result['status']  = "200";
            $result['action']  = "edit";
            $result['data']  = [];
        }
        else
        {
            $result['message'] = "Update Not Successfully...";
            $result['status']  = "400";
            $result['data']    = [];
        }               
        echo json_encode($result);
    }
    public function add_point_request()
    {
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $request_id = time().$user_id;
        $type = 1;
        $amount = $this->input->post("amount");
        $image = $this->input->post("image");
        $txn_no = $this->input->post("txn_no");
        $date_time = date("Y-m-d H:i:s");   
        $order_id = rand().$user_id;
        $user = $this->db->get_where("users",array('id'=>$user_id,))->result_object();

        $setting = $this->db->select("min_deposit")->get_where("setting")->result_object()[0];
        $min_deposit = $setting->min_deposit;



        if(empty($txn_no) && empty($image))
        {
            $result['message'] = "Select image or TXN No.";
            $result['status']  = "400";
            $result['action']  = "add";
            $result['data']    = array();
            echo json_encode($result);
            die;
        }

        if($amount<$min_deposit)
        {
            $result['message'] = "Min Diposit amount ".$min_deposit;
            $result['status']  = "400";
            $result['action']  = "add";
            $result['data']    = array();
            echo json_encode($result);
            die;
        }
        $image_time = '';
        if(!empty($image))
        {
            $image_content = base64_decode(explode(",", $image)[1]);
            $image_time = time().$user_id.'screenshot.png';
            if(file_put_contents(APPPATH.'../upload/'.$image_time,$image_content))
            {
            }
            else $image_time = '';
        } 


        if(!empty($user))
        {
            $user = $user[0];
            $data = array(
                "user_id"=>$user_id,
                "type"=>$type,
                "amount"=>$amount,
                "image"=>$image_time,
                "request_id"=>$request_id,
                "txn_no"=>$txn_no,
                "status"=>0,
                "is_delete"=>0,
                "date"=>date("Y-m-d"),
                "time"=>date("H:i:s"),
                "date_time"=>date("Y-m-d H:i:s"),
                "add_date_time"=>date("Y-m-d H:i:s"),
                "update_date_time"=>date("Y-m-d H:i:s"),
            );
            $this->db->insert("recharge_request",$data);
            $insert_id = $this->db->insert_id();



            $result['message'] = "Recharge request successfully...";
            $result['status']  = "200";
            $result['action']  = "add";
            $result['data']    = array("request_id"=>$request_id,);
        }
        else
        {
            $result['message'] = "User not found";
            $result['status']  = "400";
            $result['action']  = "add";
            $result['data']    = array();
        }
        echo json_encode($result);
    }
    public function recharge_history()
    {
         $html = '';
         $token_data = $this->token_data;
         $user_id = $token_data->user_id;
         $page = $this->input->post("page");
         $limit = 12;
         $offset = 0;
         if($page>0)
         {
            $offset = $page*$limit;
         }
        

        
        $this->db->limit($limit,$offset);
        $this->db->order_by("recharge_request.id desc");
        $data = $this->db
             ->select("recharge_request.*")
             ->where(array('recharge_request.user_id'=>$user_id,))
             ->from('recharge_request as recharge_request')->get()->result_object();

         if(!empty($data))
         {
            $response_data['data'] = $data;
            $html = $this->load->view("app/user/cards/recharge_history",$response_data,true);            

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $html;
         }
         else
         {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
         }
         echo json_encode($result);
    }
    public function point_transfer()
    {
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $request_id = time().$user_id;
        $type = $this->input->post("type");
        $amount = $this->input->post("amount");
        $mobile = $this->input->post("mobile");
        $date_time = date("Y-m-d H:i:s");   
        $order_id = rand().$user_id;
        $user = $this->db->get_where("users",array('id'=>$user_id,))->result_object();
        
        
        



        if(!empty($user))
        {
            $user = $user[0];
            $user2 = $this->db->get_where("users",array('mobile'=>$mobile,))->result_object();
            if(empty($user2))
            {
                $result['message'] = "Wrong Mobile";
                $result['status']  = "400";
                $result['action']  = "add";
                $result['data']    = array();
                echo json_encode($result);
                die;
            }
            $user2 = $user2[0];

            if($user->wallet<$amount)
            {
                $result['message'] = "You have only ".price_formate($user->wallet);
                $result['status']  = "400";
                $result['action']  = "add";
                $result['data']    = array();
                echo json_encode($result);
                die;
            }
            $message = 'Point transfer to '.$user2->mobile;
            $type = 'debit';
            $join_id = '0';
            $this->custom->wallet_credit_debit($user_id,$type,$amount,$message,$join_id);

            $message = 'Point recieve by '.$user->mobile;
            $type = 'credit';
            $join_id = '0';
            $this->custom->wallet_credit_debit($user2->id,$type,$amount,$message,$join_id);


            $result['message'] = "Point transfer successfully...";
            $result['status']  = "200";
            $result['action']  = "add";
            $result['data']    = array();
        }
        else
        {
            $result['message'] = "User not found";
            $result['status']  = "400";
            $result['action']  = "add";
            $result['data']    = array();
        }
        echo json_encode($result);
    }
    public function game_history()
    {
        $html = '';
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
        $page = $this->input->post("page");
        $game_id = $this->input->post("game_id");
        $limit = 12;
        $offset = 0;
        if($page>0)
        {
            $offset = $page*$limit;
        }
        
        $this->db->limit($limit,$offset);
        $this->db->order_by("game_bet.id desc");
        $data = $this->db

            ->select("game_times.name as game_name")
            ->select("game_times.open_time as open_time")
            ->select("game_times.close_time as close_time")
            ->select("card.name as game_type")
            ->select("card.win_price as win_price")

            ->select("game_bet.id as id")
            ->select("game_bet.amount as amount")
            ->select("game.name as game_name2")
            ->select("game_bet.bid as bid")
            ->select("game_bet.bid2 as bid2")
            ->select("game_bet.type as type")
            ->select("game_bet.session_id as session_id")
            ->select("game_bet.card_id as card_id")
            ->select("game_bet.add_date_time as add_date_time")

            ->join("game as game","game_bet.game_id=game.id","LEFT")
            ->join("game_times as game_times","game_bet.time_id=game_times.id","LEFT")
            ->join("card as card","game_bet.card_id=card.id","LEFT")



            ->select("game_bet.*")
            ->where(array('game_bet.user_id'=>$user_id,"game_bet.game_id"=>$game_id,))
            ->from('game_bet as game_bet')->get()->result_object();

        if(!empty($data))
        {
            $response_data['data'] = $data;
            $html = $this->load->view("app/user/cards/game_history",$response_data,true);            

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $html;
        }
        else
        {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
        }
        echo json_encode($result);
    }
    public function all_bet()
    {
        $this->load->model('Game_model');
        $html = '';
        $token_data = $this->token_data;
        $user_id = $token_data->user_id;
         
        $this->db->order_by("rand()");
        $data = $this->db
             ->select("dummy_users.*")
             ->from('dummy_users as dummy_users')->get()->result_object();

         if(!empty($data))
         {
            $response_data['data'] = $data;           

            $result['message'] = "Successfully...";
            $result['status']  = "200";
            $result['data']    = $data;
         }
         else
         {
            $result['message'] = "Not found..";
            $result['status']  = "400";
            $result['data']    = [];
         }
         echo json_encode($result);
    }
    public function profile_detail()
    {

    }  


    
}
