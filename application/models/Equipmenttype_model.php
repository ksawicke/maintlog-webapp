<?php

/**
 * Handles equipment type object interactions.
 */
class Equipmenttype_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single equipment type object.
     * 
     * @param integer $equipmenttype_id
     * @return object
     */
    public function findOne($equipmenttype_id) {
        $equipmenttype = R::findOne('equipmenttype', ' id = :equipmenttype_id ', [':equipmenttype_id' => $equipmenttype_id]);
        
        return $equipmenttype;
    }
    
    /**
     * Finds all equipment type objects.
     * 
     * @return object
     */
    public function findAll() {
        $equipmenttype = R::findAll('equipmenttype', ' ORDER BY equipment_type ASC');
        
        return $equipmenttype;
    }

	/**
	 * Returns Checklists not defined, unless we pass in a checklist_equipmenttype_id.
	 * So when we're editing a checklist, we return all checklists, otherwise, those
	 * that are undefined.
	 *
	 * @param string $checklist_equipmenttype_id
	 * @return array
	 */
    public function findAllWithoutChecklistDefined($checklist_equipmenttype_id = '') {
		$equipmenttype = R::getAll("SELECT et.id, et.equipment_type, c.equipmenttype_id FROM equipmenttype et LEFT JOIN checklist c ON c.equipmenttype_id = et.id" . (empty($checklist_equipmenttype_id) ? " WHERE c.equipmenttype_id IS NULL" : ""));

		return $equipmenttype;
	}
    
    /**
     * Creates or modifies an equipment type object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $equipmenttype = ($post['equipmenttype_id']==0 ? R::dispense('equipmenttype') : R::load('equipmenttype', $post['equipmenttype_id']));
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
