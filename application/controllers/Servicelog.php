<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Servicelog is a Controller handling payloads to save data
*
* Servicelog handles routes related mainly to the service log form.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: Tag v2.3.1 $
* @access   public
*/
class Servicelog extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Servicelog_model');
        $this->load->model('Report_model');
    }
    
    public function getEquipmentByType() {
        $post = json_decode(file_get_contents('php://input'), true);
        $equipment = [];
        
        if(!array_key_exists('query', $post) || !array_key_exists('id', $post)) {
            http_response_code(404);
        } else {
            http_response_code(200);
            $equipment = $this->Equipment_model->findAllByEquipmentTypeIdAndQuery($post['id'], $post['query']);
        }
        
        echo json_encode($equipment);
//        echo json_encode(['equipment' => $equipment]);
        exit();
    }
    
    public function save() {
        $post = json_decode(file_get_contents('php://input'), true);
        
        $prev_service_log = $this->Report_model->findServiceLogs($post['id'], 'compare');
        
        $this->Servicelog_model->store($post, $prev_service_log);
    }
    
    public function deleteServiceLog() {
        $post = json_decode(file_get_contents('php://input'), true);
        $servicelog = [];
        
        if(!$this->input->is_ajax_request() && !array_key_exists('action', $post) && is_int($post['servicelogid']) && $post['tokenCheck']!='CBxjkc6b32cb2ccy23b!8acbac%5654@6sdsassf') {
            http_response_code(404);
            $servicelog = ['success' => false, 'message' => 'There was an error deleting this service log. Please try again.'];
        } else {
            $servicelog = $this->Servicelog_model->deleteServiceLogAndChildren($post['servicelogid']);
        }
        
        if($servicelog['success']) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        
        echo json_encode($servicelog);
        exit();
    }
}
