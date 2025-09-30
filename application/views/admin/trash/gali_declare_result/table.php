<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>User Name</th>
           <th>Bid Points</th>
           <th>Winning Points</th>
           <th>Market Name</th>
           <th>Game Name</th>
           <th>Bid Number</th>
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
           <td><?php echo price_formate($value->amount); ?></td>
           <td>
               <?php  
                echo $win_amount = get_win_amount($value->card_id,$value->amount);
               ?>
           </td>
           <td><?php echo $value->game_name2.' ('.date("h:i A",strtotime($value->open_time)).'-'.date("h:i A",strtotime($value->close_time)).')'.get_game_type($value->type); ?></td>           
           <td><?=$value->game_type ?></td>
           <td><?php echo $value->bid;if(!empty($value->bid2))echo '-'.$value->bid2; ?></td>
           <td><?=date("d M Y",strtotime($value->add_date_time)) ?></td>              
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 

















