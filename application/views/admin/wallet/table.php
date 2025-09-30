<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>ID No.</th>
           <th>User Name</th>
           <th>User Mobile</th>
           <th>Points</th>
           <th>Balance</th>
           <th>Date Time</th>
           <th>Message</th>
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
           <td>
                <?php if($value->type=='credit'){ ?>
                    +
               <?php }else{ ?>
                    -
               <?php } ?>
                <?=price_formate($value->amount) ?>
           </td>
           <td><?=price_formate($value->balance) ?></td>
           <td><?=date("d M Y",strtotime($value->date_time)) ?></td>   
           <td><?=$value->message ?></td>
           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















