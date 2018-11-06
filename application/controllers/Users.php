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

* @access   public
*/
class Users extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('User_model');
    }
    
    public function getUsers() {
		$this->load->model('Reminderrecipient_model');

        $post = json_decode(file_get_contents('php://input'), true);
		$userModel = [];
		$reminderRecipients = [];
        
        $userModel = $this->User_model->findAll();
        $reminderRecipientModel = $this->Reminderrecipient_model->findAll();

        foreach($reminderRecipientModel as $id => $reminderRecipient) {
        	$reminderRecipients[] = $reminderRecipient->user_id;
		}
        
        if(empty($userModel)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            foreach($userModel as $id => $userData) {
				$userModel[$id]['current'] = (($userData['id']===$_SESSION['user_id']) ? "1" : "0");
				$userModel[$id]['isReminderRecipient'] = (in_array($userData['id'], $reminderRecipients) ? "1" : "0");
            }
            
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $userModel], JSON_NUMERIC_CHECK);
        }
        
        exit();
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
    
    /**
     * Ensure that the PIN being put in for a user is not used, is numeric, and 4 digits in length
     */
    public function validateUserData() {
        $post = json_decode(file_get_contents('php://input'), true);
        $response = '';
        $pass = false;
        $response = $this->User_model->findByPin($post['data']);
                
        if(is_null($response) && is_numeric($post['data']) && strlen($post['data'])==4) {
            $pass = true;
        } elseif(!is_null($response) && is_numeric($post['data']) && strlen($post['data'])==4 && $response->id==$post['compare']) {
            $pass = true;
        }
        
        if(!$pass) {
            echo json_encode(['success' => false]);
            http_response_code(404);
        } else {
            echo json_encode(['success' => true]);
            http_response_code(200);
        }
        
        exit();
    }
}
