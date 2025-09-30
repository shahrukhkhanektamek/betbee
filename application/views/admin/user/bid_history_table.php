<table class="table table-striped table-bordered">
   <thead>
      <tr>
         <th>Session ID</th>
         <th>Game</th>
         <th>Points</th>
         <th>Placed on</th>
      </tr>
   </thead>
   <tbody>
      <?php  
      foreach ($list as $key => $value) {
         

         $class = '';
         $color = $value->p_id;
         $number = '';
         if($value->type==2)
         {
            $number = $value->p_id;
         }
         else
         {
            if($color==1) $class = 'selected_color_black';
            if($color==2) $class = 'selected_color_blue';
            if($color==3) $class = 'selected_color_red';
         }
      
      ?>
      <tr id="rowno<?=$value->id ?>">           
           <td><?=$value->session_id ?></td>
           <td>
               <span class="p_id_type <?=$class ?>"><?=$number ?></span>
           </td>
           <td><?=price_formate($value->amount) ?></td>            
           <td><?=date("d M Y h:i A",strtotime($value->add_date_time)) ?></td>              
        </tr> 
        <?php } ?>  
   </tbody>
</table>  
<?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   