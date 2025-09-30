<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>User Name</th>
           <th>User Mobile</th>
           <th>Amount</th>
           <th>Date Time</th>
        </tr>
    </thead>
    <tbody>
        <?php  
            if(!empty($list))
            {
                foreach ($list as $key => $value){ 
        ?>
        <tr id="rowno<?=$value->id ?>">
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
           <td><?=date("d M Y h:i A",strtotime($value->add_date_time)) ?></td>           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















