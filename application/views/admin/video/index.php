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
<!-- <link rel="stylesheet" href="<?=base_url('agora/') ?>css.css"> -->
<style>
.player {
    width: 100%;
    height: 300px;
}


.logout-button {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 99999999999999999999;
    font-size: 30px;
    color: red;
}
.video-button {
    position: fixed;
    bottom: 0;
    z-index: 99999999999999;
/*    background: white;*/
    left: 0;
    display: block;
    width: 100%;
    padding: 10px 0;
}
.video-div {
    position: fixed;
    top: 0;
    height: 100%;
    left: 0;
    z-index: 9999;
    padding: 0;
    background: white;
    width: 100%;
}
#remote-playerlist {
    height: 100%;
}
#remote-playerlist, .player, div:has(.player)
{
    height: 100%;
}
.player-name {
    display: none;
}



.player {
    width: 100% !important;
    height: 100% !important;
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
                        <h3 class="card-title">Live Screen</h3>
                     </div>
                     <div class="card-body">
                        <div class="row">


                          
                           
                           <div class="col-lg-12 col-md-12 text-center">
                                






                                <form id="join-form">
                                  <div class="row join-info-group">
                                      <div class="col-sm">
                                        <p class="join-info-text">AppID</p>
                                        <input id="appid" type="text" placeholder="enter appid" required value="<?=agora_appid ?>">
                                        <p class="tips">If you don`t know what is your appid, checkout <a href="https://docs.agora.io/en/Agora%20Platform/terms?platform=All%20Platforms#a-nameappidaapp-id">this</a></p>
                                      </div>
                                      <div class="col-sm">
                                        <p class="join-info-text">Token(optional)</p>
                                        <input id="token" type="text" placeholder="enter token">
                                        <p class="tips">If you don`t know what is your token, checkout <a href="https://docs.agora.io/en/Agora%20Platform/terms?platform=All%20Platforms#a-namekeyadynamic-key">this</a></p>
                                      </div>
                                      <div class="col-sm">
                                        <p class="join-info-text">Channel</p>
                                        <input id="channel" type="text" placeholder="enter channel name" required value="<?=agorachannel ?>">
                                        <p class="tips">If you don`t know what is your channel, checkout <a href="https://docs.agora.io/en/Agora%20Platform/terms?platform=All%20Platforms#channel">this</a></p>
                                      </div>
                                  </div>

                                  <div class="button-group">
                                    <button id="join" type="submit" class="btn btn-primary btn-sm">Join</button>
                                    <button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Leave</button>
                                  </div>
                                </form>

                                




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



<div class="col-md-61 video-div" style="margin:0 auto;display: block;">
    <a class="nav-link logout-button" href="<?=base_url('admin/auth/logout') ?>" role="button">
        <i class="fas fa-power-off"></i>
    </a>
    
    <p id="local-player-name" class="player-name"></p>
    <div id="local-player" class="player"></div>
    <div id="remote-playerlist"></div>

    <div class="row video-button" style="text-align: center;">
        <!-- <select id="camera-list"></select> -->
        <button id="start-video" class="btn btn-primary">Start</button>
        <button id="stop-video" class="btn btn-danger">Stop</button>
    </div>

</div>

<script>const role_type = 'host';</script>

<script src="<?=base_url('assetsadmin') ?>/videoadmin/AgoraRTC_N-4.22.0.js"></script>
<script src="<?=base_url('assetsadmin') ?>/videoadmin/index.js"></script>



<script>

</script>

<script type="module">
	 import { firebaseConfig} from '<?=base_url() ?>firebase.js';
	 import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
	 import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-analytics.js";
	 import { getDatabase, ref, set, child, update, remove, onValue  } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-database.js";
	 const app = initializeApp(firebaseConfig);
	 const analytics = getAnalytics(app);
	 const db = getDatabase();









videoStatusUpdate(0,Date.now())
// Host join
$("#stop-video").click(function (e) {
   videoStatusUpdate(0,Date.now())
});
$("#start-video").click(function (e) {
   get_channel_detail();
});
function get_channel_detail()
{
   $(".loader").addClass("active");
   $.ajax({
       url:"<?=base_url('admin/video/start_video') ?>",
       type:"post",
       data:{ids:'',},
       dataType:"json",
       success:function(d)
       {
            console.log(d);
            if(d.status==200)
             {
               // options.token = d.data.token;
               $("#token").val(d.data.token);
                // console.log(options.token);
               $("#join").trigger('click');
             }
         $(".loader").removeClass("active");
       },
       error: function(e)
       {
         $(".loader").removeClass("active");
         // console.log(e);
         // exit;
       }
   });
}






	 
	 
	function videoStatus()
	{
		var  data = [];
		let starCountRef = ref(db, 'videoStatus/1');
		onValue(starCountRef, (snapshot) => {
		   data = snapshot.val();
		   if(data.status==1)
		   {		       
		       join();
		       options.role = "host";
               $("#join").trigger('click');		       
		   }
		   else
		   {
               $("#leave").trigger('click');
		   }
		});
	}
	videoStatus();
	
	
	function videoStatusUpdate(status,datetime) {
        set(ref(db, 'videoStatus/' + 1), {
            status: status,
            dateTime: datetime,
        });
    }
   
	 
	 
</script>

<script>


</script>
