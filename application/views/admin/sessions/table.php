<?php $colspan = 9; ?>





<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>Date/Time</th>
           <th>SessionID</th>
           <th>Duration</th>
           <th>Result</th>
           <th>Result Status</th>
           <th>Action</th>
        </tr>
    </thead>
    <tbody>
        

        
        

        <?php  
            if(!empty($list))
            {
                foreach ($list as $key => $value){   
                    $class = '';
                   $color = explode(",",$value->result)[0];
                   $number = explode(",",$value->result)[1];
                  if($color==1) $class = 'selected_color_black';
                  if($color==2) $class = 'selected_color_blue';
                  if($color==3) $class = 'selected_color_red';


                    if($number==1 || $number==3 || $number==7 || $number==9) $class = 'black-bg';
                    if($number==2 || $number==4 || $number==6 || $number==8) $class = 'red-bg';
                    if($number==0) $class = 'violet-red-bg';
                    if($number==5) $class = 'violet-black-bg';



          // if($number==0) $class = 'selected_color_red_blue';
          // if($number==5) $class = 'selected_color_black_blue';

          // $number = '';
                    
                    
        ?>


        <tr id="rowno<?=$value->id ?>">
           <td>
                <b>Start Date Time: </b><?=date("Y-m-d h:i A",strtotime($value->bet_start_date_time)) ?><br>
                <b>End Date Time: </b><?=date("Y-m-d h:i A",strtotime($value->bet_stop_date_time)) ?>
           </td>
           
           <td><?=$value->session_id ?></td>
           <td><?=$value->total_minute ?></td>
           <td>
               <span class="p_id_type <?=$class ?>"><?=$number ?></span>
           </td>
           <td>
               <?php if($value->is_result_declare==1){ ?>
                <span class="badge btn-success">Declared</span>
               <?php }else if($value->is_result_declare==0){ ?>
                <span class="badge btn-danger">Pending</span>
               <?php } ?>
           </td>
           
           <td class="text-end action-td" >

               <?php if(empty($is_delete)){ ?>
                   <a href="<?=base_url('admin/live/index/'.$value->session_id.'/'.$value->game_id) ?>" class="badge btn btn-primary">
                       <i class="far fa-eye mr-1"></i> View
                   </a>
               <?php }else{ ?>
               <?php } ?>

            </td>
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















