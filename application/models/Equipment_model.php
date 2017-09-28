<?php

/**
 * Handles equipment object interactions
 */
class Equipment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single equipment object.
     * 
     * @param type $equipment_id
     * @return type
     */
    public function findOne($equipment_id) {
        $equipment = R::findOne('equipment', ' id = :equipment_id ', [':equipment_id' => $equipment_id]);
        
        return $equipment;
    }
    
    /**
     * Finds all equipment objects.
     * 
     * @return type
     */
    public function findAll() {
        $equipment = R::getAll('SELECT equipment.id, equipment.unit_number, equipment.manufacturer_id, equipment.model_number, equipment.equipmenttype_id, manufacturer.manufacturer_name, equipmenttype.equipment_type FROM equipment LEFT JOIN manufacturer ON manufacturer.id = equipment.manufacturer_id LEFT JOIN equipmenttype ON equipmenttype.id = equipment.equipmenttype_id ORDER BY equipment.model_number ASC');
        
        return $equipment;
    }
    
    /**
     * Finds all equipment objects.
     * 
     * @return type
     */
    public function findAllByEquipmentTypeIdAndQuery($equipmenttype_id, $query) {        
        $dbQuery = 'SELECT equipment.id, equipment.unit_number, equipment.manufacturer_id, equipment.model_number, equipment.equipmenttype_id, manufacturer.manufacturer_name, equipmenttype.equipment_type, CONCAT( equipment.unit_number,  " ", manufacturer.manufacturer_name,  " ", equipment.model_number ) AS search_match
FROM equipment
LEFT JOIN manufacturer ON manufacturer.id = equipment.manufacturer_id
LEFT JOIN equipmenttype ON equipmenttype.id = equipment.equipmenttype_id
WHERE equipment.equipmenttype_id =  "' . $equipmenttype_id . '"
AND CONCAT( equipment.unit_number,  " ", manufacturer.manufacturer_name,  " ", equipment.model_number ) LIKE  "%' . $query . '%"
ORDER BY equipment.model_number ASC';

        $equipment = R::getAll($dbQuery);
        
        return $equipment;
    }
    
    /**
     * Creates or modifies record
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $equipment = ($post['equipment_id']==0 ? R::dispense('equipment') : R::load('equipment', $post['equipment_id']));
        $equipment->unit_number = $post['unit_number'];
        $equipment->manufacturer_id = $post['manufacturer_id'];
        $equipment->model_number = $post['model_number'];
        $equipment->equipmenttype_id = $post['equipmenttype_id'];
        
        if($post['equipment_id']==0) {
            $equipment->created = $now;
            $equipment->created_by = $_SESSION['user_id'];
        } else {
            $equipment->modified = $now;
            $equipment->modified_by = $_SESSION['user_id'];
        }
        
//        echo '<pre>';
//        var_dump($equipment);
//        exit();
        
        R::store($equipment);
    }
    
    public function delete($equipment_id = null) {
        if(!is_null($equipment_id)) {
            $equipment = R::load('equipment', $equipment_id);
            R::trash($equipment);
        }
    }

}