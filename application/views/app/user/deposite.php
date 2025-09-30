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
            <div class="container-fluid mt-2">
               <div class="bg-theme-1-subtle rounded px-2 py-2">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item bi"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active bi" aria-current="page">Diposit</li>
                     </ol>
                  </nav>
               </div>
            </div>
            <div class="container mt-3" id="main-content">
               <div class="text-center mb-3">
                  <p class="h4 mb-0">Diposit</p>
               </div>
               <div class="row gx-3 justify-content-center">

                  <div class="qr-code-div">
                     <?php 
                     $this->db->order_by('id', 'RANDOM');
                     $sele = $this->db->limit(1)->get_where("qr_code",array("status"=>1,))->result_object();
                     foreach ($sele as $key => $value)
                     {
                         $image = 'default.jpg';
                         if(!empty($value->image))
                             if(json_decode($value->image))
                                 if(file_exists(FCPATH.'upload/'.json_decode($value->image)[0]->image_path))
                                     $image = json_decode($value->image)[0]->image_path;  
                     ?>
                         <img src="<?=base_url('upload/'.$image) ?>" class="img-thumbnail w-25" style="margin: 0 auto;display: block;background: white;">
                         <p class="text-center mt-2 text-white">1122334455@ybl</p>
                     <?php } ?>
                 </div>

                  <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                     

                     <form id="LoginForm1" method="post" action="<?=base_url('api/user/add_point_request') ?>" novalidate class="tf-form front_form_data">
                        <div class="row gx-3">
                           <div class="col-12 col-md-6">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-coin"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="Enter Amount:"  required="" class="form-control amount-val" name="amount"> <label>Enter Amount:</label></div>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="col-12 col-md-6">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-border-width"></i></span>
                                    <div class="form-floating">
                                       <input type="file" class="form-control amount-val upload_image" data-target=".user_profile_image" >
                                       <label>Screenshot:</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row align-items-center mb-2"><div class="col"><hr class=""></div><div class="col-auto"><p class="text-secondary">or </p></div><div class="col"><hr class=""></div></div>
                           <div class="col-12 col-md-6">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-ticket"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="transaction Number:"  class="form-control amount-val" name="txn_no"> <label>Transaction Number:</label></div>
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                        <div class="text-center">
                           <button type="submit" class="btn btn-theme">Diposit</button>
                        </div>
                     </form>



                  </div>
               </div>
<style>
.refer-body{
       padding: 8px 27px;
       border: 1px solid white;
       margin-bottom: 4px;
   }
   .text-secondary {
    color: rgb(255 255 255) !important;

}
</style>
               <div class="mt-5">
                  
                  <ul class="history"></ul>
                  <button class="btn btn-danger mt-3 mb-3 history-view-more" style="margin: 0 auto;display: block;">View More</button>

               </div>




            <?php include('include/menubar.php'); ?>
               
                <?php include('include/allscript.php'); ?>
            </div>
         </main>
      </div>





<script>
  $(".upload_image").on('change', function(){
     var files = [];
     var j=1;      
     for (var i = 0; i < this.files.length; i++)
     {
           if (this.files && this.files[i]) 
           {
               var reader = new FileReader();
               reader.onload = function (e) {                
               $("#screenshot").val(e.target.result);

                   j++;
               // console.log(e.target.result);
               }
               reader.readAsDataURL(this.files[i]);
           }
     }
  });
</script>



<script>
    var type = 0;
    var click_btn = '';
    $(document).on("click", ".pay-svg",(function(e) {
        type = $(this).data('type');
        click_btn = $(this);
        add_point_request();
    }));

    var page = 0;
    var type = 0;
    var api_data_div = 'history';
    var click_btn = '.history-view-more';
    function recharge_history()
    {
        $(".ajax-loader").addClass("show");
        $(click_btn).attr("disabled",true);
        $(".sweet-loader").addClass("show");
        var form = new FormData();
        form.append("page", page);
        form.append("use_type", type);

        var settings = {
          "url": "<?=base_url('api/user/recharge_history') ?>",
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
          // console.log(response);
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
    recharge_history();
    $(document).on("click", ".history-view-more",(function(e) {
        click_btn = $(this);
        recharge_history();
    }));
</script>




   </body>
</html>


