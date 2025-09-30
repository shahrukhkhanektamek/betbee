<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Delete extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        is_logged_in();
        is_admin_logged_in();
        $this->load->model('Custom_model','custom');
    }

	public function index($table_name)
	{
        $ids = $this->input->post("ids");
        $trashd = $this->input->get("trashd");
        $cols = explode(",", $this->input->get("cols"));
        // $ids = [34];
        $rowid = $this->input->post("rowid");
        $id_html = '';
        $slug = '';
        $old_slug_data = $this->db->select("slug")->where_in("id",$ids)->get_where($table_name)->result_object();
        if(!empty($old_slug_data))
        {
           $slug = $old_slug_data[0]->slug;
        }
        foreach ($ids as $key => $value)
        {
            if($key==0)
                $id_html .= "#".$rowid.$value;
            else
                $id_html .= ", #".$rowid.$value;
        }
        if(!empty($ids))		
        {
            if(trash==false || !empty($trashd))
            {
                $images_path = [];
                foreach ($cols as $key => $value)
                {
                    if(!empty($value))
                    {
                        $this->db->where_in("id",$ids);
                        $old_img_data = $this->db->select($value)->get_where($table_name)->result_object();
                        if(!empty($old_img_data))
                        {
                            $old_img_data = $old_img_data[0];
                            $images = $old_img_data->$value;
                            if(!empty($images))
                            {
                                if(json_decode($images))
                                {
                                    foreach (json_decode($images) as $key5 => $value_img)
                                        $images_path[] = $value_img->image_path;
                                }
                            }
                        }
                    }
                }
                $this->db->where_in("id",$ids);
                if($this->db->delete($table_name))
                {
                    $row = true;
                    foreach ($images_path as $key5 => $value_img)
                    {
                        if(file_exists(FCPATH.'upload/'.$value_img))
                            unlink(FCPATH.'upload/'.$value_img);
                    }
                    $this->db->delete("meta_tags",array("slug"=>$slug,));                    
                }
                else
                {
                    $row = false;            
                }
            }
            else
            {
                $this->db->where_in("id",$ids);
                if($this->db->update($table_name,array("is_delete"=>1,)))
                {
                    $row = true;
                    $this->db->delete("slugs",array("slug"=>$slug,));
                }
                else
                {
                    $row = false;
                }
            }

    		if($row)
            {                
                $result['message'] = "Delete successfully";
                $result['success']  = "200";
                $result['id']  = $id_html;
            }
            else
            {
                $result['message'] = "Delete not successfully";
                $result['success']  = "400";
                $result['id']  = $id_html;
            }
        }
        else
        {
            $result['message'] = "error...";
            $result['success']  = "400";
            $result['id']  = $id_html;
        }
        echo json_encode($result);
	}


    public function permanent($table_name)
    {
        $ids = $this->input->post("ids");
        $rowid = $this->input->post("rowid");
        $id_html = '';
        foreach ($ids as $key => $value)
        {
            if($key==0)
                $id_html .= "#".$rowid.$value;
            else
                $id_html .= ", #".$rowid.$value;
        }
        if(!empty($ids))        
        {
            $this->db->where_in("id",$ids);
            if($this->db->delete($table_name))
                $row = true;
            else
                $row = false;
            if($row)
            {
                $result['message'] = "Delete successfully";
                $result['success']  = "200";
                $result['id']  = $id_html;
            }
            else
            {
                $result['message'] = "Delete not successfully";
                $result['success']  = "400";
                $result['id']  = $id_html;
            }
        }
        else
        {
            $result['message'] = "error...";
            $result['success']  = "400";
            $result['id']  = $id_html;
        }
        echo json_encode($result);
    }





}



?>