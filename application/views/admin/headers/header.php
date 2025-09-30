<?php 
   $get_user = get_user();
   $user_detail = $get_user['full_detail'];
   $image = $get_user['image'];
   $logo = 'demo-logo.png';
   $favicon = 'demo-logo.png';
   $setting = setting();
   if(!empty($setting))
   {
      if(!empty($setting->logo))
         if(json_decode($setting->logo))
            $logo = json_decode($setting->logo)[0]->image_path;

      if(!empty($setting->favicon))
         if(json_decode($setting->favicon))
            $favicon = json_decode($setting->favicon)[0]->image_path;
   }
?>
<!DOCTYPE html>
<html lang="en">
   
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?=$title ?></title>
      <link rel="shortcut icon" href="<?=base_url('upload/'.$favicon) ?>">
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/dist/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- JQVMap -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/jqvmap/jqvmap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/dist/css/adminlte.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/daterangepicker/daterangepicker.css">
      <!-- summernote -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/summernote/summernote-bs4.min.css">
      <!-- DataTables -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="<?=base_url() ?>assetsadmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">



      <link rel="stylesheet" href="<?=base_url() ?>toast/saber-toast.css">
      <link rel="stylesheet" href="<?=base_url() ?>toast/style.css">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="<?= base_url('front_script.js') ?>"></script>
      <link rel="stylesheet" href="<?=base_url() ?>upload-multiple/style.css">
      <script src="<?=base_url() ?>upload-multiple/script.js"></script>


      <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>



      




<style>
.singleAnks-card .inner-card {
    padding: 10px 5px;
}

.card-body, .card, .modal-body {
    overflow: auto;
}
[class*="sidebar-dark-"] {
    background-color: #2e3383;
}
[class*="sidebar-dark"] .btn-sidebar, [class*="sidebar-dark"] .form-control-sidebar {
    background-color: #2e3383;
    border: 1px solid #56606a;
    color: #fff;
}
.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
    background-color: #007bff;
    color: #fff;
}



  #filter_inputs
  {
    display: block;
  }
    .single-image-div {
        width: 50%;
        text-align: center;
        display: block;
        margin: 15px auto;
        box-shadow: 0px 0px 25px 1px rgba(0,0,0,0.5);
        padding: 10px 0;
        border-radius: 10px;
    }

    .remove-btn {
        position: absolute;
        top: 0;
        right: 10px;
        z-index: 99;
    }
    .panel-title {
        padding: 10px 20px 10px 20px;
        background: lightgray;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
   .custom-file-upload {
    display: block;
    width: 100%;
    border: 2px solid;
    width: 100% !important;
    border-style: dotted;
    border-radius: 5px;
    border-width: 3px;
    overflow: hidden;
    position: relative;
}
.custom-file-upload > span {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.custom-file-upload > input.active {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    opacity: 1;
}
.custom-file-upload > input.active:before {
    content: "\f093";
    position: absolute;
    top: 0;
    left: auto;
    right: auto;
    bottom: auto;
    display: block;
    width: 100%;
    height: 100%;
    text-align: center;
    padding-top: 9%;
    font-size: 50px;
    background: white;
}
.custom-file-upload > input {
    
    display: block !important;
    height: 155px;
    width: 100% !important;
    opacity: 0;
    
}
   .active.loading:before {
    content: "Loading...";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 99999999999;
    color: white;
    text-align: center;
    padding-top: 5%;
    font-size: 20px;
    letter-spacing: 5px;
    font-weight: bold;
}
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: block;
  width: 35px;
  height: 18px;
  margin-top: 3px;
      margin: 3px auto;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
      height: 15px;
    width: 15px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  top: 1.2px;
}

input:checked + .slider {
  background-color: #77c425;
}

input:focus + .slider {
  box-shadow: 0 0 1px #77c425;
}

input:checked + .slider:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}


.recharge-nav.active {
    background: #042954 !important;
    border-color: #042954 !important;
}
.ctabs a {
    background: #eb4141;
    color: white;
    text-decoration: none;
    margin-right: 5px;
    padding: 3px 5px;
}
.ctabs a.active {
    background: black;
}
.tag{
width: 100%;
}
.custom-file-upload img {
   width: 100% !important;
   height: 100%;
}
.sidebar-menu li a {
    font-weight: 600;
}
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


