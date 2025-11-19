
<?php  
   $spinner = '<div class="spin-div"><i class="fa fa-spinner fa-spin" ></i></div>';
   $table_id = 1; 
   
   $date = date("Y-m-d");
   $year = date("Y",strtotime($date));
   $month = date("m",strtotime($date));
   $day = date("d",strtotime($date));
   if($month[0]==0)$month = $month[1];
   if($day[0]==0)$day = $day[1];
   $date = $year.'-'.$month.'-'.$day;
   ?>
<style>
   .win_number {
   text-align: center;
   padding: 8px 0 0 0;
   color: white;
   display: block;
   /*position: absolute;*/
   top: 0;
   left: 0;
   width: 40px;
   height: 40px;
   box-shadow: 0px 0px 3px rgb(0 0 0 / 50%);
   border-radius: 50%;
   margin: 0 auto;
   }
   .in-div {
   width: 65px;
   height: 65px;
   margin: 0 auto;
   display: block;
   position: relative;
   }
   .win-popup-number {
   position: relative;
   color: white;
   width: 60px;
   display: block;
   text-align: center;
   height: 60px;
   /* font-size: 40px; */
   border-radius: 50%;
   margin: 0 auto;
   }
   .in-div > div {
   width: 100%;
   height: 100%;
   }
   .in-div .win_number {
   font-size: 35px;
   }
   .in-div > span {
   width: 100% !important;
   height: 100% !important;
   font-size: 35px !important;
   }
   .number-color-btn li {
   display: inline-block;
   /*background: #A90041;*/
   color: white;
   /*    padding: 2px 10px;*/
   margin-bottom: 10px;
   border-radius: 3px;
   cursor: pointer;
   }
   .number-color-btn.green li
   {
   /*background: #15971A;*/
   }
   .win_numbers li {
   margin-left: 5px;
   }
   .numbers {
   text-align: center;
   background: #15971a;
   color: white;
   font-weight: 800;
   border-radius: 4px;
   padding: 10px 0;
   cursor: pointer;
   margin: 0 0 10px 0;
   position: relative;
   }
   .numbers i {
   position: absolute;
   top: -10px;
   right: -10px;
   background: white;
   font-size: 16px;
   height: 25px;
   width: 25px;
   text-align: center;
   align-items: center;
   border-radius: 50%;
   display: none;
   color: black;
   border: 2px solid black;
   }
   .numbers.active i {
   display: grid;
   }
   .best-user {
   border: 1px solid #dee2e6;
   padding: 10px 10px;
   border-radius: 5px;
   }
   .join-violet.numbers.active i {
   border-color: #8c3bbd;
   }
   .join-red.numbers.active i {
   border-color: #fa1414;
   }
   .select-numbers-modal {
   position: fixed;
   bottom: 0;
   left: 0;
   width: 100%;
   background: white;
   z-index: 999999;
   padding: 15px 0;
   display: none;
   }
   .select-numbers-modal.active {
   display: flex;
   }
   .select-numbers-modal .number-color-btn {
   margin: 0 auto;
   padding: 0;
   }
   .select-numbers-modal .number-color-btn li {
   margin-left: 5px;
   }
   .breadcrumb {
   margin: 0 !important;
   }
   .numbers.active {
   /*background: black;*/
   }
   .number-color-btn {
   margin: 0 auto;
   padding: 0;
   }
   .sspp11, .sspp55 {
   font-weight: 800;
   }
   .sspp11 span, .sspp55 span {
   font-weight: 500;
   }
   .join-black, .join-violet, .join-red {
   width: 90px;
   background: gray;
   display: inline-block;
   padding: 0px 0;
   margin: 0 auto;
   color: white !important;
   border-radius: 5px;
   box-shadow: -3px 3px 4px 0px rgba(0, 0, 0, 0.25);
   }
   .color-button img {
   height: 60px !important;
   display: block;
   margin: 0 auto;
   }
   .p_id_type {
   background: gray;
   width: 50px;
   height: 50px;
   display: grid !important;
   margin: 0 auto;
   border-radius: 50%;
   color: white;
   text-align: center !important;
   align-items: center;
   font-weight: 800;
   font-size: 20px;
   }
   .join-violet {
   background: #8C3BBD;
   }
   .join-black {
   background: #000000;
   }
   .join-red {
   background: #FA1414;
   }
   .color-button {
   display: block;
   }
   .game-total-bet b {
   width: 100%;
   display: block;
   }

   .join-black.active
   {
      border: 2px solid #000000;
   }
   .join-violet.active   
   {
      border: 2px solid #8C3BBD;
   }
   .join-red.active
   {
      border: 2px solid #FA1414;
   }


   .join-black, .join-violet, .join-red  {
       background: #ffffff;
   }
   .join-black .iiinner {
       background: black;
   }
   .join-violet .iiinner {
       background: #8C3BBD;
   }
   .join-red .iiinner {
       background: #FA1414;
   }
   .iiinner {
       padding: 15px 0;
       border-radius: 3px;
   }
   .numbers.active {
       padding: 2px;
   }
