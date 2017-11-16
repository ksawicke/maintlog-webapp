<?php

/**
 * Handles Time choice object interactions.
 */
class Timechoice_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single Time choice object.
     * 
     * @param type $timechoice_id
     * @return type
     */
    public function findOne($timechoice_id) {
        $timechoice = R::findOne('timechoice', ' id = :timechoice_id ', [':timechoice_id' => $timechoice_id]);
        
        return $timechoice;
    }
    
    /**
     * Finds all Time choice objects.
     * 
     * @return type
     */
    public function findAll() {
        $timechoice = R::findAll('timechoice', ' ORDER BY time_choice ASC');
        
        return $timechoice;
    }
    
    /**
     * Creates or modifies an SMR choice object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $timechoice = ($post['timechoice_id']==0 ? R::dispense('timechoice') : R::load('timechoice', $post['timechoice_id']));
        $timechoice->time_choice = $post['time_choice'];
        
        if($post['timechoice_id']==0) {
            $timechoice->created = $now;
            $timechoice->created_by = $_SESSION['user_id'];
        } else {
            $timechoice->modified = $now;
            $timechoice->modified_by = $_SESSION['user_id'];
        }
        
        R::store($timechoice);
    }
    
    /**
     * Deletes an Time choice object.
     * 
     * @param type $timechoice_id
     */
    public function delete($timechoice_id = null) {
        if(!is_null($timechoice_id)) {
            $timechoice = R::load('timechoice', $timechoice_id);
            R::trash($timechoice);
        }
    }

}