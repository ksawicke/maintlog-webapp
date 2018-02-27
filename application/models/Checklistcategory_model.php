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
        $checklistcategories = R::findAll('checklistcategory', ' ORDER BY category ASC');
        
        return $checklistcategories;
    }
    
    /**
     * Creates or modifies a checklist category object.
     */
    public function store($post) {
        $now = date('Y-m-d h:i:s');

        $checklistcategory = ($post['checklistcategory_id']==0 ? R::dispense('checklistcategory') : R::load('checklistcategory', $post['checklistcategory_id']));
        $checklistcategory->category = $post['category'];

        if($post['checklistcategory_id']==0) {
            $checklistcategory->created = $now;
            $checklistcategory->created_by = $_SESSION['user_id'];
        } else {
            $checklistcategory->modified = $now;
            $checklistcategory->modified_by = $_SESSION['user_id'];
        }

        R::store($checklistcategory);
    }
    
    /**
     * Deletes a checklist category type object.
     * 
     * @param integer $checklistcategory_id
     */
    public function delete($checklistcategory_id = null) {
        if(!is_null($checklistcategory_id)) {
            $checklistcategory = R::load('checklistcategory', $checklistcategory_id);
            R::trash($checklistcategory);
        }
    }

}