.progress-bar-danger {
    background-color: #d9534f;
}


.p_id_type.join-violet {
    background: #8C3BBD;
}
.p_id_type.join-black {
    background: #000000;
}
.p_id_type.join-red {
    background: #FA1414;
}


.result-pending {
    display: block;
}
.result-pending {
    display: block;
    margin: 10px auto;
    background: red;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    animation: beat .25s infinite alternate;
    display: none;
}

@keyframes beat{
   to { transform: scale(1.2); }
}

.select-color-before {
    text-align: center;
}
.numbers.active {
    animation: beat .25s infinite alternate;
}






.select-amount.selected {
    border-radius: 50%;
    border: 1px solid white;
    padding: 1px;
}
.game-btn-button p {
    text-align: center;
    margin-top: 3px;
    font-size: 15px;
}
.game-btn-button {
   margin-top: 15px;
    width: 100%;
    display: block;
}
.game-btn-button button {
   display: block;
    width: 100px;
    height: 100px;
    font-size: 35px;
    font-weight: bold;
}
.join-red-btn, .join-black-btn, .join-violet-btn, .number-color-btn {
   width: 60px;
   height: 35px;
   border: 0;
   border-radius: 5px;
   border: 1px solid;
}


.join-red-btn {
   background: #FA1414;
}
.join-black-btn {
    background: #000000;
}
.join-violet-btn {
    background: #8C3BBD;
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



.join-black, .join-red, .join-violet {
    position: relative;
}
.enimate-coin {
    position: absolute;
    z-index: 9;
    display: none;
    width: 20px !important;
    height: 20px !important;
}
.coininn {
    position: relative;
    display: flex;
    align-items: center;
    text-align: center;
}
.color-button img {
    display: block;
    margin: 0 auto;
    width: 100%;
}
.coin-amt {
   position: absolute;
    top: 0;
    left: 0%;
    font-size: 5px;
    color: black;
    display: flex;
    width: 100%;
    font-weight: 900;
    height: 100%;
    align-items: center;
    text-align: center;
}
.coin-amt2 {
    display: block;
    text-align: center;
    width: 100%;
}
.number-color-btn {
    color: white;
}
.select-color-before .numbers {
    width: 50%;
    height: 100px;
    font-size: 73px !important;
    padding: 0 !important;
    display: grid;
    align-items: center;
    text-align: center;
    margin: 0 auto;
    margin-top: 15px;
    margin-bottom: 15px;
}
.game-btn-button p {
    margin: 0;
    font-weight: 600;
}
.game-btn-button button {
    margin-bottom: 10px;    
}
.game-btn-button p span {
    font-weight: 400;
}
.wheel-status {
    text-align: center;
    display: block;
    font-size: 20px;
    font-weight: 900;
    letter-spacing: 1px;
}


@media(max-width:767px)
{
   .game-btn-button {
       width: 100%;
   }
   .game-btn-button button {
       width: 50px;
       height: 50px;
       font-size: 20px;
   }
   .game-btn-button p {
       font-size: 11px;
    }
}



</style>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card card-primary">
                     <div class="card-header">
                        <h3 class="card-title">
                            <?php if(empty($session_id)){ ?>
                                Game Manuals
                            <?php }else{ ?> 
                                Old Result
                            <?php } ?>
                        </h3>
                     </div>
                     <div class="card-body">
                        <div class="row">

                           
                           <div class="col-lg-12 col-md-12">
                              <div class="row" style="margin: 0;">
                            <?php if(empty($session_id)){ ?>
                                 <div class="row" style="width:100%">
                                     
                              Wheel Staus <span id="wheelstatus"></span>
                                    <div class="col-md-12 text-center mb-2">
                                       <label class="btn btn-danger" for="timer_checkbox">
                                          <input type="checkbox" id="timer_checkbox" value="1" checked> Start timer after declare result
                                       </label>
                                    </div>
                            
                                    <div class="col-4">
                                       <button type="button" class="btn btn-success" onclick="window.location.href='<?=base_url() ?>admin/sessions/list/1'">Old Results</button>
                                    </div>
                                    <div class="col-4" style="text-align:center;">
                                       <button type="button" class="btn btn-success" disabled id="start-timer" style="font-size: 20px;">START TIMER</button>
                                       <!-- <button type="button" class="btn btn-danger stop-timer" style="font-size: 20px;">STOP TIMER</button> -->
                                    </div>
                                    <div class="col-4" style="text-align: right;">                                            
                                       <button type="button" class="btn btn-success get_about_to_win"><i class="fa fa-redo"></i></button>
                                    </div>
                                    
                                 </div>
                           
                                <?php } ?>


                                 <div class="row mt-2" style="width:100%">
                                    <div class="col-md-4">
                                       <span class="sspp11" style="font-size: 22px;float: left;">Total bet amount: Rs. 
                                       <span class="sspp22 total_bet_amount">0</span></span>
                                    </div>
                                    <div class="col-md-4">
                                       <h3 class="hh11" style="font-weight: 700;text-align: center;margin-top: 0px;font-size: 22px;margin-bottom: 0;width: 100%;">
                                          You have to pay in this session: Rs. 
                                          <span class="have_to_pay">0</span>
                                       </h3>
                                    </div>
                                    <div class="col-md-4">
                                       <span class="sspp55" style="    font-size: 22px;float: left;margin-left: 160px;">Total P &amp; L amount: Rs. 
                                       <span class="sspp66 total_profit">0</span></span>
                                    </div>
                                 </div>
                         
                                 <span class="result-pending">Result Pending</span>
                                 <h4 style="text-align: center;margin-top: 15px;width: 100%;">
                                    <span class="sspp33">(<span id="start_date_time"></span> - <span id="end_date_time"></span>)</span><br>
                                    <?php if(empty($session_id)){ ?>
                                        <span>Remaining Time: </span><span class="sspp44" id="mint-count">done</span><br>
                                        <span>Betting Time: </span><span class="sspp44" id="mint-count2">Over</span>
                                    <?php } ?>
                                    
                                 </h4>


                                 <div class="row" style="width: 100%;">
                                    <div class="col-4 text-center">
                                       <div class="game-btn-button">
                                          <button class="join-black join-black-btn color-button" data-p_id="1"></button>
                                          <p class="my-black-bet">Bet Amount: <span class="color-bet-amount1">₹ 0.00</span></p>
                                       </div>
                                    </div>
                                    <div class="col-4 text-center">
                                       <div class="game-btn-button">
                                          <button class="join-violet join-violet-btn color-button" data-p_id="2"></button>
                                          <p class="my-blue-bet">Bet Amount: <span class="color-bet-amount2">₹ 0.00</span></p>
                                       </div>
                                    </div>
                                    <div class="col-4 text-center">
                                       <div class="game-btn-button">
                                          <button class="join-red join-red-btn color-button" data-p_id="3"></button>
                                          <p class="my-red-bet">Bet Amount: <span class="color-bet-amount3">₹ 0.00</span></p>
                                       </div>
                                    </div>

                                    <div class="row bet-btns"></div>
                                    

                                 </div>


                              
                                 <?php if(empty($session_id)){ ?>
                                    <button type="button" class="btn btn-success submit-manual" disabled style="margin: 0 auto;margin-top: 15px;">Declare Result</button>   
                                    <?php } ?>
                                 <!-- <h1 style="display: block;width: 100%;text-align: center;margin-top: 18px;">Bettings</h1> -->
                                 <div class="row" id="bettings-area"></div>
                                 <!-- <audio autoplay id="myAudio" src="<?=base_url() ?>bell4.mp3"></audio> -->



                                 <audio id="myAudio" controls style="display:none;">
                                    <source src="<?=base_url() ?>bell4.mp3" type="audio/mp3" style="display: none;">
                                    Your browser does not support the audio tag.
                                </audio>
                                <!-- <button id="playButton">Play Audio</button> -->



                                 
                              </div>
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- /.row (main row) -->
   </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class="modal fade" id="resultdeclaremodal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
             <div class="select-color-before">
                 
             </div>

            <div class="row mt-2" style="width:100%">
               <div class="col-md-12">
                  <span class="sspp11" style="font-size: 15px;float: left;">Total bet amount: Rs. 
                  <span class="sspp22 total_bet_amount">0</span></span>
               </div>
               <div class="col-md-12">
                  <h3 class="hh11" style="font-weight: 700;font-size: 15px;width: 100%;">
                     You have to pay in this session: Rs. 
                     <span class="have_to_pay">0</span>
                  </h3>
               </div>
               <div class="col-md-12">
                  <span class="sspp55" style="    font-size: 15px;float: left;">Total P &amp; L amount: Rs. 
                  <span class="sspp66 total_profit">0</span></span>
               </div>
            </div>
             
            <p style="text-align: center;font-size: 20px;">Are you sure to declare</p>
         </div>
         <div class="row m-0 modal-f">
            <div class="col-12">
               <span class="wheel-status" id="wheel-status"></span>
            </div>
            <div class="col-6">
               <button class="btn btn-danger" data-dismiss="modal" style="border-bottom-left-radius: 3px;">No</button>
            </div>
            <div class="col-6">
               <button class="btn btn-success submit-manual-confirm" style="border-bottom-right-radius: 3px;">Yes</button>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="stoptimermodal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <p style="text-align: center;font-size: 20px;">Are you sure to stop</p>
            <form class="row m-0" id="stopform">
               <input type="datetime-local" class="form-control col-md-12" id="stopdatetime">
               <textarea class="form-control col-md-12 mt-2" id="stopmessage"></textarea>
            </form>
         </div>
         <div class="row m-0 modal-f">
            <div class="col-6">
               <button class="btn btn-danger" data-dismiss="modal" style="border-bottom-left-radius: 3px;">No</button>
            </div>
            <div class="col-6">
               <button class="btn btn-success stop-confirm" style="border-bottom-right-radius: 3px;">Yes</button>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="d-warning">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body" style="display: flex;">
            <a class="btn btn-danger" href="<?=base_url('admin/sessions/list/'.$game_id.'?pending=1') ?>" style="margin: 0 auto;">Go to pending results</a>
         </div>
         
      </div>
   </div>
</div>


<script>
      
    </script>

<script>
    function price_format(amount)
    {        
        formattedCurrency = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'INR'
        }).format(amount);

        return formattedCurrency.replace('₹', '₹ ')

    }
