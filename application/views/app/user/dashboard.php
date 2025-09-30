<?php
$currenturl = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!doctype html>
<html lang="en">
   <head>
      <?php include('include/allcss.php'); ?>
   </head>
   
   <body class="main-bg main-bg-opac main-bg-blur overflow-hidden">
      
      <?php // include('include/topheader.php'); ?>




<style>

.adminuiux-sidebar .adminuiux-sidebar-inner
{
   background: black;
}

   .number-boxs {
       z-index: 9;
        padding: 15px 10px !important;
        margin-bottom: 5px !important;
        margin-top: 0;
        display: flex;
        justify-content: center;
        overflow-y: auto;
    }

   .number-color{
        padding: 0;
        border-radius: 50%;
        border: 1px solid white;
        font-size: 10px;
        margin-right: 5px;
        width: 24px !important;
        height: 24px;
        text-align: center;
        align-items: center;
        display: inline-grid
    ;
   }
</style>

<style>
   .remote-playerlist {
       position: fixed !important;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background-color: white;
       z-index: 1;
       padding: 0;
   }
</style>

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
main {
    position: fixed;
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

.number-box {
   position: fixed;
   z-index: 2;
   padding: 0 0 0 0;
   bottom: 0px;
   height: 100%;
}

.adminuiux-card {
    height: 100%;
    /* align-items: center; */
    padding: 0 10px;
/*    background: rgba(0,0,0,0.5);*/
    background: linear-gradient(180deg, #00000000 33%, #000000 60%);
    padding: 30px 15px;
    position: fixed;
    width: 100%;
    z-index: 2;
}




.undo img {
    width: 100%;
}
.undo {
    border: 0;
    background: black;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    padding: 10px;
}
.my-table, .my-table td {
    border: 1px solid white;
}

.join-red-btn, .join-black-btn, .join-violet-btn, .number-color-btn {
   width: 60px;
   height: 35px;
   border: 0;
   border-radius: 5px;
/*   box-shadow: 1px 2px 5px -1px #ffffff47;*/
   border: 1px solid;
   position: relative;
}


.join-red-btn {
   background: #FA1414;
}
.join-black-btn {
    background: #000000;
/*    border: 1px solid white;*/
}
.join-violet-btn {
    background: #8C3BBD;
}


.coin-selection-inner-single img {
    max-width: 50px;
}
.coin10, .coin20, .coin50, .coin100, .coin500, .coin1000 {
    display: none;
    transition: all 0.5s;
    z-index: 9999999;
}

.active.coin-selection-inner-single:before {
    content: '';
    position: fixed;
    background: rgb(0 0 0 / 50%);
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    z-index: 99999;
}
.coin-selection-inner-single.active .coin10 {
    display: block;
    position: absolute;
    left: -85px;
    top: 0;
    transition: all 0.5s;
}
.coin-selection-inner-single.active .coin20 {
    display: block;
    position: absolute;
    left: -60px;
    top: -60px;
    transition: all 0.5s;
}
.coin-selection-inner-single.active .coin50 {
    display: block;
    position: absolute;
    left: -10px;
    top: -110px;
    transition: all 0.5s;
}
.coin-selection-inner-single.active .coin100 {
    display: block;
    position: absolute;
    right: -10px;
    top: -110px;
    transition: all 0.5s;
}
.coin-selection-inner-single.active .coin500 {
    display: block;
    position: absolute;
    right: -60px;
    top: -60px;
    transition: all 0.5s;
}
.coin-selection-inner-single.active .coin1000 {
    display: block;
    position: absolute;
    right: -85px;
    top: 0;
    transition: all 0.5s;
}
video {
    height: 100%;
    width: 100%;
}
.select-amount.selected {
    /* box-shadow: 0px 0px 8px rgb(255 255 255 / 50%); */
    border-radius: 50%;
    border: 1px solid white;
    padding: 1px;
}
.game-btn-button p {
    text-align: center;
    margin-top: 3px;
    font-size: 10px;
}
.game-btn-button {
    margin-top: 5px;
}



.adminuiux-content{
    display: block;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
}
.top-number-series {
    position: fixed;
    top: 0px;
    left: 0;
    width: 150%;
    z-index: 3;
    overflow-x: auto;
    padding: 5px 10px;
}
body, html {
    overflow: hidden;
}



.betting-secton.wait {
    /* transform: scale(0.5); */
    bottom: 0;
    background: black;
    z-index: 1;
}
.betting-secton {
    transition: all 1s;
    bottom: 60px;
    position: fixed;
    left: 0;
}
.betting-secton.wait:before {
    content: '';
    position: absolute;
    background: #00000070;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.bottom-text p {
    font-size: 12px;
    margin: 0 !important;
}
.bottom-text #wallet-amount {
    font-size: 12px;
}
.bottom-text .deposit-button {
    font-size: 12px;
}


.betting-secton.wait .coin-bet-section {
    display: none;
}

</style>







    <div class="adminuiux-wrap">

        <?php include('include/sidebar.php'); ?>

        <div class="box-no top-number-series"></div>


        <div class="sppinser-timer">
            <span id="mint-count">Will be live Soon</span>
        </div>

        <div class="col-12 col-lg-12 remote-playerlist">







            <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Viewer - Video Only</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
      background: black;
    }
    #root {
      width: 100vw;
      height: 100vh;
    }
    video {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 99;
}
#ZegoRoomFooter {
    display: none;
}
  


