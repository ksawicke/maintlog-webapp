<?php

/**
 * Handles checklist item object interactions.
 */
class Checklistitem_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single checklist item object.
     * 
     * @param type $equipmenttype_id
     * @return array
     */
    public function findOne($equipmenttype_id) {
        return [];
    }
    
    /**
     * Finds all checklist item objects.
     * 
     * @return array
     */
    public function findAll() {
        return [];
    }
    
    /**
     * Creates or modifies a checklist item object.
     */
    public function store($post) {        
        //
    }
    
    /**
     * Deletes a checklist item type object.
     * 
     * @param integer $checklistitem_id
     */
    public function delete($checklistitem_id = null) {
        //
    }

}