</script>


<script type="module">

   // import { firebaseConfig} from '<?=base_url() ?>firebase.js';
   import { firebaseConfig} from '<?=base_url() ?>firebase2.js';
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-analytics.js";
    import { getDatabase, ref, set, child, update, remove, onValue  } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-database.js";
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    const db = getDatabase();


   


  // Function to play the audio
        function playAudio() {
            var audio = document.getElementById('myAudio');
            audio.play().catch(function(error) {
                console.error('Error attempting to play audio:', error);
            });
        }

        // Add event listener to the button
        // document.getElementById('playButton').addEventListener('click', playAudio);




      document.addEventListener('dblclick', function(event) {
            event.preventDefault();
      });



   function msToTime_new(duration)
   {
      var milliseconds = Math.floor((duration % 1000) / 100),
      seconds = Math.floor((duration / 1000) % 60),
      minutes = Math.floor((duration / (1000 * 60)) % 60),
      hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
      hours = (hours < 10) ? "0" + hours : hours;
      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;
      return {"hour":hours,"minutes":minutes,"seconds":seconds};
   }
   function get_duration(date2)
   {
       var options = { timeZone: 'Asia/Kolkata' };
       var currentdate = new Date(); 
       var year = currentdate.getFullYear();
       var month = currentdate.getMonth();
       var day = currentdate.getDate();
       var hour = currentdate.getHours();
       var minute = currentdate.getMinutes();
       var second = currentdate.getSeconds();
       if(month<10) month = '0'+month;
       if(day<10) day = '0'+day;
       if(hour<10) hour = '0'+hour;
       if(minute<10) minute = '0'+minute;
       if(second<10) second = '0'+second;
       var date1 = 
            year
            +'-'+month
            +'-'+day
            +' '+hour
            +':'+minute
            +':'+second;

      var olddate = new Date(date2); 
       var year2 = olddate.getFullYear();
       var month2 = olddate.getMonth();
       var day2 = olddate.getDate();
       var hour2 = olddate.getHours();
       var minute2 = olddate.getMinutes();
       var second2 = olddate.getSeconds();
       if(month2<10) month2 = '0'+month2;
       if(day2<10) day2 = '0'+day2;
       if(hour2<10) hour2 = '0'+hour2;
       if(minute2<10) minute2 = '0'+minute2;
       if(second2<10) second2 = '0'+second2;
       var date2 = 
            year2
            +'-'+month2
            +'-'+day2
            +' '+hour2
            +':'+minute2
            +':'+second2;
    

      if(date1>date2)
      {
         diffInMilliseconds = 0;
      }
      else
      {
         var date1 = new Date(date1).getTime('en-US', options);
          var date2 = new Date(date2).getTime('en-US', options); 
          var diffInMilliseconds = date2 - date1;       
          var diffInSeconds = diffInMilliseconds / 1000;
          var diffInMinutes = diffInMilliseconds / (1000 * 60);
          var diffInHours = diffInMilliseconds / (1000 * 60 * 60);
          var diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);
          // console.log(`Difference in milliseconds: ${diffInMilliseconds}`);
          // console.log(`Difference in seconds: ${diffInSeconds}`);
          // console.log(`Difference in minutes: ${diffInMinutes}`);
          // console.log(`Difference in hours: ${diffInHours}`);
          // console.log(`Difference in days: ${diffInDays}`);
      }
      return msToTime_new(diffInMilliseconds);
   }
   


   var session_id = 0;
   var game_id = 1;
   var iddd = 0;
   var duration = 0;
   var p_id = '';
   var stop_betting_after = 0;
   var start_date_time = '';
   var end_date_time = '';
   var type = 0;
   var session_start_date_time = '';
   var session_end_date_time = '';
   var bet_end_date_time = '';
   var bell_before_date_time = '';

    
 

  


