<?php

/**
 * Handles Mileage choice object interactions.
 */
class Mileagechoice_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single Mileage choice object.
     * 
     * @param type $mileagechoice_id
     * @return type
     */
    public function findOne($mileagechoice_id) {
        $mileagechoice = R::findOne('mileagechoice', ' id = :mileagechoice_id ', [':mileagechoice_id' => $mileagechoice_id]);
        
        return $mileagechoice;
    }
    
    /**
     * Finds all Mileage choice objects.
     * 
     * @return type
     */
    public function findAll() {
        $mileagechoice = R::findAll('mileagechoice', ' ORDER BY mileage_choice ASC');
        
        return $mileagechoice;
    }
    
    /**
     * Creates or modifies an Mileage choice object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $mileagechoice = ($post['mileagechoice_id']==0 ? R::dispense('mileagechoice') : R::load('mileagechoice', $post['mileagechoice_id']));
        $mileagechoice->mileage_choice = $post['mileage_choice'];
        
        if($post['mileagechoice_id']==0) {
            $mileagechoice->created = $now;
            $mileagechoice->created_by = $_SESSION['user_id'];
        } else {
            $mileagechoice->modified = $now;
            $mileagechoice->modified_by = $_SESSION['user_id'];
        }
        
        R::store($mileagechoice);
    }
    
    /**
     * Deletes an Mileage choice object.
     * 
     * @param type $mileagechoice_id
     */
    public function delete($mileagechoice_id = null) {
        if(!is_null($mileagechoice_id)) {
            $mileagechoice = R::load('mileagechoice', $mileagechoice_id);
            R::trash($mileagechoice);
        }
    }

}