<?php

/**
 * Handles component type object interactions.
 */
class Componenttype_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single component type object.
     * 
     * @param type $componenttype_id
     * @return type
     */
    public function findOne($componenttype_id) {
        $componenttype = R::findOne('componenttype', ' id = :componenttype_id ', [':componenttype_id' => $componenttype_id]);
        
        return $componenttype;
    }
    
    /**
     * Finds all component type objects.
     * 
     * @return type
     */
    public function findAll() {
        $componenttype = R::findAll('componenttype', ' ORDER BY component_type ASC');
        
        return $componenttype;
    }
    
    /**
     * Creates or modifies an component type object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $componenttype = ($post['componenttype_id']==0 ? R::dispense('componenttype') : R::load('componenttype', $post['componenttype_id']));
        $componenttype->component_type = $post['component_type'];
        
        if($post['componenttype_id']==0) {
            $componenttype->created = $now;
            $componenttype->created_by = $_SESSION['user_id'];
        } else {
            $componenttype->modified = $now;
            $componenttype->modified_by = $_SESSION['user_id'];
        }
        
        R::store($componenttype);
    }
    
    /**
     * Deletes an component type object.
     * 
     * @param type $componenttype_id
     */
    public function delete($componenttype_id = null) {
        if(!is_null($componenttype_id)) {
            $componenttype = R::load('componenttype', $componenttype_id);
            R::trash($componenttype);
        }
    }

}