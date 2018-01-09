<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Components is a Controller handling interactions related to components
*
* Component types handles routes related mainly to the component table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: Tag v2.0.0-alpha2 $
* @access   public
*/
class Components extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Component_model');
    }
    
    public function getComponents() {
        $post = json_decode(file_get_contents('php://input'), true);
        $componentmodel = [];
        
        $componentmodel = $this->Component_model->findAll();
        
        if(empty($componentmodel)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $componentmodel]);
        }
        
        exit();
    }
    
    public function save() {
        $this->Component_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/components', 'refresh');
    }
    
    public function delete($component_id) {
        $this->load->library('session');
        
        $this->load->model('Component_model');
        $this->Component_model->delete($component_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/components', 'refresh');
    }
}
