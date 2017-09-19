<?php

/**
 * Handles user object interactions
 */
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Returns an object to validate user authentication
     * 
     * @param type $pin
     * @return boolean
     */
    public function getAuthObject($pin) {
        $authObject = new stdClass();
        $authObject->authenticated = false;
        
        if(password_verify($password, $user->pin)) {
            $authObject->authenticated = true;
            $authObject->user = $user;
        }
        
        return $authObject;
    }
    
    /**
     * Creates record(s) for testing
     */
    public function create() {
        $now = date('Y-m-d h:i:s');
        $user = R::dispense('user');
        $user->first_name = 'Kevin';
        $user->last_name = 'Sawicke';
        $user->email_address = 'kevin@rinconmountaintech.com';
        $user->pin = password_hash('987654', PASSWORD_DEFAULT);
        $user->active = 1;
        $user->role = 'admin';
        $user->created = $now;
        $user->modified = $now;
        $user_id = R::store($user);
    }
    
    /**
     * Deletes a user record
     * 
     * @param type $user_id
     */
    public function delete($user_id = null) {
        if(!is_null($user_id)) {
            $user = R::load('user', $user_id);
            R::trash($user);
        }
    }
    
    /**
     * Wipes out all user records
     */
    public function wipe() {
        R::wipe('user');
    }

}