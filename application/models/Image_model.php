<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Image_model extends CI_Model
{
    // Users Data
    public function upload_image($all_image_column_names,$table_name='',$p_id='')
    {
    	$return_array = array();
    	foreach ($all_image_column_names as $key => $value)
    	{
    		if(!empty($table_name))
    			check_column_and_ceate($value,$table_name);

    		$old_img_data = $this->db->select($value)->get_where($table_name,array("id"=>$p_id,))->result_object();
			if(!empty($old_img_data))
			{
				$old_img_data = $old_img_data[0];
				$images = $old_img_data->$value;
				if(!empty($images))
				{
					if(json_decode($images))
					{
						foreach (json_decode($images) as $key5 => $value_img)
						{
							if(file_exists(FCPATH.'upload/'.$value_img->image_path))
								unlink(FCPATH.'upload/'.$value_img->image_path);
						}
					}
				}
			}


    		$images_data = array();
	    	$image_name = $this->input->post("image_name".$value);
	    	if(!empty($image_name))
	    	{
		    	$image_alt_text = $this->input->post("image_alt_text".$value);
		    	$image_string = $this->input->post("image_string".$value);
		    	foreach ($image_name as $key2 => $value2)
		    	{
			    	$image_content = base64_decode(explode(",", $image_string[$key2])[1]);
		            $image_time = time().$key.$key2.$value.'.'.explode(".", $image_name[$key2])[1];
		            $ok=false;
	            	if(file_put_contents(APPPATH.'../upload/'.$image_time,$image_content))
	            	{
	            		$ok = true;
	            	}
		            else
		            {
		            	$ok = true;
		            }
		            if($ok==true)
		            {
		            	$images_data[] = array(
		            		"image_name"=>$image_name[$key2],
		            		"image_path"=>$image_time,
		            		"image_alt_text"=>$image_alt_text[$key2],
		            	);
		            }
		        }
				$images_data = json_encode($images_data);
				$return_array[$value] = $images_data;
			}
		}
		return $return_array;
        // print_r($all_image_column_names);
    }
}