const timerElement = document.getElementById("wheel-status");

$(document).on("click", ".get_about_to_win",(function(e) {
   get_about_to_win();
}));
$(document).on("click", ".submit-manual",(function(e) {
   $("#resultdeclaremodal").modal("show");
   $(".select-color-before").html($(".numbers.active").parent().html());
}));
$(document).on("click", ".submit-manual-confirm",(function(e) {
   e.preventDefault();
   
   update(ref(db, '/'), {'L1':String("s")});
   update(ref(db, '/'), {'F1':String("Runing :"+p_id)});

   startWheel()
   stopWheel();


   // let timeLeft = 15;
   // const countdown = setInterval(() => {
   //       timeLeft--;
   //       // timerElement.textContent = timeLeft;
   //       timerElement.textContent = "Wheel Runing...";

   //       if (timeLeft <= 0) {
   //           clearInterval(countdown);
   //          update(ref(db, '/'), {'L1':String(p_id)});
   //       }
   // }, 1000);

   // declareResult();

   

}));

function declareResult() {
   $.ajax({
      url:"<?=base_url('admin/game_manual/declare_result') ?>",
      type:"post",
      data:{p_id:p_id,session_id:session_id,game_id:game_id},
      success:function(d)
      {
         
         // console.log(d);
         if($("#timer_checkbox:checked").val()==1) start_timer();
         var timefirebase =  Date.now();
         timerdataupdate(1,timefirebase);
         $("#resultdeclaremodal").modal("hide");
         update(ref(db, '/'), {'F1':String("Declare :"+p_id)});
         timerElement.textContent = "";

      },
      error: function(e) 
      {
      }
   });
}




