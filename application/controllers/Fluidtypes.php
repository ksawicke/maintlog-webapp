<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Fluidtypes is a Controller handling interactions related to fluid types
*
* Fluidtypes handles routes related mainly to the fluid_types table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Fluidtypes extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Fluidtype_model');
    }
    
    public function save() {
        $this->Fluidtype_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/fluidTypes', 'refresh');
    }
    
    public function delete($fluidtype_id) {
        $this->load->library('session');
        
        $this->load->model('Fluidtype_model');
        $this->Fluidtype_model->delete($fluidtype_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/fluidTypes', 'refresh');
    }
}