.betting-secton.wait .enimate-coin {
  top: calc(var(--top, 0px) + 60px);
      display: none;
}



.result-modal.show {display: block;}
.result-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 99999;
    display: none;
}
.result-modal-body {
    text-align: center;
    padding: 20px 20px;
    height: 250px;
    display: grid;
    width: 100%;
    align-items: center;
}
.result-modal-result .number-color {
    width: 100px !important;
    height: 100px !important;
    font-size: 50px;
}
.result-win p, .result-lose p {
    margin: 0;
    text-transform: uppercase;
}
.result-win h2, .result-lose h2 {
    font-size: 45px;
    font-weight: bold;
    color: gold;
}
.result-win, .result-lose{
    display: none;
}
.result-modal.show.win .result-win{display: block;}
.result-modal.show.lose .result-lose{display: block;}




</style>

</head>
<body>
  <div id="root"></div>

  <script src="https://unpkg.com/@zegocloud/zego-uikit-prebuilt/zego-uikit-prebuilt.js"></script>
  <script>
    window.onload = function () {
      const urlParams = new URLSearchParams(window.location.search);
      const roomID = urlParams.get('roomID') || "demoRoom";

      const userID = "viewer_" + Math.floor(Math.random() * 10000);
      const userName = "Viewer_" + userID;

      const appID = 906988945;
      const serverSecret = "4a901db0f6009cc505f7697aefa38dec";

      const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(
        appID,
        serverSecret,
        roomID,
        userID,
        userName
      );

      const zp = ZegoUIKitPrebuilt.create(kitToken);

      zp.joinRoom({
        container: document.getElementById("root"),
        scenario: {
          mode: ZegoUIKitPrebuilt.LiveStreaming,
          config: {
            role: ZegoUIKitPrebuilt.Audience,
          },
        },

        // Permissions
        turnOnCameraWhenJoining: false,
        turnOnMicrophoneWhenJoining: false,

        // Remove all UI elements
        showPreJoinView: false,
        showTextChat: false,
        showUserList: false,
        showLayoutButton: false,
        showScreenSharingButton: false,
        showAudioVideoSettingsButton: false,
        showLeaveRoomButton: false,
        showRoomTimer: false,
        showMicrophoneToggleButton: false,
        showCameraToggleButton: false,
        showMyCameraToggleButton: false,
        showSoundWaveInRoom: false,
        showRoomDetailsButton: false,
      });
    };
  </script>