$(document).on("click", ".stop-timer",(function(e) {
   $("#stoptimermodal").modal("show");
}));
$(document).on("click", ".stop-confirm",(function(e) {
   var stopdatetime = $("#stopdatetime").val();
   var stopmessage = $("#stopmessage").val();

   $.ajax({
      url:"<?=base_url('admin/game_manual/stop_game') ?>",
      type:"post",
      data:{game_id:game_id,stopdatetime:stopdatetime,stopmessage:stopmessage},
      success:function(d)
      {
         // console.log(d);
         $("#stopform")[0].reset();
         // live_session_id()
      },
      error: function(e) 
      {
      } 
   }); 
   $("#stoptimermodal").modal("hide");
}));



$(document).on("click", "#start-timer",(function(e) {
   e.preventDefault();
   $("#start-timer").attr("disabled",true);
   start_timer();          
}));
function start_timer()
{
   var id = 0;  
   $.ajax({
      url:"<?=base_url('admin/game_manual/start_game') ?>",
      type:"post",
      dataType:"json",
      data:{id:id},
      success:function(d)
      {
         // console.log(d);
         if(d.status==200)
         {
            $("#start-timer").attr("disabled",false);
            live_session_id();

            var timefirebase =  Date.now()
            timerdataupdate(1,timefirebase)
         }
         else
         {
            $("#start-timer").attr("disabled",false);
            $("#d-warning").modal('show');
         }
      },
      error: function(e) 
      {
      } 
   }); 
}


