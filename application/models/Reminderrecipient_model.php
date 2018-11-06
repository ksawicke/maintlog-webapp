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
        $reminderrecipient = R::findAll('reminderrecipient', ' ORDER BY user_id ASC');
        
        return $reminderrecipient;
    }
    
    /**
     * Creates or modifies a Reminder recipient object.
     */
    public function store($post) {
        $now = date('Y-m-d h:i:s');
        
        R::wipe('reminderrecipient');
        
        foreach($post['reminder_recipient'] as $ctr => $reminder_recipient_user_id) {
            $reminderrecipient = R::dispense('reminderrecipient');
            $reminderrecipient->user_id = $reminder_recipient_user_id;
            $reminderrecipient->created = $now;
            $reminderrecipient->created_by = $_SESSION['user_id'];

            R::store($reminderrecipient);
        }
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
