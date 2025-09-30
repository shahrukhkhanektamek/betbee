<?php if(!empty($row))$row = $row[0];else $row = array(); 
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

                                         <div class="col-md-2">
                                          <label>Date</label>
                                            <input type="date" class="form-control select datechange" value="<?=date("Y-m-d") ?>">
                                         </div>
                                         <div class="col-md-2">
                                             <label>Game Name</label>
                                            <select class="form-control select2 time_idchange" id="time_idchange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                                <option value="">Game Name</option>
                                                <?php  
                                                   $game_id = $id;
                                                   $games = $this->db->where(array("game_id"=>$game_id,"is_delete"=>0,))->get_where("game_times")->result_object();
                                                   foreach ($games as $key => $value) {
                                                    $name = $value->name;
                                                    if(empty(trim($name)))
                                                        $name = $row->name.' '.date("h:i A",strtotime($value->open_time)).'-'.date("h:i A",strtotime($value->close_time));

                                                ?>
                                                   <option value="<?=$value->id ?>" data-game_id="<?=$game_id ?>"><?=$name ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                         <div class="col-md-2" style="display: none;">
                                             <label>Session</label>
                                            <select class="form-control select2 sessionchange" data-table_id="<?=$table_id ?>">
                                                <option value="1">Open</option>
                                            </select>
                                         </div>
                                         <div class="col-md-2">
                                             <label>Panna</label>

                                             <?php 
                                                $arr = [];
                                                $single_panna_digits = single_panna_digits();
                                                $double_panna_digits = double_panna_digits();
                                                $tripple_panna_digits = tripple_panna_digits();
                                                $arr = array_merge($single_panna_digits,$double_panna_digits,$tripple_panna_digits);
                                             ?>

                                            <select class="form-control select2 pannachange" id="pannachange<?=$table_id ?>" data-table_id="<?=$table_id ?>">
                                                <option value="">Select Panna</option>
                                                <?php
                                                   foreach ($arr as $key => $value) {
                                                ?>
                                                   <option value="<?=$value ?>"><?=$value ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                         <div class="col-md-1">
                                          <label>Digit</label>
                                            <input type="number" readonly class="form-control select digitchange" id="digitchange<?=$table_id ?>" >
                                         </div>
                                         <div class="col-md-3">
                                             <button type="button" class="btn btn-primary now_declare_result" style="margin-top: 31px;">Declare Result</button>
                                         
                                             <button type="button" class="btn btn-primary check-winners" data-table_id="1" style="margin-top: 31px;">Winner Detail</button>
                                         </div>
                                    </div>
                               </div>                                 
                               <!-- /.card-body -->
                            </div>
                        </div>

                       
                        <div class="col-12" >
                            <div class="card">
                               <div class="card-header" style="padding-bottom: 0;">
                                
                                   
                                    
                                        
                                    <div class="row mt-2">
                                         
                                         <div class="col-md-9"></div>                     
                                         <div class="col-md-3">
                                            <div class="navbar-item navbar-form">
                                                  <div class="form-group">
                                                     <input type="text" class="form-control list-search" placeholder="Enter keyword" data-url="<?=base_url(panel.'/'.$controller_name.'/search') ?>" data-keys="<?=$keys ?>" data-target="1" data-table_id="<?=$table_id ?>" id="list-searchid-1">
                                                  </div>
                                            </div>
                                         </div>
                                    </div>
                                        
                                    

                               </div>  
                               <div id="table3"></div>
                               
                               <!-- /.card-body -->
                            </div>
                        </div>
                        









                    </div>
                </div>
            </section>




<div class="modal fade" id="declare_resultModal">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <!-- Modal body -->
         <div class="modal-body">

                <div id="declare_resultModaltable">
                    
                </div>
           
              <div class="modal-footer">                 
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>            
         </div>
      </div>
   </div>
</div>





<script>
   
   var page = 1;
   var data = [];
   var keys_url = {};
   data['table_id'] = 1;

   $(document).on("click", ".check-winners",(function(e) {
      data['url'] = "<?=$back_btn ?>/get_about_to_winners_table";
      data['table_id'] = $(this).data("table_id");
      get_about_to_winners(data);
   }));

   $(document).on("click", ".now_declare_result",(function(e) {
    $("body").addClass("active");
      data['table_id'] = $(this).data("table_id");
     
      now_declare_result(data);
      
   }));

   $(document).on("keyup", ".list-search",(function(e) {
      data['table_id'] = $(this).data("table_id");
      get_about_to_winners(data);
   }));

   $(document).on("click", ".page-number-custom",(function(e) {      
      event.preventDefault();
      page = $(this).data("page");
      data['table_id'] = $(this).data("table_id");
      get_about_to_winners(data);
   }));

   $(document).on("change", ".datechange",(function(e) {
      data['table_id'] =3;
      game_results(data);
   }));

   function get_about_to_winners(data)
   {
      $("#table"+data['table_id']).append('<?=$spinner; ?>');
      keys_url['page'] = page;
      keys_url['date'] = $(".datechange").val();
      keys_url['game_id'] = "<?=$id ?>";
      keys_url['time_id'] = $(".time_idchange").val();
      keys_url['session_id'] = $(".sessionchange").val();
      keys_url['panna'] = $(".pannachange").val();
      keys_url['digit'] = $(".digitchange").val();
      keys_url['table_id'] = data['table_id'];
      keys_url['filter_search_value'] = $("#list-searchid-"+data['table_id']).val();
      keys_url['keys'] = $("#list-searchid-"+data['table_id']).data("keys");
      var url = "<?=$back_btn ?>/get_about_to_winners_table";
      var post_data = keys_url;
      var post_data = JSON.stringify(post_data);
      $.ajax({
         url:url,
         type:"post",
         dataType:"json",
         data:{post_data:post_data},
         success:function(d)
         {
            $(".loading").removeClass("active");
            // $(".winner-section").show();
            // $("#table"+data['table_id']).html(d.data);
            $("#declare_resultModaltable ").html(d.data);
            if(d.status==200)
            {
                $("#declare_resultModal").modal("show");
                // success_message(d.message);
            }
            else
            {
                error_message(d.message);                
            }
         },
         error: function(e) 
         {
            $(".loading").removeClass("active");
         }
      });
   }

   function now_declare_result(data)
   {
      $("#table"+data['table_id']).append('<?=$spinner; ?>');
      keys_url['page'] = page;
      keys_url['date'] = $(".datechange").val();
      keys_url['game_id'] = "<?=$id ?>";
      keys_url['time_id'] = $(".time_idchange").val();
      keys_url['session_id'] = $(".sessionchange").val();
      keys_url['panna'] = $(".pannachange").val();
      keys_url['digit'] = $(".digitchange").val();
      keys_url['table_id'] = data['table_id'];
      keys_url['filter_search_value'] = $("#list-searchid-"+data['table_id']).val();
      keys_url['keys'] = $("#list-searchid-"+data['table_id']).data("keys");
      var url = "<?=$back_btn ?>/now_declare_result";
      var post_data = keys_url;
      var post_data = JSON.stringify(post_data);
      $.ajax({
         url:url,
         type:"post",
         dataType:"json",
         data:{post_data:post_data},
         success:function(d)
         {
            $(".loading").removeClass("active");
            $(".winner-section").show();
            data['table_id'] = 3; 
            game_results(data);
            if(d.status==200)
            {
                success_message(d.message);
            }
            else
            {
                error_message(d.message);                
            }
         },
         error: function(e) 
         {
            $(".loading").removeClass("active");
         }
      });
   }


   function game_results(data)
   {
      $("#table"+data['table_id']).append('<?=$spinner; ?>');
      keys_url['page'] = page;
      keys_url['date'] = $(".datechange").val();
      keys_url['game_id'] = "<?=$id ?>";
      keys_url['table_id'] = data['table_id'];
      keys_url['filter_search_value'] = $("#list-searchid-"+data['table_id']).val();
      keys_url['keys'] = $("#list-searchid-"+data['table_id']).data("keys");
      var url = "<?=$back_btn ?>/game_results";
      var post_data = keys_url;
      var post_data = JSON.stringify(post_data);
      $.ajax({
         url:url,
         type:"post",
         // dataType:"json",
         data:{post_data:post_data},
         success:function(d)
         {
            console.log(d);
            $(".loading").removeClass("active");
            $(".winner-section").show();
            $("#table"+data['table_id']).html(d);
           
         },
         error: function(e) 
         {
            // console.log(e);
            $(".loading").removeClass("active");
         }
      });
   }
    data['table_id'] = 3; 
    game_results(data);


</script>




<script>
    $(document).on("change",".pannachange",(function(){
        var panna = $(this).val();
        var digit = 0;
        count = panna.length;
        i=0;
        while(i<count)
        {
            digit = digit+parseInt(panna[i]);
            i++;
        }
        digit = String(digit);
        if(digit.length>1)final_digit = digit[1];
        else final_digit = digit[0];
        $(".digitchange").val(final_digit);            
    }));
</script>