<?php



function encode_token($data)
{
  $data = json_encode($data);
  return base64_encode(base64_encode(base64_encode($data)));
}
function decode_token($data)
{
  $data = base64_decode(base64_decode(base64_decode($data)));
  return $data = json_decode($data);
}

function token_auth()
{
    $ci =& get_instance();
    $result = [];
    $headers = getallheaders();    
    

    $access_token = $ci->session->userdata('access_token');

    
    if(isset($headers['token']) || !empty($access_token))
    {
      if(empty($access_token))
        $token_string = $headers['token'];
      else
        $token_string = $access_token;
        
      $token_array = decode_token($token_string);
      if(!empty($token_array->user_id)) $user_id = $token_array->user_id; else $user_id = 0;
      if(!empty($token_array->password)) $password = $token_array->password;else $password = '';
      if(!empty($token_array->hours)) $hours = $token_array->hours;else $hours = 0;
      if(!empty($token_array->date_time)) $date_time = $token_array->date_time;else $date_time = '';



      $datetime_1 = $date_time; 
      $datetime_2 = date("Y-m-d H:i:s"); 
      $start_datetime = new DateTime($datetime_1); 
      $diff = $start_datetime->diff(new DateTime($datetime_2)); 
      // echo $diff->days.' Days total<br>'; 
      // echo $diff->y.' Years<br>'; 
      // echo $diff->m.' Months<br>'; 
      // echo $diff->d.' Days<br>'; 
      // echo $diff->h.' Hours<br>'; 
      // echo $diff->i.' Minutes<br>'; 
      // echo $diff->s.' Seconds<br>';
      $total_minutes = ($diff->days * 24 * 60); 
      $total_minutes += ($diff->h * 60); 
      $total_minutes += $diff->i; 
      $total_hours = $total_minutes/60;
      if($total_hours<=$hours || 1==1)
      {
          $user = $ci->db->get_where("users",array("id"=>$user_id,))->result_object();          
          if(!empty($user))
          {
              $user = $user[0];
              if($user->password!=$password)
              {
                  $result['status'] = "401";
                  $result['message'] = "Invailid user...";
                  $result['data'] = [];
                  echo json_encode($result);
                  die;
              }
              else
              {
                return $token_array;
              }
          }
          else
          {
              $result['status'] = "401";
              $result['message'] = "Invailid user...";
              $result['data'] = [];
              echo json_encode($result);
              die;
          }
      }
      else
      {
          $result['status'] = "401";
          $result['message'] = "Token Expired...";
          $result['data'] = [];
          echo json_encode($result);
          die;
      }
    }
    else
    {
        $result['status'] = "401";
        $result['message'] = "Token Required...";
        $result['data'] = [];
        echo json_encode($result);
        die;
    }    
    


}
function token_auth_web($access_token)
{
    $ci =& get_instance();
    $result = [];
    $headers = getallheaders();

    
    if(isset($access_token))
    {
      $token_string = $access_token;
      $token_array = decode_token($token_string);
      if(!empty($token_array->user_id)) $user_id = $token_array->user_id; else $user_id = 0;
      if(!empty($token_array->password)) $password = $token_array->password;else $password = '';
      if(!empty($token_array->hours)) $hours = $token_array->hours;else $hours = 0;
      if(!empty($token_array->date_time)) $date_time = $token_array->date_time;else $date_time = '';



      $datetime_1 = $date_time; 
      $datetime_2 = date("Y-m-d H:i:s"); 
      $start_datetime = new DateTime($datetime_1); 
      $diff = $start_datetime->diff(new DateTime($datetime_2)); 
      // echo $diff->days.' Days total<br>'; 
      // echo $diff->y.' Years<br>'; 
      // echo $diff->m.' Months<br>'; 
      // echo $diff->d.' Days<br>'; 
      // echo $diff->h.' Hours<br>'; 
      // echo $diff->i.' Minutes<br>'; 
      // echo $diff->s.' Seconds<br>';
      $total_minutes = ($diff->days * 24 * 60); 
      $total_minutes += ($diff->h * 60); 
      $total_minutes += $diff->i; 
      $total_hours = $total_minutes/60;
      if($total_hours<=$hours)
      {
          $user = $ci->db->get_where("users",array("id"=>$user_id,))->result_object();          
          if(!empty($user))
          {
              $user = $user[0];
              if($user->password!=$password)
              {
                  $result['status'] = "401";
                  $result['message'] = "Invailid user...";
                  $result['data'] = [];
              }
              else
              {
                return $token_array;
              }
          }
          else
          {
              $result['status'] = "401";
              $result['message'] = "Invailid user...";
              $result['data'] = [];
          }
      }
      else
      {
          $result['status'] = "401";
          $result['message'] = "Token Expired...";
          $result['data'] = [];
      }
    }
    else
    {
        $result['status'] = "401";
        $result['message'] = "Token Required...";
        $result['data'] = [];
    }    
    


}



