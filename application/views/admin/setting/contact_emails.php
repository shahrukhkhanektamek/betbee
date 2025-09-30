<?php  
if(!isset($i)) $i =0;
?>
<div class="row" style="position: relative;    padding-top: 12px;">
    <span class="btn btn-danger remove-btn" style="width: fit-content;">Remove</span>    
    <div class="mb-3 col-md-4">
        <label class="form-label">E-Mail Title *</label>
        <input class="form-control" type="text" placeholder="Title" value="<?php  if(isset($contact_emails->contact_emails_title[$i]))echo $contact_emails->contact_emails_title[$i] ?>" name="contact_emails_title[]" />
    </div>
    <div class="mb-3 col-md-8">
        <label class="form-label">E-Mail Value *</label>
        <input class="form-control" type="text" placeholder="Value" value="<?php  if(isset($contact_emails->contact_emails_value[$i]))echo $contact_emails->contact_emails_value[$i] ?>" name="contact_emails_value[]" />
    </div>
</div>