<?php  
if(!isset($i)) $i =0;
?>
<div class="row" style="position: relative;    padding-top: 12px;">
    <span class="btn btn-danger remove-btn" style="width: fit-content;">Remove</span>    
    <div class="mb-3 col-md-4">
        <label class="form-label">E-Mail Title *</label>
        <input class="form-control" type="text" placeholder="Title" value="<?php  if(isset($header_emails->header_emails_title[$i]))echo $header_emails->header_emails_title[$i] ?>" name="header_emails_title[]" />
    </div>
    <div class="mb-3 col-md-8">
        <label class="form-label">E-Mail Value *</label>
        <input class="form-control" type="text" placeholder="Value" value="<?php  if(isset($header_emails->header_emails_value[$i]))echo $header_emails->header_emails_value[$i] ?>" name="header_emails_value[]" />
    </div>
</div>