<?php

/**
 * Handles Report object interactions.
 */
class Report_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Finds Maintenance Log Reminder objects.
     * 
     * @param type $smrchoice_id
     * @return type
     */
    public function findMaintenanceLogReminders() {
        $reminders = R::getAll(
            "SELECT
                s.date_entered, pm.current_smr, man.manufacturer_name, em.model_number, eu.unit_number, pm.pm_type,  pm.due_units, pm.notes,
                CASE pm.pm_type
                    WHEN 'smr_based' THEN smr.smr_choice
                    WHEN 'mileage_based' THEN mileage.mileage_choice
                    WHEN 'time_based' THEN time.time_choice
                    ELSE -1
                END AS pm_level
            FROM pmservice pm
		LEFT JOIN servicelog s on s.id = pm.servicelog_id
		LEFT JOIN equipmentunit eu ON eu.id = s.unit_number
		LEFT JOIN equipmentmodel em on em.id = eu.equipmentmodel_id
		LEFT JOIN manufacturer man on man.id = em.manufacturer_id
		LEFT OUTER JOIN smrchoice smr ON (smr.id = pm.pm_level AND pm.pm_type = 'smr_based')
		LEFT OUTER JOIN mileagechoice mileage ON (mileage.id = pm.pm_level AND pm.pm_type = 'mileage_based')
                LEFT OUTER JOIN timechoice time ON (time.id = pm.pm_level AND pm.pm_type = 'time_based')");
        
        return $reminders;
    }
    
    public function findServiceLogs($servicelog_id = 0) {
        $append_query = "ORDER BY s.created DESC";
        
        if($servicelog_id<>0) {
            $append_query = " WHERE s.id = '" . $servicelog_id . "'";
        }
        
        $service_logs = R::getAll(
            "SELECT
                s.id, s.date_entered, u.first_name, u.last_name, man.manufacturer_name, em.model_number, eu.unit_number
            FROM servicelog s
                LEFT JOIN equipmentunit eu ON eu.id = s.unit_number
		LEFT JOIN equipmentmodel em on em.id = eu.equipmentmodel_id
		LEFT JOIN manufacturer man on man.id = em.manufacturer_id
                LEFT JOIN user u on u.id = s.entered_by " . $append_query);
        
        if($servicelog_id<>0) {
            $service_logs[0]['update_type'] = '';
            
            if($this->isSMRUpdate($servicelog_id)) {
                $service_logs[0]['update_type'] = 'smr_update';
                $service_logs[0]['update_detail'] = $this->getSMRUpdateDetail($servicelog_id);
            }
            
            if($this->isFluidEntry($servicelog_id)) {
                $service_logs[0]['update_type'] = 'fluid';
                $service_logs[0]['update_detail'] = $this->getFluidEntryDetail($servicelog_id);
            }
            
            if($this->isPMService($servicelog_id)) {
                $service_logs[0]['update_type'] = 'pmservice';
                $service_logs[0]['update_detail'] = $this->getPMServiceDetail($servicelog_id);
            }
            
            if($this->isComponentChange($servicelog_id)) {
                $service_logs[0]['update_type'] = 'componentchange';
                $service_logs[0]['update_detail'] = $this->getComponentChangeDetail($servicelog_id);
            }
        }
        
        return ($servicelog_id <> 0 ? $service_logs[0] : $service_logs);
    }
    
    public function isSMRUpdate($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as smrupdates
            FROM smrupdate WHERE servicelog_id = '" . $servicelog_id . "'");
        
        return($counts[0]['smrupdates']==0 ? false : true);
    }
    
    public function isFluidEntry($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as fluid_entries
            FROM fluidentry WHERE servicelog_id = '" . $servicelog_id . "'");
        
        return($counts[0]['fluid_entries']==0 ? false : true);
    }
    
    public function isPMService($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as pmservices
            FROM pmservice WHERE servicelog_id = '" . $servicelog_id . "'");
        
        return($counts[0]['pmservices']==0 ? false : true);
    }
    
    public function isComponentChange($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as component_changes
             FROM componentchange WHERE servicelog_id = '" . $servicelog_id . "'");
        
        return ($counts[0]['component_changes']==0 ? false : true);
    }
    
    public function getSMRUpdateDetail($servicelog_id = 0) {
        return [];
    }
    
    public function getFluidEntryDetail($servicelog_id = 0) {
        return [];
    }
    
    public function getPMServiceDetail($servicelog_id = 0) {
        $detail = R::getAll(
            "SELECT
                pm.pm_type,
                CASE pm.pm_type
                        WHEN 'smr_based' THEN smr.smr_choice
                        WHEN 'mileage_based' THEN mileage.mileage_choice
                        WHEN 'time_based' THEN time.time_choice
                        ELSE -1
                END AS pm_level,
                pm.current_smr, pm.due_units, pm.notes
            FROM pmservice pm
            LEFT OUTER JOIN smrchoice smr ON (smr.id = pm.pm_level AND pm.pm_type = 'smr_based')
            LEFT OUTER JOIN mileagechoice mileage ON (mileage.id = pm.pm_level AND pm.pm_type = 'mileage_based')
            LEFT OUTER JOIN timechoice time ON (time.id = pm.pm_level AND pm.pm_type = 'time_based')
            WHERE servicelog_id = '" . $servicelog_id . "'");
        
        return $detail[0];
    }
    
    public function getComponentChangeDetail($servicelog_id = 0) {
        $detail = R::getAll(
            "SELECT
                cc.component_data, c.component, ct.component_type, cc.notes
            FROM componentchange cc
            LEFT JOIN componenttype ct ON ct.id = cc.component_type
            LEFT JOIN component c ON c.id = cc.component
            WHERE cc.servicelog_id = '" . $servicelog_id . "'");
        
        return $detail[0];
    }
}