.cd-buttons {
   margin: 0;
   padding: 0;
   border: 0;
   font-size: 100%;
   font: inherit;
   vertical-align: baseline;
}


/* -------------------------------- 

Modules - reusable parts of our design

-------------------------------- */
.img-replace {
  /* replace text with an image */
  display: inline-block;
  overflow: hidden;
  text-indent: 100%;
  color: transparent;
  white-space: nowrap;
}

/* -------------------------------- 

xnugget info 

-------------------------------- */
.cd-nugget-info {
  text-align: center;
  position: absolute;
  width: 100%;
  height: 50px;
  line-height: 50px;
  bottom: 0;
  left: 0;
}
.cd-nugget-info a {
  position: relative;
  font-size: 14px;
  color: #5e6e8d;
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  transition: all 0.2s;
}
.no-touch .cd-nugget-info a:hover {
  opacity: .8;
}
.cd-nugget-info span {
  vertical-align: middle;
  display: inline-block;
}
.cd-nugget-info span svg {
  display: block;
}
.cd-nugget-info .cd-nugget-info-arrow {
  fill: #5e6e8d;
}

/* -------------------------------- 

Main components 

-------------------------------- */


.cd-popup-trigger {
  display: block;
  width: 170px;
  height: 50px;
  line-height: 50px;
  margin: 3em auto;
  text-align: center;
  color: #FFF;
  font-size: 14px;
  font-size: 0.875rem;
  font-weight: bold;
  text-transform: uppercase;
  border-radius: 50em;
  background: #35a785;
  box-shadow: 0 3px 0 rgba(0, 0, 0, 0.07);
}
@media only screen and (min-width: 1170px) {
  .cd-popup-trigger {
    margin: 6em auto;
  }
}

/* -------------------------------- 

xpopup 

-------------------------------- */
.cd-popup {
  position: fixed;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  background-color: #ffffffb3;
  opacity: 0;
  visibility: hidden;
  -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s;
  -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s;
  transition: opacity 0.3s 0s, visibility 0s 0.3s;
   z-index: 999999;
}
.cd-popup.is-visible {
  opacity: 1;
  visibility: visible;
  -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
  -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
  transition: opacity 0.3s 0s, visibility 0s 0s;
}

