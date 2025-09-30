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
      .player {
    width: 100%;
    height: 300px;
}
.player-name
{
    display:none;
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

                    <div class="col-md-6" style="margin:0 auto;">
                        <div id="remote-playerlist"></div> 
                    </div>
                           <div class="col-md-12">
                              <link rel="stylesheet" href="<?=base_url('agora/') ?>css.css">
                               <form id="join-form" name="join-form" class="mt-4" style="display:none;">           
                                        <input id="appid" type="text" placeholder="Enter AppID" required class="form-control" value="b4a204158867474597eb34dfdbb8e49a">
                                        <input id="channel" type="text" placeholder="Enter Channel Name" required class="form-control" value="betbee">                
                                        <input id="a_token" type="text" placeholder="Enter Channel Name"  class="form-control" value="">                
                                        <input id="accountName" type="text" placeholder="Enter Your Name" required class="form-control" value="test">               
                                        <button id="host-join" type="submit" class="btn btn-live btn-sm">Join as Host</button>
                                        <button id="audience-join" type="submit" class="btn btn-live btn-sm">Join as Audience</button>
                                        <button id="leave" type="button" class="btn btn-live btn-sm" disabled>Leave</button>            
                                </form>
                                  
                        	    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
                        	    <script src="https://cdn.jsdelivr.net/npm/agora-rtm-sdk@1.3.1/index.js"></script>
                        	    <script src="<?=base_url('agora/') ?>jsadmin.js"></script>
                        	    <script>get_channel_detail();</script>
                              <script>//$("#audience-join").trigger("click");</script>                                 
                           </div>
                           
                           <div class="col-lg-12 col-md-12 text-center">
                                 
                                <button class="btn btn-success mt-3" id="start-video">Start Video</button>
                                <button class="btn btn-danger mt-3" id="stop-video">Stop Video</button>
                              
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

<script type="module">
	 import { firebaseConfig} from '<?=base_url() ?>firebase.js';
	 import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
	 import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-analytics.js";
	 import { getDatabase, ref, set, child, update, remove, onValue  } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-database.js";
	 const app = initializeApp(firebaseConfig);
	 const analytics = getAnalytics(app);
	 const db = getDatabase();
	 
	 
	
    $("#start-video").click(function (e) {
        var timefirebase =  Date.now()
        videoStatusUpdate(1,timefirebase);
        
    });
    $("#stop-video").click(function (e) {
        var timefirebase =  Date.now()
        videoStatusUpdate(0,timefirebase);
        
    });

     
     
	 function videoStatusUpdate(status,datetime) {
        set(ref(db, 'videoStatus/' + 1), {
            status: status,
            dateTime: datetime,
        });
    }

</script>
