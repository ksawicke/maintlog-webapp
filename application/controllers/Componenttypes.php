<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Componenttypes is a Controller handling interactions related to component types
*
* Component types handles routes related mainly to the component_types table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Componenttypes extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Componenttype_model');
    }
    
    public function save() {
        $this->Componenttype_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/componentTypes', 'refresh');
    }
    
    public function delete($componenttype_id) {
        $this->load->library('session');
        
        $this->load->model('Componenttype_model');
        $this->Componenttype_model->delete($componenttype_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/componentTypes', 'refresh');
    }
}
