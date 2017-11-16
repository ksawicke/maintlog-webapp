<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Mileagechoices is a Controller handling interactions related to Mileage choices
*
* Mileage choices handles routes related mainly to the mileage_choices table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Mileagechoices extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Mileagechoice_model');
    }
    
    public function save() {
        $this->Mileagechoice_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/mileageChoices', 'refresh');
    }
    
    public function delete($mileagechoice_id) {
        $this->load->library('session');
        
        $this->load->model('Mileagechoice_model');
        $this->Mileagechoice_model->delete($mileagechoice_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/mileageChoices', 'refresh');
    }
}
