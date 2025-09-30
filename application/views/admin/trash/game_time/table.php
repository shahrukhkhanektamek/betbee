<?php $colspan = 9;?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>Game Name</th>
           <?php if($game_id==1){?><th>Title</th><?php } ?>
           <th>Open Time</th>
           <th>Close Time</th>
           <th>Days</th>
           <th>Active</th>
           <th>Action</th>
        </tr>
    </thead>
    <tbody>
        

        
        

        <?php  
            if(!empty($list))
            {
                foreach ($list as $key => $value){ 
                    $image = 'default.jpg';
                   if(!empty($value->image))
                      if(json_decode($value->image))
                         if(file_exists(FCPATH.'upload/'.json_decode($value->image)[0]->image_path))
                            $image = json_decode($value->image)[0]->image_path;         
        ?>


        <tr id="rowno<?=$value->id ?>">
           <!-- <td><img src="<?=base_url('upload/'.$image) ?>" class="img-thumbnail w-25"></td>    -->
           <td><?=$value->game_name ?></td>        
           <?php if($game_id==1){?><td><?=$value->name ?></td><?php } ?>
           <td><?=date("h:i A", strtotime($value->open_time)) ?></td>        
           <td><?=date("h:i A", strtotime($value->close_time)) ?></td>        
           <td>
                <?php
                    $i=0;
                    $times = json_decode($value->times);
                  foreach (days() as $key2 => $value2)
                  {
                        if($times[$i]==2)
                        {
                            echo days($times[$i]).' (Closed)';
                        }
                        $i++;
                  }
                ?>
           </td>
           <td class="text-center">
                <span class="yes_no" id="status<?=$value->id ?>"><?=status_get($value->status,'yes_no') ?></span>
                <label class="switch">
                    <input type="checkbox" class="status_change status_change<?=$value->id ?>" value="<?=$value->id ?>" <?php if($value->status==1)echo'checked'; ?> data-url="<?=base_url().'status_change/index/'.$table_name ?>" data-column="status">
                    <span class="slider round"></span>
                </label>
           </td>
           <td class="text-end action-td" >

               <?php if(empty($is_delete)){ ?>
                   <a href="<?=base_url($edit_btn_url.$value->id.'/'.$game_id) ?>" class="badge btn btn-success">
                       <i class="far fa-edit mr-1"></i> Edit
                   </a>
                   <a href="<?=base_url('admin/Delete/index/'.$table_name) ?>" class="badge btn btn-danger del-btn mb-0"  data-id="<?=$value->id ?>">
                       <i class="fa fa-trash mr-1"></i> Delete
                   </a>
               <?php }else{ ?>
                  <a href="<?=base_url('admin/Restore/index/'.$table_name.'/'.$page_name.'/'.$controller_name) ?>" class="badge btn btn-danger restore-btn"  data-id="<?=$value->id ?>">Restore</a>
                  <a href="<?=base_url('admin/Delete/index/'.$table_name.'?trashd=1&cols='.$all_image_column_names) ?>" class="badge btn btn-danger del-btn"  data-id="<?=$value->id ?>"><i class="fa fa-trash mr-1"></i> Delete</a>
               <?php } ?>

            </td>
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















