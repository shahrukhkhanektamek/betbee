<!doctype html>
<html lang="en">
   <head>
      <?php include('include/allcss.php'); ?>
   </head>
   <body class="main-bg main-bg-opac main-bg-blur overflow-hidden">
      
      <main class="flex-shrink-0 pt-0 h-100">
         <div class="container-fluid">
            <div class="auth-wrapper">
               <div class="d-flex flex-column vh-100 pt-ios">
                  
                  <div class="row justify-content-center h-100">
                     <div class="col-12 col-md-6 col-lg-6">
                        <form id="LoginForm1" method="post" action="<?=base_url('api/auth/sign_up') ?>" novalidate class="tf-form front_form_data">

            <input type="hidden" name="type" value="2">
            <input type="hidden" name="device_id" value="<?=$this->session->userdata('device_id') ?>">
            <input type="hidden" name="firebase_token" value="<?=$this->input->get('firebase_token') ?>">

                           <div class="row h-100 align-items-center justify-content-center my-md-3">
                              <div class="col-12 col-md-10 col-lg-8 col-xxl-6 login-box">
                                 <p style="text-align:center;">
                                    <img data-bs-img="dark" src="<?=base_url() ?>assets/logo.png" alt="" class="me-3" style="width: 150px;margin: 0 auto !important;">
                                 </p>
                                 <p class="h1 fw-bold text-center mb-0 mt-3">Let's get started</p>
                                 <p class="small text-center text-secondary mb-4">Provide your few details</p>


                                 <div class="position-relative">
                                    <div class="form-floating mb-3">
                                       <input type="text" class="form-control" id="passwd" placeholder="Referral Code" value="<?=$this->input->get('referral_id') ?>" name="referral_id" >
                                       <label for="passwd">Referral Code</label>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col">
                                       <div class="form-floating mb-3"><input class="form-control" id="namef" placeholder="Enter first name" value="" name="name" required> <label for="namef">Name</label></div>
                                    </div>
                                 </div>
                                 

                                 <div class="input-group mb-3">
                                    <div class="form-floating maxwidth-100">
                                       <select class="form-select" id="code" aria-label="Country code">
                                          <option selected="selected" value="+91">+91</option>
                                       </select>
                                       <label for="code">Code</label>
                                    </div>
                                    <div class="form-floating"><input class="form-control" id="phonen" placeholder="Enter your phone number" name="mobile" required> <label for="phonen">Phone Number</label></div>
                                 </div>
                           

                                 <div class="position-relative">
                                    <div class="form-floating mb-3"><input type="password" class="form-control" id="checkstrength" placeholder="Enter your password" name="password" required> <label for="checkstrength">Password</label></div>
                                    <button type="button" class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                                 </div>


                                 <div class="position-relative">
                                    <div class="form-floating mb-3"><input type="password" class="form-control" id="passwd" placeholder="Confirm your password" name="cpassword" required> <label for="passwd">Confirm Password</label></div>
                                    <button type="button" class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                                 </div>


                              
                                 <button class="btn btn-theme w-100 mb-4" type="submit">Sign up</button>
                                 <div class="text-center mb-3">Already have account? <a href="login.php" class="">Login</a> here.</div>

                                 
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                	
                	<?php include('include/allscript.php'); ?>
                 
               </div>
            </div>
         </div>
      </main>
      
   </body>
</html>