function slug($text, string $divider = '-')
{
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = trim($text, $divider);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}







function get_user_app()
{
  $ci =& get_instance();
  $table_name = 'users';
  $user_session = $ci->session->userdata("user");

  if(!empty($user_session))
  {
    $id = $user_session['id'];
    $role = $user_session['role'];
    $where = array("id"=>$id,);
    $user = $ci->db->get_where($table_name,$where)->result_object();
    if(!empty($user))
    {
      $user = $user[0];
      if($role==1)
      {
        $data['image'] = base_url('upload/').$user->files;
      }
      else
      {
        $data['image'] = base_url('upload/').$user->profile_image;
      }
      $data['full_detail'] = $user;
      return $data;
    }
    else
      return FALSE;
  }
  else
    return FALSE;
}
function set_user_session()
{
  $ci =& get_instance();
  $device_id = $ci->session->userdata("device_id");
  if(empty($device_id))
  {
    $device_id = uniqid();
    // .$_SERVER['REMOTE_ADDR']
    $ci->session->set_userdata(array("device_id"=>$device_id,));
  }
}
function user_app_logged_in($page='',$login_required_pages='',$login_not_required_pages='')
{

  $count = explode(".", $page);
  if(count($count)>0) $page = $count[0];
  else $page = $count[0].'.'.$count[1];

    $ci =& get_instance();
    $id = 0;
    $status = 0;
    $role = 0;


    $access_token = decode_token($ci->session->userdata('access_token'));
    if(!empty($access_token))
    {
      $user_id = $access_token->user_id;
      $role = $access_token->role;
      $check_login = $ci->db->order_by('id desc')->limit(1)->get_where("login_history",array('user_id'=>$user_id,"status"=>1,))->result_object();


      if(!empty($check_login))
      {
        $check_login = $check_login[0];
        $user = $ci->db->get_where("users",array('id'=>$user_id,"role"=>$role,))->result_object();
        if(!empty($user))
        {
          $user = $user[0];
          if($user->password==$check_login->password)
          {
            $status = 1;
          }
          else
            $status = 5; // password not match            
        }
        else
        {
          $status = 4; // account not found
        } 
      }
      else
      {
        $status = 3; // not loged in
      }
    }
    else
    {
      $status = 2; // session not set
    }  
    

    if(in_array($page, $login_required_pages) && $status!=1)
    {
      $status = 6; // send on login page
    }
    if(in_array($page, $login_not_required_pages) && $status==1)
    {
      $status = 7; // send on home page
    }
    return $status;
}









function front_user_pages()
{
  return array("dashboard","profile","wallet","edit-profile");
}
function is_user_logged_in($page='')
{
    $ci =& get_instance();
    $role = $ci->session->userdata('role');

    if($role==1)
    {
      $ci->session->unset_userdata('username');
      $ci->session->unset_userdata('type');
      $ci->session->unset_userdata('id');
      $ci->session->unset_userdata('role');
    }
    $device_id = $ci->session->userdata("device_id");
    $id = 0;
    if(!empty($device_id) && $role!=1)
    {
      $check_login = $ci->db->order_by('id desc')->limit(1)->get_where("login_history",array('device_id'=>$device_id,"status"=>1,))->result_array();
      if(!empty($check_login))
      {
        $check_login = $check_login[0];

        $access_token = $check_login['access_token'];
        $access_token = $ci->session->set_userdata(array('access_token'=>$access_token));
        

        $id = $check_login['user_id'];
        $ci->session->set_userdata(array("user"=>array("role"=>2,"id"=>$id,),));
        $user = $ci->db->get_where("users",array('id'=>$id,))->result_array();

        if(!empty($user))
        {
          if($user[0]['password']!=$check_login['password'])
          {
              $ci->db->update("login_history",array("status"=>0,),array("user_id"=>$id,"status"=>1,));
              $ci->session->unset_userdata('user');
              if($page!='login.php' && $page!='signup.php')
                redirect(base_url('app/login?device_id='.$ci->session->userdata("device_id")));
          }
          else
          {
            if($page=='login.php' || $page=="signup.php" || $page=="forgot-password.php" || $page=="create-new-password.php")
            {
              redirect(base_url('app/dashboard'));
            }
          }
        }
        else
        {
          $ci->db->update("login_history",array("status"=>0,),array("user_id"=>$id,"status"=>1,));
          $ci->session->unset_userdata('user');
          if($page!='login.php' && $page!='signup.php' && $page!='forgot-password.php' && $page!='create-new-password.php')
            redirect(base_url('app/login?device_id='.$ci->session->userdata("device_id")));
        }
      }   
      else
      {
        $ci->db->update("login_history",array("status"=>0,),array("user_id"=>$id,"status"=>1,));
        $ci->session->unset_userdata('user');
        if($page!='login.php' && $page!='signup.php' && $page!='forgot-password.php' && $page!='create-new-password.php')
          redirect(base_url('app/login?device_id='.$ci->session->userdata("device_id")));
      }   
    }
    else
    {
      $ci->db->update("login_history",array("status"=>0,),array("user_id"=>$id,"status"=>1,));
      $ci->session->unset_userdata('user');
      if($page!='login' && $page!='signup')
        redirect(base_url('app/login?device_id='.$ci->session->userdata("device_id")));
    }
}



