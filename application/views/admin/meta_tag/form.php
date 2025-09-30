<?php 
if(!empty($row))$row = $row[0];else $row = array();

?>

<div id="content" class="app-content">
   <?php $this->load->view("admin/headers/breadcrumb") ?>
<form class="form_data" method="post" enctype="multipart/form-data" action="<?=base_url($submit_url) ?>" id="form1" novalidate>
   <div class="row">





      <div class="col-md-12">
         <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <div class="panel-heading">
               <h4 class="panel-title">List</h4>


               <div class="panel-heading-btn">
                  <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                  <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
               </div>
               <a href="<?=base_url($back_btn) ?>" class="btn btn-danger" style="margin-left: 15px;padding: 5px 5px;"><i class="fa fa-backward"></i> Back</a>
            </div>
            <div class="panel-body">
                  <div class="row">

                     <div class="mb-3 col-md-4">
                        <label class="form-label">Page Name *</label>
                        <input class="form-control" type="text" required placeholder="Page Name" value="<?php if(!empty($row))echo $row->page_name ?>" name="page_name" />
                     </div>

                     <div class="mb-3 col-md-4">
                        <label class="form-label">Meta Title *</label>
                        <input class="form-control" type="text" required placeholder="Meta Title" value="<?php if(!empty($row))echo $row->meta_title ?>" name="meta_title" />
                     </div>

                     <div class="mb-3 col-md-4">
                        <label class="form-label">Meta Auther *</label>
                        <input class="form-control" type="text" required placeholder="Meta Auther" value="<?php if(!empty($row))echo $row->meta_auther ?>" name="meta_auther" />
                     </div>


                     <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Keywords *</label>
                        <input class="form-control" type="text" required placeholder="Meta Keywords" value="<?php if(!empty($row))echo $row->meta_keyword ?>" name="meta_keyword" />
                     </div>

                     <div class="mb-3 col-md-12">   
                        <label class="form-label">Link *</label>
                        <div class="input-group">
                           <div class="input-group-text"><?=base_url() ?></div>
                           <input class="form-control" type="text" placeholder="Link" value="<?php if(!empty($row))echo $row->slug ?>" name="slug" />
                        </div>                     
                     </div>

                     <div class="mb-3 col-md-12">
                        <label class="form-label">Meta Description *</label>
                        <textarea class="form-control" name="meta_description" placeholder="Meta Description" rows="5"><?php if(!empty($row))echo $row->meta_description ?></textarea>
                     </div>



                    


                  </div>
               

            </div>
         </div>
      </div>



      <div class="col-md-12">
         <div class="panel panel-inverse" data-sortable-id="form-stuff-2000000">
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12" style="text-align: center;">
                   <button type="submit" class="btn btn-primary w-100px me-5px">Save</button>                     
                  </div>
               </div>
            </div>
         </div>
      </div>



   </div>    
</form>  
</div>
<script>
   $(".select2").select2();
   // $(".select2").select2({
   //    ajax: {
   //          url: "<?=base_url('home/vendors_name_ajax') ?>",
   //          dataType:"json",
   //          type:"post",
   //          data: function (params) {
   //             var query = {
   //               search: params.term,
   //               type: 'public'
   //             }
   //             return query;
   //          },
   //          processResults: function (data) {
   //             console.log(data);
   //             return {
   //               results: data.results
   //             };
   //          }
   //       }
   // });
</script>