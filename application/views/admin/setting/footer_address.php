<?php  
if(!isset($i)) $i = 0;
?>
<div class="row" style="position: relative;    padding-top: 12px;">
    <span class="btn btn-danger remove-btn" style="width: fit-content;">Remove</span>    
    <div class="mb-3 col-md-4">
        <label class="form-label">Address Title *</label>
        <input class="form-control" type="text" placeholder="Title" value="<?php  if(isset($footer_address->footer_address_title[$i]))echo $footer_address->footer_address_title[$i] ?>" name="footer_address_title[]" />
    </div>
    <div class="mb-3 col-md-8">
        <label class="form-label">Address Value *</label>
        <input class="form-control" type="text" placeholder="Value" value="<?php  if(isset($footer_address->footer_address_value[$i]))echo $footer_address->footer_address_value[$i] ?>" name="footer_address_value[]" />
    </div>
</div>