function pagination_custom($count,$limit,$page,$extra_data)
{
  $url_extra = '';
  if(!empty($extra_data['url'])) $url_extra = $extra_data['url'];
  $url = '#!';
  $ci =& get_instance();
  $active_page = $page_active = $page;
  if(!empty($where))
    $where = " where ".$where;
  if ($page==1|| $page==0)
  {
    $offset = 0;
  }
  else
  {
    $offset = $limit * $page;
  }
  $page11=$page;
  // $result = $ci->db->query("select id from $table_name $where   ")->result_object();
  $number_of_result = $count;
  $number_of_page = ceil ($number_of_result / $limit); 
  $page_prev = $page;
  $page_next = $page;
  ++$page_next;
  if($page>1)
    --$page_prev;
  $page1 = 1;
  $j=1;
  if($page==1 || $page==0)
  {
    $from_start = 1;
    $to_end = $limit;
  }
  else
  {
    $from_start = $offset-$limit;
    $to_end = $offset;
  }

  if($number_of_result<$limit)
  {
    $to_end = $number_of_result;
  }

  $page_list = array();
  $previous_list[] = array("url"=>'',"page"=>'',);
  $next_list[] = array("url"=>'',"page"=>'',"table_id"=>$extra_data['table_id'],"extra_url"=>$url_extra,);
  while( $page1<= $number_of_page)
  {
    if($page1==1)
    {
      $previous_list = array();
      $previous_list[] = array("url"=>$url,"page"=>$page_prev,"table_id"=>$extra_data['table_id'],"extra_url"=>$url_extra,);
    }
    if($page_active==$page1) $active = "active";else $active = "";
    if( $page1>=$page11&&$j<=5&&$page1!=$number_of_page )
    {
      $page_list[] = array("url"=>$url,"page"=>$page1,"table_id"=>$extra_data['table_id'],"extra_url"=>$url_extra,);
      $j++;
    }
    if($j==5)
    {
      $page_list[] = array("url"=>"","page"=>"...","table_id"=>$extra_data['table_id'],"extra_url"=>$url_extra,);
    }
    if($page1==$number_of_page)
    {
      $page_list[] = array("url"=>$url,"page"=>$page1,"table_id"=>$extra_data['table_id'],"extra_url"=>$url_extra,);
    }
    if($page1==$number_of_page && $page_next <= $number_of_page)
    { 
      $next_list = array();
      $next_list[] = array("url"=>$url,"page"=>$page_next,"table_id"=>$extra_data['table_id'],"extra_url"=>$url_extra,);
    }
    $page1++;
  }
  $result_data = array("previous_list"=>$previous_list,"next_list"=>$next_list,"page_list"=>$page_list,"total_count"=>$number_of_result,"from"=>$from_start,"to"=>$to_end,"active_page"=>$active_page,"total_page"=>$number_of_page,);
  return $result_data;
}






function status_get($value,$type)
{

  $class = 'badge bg-success';
  $status = 'Active';
  $html = '';
  if(empty($type))
  {
    if($value==1)
    {
      $status = 'Active';
      $class = 'badge bg-success';
    }
    else if($value==0)
    {
      $status = 'Inactive';
      $class = 'badge bg-danger';
    }
    $html = '<label class="badge '.$class.'" >'.$status.'</label>';
  }
  else if($type=='withdraw')
  {
    if($value==0)
    {
      $html = '<label class="badge badge-info">Pending...</label>';
    }
    else if($value==1)
    {
      $html = '<label class="badge badge-success">Accepted</label>';
    }
    else if($value==2)
    {
      $html = '<label class="badge badge-danger">Rejected</label>';
    }
  }
  else if($type=='kyc')
  {
    if($value==0)
    {
      $html = '<label class="badge badge-info">New</label>';
    }
    else if($value==2)
    {
      $html = '<label class="badge badge-danger">Rejected</label>';
    }
    else if($value==3)
    {
      $html = '<label class="badge badge-success">Accepted</label>';
    }
    else if($value==4)
    {
      $html = '<label class="badge badge-danger">Expired</label>';
    }
  }
  else if($type=='providerkyc')
  {
    if($value==0)
    {
      $html = '<label class="badge badge-info">Not Uploaded</label>';
    }
    if($value==1)
    {
      $html = '<label class="badge badge-info">Under Review</label>';
    }
    else if($value==2)
    {
      $html = '<label class="badge badge-danger">Rejected</label>';
    }
    else if($value==3)
    {
      $html = '<label class="badge badge-success">Accepted</label>';
    }
    else if($value==4)
    {
      $html = '<label class="badge badge-danger">Expired</label>';
    }
    else if($value==5)
    {
      $html = '<label class="badge badge-danger">Uploaded</label>';
    }
  }
  else if($type=='yes_no')
  {
    if($value==0)
    {
      $html = '<label class="badge bg-danger">No</label>';
    }
    else if($value==1)
    {
      $html = '<label class="badge bg-success">Yes</label>';      
    }
  }
  return $html;
}



