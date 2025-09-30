<!doctype html>
<html lang="en" >
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

                              <p class="h1 fw-bold text-center mb-4">Hi,Welcome Back!</p>

                              <form id="LoginForm1" method="post" action="<?=base_url('api/auth/login') ?>" novalidate class="tf-form front_form_data">
                                 <div class="form-floating mb-3"><input type="email" class="form-control" id="emailadd" placeholder="Enter Email Or Mobile" value="" name="mobile" autofocus=""> <label for="emailadd">Email Or Mobile</label></div>
                                 <div class="position-relative">
                                    <div class="form-floating mb-3"><input type="password" class="form-control" id="passwd" placeholder="Enter your password" name="password"> <label for="passwd">Password</label></div>
                                    <button class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                                 </div>
                                 <div class="row align-items-center mb-3">
                                    <div class="col">
                                       <div class="form-check"><input class="form-check-input" type="checkbox" name="rememberme" id="rememberme"> <label class="form-check-label" for="rememberme">Remember me</label></div>
                                    </div>
                                    <div class="col-auto"><a href="forgot-password.php" class="">Forget Password?</a></div>
                                 </div>
                                 <!-- <a href="home.php" class="btn btn-theme w-100 mb-4">Login</a> -->
                                 <button type="submit" class="btn btn-theme w-100">Login</button>
                                 <div class="text-center mb-3">Don't have account? <a href="register.php" class="">Create Account</a></div>
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
<script>check_login()</script>
   
</html>