</body>
</html>








            <!-- <video autoplay muted loop><source src="video.mp4" type="video/mp4"></video> -->
        </div>


        <div class="adminuiux-card ">
            
            <div class="col-12" style="position: absolute;left: 0;bottom: 0;padding: 15px;padding-bottom: 5px;">

                <div class="betting-secton">
                    <div class="row">
                        <div class="col-4 text-center">
                           <div class="game-btn-button">
                              <button class="join-black join-black-btn color-button" data-p_id="1"></button>
                              <p class="my-black-bet color-bet-amount1">₹ 0.00</p>
                           </div>
                        </div>
                        <div class="col-4 text-center">
                           <div class="game-btn-button">
                              <button class="join-violet join-violet-btn color-button" data-p_id="2"></button>
                              <p class="my-blue-bet color-bet-amount2">₹ 0.00</p>
                           </div>
                        </div>
                        <div class="col-4 text-center">
                           <div class="game-btn-button">
                              <button class="join-red join-red-btn color-button" data-p_id="3"></button>
                              <p class="my-red-bet color-bet-amount3">₹ 0.00</p>
                           </div>
                        </div>
                        

                        <div class="col-12 mt-0" style="display: flex;justify-content: space-around;">
                              
                           <div class="game-btn-button">
                              <button class="number-0 number-color-btn number-button violet-red-bg" data-p_id='0'>0</button>
                              <p class="number-bet-amount0 my-0-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-1 number-color-btn number-button black-bg" data-p_id='1'>1</button>
                              <p class="number-bet-amount1 my-1-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-2 number-color-btn number-button red-bg" data-p_id='2'>2</button>
                              <p class="number-bet-amount2 my-2-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-3 number-color-btn number-button black-bg" data-p_id='3'>3</button>
                              <p class="number-bet-amount3 my-3-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-4 number-color-btn number-button red-bg" data-p_id='4'>4</button>
                              <p class="number-bet-amount4 my-4-bet">₹ 0.00</p>
                           </div>
                        </div>

                        <div class="col-12 mt-0" style="display: flex;justify-content: space-around;">
                           <div class="game-btn-button">
                              <button class="number-5 number-color-btn number-button violet-black-bg" data-p_id='5'>5</button>
                              <p class="number-bet-amount5 my-5-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-6 number-color-btn number-button red-bg" data-p_id='6'>6</button>
                              <p class="number-bet-amount6 my-6-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-7 number-color-btn number-button black-bg" data-p_id='7'>7</button>
                              <p class="number-bet-amount7 my-7-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-8 number-color-btn number-button red-bg" data-p_id='8'>8</button>
                              <p class="number-bet-amount8 my-8-bet">₹ 0.00</p>
                           </div>
                           <div class="game-btn-button">
                              <button class="number-9 number-color-btn number-button black-bg" data-p_id='9'>9</button>
                              <p class="number-bet-amount9 my-9-bet">₹ 0.00</p>
                           </div>
                        </div>
                    </div>

                    <div class="row mt-2 coin-bet-section">
                        <div class="col-4 mb-2" style="text-align: right;">
                           <button class=" undo"><img src="<?=base_url() ?>assets/undo.png"></button>
                        </div>
                        <div class="col-4">
                           <span class="coin-selection">
                                 <span class="coin-selection-inner-single" style="text-align: center;display: block;    position: relative;">
                                 <img src="<?=base_url() ?>assets/coins/10.png" class="select-amount-open">
                                 <img src="<?=base_url() ?>assets/coins/10.png" class="select-amount coin10" data-amount="10">
                                 <img src="<?=base_url() ?>assets/coins/20.png" class="select-amount coin20" data-amount="20">
                                 <img src="<?=base_url() ?>assets/coins/50.png" class="select-amount coin50" data-amount="50">
                                 <img src="<?=base_url() ?>assets/coins/100.png" class="select-amount coin100" data-amount="100">
                                 <img src="<?=base_url() ?>assets/coins/500.png" class="select-amount coin500" data-amount="500">
                                 <img src="<?=base_url() ?>assets/coins/1000.png" class="select-amount coin1000" data-amount="1000">
                              </span>
                           </span>                     
                        </div>
                        <div class="col-4">
                           <button class=" undo"><img src="<?=base_url() ?>assets/undo.png"></button>
                        </div>                           
                    </div>
                </div>


                <div class="row bottom-text">
                    <div class="col-6" style="align-items: center;display: grid;">
                       <p class="" style="margin-bottom: -8px !important;">Total Bet:- <span class="betting-amount">₹ 0.00</span></p>
                       <p class="" style="margin-bottom: -8px !important;">Last Win:- <span class="last-win-amount">₹ 0.00</span></p>
                       <p class="">Period ID:- <span class="session-id">0000</span></p>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <div>
                            <button class="btn btn-danger rule-btn open-rule-modal"><i class="bi bi-bar-chart-line-fill"></i></button>
                        </div>
                        <div style="margin-top: 4px;">
                            <span id="wallet-amount">₹ 00.00</span>
                            <a href="deposite.php" class="btn btn-success deposit-button" style="padding: 0 5px;">Deposit <i class="bi bi-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>



         
    </div>
      


