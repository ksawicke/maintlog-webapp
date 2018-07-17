<?php

/**
 * Handles component object interactions.
 */
class Component_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single component object.
     * 
     * @param type $component_id
     * @return type
     */
    public function findOne($component_id) {
        $component = R::findOne('component', ' id = :component_id ', [':component_id' => $component_id]);
        
        return $component;
    }

	/**
	 * Finds component object(s) via API.
	 *
	 * @param int $id
	 * @return array
	 */
	public function findAllApi($id = 0) {
		$components = R::getAll('SELECT id, component
		FROM component ' . ($id > 0 ? ' WHERE id = ' . $id : '') . ' ORDER BY component ASC');

		return $components;
	}
    
    /**
     * Finds all component objects.
     * 
     * @return type
     */
    public function findAll() {
        $component = R::findAll('component', ' ORDER BY component ASC');
        
        return $component;
    }
    
    /**
     * Creates or modifies an component object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $component = ($post['component_id']==0 ? R::dispense('component') : R::load('component', $post['component_id']));
        $component->component = $post['component'];
        
        if($post['component_id']==0) {
            $component->created = $now;
            $component->created_by = $_SESSION['user_id'];
        } else {
            $component->modified = $now;
            $component->modified_by = $_SESSION['user_id'];
        }
        
        R::store($component);
    }
    
    /**
     * Deletes an component object.
     * 
     * @param type $component_id
     */
    public function delete($component_id = null) {
        if(!is_null($component_id)) {
            $component = R::load('component', $component_id);
            R::trash($component);
        }
    }

}
