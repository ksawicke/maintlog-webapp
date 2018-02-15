<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Manufacturers is a Controller handling interactions related to manufacturers
*
* Manufacturers handles routes related mainly to the manufacturers table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: Tag v2.1 $
* @access   public
*/
class Manufacturers extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Manufacturer_model');
    }
    
    public function save() {
        $this->Manufacturer_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/manufacturers', 'refresh');
    }
    
    public function delete($manufacturer_id) {
        $this->load->library('session');
        
        $this->load->model('Manufacturer_model');
        $this->Manufacturer_model->delete($manufacturer_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/manufacturers', 'refresh');
    }
}
