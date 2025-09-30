<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Status_change extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        is_logged_in();
        // is_admin_logged_in();
        $this->load->model('Custom_model','custom');
    }   


    public function index($table_name)
    {
        $id = $this->input->post("id");
        $status = $this->input->post("status");
        $column = $this->input->post("column");
        $status_html = status_get($status,'yes_no');
        $this->db->update($table_name,array($column=>$status,),array("id"=>$id,));         
        $result['message'] = "Update successfully";
        $result['status']  = "200";
        $result['action']  = "edit";
        $result['data'] = array("status"=>$status_html,);
        echo json_encode($result);
    }
}



?>