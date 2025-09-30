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
                              <p class="h1 fw-bold text-center mb-0">Sorry!</p>
                              <p class="h4 text-center mb-2">You have to be here</p>
                              <p class="text-center text-secondary small mb-4">Provide your registered email address, we will send you email with change password link.</p>

                              <form id="LoginForm1" method="post" action="<?=base_url('api/auth/forgot_password_otp') ?>" novalidate class="tf-form front_form_data">
                                 <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="emailadd" placeholder="Enter email address" value="" autofocus="" name="mobile"> <label for="emailadd">Mobile</label></div>

                                 <button type="submit" class="btn btn-theme w-100 mb-4">Reset Now</button>

                              </form>


                              <div class="text-center mb-3">Already have password? <a href="login.php" class="">Login</a> here.</div>
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