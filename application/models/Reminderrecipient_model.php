<?php

/**
 * Handles Reminder recipient object interactions.
 */
class Reminderrecipient_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single Reminder recipient object.
     * 
     * @param type $reminderrecipient_id
     * @return type
     */
    public function findOne($reminderrecipient_id) {
        $reminderrecipient = R::findOne('reminderrecipient', ' id = :reminderrecipient_id ', [':reminderrecipient_id' => $reminderrecipient_id]);
        
        return $reminderrecipient;
    }
    
    /**
     * Finds all Reminder recipient objects.
     * 
     * @return type
     */
    public function findAll() {
        $reminderrecipient = R::findAll('reminderrecipient', ' ORDER BY reminder_recipient ASC');
        
        return $reminderrecipient;
    }
    
    /**
     * Creates or modifies a Reminder recipient object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $reminderrecipient = ($post['reminderrecipient_id']==0 ? R::dispense('reminderrecipient') : R::load('reminderrecipient', $post['reminderrecipient_id']));
        $reminderrecipient->reminder_recipient = $post['reminder_recipient'];
        
        if($post['reminderrecipient_id']==0) {
            $reminderrecipient->created = $now;
            $reminderrecipient->created_by = $_SESSION['user_id'];
        } else {
            $reminderrecipient->modified = $now;
            $reminderrecipient->modified_by = $_SESSION['user_id'];
        }
        
        R::store($reminderrecipient);
    }
    
    /**
     * Deletes a Reminder recipient object.
     * 
     * @param type $reminderrecipient_id
     */
    public function delete($reminderrecipient_id = null) {
        if(!is_null($reminderrecipient_id)) {
            $reminderrecipient = R::load('reminderrecipient', $reminderrecipient_id);
            R::trash($reminderrecipient);
        }
    }

}