<?php  
if(!isset($i)) $i = 0;
?>
<div class="row" style="position: relative;    padding-top: 12px;">
    <span class="btn btn-danger remove-btn" style="width: fit-content;">Remove</span>    
    <div class="col-md-2 form-group">
         <label>Min Diposit reward</label>
         <input type="number" name="diposit_reward_from[]" value="<?php if(!empty($main_max_deposit->fromamount))echo $main_max_deposit->fromamount ?>" class="form-control" required />
      </div>
      <div class="col-md-1 form-group text-center">
         <label style="color: white;">To</label>
         <label style="display:block">To</label>
      </div>
      <div class="col-md-2 form-group">
         <label>Max Diposit reward</label>
         <input type="number" name="diposit_reward_to[]" value="<?php if(!empty($main_max_deposit->toamount))echo $main_max_deposit->toamount ?>" class="form-control" required />
      </div>
      <div class="col-md-2 form-group">
         <label>Rfferal Amount(%)</label>
         <input type="number" name="diposit_reward_percent[]" value="<?php if(!empty($main_max_deposit->percent))echo $main_max_deposit->percent;else echo '0'; ?>" class="form-control" required />
      </div>
      <div class="col-md-2 form-group">
         <label>Self Amount(%)</label>
         <input type="number" name="diposit_reward_self_percent[]" value="<?php if(!empty($main_max_deposit->percent_self))echo $main_max_deposit->percent_self;else echo '0'; ?>" class="form-control" required />
      </div>
</div>