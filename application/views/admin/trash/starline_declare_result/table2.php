<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>Game Name</th>
           <th>Result Date</th>
           <th>Open Panna</th>
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
          
           <td><?php 
               echo $value->game_name2.' ('.date("h:i A", strtotime($value->open_time)).'-'.date("h:i A", strtotime($value->close_time)).')';
            ?></td>           
           <td><?=date("d M Y",strtotime($value->date)) ?></td>              
           <td>
                <?php
                    echo $value->open_number;
                    echo '-'.$value->open_single_number;
                ?>
           </td>                
           <td>
               <a href="<?=base_url('admin/declare_result/delete') ?>" class="btn btn-danger del-btn mb-0"  data-id="<?=$value->id ?>"><i class="fa fa-trash mr-1"></i> Delete</a>
           </td>
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 

















