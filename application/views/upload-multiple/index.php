  <div class="drag-area"> 
    <div class="upload-icon">
      <i class="fa fa-upload"></i> 
    </div>
    <input type="file" accept="<?=$accept ?>" <?php if($multiple==true)echo 'multiple'; ?> class="multiimagesuploadimages" data-target="multiimagesuploadimages<?=$position ?>" data-position="<?=$position ?>" data-cname="<?=$columna_name ?>" data-type="<?php if($multiple==true)echo 'multiple';else echo'single'; ?>"  data-col="<?=$col ?>" data-alt_text="<?=$alt_text ?>">
  </div>
  <ul class="images-ul csulli row  <?php if($multiple==true)echo 'ui-sortable'; ?>  " id="multiimagesuploadimages<?=$position ?>">
	<?php  
	if(!empty($row))
	{
		$images_array = array();
		$images = $row->$columna_name;
		if(!empty($images))
		{
			$images_array = json_decode($images);
		}
		if(!empty($images_array))
		{
			foreach ($images_array as $key_image => $value_image)
			{
				$image_path = FCPATH.'upload/'.$value_image->image_path;
				if(file_exists($image_path))
				{
					$image = base64_encode(file_get_contents($image_path));
				
	?>
	  	<li class="<?=$col ?>" style="cursor: move;">
		 <div class="csulli-iiner">
		    <button class="btn btn-sa-muted btn-sm mx-n3 multiimagesremovebtnimages" type="button" title="Delete image" style="float: right;">
		        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
		           <path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"></path>
		        </svg>
		     </button>
		    <img src="data:image/png;base64,<?=$image ?>" name="image_string<?=$columna_name ?>[]">
		    <input type="hidden" value="<?=$value_image->image_name ?>" name="image_name<?=$columna_name ?>[]">
		    <input type="hidden" value="data:image/png;base64,<?=$image ?>" name="image_string<?=$columna_name ?>[]">
		    <input type="text" name="image_alt_text<?=$columna_name ?>[]" value="<?=$value_image->image_alt_text ?>" class="form-control form-control-sm" style="display:none;">
		    </div>
		  </li>
	<?php } } } } ?>
  </ul>