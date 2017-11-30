<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Equipmentmodel is a Controller handling interactions related to equipment model
*
* Equipmentmodel handles routes related mainly to the equipmentmodel table
* used by the application.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
class Equipmentmodel extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Equipmentmodel_model');
    }
    
    public function getEquipmentByType() {
        $post = json_decode(file_get_contents('php://input'), true);
        $equipmentmodel = [];
        
        if(!array_key_exists('query', $post) || !array_key_exists('id', $post)) {
            http_response_code(404);
        } else {
            http_response_code(200);
            $equipmentmodel = $this->Equipment_model->findAllByEquipmentTypeIdAndQuery($post['id'], $post['query']);
        }
        
        echo json_encode($equipmentmodel);
//        echo json_encode(['equipment' => $equipment]);
        exit();
    }
    
    public function save() {
        $this->Equipmentmodel_model->store($this->input->post());
        
        $this->load->library('session');
        
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentmodel', 'refresh');
    }
    
    public function delete($equipment_id) {
        $this->load->library('session');
        
        $this->load->model('Equipmentmodel_model');
        $this->Equipmentmodel_model->delete($equipment_id);
        $this->session->set_flashdata('data_name', 'data_value');
        redirect('/app/equipmentmodel', 'refresh');
    }
}
