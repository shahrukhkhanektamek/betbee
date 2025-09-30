<?php 
if(!empty($row))
   $row = $row[0];
?>

<div id="content" class="app-content">
   <?php $this->load->view("admin/headers/breadcrumb") ?>
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
               <form class="form_data" method="post" enctype="multipart/form-data" action="<?=base_url($submit_url) ?>" id="form1" novalidate>
                  <div class="row">

                     <div class="mb-3 col-md-6">
                        <label class="form-label">Select Vendor *</label>
                        <select class="form-control select2" name="vendor_id">
                           <option value="">Select</option>
                           <option value="1">Option 1</option>
                           <option value="1">Option 2</option>
                           <option value="1">Option 3</option>
                        </select>
                     </div>

                     <div class="mb-3 col-md-6">
                        <label class="form-label">Machine ID. *</label>
                        <input class="form-control" type="text" required placeholder="Machine ID." value="<?php if(!empty($row))echo $row->machine_id ?>" name="machine_id" />
                     </div>

                     <div class="mb-3 col-md-6">
                        <label class="form-label">Purchase Date *</label>
                        <input class="form-control" type="date" required placeholder="Purchase Date." value="<?php if(!empty($row))echo date("Y-m-d",strtotime($row->purchase_date_time)) ?>" name="purchase_date_time" />
                     </div>

                     <div class="mb-3 col-md-6">
                        <label class="form-label">Exp Date *</label>
                        <input class="form-control" type="date" required placeholder="Purchase Date." value="<?php if(!empty($row))echo date("Y-m-d",strtotime($row->exp_date_time)) ?>" name="exp_date_time" />
                     </div>

                     

                     <div class="mb-3 col-md-12">
                      <button type="submit" class="btn btn-primary w-100px me-5px">Save</button>                     
                     </div>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>      
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