function is_logged_in()
{
    $ci =& get_instance();
    $role = $ci->session->userdata("role");
    $id = $ci->session->userdata("id");
    if(empty($id))
      redirect(base_url('admin'));
}

function setting()
{
    $ci =& get_instance();
    $setting = $ci->db->get_where("setting",array("id"=>1,))->result_object();
    if(!empty($setting))
      $setting = $setting[0];
    return $setting;
}

function is_admin_logged_in()
{
  $ci =& get_instance();
    $role = $ci->session->userdata("role");
    $id = $ci->session->userdata("id");
    $password = $ci->session->userdata('password');
    $user = $ci->db->get_where("admin",array("id"=>$id,))->result_object();
    if(empty($user))
    {
      $ci->session->unset_userdata('username');
      $ci->session->unset_userdata('role');
      $ci->session->unset_userdata('id');
      redirect(base_url('admin'));
    }
    else
    {
      $user = $user[0];
      if($password!=$user->password)
      {
        $ci->session->unset_userdata('username');
        $ci->session->unset_userdata('role');
        $ci->session->unset_userdata('id');
        redirect(base_url('admin'));
      }
    }
    if(empty($id))
      redirect(base_url('admin'));
    // else if($role!=1)
    //   redirect(base_url('vendor/dashboard'));
}

function file_size_convert($value)
{
  return $value;
}


function get_user()
{
  $ci =& get_instance();
  $role = $ci->session->userdata("role");
  $userss = $ci->session->userdata("user");
  $id = $ci->session->userdata("id");
  // if($role==2 && !empty($userss))
  if(!empty($userss))
  {
    $id = $ci->session->userdata("user")['id'];
    $role = $ci->session->userdata("user")['role'];
  }
  if($role==1)
  {
    $table_name = "admin";
    $where = array("id"=>$id,);
  }
  else
  {
    $table_name = "users";
    $where = array("id"=>$id,);
  }

  $user = $ci->db->get_where($table_name,$where)->result_object();
  if(!empty($user))
  {
    $user = $user[0];
    if($role==1)
    {
      $data['image'] = base_url('upload/').$user->files;
    }
    else
    {
      $data['image'] = base_url('upload/').$user->profile_image;
    }
    $data['full_detail'] = $user;
    return $data;
  }
  else
    return FALSE;
}

function user_id($user_id)
{
  $ci =& get_instance();
  if(empty($user_id))
  {
    $user_id = $ci->session->userdata("id");
  }
  return $user_id;
}

function create_importent_columns($table_name)
{
    $ci =& get_instance();
    if (!$ci->db->field_exists('add_date_time', $table_name))
      $ci->db->query("ALTER TABLE $table_name ADD add_date_time datetime DEFAULT NULL");
    if (!$ci->db->field_exists('update_date_time', $table_name))
      $ci->db->query("ALTER TABLE $table_name ADD update_date_time datetime DEFAULT NULL");
    if (!$ci->db->field_exists('update_history', $table_name))
      $ci->db->query("ALTER TABLE $table_name ADD update_history text DEFAULT NULL");
    if (!$ci->db->field_exists('slug', $table_name))
      $ci->db->query("ALTER TABLE $table_name ADD slug text DEFAULT NULL");
    if (!$ci->db->field_exists('is_delete', $table_name))
      $ci->db->query("ALTER TABLE $table_name ADD is_delete int(2) DEFAULT NULL");
    if (!$ci->db->field_exists('status', $table_name))
      $ci->db->query("ALTER TABLE $table_name ADD status int(2) DEFAULT NULL");
}



function check_column_and_ceate($column_name,$table_name)
{
  $ci =& get_instance();
  if (!$ci->db->field_exists($column_name, $table_name))
      $ci->db->query("ALTER TABLE $table_name ADD $column_name text DEFAULT NULL");
}



function randID() { 
  $length = 10;
    $vowels = 'AEUY'; 
    $consonants = '0123456789BCDFddadADDASAFS786GHJKLMNPQRSTVWXZ'; 
    $idnumber = ''; 
    $alt = time() % 2; 
    for ($i = 0;$i < $length;$i++) { 
        if ($alt == 1) { 
            $idnumber.= $consonants[(rand() % strlen($consonants)) ]; 
            $alt = 0; 
        } else { 
            $idnumber.= $vowels[(rand() % strlen($vowels)) ]; 
            $alt = 1; 
        } 
    }     
    return $idnumber; 
} 

function currency_simble()
{
  return '₹';
}

