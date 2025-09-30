<?php
$setting = setting();
$role = $this->session->userdata("role");
if(!empty($row))
$row = $row[0];
$profile_image = "user.png";
$mobile = '';
if(!empty($row))
{
    if($role==1)
    {
        $profile_image = $row->files;
        $mobile = $row->phone;
    }
    else if($role==2 || $role==3)
    {
        $profile_image = $row->profile_image;
        $mobile = $row->mobile;
    }
}
?>
<section class="content">
   <div class="container-fluid">
      
      <form class="row form_data" method="post" enctype="multipart/form-data" action="<?=base_url($submit_url) ?>" id="form1" novalidate>




         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Main Setting</h3>
               </div>
               <div class="card-body row">
                  
                  <div class="col-md-6 form-group">
                     <label>Signup Reward</label>
                     <input type="number" name="signup_reward" value="<?php if(!empty($setting))echo $setting->signup_reward ?>" class="form-control" required />
                  </div>
                  <div class="col-md-3 form-group">
                     <label>Signup Reward Status</label>
                     <select name="signup_reward_status" class="form-control select2">
                        <option value="1" <?php if($setting->signup_reward_status==1)echo 'selected'; ?> >Yes</option>
                        <option value="0" <?php if($setting->signup_reward_status==0)echo 'selected'; ?> >No</option>
                     </select>
                  </div>

                  <div class="col-md-3 form-group">
                     <label>Diposit Reward Status</label>
                     <select name="diposit_reward_status" class="form-control select2">
                        <option value="1" <?php if($setting->diposit_reward_status==1)echo 'selected'; ?> >Yes</option>
                        <option value="0" <?php if($setting->diposit_reward_status==0)echo 'selected'; ?> >No</option>
                     </select>
                  </div>





                  <div class="col-md-12">

                   <?php
                        $main_max_deposit_array = [''];
                        $main_max_deposit = [''];
                        $reward_amount = $this->db->get_where("reward_amount")->result_object();
                        if(!empty($reward_amount))
                        {
                           $main_max_deposit_array = $reward_amount;
                        }
                        $i = 0;
                        foreach ($main_max_deposit_array as $key => $value)
                        {
                           $this->load->view("admin/setting/main_max_deposit",array("main_max_deposit"=>$value,"i"=>$i,));
                           $i++;
                        }
                     ?>
                     <div class="add-more-before-main_max_deposit"></div>
                     <div class="col-md-2" style="margin: 0 auto;">
                        <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-main_max_deposit" data-url="<?=base_url('admin/'.$controller_name.'/main_max_deposit') ?>">Add More</button>
                     </div>
                  </div>
                    












                  





                  
                  
                  <div class="col-md-4 form-group">
                     <label>Minimum Deposit</label>
                     <input type="number" name="min_deposit" value="<?php if(!empty($setting))echo $setting->min_deposit ?>" class="form-control" required />
                  </div>
                  <div class="col-md-4 form-group">
                     <label>Minimum Withdraw</label>
                     <input type="number" name="min_withdraw" value="<?php if(!empty($setting))echo $setting->min_withdraw ?>" class="form-control" required />
                  </div>









                  <div class="col-md-6 form-group" style="display:none;">
                     <label>OTP Demo mobile number</label>
                     <input type="number" name="demo_number" value="<?php if(!empty($setting))echo $setting->demo_number ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Paytm UPI Address</label>
                     <input type="text" name="upi" value="<?php if(!empty($setting))echo $setting->upi ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none;">
                     <label>RazorPay Key</label>
                     <input type="text" name="rz_key" value="<?php if(!empty($setting))echo $setting->rz_key ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Paytm UPI MCC</label>
                     <input type="number" name="merchant" value="<?php if(!empty($setting))echo $setting->merchant ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>PhonePe UPI Address</label>
                     <input type="text" name="upi_2" value="<?php if(!empty($setting))echo $setting->upi_2 ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>PhonePe UPI MCC</label>
                     <input type="number" name="merchant_2" value="<?php if(!empty($setting))echo $setting->merchant_2 ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>GPAY UPI Address</label>
                     <input type="text" name="upi_3" value="<?php if(!empty($setting))echo $setting->upi_3 ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>GPAY UPI MCC</label>
                     <input type="number" name="merchant_3" value="<?php if(!empty($setting))echo $setting->merchant_3 ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Whatsapp Support</label>
                     <select name="whatsapp_active" class="form-control select2">
                        <option value="1" <?php if($setting->whatsapp_active==1)echo 'selected'; ?> >ON</option>
                        <option value="0" <?php if($setting->whatsapp_active==0)echo 'selected'; ?> >OFF</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Payment Gateway</label>
                     <select name="rz_setting" class="form-control select2">
                        <option value="1" <?php if($setting->rz_setting==1)echo 'selected'; ?> >RazorPay</option>
                        <option value="0" <?php if($setting->rz_setting==0)echo 'selected'; ?> >UPI</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none;">
                     <label>Spin Game</label>
                     <select name="spin_game" class="form-control select2">
                        <option value="1" <?php if($setting->spin_game==1)echo 'selected'; ?> >Yes</option>
                        <option value="0" <?php if($setting->spin_game==0)echo 'selected'; ?> >No</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Reward Game</label>
                     <select name="dice_game" class="form-control select2">
                        <option value="1" <?php if($setting->dice_game==1)echo 'selected'; ?> >Yes</option>
                        <option value="0" <?php if($setting->dice_game==0)echo 'selected'; ?> >No</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Number Game</label>
                     <select name="number_game" class="form-control select2">
                        <option value="1" <?php if($setting->number_game==1)echo 'selected'; ?> >Yes</option>
                        <option value="0" <?php if($setting->number_game==0)echo 'selected'; ?>  >No</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Whatsapp</label>
                     <input type="number" name="whatsapp" value="<?php if(!empty($setting))echo $setting->whatsapp ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none" >
                     <label>Withdraw Open Time</label>
                     <input type="time" name="withdrawOpenTime" value="<?php if(!empty($setting))echo $setting->withdrawOpenTime ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Withdraw Close Time</label>
                     <input type="time" name="withdrawCloseTime" value="<?php if(!empty($setting))echo $setting->withdrawCloseTime ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>Auto verify</label>
                     <select name="auto_verify" class="form-control select2">
                        <option value="1" <?php if($setting->auto_verify==1)echo 'selected'; ?> >ON</option>
                        <option value="0" <?php if($setting->auto_verify==0)echo 'selected'; ?>  >OFF</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group"  style="display:none;">
                     <label>Chat Support</label>
                     <select name="chat_support" class="form-control select2">
                        <option value="1" <?php if($setting->chat_support==1)echo 'selected'; ?> >ON</option>
                        <option value="0" <?php if($setting->chat_support==0)echo 'selected'; ?>  >OFF</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none">
                     <label>UPI Manual verify</label>
                     <select name="verify_upi_payment" class="form-control select2">
                        <option value="1" <?php if($setting->verify_upi_payment==1)echo 'selected'; ?> >ON</option>
                        <option value="0" <?php if($setting->verify_upi_payment==0)echo 'selected'; ?>  >OFF</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none;">
                     <label>Telegram</label>
                     <select name="telegram" class="form-control select2">
                        <option value="1" <?php if($setting->telegram==1)echo 'selected'; ?>  >ON</option>
                        <option value="0" <?php if($setting->telegram==0)echo 'selected'; ?> >OFF</option>
                     </select>
                  </div>
                  <div class="col-md-6 form-group" style="display:none;">
                     <label>Telegram link</label>
                     <input type="text" name="telegram_details" value="<?php if(!empty($setting))echo $setting->telegram_details ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none;">
                     <label>Chat Welcome Message</label>
                     <input type="text" name="welcome_msg" value="<?php if(!empty($setting))echo $setting->welcome_msg ?>" class="form-control" required />
                  </div>
                  <div class="col-md-6 form-group" style="display:none;">
                     <label>HomeScreen Marquee Text</label>
                     <input type="text" name="home_line" value="<?php if(!empty($setting))echo $setting->home_line ?>" class="form-control" required />
                  </div>

               </div>
            </div>
         </div>


         <div class="col-12" style="display:none;">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">How to play</h3>
               </div>
               <div class="card-body">
                  <label>How to play</label>
                  <textarea class="form-control" name="how_to_play"><?=$setting->how_to_play ?></textarea>
               </div>
            </div>
         </div>



         <div class="col-12" style="display:none;">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Inquiry mails</h3>
               </div>
               <div class="card-body">
                        <fieldset class="row">                           
                           <div class="mb-3 col-md-6">
                              <label class="form-label">Main Mails</label>
                              <select class="form-control tags" multiple name="main_mail[]">
                                 <?php 
                                 if(!empty($setting))
                                    if(!empty($setting->main_mail))
                                       foreach (explode("||", $setting->main_mail) as $key => $value)
                                          echo '<option selected>'.$value.'</option>';
                                 ?>
                              </select>
                           </div>

                           <div class="mb-3 col-md-6">
                              <label class="form-label">CC Mails </label>
                              <select class="form-control tags" multiple name="cc_mail[]">
                                 <?php 
                                 if(!empty($setting))
                                    if(!empty($setting->cc_mail))
                                       foreach (explode("||", $setting->cc_mail) as $key => $value)
                                          echo '<option selected>'.$value.'</option>';
                                 ?>
                              </select>
                           </div>
                           <div class="mb-3 col-md-12">
                              <label class="form-label">BCC Mails</label>
                              <select class="form-control tags" multiple name="bcc_mail[]">
                                 <?php 
                                 if(!empty($setting))
                                    if(!empty($setting->bcc_mail))
                                       foreach (explode("||", $setting->bcc_mail) as $key => $value)
                                          echo '<option selected>'.$value.'</option>';
                                 ?>
                              </select>
                              
                           </div>
                        </fieldset>
                  </div>
            </div>
         </div>

         <div class="col-12" style="display:none;">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Mail Setting</h3>
               </div>
               <div class="card-body">
                        <fieldset class="row">
                           
                           <div class="mb-3 col-md-4">
                              <label class="form-label">Inquiry mail</label>
                              <select class="form-control select2" name="inquiry_mail" required>
                                 <option value="1" <?php if($setting->inquiry_mail==1)echo 'selected' ?> >Yes</option>
                                 <option value="2" <?php if($setting->inquiry_mail==2)echo 'selected' ?> >No</option>
                              </select>
                           </div>

                           <div class="mb-3 col-md-4">
                              <label class="form-label">Mail Type</label>
                              <select class="form-control select2" name="mail_type" required>
                                 <option value="1" <?php if($setting->mail_type==1)echo 'selected' ?> >WebMail</option>
                                 <option value="2" <?php if($setting->mail_type==2)echo 'selected' ?> >Gmail</option>
                                 <option value="3" <?php if($setting->mail_type==3)echo 'selected' ?> >Hostinger</option>
                              </select>
                           </div>

                           <div class="mb-3 col-md-4">
                              <label class="form-label">Mail Host </label>
                              <input type="text" name="mailhost" class="form-control" required value="<?=$setting->mailhost ?>">
                           </div>

                           <div class="mb-3 col-md-6">
                              <label class="form-label">Mail Username </label>
                              <input type="text" name="mailusername" class="form-control" required value="<?=$setting->mailusername ?>">
                           </div>

                           <div class="mb-3 col-md-6">
                              <label class="form-label">Mail Password </label>
                              <input type="text" name="mailpassword" class="form-control" required value="<?=$setting->mailpassword ?>">
                           </div>


                           <div class="mb-3 col-md-12">
                              <a href="<?=base_url(panel.'/profile/test_mail') ?>" class="btn btn-primary test-mail" style="margin: 0 auto;width: fit-content;display: block;">Send Test Mail</a>
                           </div>
                           
                        </fieldset>
                  </div>
            </div>
         </div>


         <div class="col-md-6" style="display:none">
            <div class="card panel panel-inverse" data-sortable-id="form-stuff-20">
               <div class="panel-heading ">
                  <h4 class="panel-title card-primary">Logo</h4>
               </div>
               <div class="card-body">
                     <fieldset>
                       <div class="col-lg-12 col-12 form-group">
                         <?php 
                             $file_data = array(
                                 "position"=>1,
                                 "columna_name"=>"logo",
                                 "multiple"=>false,
                                 "accept"=>'image/*',
                                 "col"=>"col-md-12",
                                 "alt_text"=>"none",
                                 "row"=>$setting,
                             );
                             $this->load->view('upload-multiple/index',$file_data);
                         ?>                                    
                     </div>
                     </fieldset>
               </div>
            </div>
         </div>
         <div class="col-md-6" style="display: none;">
            <div class="card panel panel-inverse" data-sortable-id="form-stuff-21">
               <div class="panel-heading">
                  <h4 class="panel-title">Favicon</h4>
               </div>
               <div class="card-body panel-body">
                     <fieldset>
                       <div class="col-lg-12 col-12 form-group">
                         <?php 
                             $file_data = array(
                                 "position"=>2,
                                 "columna_name"=>"favicon",
                                 "multiple"=>false,
                                 "accept"=>'image/*',
                                 "col"=>"col-md-12",
                                 "alt_text"=>"none",
                                 "row"=>$setting,
                             );
                             $this->load->view('upload-multiple/index',$file_data);
                         ?>
                     </div>
                     </fieldset>
               </div>
            </div>
         </div>



         <div class="col-12" style="display: none;">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Header</h3>
               </div>
               <div class="card-body">
                     <?php
                        $header_emails_array = [''];
                        $header_emails = [''];
                        if(!empty($setting->header_emails))
                        {
                           $header_emails = json_decode($setting->header_emails);
                           if(empty($header_emails->header_emails_value[0]))
                              $header_emails = [''];
                           else
                              $header_emails_array = $header_emails->header_emails_title;

                        }
                        $i = 0;
                        foreach ($header_emails_array as $key => $value)
                        {
                           $this->load->view("admin/setting/header_emails",array("header_emails"=>$header_emails,"i"=>$i,));
                           $i++;
                        }
                     ?>
                     <div class="add-more-before-header_emails"></div>
                     <div class="col-md-2" style="margin: 0 auto;">
                        <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-header_emails" data-url="<?=base_url('admin/'.$controller_name.'/header_emails') ?>">Add More</button>
                     </div>
                     <?php
                        $header_mobiles_array = [''];
                        $header_mobiles = [''];
                        if(!empty($setting->header_mobiles))
                        {
                           $header_mobiles = json_decode($setting->header_mobiles);
                           if(empty($header_mobiles->header_mobiles_value[0]))
                              $header_mobiles = [''];
                           else
                              $header_mobiles_array = $header_mobiles->header_mobiles_title;
                        }
                        $i = 0;
                        foreach ($header_mobiles_array as $key => $value)
                        {
                           $this->load->view("admin/setting/header_mobiles",array("header_mobiles"=>$header_mobiles,"i"=>$i,));
                           $i++;
                        }
                     ?>
                     <div class="add-more-before-header_mobiles"></div>
                     <div class="col-md-2" style="margin: 0 auto;">
                        <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-header_mobiles" data-url="<?=base_url('admin/'.$controller_name.'/header_mobiles') ?>">Add More</button>
                     </div>
                     <?php
                        $header_address_array = [''];
                        $header_address = [''];
                        if(!empty($setting->header_address))
                        {
                           $header_address = json_decode($setting->header_address);
                           if(empty($header_address->header_address_value[0]))
                              $header_address = [''];
                           else
                              $header_address_array = $header_address->header_address_title;

                        }
                        $i = 0;
                        foreach ($header_address_array as $key => $value)
                        {
                           $this->load->view("admin/setting/header_address",array("header_address"=>$header_address,"i"=>$i,));
                           $i++;
                        }
                     ?>
                     <div class="add-more-before-header_address"></div>
                     <div class="col-md-2" style="margin: 0 auto;">
                        <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-header_address" data-url="<?=base_url('admin/'.$controller_name.'/header_address') ?>">Add More</button>
                     </div>
               </div>
            </div>
         </div>


         <div class="col-12"  style="display: none;">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Footer</h3>
               </div>
               <div class="card-body">
                  <?php
                     $footer_emails_array = [''];
                     $footer_emails = [''];
                     if(!empty($setting->footer_emails))
                     {
                        $footer_emails = json_decode($setting->footer_emails);
                        if(empty($footer_emails->footer_emails_value[0]))
                           $footer_emails = [''];
                        else
                           $footer_emails_array = $footer_emails->footer_emails_title;
                     }
                     $i = 0;
                     foreach ($footer_emails_array as $key => $value)
                     {
                        $this->load->view("admin/setting/footer_emails",array("footer_emails"=>$footer_emails,"i"=>$i,));
                        $i++;
                     }
                  ?>
                  <div class="add-more-before-footer_emails"></div>
                  <div class="col-md-2" style="margin: 0 auto;">
                     <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-footer_emails" data-url="<?=base_url('admin/'.$controller_name.'/footer_emails') ?>">Add More</button>
                  </div>
                  <?php
                     $footer_mobiles_array = [''];
                     $footer_mobiles = [''];
                     if(!empty($setting->footer_mobiles))
                     {
                        $footer_mobiles = json_decode($setting->footer_mobiles);
                        if(empty($footer_mobiles->footer_mobiles_value[0]))
                           $footer_mobiles = [''];
                        else
                           $footer_mobiles_array = $footer_mobiles->footer_mobiles_title;
                     }
                     $i = 0;
                     foreach ($footer_mobiles_array as $key => $value)
                     {
                        $this->load->view("admin/setting/footer_mobiles",array("footer_mobiles"=>$footer_mobiles,"i"=>$i,));
                        $i++;
                     }
                  ?>
                  <div class="add-more-before-footer_mobiles"></div>
                  <div class="col-md-2" style="margin: 0 auto;">
                     <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-footer_mobiles" data-url="<?=base_url('admin/'.$controller_name.'/footer_mobiles') ?>">Add More</button>
                  </div>
                  <?php
                     $footer_address_array = [''];
                     $footer_address = [''];
                     if(!empty($setting->footer_address))
                     {
                        $footer_address = json_decode($setting->footer_address);
                        if(empty($footer_address->footer_address_value[0]))
                           $footer_address = [''];
                        else
                           $footer_address_array = $footer_address->footer_address_title;

                     }
                     $i = 0;
                     foreach ($footer_address_array as $key => $value)
                     {
                        $this->load->view("admin/setting/footer_address",array("footer_address"=>$footer_address,"i"=>$i,));
                        $i++;
                     }
                  ?>
                  <div class="add-more-before-footer_address"></div>
                  <div class="col-md-2" style="margin: 0 auto;">
                     <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-footer_address" data-url="<?=base_url('admin/'.$controller_name.'/footer_address') ?>">Add More</button>
                  </div>
                  </div>
            </div>
         </div>


         <div class="col-12"  style="display: none;">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Contact us</h3>
               </div>
               <div class="card-body">
                        <?php
                              $contact_emails_array = [''];
                              $contact_emails = [''];
                              if(!empty($setting->contact_emails))
                              {
                                 $contact_emails = json_decode($setting->contact_emails);
                                 if(empty($contact_emails->contact_emails_value[0]))
                                    $contact_emails = [''];
                                 else
                                    $contact_emails_array = $contact_emails->contact_emails_title;

                              }
                              $i = 0;
                              foreach ($contact_emails_array as $key => $value)
                              {
                                 $this->load->view("admin/setting/contact_emails",array("contact_emails"=>$contact_emails,"i"=>$i,));
                                 $i++;
                              }
                           ?>
                           <div class="add-more-before-contact_emails"></div>
                           <div class="col-md-2" style="margin: 0 auto;">
                              <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-contact_emails" data-url="<?=base_url('admin/'.$controller_name.'/contact_emails') ?>">Add More</button>
                           </div>
                           <?php
                              $contact_mobiles_array = [''];
                              $contact_mobiles = [''];
                              if(!empty($setting->contact_mobiles))
                              {
                                 $contact_mobiles = json_decode($setting->contact_mobiles);
                                 if(empty($contact_mobiles->contact_mobiles_value[0]))
                                    $contact_mobiles = [''];
                                 else
                                    $contact_mobiles_array = $contact_mobiles->contact_mobiles_title;
                              }
                              $i = 0;
                              foreach ($contact_mobiles_array as $key => $value)
                              {
                                 $this->load->view("admin/setting/contact_mobiles",array("contact_mobiles"=>$contact_mobiles,"i"=>$i,));
                                 $i++;
                              }
                           ?>
                           <div class="add-more-before-contact_mobiles"></div>
                           <div class="col-md-2" style="margin: 0 auto;">
                              <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-contact_mobiles" data-url="<?=base_url('admin/'.$controller_name.'/contact_mobiles') ?>">Add More</button>
                           </div>
                           <?php
                              $contact_address_array = [''];
                              $contact_address = [''];
                              if(!empty($setting->contact_address))
                              {
                                 $contact_address = json_decode($setting->contact_address);
                                 if(empty($contact_address->contact_address_value[0]))
                                    $contact_address = [''];
                                 else
                                    $contact_address_array = $contact_address->contact_address_title;

                              }
                              $i = 0;
                              foreach ($contact_address_array as $key => $value)
                              {
                                 $this->load->view("admin/setting/contact_address",array("contact_address"=>$contact_address,"i"=>$i,));
                                 $i++;
                              }
                           ?>
                           <div class="add-more-before-contact_address"></div>
                           <div class="col-md-2" style="margin: 0 auto;">
                              <button type="button" class="btn btn-danger add-more-btn" data-target=".add-more-before-contact_address" data-url="<?=base_url('admin/'.$controller_name.'/contact_address') ?>">Add More</button>
                           </div>
                  </div>
            </div>
         </div>         


         <div class="col-md-12" style="text-align:center;">
            <div class="panel panel-inverse">
               <div class="panel-body p-2">
                     <button type="submit" class="btn btn-primary w-100px me-5px">Save</button>
               </div>
            </div>
         </div>


      </form>
   </div>
</section>
<script>
   $(document).on("click", ".test-mail",(function(e) {
      event.preventDefault();
      $(".loading").addClass("active");
      var url = $(this).attr("href");
      var id = '';
      $.ajax({
          url:url,
          type:"post",
          data:{id:id},
          success:function(d)
          {
              var result = JSON.parse(d);
              if(result.status=='200')
              {
                success_message(result.message);
                $(result.id).remove();
              }
              else if(result.status=='400')
              {
                error_message(result.message);
              }
              else
              {
                error_message(d);
              }
              $(".loading").removeClass("active");  
          },
          error: function(e)
          {
            
          }
      });
   }));
</script>