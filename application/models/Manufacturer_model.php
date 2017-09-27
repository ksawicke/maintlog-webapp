<?php

/**
 * Handles manufacturer object interactions
 */
class Manufacturer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds a single manufacturer object.
     * 
     * @param type $manufacturer_id
     * @return type
     */
    public function findOne($manufacturer_id) {
        $manufacturer = R::findOne('manufacturer', ' id = :manufacturer_id ', [':manufacturer_id' => $manufacturer_id]);
        
        return $manufacturer;
    }
    
    /**
     * Finds all manufacturer objects.
     * 
     * @return type
     */
    public function findAll() {
        $manufacturers = R::findAll('manufacturer', ' ORDER BY manufacturer_name ASC');
        
        return $manufacturers;
    }
    
    /**
     * Creates or modifies record
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
        $manufacturer = ($post['manufacturer_id']==0 ? R::dispense('manufacturer') : R::load('manufacturer', $post['manufacturer_id']));
        $manufacturer->manufacturer_name = $post['manufacturer_name'];
        
        if($post['manufacturer_id']==0) {
            $manufacturer->created = $now;
            $manufacturer->created_by = $_SESSION['user_id'];
        } else {
            $manufacturer->modified = $now;
            $manufacturer->modified_by = $_SESSION['user_id'];
        }
        
//        echo '<pre>';
//        var_dump($manufacturer);
//        exit();
        
        R::store($manufacturer);
    }
    
    public function delete($manufacturer_id = null) {
        if(!is_null($manufacturer_id)) {
            $manufacturer = R::load('manufacturer', $manufacturer_id);
            R::trash($manufacturer);
        }
    }

}