function price_formate($price)
{
  return currency_simble().' '.number_format($price,2);
}
function rating_amount($rating)
{ 
  return $rating;
}
function rating_amount_total($rating)
{ 
  return $rating;
}
function rating_count($user_id)
{ 
  return 5;
}


function rating_html($rating)
{
  return '<i class="fa fa-star"></i>';
}

function yes_no($check_value,$type='')
{
  $html = '';
  $arr = array("2"=>"No","1"=>"Yes",);
  if(empty($type))
  {
    foreach ($arr as $key => $value) {
      $selected = ''; 
      if($check_value==$key) $selected = 'selected';
      $html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }
  }
  else
  {
    if(!empty($arr[$check_value]))
    {
      if($check_value==2)
        $html = '<span class="btn btn-danger">'.$arr[$check_value].'</span>';
      if($check_value==1)
        $html = '<span class="btn btn-success">'.$arr[$check_value].'</span>';
    }
    else
    {
      $html = 'Not Selected';
    }
  }
  return $html;
}


function years($value='')
{
    $arr = array('2023','2024');
    return $arr;
}

function game_card_category($value='')
{
    $arr = array(
      "1"=>'Bid of digit',
      "2"=>'Bid of panna',
      "3"=>'Bid of Sangam',
      "4"=>'Bid of motor',
    );
    if(empty($value))
      return $arr;
    return $arr[$value];
}

function Yes_no_array($value='')
{
    $arr = array(
      "2"=>'No',
      "1"=>'Yes',
    );
    if(empty($value))
      return $arr;
    return $arr[$value];
}

function date_range_type($value='')
{
    $arr = array(
      "1"=>'No',
      "2"=>'Custom Date',
      "3"=>'DOB',
    );
    if(empty($value))
      return $arr;
    return $arr[$value];
}

function months($value='')
{
    $arr = array(
      "01"=>'January',
      "02"=>'February',
      "03"=>'March',
      "04"=>'April',
      "05"=>'May',
      "06"=>'June',
      "07"=>'July',
      "08"=>'August',
      "09"=>'September',
      "10"=>'October',
      "11"=>'November',
      "12"=>'December',
    );
    if(empty($value))
      return $arr;
    return $arr[$value];
}
function days($value='')
{
    $arr = array(
      "1"=>'Monday',
      "2"=>'Tuesday',
      "3"=>'Wednesday',
      "4"=>'Thursday',
      "5"=>'Friday',
      "6"=>'Saturday',
      "7"=>'Sunday',
    );
    if(empty($value))
      return $arr;
    return $arr[$value];
}
function days_string_int($value='')
{
    $arr = array(
      "Monday"=>'1',
      "Tuesday"=>'2',
      "Wednesday"=>'3',
      "Thursday"=>'4',
      "Friday"=>'5',
      "Saturday"=>'6',
      "Sunday"=>'7',
    );
    if(empty($value))
      return $arr;
    return $arr[$value];
}

function select_type($value='')
{
    $arr = array(
      "2"=>'0-9',
      "3"=>'Select Digit',
      "4"=>'Open Ank & Close Pana',
      "5"=>'Open Panna & Close Panna',
      "1"=>'Number',
    );
    if(empty($value))
    {
      return $arr;
    }
    {
      return $arr[$value];
    }
}
function pay_type($value='')
{
    $arr = array(
      "1"=>'G Pay',
      "2"=>'PhonePe',
      "3"=>'PayTm',
    );
    if(empty($value))
    {
      return $arr;
    }
    {
      return $arr[$value];
    }
}






function list_image($json_image)
{
  $html = '';
  $display_image = 'default.jpg';
  if(!empty($json_image))
    if(json_decode($json_image))
       if(file_exists(FCPATH.'upload/'.json_decode($json_image)[0]->image_path))
          $display_image = json_decode($json_image)[0]->image_path;
  return  $html = '
          <img src="'.base_url('upload/'.$display_image).'" class="rounded service-img mr-1" style="width: 100px;height: 100px;">
    ';
}

