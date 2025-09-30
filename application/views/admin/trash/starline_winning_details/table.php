<?php $colspan = 9; ?>




<div class="row">
    <div class="col-2">
        <span class="badge btn-success" style="font-size: 15px;padding: 7px 8px;margin-bottom: 10px;">Total Bid Amount: <?=$total_bid_amount ?></span>
    </div>
    <div class="col-2">
        <span class="badge btn-success" style="font-size: 15px;padding: 7px 8px;margin-bottom: 10px;">Total Winning Amount: <?=$total_winning_amount ?></span>
    </div>
</div>


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
           
            <td><?php echo $value->game_name2.' ('.date("h:i A",strtotime($value->open_time)).'-'.date("h:i A",strtotime($value->close_time)).')'; ?></td>
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

















