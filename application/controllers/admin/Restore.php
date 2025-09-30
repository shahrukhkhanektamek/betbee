<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Restore extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        is_logged_in();
        // is_admin_logged_in();
        $this->load->model('Custom_model','custom');
    }

	public function index($table_name,$page_name,$controller_name)
	{
        $r_type = $this->input->get("r_type");
        $ids = $this->input->post("ids");
        $insert_id = $id = $ids;
        $rowid = $this->input->post("rowid");
        $id_html = "#".$rowid.$ids;        
        if(!empty($ids))		
        {            
            $slug = '';
            $old_slug = '';
            $old_slug_data = $this->db->select("slug")->get_where($table_name,array("id"=>$id,))->result_object();
            if(!empty($old_slug_data))
            {
               $slug = $old_slug = $old_slug_data[0]->slug;
            }
            $row = true;
            if($table_name!='meta_tags' && empty($r_type))
            {
                $slug = $this->Custom_model->insert_slug($slug,$insert_id,$table_name,$controller_name."/detail",$old_slug,$page_name);
            }
            $this->db->where(array("id"=>$ids,));
            if($this->db->update($table_name,array("is_delete"=>0,)))
                $row = true;
            else
                $row = false;
    		if($row)
            {
                $result['message'] = "Restore successfully";
                $result['success']  = "200";
                $result['id']  = $id_html;
            }
            else
            {
                $result['message'] = "Restore not successfully";
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