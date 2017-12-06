<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Equipmentunits is a Controller handling interactions related to equipment units
*
* Equipment units handles routes related mainly to the equipment_units table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Equipmentunits extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Equipmentunit_model');
    }
    
    public function save() {
        $this->Equipmentunit_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentunit', 'refresh');
    }
    
    public function delete($equipmentunit_id) {
        $this->load->library('session');
        
        $this->load->model('Equipmentunit_model');
        $this->Equipmentunit_model->delete($equipmentunit_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentunit', 'refresh');
    }
}
