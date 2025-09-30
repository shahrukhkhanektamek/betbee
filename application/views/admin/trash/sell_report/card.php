<div class="row">
   <h4 class="col-12"><?=$value->name ?></h4>
   <?php 
   foreach ($digit_array as $key2 => $value2) {      
      $amount = $this->db
      ->where(" CONCAT(YEAR(game_bet.add_date_time),'-',MONTH(game_bet.add_date_time),'-',DAY(game_bet.add_date_time))='$date' ")
      ->where(array(
         "card_id"=>$card_id,
         "time_id"=>$time_id,
         "bid"=>$value2,
      ))
      ->select_sum('amount')->get_where("game_bet")->result_object()[0]->amount;
      if(empty($amount)) $amount = 0;
   ?>
      <div class="col-2 singleAnks-card" style="width: 20%;max-width: 20%;flex: 20%;">
         <div class="inner-card">
            <h3>Digit</h3>
            <h4><?=$value2 ?></h4>
            <h3>Amount</h3>
            <h4><?=$amount ?></h4>         
         </div>
      </div>
   <?php } ?>

</div>