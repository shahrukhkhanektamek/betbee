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
#shareModal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    z-index: 1000;
}

#shareModal h3 {
    margin-top: 0;
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
    font-size: 18px;
    color: #333;
    text-align: center;
}

#shareModal a {
    display: block;
    margin-bottom: 10px;
    padding: 10px;
    text-decoration: none;
    text-align: center;
    font-family: Arial, sans-serif;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    color: #333;
    transition: background-color 0.3s, color 0.3s;
}

#shareModal a:hover {
    background-color: #e2e2e2;
    color: #000;
}

#shareModal button {
    display: block;
    width: 100%;
    padding: 10px;
    font-family: Arial, sans-serif;
    font-size: 16px;
    background-color: #ff6666;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#shareModal button:hover {
    background-color: #ff4c4c;
}

#modalOverlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}
.refer-body{
    padding: 5px 10px;
    border: 1px solid white;
    margin-bottom: 4px;
}
</style>
         <main class="adminuiux-content has-sidebar" onclick="contentClick()">
            
            <div class="container mt-3" id="main-content">
               <div class="text-center mb-3">
                  <p class="h4 mb-0">My Referral URL and Tree</p>
               </div>
               <div class="card adminuiux-card mt-3 mb-3">
                  <div class="row gx-3">
                     <div class="col-6 col-lg-6 col-xxl-3 mb-3">
                        <div class="card adminuiux-card">
                           <div class="card-body">
                              <div class="row gx-2 gx-sm-3 align-items-center">
                                 <div class="col">
                                    <p class="h4 mb-0">
                                    <?php  
                                        $total = $this->db->select_sum("amount")->get_where("user_history",array("user_id"=>$full_detail->id,"type2"=>6,))->result_object();
                                        if(!empty($total[0]->amount)) $total_amount = $total[0]->amount;
                                        else $total_amount = 0;
                                    ?>
                                        <?=price_formate($total_amount) ?></p>
                                    <p class="text-secondary small">Total Contribution</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-6 col-lg-6 col-xxl-3 mb-3">
                        <div class="card adminuiux-card">
                           <div class="card-body">
                              <div class="row gx-2 gx-sm-3 align-items-center">
                                 <div class="col">
                                    <p class="h4 mb-0"><i class="bi bi-person-badge fs-4 text-info-emphasis"></i> <?php  
                                           $total = $this->db->select('id')->where(array("referral_id"=>$full_detail->user_id,))->get_where("users")->num_rows();
                                           ?>
                                           <?=$total ?></p>
                                    <p class="text-secondary small">Total People</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <p id="referralUrl" style="display: none;"><?=base_url() ?>app/user/register?referral_id=<?=$full_detail->user_id ?></p>

                  <div class="col-12 col-lg-12 mb-3">
                       <div class="card adminuiux-card">
                           <div class="card-body">
                              <div class="row gx-2 gx-sm-3 align-items-center">
                                 <div class="col-12" style="display: flex; justify-content: space-between;">
                                     <a href="javascript:void(0);" id="copyLink">Copy Invitation Link</a>
                                     <i class="bi bi-back" style="cursor: pointer;"></i>
                                 </div>  
                                 <div class="col-12 mt-3" style="display: flex; justify-content: space-between;">
                                     <a href="javascript:void(0);" id="shareLink">Share Invitation Link :</a>
                                     <i class="bi bi-share" style="cursor: pointer;"></i>
                                 </div>                                
                              </div>
                           </div>
                       </div>
                       
                   </div>






                   <div class="col-12">
                      <ul class="history">
                      </ul>
                      <button class="btn btn-danger mt-3 mb-3 history-view-more" style="margin: 0 auto;display: block;">View More</button>
                      
                  </div>



               </div>
            </div>
         </main>
      </div>
      
  <?php include('include/menubar.php'); ?>
  <?php include('include/allscript.php'); ?>


<div id="modalOverlay"></div>
  <div id="shareModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
    <h3>Share on</h3>
    <a href="#" id="facebookShare" target="_blank">Facebook</a><br>
    <a href="#" id="twitterShare" target="_blank">Twitter</a><br>
    <a href="#" id="instagramShare" target="_blank">Instagram</a><br>
    <a href="#" id="whatsappShare" target="_blank">Whatsapp</a><br>
    <button id="closeModal">Close</button>
</div>








<script>
    


    $(document).on("click",".share-button",(function(){
        $(".share-modal").toggle();
    })); 
    $(document).on("click",".share-button-close",(function(){
            $(".share-modal").hide();
    }));


    var page = 0;
    var type = 0;
    var api_data_div = 'history';
    var click_btn = '.history-view-more';
    function plan_list()
    {
        $(".ajax-loader").addClass("show");
        $(click_btn).attr("disabled",true);
        $(".sweet-loader").addClass("show");
        var form = new FormData();
        form.append("page", page);
        form.append("use_type", type);

        var settings = {
          "url": "<?=base_url('api/user/my_referral') ?>",
          "method": "POST",
          "processData": false,
          "mimeType": "multipart/form-data",
          "headers": {
                "token": sessionStorage.getItem("token")
              },
          "contentType": false,
          "dataType":"json",
          "data": form
        };
        $.ajax(settings).done(function (response) {
          console.log(response);
          $(".ajax-loader").removeClass("show");


          $(click_btn).attr("disabled",false);
          if(response.status==200)
          {
            if(page==0)
                $('.'+api_data_div).html(response.data);
            else
                $("."+api_data_div+"").append(response.data);
            $(".card-loader-img-div").removeClass("card-loader-img-div");
            $(".card-loader").remove();
            page++;
            $(click_btn).show();
          }
          else
          {
            $(click_btn).hide();
            // if(page==0)
            // $('.'+api_data_div).html('<li style="color: white;text-align: center;background: darkred;width: 100%;">Data not found...</li>');
            print_toast(response.message);
          }
        });
    }
    plan_list();
    $(document).on("click", ".history-view-more",(function(e) {
        click_btn = $(this);
        plan_list();
    }));


</script>

<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  print_toast("Copy Successfuly...")
}
</script>









<script>
 
        $('#copyLink').on('click', function() {
            var referralUrl = $('#referralUrl').text();
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(referralUrl).select();
            document.execCommand('copy');
            tempInput.remove();
            toaster("Invitation link copied: ", 'success');
        });
    
 
    var referralUrl = $('#referralUrl').text();
    $('#shareLink').on('click', function() {
        $('#shareModal').show();
        $('#modalOverlay').show();
        $('#facebookShare').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(referralUrl));
        $('#twitterShare').attr('href', 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(referralUrl));
        $('#instagramShare').attr('href', 'https://www.instagram.com/?url=' + encodeURIComponent(referralUrl));
        $('#whatsappShare').attr('href', 'https://wa.me/?text='+encodeURIComponent(referralUrl));
    });
    $('#closeModal').on('click', function() {
        $('#shareModal').hide();
        $('#modalOverlay').hide();
    });
    $('#modalOverlay').on('click', function() {
        $('#shareModal').hide();
        $('#modalOverlay').hide();
    });


</script>

   </body>
</html>
