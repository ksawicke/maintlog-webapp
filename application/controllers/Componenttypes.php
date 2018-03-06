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
* @version  $Revision: Tag v2.3 $
* @access   public
*/
class Componenttypes extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Componenttype_model');
    }
    
    public function getComponentTypes() {
        $post = json_decode(file_get_contents('php://input'), true);
        $componenttypemodel = [];
        
        $componenttypemodel = $this->Componenttype_model->findAll();
        
        if(empty($componenttypemodel)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $componenttypemodel], JSON_NUMERIC_CHECK);
        }
        
        exit();
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
