<?php

/**
 * Handles equipment unit object interactions.
 */
class Equipmentunit_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single equipment unit object.
     * 
     * @param type $equipmentunit_id
     * @return type
     */
    public function findOne($equipmentunit_id) {
        $equipmentunit = R::findOne('equipmentunit', ' id = :equipmentunit_id ', [':equipmentunit_id' => $equipmentunit_id]);
        
        return $equipmentunit;
    }
    
    /**
     * Finds all equipment unit objects.
     * 
     * @return type
     */
    public function findAll() {
        $equipmentunit = R::findAll('equipmentunit', ' ORDER BY equipment_unit ASC');
        
        return $equipmentunit;
    }
    
    /**
     * Creates or modifies an equipment unit object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $equipmentunit = ($post['equipmentunit_id']==0 ? R::dispense('equipmentunit') : R::load('equipmentunit', $post['equipmentunit_id']));
        $equipmenttype->equipment_type = $post['equipment_type'];
        
        if($post['equipmentunit_id']==0) {
            $equipmentunit->created = $now;
            $equipmentunit->created_by = $_SESSION['user_id'];
        } else {
            $equipmentunit->modified = $now;
            $equipmentunit->modified_by = $_SESSION['user_id'];
        }
        
        R::store($equipmentunit);
    }
    
    /**
     * Deletes an equipment unit object.
     * 
     * @param type $equipmentunit_id
     */
    public function delete($equipmentunit_id = null) {
        if(!is_null($equipmentunit_id)) {
            $equipmentunit = R::load('equipmentunit', $equipmentunit_id);
            R::trash($equipmentunit);
        }
    }

}