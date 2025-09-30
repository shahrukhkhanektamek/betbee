<?php
$colspan = 9;
?>
<table class="table table-striped mb-0 align-middle  table-bordered text-nowrap">
   <thead>
      <tr>
         <th>
            #
            <!-- <input type="checkbox" name="alllistcheckbox" class="alllistcheckbox-btn alllistcheckbox<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="all" <?php if(!empty($listcheckbox))if($listcheckbox[0]=='all')echo'checked'; ?>> -->
         </th>
         <th>Page Name</th>
         <th>Meta Title</th>
         <th>Keywords</th>
         <th>Description</th>
         <th>Status</th>
         <th width="1%"></th>
      </tr>
   </thead>
   <tbody>
      <?php  
      if(!empty($list))
      {
         foreach ($list as $key => $value){      
         
      ?>
         <tr id="rowno<?=$value->id ?>">
         <td><input type="checkbox" name="listcheckbox" class="listcheckbox-btn listcheckbox<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=$value->id ?>" <?php if(in_array($value->id,$listcheckbox))echo 'checked'; if(!empty($listcheckbox))if($listcheckbox[0]=='all')echo'checked'; ?>></td>
         <td><?php echo $value->page_name; ?></td>
         <td><?php echo $value->meta_title; ?></td>
         <td><?php echo $value->meta_keyword; ?></td>
         <td><?php echo $value->meta_description; ?></td>
         <td>
            <span id="status<?=$value->id ?>"><?=status_get($value->status,'') ?></span>
            <label class="switch">
               <input type="checkbox" class="status_change status_change<?=$value->id ?>" value="<?=$value->id ?>" <?php if($value->status==1)echo'checked'; ?> data-url="<?=base_url().'status_change/index/'.$table_name ?>">
               <span class="slider round"></span>
            </label>
         </td>
         <td nowrap>

            <?php if(empty($is_delete)){ ?>
               <a href="<?=base_url($edit_btn_url.$value->id) ?>" class="btn btn-sm btn-primary w-60px me-1">Edit</a>
               <a href="<?=base_url('admin/Delete/index/'.$table_name) ?>" class="btn btn-sm btn-white w-60px del-btn"  data-id="<?=$value->id ?>">Delete</a>
            <?php }else{ ?>
               <a href="<?=base_url('admin/Restore/index/'.$table_name.'/'.$page_name.'/'.$controller_name) ?>" class="btn btn-sm btn-primary w-60px restore-btn"  data-id="<?=$value->id ?>">Restore</a>
               <a href="<?=base_url('admin/Delete/index/'.$table_name.'?trashd=1&cols='.$all_image_column_names) ?>" class="btn btn-sm btn-white w-60px del-btn"  data-id="<?=$value->id ?>">Delete</a>
            <?php } ?>

         </td>
      </tr>                             
      <?php }
         }
         else
         {
            echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';
         }
      ?>                         
   </tbody>
</table>
 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















