<!doctype html>
<html lang="en">
   <head>
       <?php include('include/allcss.php'); ?>
   </head>
   <body class="main-bg main-bg-opac main-bg-blur overflow-hidden">
      <?php include('include/topheader.php'); ?>

      <div class="adminuiux-wrap">
         <?php include('include/sidebar.php'); ?>

         <main class="adminuiux-content has-sidebar" onclick="contentClick()">
            <div class="container-fluid mt-2">
               <div class="bg-theme-1-subtle rounded px-2 py-2">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item bi"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active bi" aria-current="page">Change Password</li>
                     </ol>
                  </nav>
               </div>
            </div>
            <div class="container mt-3" id="main-content">
               <div class="text-center mb-3">
                  <p class="h4 mb-0"></p>
               </div>
               <div class="row h-100 align-items-center justify-content-center my-md-3">
                   <div class="col-12 col-md-10 col-lg-8 col-xxl-6 login-box">
                      <p class="text-center text-secondary small mb-4">Provide you new password and confirm password here and you're all set to go.</p>
                      


                     <form id="LoginForm1" method="post" action="<?=base_url('api/user/password_update') ?>" novalidate class="tf-form front_form_data">
                         <div class="position-relative">
                            <div class="form-floating mb-3"><input type="password" class="form-control" id="passwdconfirm" placeholder="Old password" name="oldpassword" required> <label for="passwdconfirm">Old Password</label></div>
                            <button type="button" class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                         </div>

                         <div class="position-relative">
                            <div class="form-floating mb-3"><input type="password" class="form-control" id="checkstrength" placeholder="Enter your new password" name="npassword" required> <label for="checkstrength">New Password</label></div>
                            <button type="button" class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                         </div>
                         
                         <div class="position-relative">
                            <div class="form-floating mb-3"><input type="password" class="form-control" id="passwdconfirm" placeholder="Confirm your new password" name="cpassword" required> <label for="passwdconfirm">Confirm Password</label></div>
                            <button type="button" class="btn btn-square btn-link text-theme-1 position-absolute end-0 top-0 mt-2 me-2"><i class="bi bi-eye"></i></button>
                         </div>
                         <button type="submit" class="btn btn-theme w-100 mb-4">Change Now</button>
                       </form>





                   </div>
                </div>
              
            </div>
            <?php include('include/menubar.php'); ?>
            <?php include('include/allscript.php'); ?>
         </main>
      </div>
      
   </body>
</html>