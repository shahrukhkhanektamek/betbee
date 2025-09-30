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
       padding: 8px 27px;
       border: 1px solid white;
       margin-bottom: 4px;
   }
   .text-secondary {
    color: rgb(255 255 255) !important;

}
.withdraw-card-round.active {
    /* box-shadow: 3px 3px 2px rgb(255 255 255 / 67%); */
    border: 6px solid green;
    border-radius: 5px;
}
.withdraw-card-round {
    margin: 0 0 15px 0;
    background: white;
    text-align: center;
    border-radius: 5px;
    padding: 5px 0 5px 0;
}
.withdraw-card-round input {
    display: none;
}
</style>


         <main class="adminuiux-content has-sidebar" onclick="contentClick()">
            <div class="container-fluid mt-2">
               <div class="bg-theme-1-subtle rounded px-2 py-2">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item bi"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active bi" aria-current="page">Withdraw</li>
                     </ol>
                  </nav>
               </div>
            </div>
            <div class="container mt-3" id="main-content">
               <div class="text-center mb-3">
                  <p class="h4 mb-0">Withdraw</p>
               </div>
               <div class="row gx-3 justify-content-center">
                  

                  <form id="WithdrawForm" method="post" action="<?=base_url('api/user/withdraw_request') ?>" novalidate class=" newpass front_form_data">
                     <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="row gx-3">
                           <div class="col-12 col-md-6">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-coin"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="Enter Amount:" name="amount" required="" class="form-control amount-val"> <label>Enter Amount:</label></div>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="col-3 col-md-6">
                              <label class="row withdraw-card-round active">
                                  <input type="radio" name="type" class="pay_type" value="1" checked="">
                                  <img src="<?=base_url() ?>assets/gpay.webp" class="img-fluid">
                              </label>
                           </div>
                           <div class="col-3 col-md-6">
                              <label class="row withdraw-card-round">
                                  <input type="radio" name="type" class="pay_type" value="2">
                                  <img src="<?=base_url() ?>assets/phonepe.webp">
                              </label>
                           </div>

                           <div class="col-3 col-md-6">
                              <label class="row withdraw-card-round">
                                  <input type="radio" class="pay_type" name="type" value="3">
                                  <img src="<?=base_url() ?>assets/paytm.png">
                              </label>
                           </div>

                           <div class="col-3 col-md-6">
                              <label class="row withdraw-card-round">
                                  <input type="radio" class="pay_type" name="type" value="4">
                                  <img src="<?=base_url() ?>assets/bank.png">
                              </label>
                           </div>

                           <div class="row align-items-center mb-2"><div class="col"><hr class=""></div><div class="col-auto"></div><div class="col"><hr class=""></div></div>


                           <div class="col-12 col-md-6 gpay_number ">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-ticket"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="G-Pay Number/UPI ID:"  required="" class="form-control amount-val" name="gpay_number"> <label>G-Pay Number/UPI ID:</label></div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-12 col-md-6 phonepe_number ">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-ticket"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="PhonePe Number/UPI ID"  required="" class="form-control amount-val" name="phonepe_number"> <label>PhonePe Number/UPI ID</label></div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-12 col-md-6 paytm_number ">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-ticket"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="PayTm Number/UPI ID"  required="" class="form-control amount-val" name="paytm_number"> <label>PayTm Number/UPI ID</label></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-md-6 bank_detail  ">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-ticket"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="Account Number"  required="" class="form-control amount-val" name="account_number"> <label>Account Number</label></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-md-6 bank_detail  ">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-ticket"></i></span>
                                    <div class="form-floating"><input type="number" placeholder="IFSC"  required="" class="form-control amount-val" name="ifsc"> <label>IFSC</label></div>
                                 </div>
                              </div>
                           </div>



                           <div class="col-12 col-md-6 bank_detail  holder_name  ">
                              <div class="form-group mb-3 position-relative check-valid">
                                 <div class="input-group input-group-lg">
                                    <span class="input-group-text text-theme-1"><i class="bi bi-ticket"></i></span>
                                    <div class="form-floating"><input type="text" placeholder="A/C Holder Name"  required="" class="form-control amount-val" name="holder_name"> <label>A/C Holder Name</label></div>
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                        <div class="text-center">
                           <button type="submit" class="btn btn-theme">Submit</button>
                        </div>
                     </div>
                  </form>





               </div>

               <div class="mt-5">


                  <ul class="history"></ul>
                  <button class="btn btn-danger mt-3 mb-3 history-view-more" style="margin: 0 auto;display: block;">View More</button>

               </div>




            <?php include('include/menubar.php'); ?>
               
                <?php include('include/allscript.php'); ?>
            </div>
         </main>
      </div>
      
   </body>
</html>

<script>
    $(document).on("click", ".withdraw-card-round",(function(e) {
        $(".withdraw-card-round").removeClass("active");
        $(this).addClass("active");
        pay_type();
   })); 

    function pay_type()
    {
        var pay_type = $(".pay_type:checked").val();
        $(".holder_name,.gpay_number,.paytm_number, .phonepe_number, .bank_detail").hide();
        $(".gpay_number input, .holder_name input, .phonepe_number input, .paytm_number input, .bank_detail input").attr("required",false);
        if(pay_type==1)
        {
            $(".gpay_number").show();
            $(".holder_name").show();
            $(".gpay_number input, .holder_name input").attr("required",true);
        }
        if(pay_type==2)
        {
            $(".phonepe_number").show();
            $(".holder_name").show();
            $(".phonepe_number input, .holder_name input").attr("required",true);
        }
        if(pay_type==3)
        {
            $(".paytm_number").show();
            $(".holder_name").show();
            $(".paytm_number input, .holder_name input").attr("required",true);
        }
        if(pay_type==4)
        {
            $(".holder_name").show();
            $(".bank_detail").show();
            $(".bank_detail input, .holder_name input").attr("required",true);
        }
    }
    pay_type();  
</script>
<script>
    
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
          "url": "<?=base_url('api/user/withdraw_history') ?>",
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
