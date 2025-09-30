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
            <div class="marquee">
               <marquee direction="left" scrollamount="4" style="padding-top: 5px;color: #f20000;background-color: #000000;font-weight: 600;">
                  <?=$this->db->get_where("notice")->result_object()[0]->description ?>
               </marquee>
            </div>

            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="" aria-current="true" aria-label="Slide 1"></button>
            </div>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img src="<?=base_url() ?>assets/banner1.png" class="d-block w-100" alt="...">
               </div>
               <div class="carousel-item ">
                  <img src="<?=base_url() ?>assets/banner2.png" class="d-block w-100" alt="...">
               </div>
               <div class="carousel-item ">
                  <img src="<?=base_url() ?>assets/banner3.png" class="d-block w-100" alt="...">
               </div>
            </div>
           <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Previous</span>
           </button>
           <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Next</span>
           </button>
         </div>     
<style>
   .game-box {
       background: white;
       padding: 5px;
       text-align: center;
       border-radius: 10px;
               margin-bottom: 15px;
   }
   .game-box img {
    border-radius: 10px;
}
</style>

            <div class="container mt-3" id="main-content">
               <div class="text-center mb-3">
                  <p class="h4 mb-0"></p>
               </div>
               <div class="row gx-3 justify-content-center">

                  <div class="col-6 col-lg-6 col-xxl-3">
                     <div class="game-box" style="position:relative;">
                        <a href="dashboard.php" class="comming-soon">
                           <img src="<?=base_url() ?>assets/2.png" class="img-fluid">
                        </a>
                        <p style="position: absolute;top: 10px;color: greenyellow;text-align: left;width: 100%;font-size: 10px;font-weight: 900;letter-spacing: -0.5px;left: 13px;">Active</p>
                     </div>
                  </div>

                  
                  <div class="col-6 col-lg-6 col-xxl-3">
                     <div class="game-box">
                        <a href="" class="comming-soon">
                           <img src="<?=base_url() ?>assets/4.png" class="img-fluid">
                        </a>
                     </div>
                  </div>

                  
                  <div class="col-6 col-lg-6 col-xxl-3">
                     <div class="game-box">
                        <a href="" class="comming-soon">
                           <img src="<?=base_url() ?>assets/3.png" class="img-fluid">
                        </a>
                     </div>
                  </div>

                  
                  <div class="col-6 col-lg-6 col-xxl-3">
                     <div class="game-box">
                        <a href="" class="comming-soon">
                           <img src="<?=base_url() ?>assets/1.png" class="img-fluid">
                        </a>
                     </div>
                  </div>

                  

                  
               </div>
              
            </div>
             <?php include('include/menubar.php'); ?>
            <?php include('include/allscript.php'); ?>
         </main>
      </div>
      
   </body>
</html>