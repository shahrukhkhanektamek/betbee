<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>User Name</th>
           <th>Bid Points</th>
           <th>Winning Points</th>
           <th>Market Name</th>
           <th>Game Name</th>
           <th>Number</th>
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
           
           <td><?=$value->fname ?></td>
           <td><?=price_formate($value->amount) ?></td>
           <td><?=price_formate($value->win_amount) ?></td>
           
            <td><?=str_replace(" ", "_", $value->game_name).get_game_type($value->type);?></td>
           <td><?=$value->game_type ?></td>
           <td>
            <?php 
                if(empty($value->bid2))
                    echo $value->bid;
                else
                    echo $value->bid.'-'.$value->bid2;
            ?>
            </td>
           <td><?=date("d M Y h:i A",strtotime($value->add_date_time)) ?></td>
           <td><a data-id="<?=$value->id ?>" data-bid="<?=$value->bid ?>" class="btn btn-primary bid-change-modal-btn">Edit</td>
           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