function contact_details()
{
    $ci =& get_instance();
    $result_data = array();
    $data = $ci->db->select("header_emails,header_mobiles,header_address,footer_emails,footer_mobiles,footer_address,contact_emails,contact_mobiles,contact_address")->get_where("setting")->result_object();
    if(!empty($data))
    {
      $data = $data[0];
      $header_emails_data = [];
      $header_emails_array = [];
      $header_emails = [];
      if(!empty($data->header_emails))
      {
        $header_emails = json_decode($data->header_emails);
        if(empty($header_emails->header_emails_value[0]))
           $header_emails = [];
        else
         $header_emails_array = $header_emails->header_emails_title;
      }
      foreach ($header_emails_array as $key => $value)
      {
        $header_emails_data[] = array("title"=>$header_emails->header_emails_title[$key],"value"=>$header_emails->header_emails_value[$key]);
      }
      $header_mobiles_data = [];
      $header_mobiles_array = [];
      $header_mobiles = [];
      if(!empty($data->header_mobiles))
      {
        $header_mobiles = json_decode($data->header_mobiles);
        if(empty($header_mobiles->header_mobiles_value[0]))
           $header_mobiles = [];
        else
         $header_mobiles_array = $header_mobiles->header_mobiles_title;
      }
      foreach ($header_mobiles_array as $key => $value)
      {
        $header_mobiles_data[] = array("title"=>$header_mobiles->header_mobiles_title[$key],"value"=>$header_mobiles->header_mobiles_value[$key]);
      }
      $header_address_data = [];
      $header_address_array = [];
      $header_address = [];
      if(!empty($data->header_address))
      {
        $header_address = json_decode($data->header_address);
        if(empty($header_address->header_address_value[0]))
           $header_address = [];
        else
         $header_address_array = $header_address->header_address_title;
      }
      foreach ($header_address_array as $key => $value)
      {
        $header_address_data[] = array("title"=>$header_address->header_address_title[$key],"value"=>$header_address->header_address_value[$key]);
      }
      $footer_emails_data = [];
      $footer_emails_array = [];
      $footer_emails = [];
      if(!empty($data->footer_emails))
      {
        $footer_emails = json_decode($data->footer_emails);
        if(empty($footer_emails->footer_emails_value[0]))
           $footer_emails = [];
        else
         $footer_emails_array = $footer_emails->footer_emails_title;
      }
      foreach ($footer_emails_array as $key => $value)
      {
        $footer_emails_data[] = array("title"=>$footer_emails->footer_emails_title[$key],"value"=>$footer_emails->footer_emails_value[$key]);
      }
      $footer_mobiles_data = [];
      $footer_mobiles_array = [];
      $footer_mobiles = [];
      if(!empty($data->footer_mobiles))
      {
        $footer_mobiles = json_decode($data->footer_mobiles);
        if(empty($footer_mobiles->footer_mobiles_value[0]))
           $footer_mobiles = [];
        else
         $footer_mobiles_array = $footer_mobiles->footer_mobiles_title;
      }
      foreach ($footer_mobiles_array as $key => $value)
      {
        $footer_mobiles_data[] = array("title"=>$footer_mobiles->footer_mobiles_title[$key],"value"=>$footer_mobiles->footer_mobiles_value[$key]);
      }
      $footer_address_data = [];
      $footer_address_array = [];
      $footer_address = [];
      if(!empty($data->footer_address))
      {
        $footer_address = json_decode($data->footer_address);
        if(empty($footer_address->footer_address_value[0]))
           $footer_address = [];
        else
         $footer_address_array = $footer_address->footer_address_title;
      }
      foreach ($footer_address_array as $key => $value)
      {
        $footer_address_data[] = array("title"=>$footer_address->footer_address_title[$key],"value"=>$footer_address->footer_address_value[$key]);
      }
      $contact_emails_data = [];
      $contact_emails_array = [];
      $contact_emails = [];
      if(!empty($data->contact_emails))
      {
        $contact_emails = json_decode($data->contact_emails);
        if(empty($contact_emails->contact_emails_value[0]))
           $contact_emails = [];
        else
         $contact_emails_array = $contact_emails->contact_emails_title;
      }
      foreach ($contact_emails_array as $key => $value)
      {
        $contact_emails_data[] = array("title"=>$contact_emails->contact_emails_title[$key],"value"=>$contact_emails->contact_emails_value[$key]);
      }
      $contact_mobiles_data = [];
      $contact_mobiles_array = [];
      $contact_mobiles = [];
      if(!empty($data->contact_mobiles))
      {
        $contact_mobiles = json_decode($data->contact_mobiles);
        if(empty($contact_mobiles->contact_mobiles_value[0]))
           $contact_mobiles = [];
        else
         $contact_mobiles_array = $contact_mobiles->contact_mobiles_title;
      }
      foreach ($contact_mobiles_array as $key => $value)
      {
        $contact_mobiles_data[] = array("title"=>$contact_mobiles->contact_mobiles_title[$key],"value"=>$contact_mobiles->contact_mobiles_value[$key]);
      }
      $contact_address_data = [];
      $contact_address_array = [];
      $contact_address = [];
      if(!empty($data->contact_address))
      {
        $contact_address = json_decode($data->contact_address);
        if(empty($contact_address->contact_address_value[0]))
           $contact_address = [];
        else
         $contact_address_array = $contact_address->contact_address_title;
      }
      foreach ($contact_address_array as $key => $value)
      {
        $contact_address_data[] = array("title"=>$contact_address->contact_address_title[$key],"value"=>$contact_address->contact_address_value[$key]);
      }
      $result_data = array(
        "header_data"=>array(
                            "emails"=>$header_emails_data,
                            "mobiles"=>$header_mobiles_data,
                            "address"=>$header_address_data,
                          ),
        "footer_data"=>array(
                            "emails"=>$footer_emails_data,
                            "mobiles"=>$footer_mobiles_data,
                            "address"=>$footer_address_data,
                          ),
        "contact_data"=>array(
                            "emails"=>$contact_emails_data,
                            "mobiles"=>$contact_mobiles_data,
                            "address"=>$contact_address_data,
                          ),
      );
    }
    return $result_data;
}

