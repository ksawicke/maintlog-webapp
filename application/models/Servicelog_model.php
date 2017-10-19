<?php

/**
 * Handles equipment object interactions
 */
class Servicelog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Creates or modifies record
     */
    public function store($post) {        
        $now = date('Y-m-d h:i:s');
        
//        echo '<pre>';
//        var_dump($post);
        
        $servicelog = R::dispense('servicelog');
        $servicelog->date_entered = $post['date_entered'];
        $servicelog->entered_by = $post['entered_by'];
        $servicelog->serviced_by = $post['serviced_by'];
        $servicelog->equipment_id = $post['equipment_id'];
        $servicelog->created = $now;
        $servicelog_id = R::store($servicelog);
        
        switch($post['subflow']) {
            case 'sus':
                $smrupdate = R::dispense('smrupdate');
                $smrupdate->servicelog_id = $servicelog_id;
                $smrupdate->sus_fluid_type = $post['sus_fluid_type'];
                $smrupdate->sus_quantity = $post['sus_quantity'];
                $smrupdate->sus_units = $post['sus_units'];
                $smrupdate->sus_miles = $post['sus_miles'];
                R::store($smrupdate);
                break;
            
            case 'pss':
                $pmservice = R::dispense('pmservice');
                $pmservice->servicelog_id = $servicelog_id;
                $pmservice->reminder_pm_type = $post['pss_reminder_pm_type'];
                $pmservice->smr_due = $post['pss_smr_due'];
                $pmservice->notes = $post['pss_notes'];
                $pmservice->reminder_recipients = $post['pss_reminder_recipients'];
                $pmservice->reminder_quantity = $post['pss_reminder_quantity'];
                $pmservice->reminder_units = $post['pss_reminder_units'];
                R::store($pmservice);
                break;
            
            case 'ccs':
                $componentchange = R::dispense('componentchange');
                $componentchange->servicelog_id = $servicelog_id;
                $componentchange->component_type = $post['ccs_component_type'];
                $componentchange->component = $post['ccs_component'];
                $componentchange->component_data = $post['ccs_component_data'];
                $componentchange->notes = $post['ccs_notes'];
                R::store($componentchange);
                break;
        }
        
        
        
//        $equipment = ($post['equipment_id']==0 ? R::dispense('equipment') : R::load('equipment', $post['equipment_id']));
//        $equipment->unit_number = $post['unit_number'];
//        $equipment->manufacturer_id = $post['manufacturer_id'];
//        $equipment->model_number = $post['model_number'];
//        $equipment->equipmenttype_id = $post['equipmenttype_id'];
//        
//        if($post['equipment_id']==0) {
//            $equipment->created = $now;
//            $equipment->created_by = $_SESSION['user_id'];
//        } else {
//            $equipment->modified = $now;
//            $equipment->modified_by = $_SESSION['user_id'];
//        }
//        
////        echo '<pre>';
////        var_dump($equipment);
////        exit();
//        
//        R::store($equipment);
    }

}