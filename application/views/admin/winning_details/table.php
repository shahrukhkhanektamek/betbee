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
           <th>Session ID</th>
           <th>Game</th>
           <th>Bid Points</th>
           <th>Winning Points</th>
           <th>Date Time</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            if(!empty($list))
            {
                foreach ($list as $key => $value){ 

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
           
           <td><?=$value->fname ?></td>
           <td><?=$value->session_id ?></td>
           <td><span class="p_id_type <?=$class ?>"><?=$number ?></span></td>
           <td><?=price_formate($value->amount) ?></td>
           <td><?=price_formate($value->win_amount) ?></td>
           
           
           <td><?=date("d M Y h:i A",strtotime($value->add_date_time)) ?></td>
           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















