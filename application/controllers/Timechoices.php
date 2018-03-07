<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Timechoices is a Controller handling interactions related to Time choices
*
* Time choices handles routes related mainly to the time_choices table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: Tag v2.3.1 $
* @access   public
*/
class Timechoices extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Timechoice_model');
    }
    
    public function getTimeChoices() {
        $post = json_decode(file_get_contents('php://input'), true);
        $timechoicemodel = [];
        
        $timechoicemodel = $this->Timechoice_model->findAll();
        
        if(empty($timechoicemodel)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $timechoicemodel], JSON_NUMERIC_CHECK);
        }
        
        exit();
    }
    
    public function save() {
        $this->Timechoice_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/timeChoices', 'refresh');
    }
    
    public function delete($timechoice_id) {
        $this->load->library('session');
        
        $this->load->model('Timechoice_model');
        $this->Timechoice_model->delete($timechoice_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/timeChoices', 'refresh');
    }
}
