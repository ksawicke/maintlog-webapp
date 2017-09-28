<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Users is a Controller handling interactions related to users
*
* Users handles routes related mainly to the users table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Users extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('User_model');
    }
    
    /**
     * 
     */
    public function save() {
        $this->User_model->store($this->input->post());
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/users', 'refresh');
    }
    
    /**
     * 
     * @param type $equipment_id
     */
    public function toggle_activation($equipment_id) {
        $this->User_model->toggle_activation($equipment_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/users', 'refresh');
    }
}
