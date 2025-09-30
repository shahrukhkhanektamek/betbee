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
   .refer-body{
       padding: 5px 10px;
       border: 1px solid white;
       margin-bottom: 4px;
   }
   .text-secondary {
    color: rgb(255 255 255) !important;

}
</style>
         <main class="adminuiux-content has-sidebar" onclick="contentClick()">
            <div class="container-fluid mt-2">
               <div class="bg-theme-1-subtle rounded px-2 py-2">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item bi"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active bi" aria-current="page">Old Results</li>
                     </ol>
                  </nav>
               </div>
            </div>
            <div class="container mt-3" id="main-content">

               <ul class="history row" style="padding: 0;"></ul>
                              
            </div>






            <?php include('include/menubar.php'); ?>
            <?php include('include/allscript.php'); ?>
         </main>
      </div>
      


<script>
    
    var page = 0;
    var type = 0;
    var api_data_div = 'history';
    var click_btn = '.history-view-more';
    function plan_list()
    {
        $("#preloader").addClass("show");
        $(click_btn).attr("disabled",true);
        $(".sweet-loader").addClass("show");
        var form = new FormData();
        form.append("page", page);
        form.append("game_id", 1);
        form.append("use_type", type);

        var settings = {
          "url": "<?=base_url('api/user/old_result') ?>",
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



   </body>
</html>