<?php

/**
 * Handles app setting object interactions.
 */
class Appsetting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single app setting object.
     * 
     * @param type $equipmenttype_id
     * @return type
     */
    public function findOne($appsetting_id) {
        $appsetting = R::findOne('appsetting', ' id = :appsetting_id ', [':appsetting_id' => $appsetting_id]);
        
        return $appsetting;
    }
    
    /**
     * Finds all app setting objects.
     * 
     * @return type
     */
    public function findAll() {
        $appsetting = R::findAll('appsetting', ' ');
        
        return $appsetting;
    }
    
    /**
     * Creates or modifies an app setting object.
     */
    public function store($post) {
        $appsetting = R::load('appsetting', 15000);
        $appsetting->smr_based_choices = $post['smr_based_choices'];
        $appsetting->mileage_based_choices = $post['mileage_based_choices'];
        $appsetting->time_based_choices = $post['time_based_choices'];
        
        R::store($appsetting);
    }

}