<?php

/**
 * Handles SMR choice object interactions.
 */
class Smrchoice_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single SMR choice object.
     * 
     * @param type $smrchoice_id
     * @return type
     */
    public function findOne($smrchoice_id) {
        $smrchoice = R::findOne('smrchoice', ' id = :smrchoice_id ', [':smrchoice_id' => $smrchoice_id]);
        
        return $smrchoice;
    }
    
    /**
     * Finds all SMR choice objects.
     * 
     * @return type
     */
    public function findAll() {
        $smrchoice = R::findAll('smrchoice', ' ORDER BY smr_choice ASC');
        
        return $smrchoice;
    }
    
    /**
     * Creates or modifies an SMR choice object.
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $smrchoice = ($post['smrchoice_id']==0 ? R::dispense('smrchoice') : R::load('smrchoice', $post['smrchoice_id']));
        $smrchoice->smr_choice = $post['smr_choice'];
        
        if($post['smrchoice_id']==0) {
            $smrchoice->created = $now;
            $smrchoice->created_by = $_SESSION['user_id'];
        } else {
            $smrchoice->modified = $now;
            $smrchoice->modified_by = $_SESSION['user_id'];
        }
        
        R::store($smrchoice);
    }
    
    /**
     * Deletes an SMR choice object.
     * 
     * @param type $smrchoice_id
     */
    public function delete($smrchoice_id = null) {
        if(!is_null($smrchoice_id)) {
            $smrchoice = R::load('smrchoice', $smrchoice_id);
            R::trash($smrchoice);
        }
    }

}