.cd-popup-container {
  position: relative;
  width: 90%;
  max-width: 400px;
  margin: 4em auto;
  background: #FFF;
  border-radius: .25em .25em .4em .4em;
  text-align: center;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
  -webkit-transform: translateY(-40px);
  -moz-transform: translateY(-40px);
  -ms-transform: translateY(-40px);
  -o-transform: translateY(-40px);
  transform: translateY(-40px);
  /* Force Hardware Acceleration in WebKit */
  -webkit-backface-visibility: hidden;
  -webkit-transition-property: -webkit-transform;
  -moz-transition-property: -moz-transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.cd-popup-container p {
  padding: 3em 1em;
}
.cd-popup-container .cd-buttons:after {
  content: "";
  display: table;
  clear: both;
}
.cd-popup-container .cd-buttons li {
  float: left;
  width: 50%;
  list-style: none;
}
.cd-popup-container .cd-buttons a {
  display: block;
  height: 60px;
  line-height: 60px;
  text-transform: uppercase;
  color: #FFF;
  -webkit-transition: background-color 0.2s;
  -moz-transition: background-color 0.2s;
  transition: background-color 0.2s;
}
.cd-popup-container .cd-buttons li:first-child a {
  background: #fc7169;
  border-radius: 0 0 0 .25em;
}
.no-touch .cd-popup-container .cd-buttons li:first-child a:hover {
  background-color: #fc8982;
}
.cd-popup-container .cd-buttons li:last-child a {
  background: #b6bece;
  border-radius: 0 0 .25em 0;
}
.no-touch .cd-popup-container .cd-buttons li:last-child a:hover {
  background-color: #c5ccd8;
}
.cd-popup-container .cd-popup-close {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 30px;
  height: 30px;
}
.cd-popup-container .cd-popup-close::before, .cd-popup-container .cd-popup-close::after {
  content: '';
  position: absolute;
  top: 12px;
  width: 14px;
  height: 3px;
  background-color: #8f9cb5;
}
.cd-popup-container .cd-popup-close::before {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  left: 8px;
}
.cd-popup-container .cd-popup-close::after {
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg);
  right: 8px;
}
.is-visible .cd-popup-container {
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -ms-transform: translateY(0);
  -o-transform: translateY(0);
  transform: translateY(0);
}
@media only screen and (min-width: 1170px) {
  .cd-popup-container {
    margin: 8em auto;
  }
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
  background-color: #71519d;
  border: 1px solid #71519d;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
  color: white;
}
.select2-container .select2-selection--single
{
  height: calc(2.25rem + 2px);
}
.select2-container--default .select2-selection--single {
    padding: 5px 5px;
    padding-top: 6px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow b {
  top: 70%;
}
.select2-container--default .select2-selection--single {
  border: 1px solid #ced4da;
}
.yes_no label {
    margin: 0 !important;
}

#deletemodal .modal-footer {
    padding: 0 0 !important;
}
.modal-f > div {
    padding: 0;
}
.modal-f > div > button {
    width: 100%;
    border-radius: 0;
}
#deletemodal i {
    font-size: 50px;
    color: #171941;
}
#deletemodal p {
    margin: 0;
    font-size: 20px;
    text-transform: capitalize;
}
#deletemodal .modal-body {
    text-align: center;
}

.card-body {
    position: relative;
}
.spin-div {
    position: absolute;
    top: 0;
    left: 0;
    background: rgb(239 226 226 / 50%);
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    z-index: 9999999;
}
.spin-div .fa-spinner {
  font-size: 55px;
  margin: 0 auto;
  display: block;
  width: fit-content;
  color: #00000070;
}


.violet-black-bg
{
   background: linear-gradient(151deg, #8C3BBD 50%, #000000 50%) !important;
}
.violet-red-bg
{
   background: linear-gradient(151deg, #8C3BBD 50%, #FA1414 50%) !important;
}

.violet-black-bg-round
{
   background: linear-gradient(90deg, #8C3BBD 50%, #000000 50%) !important;
}
.violet-red-bg-round
{
   background: linear-gradient(90deg, #8C3BBD 50%, #FA1414 50%) !important;
}





.black-bg
{
   background: #000000 !important;
}
.violet-bg
{
   background: #8C3BBD !important;
}
.red-bg
{
   background: #FA1414 !important;
}
.white-bg
{
   background: white !important;
}


@media(max-width: 767px)
{
  .card-header .form-control {
      margin: 0 0 10px 0;
  }
}

</style>








   </head>
   <body class="hold-transition sidebar-mini layout-fixed loading">
    <div class="loader"><span class="loader-43"> </span></div>
      <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
         <img class="animation__shake" src="<?=base_url('upload/'.$logo) ?>" alt="AdminLTELogo" height="60" width="60">
      </div>
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>
         <!-- Right navbar links -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" href="<?=base_url('admin/auth/logout') ?>" role="button">
               <i class="fas fa-power-off"></i>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
               <i class="fas fa-expand-arrows-alt"></i>
               </a>
            </li>
         </ul>
      </nav>
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <!-- Brand Logo -->
         <a href="dashboard.php" class="brand-link">
         <img src="<?=base_url('upload/'.$logo) ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Admin Panel</span>
         </a>
         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            
            <!-- SidebarSearch Form -->
            <div class="form-inline mt-2">
               <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                     <button class="btn btn-sidebar">
                     <i class="fas fa-search fa-fw"></i>
                     </button>
                  </div>
               </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <?php $this->load->view('admin/headers/nav'); ?>
                  
               </ul>
            </nav>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0"><?=$page_title ?></h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <?php $this->load->view("admin/headers/breadcrumb") ?>
                     </ol>
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->
