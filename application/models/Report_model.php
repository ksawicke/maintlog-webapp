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
     * Finds Maintenance Log Reminder objects
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

    /**
     * Find service log objects
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function findServiceLogs($servicelog_id = 0) {
        $append_query = " WHERE su.servicelog_id <> 'UNKNOWN'
                          OR pm.servicelog_id <> 'UNKNOWN'
                          OR fe.servicelog_id <> 'UNKNOWN'
                          OR cc.servicelog_id <> 'UNKNOWN'
                          ORDER BY s.created DESC";

        if ($servicelog_id <> 0) {
            $append_query = " WHERE s.id = '" . $servicelog_id . "'";
        }

        $service_logs = $this->getAllServiceLogs($append_query);

        if ($servicelog_id <> 0) {
            $service_logs = $this->appendServiceLogChildren($servicelog_id, $service_logs);
        }

        return ($servicelog_id <> 0 ? $service_logs[0] : $service_logs);
    }
    
    private function getAllServiceLogs($append_query) {
        return R::getAll(
            "SELECT DISTINCT
                s.id, s.date_entered, u.first_name AS enteredby_first_name, u.last_name AS enteredby_last_name, man.manufacturer_name, em.model_number, eu.unit_number,
                CASE
                    WHEN su.servicelog_id IS NOT NULL THEN 'SMR Update'
                    WHEN pm.servicelog_id IS NOT NULL THEN 'PM Service'
                    WHEN fe.servicelog_id IS NOT NULL THEN 'Fluid Entry'
                    WHEN cc.servicelog_id IS NOT NULL THEN 'Component Change'
                    ELSE 'UNKNOWN'
                END AS entry_type
            FROM servicelog s
                LEFT JOIN equipmentunit eu ON eu.id = s.unit_number
		LEFT JOIN equipmentmodel em on em.id = eu.equipmentmodel_id
		LEFT JOIN manufacturer man on man.id = em.manufacturer_id
                LEFT JOIN user u on u.id = s.entered_by
                LEFT OUTER JOIN smrupdate su ON su.servicelog_id = s.id
                LEFT OUTER JOIN pmservice pm ON pm.servicelog_id = s.id
                LEFT OUTER JOIN fluidentry fe ON fe.servicelog_id = s.id
                LEFT OUTER JOIN componentchange cc ON cc.servicelog_id = s.id " . $append_query);
    }
    
    /**
     * Appends child objects to service logs
     * 
     * @param type $servicelog_id
     * @param type $service_logs
     * @return type
     */
    private function appendServiceLogChildren($servicelog_id, $service_logs) {
        $service_logs[0]['serviced_by'] = $this->getServicedBy($servicelog_id);
            
        switch($service_logs[0]) {
            case 'SMR Update':
                $service_logs[0]['update_detail'] = $this->getSMRUpdateDetail($servicelog_id);
                break;
            
            case 'PM Service':
                $service_logs[0]['update_detail'] = $this->getPMServiceDetail($servicelog_id);
                break;
            
            case 'Fluid Entry':
                $service_logs[0]['update_detail'] = $this->getFluidEntryDetail($servicelog_id);
                break;
            
            case 'Component Change':
                $service_logs[0]['update_detail'] = $this->getComponentChangeDetail($servicelog_id);
                break;
        }
        
        return $service_logs;
    }

    /**
     * Determines if a service log is an SMR Update
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function isSMRUpdate($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as smrupdates
            FROM smrupdate WHERE servicelog_id = '" . $servicelog_id . "'");

        return($counts[0]['smrupdates'] == 0 ? false : true);
    }

    /**
     * Determines if a service log is a Fluid Entry
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function isFluidEntry($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as fluid_entries
            FROM fluidentry WHERE servicelog_id = '" . $servicelog_id . "'");

        return($counts[0]['fluid_entries'] == 0 ? false : true);
    }

    public function isPMService($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as pmservices
            FROM pmservice WHERE servicelog_id = '" . $servicelog_id . "'");

        return($counts[0]['pmservices'] == 0 ? false : true);
    }

    /**
     * Determines if a service log is a Component Change
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function isComponentChange($servicelog_id = 0) {
        $counts = R::getAll(
            "SELECT count(*) as component_changes
            FROM componentchange WHERE servicelog_id = '" . $servicelog_id . "'");

        return ($counts[0]['component_changes'] == 0 ? false : true);
    }

    /**
     * Gets SMR Update object
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function getSMRUpdateDetail($servicelog_id = 0) {
        $detail = R::getAll(
            "SELECT
                smr.smr
            FROM smrupdate smr
            WHERE smr.servicelog_id = '" . $servicelog_id . "'");

        return $detail[0];
    }

    /**
     * Gets Fluid Entry object
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function getFluidEntryDetail($servicelog_id = 0) {
        $detail = R::getAll(
            "SELECT
                ft.fluid_type, fe.quantity, fe.units
            FROM fluidentry fe
            LEFT JOIN fluidtype ft ON ft.id = fe.type
            WHERE fe.servicelog_id = '" . $servicelog_id . "'");

        return $detail;
    }

    /**
     * Gets PM Service Detail
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function getPMServiceDetail($servicelog_id = 0) {
        $detail = R::getAll(
            "SELECT
                pm.id,
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
            WHERE pm.servicelog_id = '" . $servicelog_id . "'");

        $detail[0]['pmservicenotes'] = $this->getPMServiceNotes($detail[0]['id']);
        $detail[0]['pmservicereminder'] = $this->getPMServiceReminder($detail[0]['id']);

        return $detail[0];
    }

    /**
     * Gets PM Service Notes
     * 
     * @param type $pmservice_id
     * @return type
     */
    public function getPMServiceNotes($pmservice_id = 0) {
        $detail = R::getAll(
            "SELECT
               pn.note
            FROM pmservicenote pn
            WHERE pn.pmservice_id = '" . $pmservice_id . "'");

        return $detail;
    }

    /**
     * Gets PM Service Reminder
     * 
     * @param type $pmservice_id
     * @return type
     */
    public function getPMServiceReminder($pmservice_id = 0) {
        $detail = R::getAll(
            "SELECT
               pr.emails, pr.pm_type,
               CASE pr.pm_type
                    WHEN 'smr_based' THEN smr.smr_choice
                    WHEN 'mileage_based' THEN mileage.mileage_choice
                    WHEN 'time_based' THEN time.time_choice
                    ELSE -1
               END AS pm_level,
               pr.quantity, pr.units, pr.date, pr.sent
            FROM pmservicereminder pr
            LEFT OUTER JOIN smrchoice smr ON (smr.id = pr.pm_level AND pr.pm_type = 'smr_based')
            LEFT OUTER JOIN mileagechoice mileage ON (mileage.id = pr.pm_level AND pr.pm_type = 'mileage_based')
            LEFT OUTER JOIN timechoice time ON (time.id = pr.pm_level AND pr.pm_type = 'time_based')
            WHERE pr.pmservice_id ='" . $pmservice_id . "'");

        return $detail;
    }

    /**
     * Gets Component Change Detail
     * 
     * @param type $servicelog_id
     * @return type
     */
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
    
    /**
     * Gets Serviced By Detail
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function getServicedBy($servicelog_id = 0) {
        $detail = R::getAll(
            "SELECT
                u.first_name, u.last_name
            FROM servicelogservicedby sb
            LEFT JOIN user u ON u.id = sb.user_id
            WHERE sb.servicelog_id = '" . $servicelog_id . "'");

        return $detail;
    }
    
    public function findPMServiceReminders() {
        $pmservicereminders = R::getAll(
            "SELECT
                u.first_name AS enteredby_first_name, u.last_name AS enteredby_last_name,
                man.manufacturer_name, em.model_number, eu.unit_number,
                r.emails, 
                CASE r.pm_type
                    WHEN 'mileage_based' THEN 'Mileage based'
                    WHEN 'smr_based' THEN 'SMR based'
                    WHEN 'time_based' THEN 'Time based'
                    ELSE -1
                END AS reminder_pm_type,
                r.quantity AS warn_on_quantity,
                CASE r.units
                    WHEN 'days' THEN 'Days'
                    WHEN 'smr' THEN 'SMR'
                    WHEN 'miles' THEN 'Miles'
                    ELSE -1
                END AS warn_on_units,
                CASE ps.pm_type
                    WHEN 'mileage_based' THEN 'Mileage based'
                    WHEN 'smr_based' THEN 'SMR based'
                    WHEN 'time_based' THEN 'Time based'
                    ELSE -1
                END AS pmservice_pm_type,
                CASE ps.pm_type
                    WHEN 'smr_based' THEN smr.smr_choice
                    WHEN 'mileage_based' THEN mileage.mileage_choice
                    WHEN 'time_based' THEN time.time_choice
                    ELSE -1
                END AS pmservice_pm_level,
                ps.current_smr AS pmservice_current_smr,
                ps.due_units AS pmservice_due_quantity,
                ps.notes AS pmservice_notes,
                r.date AS reminder_date_created, r.sent AS reminder_date_sent
             FROM pmservicereminder r
             LEFT JOIN pmservice ps ON ps.id = r.pmservice_id
             LEFT JOIN servicelog s ON s.id = ps.servicelog_id
             LEFT JOIN equipmentunit eu ON eu.id = s.unit_number
	     LEFT JOIN equipmentmodel em on em.id = eu.equipmentmodel_id
	     LEFT JOIN manufacturer man on man.id = em.manufacturer_id
             LEFT JOIN user u on u.id = s.entered_by
             LEFT OUTER JOIN smrchoice smr ON (smr.id = ps.pm_level AND ps.pm_type = 'smr_based')
	     LEFT OUTER JOIN mileagechoice mileage ON (mileage.id = ps.pm_level AND ps.pm_type = 'mileage_based')
             LEFT OUTER JOIN timechoice time ON (time.id = ps.pm_level AND ps.pm_type = 'time_based')
             ORDER BY r.date DESC, r.id DESC");

        return $pmservicereminders;
    }

}
