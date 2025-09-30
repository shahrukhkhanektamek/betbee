<!doctype html>
<html lang="en">
   <head>
       <?php include('include/allcss.php'); ?>


<style>
   .user_image {
    margin: 0 auto;
    margin-top: 20px;
    position: relative;
}
.user_image img {
   border-radius: 50%;
   width: 100%;
}
.user_image i {
    position: absolute;
    bottom: 0;
    right: 20px;
    background: white;
    width: 30px;
    height: 30px;
    display: grid;
    align-items: center;
    text-align: center;
    color: black;
    border-radius: 50%;
    font-size: 20px;
}
</style>


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
                        <li class="breadcrumb-item active bi" aria-current="page">Profile Settings</li>
                     </ol>
                  </nav>
               </div>
            </div>
            <div class="container mt-3" id="main-content">
               <div class="text-center mb-3">
                  <p class="h4 mb-0"></p>
               </div>
               <div class="row gx-3 justify-content-center">
                  <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                     <div class="row h-100 align-items-center justify-content-center my-md-3">

<div class="row" style="text-align: center;">
         <div class="col-4 user_image open-avtar-modal">
            <img src="<?=($get_user['image']) ?>" alt="author-image" class="">
            <i class="bi bi-camera-fill"></i>
         </div>
         <a style="margin:5px 0;color: white;font-size: 18px;">(#<?=$full_detail->user_id ?>)</a>
      </div>


                           <div class="col-12 col-md-10 col-lg-8 col-xxl-6 login-box">
                              
                              <form id="LoginForm1" method="post" action="<?=base_url('api/user/update_profile') ?>" novalidate class="tf-form front_form_data">
                                 <div class="row">
                                    <div class="col">
                                       <div class="form-floating mb-3"><input class="form-control" id="namef" placeholder="Enter first name" name="name" value="<?=$full_detail->fname ?>" required> <label for="namef">First Name</label></div>
                                    </div>
                                 </div>
                                 <div class="input-group mb-3">
                                    <div class="form-floating maxwidth-100">
                                       <select class="form-select" id="code" aria-label="Country code">
                                          <option selected="selected" value="+91">+91</option>
                                       </select>
                                       <label for="code">Code</label>
                                    </div>
                                    <div class="form-floating"><input class="form-control" id="phonen" placeholder="Enter your phone number" name="mobile" required value="<?=$full_detail->mobile ?>"> <label for="phonen">Phone Number</label></div>
                                 </div>
                                 <button type="submit" class="btn btn-theme w-100">Update</button>
                              </form>
                              

                              
                           </div>
                        </div>
                     
                  </div>
               </div>
              
            </div>







<div class="custom-modal avtar-modal" style="background: black;">
      <div class="modal-inner" style="background: transparent;">
         <span class="custom-modal-close">x</span>
         <div class="row m-0">
            <?php 
            $avtars = $this->db->get_where("avtar",array("is_delete"=>0,"status"=>1,))->result_object();
            foreach ($avtars as $key => $value) {
               $image = '';
                     if(!empty($value->image))
                     if(json_decode($value->image))
                           if(file_exists(FCPATH.'upload/'.json_decode($value->image)[0]->image_path))
                              $image = json_decode($value->image)[0]->image_path;  
                        if(!empty($image)){
            ?>
               <div class="col-6">
                  <img src="<?=base_url('upload/'.$image) ?>" class="select-avtar" alt="author-image" data-id="<?=$value->id ?>">         
               </div>
            <?php }} ?>

            <div class="col-12">
               <button type="button" class="btn btn-theme w-100 submit-avtar" style="margin: 0 auto;display: block;">Update</button>
            </div>

         </div>
      </div>
   </div>








            <?php include('include/menubar.php'); ?>
            <?php include('include/allscript.php'); ?>
         </main>
      </div>
      




<script>
   var avtar_id = 0;
   $(document).on("click",".open-avtar-modal",(function(){
      $(".avtar-modal").show();
   }));
   $(document).on("click",".custom-modal-close",(function(){
      $(".avtar-modal").hide();
   }));
   $(document).on("click",".select-avtar",(function(){
      avtar_id = $(this).data('id');
      $(".select-avtar").removeClass("selected");
      $(this).addClass("selected");
   }));





   function submit_avtar()
    {
        $("#preloader").addClass("show");
        $(click_btn).attr("disabled",true);
        $(".sweet-loader").addClass("show");
        var form = new FormData();
        form.append("avtar_id", avtar_id);

        var settings = {
          "url": "<?=base_url('api/user/update_avtar') ?>",
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
          $("#preloader").removeClass("show");
          $(click_btn).attr("disabled",false);
          if(response.status==200)
          {
            $('.user_image img').attr("src",response.data.image);
            $(".avtar-modal").hide();
          }
          else
          {
          }
            print_toast(response.message);
        });
    }


    $(document).on("click", ".submit-avtar",(function(e) {
        click_btn = $(this);
        submit_avtar();
    }));




</script>






   </body>
</html>