<!-- lose modal end -->
<div class="custom-modal rule-modal">
    <div class="modal-inner" style="background: #000000;">
        <span class="custom-modal-close">x</span>
        <div class="row m-0">
            <h2 class="text-center">{RULES}</h2>
            <p>This is a live colour game<br>
                All players can participate betting in (RED,BLACK and VIOLET) <br><br>
                <b>FOR EXAMPLE- </b><br>
            <ul style="margin: 0 0 0 15px;">
                <li>-If you bet 100₹ on Black and if the result shows Black then you win(X2) 100X2-200₹ net profit 200-100= 100₹<br><br></li>
                <li>- If you bet 100₹ on Red and if the result shows Red then you win(X2) 100X2-200₹ net profit 200-100= 100₹<br><br></li>
                <li>- If you bet 100₹ on Violet and if the result shows Violet then you win(X5) 100X5-500₹ net profit 500-100= 400₹</li>
            </ul>
            </p>
        </div>
    </div>
</div>



<div class="result-modal">
    <div class="result-modal-body">
        <div class="result-modal-result">
            <span class="number-color violet-red-bg-round">0</span>
        </div>
        <div class="result-win">
            <p>You Win</p>
            <h2>₹ 200</h2>
        </div>
        <div class="result-lose">
            <p>You Lose</p>            
        </div>
    </div>
