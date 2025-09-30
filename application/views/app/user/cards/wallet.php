<?php foreach ($data as $key => $value) { 
$types = [3,4];
?> 
  <li>
    <div class="card-body refer-body 
    <?php if(in_array($value->type2, $types)){ ?>
    transaction-row"
    <?php } ?>
     <?php if(in_array($value->type2, $types)){ ?> data-id="<?=$value->id ?>" <?php } ?> data-type2="<?=$value->type2 ?>" >
        <div class="row align-items-center flex-nowrap mb-2">
            <div class="col-9 ps-0">
                <p class="mb-0 fw-medium"><?=$value->message ?></p>
                <p class="text-secondary small"><?=date("d M, Y h:i A",strtotime($value->date_time)) ?></p>
            </div>
            <div class="col-3 ps-0">
                <?php if($value->type=='credit'){ ?>
                    <span style="color: #43b943!important;">+ <?=price_formate($value->amount) ?></span>
                <?php }else{ ?>
                    <span style="color: red!important;">- <?=price_formate($value->amount) ?></span>
                <?php } ?>
            </div>
        </div>
    </div>    
</li>
<?php } ?>