function get_game_type($value)
{ 
  $status = '';
  if($value==1) $status = 'Open';
  if($value==2) $status = 'Close';
  if($value==3) $status = 'open odd';
  if($value==4) $status = 'open even';
  if($value==5) $status = 'close odd';
  if($value==6) $status = 'close even';
  if($value==7) $status = 'half red backet';
  if($value==8) $status = 'half red backet';
  if($value==9) $status = 'open single panna';
  if($value==10) $status = 'open doubble panna';
  if($value==11) $status = 'open tripple panna';
  if($value==12) $status = 'close single panna';
  if($value==13) $status = 'close doubble panna';
  if($value==14) $status = 'close tripple panna';
  if($value==15) $status = 'open ank close patti';
  if($value==16) $status = 'open patti close ank';
  if(!empty($status)) $status = "_".str_replace(" ", "_", $status);
  return strtoupper($status);
}

function get_game_type2($value,$card_id='')
{ 
  $status = '';
  if($value==1) $status = 'Open';
  if($value==2) $status = 'Close';
  if($value==3) $status = 'open odd';
  if($value==4) $status = 'open even';
  if($value==5) $status = 'close odd';
  if($value==6) $status = 'close even';
  if($value==7) $status = 'half red backet';
  if($value==8) $status = 'half red backet';
  if($value==9) $status = 'open single panna';
  if($value==10) $status = 'open doubble panna';
  if($value==11) $status = 'open tripple panna';
  if($value==12) $status = 'close single panna';
  if($value==13) $status = 'close doubble panna';
  if($value==14) $status = 'close tripple panna';
  if($value==15) $status = 'open ank close patti';
  if($value==16) $status = 'open patti close ank';
  
  if($card_id==3)$status = 'Jodi';
  
  if(!empty($status)) $status = "_".str_replace(" ", "_", $status);
  return strtoupper($status);
}


function single_bid_digits()
{
  $arr = array(
    "0",
    "1",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "9",
  );
  return $arr;
}
function odd_digits()
{
  $arr = array(
    "1",
    "3",
    "5",
    "7",
    "9",
  );
  return $arr;
}
function even_digits()
{
  $arr = array(
    "2",
    "4",
    "6",
    "8",
    "10",
  );
  return $arr;
}


function full_red_bracket()
{
  $arr = array(
    "00",
    "11",
    "22",
    "33",
    "44",
    "55",
    "66",
    "77",
    "88",
    "99",
  );
  return $arr;
}
function half_red_bracket()
{
  $arr = array(
    "05",
    "16",
    "27",
    "38",
    "49",
    "50",
    "61",
    "72",
    "83",
    "94",
  );
  return $arr;
}

function single_panna_digits()
{
  $arr = array(
    127, 136, 145, 190, 235, 280, 370, 389, 460, 479, 569, 578,
    128, 137, 146, 236, 245, 290, 380, 470, 489, 560, 579, 678,
    129, 138, 147, 156, 237, 246, 345, 390, 480, 570, 589, 679,
    120, 139, 148, 157, 238, 247, 256, 346, 490, 580, 670, 689,
    130, 149, 158, 167, 239, 248, 257, 347, 356, 590, 680, 789,
    140, 159, 168, 230, 249, 258, 267, 348, 357, 456, 690, 780,
    123, 150, 169, 178, 240, 259, 268, 349, 358, 367, 457, 790,
    124, 160, 278, 179, 250, 269, 340, 359, 368, 458, 467, 890,
    125, 134, 170, 189, 260, 279, 350, 369, 468, 378, 459, 567,
    126, 135, 180, 234, 270, 289, 360, 379, 450, 469, 478, 568,
  );
  return $arr;
}
function double_panna_digits()
{
  $arr = array(
    118, 226, 244, 299, 334, 488, 550, 668, 677,
    100, 119, 155, 227, 335, 344, 399, 588, 669,
    110, 200, 228, 255, 366, 499, 660, 688, 778,
    166, 229, 300, 337, 355, 445, 599, 779, 788,
    112, 220, 266, 338, 400, 446, 455, 699, 770,
    113, 122, 177, 339, 366, 447, 500, 799, 889,
    600, 114, 277, 330, 448, 466, 556, 880, 899,
    115, 133, 188, 223, 377, 449, 557, 566, 700,
    116, 224, 233, 288, 440, 477, 558, 800, 990,
    117, 144, 199, 225, 388, 559, 577, 667, 900,
  );
  return $arr;
}
function tripple_panna_digits()
{
  $arr = array(
    '000',
    777,
    444,
    111,
    888,
    555,
    222,
    999,
    666,
    333,
  );
  return $arr;
}