function live_session_id()
{
    var game_id = <?=$game_id ?>;
    var form = new FormData();
    form.append("game_id", game_id);
    form.append("session_id", "<?=$session_id ?>");
    var settings = {
      "url": "<?=base_url('admin/game_manual/live_session_id') ?>",
      "method": "POST",
      "dataType": "json",
      "timeout": 0,
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data":form
    };
    $.ajax(settings).done(function (response) {
      // console.log(response);
      var uri = "<?=base_url('admin/game_manual/index/') ?>"+response.session_id+"/<?=$game_id ?>";
      session_id = response.session_id;
      duration = response.duration;
      stop_betting_after = response.stop_betting_after;
      start_date_time = response.session_start_date_time;
      end_date_time = response.session_end_date_time;

      session_start_date_time = response.session_start_date_time
      session_end_date_time = response.session_end_date_time
      bet_end_date_time = response.bet_end_date_time
      bell_before_date_time = response.bell_before_date_time


      $("#start_date_time").html(start_date_time);
      $("#end_date_time").html(end_date_time);


      // all_bet_interval = setInterval(function() {
         get_about_to_win();                               
      //   }, 1000);


        if(response.result) p_id = response.result[1];
      if(response.game_status==1)
      {
         
         timer(duration);
         bell_timer(duration);
        //  timer2(stop_betting_after);
         $(".result-pending").hide();
      }
      else if(response.game_status==2)
      {
         $("#start-timer").attr("disabled",false);         
         $(".submit-manual").attr("disabled",true);
         $(".result-pending").hide();
      }
      else if(response.game_status==4)
      {
         if(response.result) p_id = response.result[1];
         $(".result-pending").show();
         $(".submit-manual").attr("disabled",false);
      }
      else
      {
         $(".result-pending").hide();
         $("#start-timer").attr("disabled",false);
      }
    });
}
live_session_id();


   iddd = iddd+1;
    type = 1;
    var win_number2 = 0;
    function next_uri(type)
    {
        var uri = "<?=base_url('admin/game_manual/index/') ?>"+iddd+'/'+game_id;
        if(type==2)
            window.location.href=uri;
    }
   
    function timer(duration,type)
    {
         var interval = setInterval(function() {

            var minute_hour = (get_duration(session_end_date_time));
            var newHour = minute_hour.hour
            var newMinute = minute_hour.minutes
            var newSeconds = minute_hour.seconds
            $("#mint-count").html(newMinute+":"+newSeconds);

            if(parseInt(newHour)<1 && parseInt(newMinute)<1 && parseInt(newSeconds)<1)
            {
               clearInterval(interval);
               live_session_id();
               $("#mint-count").html("done");
               $(".submit-manual").attr("disabled",false);
            }
            else
            {
               $("#start-timer").attr("disabled",true);
               $(".submit-manual").attr("disabled",true);
            }
            
        }, 1000);
    }
    function timer2(duration,type)
    {
         var interval2 = setInterval(function() {

            var minute_hour = (get_duration(bet_end_date_time));
            var newHour = minute_hour.hour
            var newMinute = minute_hour.minutes
            var newSeconds = minute_hour.seconds
            $("#mint-count2").html(newMinute+":"+newSeconds);
            if(parseInt(newHour)<1 && parseInt(newMinute)<1 && parseInt(newSeconds)<1)
            {
               clearInterval(interval2);
               $("#mint-count2").html("Over");               
            }
            else
            {
            }


            // var minute_hour = (get_duration(bell_before_date_time));
            // var newHour = minute_hour.hour
            // var newMinute = minute_hour.minutes
            // var newSeconds = minute_hour.seconds
            // if(parseInt(newHour)<1 && parseInt(newMinute)<1 && parseInt(newSeconds)<1)
            // {
            //    clearInterval(bellinterval2);
            //    console.log("sfasfs");
            // }

               playAudio();


            
        }, 1000);
    }
    function bell_timer(duration)
    {
        //  var bellinterval2 = setInterval(function() {

        //     var minute_hour = (get_duration(bell_before_date_time));
        //     var newHour = minute_hour.hour
        //     var newMinute = minute_hour.minutes
        //     var newSeconds = minute_hour.seconds
        //     $("#mint-count2").html(newMinute+":"+newSeconds);
        //     if(parseInt(newHour)<1 && parseInt(newMinute)<1 && parseInt(newSeconds)<1)
        //     {
        //        clearInterval(bellinterval2);
        //        // $("#mint-count2").html("Over");
        //        playAudio();
        //        console.log("sfasfs");
        //     }
        //     else
        //     {
        //     }
        //     // console.log(minute_hour);
            
        // }, 1000);
    }
    function get_about_to_win()
    {
        // $(".total_profit").html("Wait...");
        // $(".total_bet_amount").html("Wait...");
        // $(".have_to_pay").html("Wait...");        
        $.ajax({
            url:"<?=base_url('admin/game_manual/amount_detail') ?>",
            type:"post",
            data:{session_id:session_id,game_id:game_id,p_id:p_id},
            success:function(d)
            {
                var result_data = JSON.parse(d);
                // console.log(result_data);
                if(result_data.status==200)
                {
                  $('.numbers').removeClass("active");
                  var data = result_data.data;



                  $(".color-bet-amount1, .color-bet-amount2, .color-bet-amount3").html(price_format(0));
                  btn_card_function(data.about_to_pay_amount)
                  $(data.color_group_record).each(function(index , item){
                     var selected_inner_p_id = item.p_id;
                     $(".color-bet-amount"+selected_inner_p_id).html(price_format(item.bet_amount));
                  });

                  $(data.number_group_record).each(function(index , item){
                     var selected_inner_p_id = item.p_id;
                     $(".number-bet-amount"+selected_inner_p_id).html(price_format(item.bet_amount));
                  });




                  $(data.about_to_pay_amount).each(function(index , item){
                     var p_and_l = 0;
                     p_and_l = data.bet_total_amount-item.amount;
                     // p_and_l = item.amount;
                     if(p_and_l>1)
                     {
                        $(".my-"+item.p_id+"-p-and-l span").html('+'+price_format(p_and_l));
                     }
                     else
                     {
                        $(".my-"+item.p_id+"-p-and-l span").html(price_format(p_and_l));
                     }
                  });


                  

                  $(".number-"+data.win_numbers[1]).addClass('active');

                                        
                  $(".total_bet_amount").html(data.bet_total_amount);
                  $(".have_to_pay").html(data.win_total_amount);
                  $(".total_profit").html(data.profit_loss_amount);               


                }
            },
            error: function(e) 
            {
            } 
        });
    }

