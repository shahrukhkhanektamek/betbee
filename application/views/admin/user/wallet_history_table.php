<table class="table table-striped table-bordered">
   <thead>
      <tr>
           <th>Points</th>
           <th>Balance</th>
           <th>Date Time</th>
           <th>Message</th>
        </tr>
   </thead>
   <tbody>
<?php foreach ($list as $key => $value) { 

$name = '';
$mobile = '';
$wallet = 0;
$image = '';
$user = $this->db->get_where("users",array("id"=>$value->user_id,))->result_object();
if(!empty($user))
{
  $user = $user[0];
  $image = $user->image;
  $name = $user->fname;
  $mobile = $user->mobile;
  $wallet = $user->wallet;
}


   ?>
   <tr id="rowno<?=$value->id ?>">
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
<?php } ?>
   </tbody>
</table>
<?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   