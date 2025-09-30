<?php  
$spinner = '<div class="spin-div"><i class="fa fa-spinner fa-spin" ></i></div>';
$table_id = 1; 
?>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">


                        <div class="col-12">
                            <div class="card">
                               <div class="card-header" style="padding-bottom: 0;">
                                
                                    
                                    
                                        
                                    <div class="row mb-3" >
                                         <div class="col-md-2" style="display: none;">
                                            <select class="form-control select statuschange" id="statuschange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                               <option value="1">Active</option>
                                               <option value="0">Inactive</option>
                                            </select>
                                         </div>
                                         <div class="col-md-2" style="display:none;">
                                            <select class="form-control select order_bychange" id="order_bychange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                               <option value="<?=$table_name ?>.id desc">DESC</option>
                                               <option value="<?=$table_name ?>.id asc">ASC</option>
                                            </select>
                                         </div>
                                         <div class="col-md-2" style="display:block;">
                                            <select class="form-control select limitchange" id="limitchange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                               <option value="12">12</option>
                                               <option value="24">24</option>
                                               <option value="36">36</option>
                                               <option value="100">100</option>
                                            </select>
                                         </div>
                                         <div class="col-md-2" style="display:block;">
                                            <select class="form-control select select-user" id="select-user<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                             <option value="">Select User</option>
                                            </select>
                                         </div>

                                         <div class="col-md-2">
                                             <!-- <label>Date</label> -->
                                            <input type="date" class="form-control select datechange" id="datechange<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=date("Y-m-d") ?>">
                                         </div>
                                        
                                        
                                         
                                         

                                         <!-- <div class="col-md-2 text-right"><a href="<?=base_url($add_btn_url) ?>" class="btn btn-success add-button ml-3 add-btn" style="margin-left: 15px;padding: 5px 5px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a></div> -->
                                    </div>
                                        
                                    

                               </div>  
                               <div class="card-body" id="table1">
                                                                 
                               </div>
                               <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>




<div class="modal fade" id="winningBidChange">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Edit Game</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="post" autocomplete="off">
               <div class="form-group">
                  <label>Betting number</label>
                  <input type="number" name="bidwinning" id="bidwinning" value="" class="form-control" placeholder="Enter Bid Here" required/>
               </div>
               <div class="form-group">
                  <!-- Modal footer -->
                  <div class="modal-footer">
                     <button class="btn btn-success bid-change-modal-btn-submit" type="button">Save Change</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


<script>
   
   var page = 1;
   var data = [];
   var keys_url = {};
   data['url'] = "<?=$back_btn ?>/load_data";
   data['table_id'] = 1;
   load_table(data);




   $(document).on("change", ".select-user, .statuschange, .order_bychange, .limitchange, .kycchange, .time_idchange, .cardidchange, .datechange, .sessionchange, .openpannachange, .closepannachange",(function(e) {
      data['table_id'] = $(this).data("table_id");
      load_table(data);
   }));

   $(document).on("keyup", ".list-search",(function(e) {
      data['table_id'] = $(this).data("table_id");
      load_table(data);
   }));

   $(document).on("click", ".page-number-custom",(function(e) {      
      event.preventDefault();
      page = $(this).data("page");
      data['table_id'] = $(this).data("table_id");
      load_table(data);
   }));

   function load_table(data)
   {
      $("#table"+data['table_id']).append('<?=$spinner; ?>');
      keys_url['status'] = $("#statuschange"+data['table_id']).val();
      keys_url['order_by'] = $("#order_bychange"+data['table_id']).val();
      keys_url['limit'] = $("#limitchange"+data['table_id']).val();
      keys_url['user_id'] = $("#select-user"+data['table_id']).val();
      keys_url['time_id'] = $("#time_idchange"+data['table_id']).val();
      keys_url['card_id'] = $("#cardidchange"+data['table_id']).val();
      keys_url['session_id'] = $("#sessionchange"+data['table_id']).val();
      keys_url['openpannachange'] = $("#openpannachange"+data['table_id']).val();
      keys_url['closepannachange'] = $("#closepannachange"+data['table_id']).val();
      keys_url['date'] = $("#datechange"+data['table_id']).val();
      keys_url['kyc_step'] = $("#kycchange"+data['table_id']).val();
      keys_url['page'] = page;
      keys_url['table_id'] = data['table_id'];
      keys_url['is_delete'] = '<?=$trash ?>';
      keys_url['listcheckbox'] = listcheckbox;
      keys_url['filter_search_value'] = $("#list-searchid-"+data['table_id']).val();
      keys_url['keys'] = $("#list-searchid-"+data['table_id']).data("keys");
      var url = data['url'];
      var post_data = keys_url;
      var post_data = JSON.stringify(post_data);
      $.ajax({
         url:url,
         type:"post",
         data:{post_data:post_data},
         success:function(d)
         {
           // console.log(d);
           $("#table"+data['table_id']).html(d);
             $(".loading").removeClass("active");
         },
         error: function(e) 
         {
            $(".loading").removeClass("active");
         }
      });
   }


   var bid_id = 0;
   var bid = 0;
   $(document).on("click",".bid-change-modal-btn", (function() {
      bid_id = $(this).data('id');
      bid = $(this).data('bid');
      $("#bidwinning").val(bid);
      $("#winningBidChange").modal("show");
   }));
   $(document).on("click",".bid-change-modal-btn-submit", (function() {
      
      $(".loading").addClass("active");
      var bid = $("#bidwinning").val();
      $.ajax({
         url:"<?=base_url(panel.'/'.$controller_name.'/update') ?>",
         type:"post",
         data:{bid_id:bid_id,bid:bid},
         dataType:"json",
         success:function(response)
         {
            // console.log(response);
            $("#winningBidChange").modal("hide");
            load_table(data);
            $(".loading").removeClass("active");
         },
         error:function (response)
         {
            $(".loading").removeClass("active");
         }
      });
   }));





</script>

