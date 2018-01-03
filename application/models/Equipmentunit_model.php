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
        $equipmentunit = R::getAll('SELECT equipmentunit.id AS equipmentunit_id, equipmentunit.unit_number, equipmentunit.track_type, equipmentunit.person_responsible, equipmentunit.active, manufacturer.id as manufacturer_id, manufacturer.manufacturer_name, equipmentunit.equipmentmodel_id, equipmentmodel.model_number, equipmenttype.equipment_type, equipmenttype.id as equipment_type_id
FROM equipmentunit
  LEFT JOIN equipmentmodel ON equipmentunit.equipmentmodel_id = equipmentmodel.id
  LEFT JOIN manufacturer ON equipmentmodel.manufacturer_id = manufacturer.id
  LEFT JOIN equipmenttype ON equipmentmodel.equipmenttype_id = equipmenttype.id
  WHERE equipmentunit.id = ' . $equipmentunit_id);
        
        return (object) $equipmentunit[0];
    }
    
    /**
     * Finds all equipment unit objects.
     * 
     * @return type
     */
    public function findAll() {
        $equipmentunit = R::getAll('SELECT equipmentunit.id AS equipmentunit_id, equipmentunit.unit_number, equipmentunit.track_type, equipmentunit.person_responsible, equipmentunit.active, manufacturer.manufacturer_name, equipmentmodel.model_number, equipmenttype.equipment_type
FROM equipmentunit
  LEFT JOIN equipmentmodel ON equipmentunit.equipmentmodel_id = equipmentmodel.id
  LEFT JOIN manufacturer ON equipmentmodel.manufacturer_id = manufacturer.id
  LEFT JOIN equipmenttype ON equipmentmodel.equipmenttype_id = equipmenttype.id
  ORDER BY manufacturer_name ASC, model_number ASC, unit_number ASC');
        
        return $equipmentunit;
    }
    
    public function findAllByModelId($equipmentmodel_id) {
        $dbQuery = 'SELECT equipmentunit.id, equipmentunit.unit_number, equipmentunit.track_type, equipmentunit.person_responsible, equipmentunit.active FROM equipmentunit WHERE equipmentunit.equipmentmodel_id = ' . $equipmentmodel_id . ' ORDER BY equipmentunit.unit_number ASC';

        $equipmentunit = R::getAll($dbQuery);
        
        return $equipmentunit;
    }
    
    /**
     * Creates or modifies an equipment unit object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $equipmentunit = ($post['equipmentunit_id']==0 ? R::dispense('equipmentunit') : R::load('equipmentunit', $post['equipmentunit_id']));
        $equipmentunit->equipmentmodel_id = $post['equipmentmodel_id'];
        $equipmentunit->unit_number = $post['unit_number'];
        $equipmentunit->track_type = $post['track_type'];
        $equipmentunit->person_responsible = implode("|", $post['person_responsible']);
        $equipmentunit->active = $post['active'];
        
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