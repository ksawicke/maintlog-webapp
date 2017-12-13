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
        $servicelog->date_entered = $post['date_entered'];
        $servicelog->entered_by = $post['entered_by'];
//        $servicelog->serviced_by = $post['serviced_by']; // TODO: Will be 6|4|2...need to explode on |
        $servicelog->unit_number = $post['unit_number'];
        $servicelog->created = $now;
        $servicelog_id = R::store($servicelog);
        
        $servicedBys = explode("|", $post['serviced_by']);
        foreach($servicedBy as $ctr => $serviceByUserId) {
            $servicelog_servicedby = R::dispense('servicelog_servicedby');
            $servicelog_servicedby->servicelog_id = $servicelog_id;
            $servicelog_servicedby->user_id = $serviceByUserId;
            $servicelog_servicedby_id = R::store($servicelog_servicedby);
        }
        
        switch($post['subflow']) {
            case 'sus':
                $smrupdate = R::dispense('smrupdate');
                $smrupdate->servicelog_id = $servicelog_id;
                $smrupdate->smr = 'current_smr';
                R::store($smrupdate);
                break;
            
            case 'flu':
                foreach($post['fluid_added'] as $ctr => $fluid_added) {
                    if(!empty($fluid_added['type'])) {
                        $fluidentry = R::dispense('fluidentry');
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
                
                foreach($post['pss_smr_based_notes'] as $note) {
                    $pmservicenote = R::dispense('pmservicenote');
                    $pmservicenote->pmservice_id = $pmservice_id;
                    $pmservicenote->note = $note;
                    R::store($pmservicenote);
                }
                
                $pmservice->reminder_pm_type = $post['pss_reminder_pm_type'];
                $pmservice->reminder_pm_level = $post['pss_reminder_pm_level'];
                $pmservice->due_units = $post['pss_due_units'];
                $pmservice->notes = $post['pss_notes'];
                
                foreach($post['pss_reminder_recipients'] as $recipient) {
                    $emails = explode(",", $recipient['email_addresses']);
                    foreach($emails as $id => $email) {
                        $pmservicereminder = R::dispense('pmservicereminder');
                        $pmservicereminder->pmservice_id = $pmservice_id;
                        $pmservicereminder->email = $email;
                        $pmservicereminder->quantity = $post['pss_reminder_quantity'];
                        $pmservicereminder->units = $post['pss_reminder_units'];
                        $pmservicereminder->date = date("Y-m-d");
                        $pmservicereminder->sent = 0;
                        R::store($pmservicereminder);
                    }
                }
                
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