function sp_dp_tp_panna()
{
  return array_merge(single_panna_digits(),double_panna_digits(),tripple_panna_digits());
}

function jodi_digits()
{
  $arr = array(
    '00',
    '01', 10, 19, 28, 37, 46, 55, 64, 73, 82, 91,
    '02', 11, 20, 29, 38, 47, 56, 65, 74, 83, 92,
    '03', 12, 21, 30, 39, 48, 57, 66, 75, 84, 93,
    '04', 13, 22, 31, 40, 49, 58, 67, 76, 85, 94,
    '05', 14, 23, 32, 41, 50, 59, 68, 77, 86, 95,
    '06', 15, 24, 33, 42, 51, 60, 69, 78, 87, 96,
    '07', 16, 25, 34, 43, 52, 61, 70, 79, 88, 97,
    '08', 17, 26, 35, 44, 53, 62, 71, 80, 87, 98,
    '09', 18, 27, 36, 45, 54, 63, 72, 81, 88, 99,
  );
  return $arr;
}
function half_sangam_patti()
{
  $arr = array('000',100,111,112,113,114,115,116,117,118,119,120,122,123,124,125,126,127,128,129,130,133,134,135,136,137,138,139,140,144,145,146,147,148,149,150,155,156,157,158,159,160,166,167,168,169,170,177,178,179,180,188,189,190,199,200,220,222,223,224,225,226,227,228,229,230,233,234,235,236,237,238,239,240,244,245,246,247,248,249,250,255,256,257,258,259,260,266,267,268,269,270,277,278,279,280,288,289,290,291,292,293,294,295,296,297,298,299,300,330,333,334,335,336,337,338,339,340,344,345,346,347,348,349,350,355,356,357,358,359,360,366,367,368,369,370,377,378,379,380,388,389,390,399,400,440,444,445,446,447,448,449,450,455,456,457,458,459,460,466,467,468,469,470,477,478,479,480,488,489,490,499,500,550,555,556,557,558,559,560,566,567,568,569,570,577,578,579,580,588,589,590,591,592,593,594,595,596,597,598,599,600,660,666,667,668,669,670,677,678,679,680,681,682,683,684,685,686,687,688,689,690,699,700,770,777,778,779,780,799,800,880,899,900,990,999);
    return $arr;
}
function full_sangam_open_patti()
{
  return array('000',100,110,111,112,113,114,115,116,117,118,119,120,122,123,124,125,126,127,128,129,130,133,134,135,136,137,138,139,140,144,145,146,147,148,149,150,155,156,157,158,159,160,166,167,168,169,170,177,178,179,180,188,189,190,199,200,220,222,223,224,225,226,227,228,229,230,233,234,235,236,237,238,239,240,244,245,246,247,248,249,250,255,256,257,258,259,260,266,267,268,269,270,277,278,279,280,288,289,290,299,300,330,333,334,335,336,337,338,339,340,344,345,346,347,348,349,350,355,356,357,358,359,360,366,367,368,369,370,377,378,379,380,388,389,390,400,440,444,445,446,447,448,449,450,455,456,457,458,459,460,466,467,468,469,470,477,478,479,480,488,489,490,499,500,550,555,556,557,558,559,560,566,567,568,569,570,577,578,579,580,588,589,590,599,600,660,666,667,668,669,670,677,678,679,680,688,689,690,699,700,770,777,778,779,780,799,800,880,888,889,890,899,900,990,999);
}
function full_sangam_close_patti()
{
  return array('000',100,110,111,112,113,114,115,116,117,118,119,120,122,123,124,125,126,127,128,129,130,133,134,135,136,137,138,139,140,144,145,146,147,148,149,150,155,156,157,158,159,160,166,167,168,169,170,177,178,179,180,188,189,190,199,200,220,222,223,224,225,226,227,228,229,230,233,234,235,236,237,238,239,240,244,245,246,247,248,249,250,255,256,257,258,259,260,266,267,268,269,270,277,278,279,280,288,289,290,299,300,330,333,334,335,336,337,338,339,340,344,345,346,347,348,349,350,355,356,357,358,359,360,366,367,368,369,370,377,378,379,380,388,389,390,399,400,440,444,445,446,447,448,449,450,455,456,457,458,459,460,466,467,468,469,470,477,478,479,480,488,489,490,499,500,550,555,556,557,558,559,560,566,567,568,569,570,577,578,579,580,588,589,590,599,600,660,666,667,668,669,670,677,678,679,680,688,689,690,699,700,770,777,778,779,780,788,789,790,799,800,880,888,889,890,899,900,990,999);
}

function get_win_amount($card_id,$amount)
{
    $ci =& get_instance();
    $card = $ci->db
    ->select("win_price,win_amount_start")
    ->get_where("card",array("id"=>$card_id,))->result_object()[0];
    $win_amount_start = $card->win_amount_start;
    $win_amount = $card->win_price;
    return $r_one_amount = ($win_amount/$win_amount_start)*$amount;
}



?>