<?php if(empty($session_id)){ ?>
    $(document).on("click", ".numbers",(function(e) {
         $('.numbers').removeClass("active");
         $(this).addClass("active");
         p_id = $(this).data('p_id');
          get_about_to_win();
    }));
<?php } ?>

   
   function btn_card_function(data)
   {
      var btn_card = ``;
      var i = 0;
      var j = 0;
      while(j<=9)
      {
         if(data[j])
         {
            i = data[j].p_id;
         }
         var btnColor = '';
         if(j==0 || j==5) btn_card = btn_card+`<div class="col-12 mt-2" style="display: flex;justify-content: space-around;">`;

         if(i==1 || i==3 || i==7 || i==9) btnColor = 'black-bg';
         if(i==2 || i==4 || i==6 || i==8) btnColor = 'red-bg';
         if(i==0) btnColor = 'violet-red-bg';
         if(i==5) btnColor = 'violet-black-bg';
         btn_card = btn_card+`
            <div class="game-btn-button" data-pay="0">
               <button class="numbers number-${i} number-color-btn number-button ${btnColor}" data-p_id='${i}'>${i}</button>
               <!-- <p class="my-${i}-bet">Bet Amount: <span class="number-bet-amount0">₹ 0.00</span></p> -->
               <!-- <p class="my-${i}-have-to-pay">Have To Pay: <span class="number-have-to-pay-amount0">₹ 0.00</span></p> -->
               <p class="my-${i}-p-and-l"><!-- P & L: --> <span class="number-p-and-l-span0">₹ 0.00</span></p>
            </div>
         `;
         if(j==4 || j==9) btn_card = btn_card+ `</div>`;
         i++;
         j++;
      }
      $(".bet-btns").html(btn_card);
   }
    function timerdataupdate(status,datetime) {
          set(ref(db, 'timerdataupdate/' + 1), {
              status: status,
              dateTime: datetime,
              number: p_id,
          });

          set(ref(db, 'timerdataupdate/' + 2), {
              status: status,
              dateTime: datetime,
          });

          remove(ref(db, 'timerdataupdate/' + 2), {
              status: status,
              dateTime: datetime,
          });


          set(ref(db, 'wheel/' + 1), {
              status: 4,
              dateTime: datetime,
          });
          set(ref(db, 'wheel/' + 1), {
              status: p_id,
              dateTime: datetime,
          });         


        }
    function betStatus()
   {
      var  data = [];
      let starCountRef = ref(db, 'betStatus/1');
      onValue(starCountRef, (snapshot) => {
         data = snapshot.val();
         if(data.status==1)
         {
             get_about_to_win();  
         }
         else
         {
             
         }
      });
   }
   betStatus();
   
   function getTimerStatus()
    {
    var  data = [];
    let starCountRef = ref(db, 'timerdataupdate/1');
    onValue(starCountRef, (snapshot) => {
       data = snapshot.val();
       if(data.status==1)
       {
         live_session_id();
       }
    });
    }
    getTimerStatus();


    function getWellStopStatus()
    {
    var  data = [];
    let starCountRef = ref(db, '/F1');
    onValue(starCountRef, (snapshot) => {
         data = snapshot.val();
         if(data.split(":")[0]=="FeedBack ")
         {
           declareResult(); 
         }
    });
    }
    getWellStopStatus();

           

/* 🟢 CHANGE THIS to your server IP (same as ESP8266 uses) */
// const ws = new WebSocket("ws:localhost:3006");
const ws = new WebSocket("ws:145.223.18.56:3006");


let targetNumber = null;
let anytext = '';




