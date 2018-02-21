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
    public function findMaintenanceLogReminders($params = []) {
        $customSearch = '';
        
        if(!empty($params) && array_key_exists('data', $params)) {
            $customSearch .= (!empty($params['data']['date_entered']) ? " AND s.date_entered = '" . date_create_from_format('Y-m-d', $params['data']['date_entered']) . "'" : "");
            $customSearch .= (!empty($params['data']['current_smr']) ? " AND pm.current_smr = '" . $params['data']['current_smr'] . "'" : "");
            $customSearch .= (!empty($params['data']['manufacturer_name']) ? " AND man.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
            $customSearch .= (!empty($params['data']['model_number']) ? " AND em.model_number = '" . $params['data']['model_number'] . "'" : "");
            $customSearch .= (!empty($params['data']['unit_number']) ? " AND eu.unit_number = '" . $params['data']['unit_number'] . "'" : "");
            $customSearch .= (!empty($params['data']['notes']) ? " AND pm.notes = '" . $params['data']['notes'] . "'" : "");
            $customSearch .= (!empty($params['data']['due_units']) ? " AND pm.due_units = '" . $params['data']['due_units'] . "'" : "");
        }
        
        $customSql = "SELECT
                s.date_entered, pm.current_smr, man.manufacturer_name, em.model_number, eu.unit_number, pm.pm_type, pm.due_units, pm.notes,
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
                LEFT OUTER JOIN timechoice time ON (time.id = pm.pm_level AND pm.pm_type = 'time_based')
            WHERE s.new_id = 0" . $customSearch;
        
        $reminders = R::getAll($customSql);

        return $reminders;
    }

    /**
     * Find service log objects
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function findServiceLogs($servicelog_id = 0, $params = []) {
        $customSearch = '';
        $fluidType = '';
        
        if(!empty($params) && array_key_exists('data', $params)) {
//            echo '<pre>';
//            var_dump($params);
//            exit();
            $customSearch .= (!empty($params['data']['date_entered']) ? " AND s.date_entered = '" . date_create_from_format('Y-m-d', $params['data']['date_entered']) . "'" : "");
            $customSearch .= (!empty($params['data']['entered_by']) ? " AND CONCAT(u.first_name, ' ', u.last_name) = '" . $params['data']['entered_by'] . "'" : "");
            $customSearch .= (!empty($params['data']['manufacturer_name']) ? " AND man.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
            $customSearch .= (!empty($params['data']['model_number']) ? " AND em.model_number = '" . $params['data']['model_number'] . "'" : "");
            $customSearch .= (!empty($params['data']['unit_number']) ? " AND eu.unit_number = '" . $params['data']['unit_number'] . "'" : "");
            // ENTRY TYPE
            
            if(!empty($params['data']['entry_type'])) {
                switch($params['data']['entry_type']) {
                    case 'Fluid Entry':
                        $customSearch .= " AND fe.servicelog_id IS NOT NULL AND su.smr IS NULL";
                        $fluidType = $params['data']['fluid_type'];
                        break;
                    
                    case 'Component Change':
                        $customSearch .= " AND cc.servicelog_id IS NOT NULL";
                        $customSearch .= (!empty($params['data']['component_type']) ? " AND ct.component_type = '" . $params['data']['component_type'] . "'" : "");
                        $customSearch .= (!empty($params['data']['component']) ? " AND c.component = '" . $params['data']['component'] . "'" : "");
                        $customSearch .= (!empty($params['data']['component_data']) ? " AND cc.component_data = '" . $params['data']['component_data'] . "'" : "");
                        break;
                    
                    case 'PM Service':
                        $customSearch .= " AND pm.servicelog_id IS NOT NULL";
                        break;
                    
                    case 'SMR Update':
                        $customSearch .= " AND su.servicelog_id IS NOT NULL";
                        break;
                }
            }
            
            $customSearch .= (!empty($params['data']['smr']) ? " AND su.smr = '" . $params['data']['smr'] . "'" : "");
        }
        
        $append_query = " WHERE (su.servicelog_id <> 'UNKNOWN'
                          OR pm.servicelog_id <> 'UNKNOWN'
                          OR fe.servicelog_id <> 'UNKNOWN'
                          OR cc.servicelog_id <> 'UNKNOWN')
                          AND s.new_id = 0" . $customSearch . " 
                          ORDER BY s.id DESC";

        if ($servicelog_id <> 0) {
            $append_query = " WHERE s.id = '" . $servicelog_id . "'";
        }

        $service_logs = $this->getAllServiceLogs($append_query);

        if ($servicelog_id <> 0) {
            $service_logs = $this->appendServiceLogChildren($servicelog_id, $service_logs, $params);
            $service_logs = $this->appendServiceLogReplacements($servicelog_id, $service_logs);
        }
        
        if ($servicelog_id == 0) {
//            die($fluidType);
            $service_logs = $this->appendFluidsAdministered($service_logs, $fluidType);
        }

        return ($servicelog_id <> 0 ? $service_logs[0] : $service_logs);
    }
    
    private function getAllServiceLogs($append_query) {
        try {
            $sql = "SELECT DISTINCT
                s.id, DATE_FORMAT(s.date_entered, '%m/%d/%Y') date_entered, s.entered_by, u.first_name AS enteredby_first_name, u.last_name AS enteredby_last_name, CONCAT(u.first_name, ' ', u.last_name) AS enteredby_full_name, man.manufacturer_name, em.equipmenttype_id, em.id equipmentmodel_id, em.model_number, eu.id equipmentunit_id, eu.unit_number,
                CASE
                    WHEN su.servicelog_id IS NOT NULL THEN 'sus'
                    WHEN pm.servicelog_id IS NOT NULL THEN 'pss'
                    WHEN fe.servicelog_id IS NOT NULL THEN 'flu'
                    WHEN cc.servicelog_id IS NOT NULL THEN 'ccs'
                    ELSE 'UNKNOWN'
                END AS subflow,
                CASE
                    WHEN su.servicelog_id IS NOT NULL THEN 'SMR Update'
                    WHEN pm.servicelog_id IS NOT NULL THEN 'PM Service'
                    WHEN fe.servicelog_id IS NOT NULL THEN 'Fluid Entry'
                    WHEN cc.servicelog_id IS NOT NULL THEN 'Component Change'
                    ELSE 'UNKNOWN'
                END AS entry_type,
                su.smr,
                ct.component_type,
                c.component,
                cc.component_data
            FROM servicelog s
                LEFT JOIN equipmentunit eu ON eu.id = s.unit_number
		LEFT JOIN equipmentmodel em on em.id = eu.equipmentmodel_id
		LEFT JOIN manufacturer man on man.id = em.manufacturer_id
                LEFT JOIN user u on u.id = s.entered_by
                LEFT OUTER JOIN smrupdate su ON su.servicelog_id = s.id
                LEFT OUTER JOIN pmservice pm ON pm.servicelog_id = s.id
                LEFT OUTER JOIN fluidentry fe ON fe.servicelog_id = s.id
                LEFT OUTER JOIN componentchange cc ON cc.servicelog_id = s.id 
                LEFT JOIN componenttype ct ON ct.id = cc.component_type
                LEFT JOIN component c ON c.id = cc.component " . $append_query;
            
//            die($sql);
            
            $results = R::getAll($sql);
            
//            echo '<pre>';
//            var_dump($results);
//            exit();
        } catch (Exception $ex) {
            $results = [];
        }
        return $results;
    }
    
    private function appendFluidsAdministered($service_logs = [], $fluidType = '') {
        foreach($service_logs as $ctr => $service_log) {
            $sql = (!empty($fluidType) ? "SELECT * FROM (" : "") . "SELECT '" . $service_log['id'] . "' servicelog_id, GROUP_CONCAT(temp.ftentries SEPARATOR ', ') typeoffluid
                    FROM (
                        SELECT ft.fluid_type ftentries
                        FROM fluidentry fe
                        LEFT JOIN fluidtype ft ON ft.id = fe.type
                        WHERE fe.servicelog_id = " . $service_log['id'] . " ) temp" .
                   (!empty($fluidType) ? ") temp2 WHERE typeoffluid LIKE '%" . $fluidType . "%'" : "");
            
            // phpMyAdmin
            //SELECT * FROM (SELECT '50' servicelog_id, GROUP_CONCAT(temp.ftentries SEPARATOR ', ') typeoffluid FROM ( SELECT ft.fluid_type ftentries FROM fluidentry fe LEFT JOIN fluidtype ft ON ft.id = fe.type WHERE fe.servicelog_id = 50 ) temp) temp2 WHERE typeoffluid LIKE '%Die%'
            
            //SELECT * FROM (SELECT '50' servicelog_id, GROUP_CONCAT(temp.ftentries SEPARATOR ', ') typeoffluid FROM ( SELECT ft.fluid_type ftentries FROM fluidentry fe LEFT JOIN fluidtype ft ON ft.id = fe.type WHERE fe.servicelog_id = 50 ) temp) temp2) WHERE typeoffluid LIKE '%Diesel - Off Highway%'
            
//            die($sql);
            $results = R::getAll($sql);
            
            $service_logs[$ctr]['typeoffluid'] = (!empty($results) ? $results[0]['typeoffluid'] : []);
        }
        
//        echo '<pre>';
//        var_dump($service_logs);
//        exit();
        
        return $service_logs;
    }
    
    /**
     * Appends child objects to show updates made to service logs
     * 
     * @param type $servicelog_id
     * @param type $service_logs
     */
    private function appendServiceLogReplacements($servicelog_id, $service_logs) {
        $replacements = R::getAll(
            "SELECT r.old_id, r.created, u.first_name, u.last_name
                FROM servicelogreplacement r
                LEFT JOIN user u ON u.id = r.entered_by
                WHERE r.old_id = '" . $servicelog_id . "'");
        
        $service_logs[0]['replacements'] = $replacements;
        
        return $service_logs;
    }
    
    /**
     * Appends child objects to service logs
     * 
     * @param type $servicelog_id
     * @param type $service_logs
     * @return type
     */
    private function appendServiceLogChildren($servicelog_id, $service_logs, $params = []) {
        $service_logs[0]['serviced_by'] = $this->getServicedBy($servicelog_id);
        $entry_type = '';
        if(!empty($params) && array_key_exists($params['data'])) {
            $entry_type = $params['data']['entry_type'];
        } else {
            $entry_type = $service_logs[0]['entry_type'];
        }
            
        switch($entry_type) {
            case 'SMR Update':
                $service_logs[0]['update_detail'] = $this->getSMRUpdateDetail($servicelog_id);
                break;
            
            case 'PM Service':
                $service_logs[0]['update_detail'] = $this->getPMServiceDetail($servicelog_id);
                break;
            
            case 'Fluid Entry':
                $service_logs[0]['update_detail'] = $this->getFluidEntryDetail($servicelog_id);
                $service_logs[0]['fluidentry_smr_detail'] = $this->getFluidEntrySMRUpdateDetail($servicelog_id);
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
     * Gets Fluide Entry SMR Update object
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function getFluidEntrySMRUpdateDetail($servicelog_id = 0) {
        $detail = R::getAll(
            "SELECT
                fes.smr
            FROM fluidentrysmrupdate fes
            WHERE fes.servicelog_id = '" . $servicelog_id . "'");

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
                ft.id, ft.fluid_type, ft.id AS fluidtype_id, fe.quantity, fe.units
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
                CASE pm.pm_type
                        WHEN 'smr_based' THEN smr.id
                        WHEN 'mileage_based' THEN mileage.id
                        WHEN 'time_based' THEN time.id
                        ELSE -1
                END AS pm_id,
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
               pn.id, pn.note
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
               pr.id,
               pr.emails,
               pr.pm_type,
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
                u.first_name, u.last_name, sb.user_id
            FROM servicelogservicedby sb
            LEFT JOIN user u ON u.id = sb.user_id
            WHERE sb.servicelog_id = '" . $servicelog_id . "'");

        return $detail;
    }
    
    public function markPMServiceReminderEmailAsSent($id) {
        $now = date('Y-m-d h:i:s');
        
        $pmservicereminder = R::load('pmservicereminder', $id);
        $pmservicereminder->sent = 1;
        $pmservicereminder->sent_on = $now;
        
        R::store($pmservicereminder);
    }
    
    public function findPMServiceEmailReminders() {        
        $pmservicereminders = R::getAll(
            "SELECT
                u.first_name AS enteredby_first_name, u.last_name AS enteredby_last_name,
                man.manufacturer_name, em.model_number, eu.unit_number,
                r.emails, r.sent_on,
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
                r.date AS reminder_date_created, r.sent AS reminder_date_sent, 
                r.id AS reminder_id
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

        foreach($pmservicereminders as $ctr => $reminder) {
            $unit_number = $reminder['unit_number'];
            $smrrecords = R::getAll(
                "SELECT smr.smr last_smr_recorded, s.unit_number
                 FROM smrupdate smr
                 LEFT JOIN servicelog s ON smr.servicelog_id = s.id
                 LEFT JOIN equipmentunit eu ON eu.id = s.unit_number 
                 WHERE eu.unit_number = '" . $unit_number . "'");
            $pmservicereminders[$ctr]['last_smr_recorded'] = (count($smrrecords)==0 ? 'NULL' : $smrrecords[0]['last_smr_recorded']);
        }
        
        return $pmservicereminders;
    }

}
