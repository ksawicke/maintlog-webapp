<?php

/**
 * Handles equipment object interactions
 */
class Servicelog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Creates or modifies record
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        echo '<pre>';
        var_dump($post);
        
//        $equipment = ($post['equipment_id']==0 ? R::dispense('equipment') : R::load('equipment', $post['equipment_id']));
//        $equipment->unit_number = $post['unit_number'];
//        $equipment->manufacturer_id = $post['manufacturer_id'];
//        $equipment->model_number = $post['model_number'];
//        $equipment->equipmenttype_id = $post['equipmenttype_id'];
//        
//        if($post['equipment_id']==0) {
//            $equipment->created = $now;
//            $equipment->created_by = $_SESSION['user_id'];
//        } else {
//            $equipment->modified = $now;
//            $equipment->modified_by = $_SESSION['user_id'];
//        }
//        
////        echo '<pre>';
////        var_dump($equipment);
////        exit();
//        
//        R::store($equipment);
    }

}