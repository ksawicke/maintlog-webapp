<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Checklistcategories is a Controller handling interactions related to checklist categories
*
* Checklistcategories handles routes related mainly to the checklistcategory table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>

* @access   public
*/
class Checklistcategories extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Checklistcategory_model');
    }
    
    /**
     * Get checklist categories
     */
    public function getChecklistCategories() {
        $post = json_decode(file_get_contents('php://input'), true);
        $checklistcategorymodel = [];
        
        $checklistcategorymodel = $this->Checklistcategory_model->findAll();
        
        if(empty($checklistcategorymodel)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $checklistcategorymodel], JSON_NUMERIC_CHECK);
        }
        
        exit();
    }
    
    /**
     * Save a checklist category
     */
    public function save() {
        $this->Checklistcategory_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/checklistCategories', 'refresh');
    }
    
    /**
     * Delete a checklist category
     * 
     * @param integer $checklistcategory_id
     */
    public function delete($checklistcategory_id) {
        $this->load->library('session');
        
        $this->load->model('Checklistcategory_model');
        $this->Checklistcategory_model->delete($checklistcategory_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/checklistCategories', 'refresh');
    }
}
