<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Equipment_model');
    }
    
    public function save() {
        $this->Equipment_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipment', 'refresh');
    }
    
    public function delete($equipment_id) {
        $this->load->library('session');
        
        $this->load->model('Equipment_model');
        $this->Equipment_model->delete($equipment_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipment', 'refresh');
    }
}
