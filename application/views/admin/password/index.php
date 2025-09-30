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
      <div class="row">
         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title"><?=$page_title ?>
                  </h3>
               </div>
               <div class="card-body">                             
                 
                    <form class="form_data row" autocomplete="off" method="post" enctype="multipart/form-data" action="<?=base_url($submit_url) ?>" id="form1" novalidate >

                      <div class="form-group col-xl-12">
                          <label>Old Password *</label>
                          <input class="form-control" type="text" required placeholder="Old Password" value="" name="old_password" />
                      </div>
                      <div class="form-group col-xl-12">
                          <label>Password *</label>
                          <input class="form-control" type="text" required placeholder="Password" value="" name="new_password" />
                      </div>
                      <div class="form-group col-xl-12">
                          <label>Confirm Password *</label>
                          <input class="form-control" type="text" required placeholder="Confirm Password" value="" name="confirm_password" />
                      </div>

                      <div class="col-md-12">
                          <button class="btn btn-primary" type="submit">Save</button>
                          <a href="<?=base_url($back_btn) ?>" class="btn btn-link">Cancel</a>
                      </div>
                    </form>                             
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
            








