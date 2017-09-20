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
     * Finds a count of user by username
     * 
     * @param type $username
     * @return object
     */
    public function findCountByUsername($username) {
        $count = R::count('user', ' username = :username AND active = 1 ', [':username' => $username]);
        
        return $count;
    }
    
    /**
     * Finds a user by username
     * 
     * @param type $username
     * @return object
     */
    public function findByUsername($username) {
        $user = R::findOne('user', ' username = :username AND active = 1 ', [':username' => $username]);
        
        return $user;
    }
    
    /**
     * Finds a user by PIN
     * 
     * @param type $pin
     * @return object
     */
    public function findByPin($pin) {
        $users = R::findAll('user', ' active = 1 ');
        
        foreach($users as $user) {
            if(password_verify($pin, $user->pin)) {
                return $user;
            }
        }
        
        return null;
    }
    
    /**
     * Returns an object to validate user authentication
     * 
     * $param type $username
     * @param type $pin
     * @return boolean
     */
    public function getAuthObject($pin) {
        $authObject = new stdClass();
        $authObject->authenticated = false;
        
        $user = $this->findByPin($pin);
        
        if(!is_null($user)) {
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
        $user->username = 'ksawic';
        $user->first_name = 'Kevin';
        $user->last_name = 'Sawicke';
        $user->email_address = 'kevin@rinconmountaintech.com';
        $user->pin = password_hash('999999', PASSWORD_DEFAULT);
        $user->active = 1;
        $user->role = 'admin';
        $user->created = $now;
        $user->modified = $now;
        $user_id = R::store($user);
        
        $now = date('Y-m-d h:i:s');
        $user = R::dispense('user');
        $user->username = 'npjohnson';
        $user->first_name = 'Neil';
        $user->last_name = 'Johnson';
        $user->email_address = 'npjohnson@komatsuna.com';
        $user->pin = password_hash('987654', PASSWORD_DEFAULT);
        $user->active = 1;
        $user->role = 'admin';
        $user->created = $now;
        $user->modified = $now;
        $user_id = R::store($user);
        
        $now = date('Y-m-d h:i:s');
        $user = R::dispense('user');
        $user->username = 'jleonetti';
        $user->first_name = 'John';
        $user->last_name = 'Leonetti';
        $user->email_address = 'jleonetti@komatsuna.com';
        $user->pin = password_hash('876543', PASSWORD_DEFAULT);
        $user->active = 1;
        $user->role = 'admin';
        $user->created = $now;
        $user->modified = $now;
        $user_id = R::store($user);
        
        $now = date('Y-m-d h:i:s');
        $user = R::dispense('user');
        $user->username = 'bwjohnson';
        $user->first_name = 'Bret';
        $user->last_name = 'Johnson';
        $user->email_address = 'bwjohnson@komatsuna.com';
        $user->pin = password_hash('765432', PASSWORD_DEFAULT);
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