</div>



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
              +'T'+hour
              +':'+minute
              +':'+second.toString();
           
    
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
              +'T'+hour2
              +':'+minute2
              +':'+second2.toString();
    
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
        }
        return msToTime_new(diffInMilliseconds);
     }
     function timer(duration,type)
      {
          var interval = setInterval(function() {    
            var minute_hour = (get_duration(session_end_date_time));            
            var newHour = minute_hour.hour
            var newMinute = minute_hour.minutes
            var newSeconds = minute_hour.seconds
            $("#mint-count").html(newMinute+":"+newSeconds);    
            if(newHour<1 && newMinute<1 && newSeconds<1)
            {
               clearInterval(interval);
               $("#mint-count").html("Result Pending");
               $(".network").show();
            }
            else
            {
               $(".network").hide();
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
            if(newHour<1 && newMinute<1 && newSeconds<1)
            {
               clearInterval(interval2);
               $("#mint-count2").html("Over");
               $(".betting-secton").addClass("wait");
               $(".sppinser-inner-div").addClass("result-time");  
               $('.spinner-image').addClass("fa-spin");
               clearInterval(all_bet_interval);

                $('.enimate-coin').each(function() {
                    let currentTop = parseFloat($(this).css('top'));
                    if (!isNaN(currentTop)) {
                        $(this).css('top', (currentTop + 60) + 'px');
                    }
                });

            }
            else
            {                
                  $(".betting-secton").removeClass("wait");               
                  $(".sppinser-inner-div").removeClass("result-time");  
                  $('.spinner-image').removeClass("fa-spin");
            }
         }, 1000);
      }





   var color = '';
   var img ='';
   var coin ='';
   var last_coin  = '';
   var selected_button  = '';
   var leftm ='';
   var righttm  = '';
   var all_coins  = '';
   var classs = '';
   var bottomm ='';
   var session_id = 0;
   var user_id = 0;
   var duration = 0;
   var stop_betting_after = 0;
   var amount = 0;
   var coinId = 0;
   var final_amount = 10;
   var selected_color = 0;
   var selected_p_id = 0;
   var game_id = 1;
   var all_bet_interval = 1;
   var bet_status = 0;
   var user_id = '<?=$full_detail->id ?>';
   var p_id = 0;
   var wallet_amount = <?=$full_detail->wallet ?>;
   var progressbaarspeed = 0;
   var session_start_date_time = '';
   var session_end_date_time = '';
   var bet_end_date_time = '';
   var game_status = '';
   var p_id_select_type = '';
   var local_bets = [];





   $(document).on('click',".select-amount-open",function (e) {
      $(".coin-selection-inner-single").addClass('active');
   });
   $(document).on('click',".select-amount",function (e) {
      $('.select-amount').removeClass('selected');
      $(this).addClass('selected');
      amount = $(this).data('amount');
      final_amount = amount;
      $('.amount-print').html(final_amount);
      $(".coin-selection-inner-single").removeClass('active');          
      $(".select-amount-open").attr("src",$(this).attr("src"));
   });
   $(document).on('click',".active.coin-selection-inner-single",function (e) {
      $(".coin-selection-inner-single").removeClass('active');        
   });
   $(document).on("click",".open-rule-modal",(function(e){
      $(".rule-modal").show();
   }));
   $(document).on("click",".custom-modal-close",(function(){
      $(".rule-modal").hide();
   }));
   $(document).on('click',".undo",function (e) {    
        undo_api()    
   });


   $(document).on('click',".color-button",function (e) {
      selected_button = $(this);
      $('.color-button').removeClass('selected');
      $(this).addClass('selected');
      p_id_select_type = 1;
      selected_p_id = $(this).data('p_id');
      $('.do-bet').show();
      $('.number-button').removeClass('selected');
      do_bet();
   });
    
   $(document).on('click',".number-button",function (e) {
      $('.number-button').removeClass('selected');
      $(this).addClass('selected');      
      p_id_select_type = 2;
      selected_p_id = $(this).data('p_id');
      $('.do-bet').show();
      $('.color-button').removeClass('selected');
      do_bet();
   });

   $(document).on('click',".betting-secton.wait",function (e) {
      print_toast('Wait for next round');
   });
    
   $(document).on('click',".select-amount-open",function (e) {
      $(".coin-selection-inner-single").addClass('active');
   });


   function set_new()
   {
        selected_p_id = 0;
        $('.color-button, .number-button').removeClass('selected');   
        $(".do-bet").hide();

        var l_data = localStorage.getItem('l_data');
        if(l_data)
        {
            l_data = JSON.parse(l_data);
            if(l_data.length>0)
            {
                var secid = parseInt(l_data[0].session_id);
                var gaid = parseInt(l_data[0].game_id);
                if(session_id!=secid)
                {
                    localStorage.removeItem('l_data');
                }                
            }
        }
   }
   $(document).on('click',".do-bet",function (e) {
      do_bet();
   });
   function main_api()
    {
        var screen_size = window.innerWidth;
        var form = new FormData();
    form.append("game_id", game_id);
    form.append("screen_size", screen_size);
    
    var settings = {
      "url": "<?=base_url() ?>api/game/detail",
      "method": "POST",
      "timeout": 0,
      "headers": {
           "token": localStorage.getItem("token")
         },   
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "dataType":"json",
      "data": form
    };
    
    $.ajax(settings).done(function (response) {
      console.log(response);
      var data = response.data;
      var winner_data = data.winner_data[0];
      var last_win_ticket = response.data.last_win_ticket;
      session_id = data.session_id;
      user_id = data.user_id;
      duration = data.duration;
      stop_betting_after = data.stop_betting_after;
      session_start_date_time = data.session_start_date_time
      session_end_date_time = data.session_end_date_time
      bet_end_date_time = data.bet_end_date_time
      if(data.old_betting_amount>0) bet_status = 1;
      game_status = data.game_status;

        
    $(".session-id").text(session_id);
      $(".betting-amount").html('₹ 0.00');
    
      if(winner_data.user_id==user_id)
      {
      //    win_modal_show(winner_data);
      }
      else
      {
      //    lose_modal_show(winner_data);
      }
      if(duration<1)
      {
           //main_api();
      }    
    
      if(data.game_status==1)
      {
          timer(duration);
          timer2(stop_betting_after);
          // all_bet();
      }
      else if(data.game_status==2)
      {
        $("#mint-count").html("Will be live Soon");
      }
      else if(data.game_status==3)
      {    
            // var countDownDate = new Date(data.stop_date_time).getTime();
            // var x = setInterval(function() {
            //    var now = new Date().getTime();
            //    var distance = countDownDate - now;
            //    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            //    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            //    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            //    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            //    document.getElementById("stoptimerdiv").innerHTML = days + "D " + hours + "H "+ minutes + "M " + seconds + "S ";
            //    if (distance < 0) {
            //      clearInterval(x);
            //      document.getElementById("stoptimerdiv").innerHTML = "EXPIRED";
            //    }
            // }, 1000);
            // $("#stoptimer").addClass("active");          
      }
      else if(data.game_status==5)
      {
          $("#stoptimer").removeClass("active");
      }
      else
      {
          $("#mint-count").html("Result Pending");
      }
       
       $("#wallet-amount").html(response.wallet_amt);
       wallet_amount = response.wallet_amt_string;
    
      
       $('.all_bet_div').html('');
       $(".enimate-coin").remove();

       $(".my-black-bet, .my-blue-bet, .my-red-bet, .my-0-bet, .my-1-bet, .my-2-bet, .my-3-bet, .my-4-bet, .my-5-bet, .my-6-bet, .my-7-bet, .my-8-bet, .my-9-bet").html("₹ 0.00");
       

       clearInterval(all_bet_interval);
    
    
       var html = '';
       var all_bet_amt = 0;
       $(last_win_ticket).each(function(index, item){

            var color1 = item.result.split(',')[0];
            var number1 = item.result.split(',')[1];
            classs = '';
            
            if(number1==0) classs = 'violet-red-bg-round';
            else if(number1==5) classs = 'violet-black-bg-round';
            else if(number1==1 || number1==3 || number1==7 || number1==9) classs = 'black-bg';
            else if(number1==2 || number1==4 || number1==6 || number1==8) classs = 'red-bg';

            html = html+`<span class="number-color ${classs}" >${number1}</span>`;

        });


        $(".top-number-series").html(html);
           
           set_new();
           if(game_status==1 || game_status==4)
           {
                set_selected_bets(data.game_bets);

                var set_selected_colors_arr = localStorage.getItem('l_data');
                if(!set_selected_colors_arr) set_selected_colors_arr = [];
                else set_selected_colors_arr = JSON.parse(set_selected_colors_arr);

                set_selected_colors(set_selected_colors_arr);


                $(".betting-amount").html(price_format(data.betting_amount));
           }
           $(".last-win-amount").html(price_format(data.last_win_amount));

    
        });
    }

    

   function set_selected_bets(data)
   {        
        $(data).each(function(index , item){

            var selected_inner_p_id = item.p_id;
            var selected_inner_type = item.p_type;
            if(selected_inner_type==1)
            {
                $(".color-bet-amount"+selected_inner_p_id).html(price_format(item.bet_amount));
            }
            else if(selected_inner_type==2)
            {
                $(".number-bet-amount"+selected_inner_p_id).html(price_format(item.bet_amount));
            }         

       });   
   }
   function set_selected_colors(data)
   {    
        var  offset2 = $('.coin-selection-inner-single').offset();
        $(data).each(function(index , item){  



        var selected_inner_p_id = item.p_id;
        var selected_inner_type = item.type;

         var coin = document.createElement('span');
         img =`<span class="coininn">
                  <img src="<?=base_url() ?>assets/coins/coin.png">
                  <span class="coin-amt">
                     <span class="coin-amt2">
                        `+item.amount+`</span>
                     </span>
               </span>`;
         coin.innerHTML = img;

            if(selected_inner_type==1)
            {
                if(selected_inner_p_id==1)
                {
                    var bt = $('.join-black');                    
                }
                if(selected_inner_p_id==2)
                {
                    var bt = $('.join-violet');                   
                }
                if(selected_inner_p_id==3)
                {
                    var bt = $('.join-red');                    
                }
            }
            else if(selected_inner_type==2)
            {
                if(selected_inner_p_id==0)
                {
                    var bt = $('.number-0');                    
                }
                else if(selected_inner_p_id==1)
                {
                    var bt = $('.number-1');                    
                }
                else if(selected_inner_p_id==2)
                {
                    var bt = $('.number-2');                    
                }
                else if(selected_inner_p_id==3)
                {
                    var bt = $('.number-3');
                }
                else if(selected_inner_p_id==4)
                {
                    var bt = $('.number-4');
                }
                else if(selected_inner_p_id==5)
                {
                    var bt = $('.number-5');
                }
                else if(selected_inner_p_id==6)
                {
                    var bt = $('.number-6');
                }
                else if(selected_inner_p_id==7)
                {
                    var bt = $('.number-7');
                }
                else if(selected_inner_p_id==8)
                {
                    var bt = $('.number-8');
                }
                else if(selected_inner_p_id==9)
                {
                    var bt = $('.number-9');
                }
            }


            var offset = $(bt).offset();
            $(coin).addClass('enimate-coin coinId'+coinId);
            var tt = Math.floor(Math.random() * 21) + 2;
            var ll = Math.floor(Math.random() * 21) + 1;
            var t2 = offset2.top-offset.top;
            $(coin).css({top: ''+offset2.top+'px',left: '48%'});
            $(bt).append(coin);
            $(coin).show(0);
            var tt = offset.top-Math.floor(Math.random() * 22) + 10;
            var ll = offset.left-Math.floor(Math.random() * 22) + 30;
            $(coin).animate({top: ''+tt+'px',left: ''+ll+'px'}, 500);





            coinId++;

       });   


        // $('.enimate-coin').each(function() {
        //             let currentTop = parseFloat($(this).css('top'));
        //             if (!isNaN(currentTop)) {
        //                 $(this).css('top', (currentTop + 60) + 'px');
        //             }
        //             console.log(currentTop);
        //         });
   }





   function do_bet()
   {   
        if(final_amount<1)
        {
            print_toast("Select Amount");
            return false;
        }    
       p_id = selected_p_id;
       var form = new FormData();
       form.append("game_id", game_id);
       form.append("session_id", session_id);
       form.append("bet_amount", final_amount);
       form.append("p_id", p_id);
       form.append("type", p_id_select_type);
       
       var settings = {
         "url": "<?=base_url() ?>api/game/do_bet",
         "method": "POST",
         "timeout": 0,
         "headers": {
              "token": localStorage.getItem("token")
            },   
         "processData": false,
         "mimeType": "multipart/form-data",
         "contentType": false,
         "dataType":"json",
         "data": form
       };
    
      $.ajax(settings).done(function (response) {
      console.log(response);
      $("#preloader").removeClass("show");
      var data = response.data; 

      if(response.status==200)
      {
        $(".betting-amount").html(price_format(data.betting_amount));
        bet_status = 1;
        set_new();

        var l_data = localStorage.getItem('l_data');
        if(l_data) l_data = JSON.parse(l_data);
        else l_data = [];
        l_data.push({
            p_id:p_id,
            type:p_id_select_type,
            session_id:session_id,
            amount:final_amount,
            game_id:game_id,
            bet_insert_id:data.bet_insert_id
        });        
        localStorage.setItem("l_data",JSON.stringify(l_data));



        set_selected_bets(data.game_bets);
        
        var tdata = [];
        tdata.push({amount:final_amount,p_id:p_id,type:p_id_select_type});
        set_selected_colors(tdata);

        var timefirebase =  Date.now()
        betdataupdate(1,timefirebase)
      }
      else
      {
        print_toast(response.message);
      }
      wallet_amount = response.wallet_amt_string;
      $("#wallet-amount").html(response.wallet_amt);
    
    
    });
   }



    function undo_api()
    {
        var l_data = localStorage.getItem('l_data');
        if(l_data)
        {
            l_data = JSON.parse(l_data);

            if(l_data.length<1) return false;

            var lindex = l_data.length - 1
            var lastElement = l_data[lindex];
            var l_data2 = lastElement;
        }





        var form = new FormData();
        form.append("game_id", game_id);
        form.append("session_id", session_id);
        form.append("bet_insert_id", lastElement.bet_insert_id);
        form.append("amount", lastElement.amount);
        
        var settings = {
          "url": "<?=base_url() ?>api/game/undo",
          "method": "POST",
          "timeout": 0,
          "headers": {
               "token": localStorage.getItem("token")
             },   
          "processData": false,
          "mimeType": "multipart/form-data",
          "contentType": false,
          "dataType":"json",
          "data": form
        };
        
        $.ajax(settings).done(function (response) {
          console.log(response);
          $("#preloader").removeClass("show");
          var data = response.data;
          // set_selected_bets(data.game_bets);


          if(response.status==200)
          {
                coinId--;

                bet_status = response.bet_status;
                all_coins = [];
                all_coins = $(".enimate-coin");
                
                // last_coin = all_coins[all_coins.length-1];
                last_coin = $(".coinId"+coinId);
                var last_coin_parent = $(last_coin).parent().parent();
                var price = $(last_coin_parent).find('p').text();                
                let pAmount = Math.round(parseFloat(price.replace(/[^0-9.]/g, "")));
                $(last_coin_parent).find('p').text(price_format(pAmount-lastElement.amount))
                
                if(last_coin!=undefined)
                {
                    var amm = parseInt($(last_coin).find('.coin-amt2').text());
                    if(amm<11) $(last_coin).remove();
                    else
                    {
                        $(last_coin).find('.coin-amt2').text(amm-lastElement.amount);
                    }
                }



                var timefirebase =  Date.now()
                betdataupdate(1,timefirebase)

                l_data.splice(lindex, 1);
                localStorage.setItem("l_data",JSON.stringify(l_data));


          }
          else
          {
              bet_status = response.bet_status;
          }
          
          wallet_amount = response.wallet_amt_string;
          $("#wallet-amount").html(response.wallet);
          $(".betting-amount").html(price_format(data.betting_amount));
        });
    }

// main_api();





function getTimerStatus()
{
    var  data = [];
    let starCountRef = ref(db, 'timerdataupdate/1');
    onValue(starCountRef, (snapshot) => {
       data = snapshot.val();
       if(data.status==1)
       {
            main_api();
       }
    });
}
getTimerStatus();

function betdataupdate(status,datetime) {
  set(ref(db, 'betStatus/' + 1), {
      status: status,
      dateTime: datetime,
  });
}

function win_lose_modal_status()
{
    var  data = [];
    let starCountRef = ref(db, 'timerdataupdate/2');
    onValue(starCountRef, (snapshot) => {
       data = snapshot.val();
       if(data)
       {
            // check_winner();
       }
    });
}
win_lose_modal_status();

function videoStatus()
{
    var  data = [];
    let starCountRef = ref(db, 'videoStatus/1');
    onValue(starCountRef, (snapshot) => {
       data = snapshot.val();
       if(data.status==1)
       {
            // get_channel_detail();
       }
       else
       {
       }
    });
}
videoStatus();




</script>


      
   </body>
</html>