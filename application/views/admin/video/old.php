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
<link rel="stylesheet" href="<?=base_url('agora/') ?>css.css">
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
                                 <form id="join-form" name="join-form" >
                                    <input id="appid" type="text" placeholder="Enter AppID" required class="form-control" value="<?=agora_appid ?>" style="display:none;">
                                    <input id="channel" type="text" placeholder="Enter Channel Name" required class="form-control" value="<?=agorachannel ?>"  style="display:none;">
                                    <input id="accountName" type="text" placeholder="Enter Your Name" required class="form-control" value="Admin"  style="display:none;">
                                    <div class="video-button">
                                        <button id="host-join" type="submit" class="btn btn-live btn-sm" style="display:none;"  ></button>
                                        <button id="audience-join" type="submit" class="btn btn-live btn-sm"  style="display:none;">Join as Audience</button>
                                                       
                                        <button id="start-video" type="button" class="btn-sm btn btn-success"  >Connect</button>
                                        <button id="leave" type="button" class="btn btn-danger btn-sm" style="    background-color: #dc3545;" disabled  >Stop Video</button>
                                    </div>
                              </form>
                              <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
                              <!-- <script src="<?=base_url('agora/') ?>js.js"></script> -->
                              <script>//$("#audience-join").trigger("click");</script>                              
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



<div class="col-md-61 video-div" style="margin:0 auto;">
    <a class="nav-link logout-button" href="<?=base_url('admin/auth/logout') ?>" role="button">
        <i class="fas fa-power-off"></i>
    </a>
    
    <!-- <div id="local-player-name"></div> -->
    <div id="local-player" class="player"></div>
    <!-- <div id="remote-playerlist"></div> -->
</div>





<script type="module">
     import { firebaseConfig} from '<?=base_url() ?>firebase.js';
     import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
     import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-analytics.js";
     import { getDatabase, ref, set, child, update, remove, onValue  } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-database.js";
     const app = initializeApp(firebaseConfig);
     const analytics = getAnalytics(app);
     const db = getDatabase();
   // create Agora client
var client = AgoraRTC.createClient({
    mode: "live",
    codec: "vp8"
});

// RTM Global Vars
var isLoggedIn = false;

var localTracks = {
    videoTrack: null,
    audioTrack: null
};
var remoteUsers = {};
// Agora client options
var options = {
    appid: $("#appid").val(),
    channel: null,
    uid: null,
    token: null,
    accountName: null,
    role: "audience"
};

// Host join
$("#host-join").click(function (e) {
    // join();
    options.role = "host";
    var timefirebase =  Date.now()
    videoStatusUpdate(1,timefirebase);
    // videoStatus();
})


// Audience join
$("#audience-join").click(function (e) {
    join();
    options.role = "audience";
})

// Join form submission
$("#join-form").submit(async function (e) {
    e.preventDefault();
    // $("#host-join").attr("disabled", true);
    // $("#audience-join").attr("disabled", true);
    try {
        options.appid = $("#appid").val();
        // options.token = '007eJxTYOg7fDSo8fUiM5NVnO9YJBLNUxV1ajSOnG09rFFs7R5Qa6nAkGSSaGRgYmhqYWFmbmJuYmppnppkbJKSlpKUZJFqYplo2GiT1hDIyLBg2wFGRgZGBhYgBvGZwCQzmGQBk2wMSaklSampDAwA+cYgaQ==';
        options.channel = "betbee";
        options.accountName = $('#accountName').val();
        await join();
    } catch (error) {
        // console.error(error);
    } finally {
        $("#leave").attr("disabled", false);
    }
})

// Leave click
$("#leave").click(function (e) {
    leave();
    var timefirebase =  Date.now()
    videoStatusUpdate(0,timefirebase);
})

async function join() {
    options.role = "host";
    // create Agora client
    client.setClientRole(options.role);
    if (options.role === "audience") {
        // add event listener to play remote tracks when remote user publishs.
        client.on("user-published", handleUserPublished);
        client.on("user-joined", handleUserJoined);
        client.on("user-left", handleUserLeft);
    }
    // join the channel
    options.uid = await client.join(options.appid, options.channel, options.token || null);
    
    if (options.role === "host") {
        client.on("user-published", handleUserPublished);
        client.on("user-joined", handleUserJoined);
        client.on("user-left", handleUserLeft);










        // create local audio and video tracks
        // localTracks.audioTrack = await AgoraRTC.createMicrophoneAudioTrack();
        localTracks.videoTrack = await AgoraRTC.createCameraVideoTrack();
        // alert(options.uid);
        // play local video track
        localTracks.videoTrack.play("local-player");
        
            
            
        $("#local-player-name").text(`localTrack(${options.uid})`);
        // publish local tracks to channel
        await client.publish(Object.values(localTracks));
        // console.log("Successfully published.");
        
    }
    
}

// Leave
async function leave() {
    // location.reload();
   
            localTracks.audioTrack.stop();
            localTracks.videoTrack.close();
            
      
    // remove remote users and player views
    remoteUsers = {};
    $("#remote-playerlist").html("");
    // leave the channel
    await client.leave();
    $("#local-player-name").text("");
    // $("#host-join").attr("disabled", false);
    // $("#audience-join").attr("disabled", false);
    // $("#leave").attr("disabled", true);
    // location.reload();
    // console.log("Client successfully left channel.");
}

// Subscribe to a remote user
async function subscribe(user, mediaType) {
    const uid = user.uid;
    await client.subscribe(user, mediaType);
    // console.log("Successfully subscribed.");
    if (mediaType === 'video') {
        const player = $(`
      <div id="player-wrapper-${uid}">
        <p class="player-name">remoteUser(${uid})</p>
        <div id="player-${uid}" class="player"></div>
      </div>
    `);
        $("#remote-playerlist").append(player);
        user.videoTrack.play(`player-${uid}`);
    }
    if (mediaType === 'audio') {
        user.audioTrack.play();
    }
}

// Handle user published
function handleUserPublished(user, mediaType) {
    const id = user.uid;
    remoteUsers[id] = user;
    subscribe(user, mediaType);
}

// Handle user joined
function handleUserJoined(user, mediaType) {
    const id = user.uid;
    remoteUsers[id] = user;
    console.log(user);
    subscribe(user, mediaType);
}

// Handle user left
function handleUserLeft(user) {
    const id = user.uid;
    delete remoteUsers[id];
    $(`#player-wrapper-${id}`).remove();
}



// Host join
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
               options.token = d.data.token;
                // options.token = '007eJxTYNB6L9i85fK7g1e4PTOvvV5n/9vkseD9Z7kGShETrO/V2EYrMCSZJBoZmBiaWliYmZuYm5hamqcmGZukpKUkJVmkmlgmLlH2TmsIZGSo/36ClZGBkYEFiEGACUwyg0kWMMnGkJRakpSayshgAAAzdiD5';
                // console.log(options.token);
               $("#host-join").trigger('click');
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
               // $("#host-join").trigger('click');
              console.log(data.status)
              // $("#leave").attr("disabled", true);
               
           }
           else
           {
               leave();
              // $("#leave").attr("disabled", false);
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
