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
                              <p class="h1 fw-bold text-center mb-0">Create password</p>
                              
                              

                              <form id="LoginForm1" method="post" action="<?=base_url('api/auth/newpassword') ?>" novalidate class="tf-form front_form_data">

                                 <input type="hidden" class="form-control" name="mobile" id="mobile" value="<?=$this->session->userdata('phone') ?>" required>
                                 <input type="hidden" class="form-control" name="mobile" id="mobile" value="<?=$this->session->userdata('temp_session_id') ?>" required>


                                 <div class="position-relative">
                                    <div class="form-floating mb-3"><input type="password" class="form-control" id="checkstrength" placeholder="Enter your password" name="npassword" required> <label for="checkstrength">Password</label></div>
                                    <button type="button" class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                                 </div>


                                 <div class="position-relative">
                                    <div class="form-floating mb-3"><input type="password" class="form-control" id="passwd" placeholder="Confirm your password" name="cpassword" required> <label for="passwd">Confirm Password</label></div>
                                    <button type="button" class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                                 </div>



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