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

        $servicelog = R::dispense('servicelog');
        $servicelog->date_entered = date('Y-m-d', strtotime($post['date_entered']));
        $servicelog->entered_by = $post['entered_by'];
        $servicelog->unit_number = $post['unit_number'];
        $servicelog->created = $now;
        $servicelog_id = R::store($servicelog);
        
        $servicedBys = explode("|", $post['serviced_by']);
        foreach($servicedBys as $ctr => $serviceByUserId) {
            $servicelog_servicedby = R::dispense('servicelogservicedby');
            $servicelog_servicedby->servicelog_id = $servicelog_id;
            $servicelog_servicedby->user_id = $serviceByUserId;
            $servicelog_servicedby_id = R::store($servicelog_servicedby);
        }
        
        switch($post['subflow']) {
            case 'sus':
                $smrupdate = R::dispense('smrupdate');
                $smrupdate->servicelog_id = $servicelog_id;
                $smrupdate->smr = $post['sus_current_smr'];
                R::store($smrupdate);
                break;
            
            case 'flu':
                foreach($post['fluid_added'] as $ctr => $fluid_added) {
                    if(!empty($fluid_added['type'])) {
                        $fluidentry = R::dispense('fluidentry');
                        $fluidentry->servicelog_id = $servicelog_id;
                        $fluidentry->type = $fluid_added['type'];
                        $fluidentry->quantity = $fluid_added['quantity'];
                        $fluidentry->units = $fluid_added['units'];
                        R::store($fluidentry);
                    }
                }
                break;
            
            case 'pss':
                $pmservice = R::dispense('pmservice');
                $pmservice->servicelog_id = $servicelog_id;
                $pmservice->pm_type = $post['pss_pm_type'];
                $pmservice->pm_level = $post['pss_smr_based_pm_level'];
                $pmservice->current_smr = $post['pss_smr_based_current_smr'];
                $pmservice->due_units = $post['pss_due_units'];
                $pmservice->notes = $post['pss_notes'];
                $pmservice_id = R::store($pmservice);
                
                foreach($post['pss_smr_based_notes'] as $id => $note) {
                    if(!empty($note['note'])) {
                        $pmservicenote = R::dispense('pmservicenote');
                        $pmservicenote->pmservice_id = $pmservice_id;
                        $pmservicenote->note = $note['note'];
                        R::store($pmservicenote);
                    }
                }
                
                $emailsCaptured = [];
                foreach($post['pss_reminder_recipients'] as $id => $recipient) {
                    if(!empty($recipient['email_addresses'])) {
                        if(!in_array($recipient['email_addresses'][0], $emailsCaptured)) {
                            $emailsCaptured[] = $recipient['email_addresses'][0];
                        }
                    }
                }
                
                foreach($emailsCaptured as $id => $email_address) {
                    $pmservicereminder = R::dispense('pmservicereminder');
                    $pmservicereminder->pmservice_id = $pmservice_id;
                    $pmservicereminder->emails = $email_address;
                    $pmservicereminder->pm_type = $post['pss_reminder_pm_type'];
                    $pmservicereminder->pm_level = $post['pss_reminder_pm_level'];
                    $pmservicereminder->quantity = $post['pss_reminder_quantity'];
                    $pmservicereminder->units = $post['pss_reminder_units'];
                    $pmservicereminder->date = date("Y-m-d");
                    $pmservicereminder->sent = 0;
                    R::store($pmservicereminder);
                }
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
    
    public function deleteServiceLogAndChildren($servicelogid) {
        try {
            $servicelog = R::load('servicelog', $servicelogid);
            R::trash($servicelog);
        } catch (Exception $ex) {
            return ['success' => false, 'message' => $ex->getMessage()];
        }
        
        return ['success' => true, 'message' => 'Deleted records successfully.'];
    }

}