<?php

/**
 * Handles fluid type object interactions.
 */
class Fluidtype_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single fluid type object.
     * 
     * @param type $fluidtype_id
     * @return type
     */
    public function findOne($fluidtype_id) {
        $fluidtype = R::findOne('fluidtype', ' id = :fluidtype_id ', [':fluidtype_id' => $fluidtype_id]);
        
        return $fluidtype;
    }

	public function findAllApi($id = 0) {
		$fluidtypes = R::getAll('SELECT id, TRIM(fluid_type) fluid_type
		FROM fluidtype' . ($id > 0 ? ' WHERE id = ' . $id : '') . ' ORDER BY fluid_type ASC');

		return $fluidtypes;
	}
    
    /**
     * Finds all fluid type objects.
     * 
     * @return type
     */
    public function findAll() {
        $fluidtype = R::findAll('fluidtype', ' ORDER BY fluid_type ASC');
        
        return $fluidtype;
    }
    
    /**
     * Finds a list of filtered fluid types
     * 
     * @param type $post
     * @return type
     */
    public function findFiltered($post) {
        $filteredFluids = [];
        
        if(!empty($post['fluidsTrackedForSelectedUnit'])) {
            $filter = implode("|", $post);
            $newFilter1 = explode("|", $filter);
            $newFilter2 = implode(",", $newFilter1);        

            $filteredFluids = R::getAll('SELECT * FROM fluidtype WHERE id IN(' . $newFilter2 . ')');
        } else {
            $filteredFluids = R::getAll('SELECT * FROM fluidtype');
        }
        
        return $filteredFluids;
    }
    
    /**
     * Creates or modifies a fluid type object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $fluidtype = ($post['fluidtype_id']==0 ? R::dispense('fluidtype') : R::load('fluidtype', $post['fluidtype_id']));
        $fluidtype->fluid_type = $post['fluid_type'];
        
        if($post['fluidtype_id']==0) {
            $fluidtype->created = $now;
            $fluidtype->created_by = $_SESSION['user_id'];
        } else {
            $fluidtype->modified = $now;
            $fluidtype->modified_by = $_SESSION['user_id'];
        }
        
        R::store($fluidtype);
    }
    
    /**
     * Deletes an fluid type object.
     * 
     * @param type $fluidtype_id
     */
    public function delete($fluidtype_id = null) {
        if(!is_null($fluidtype_id)) {
            $fluidtype = R::load('fluidtype', $fluidtype_id);
            R::trash($fluidtype);
        }
    }

}
