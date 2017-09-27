<?php

/**
 * Handles app setting object interactions.
 */
class Appsetting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single equipment type object.
     * 
     * @param type $equipmenttype_id
     * @return type
     */
    public function findOne($equipmenttype_id) {
        $equipmenttype = R::findOne('equipmenttype', ' id = :equipmenttype_id ', [':equipmenttype_id' => $equipmenttype_id]);
        
        return $equipmenttype;
    }
    
    /**
     * Finds all equipment type objects.
     * 
     * @return type
     */
    public function findAll() {
        $equipmenttype = R::findAll('equipmenttype', ' ORDER BY equipment_type ASC');
        
        return $equipmenttype;
    }
    
    /**
     * Creates or modifies an app setting object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $appsetting = ($post['appsetting_id']==0 ? R::dispense('appsetting') : R::load('appsetting', $post['appsetting_id']));
        $equipmenttype->equipment_type = $post['equipment_type'];
        
        if($post['equipmenttype_id']==0) {
            $equipmenttype->created = $now;
            $equipmenttype->created_by = $_SESSION['user_id'];
        } else {
            $equipmenttype->modified = $now;
            $equipmenttype->modified_by = $_SESSION['user_id'];
        }
        
        R::store($equipmenttype);
    }
    
    /**
     * Deletes an equipment type object.
     * 
     * @param type $equipmenttype_id
     */
    public function delete($equipmenttype_id = null) {
        if(!is_null($equipmenttype_id)) {
            $equipmenttype = R::load('equipmenttype', $equipmenttype_id);
            R::trash($equipmenttype);
        }
    }

}