<?php 
$spinner = '<div class="spin-div"><i class="fa fa-spinner fa-spin" ></i></div>';
$table_id = 1; 
$user_id = 0;
if(!empty($row))$row = $row[0];else $row = array();
if(!empty($row)) $user_id = $row->id;

?>



<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row">


         <div class="col-6">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">User Details</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                     <img src="<?=base_url('upload/'.$row->profile_image) ?>" alt="user" class="img-thumbnail" style="display: block;margin: 0 auto;">
                  </div>
                  <div class="comment-widgets scrollable">
                     <div class="d-flex flex-row">
                        <table class="table table-bordered mt-3">
                           <tr>
                              <th>User Status</th>
                              <td class="text-center">
                                 <a href="#"><span class="badge badge-success">Yes</span></a>
                              </td>
                           </tr>
                           <tr >
                              <th>Betting Status</th>
                              <td class="text-center">
                                 <a href="#"><span class="badge badge-danger">No</span></a>
                              </td>
                           </tr>
                        </table>
                     </div>
                     <div class=" text-center">
                        <h2 style="color:#999">Wallet Balance</h2>
                        <h3>
                           <?=price_formate($row->wallet+$row->win_amount) ?>
                        </h3>
                        <div class="comment-footer">
                           <a href="<?=base_url(panel.'/wallet/add/'.$row->id) ?>" class="btn btn-success btn-md">Add Points / Withdraw</a>
                        </div>
                     </div>
                  </div>                  
               </div>
            </div>
         </div>
         <div class="col-6 pb-3">
            <div class="card card-primary" style="height: 100%;">
               <div class="card-header">
                  <h3 class="card-title">Personal Information</h3>
               </div>
               <div class="card-body">
                  <table class="table table-bordered personalInfo">
                     <tbody>
                        <tr>
                           <th>User ID.</th>
                           <td>#<?=sort_name.$row->user_id ?></td>
                        </tr>
                        <tr>
                           <th>Full Name</th>
                           <td><?=$row->fname.' '.$row->lname ?></td>
                        </tr>
                        <tr>
                           <th>Email</th>
                           <td><?=$row->email ?></td>
                        </tr>
                        <tr>
                           <th>Mobile Number</th>
                           <td><?=$row->mobile ?></td>
                        </tr>
                        <tr>
                           <th>Password</th>
                           <td><?=$row->password ?></td>
                        </tr>
                        <tr>
                           <th>Registration Date</th>
                           <td><?=date("d M Y",strtotime($row->date_time)) ?></td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="text-center mb-4 mt-4">
                     <div class="comment-footer pt-3">
                        <a href="https://api.whatsapp.com/send?phone=91<?=$row->mobile ?>" target="_blank" class="btn btn-success btn-md">WhatsApp</a>
                        <a href="tel:+91 <?=$row->mobile ?>" target="_blank" class="btn btn-danger btn-md">Call</a>
                     </div>
                  </div>                 
               </div>
            </div>
         </div>

         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Payment Information</h3>
               </div>
               <div class="card-body">
                  <table class="table table-bordered paymentInfo">
                     <tbody>
                        <tr>
                           <th>Account Holder Name</th>
                           <td><?=$row->holder_name ?></td>
                           <th>Account Number</th>
                           <td><?=$row->account_no ?></td>
                        </tr>
                        <tr>
                           <th>IFSC Code</th>
                           <td><?=$row->ifsc_code ?></td>
                           <th>UPI</th>
                           <td><?=$row->upi_id ?></td>
                        </tr>
                     </tbody>
                  </table>                
               </div>
            </div>
         </div>


         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Withdwaw Points Requests</h3>
               </div>
               <div class="card-body" id="table1">
                  <?=$spinner; ?>                              
               </div>
            </div>
         </div>


         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Bet History</h3>
               </div>
               <div class="card-body" id="table2">
                  <?=$spinner; ?>                                
               </div>
            </div>
         </div>


         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Winning History</h3>
               </div>
               <div class="card-body" id="table4">
                  <?=$spinner; ?>                                
               </div>
            </div>
         </div>

         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Wallet History</h3>
               </div>
               <div class="card-body">
                  
                  <!-- Tab panes -->

                     <div class="card-body" id="table3">
                        <?=$spinner; ?>                                
                     </div>       
               </div>
            </div>
         </div>





         
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!--Withdrawal Points-->



<script>   
   var page = 1;
   var user_id = <?=$user_id ?>;
   var data = [];
   var keys_url = {};
   var table_id = 0;
   
   $(document).on("click", ".page-number-custom",(function(e) {      
      event.preventDefault();
      page = $(this).data("page");
      table_id = $(this).data("table_id");
      url = $(this).data('url');
      load_table(data,table_id,url);
   }));
   function load_table(data,table_id,url)
   {
      $("#table"+table_id).append('<?=$spinner; ?>');
      keys_url['user_id'] = user_id;
      keys_url['page'] = page;
      keys_url['table_id'] = table_id;
      keys_url['url'] = url;
      var post_data = keys_url;
      var post_data = JSON.stringify(post_data);
      $.ajax({
         url:url,
         type:"post",
         data:{post_data:post_data},
         success:function(d)
         {
            // console.log(table_id);
            if(table_id==2)
           console.log(d);
           $("#table"+table_id).html(d);
             $(".loading").removeClass("active");
         },
         error: function(e) 
         {
            $(".loading").removeClass("active");
         }
      });
   }


   url = "<?=base_url().$back_btn ?>/withdraw_data";
   table_id = 1;
   load_table(data,table_id,url);

   url = "<?=base_url().$back_btn ?>/bid_data";
   table_id = 2;
   load_table(data,table_id,url);  

   url = "<?=base_url().$back_btn ?>/wallet_data";
   table_id = 3;
   load_table(data,table_id,url);

   url = "<?=base_url().$back_btn ?>/winning_data";
   table_id = 4;
   load_table(data,table_id,url);
</script>









