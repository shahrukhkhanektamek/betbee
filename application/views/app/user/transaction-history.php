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
.period-id-div {
    display: block;
    width: 100%;
    text-align: center;
    color: black;
}
</style>
         <main class="adminuiux-content has-sidebar" onclick="contentClick()">
            <div class="container-fluid mt-2">
               <div class="bg-theme-1-subtle rounded px-2 py-2">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item bi"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active bi" aria-current="page">My Bets</li>
                     </ol>
                  </nav>
               </div>
            </div>
            <div class="container mt-3" id="main-content">

               <div class="row gx-3">
                  <div class="col-6 mb-3 text-center">
                     <div class="card adminuiux-card">
                        <div class="card-body">
                           <div class="row gx-2 gx-sm-3 align-items-center">
                              <div class="col">
                                 <p class="h4 mb-0">
                                     <?=price_formate($full_detail->wallet+$full_detail->win_amount) ?>
                                 </p>
                                 <p class="text-secondary ">Total Amount</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 mb-3 text-center">
                     <div class="card adminuiux-card">
                        <div class="card-body">
                           <div class="row gx-2 gx-sm-3 align-items-center">
                              <div class="col">
                                 <p class="h4 mb-0">
                                     <?=price_formate($full_detail->win_amount) ?>
                                 </p>
                                 <p class="text-secondary ">Total Win Amount</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
<style>
.pills-2 {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
}

.nav-item {
    flex: 0 0 auto;
}
.pills-2::-webkit-scrollbar {
    display: none;
}

.pills-2 .nav-link {
    margin-right: 6px;
    padding: 5px 6px;
}
.pills-2 .nav-link.active {
    background-color: #007bff;
    color: #fff;
}
.number-color {
    padding: 6px 11px;
    border-radius: 50%;
    border: 1px solid white;
    width: 40px;
    height: 40px;
    display: inline-block;
    margin-right: 5px;
    background: gray;
}
.custom-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999999999;
    padding: 50px 100px;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    border-radius: 0;
}
.custom-modal .modal-inner {
    border-radius: 10px;
    height: auto;
    margin-top: 15px;
}
.bets-body {
    text-align: center;
    align-items: center;
    width: 100%;
    justify-content: space-evenly;
}
.bets-body-inner {
    display: block;
    width: fit-content;
}
.bets-body-inner-bet {
    color: black;
}
.custom-modal-close {
    background: red;
    right: 30px;
    top: 10px;
}

@media(max-width:767px)
{
   .custom-modal {
      padding: 35px 35px;
   }
}
</style>
                  <div class="col-12 mb-3">
                     <ul class="nav nav-pills pills-2 mb-3 nav-tabs" id="pills-tab" role="tablist">
                        
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" data-type='0'>All</button>
                        </li>
                        
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-type='1'>Deposit</button>
                        </li>

                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" data-type='2'>Withdraw</button>
                        </li>

                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-Game-Play-tab" data-bs-toggle="pill" data-bs-target="#pills-Game-Play" type="button" role="tab" aria-controls="pills-Game-Play" aria-selected="false" data-type='3'>Game Play</button>
                        </li>

                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-Game-win-tab" data-bs-toggle="pill" data-bs-target="#pills-Game-win" type="button" role="tab" aria-controls="pills-Game-win" aria-selected="false" data-type='4'>Game Win</button>
                        </li>

                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-Recharge-Bonus-tab" data-bs-toggle="pill" data-bs-target="#pills-Recharge-Bonus" type="button" role="tab" aria-controls="pills-Recharge-Bonus" aria-selected="false" data-type='5'>Recharge Bonus</button>
                        </li>

                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-Refferal-Bonus-tab" data-bs-toggle="pill" data-bs-target="#pills-Refferal-Bonus" type="button" role="tab" aria-controls="pills-Refferal-Bonus" aria-selected="false" data-type='6'>Refferal Bonus</button>
                        </li>

                       <!--  <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-Refferal-Bonus-tab" data-bs-toggle="pill" data-bs-target="#pills-Refferal-Bonus" type="button" role="tab" aria-controls="pills-Refferal-Bonus" aria-selected="false" data-type='7'>Undo</button>
                        </li> -->

                     </ul>
                  </div>
               </div>


               <ul class="history"></ul>
               <button class="btn btn-danger mt-3 mb-3 history-view-more" style="margin: 0 auto;display: block;">View More</button>

                              
            </div>






            <?php include('include/menubar.php'); ?>
            <?php include('include/allscript.php'); ?>
         </main>
      </div>
<!-- lose modal end -->
<div class="custom-modal transaction-modal">
    <div class="modal-inner" style="background: white;">
        <span class="custom-modal-close">x</span>
         <span class="period-id-div">Period ID: <span class="period-id"></span></span>
         <div class="row m-0 bets-body"></div>
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

<script>


   $(document).on("click", ".transaction-row",(function(e) {
      

      var id = $(this).data("id");
      var form = new FormData();
      form.append("id", id);
      form.append("type2", $(this).data("type2"));

      var settings = {
         "url": "<?=base_url('api/game/bet_detail') ?>",
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
         // $("#preloader").removeClass("show");
         if(response.status==200)
         {
            var html = '';
            $(response.data).each(function(index, item){

               var p_type = item.p_type;
               var p_id = item.p_id;
               classs = '';

               if(p_type==1)
               {                  
                  if(p_id==1) classs = 'black-bg';
                  if(p_id==2) classs = 'violet-bg';
                  if(p_id==3) classs = 'red-bg';
                  p_id = '';
               }
               else
               {
                  classs = '';
               }

               var amount = item.amount;
               if(response.is_result_declare==1 && response.type2==4) amount = item.win_amount;

               html = html+`
                           <div class="bets-body-inner">
                              <span class="number-color ${classs}" >${p_id}</span>
                                 <div class="bets-body-inner-bet">${price_format(amount)}</div>
                           </div>
                        `;
            });
            $(".bets-body").html(html);
            $(".transaction-modal").show();
            $(".period-id").text(response.session_id);
         }
         else
         {

         }
      });

   }));

   $(document).on("click", ".custom-modal-close",(function(e) {
        $(".transaction-modal").hide();
   }));


    
    var page = 0;
    var type = 0;
    var type2 = 0;
    var api_data_div = 'history';
    var click_btn = '.history-view-more';
    function plan_list()
    {
        $("#preloader").addClass("show");
        $(click_btn).attr("disabled",true);
        $(".sweet-loader").addClass("show");
        var form = new FormData();
        form.append("page", page);
        form.append("use_type", type);
        form.append("type2", type2);

        var settings = {
          "url": "<?=base_url('api/user/history') ?>",
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
            if(page==0)
            $('.'+api_data_div).html(`<li>
                <button class="btn btn-danger mt-3 mb-3 " style="margin: 0 !important;padding: 0 !important;background: #0ef;">Data not found...</button>
                </li>`);
            print_toast(response.message);
          }
        });
    }
    plan_list();


    $(document).on("click", ".history-view-more",(function(e) {
        click_btn = $(this);
        plan_list();
    }));
    $(document).on("click", ".nav-tabs li button",(function(e) {        
        $(".nav-tabs a").removeClass("active");
        $(this).addClass("active");
        type2 = $(this).data("type");
        page = 0;
        plan_list();
    }));
</script>


      
   </body>
</html>