// Start
function sendAnyText() {
  anytext = document.getElementById("anytext").value;
  sendMessage({ action: "anytext",text:anytext });
}

// Start
function startWheel() {
  targetNumber = p_id;
  sendMessage({ action: "anytext",text:'s' });
}

// Stop
function stopWheel() {
  if (targetNumber !== null) {
    sendMessage({ action: "anytext",text:targetNumber });
  }
}



// Send message helper
function sendMessage(obj) {
  ws.send(JSON.stringify(obj));
}

// WebSocket events
ws.onopen = () => {
  console.log("✅ Connected to server");
  document.getElementById("wheelstatus").innerText = "Status: Connected";
};

ws.onmessage = (event) => {
  try {
    const data = JSON.parse(event.data);
    if (data.status) {
      document.getElementById("wheelstatus").innerText = "Status: " + data.status;
    }
    
  } catch (err) {
    console.error("Invalid message:", event.data);
  }
};

ws.onclose = () => {
  document.getElementById("wheelstatus").innerText = "Status: Disconnected";
};


</script>











<?php  
$spinner = '<div class="spin-div"><i class="fa fa-spinner fa-spin" ></i></div>';
$table_id = 1; 

$date = date("Y-m-d");
$year = date("Y",strtotime($date));
$month = date("m",strtotime($date));
$day = date("d",strtotime($date));
if($month[0]==0)$month = $month[1];
if($day[0]==0)$day = $day[1];
$date = $year.'-'.$month.'-'.$day;



?>
      
         <!-- Main content -->
         <section class="content">
            <div class="container-fluid">
               <!-- Small boxes (Stat box) -->
               <div class="row">

                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <a href="<?=base_url(panel.'/user?type=1') ?>">
                        <!-- small box -->
                        <div class="small-box bg-success">
                           <div class="inner" style="padding: 5px 5px 5px 5px;">
                              <h3>
                                 <?php
                                 $where_query = " CONCAT(YEAR(users.date_time),'-',MONTH(users.date_time),'-',DAY(users.date_time))='$date' ";
                                 ?>
                                 <?=count($this->db->select('id')->where($where_query)->get_where("users",array("is_delete"=>0,"status"=>1,))->result_object()) ?>
                              </h3>
                              <p>Today Users</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                           </div>
                           <a href="<?=base_url(panel.'/user?type=1') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </a>

                  </div>
                  <!-- ./col -->

                  <div class="col-lg-3 col-6">
                     <a href="<?=base_url(panel.'/user?type=2') ?>">
                        <!-- small box -->
                        <div class="small-box bg-info">
                           <div class="inner" style="padding: 5px 5px 5px 5px;">
                              <h3>
                                 <?php

                                 echo count($this->db->select('id')->get_where("users",array("is_delete"=>0,"status"=>1,))->result_object()) ?>
                              </h3>
                              <p>Approved Users</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-bag"></i>
                           </div>
                           <a href="<?=base_url(panel.'/user?type=2') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </a>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <a href="<?=base_url(panel.'/user?type=3') ?>" >
                        <!-- small box -->
                        <div class="small-box bg-warning">
                           <div class="inner" style="padding: 5px 5px 5px 5px;">
                              <h3>
                                  <?=count($this->db->select('id')->get_where("users",array("is_delete"=>0,"status"=>0,))->result_object()) ?>
                              </h3>
                              <p>Un-Approved Users</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-person-add"></i>
                           </div>
                           <a href="<?=base_url(panel.'/user?type=3') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </a>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <a href="<?=base_url(panel.'/recharge?type=1') ?>">
                        <!-- small box -->
                        <div class="small-box bg-success">
                           <div class="inner" style="padding: 5px 5px 5px 5px;">
                              <h3>
                                 <?=count($this->db->select('id')->get_where("recharge_request",array("is_delete"=>0,"status"=>0,))->result_object()) ?>
                                 <sup style="font-size: 20px">₹</sup>
                              </h3>
                              <p>Total Diposit Request</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                           </div>
                           <a href="<?=base_url(panel.'/recharge?type=1') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </a>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                     <a href="<?=base_url(panel.'/withdraw?type=3') ?>">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                           <div class="inner" style="padding: 5px 5px 5px 5px;">
                              <h3>
                                 <?=count($this->db->select('id')->get_where("withdraw_request",array("is_delete"=>0,"status"=>0,))->result_object()) ?>
                              </h3>
                              <p>Total Withdraw Request</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                           </div>
                           <a href="<?=base_url(panel.'/withdraw?type=3') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </a>
                  </div>
                  <!-- ./col -->
               </div>
               <!-- /.row -->
              
               </div>
               <!-- /.container-fluid -->
         </section>
         <!-- /.content -->

