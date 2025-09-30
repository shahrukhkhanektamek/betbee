<?php $colspan = 9; ?>



<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>Session ID</th>
           <th>Game Play</th>
           <th>Game Result</th>
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
                    $result = $value->result;
                    $number = '';
                    if($value->p_type==2)
                    {
                        $number = $value->p_id;
                    }
                    else
                    {
                        if($color==1) $class = 'selected_color_black';
                        if($color==2) $class = 'selected_color_blue';
                        if($color==3) $class = 'selected_color_red';
                    }

                    $color_r = explode(",", $value->result)[0];
                    $number_r = explode(",", $value->result)[1];


                    if($number_r==0) $class_result = 'violet-red-bg-round';
                    else if($number_r==5) $class_result = 'violet-black-bg-round';
                    else if($number_r==1 || $number_r==3 || $number_r==7 || $number_r==9) $class_result = 'black-bg';
                    else if($number_r==2 || $number_r==4 || $number_r==6 || $number_r==8) $class_result = 'red-bg';


        ?>

        <tr id="rowno<?=$value->id ?>">
           
           
           <td><?=$value->session_id ?></td>
           <td><span class="p_id_type <?=$class ?>"><?=$number ?></span></td>
           <td><span class="p_id_type <?=$class_result ?>"><?=$number_r ?></span></td>
           <td><?=price_formate($value->amount) ?></td>
           <td><?=price_formate($value->win_amount) ?></td>
           
           
           <td><?=date("d M Y h:i A",strtotime($value->date)) ?></td>
           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















