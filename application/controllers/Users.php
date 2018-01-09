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
* @version  $Revision: Tag v2.0.0-alpha2 $
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
        $post = json_decode(file_get_contents('php://input'), true);
        $usermodel = [];
        
        $usermodel = $this->User_model->findAll();
        
        if(empty($usermodel)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            foreach($usermodel as $id => $userData) {
                $usermodel[$id]['current'] = (($userData['id']===$_SESSION['user_id']) ? "1" : "0");
            }
            
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $usermodel]);
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
}
