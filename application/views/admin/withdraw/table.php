<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>ID No.</th>
           <th>User Name</th>
           <th>User Mobile</th>
           <!-- <th>Balance</th> -->
           <th>Amount</th>
           <th>Date Time</th>
           <th>Payment Detail</th>
           <th>Status</th>
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
           <!-- <td><?=price_formate($value->wallet) ?></td> -->
           <td>
                <?=price_formate($value->amount) ?>
           </td>
           <td><?=date("d M Y h:i A",strtotime($value->date_time)) ?></td>   
           <td>
               <?php if($value->pay_type==1){ ?>
                    <b>Gpay No./UPI:</b> <?=$value->gpay_number ?><br>
                    <b>Holder Name:</b> <?=$value->holder_name ?>
               <?php } ?>
               <?php if($value->pay_type==2){ ?>
                    <b>Phonepe No./UPI:</b> <?=$value->phonepe_number ?><br>
                    <b>Holder Name:</b> <?=$value->holder_name ?>
               <?php } ?>
               <?php if($value->pay_type==3){ ?>
                    <b>PayTm No./UPI:</b> <?=$value->paytm_number ?><br>
                    <b>Holder Name:</b> <?=$value->holder_name ?>
               <?php } ?>
               <?php if($value->pay_type==4){ ?>
                    <b>Account No.:</b> <?=$value->account_number ?><br>
                    <b>IFSC:</b> <?=$value->ifsc ?><br>
                    <b>Holder Name:</b> <?=$value->holder_name ?>
               <?php } ?>
           </td>
           <td>
               <?php
                if($value->status==0) echo '<span class="badge btn btn-info">New</span>';
                if($value->status==1) echo '<span class="badge btn btn-success">Approved</span>';
                if($value->status==2) echo '<span class="badge btn btn-danger">Rejected</span>';
               ?>
           </td>
           <td>
                <?php if($value->status==0){ ?>

                    <a class="btn btn-success change_withdraw_status" data-id="<?=$value->id ?>" data-status="1" >Completed</a>
                    <a class="btn btn-danger change_withdraw_status" data-id="<?=$value->id ?>" data-status="2" >Cancel</a>

                    <!-- <select class="form-control select2 change_withdraw_status" data-id="<?=$value->id ?>" id="change2<?=$value->id ?>">
                       <option value="0" <?php if($value->status==0)echo 'selected'; ?> >New</option>
                       <option value="1" <?php if($value->status==1)echo 'selected'; ?> >Approve</option>
                       <option value="2" <?php if($value->status==2)echo 'selected'; ?> >Reject</option>
                    </select> -->
                    
               <?php } ?>
               <textarea class="form-control" style="display: block;" id="comment<?=$value->id ?>"><?=$value->comment ?></textarea>
           </td>
           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















