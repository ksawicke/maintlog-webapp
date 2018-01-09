<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Equipmentunits is a Controller handling interactions related to equipment units
*
* Equipment units handles routes related mainly to the equipment_units table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: Tag v2.0.0-alpha2 $
* @access   public
*/
class Equipmentunits extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Equipmentunit_model');
    }
    
    public function getUnitByModelId() {
        $post = json_decode(file_get_contents('php://input'), true);
        $equipmentunit = [];
        
        if(!array_key_exists('id', $post)) {
            http_response_code(404);
            echo json_encode(['success' => false]);
        } else {
            http_response_code(200);
            $equipmentunit = $this->Equipmentunit_model->findAllByModelId($post['id']);
            echo json_encode(['success' => true, 'data' => $equipmentunit]);
        }
        
        exit();
    }
    
    public function save() {
        $this->Equipmentunit_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentunit', 'refresh');
    }
    
    public function delete($equipmentunit_id) {
        $this->load->library('session');
        
        $this->load->model('Equipmentunit_model');
        $this->Equipmentunit_model->delete($equipmentunit_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentunit', 'refresh');
    }
}
