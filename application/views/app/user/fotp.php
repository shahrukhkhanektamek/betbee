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
                        <div class="row h-100 align-items-center justify-content-center my-md-3">
                           <div class="col-12 col-md-10 col-lg-8 col-xxl-6 login-box">
                              <p style="text-align:center;">
                                 <img data-bs-img="dark" src="<?=base_url() ?>assets/logo.png" alt="" class="me-3" style="width: 150px;margin: 0 auto !important;">
                              </p>
                              <p class="h1 fw-bold text-center mb-0">OTP</p>
                              
                              

                              <form id="LoginForm1" method="post" action="<?=base_url('api/auth/forgot_otp_verify') ?>" novalidate class="tf-form front_form_data">
                                 <input type="hidden" class="form-control" name="mobile" id="mobile" value="<?=$this->session->userdata('phone') ?>" required>
                                 <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="emailadd" placeholder="Enter email address" value="" autofocus="" name="otp"> <label for="emailadd">OTP</label></div>

                                 <button type="submit" class="btn btn-theme w-100 mb-4">Submit</button>

                              </form>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php include('include/allscript.php'); ?>
               </div>
            </div>
         </div>
      </main>
   </body>
</html>