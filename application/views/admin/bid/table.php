<?php $colspan = 9; ?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
           <th>ID No.</th>
           <th>User Name</th>
           <th>User Mobile</th>
           <th>Session ID</th>
           <th>Game</th>
           <th>Points</th>
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
           <td>
                <label style="display: flex;">
                    <input type="checkbox" name="listcheckbox" class="listcheckbox-btn listcheckbox<?=$table_id ?>" data-table_id="<?=$table_id ?>" value="<?=$value->id ?>" <?php if(in_array($value->id,$listcheckbox))echo 'checked'; if(!empty($listcheckbox))if($listcheckbox[0]=='all')echo'checked'; ?>>
                    &nbsp;#<?=sort_name.$value->user_id ?>
                </label>
            </td>
           <td><?=$value->fname ?></td>

           <td>
              <?=$value->mobile ?><br>
              <a href="https://api.whatsapp.com/send?phone=91<?=$value->mobile ?>" target="_blank"><i class="fab fa-whatsapp" style="color:green;font-size:20px;"></i></a>
              &nbsp;&nbsp;
              <a href="tel:+91 <?=$value->mobile ?>" target="_blank"><i class="fas fa-phone-alt" style="font-size:20px;"></i></a>
           </td>
           <td><?=$value->session_id ?></td>
           <td><span class="p_id_type <?=$class ?>"><?=$number ?></span></td>
           <td><?=price_formate($value->amount) ?></td>
           <td><?=date("d M Y",strtotime($value->add_date_time)) ?></td>          
           
        </tr>                           
        <?php }}else{echo '<tr><th colspan="'.$colspan.'" style="text-align: center;">Data not found...</th></tr>';} ?>
    </tbody>
</table>

 <?php $this->load->view("admin/pagination/index",$pagenation_data); ?>   

















