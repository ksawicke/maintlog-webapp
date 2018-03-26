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
     * Finds a single user object.
     * 
     * @param type $user_id
     * @return type
     */
    public function findOne($user_id) {
        $user = R::findOne('user', ' id = :user_id ', [':user_id' => $user_id]);
        
        return $user;
    }
    
    /**
     * Finds all user objects.
     * 
     * @return type
     */
    public function findAll() {
        $user = R::getAll('SELECT user.id, first_name, last_name, email_address, role, active, IF(reminderrecipient.user_id IS NULL, 0, 1) AS logentry_reminderrecipient
                           FROM user
                           LEFT JOIN reminderrecipient ON reminderrecipient.user_id = user.id
                           ORDER BY last_name ASC, first_name ASC');
        
        return $user;
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
    /*public function create() {
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
    }*/
    
    /**
     * Creates or modifies record
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $user = ($post['user_id']==0 ? R::dispense('user') : R::load('user', $post['user_id']));
        $user->first_name = $post['first_name'];
        $user->last_name = $post['last_name'];
        $user->email_address = $post['email_address'];
        $user->role = $post['role'];
        $user->active = $post['active'];
        if(!empty($post['pin'])) {
            $user->pin = password_hash($post['pin'], PASSWORD_DEFAULT);
        }
        
        if($post['user_id']==0) {
            $user->created = $now;
            $user->created_by = $_SESSION['user_id'];
        } else {
            $user->modified = $now;
            $user->modified_by = $_SESSION['user_id'];
        }
        
        R::store($user);
    }
    
    /**
     * Toogles activation of a user record
     * 
     * @param type $user_id
     */
    public function toggle_activation($user_id = null) {
        $user = R::load('user', $user_id);
        $user->active = ($user->active==1 ? 0 : 1);
        R::store($user);
    }
    
    /**
     * Wipes out all user records
     */
    /*public function wipe() {
        R::wipe('user');
    }*/

}
