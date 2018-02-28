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
    public function findOne($checklistitem_id) {
        $checklistitem = R::findOne('checklistitem', ' id = :checklistitem_id ', [':checklistitem_id' => $checklistitem_id]);
        
        return $checklistitem;
    }
    
    /**
     * Finds all checklist item objects.
     * 
     * @return array
     */
    public function findAll() {
        $checklistitems = R::findAll('checklistitem', ' ORDER BY item ASC');
        
        return $checklistitems;
    }
    
    /**
     * Creates or modifies a checklist item object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');

        $checklistitem = ($post['checklistitem_id']==0 ? R::dispense('checklistitem') : R::load('checklistitem', $post['checklistitem_id']));
        $checklistitem->item = $post['item'];

        if($post['checklistitem_id']==0) {
            $checklistitem->created = $now;
            $checklistitem->created_by = $_SESSION['user_id'];
        } else {
            $checklistitem->modified = $now;
            $checklistitem->modified_by = $_SESSION['user_id'];
        }

        R::store($checklistitem);
    }
    
    /**
     * Deletes a checklist item type object.
     * 
     * @param integer $checklistitem_id
     */
    public function delete($checklistitem_id = null) {
        if(!is_null($checklistitem_id)) {
            $checklistitem = R::load('checklistitem', $checklistitem_id);
            R::trash($checklistitem);
        }
    }

}
