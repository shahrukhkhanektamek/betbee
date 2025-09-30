<?php  
$spinner = '<div class="spin-div"><i class="fa fa-spinner fa-spin" ></i></div>';
$table_id = 1; 
?>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">


                  <div class="row">
            
                      <div class="col-lg-4 col-8">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3 id="diposit">Wait..</h3>
                            <p>TODAY'S DEPOSIT</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-bag"></i>
                          </div>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-4 col-8">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3 id="withdraw">Wait..</h3>
                            <p style="font-size:bold;">WITHDRAWAL</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-person-add"></i>
                          </div>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-4 col-8">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3><span id="p_and_l">Wait...</span><sup style="font-size: 20px">₹</sup></h3>
                            <p>Total Profit</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                        </div>
                      </div>
                      <!-- ./col -->
                
                  </div>


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
                                            <input type="date" class="form-control select fromdatechange" id="fromdatechange<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=date("Y-m-d") ?>">
                                         </div>

                                         <div class="col-md-2">
                                            <input type="date" class="form-control select todatechange" id="todatechange<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=date("Y-m-d") ?>">
                                         </div>
                                         

                                         <!-- <div class="col-md-9"></div> -->
                                         <div class="col-md-3" style="display:none;">
                                            <div class="navbar-item navbar-form">
                                                  <div class="form-group">
                                                     <input type="text" class="form-control list-search" placeholder="Enter keyword" data-url="<?=base_url(panel.'/'.$controller_name.'/search') ?>" data-keys="<?=$keys ?>" data-target="1" data-table_id="<?=$table_id ?>" id="list-searchid-1">
                                                  </div>
                                            </div>
                                         </div>
                                         <!-- <div class="col-md-2 text-right"><a href="<?=base_url($add_btn_url) ?>" class="btn btn-success add-button ml-3 add-btn" style="margin-left: 15px;padding: 5px 5px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a></div> -->
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



   $(document).on("change", ".statuschange, .order_bychange, .limitchange, .kycchange, .time_idchange, .cardidchange, .fromdatechange, .todatechange",(function(e) {
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
      keys_url['time_id'] = $("#time_idchange"+data['table_id']).val();
      keys_url['card_id'] = $("#cardidchange"+data['table_id']).val();
      keys_url['from_date'] = $("#fromdatechange"+data['table_id']).val();
      keys_url['to_date'] = $("#todatechange"+data['table_id']).val();
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
         dataType:"json",
         data:{post_data:post_data},
         success:function(d)
         {
           console.log(d);
           $("#diposit").html(d.diposit);
           $("#withdraw").html(d.withdraw);
           $("#p_and_l").html(d.p_and_l);
           $("#table"+data['table_id']).html(d.list);
             $(".loading").removeClass("active");
         },
         error: function(e) 
         {
            $(".loading").removeClass("active");
         }
      });
   }





</script>