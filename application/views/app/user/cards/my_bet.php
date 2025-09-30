<?php foreach ($data as $key => $value) {

    $class = "";
    $class_result = "";
    $number = "";
    if($value->p_type==1)
    {
        if($value->p_id==1) $class = 'black-bg';
        else if($value->p_id==2) $class = 'violet-bg';
        else if($value->p_id==3) $class = 'red-bg';
    }
    else if($value->p_type==2)
    {
        $number = $value->p_id;
    }
    
    $is_result_declare = 0;
    $session_data = $this->db->select('id,is_result_declare,result')->get_where("game_sessions",array("session_id"=>$value->session_id,"game_id"=>$value->game_id,))->result_object();
    if(!empty($session_data)) $is_result_declare = $session_data[0]->is_result_declare;

    $number_r = '...';
    $class_result = 'white-bg text-black';
    if($is_result_declare==1)
    {
           $color_r = explode(",", $session_data[0]->result)[0];
           $number_r = explode(",", $session_data[0]->result)[1];


        if($number_r==0) $class_result = 'violet-red-bg-round';
        else if($number_r==5) $class_result = 'violet-black-bg-round';
        else if($number_r==1 || $number_r==3 || $number_r==7 || $number_r==9) $class_result = 'black-bg';
        else if($number_r==2 || $number_r==4 || $number_r==6 || $number_r==8) $class_result = 'red-bg';



    }
    
    
    

  ?> 
<li>
    <div class="card-body refer-body">
      <div class="row align-items-center flex-nowrap mb-2">
         
         <div class="col-2">
            <figure class="avatar avatar-40 mb-0 coverimg rounded-circle <?=$class ?> " style="background: gray;border: 1px solid white;"><?=$number ?>
            </figure>
         </div>


         <div class="col-6 ps-0">
            <p class="mb-0 fw-medium"><?=$value->session_id ?></p>
            <p class="text-secondary small">31 Aug, 2024 06:10 PM<br>
                <span style="color: #43b943!important;">Bet Amount: <?=price_formate($value->amount) ?></span>
                <?php if($value->win_amount>0){ ?>
                    <br><span style="color: #43b943!important;">Win Amount: <?=price_formate($value->win_amount) ?></span>
                <?php } ?>
            </p>
         </div>

         <div class="col-2">
            <figure class="avatar avatar-40 mb-0 coverimg rounded-circle <?=$class_result ?> " style="background: red;border: 1px solid white;"><?=$number_r ?>
            </figure>
         </div>

         <div class="col-2 ps-0">
            <?php if($value->win_amount>0){ ?>
                <button class="btn btn-sm btn-success">WIN</button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-danger"><?php if($is_result_declare==1) echo'LOSE';else echo '--'; ?></button>
            <?php } ?>
         </div>
      </div>
   </div>
</li>
<?php } ?>