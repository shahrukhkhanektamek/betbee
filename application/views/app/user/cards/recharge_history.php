<?php foreach ($data as $key => $value) { ?> 
    <li>
        <div class="card-body refer-body">
            <div class="row align-items-center flex-nowrap mb-2">
                <div class="col-8 ps-0">
                   <p class="mb-0 fw-medium"><?=date("d M, Y h:i A",strtotime($value->date_time)) ?></p>
                   <p class="text-secondary small"><span style="color: #43b943!important;"> <?=price_formate($value->amount) ?></span></p>
                </div>
                <div class="col-4 ps-0 text-end">

                   <?php if($value->status==1){ ?>
                        <button class="btn btn-sm btn-success">Approve</button>
                    <?php }else if($value->status==0){ ?>
                        <button class="btn btn-sm btn-info">Pending</button>
                    <?php }else if($value->status==2){ ?>
                        <button class="btn btn-sm btn-danger">Rejected</button>
                    <?php } ?>

                </div>
            </div>
        </div>
    </li>
<?php } ?>