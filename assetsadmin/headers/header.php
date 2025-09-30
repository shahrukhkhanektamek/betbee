<!DOCTYPE html>
<html lang="en">
   
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin Panel | Dashboard</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="dist/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- JQVMap -->
      <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
      <!-- summernote -->
      <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
      <!-- DataTables -->
      <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
         <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
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
               <a class="nav-link" data-widget="fullscreen" href="logout.php" role="button">
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
         <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Admin Panel</span>
         </a>
         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            
            <!-- SidebarSearch Form -->
            <div class="form-inline">
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
                  <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                     <a href="dashboard.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="users.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           User Management
                           <span class="right badge badge-danger">New</span>
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="winning-prediction.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Winner prediction
                           <span class="right badge badge-danger">New</span>
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="bid_chart.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Bid Chart
                           <span class="right badge badge-danger">New</span>
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="chats.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Chat Inbox
                           <span class="right badge badge-danger">0</span>
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="sell-report.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Sell Report
                           <span class="right badge badge-danger">New</span>
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="declare-result.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Declare Result
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="winning-details.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Winning Details
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                           Report Management
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="bid-history.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Bid History</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="withdraw-report.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Withdraw Report</p>
                           </a>
                        </li>
                        
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                           Wallet Management
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="auto-add-points.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Auto Add Points</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="withdraw-points-request.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Withdraw Points Request</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="upi_verification.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Deposit Points Request</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="add-points-user-wallet.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Add Points (User Wallet)</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="bid-revert.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Bid Revert</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="image_slider.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Slider Management
                           <span class="right badge badge-danger">New</span>
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                           Settings
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="change-password.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Change Password</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="main-settings.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Main Settings</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="contact-us.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Contact Us Details</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="how-to-play.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>How To Play</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                           Game Management
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="game-list.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Game List</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="game-rates.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Game Rates</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                           Notice Management
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="notice.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Notice Management</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="send-notification.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Send Notification</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                           Games & Numbers
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="single-digit.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Single Digit</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="jodi-digit.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Jodi Digit</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="single-pana.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Single Pana</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="double-pana.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Double Pana</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="triple-pana.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Triple Pana</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="half-sangam.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Half Sangam</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="full-sangam.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Full Sangam</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-header">Personal Games</li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                           Starline
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="starline-market-list.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Game List</p>
                           </a>
                        </li>
                        
                        <li class="nav-item">
                           <a href="starline-bid-history.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Bid History</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="starline-declare-result.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Declare Result</p>
                           </a>
                        </li>
                        
                        <li class="nav-item">
                           <a href="game-rates-star.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Game Rates</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                           GaliDisawar
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="galidisawar-market-list.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Game List</p>
                           </a>
                        </li>
                        
                        <li class="nav-item">
                           <a href="galidisawer_bid_history.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Bid History</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="galidisawer-declare-result.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Declare Result</p>
                           </a>
                        </li>
                        
                        <li class="nav-item">
                           <a href="game_rates_galidisawer.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Game Rates</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  
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
                     <h1 class="m-0">Dashboard</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                     </ol>
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->
