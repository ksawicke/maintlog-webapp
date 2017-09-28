<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Equipmenttypes is a Controller handling interactions related to equipment types
*
* Equipment types handles routes related mainly to the equipment_types table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Equipmenttypes extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Equipmenttype_model');
    }
    
    public function save() {
        $this->Equipmenttype_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentTypes', 'refresh');
    }
    
    public function delete($equipmenttype_id) {
        $this->load->library('session');
        
        $this->load->model('Equipmenttype_model');
        $this->Equipmenttype_model->delete($equipmenttype_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentTypes', 'refresh');
    }
}
