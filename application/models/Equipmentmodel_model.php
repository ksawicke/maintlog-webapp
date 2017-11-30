 <?php

/**
 * Handles equipment model object interactions
 */
class Equipmentmodel_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single equipment model object.
     * 
     * @param type $equipment_id
     * @return type
     */
    public function findOne($equipment_id) {
        $equipmentmodel = R::findOne('equipmentmodel', ' id = :equipment_id ', [':equipment_id' => $equipment_id]);
        
        return $equipmentmodel;
    }
    
    /**
     * Finds all equipment model objects.
     * 
     * @return type
     */
    public function findAll() {
        $equipmentmodel = R::getAll('SELECT equipmentmodel.id, equipmentmodel.manufacturer_id, equipmentmodel.model_number, equipmentmodel.equipmenttype_id, manufacturer.manufacturer_name, equipmenttype.equipment_type FROM equipmentmodel LEFT JOIN manufacturer ON manufacturer.id = equipmentmodel.manufacturer_id LEFT JOIN equipmenttype ON equipmenttype.id = equipmentmodel.equipmenttype_id ORDER BY equipmentmodel.model_number ASC');
        
        return $equipmentmodel;
    }
    
    /**
     * Finds all equipment objects.
     * 
     * @return type
     */
    public function findAllByEquipmentTypeIdAndQuery($equipmenttype_id, $query) {        
        $dbQuery = 'SELECT equipmentmodel.id, equipmentmodel.manufacturer_id, equipmentmodel.model_number, equipmentmodel.equipmenttype_id, manufacturer.manufacturer_name, equipmenttype.equipment_type, CONCAT( equipmentmodel.unit_number,  " ", manufacturer.manufacturer_name,  " ", equipmentmodel.model_number ) AS search_match
FROM equipmentmodel
LEFT JOIN manufacturer ON manufacturer.id = equipmentmodel.manufacturer_id
LEFT JOIN equipmenttype ON equipmenttype.id = equipmentmodel.equipmenttype_id
WHERE equipmentmodel.equipmenttype_id =  "' . $equipmenttype_id . '"
AND CONCAT( equipmentmodel.unit_number,  " ", manufacturer.manufacturer_name,  " ", equipmentmodel.model_number ) LIKE  "%' . $query . '%"
ORDER BY equipmentmodel.model_number ASC';

        $equipmentmodel = R::getAll($dbQuery);
        
        return $equipmentmodel;
    }
    
    /**
     * Creates or modifies record
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $equipmentmodel = ($post['equipment_id']==0 ? R::dispense('equipmentmodel') : R::load('equipmentmodel', $post['equipment_id']));
        $equipmentmodel->manufacturer_id = $post['manufacturer_id'];
        $equipmentmodel->model_number = $post['model_number'];
        $equipmentmodel->equipmenttype_id = $post['equipmenttype_id'];
        
        if($post['equipment_id']==0) {
            $equipmentmodel->created = $now;
            $equipmentmodel->created_by = $_SESSION['user_id'];
        } else {
            $equipmentmodel->modified = $now;
            $equipmentmodel->modified_by = $_SESSION['user_id'];
        }
        
//        echo '<pre>';
//        var_dump($equipment);
//        exit();
        
        R::store($equipmentmodel);
    }
    
    public function delete($equipment_id = null) {
        if(!is_null($equipment_id)) {
            $equipmentmodel = R::load('equipmentmodel', $equipment_id);
            R::trash($equipmentmodel);
        }
    }

}