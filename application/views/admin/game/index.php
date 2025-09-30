<?php  
$spinner = '<div class="spin-div"><i class="fa fa-spinner fa-spin" ></i></div>';
$table_id = 1; 
?>
<style>
    .action-td .btn {
    display: block;
    width: fit-content;
    font-size: 15px;
}
</style>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">


                        <div class="col-12">
                            <div class="card">
                               <div class="card-header" style="padding-bottom: 0;">
                                
                                    <div class="row">
                                        <div class="col-md-2" style="display: none;">                    
                                            <select class="form-control select bulkactiontype" id="bulkactiontype<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                                <option value="">Select</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="delete">Delete</option>
                                                <!-- <option value="export">Export</option> -->
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="display: none;">
                                            <button type="button" class="btn btn-danger bulk-action"  data-table_id="<?=$table_id ?>" data-url="<?=($back_btn.'/bulk_action?trashd='.$trash.'&cols='.$all_image_column_names) ?>" >Bulk Action</button>
                                        </div>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4 text-right" style="text-align: right;">
                                            <a href="<?=base_url($add_btn_url) ?>" class="btn btn-success add-button ml-3 add-btn" style="margin-left: 15px;padding: 5px 5px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a>
                                        </div>
                                    </div>
                                    
                                        
                                    <div class="row mt-2">
                                         <div class="col-md-2">
                                            <select class="form-control select statuschange" id="statuschange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                               <option value="1">Active</option>
                                               <option value="0">Inactive</option>
                                            </select>
                                         </div>
                                         <div class="col-md-2">
                                            <select class="form-control select order_bychange" id="order_bychange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                               <option value="id asc">ASC</option>
                                               <option value="id desc">DESC</option>
                                            </select>
                                         </div>
                                         <div class="col-md-2">
                                            <select class="form-control select limitchange" id="limitchange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                               <option value="12">12</option>
                                               <option value="24">24</option>
                                               <option value="36">36</option>
                                               <option value="100">100</option>
                                            </select>
                                         </div>
                                         <div class="col-md-3"></div>                     
                                         <div class="col-md-3">
                                            <div class="navbar-item navbar-form">
                                                  <div class="form-group">
                                                     <input type="text" class="form-control list-search" placeholder="Enter keyword" data-url="<?=base_url(panel.'/'.$controller_name.'/search') ?>" data-keys="<?=$keys ?>" data-target="1" data-table_id="<?=$table_id ?>" id="list-searchid-1">
                                                  </div>
                                            </div>
                                         </div>
                                    </div>
                                        
                                    

                               </div>  
                               <div class="card-body" id="table1">
                                  <?=$spinner; ?>                                 
                               </div>
                               <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<script>
   
   var page = 1;
   var data = [];
   var keys_url = {};
   data['url'] = "<?=$back_btn ?>/load_data";
   data['table_id'] = 1;
   load_table(data);




   $(document).on("change", ".statuschange, .order_bychange, .limitchange, .kycchange",(function(e) {
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

</script>