   <div class="mb-3 col-md-6">
      <label class="form-label">Meta Title</label>
      <input class="form-control" type="text" placeholder="Meta Title" value="<?php if(!empty($row))echo $row->meta_title ?>" name="meta_title" />
   </div>

   <div class="mb-3 col-md-6">
      <label class="form-label">Meta Auther</label>
      <input class="form-control" type="text" placeholder="Meta Auther" value="<?php if(!empty($row))echo $row->meta_auther ?>" name="meta_auther" />
   </div>

   <div class="mb-3 col-md-12">
      <label class="form-label">Meta Keywords</label>
      <input class="form-control" type="text" placeholder="Meta Keywords" value="<?php if(!empty($row))echo $row->meta_keyword ?>" name="meta_keyword" />
   </div>

   <div class="mb-3 col-md-12">
      <label class="form-label">Meta Description</label>
      <textarea class="form-control" name="meta_description" placeholder="Meta Description" rows="5"><?php if(!empty($row))echo $row->meta_description ?></textarea>
   </div>