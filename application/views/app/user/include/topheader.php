<style>
   .btn.btn-square:not(.btn-sm):not(.btn-lg) {
    line-height: 31px!important;
 }
 .dropdown-menu-end[data-bs-popper] {
    left: auto;
    right: -125px;
}
</style>
<header class="adminuiux-header">
         <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">
               <button class="btn btn-l1ink btn-square sidebar-toggler" type="button" onclick="initSidebar()"><i class="sidebar-svg" data-feather="menu"></i></button> 
               <a class="navbar-brand" href="home.php">
                  <img data-bs-img="light" src="<?=base_url() ?>assets/logo.png" alt=""> 
                  <img data-bs-img="dark" src="<?=base_url() ?>assets/logo.png" alt="">
                  <div class="">
                     <span class="company-name text-uppercase h4"><b><?=website_name ?></b></span>
                  </div>
               </a>
               <div class="ms-auto"></div>
               <div class="ms-auto">

                  <div class="dropdown d-inline-block">
                     <a class="dropdown-toggle btn btn-link btn-link-header style-none" id="userprofiledd" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        <div class="row gx-0 d-inline-flex">
                           <div class="col-auto align-self-center">
                              <figure class="avatar avatar-28 rounded-circle coverimg align-middle"><img src="<?=($get_user['image']) ?>" alt="" id="userphotoonboarding2"></figure>
                           </div>
                        </div>
                     </a>

                     <div class="dropdown-menu dropdown-menu-end width-300 pt-0 px-0" aria-labelledby="userprofiledd">
                        <div class="bg-theme-1-space rounded py-3 mb-3 dropdown-dontclose">
                           <div class="row gx-0">
                              <div class="col-auto px-3">
                                 <figure class="avatar avatar-50 rounded-circle coverimg align-middle"><img src="<?=($get_user['image']) ?>" alt=""></figure>
                              </div>
                              <div class="col align-self-center">
                                 <p class="mb-1"><span><?=$full_detail->fname ?></span></p>
                                 <p class="mb-1">#<span><?=$full_detail->user_id ?></span></p>
                              </div>
                           </div>
                        </div>
                        <div class="px-2">
                           <div><a class="dropdown-item" href="edit-profile.php"><i data-feather="user" class="avatar avatar-18 me-1"></i> My Profile</a></div>                                                     
                           <div><a class="dropdown-item theme-red" href="<?=base_url('api/auth/logout') ?>"><i data-feather="power" class="avatar avatar-18 me-1"></i> Logout</a></div>
                        </div>
                     </div>
                  </div>
                  <a href="transaction-history.php" class="btn  btn-icon btn-link-header" style="padding-left: 0;padding-right: 0;"><i class="bi bi-wallet" style="font-size: 22px;"></i> &nbsp;&nbsp;   <span id="wallet-amount"><?=price_formate($full_detail->wallet+$full_detail->win_amount) ?></span>
               </a>
               </div>
            </div>
         </nav>

      
      </header>