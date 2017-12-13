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
* @version  $Revision: 0.2 $
* @access   public
*/
class Servicelog extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('Servicelog_model');
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
        
        $this->Servicelog_model->store($post);
    }
}
