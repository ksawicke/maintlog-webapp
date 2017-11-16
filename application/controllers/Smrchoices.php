<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Smrchoices is a Controller handling interactions related to SMR choices
*
* SMR choices handles routes related mainly to the smr_choices table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Smrchoices extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Smrchoice_model');
    }
    
    public function save() {
        $this->Smrchoice_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/smrChoices', 'refresh');
    }
    
    public function delete($smrchoice_id) {
        $this->load->library('session');
        
        $this->load->model('Smrchoice_model');
        $this->Smrchoice_model->delete($smrchoice_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/smrChoices', 'refresh');
    }
}
