<?php foreach ($data as $key => $value) {

   $class = '';
   $color = explode(",", $value->result)[0];
   $number = explode(",", $value->result)[1];

   if($number==0) $class = 'violet-red-bg-round';
   else if($number==5) $class = 'violet-black-bg-round';
   else if($number==1 || $number==3 || $number==7 || $number==9) $class = 'black-bg';
   else if($number==2 || $number==4 || $number==6 || $number==8) $class = 'red-bg';
    
  ?>
    <li>
      <!-- <span class="p_id_type <?=$class ?>"><?=$number ?></span> -->
      <div class="card-body refer-body">
                  <div class="row align-items-center flex-nowrap mb-2">
                     <div class="col-2">
                        <figure class="avatar avatar-40 mb-0 coverimg rounded-circle <?=$class ?>" style="background: #d32f2f;border: 1px solid white;"><?=$number ?>
                        </figure>
                     </div>
                     <div class="col-6 ps-0">
                        <p class="mb-0 text-secondary small">Session ID</p>
                        <p class="mb-0 fw-medium"><?=$value->session_id ?></p>
                     </div>
                     <div class="col-4 ps-0">
                        <p class="text-secondary small"><?=date("d M, Y h:i A",strtotime($value->bet_start_date_time)) ?></p>
                     </div>
                  </div>
               </div>
    </li>
<?php } ?>