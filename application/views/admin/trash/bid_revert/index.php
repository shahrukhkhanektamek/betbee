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
                                
                                    
                                    
                                        
                                    <div class="row mt-2 mb-3">
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
                                         <div class="col-md-2" style="display:none;">
                                            <select class="form-control select limitchange" id="limitchange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                               <option value="12">12</option>
                                               <option value="24">24</option>
                                               <option value="36">36</option>
                                               <option value="100">100</option>
                                            </select>
                                         </div>

                                         <div class="col-md-2">
                                            <input type="date" class="form-control select datechange" id="datechange<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=date("Y-m-d") ?>">
                                         </div>
                                         <div class="col-md-3">
                                            <select class="form-control select2 time_idchange" id="time_idchange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                                <option value="">Game Name</option>
                                                <?php  
                                                   $game_id = $id;
                                                   $games = $this->db->where(array("game_id"=>$game_id,))->get_where("game_times")->result_object();
                                                   foreach ($games as $key => $value) {
                                                      $name = $value->name;
                                                      if(empty(trim($name)))
                                                        $name = $row->name.' '.date("h:i A",strtotime($value->open_time)).'-'.date("h:i A",strtotime($value->close_time));
                                                ?>
                                                   <option value="<?=$value->id ?>" data-game_id="<?=$game_id ?>"><?=$name ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                         <div class="col-md-5"></div>
                                         <div class="col-md-2">
                                            <button type="button" class="btn bg-gradient-olive refund-all" data-table_id="<?=$table_id ?>">Clear & Refund All</button>
                                         </div>


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
<script>
   
   var page = 1;
   var data = [];
   var keys_url = {};
   data['url'] = "<?=$back_btn ?>/load_data";
   data['table_id'] = 1;
   load_table(data);




   $(document).on("change", ".statuschange, .order_bychange, .limitchange, .kycchange, .time_idchange, .cardidchange, .datechange",(function(e) {
      data['table_id'] = $(this).data("table_id");
      data['url'] = "<?=$back_btn ?>/load_data";
      load_table(data);
   }));
   $(document).on("click", ".amount-submit-btn",(function(e) {
      data['table_id'] = $(this).data("table_id");
      data['url'] = "<?=$back_btn ?>/load_data";
      load_table(data);
   }));

   $(document).on("keyup", ".list-search",(function(e) {
      data['table_id'] = $(this).data("table_id");
      data['url'] = "<?=$back_btn ?>/load_data";
      load_table(data);
   }));

   $(document).on("click", ".refund-all",(function(e) {
      data['table_id'] = $(this).data("table_id");
      data['url'] = "<?=$back_btn ?>/send";
      load_table(data);
   }));

   $(document).on("click", ".page-number-custom",(function(e) {      
      event.preventDefault();
      page = $(this).data("page");
      data['table_id'] = $(this).data("table_id");
      data['url'] = "<?=$back_btn ?>/load_data";
      load_table(data);
   }));

   function load_table(data)
   {
      $("#table"+data['table_id']).append('<?=$spinner; ?>');
      keys_url['status'] = $("#statuschange"+data['table_id']).val();
      keys_url['order_by'] = $("#order_bychange"+data['table_id']).val();
      keys_url['limit'] = $("#limitchange"+data['table_id']).val();
      keys_url['time_id'] = $("#time_idchange"+data['table_id']).val();
      keys_url['card_id'] = $("#cardidchange"+data['table_id']).val();
      keys_url['date'] = $("#datechange"+data['table_id']).val();
      keys_url['amount'] = $("#amount"+data['table_id']).val();
      keys_url['kyc_step'] = $("#kycchange"+data['table_id']).val();
      keys_url['page'] = page;
      keys_url['game_id'] = "<?=$game_id ?>";
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
         dataType:"json",
         data:{post_data:post_data},
         success:function(d)
         {
           console.log(d);
           $("#table"+data['table_id']).html(d.data);
             $(".loading").removeClass("active");
         },
         error: function(e) 
         {
            $(".loading").removeClass("active");
         }
      });
   }


</script>