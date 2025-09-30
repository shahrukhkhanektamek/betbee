<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>ID No.</th>
           <th>User Name</th>
           <th>User Mobile</th>
           <th>Points</th>
           <th>Registration Date</th>
           <!-- <th>Betting</th> -->
           <!-- <th>Paytm</th> -->
           <!-- <th>Point Transfer</th> -->
           <th>Status</th>
           <th>Action</th>
        </tr>
    </thead>
    <tbody>
        

        
        

        <?php  
            if(!empty($list))
            {
                foreach ($list as $key => $value){ 
                   if(!empty($value->image))
                      if(json_decode($value->image))
                         if(file_exists(FCPATH.'upload/'.json_decode($value->image)[0]->image_path))
                            $image = json_decode($value->image)[0]->image_path;         
        ?>


        <tr id="rowno<?=$value->id ?>">
           <td>
                <label style="display: flex;">
                    <input type="checkbox" name="listcheckbox" class="listcheckbox-btn listcheckbox<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=$value->id ?>" <?php if(in_array($value->id,$listcheckbox))echo 'checked'; if(!empty($listcheckbox))if($listcheckbox[0]=='all')echo'checked'; ?>>
                    &nbsp;#<?=sort_name.$value->user_id ?>
                </label>
            </td>
           <td><?=$value->fname.' '.$value->lname ?></td>
           <td>
              <?=$value->mobile ?><br>
              <a href="https://api.whatsapp.com/send?phone=91<?=$value->mobile ?>" target="_blank"><i class="fab fa-whatsapp" style="color:green;font-size:20px;"></i></a>
              &nbsp;&nbsp;
              <a href="tel:+91 <?=$value->mobile ?>" target="_blank"><i class="fas fa-phone-alt" style="font-size:20px;"></i></a>
           </td>
           <td><?=number_format($value->wallet,2) ?></td>
           <td><?=date("d M Y",strtotime($value->date_time)) ?></td>    
           <!-- <td class="text-center">
                <span class="yes_no" id="betting_status<?=$value->id ?>"><?=status_get($value->betting_status,'yes_no') ?></span>
                <label class="switch">
                    <input type="checkbox" class="status_change status_change<?=$value->id ?>" value="<?=$value->id ?>" <?php if($value->betting_status==1)echo'checked'; ?> data-url="<?=base_url().'status_change/index/'.$table_name ?>" data-column="betting_status">
                    <span class="slider round"></span>
                </label>
           </td> -->
           <!-- <td class="text-center">
                <span class="yes_no" id="paytm_status<?=$value->id ?>"><?=status_get($value->paytm_status,'yes_no') ?></span>
                <label class="switch">
                <input type="checkbox" class="status_change status_change<?=$value->id ?>" value="<?=$value->id ?>" <?php if($value->paytm_status==1)echo'checked'; ?> data-url="<?=base_url().'status_change/index/'.$table_name ?>" data-column="paytm_status">
                    <span class="slider round"></span>
                </label>
           </td> -->
           <!-- <td class="text-center">
                <span class="yes_no" id="point_transfer<?=$value->id ?>"><?=status_get($value->point_transfer,'yes_no') ?></span>
                <label class="switch">
                    <input type="checkbox" class="status_change status_change<?=$value->id ?>" value="<?=$value->id ?>" <?php if($value->point_transfer==1)echo'checked'; ?> data-url="<?=base_url().'status_change/index/'.$table_name ?>" data-column="point_transfer">
                    <span class="slider round"></span>
                </label>
           </td> -->
           <td class="text-center">
                <span class="yes_no" id="status<?=$value->id ?>"><?=status_get($value->status,'yes_no') ?></span>
                <label class="switch">
                    <input type="checkbox" class="status_change status_change<?=$value->id ?>" value="<?=$value->id ?>" <?php if($value->status==1)echo'checked'; ?> data-url="<?=base_url().'status_change/index/'.$table_name ?>" data-column="status">
                    <span class="slider round"></span>
                </label>
           </td>
           <td class="text-end action-td" >

               <?php if(empty($is_delete)){ ?>
                   <a href="<?=base_url($view_btn_url.$value->id) ?>" class="badge btn btn-primary">
                       <i class="far fa-eye mr-1"></i> View
                   </a>
                   <a href="<?=base_url($edit_btn_url.$value->id) ?>" class="badge btn btn-success">
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

















