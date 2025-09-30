<?php  
$logo = 'demo-logo.png';
$favicon = 'demo-logo.png';

$setting = setting();
if(!empty($setting))
{
   if(!empty($setting->logo))
      if(json_decode($setting->logo))
         if(file_exists(FCPATH.'upload/'.json_decode($setting->logo)[0]->image_path))
            $logo = json_decode($setting->logo)[0]->image_path;

   if(!empty($setting->favicon))
      if(json_decode($setting->favicon))
         if(file_exists(FCPATH.'upload/'.json_decode($setting->favicon)[0]->image_path))
            $favicon = json_decode($setting->favicon)[0]->image_path;
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=website_name ?> | Log In</title>
  <link rel="shortcut icon" href="<?=base_url('upload/'.$favicon) ?>" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/dist/css/adminlte.min.css">


    <link rel="stylesheet" href="<?=base_url() ?>toast/saber-toast.css">
    <link rel="stylesheet" href="<?=base_url() ?>toast/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="<?= base_url('front_script.js') ?>"></script>




<style>
            
.loader {
    min-width: 100%;
    width: 100%;
    height: 100%;
    padding: 10px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ccc;
    cursor: pointer;
    transition: 0.3s linear;
    position: fixed;
    z-index: 99999999;
    background: rgba(0,0,0,0.5);
    top: 0;
    left: 0;
    display: none;
}
.loader.active {
    display: flex;
}
.loader-43 {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  color: #FFF;
  left: -100px;
  -webkit-animation: shadowRolling 2s linear infinite;
          animation: shadowRolling 2s linear infinite;
}
@-webkit-keyframes shadowRolling {
  0% {
    box-shadow: 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
  }
  12% {
    box-shadow: 100px 0 white, 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
  }
  25% {
    box-shadow: 110px 0 white, 100px 0 white, 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
  }
  36% {
    box-shadow: 120px 0 white, 110px 0 white, 100px 0 white, 0px 0 rgba(255, 255, 255, 0);
  }
  50% {
    box-shadow: 130px 0 white, 120px 0 white, 110px 0 white, 100px 0 white;
  }
  62% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 130px 0 white, 120px 0 white, 110px 0 white;
  }
  75% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 130px 0 white, 120px 0 white;
  }
  87% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 130px 0 white;
  }
  100% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0);
  }
}
@keyframes shadowRolling {
  0% {
    box-shadow: 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
  }
  12% {
    box-shadow: 100px 0 white, 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
  }
  25% {
    box-shadow: 110px 0 white, 100px 0 white, 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
  }
  36% {
    box-shadow: 120px 0 white, 110px 0 white, 100px 0 white, 0px 0 rgba(255, 255, 255, 0);
  }
  50% {
    box-shadow: 130px 0 white, 120px 0 white, 110px 0 white, 100px 0 white;
  }
  62% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 130px 0 white, 120px 0 white, 110px 0 white;
  }
  75% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 130px 0 white, 120px 0 white;
  }
  87% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 130px 0 white;
  }
  100% {
    box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0);
  }
}


.invalid-feedback {
    position: absolute;
    top: -23px;
    left: 0;
}


</style>






</head>
<body class="hold-transition login-page">
  <div class="loader"><span class="loader-43"> </span></div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <div class="account-header">
            <div class="account-logo text-center">
                <a href="#">
                    <img src="<?=base_url('upload/'.$logo) ?>" alt class="img-fluid" style="width: 85px;" />
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">

        

      <p class="login-box-msg">Sign in to start your session</p>


        <form method="post" class="form_data" action="<?= base_url('admin/') ?>auth/login" id="login_form" novalidate="" autocomplete="off">

            <div class="input-group mb-3">
              <input type="email" name="username" class="form-control" value="" placeholder="Email" required />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" value="" class="form-control" placeholder="Password" required />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            <?php
                if(captcha==true)
                {
             ?>
                <div id="captchadivlogin">
                      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                      <div class="g-recaptcha" data-sitekey="<?=captcha_sitekey ?>"></div>
                </div>
             
             <?php } ?>

            
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="<?=base_url() ?>assetsadmin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url() ?>assetsadmin/dist/js/adminlte.min.js"></script>
    
    <script src="<?=base_url() ?>toast/saber-toast.js"></script>
    <script src="<?= base_url('toast/script.js') ?>"></script>

</body>

</html>
