<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>ID No.</th>
           <th>User Name</th>
           <th>User Mobile</th>
           <th>Amount</th>
           <th>TXN No.</th>
           <th>Image</th>
           <th>Date Time</th>
           <th>Action</th>
        </tr>
    </thead>
    <tbody>
        

        
        

        <?php  
            if(!empty($list))
            {
                foreach ($list as $key => $value){ 
                
        ?>


        <tr id="rowno<?=$value->id ?>">
           <td>
                <label style="display: flex;">
                    <input type="checkbox" name="listcheckbox" class="listcheckbox-btn listcheckbox<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=$value->id ?>" <?php if(in_array($value->id,$listcheckbox))echo 'checked'; if(!empty($listcheckbox))if($listcheckbox[0]=='all')echo'checked'; ?>>
                    &nbsp;#<?=sort_name.$value->user_id ?>
                </label>
            </td>
           <td><?=$value->fname ?></td>
           <td>
              <?=$value->mobile ?><br>
              <a href="https://api.whatsapp.com/send?phone=91<?=$value->mobile ?>" target="_blank"><i class="fab fa-whatsapp" style="color:green;font-size:20px;"></i></a>
              &nbsp;&nbsp;
              <a href="tel:+91 <?=$value->mobile ?>" target="_blank"><i class="fas fa-phone-alt" style="font-size:20px;"></i></a>
           </td>
           <td><?=price_formate($value->amount) ?></td>
           <td><?=$value->txn_no ?></td>
           <td>
            <?php  
            $image = 'default.jpg';
            if(!empty($value->image))$image = $value->image;
            ?>
               <img src="<?=base_url('upload/'.$image) ?>" class="img-thumbnail big-img" style="width: 150px;height: 150px;">
           </td>
           <td><?=date("d M Y h:i A",strtotime($value->date_time)) ?></td>
           <td>
                <?php if($value->status==0){ ?>

                    <a class="btn btn-success change_withdraw_status" data-id="<?=$value->id ?>" data-status="1" >Completed</a>
                    <a class="btn btn-danger change_withdraw_status" data-id="<?=$value->id ?>" data-status="2" >Cancel</a>

                   <!-- <select class="form-control select2 change_withdraw_status" data-id="<?=$value->id ?>" id="change2<?=$value->id ?>">
                       <option value="0" <?php if($value->status==0)echo 'selected'; ?> >New</option>
                       <option value="1" <?php if($value->status==1)echo 'selected'; ?> >Approve</option>
                       <option value="2" <?php if($value->status==2)echo 'selected'; ?> >Reject</option>
                   </select> -->
                   <textarea class="form-control" id="comment<?=$value->id ?>" style="display: none;"><?=$value->comment ?></textarea>
               <?php } ?>
           </td>
           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















