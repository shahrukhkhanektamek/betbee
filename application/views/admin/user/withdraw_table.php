
<table  class="table table-striped table-bordered">
   <thead>
      <tr>
         <th>Request No.</th>
         <th>Amount</th>
         <th>Payment Detail</th>
         <th>Date</th>
         <th>Status</th>
      </tr>
   </thead>
   <tbody>
<?php foreach ($list as $key => $value) { ?>
      <tr>
         <td><?=$value->id ?></td>
         <td><?=price_formate($value->amount) ?></td>
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
         <td><?=date("d M Y",strtotime($value->date_time)) ?></td>   
         <td>

            <?php if($value->status==0){ ?>
               <span class="badge btn-info">New</span>
            <?php } ?>
            <?php if($value->status==1){ ?>
               <span class="badge btn-success">Approved</span>
            <?php } ?>
            <?php if($value->status==2){ ?>
               <span class="badge btn-danger">Rejected</span>
            <?php } ?>
         </td>
      </tr>
<?php } ?>
   </tbody>
</table>   
 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   