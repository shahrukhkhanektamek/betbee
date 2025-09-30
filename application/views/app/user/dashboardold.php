<?php
$currenturl = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!doctype html>
<html lang="en">
   <head>
      <?php include('include/allcss.php'); ?>
   </head>
   
   <body class="main-bg main-bg-opac main-bg-blur overflow-hidden">
      
      <?php include('include/topheader.php'); ?>

      <div class="adminuiux-wrap">

      <?php include('include/sidebar.php'); ?>
         
<style>
   .number-boxs {
    z-index: 2;
    padding: 8px 2px !important;
    margin-bottom: 5px !important;
    margin-top: 0;
    background: black;
    display: flex;
    justify-content: center;
}
   /*.number-boxs
   {
      z-index: 2;
   }*/
   .number-color{
      padding: 6px 11px;
      border-radius: 50%;
      border: 1px solid white;
   }
</style>
         <main class="adminuiux-content has-sidebar" onclick="contentClick()" style="padding-top: 50px!important;">
            <div class="container " id="main-content">
               <div class="row gx-4">
                  <div class="col-12 col-lg-12 mb-3 number-boxs">
                     <div class="box-no">
                        <span class="number-color" style="background-color:#8F00FF">1</span>
                        <span class="number-color" style="background-color:#d32f2f">2</span>
                        <span class="number-color" style="background-color:#000">3</span>
                        <span class="number-color" style="background-color:#d32f2f">4</span>
                        <span class="number-color" style="background-color:#d32f2f">5</span>
                        <span class="number-color" style="background-color:#8F00FF">6</span>
                        <span class="number-color" style="background-color:#d32f2f">7</span>
                        <span class="number-color" style="background-color:#d32f2f">8</span>
                        <span class="number-color" style="background-color:#000">9</span>
                     </div>
                  </div>

<style>
   .remote-playerlist {
       position: fixed !important;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background-color: red;
       z-index: 1;
   }
</style>


                  <div class="col-12 col-lg-12 remote-playerlist">
                     
                  </div>
<style >
  
.roulette-board {
  display: flex;
/*  flex-direction: column;*/
  align-items: center;
  background-color: #000;
  border: 3px solid #d4af37;
  padding: 0 20px;
  border-radius: 10px;
}

.top-number {
  display: flex;
  justify-content: center;
/*  margin-bottom: 10px;*/
}

.columns {
  display: flex;
  justify-content: space-between;
}

.column {
  display: flex;
  flex-direction: column;
}

.number {
/*  width: 40px;
  height: 40px;*/
  margin: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  font-weight: bold;
/*  border-radius: 50%;*/
  text-align: center;
  padding: 5px 10px;
}

.red {
  background-color: #d32f2f;
}

.black {
  background-color: #000;
}

.bottom-options {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  margin-top: 20px;
}

.option {
  background-color: #333;
  color: white;
  padding: 10px;
  margin: 5px;
  border-radius: 5px;
  text-align: center;
  width: 62px;
  font-size: 12px;
}

.red {
  background-color: #d32f2f;
  border: 1px solid white;
}

.black {
  background-color: #000;
  border: 1px solid white;
}
.violet {
  background-color: #8F00FF;
  border: 1px solid white;
}

.roulette-board {
  border: 3px solid #ffcc00;
  padding: 0 20px;
/*  padding: 20px;*/
  background-color: black;
}
.number-box
{
   position: relative;
   z-index: 9999;
}
.number-box {
    position: relative;
    z-index: 2;
    top: 27rem;
    padding: 0;
}
</style>
                     <div class="col-12 col-lg-12 number-box">
                        <div class="card adminuiux-card">
                           <div class="card-body p-0">

                                 <div class="row roulette-board">
                                    <div class="col-12 top-number">
                                       <div class="number">0</div>
                                    </div>
                                    <div class="col-4">
                                       <div class="bottom-options">
                                          <div class="option violet">VIOLET</div>
                                          <div class="option red">RED</div>
                                          <div class="option black">BLACK</div>
                                       </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="columns">
                                          <div class="column">
                                            <div class="number red">3</div>
                                            <div class="number black">2</div>
                                            <div class="number red">1</div>
                                          </div>
                                          <div class="column">
                                            <div class="number black">4</div>
                                            <div class="number red">5</div>
                                            <div class="number black">6</div>
                                          </div>
                                          <div class="column">
                                            <div class="number red">7</div>
                                            <div class="number black">8</div>
                                            <div class="number red">9</div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                       <div class="bottom-options">
                                          <div class="option violet">VIOLET</div>
                                          <div class="option red">RED</div>
                                          <div class="option black">BLACK</div>
                                       </div>
                                    </div>
                                    
                                 </div>

                                 
                           </div>
                        </div>
                     </div>

                  

               </div>              
            </div>

            <!-- <?php include('include/menubar.php'); ?> -->
            <?php include('include/allscript.php'); ?>


         </main>
      </div>
      
      
   </body>
</html>