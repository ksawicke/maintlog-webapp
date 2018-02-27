<?php

/**
 * Handles checklist category object interactions.
 */
class Checklistcategory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single checklist category object.
     * 
     * @param type $equipmenttype_id
     * @return array
     */
    public function findOne($checklistcategory_id) {
        $user = R::findOne('checklistcategory', ' id = :checklistcategory_id ', [':checklistcategory_id' => $checklistcategory_id]);
        
        return $user;
    }
    
    /**
     * Finds all checklist category objects.
     * 
     * @return array
     */
    public function findAll() {
        return [];
    }
    
    /**
     * Creates or modifies a checklist category object.
     */
    public function store($post) {        
        //
    }
    
    /**
     * Deletes a checklist category type object.
     * 
     * @param integer $checklistitem_id
     */
    public function delete($checklistcategory_id = null) {
        //
    }

}