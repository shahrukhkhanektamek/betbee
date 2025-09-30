<?php  
if(!isset($i)) $i = 0;
?>
<div class="row" style="position: relative;    padding-top: 12px;">
    <span class="btn btn-danger remove-btn" style="width: fit-content;">Remove</span>    
    <div class="mb-3 col-md-4">
        <label class="form-label">Mobile Title *</label>
        <input class="form-control" type="text" placeholder="Title" value="<?php  if(isset($header_mobiles->header_mobiles_title[$i]))echo $header_mobiles->header_mobiles_title[$i] ?>" name="header_mobiles_title[]" />
    </div>
    <div class="mb-3 col-md-8">
        <label class="form-label">Mobile Value *</label>
        <input class="form-control" type="text" placeholder="Value" value="<?php  if(isset($header_mobiles->header_mobiles_value[$i]))echo $header_mobiles->header_mobiles_value[$i] ?>" name="header_mobiles_value[]" />
    </div>
</div>