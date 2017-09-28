<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Appsettings is a Controller handling interactions related to application settings
*
* Appsettings handles routes related to managing the application
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Appsettings extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Appsetting_model');
    }
    
    public function save() {
        $this->Appsetting_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/appSettings', 'refresh');
    }
}
