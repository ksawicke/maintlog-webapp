<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Reminderrecipients is a Controller handling interactions related to Reminder recipients
*
* Reminderrecipients handles routes related mainly to the reminder_recipients table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Reminderrecipients extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Reminderrecipient_model');
    }
    
    public function save() {
        $this->Reminderrecipient_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/addReminderRecipient', 'refresh');
    }
}
