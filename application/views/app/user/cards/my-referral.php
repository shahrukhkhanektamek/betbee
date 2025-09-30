<?php foreach ($data as $key => $value) { ?> 
   <li>
      <div class="card-body refer-body">
         <div class="row align-items-center flex-nowrap mb-2">
            <div class="col-auto">
               <figure class="avatar avatar-40 mb-0 coverimg rounded-circle" style="background-image: url(&quot;<?=base_url('upload/'.$value->profile_image) ?>&quot;);">
                  <img src="<?=base_url('upload/'.$value->profile_image) ?>" alt="" style="display: none;">
               </figure>
            </div>
            <div class="col ps-0">
               <p class="mb-0 fw-medium"><?=$value->fname ?></p>
               <p class="text-secondary small m-0"><?=$value->mobile ?></p>
               <p class="m-0" style="font-weight: 600;margin: 5px 0 0 0;">#<?=$value->user_id ?></p>
            </div>
         </div>
      </div>
   </li>
<?php } ?>