<div class="toaster"></div>

<link rel="stylesheet" href="<?=base_url() ?>assets/cdnjs.cloudflare.com/ajax/libs/highlight.js/11.10.0/styles/base16/circus.min.css">
<script src="<?=base_url() ?>assets/cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<!-- <script>document.querySelectorAll(".code").forEach((e=>{hljs.highlightElement(e)}))</script> -->
<script src="<?=base_url() ?>assets/js/clinic/clinic-auth.js"></script>
<!-- <script src="<?=base_url() ?>assets/js/clinic/clinic-dashboard.js"></script> -->
<script src="<?=base_url() ?>assets/js/clinic/clinic-schedule-grid.js"></script>



<script>

    
   function toaster(message, type) 
   {
     var toaster = $('.toaster');
     toaster.html(message);
     toaster.addClass(type);
     toaster.fadeIn(500);
     setTimeout(function() {
       toaster.fadeOut(500);
     }, 3000);
   }



</script>



<script>


    function check_login()
    {
      var token = localStorage.getItem('token');
      if(token)
      {
        $.ajax({
            url:'<?=base_url() ?>/api/auth/check_login',
            type:"post",
            data:{token:token},
            success: function(result)
              {
                var result = JSON.parse(result);
                console.log(result);
                if(result.status==200)
                {
                    // window.location.href=result.url;
                }
              },
              error: function(e) 
              {
                console.log(e)  
                
              } 
        });
      }
      else
      {

      }
    }

   var href = '';
   // $(document).on("click", "a",(function(e) {
   //      event.preventDefault();
   //      href = $(this).attr('href');

   //      if($(this).data("share")!=undefined)
   //      {
   //          window.location=href;
   //      }
   //      else
   //      {
   //        window.location=href;          
   //      }
   // }));
   $(document).on("click", ".link",(function(e) {
        event.preventDefault();
        href = $(this).data('href');    
        window.location=href;
   }));

   
   function change_page()
   {
      if(href==undefined || href=='#' || href=='javascript:void(0);')
      {
         return false;
      }
      $(".preload").show(); 
      var full_url = href;
      var full_url_array = full_url.split('device_id');
      var full_url_qs_array = full_url.split('?');
      if(full_url_array.length==1)
      {
         if(full_url_qs_array.length==1)
            full_url = full_url+"?device_id="+device_id;
         else
            full_url = full_url+"&device_id="+device_id;
      }
      var full_url = full_url;


      var check_api_url = full_url.split("<?=base_url('api/') ?>");
      if(check_api_url.length==1)
      {
          var full_url_array = full_url.split("<?=base_url(user_app) ?>");
          if(full_url_array.length==1)
          {
            full_url = "<?=base_url(user_app) ?>"+full_url_array[0];
          }
          else
          {
            full_url = "<?=base_url(user_app) ?>"+full_url_array[1];
          }
      }
      // console.log(full_url);
      window.location.href=full_url;
   }


    document.addEventListener('touchstart', handleTouchStart, false);        
   document.addEventListener('touchmove', handleTouchMove, false);

   var xDown = null;                                                        
   var yDown = null;

   function getTouches(evt) {
     return evt.touches ||             // browser API
            evt.originalEvent.touches; // jQuery
   }                                                     
                                                                            
   function handleTouchStart(evt) {
       const firstTouch = getTouches(evt)[0];                                      
       xDown = firstTouch.clientX;                                      
       yDown = firstTouch.clientY;                                      
   }; 
   function top_0_refrash()
   {
      var top = document.documentElement.scrollTop || document.body.scrollTop;
      if(top==0)
      {
         $(".preload").show(); 
         // location.reload();
      }
   }                                               
                                                                            
   function handleTouchMove(evt) {
       if ( ! xDown || ! yDown ) {
           return;
       }

       var xUp = evt.touches[0].clientX;                                    
       var yUp = evt.touches[0].clientY;

       var xDiff = xDown - xUp;
       var yDiff = yDown - yUp;
                                                                            
       if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
           if ( xDiff > 0 ) {
               /* right swipe */ 
           } else {
               /* left swipe */
           }                       
       } else {
           if ( yDiff > 0 ) {
           } else { 
               /* up swipe */
               top_0_refrash();
           }                                                                 
       }
       /* reset values */
       xDown = null;
       yDown = null;                                             
   };

</script>


<script type="module">
    import { firebaseConfig} from '<?=base_url() ?>firebase.js';
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-analytics.js";
    import { getDatabase, ref, set, child, update, remove, onValue  } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-database.js";
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    const db = getDatabase();


    

</script>

