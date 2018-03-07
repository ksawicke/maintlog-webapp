<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Checklistitems is a Controller handling interactions related to checklist items
*
* Checklistitems handles routes related mainly to the checklistitem table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: Tag v2.3.1 $
* @access   public
*/
class Checklistitems extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Checklistitem_model');
    }
    
    /**
     * Get checklist items
     */
    public function getChecklistItems($checklist_equipmenttype_id = '') {
        $post = json_decode(file_get_contents('php://input'), true);
        $checklistitemmodel = [];
        
        $checklistitemmodel = $this->Checklistitem_model->findAll($checklist_equipmenttype_id);
        
        if(empty($checklistitemmodel)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $checklistitemmodel], JSON_NUMERIC_CHECK);
        }
        
        exit();
    }
    
    public function save() {
        $this->Checklistitem_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/checklistItems', 'refresh');
    }
    
    public function delete($checklistitem_id) {
        $this->load->library('session');
        
        $this->load->model('Checklistitem_model');
        $this->Checklistitem_model->delete($checklistitem_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/checklistItems', 'refresh');
    }
}
