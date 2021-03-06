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
			$customSearch = $this->appendFindMaintenanceLogReminderQueries($params, $customSearch);
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

		list($params, $customSearch, $fluidType) = $this->buildServiceLogCustomSearch($params, $customSearch);

		$append_query = $this->appendServiceLogCustomSearch($servicelog_id, $customSearch);

		$service_logs = $this->appendServiceLogChildrenAndSort($servicelog_id, $params, $append_query, $fluidType);
        
        return ($servicelog_id <> 0 ? $service_logs[0] : $service_logs);
    }
    
    private function getAllServiceLogs($append_query) {
        try {
            $sql = "SELECT DISTINCT
                s.id, s.new_id, DATE_FORMAT(s.date_entered, '%m/%d/%Y') date_entered, s.entered_by, u.first_name AS enteredby_first_name, u.last_name AS enteredby_last_name, CONCAT(u.first_name, ' ', u.last_name) AS enteredby_full_name, man.manufacturer_name, em.equipmenttype_id, em.id equipmentmodel_id, em.model_number, eu.id equipmentunit_id, eu.unit_number,
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

            $results = R::getAll($sql);
        } catch (Exception $ex) {
            $results = [];
        }
        return $results;
    }

    private function appendServicedBy($service_logs = [], $params = []) {
		$appendQuery = "";
		$servicedBy = [];

		if(!empty($params['data']['serviced_by'])) {
			$servicedBy = explode(", ", $params['data']['serviced_by']);
			$appendQuery = " AND u.last_name = '" . $servicedBy[0] . "' AND u.first_name = '" . $servicedBy[1] . "'";
		}
		
    	foreach($service_logs as $ctr => $service_log) {
			$sql = "SELECT slsb.user_id, u.first_name servicedby_first_name, u.last_name servicedby_last_name FROM servicelogservicedby slsb
					LEFT JOIN user u ON u.id = slsb.user_id
					WHERE slsb.servicelog_id = " . $service_log['id'] . $appendQuery;

			$results = R::getAll($sql);

			if(empty($results)) {
				unset($service_logs[$ctr]);
			} else {
				$service_logs[$ctr]['serviced_by'] = $results;
			}
		}

		sort($service_logs);
		
		return $service_logs;
	}
    
    private function appendFluidsAdministered($service_logs = [], $fluidType = '') {
        $fluidType = '';
        $results = [];
        foreach($service_logs as $ctr => $service_log) {
			$fluidArray = [];

            $sql = "SELECT fe.servicelog_id, ft.fluid_type, fe.quantity, fe.units FROM fluidentry fe LEFT JOIN fluidtype ft ON ft.id = fe.type WHERE fe.servicelog_id = " . $service_log['id'] . (!empty($fluidType) ? " WHERE fluid_type LIKE '%" . $fluidType . "%'" : "");
            
            $results = R::getAll($sql);
            
            $service_logs[$ctr]['fluids_administered'] = $results;
			foreach($service_logs[$ctr]['fluids_administered'] as $factr => $fluidData) {
				$fluidArray[] = $fluidData['quantity'] . ' ' . $fluidData['units'] . ' ' . $fluidData['fluid_type'];
			}

			$service_logs[$ctr]['fluid_string'] = implode(', ', $fluidArray);
        }
        
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
                $service_logs[0]['componentchange_smr_detail'] = $this->getComponentChangeSMRUpdateDetail($servicelog_id);
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
                smr.previous_smr, smr.smr, smr.note
            FROM smrupdate smr
            WHERE smr.servicelog_id = '" . $servicelog_id . "'");

        return (!empty($detail) ? $detail[0] : []);
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
                fes.previous_smr, fes.smr, fes.note
            FROM fluidentrysmrupdate fes
            WHERE fes.servicelog_id = '" . $servicelog_id . "'");

        return (!empty($detail) ? $detail[0] : []);
    }

    public function getComponentChangeSMRUpdateDetail($servicelog_id = 0) {
		$detail = R::getAll(
			"SELECT
                csu.previous_smr, csu.smr
            FROM componentchangesmrupdate csu
            WHERE csu.servicelog_id = '" . $servicelog_id . "'");

		return (!empty($detail) ? $detail[0] : []);
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
                pm.previous_smr, pm.current_smr, pm.due_units, pm.notes
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
    
    public function findPMServiceEmailReminders($params = []) {
    	$customSearch = [];

		if(!empty($params) && array_key_exists('data', $params)) {
			$customSearch[] = (!empty($params['data']['manufacturer_name']) ? " man.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
			$customSearch[] = (!empty($params['data']['model_number']) ? " em.model_number = '" . $params['data']['model_number'] . "'" : "");
			$customSearch[] = (!empty($params['data']['unit_number']) ? " eu.unit_number = '" . $params['data']['unit_number'] . "'" : "");
			$customSearch[] = (!empty($params['data']['emails']) ? " r.emails = '" . $params['data']['emails'] . "'" : "");
		}

		$customSearchString = join(' AND ', array_filter($customSearch));

		$sql = "SELECT
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
             LEFT OUTER JOIN timechoice time ON (time.id = ps.pm_level AND ps.pm_type = 'time_based') " . (!empty($customSearchString) ? " WHERE " . $customSearchString : "") . " 
             ORDER BY r.date DESC, r.id DESC";

        $pmservicereminders = R::getAll($sql);

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

	/**
	 * @param array $params
	 * @return array
	 */
	public function getEquipmentList($params = []) {
		$customSearch = [];
		$customSearchString = "";

		if(!empty($params) && array_key_exists('data', $params)) {
			$customSearch[] = (!empty($params['data']['manufacturer_name']) ? " man.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
			$customSearch[] = (!empty($params['data']['model_number']) ? " em.model_number = '" . $params['data']['model_number'] . "'" : "");
			$customSearch[] = (!empty($params['data']['unit_number']) ? " eu.unit_number = '" . $params['data']['unit_number'] . "'" : "");
			$customSearch[] = (!empty($params['data']['equipment_type']) ? " et.equipment_type = '" . $params['data']['equipment_type'] . "'" : "");
		}

		foreach($customSearch as $ctr => $search) {
			if(empty($search)) {
				unset($customSearch[$ctr]);
			}
		}

		$customSearchString = join(' AND ', array_filter(array_merge(array(join(' AND ', array_slice($customSearch, 0, -1))), array_slice($customSearch, -1)), 'strlen'));

		$customSql = "SELECT
            man.manufacturer_name, em.model_number, eu.unit_number, et.equipment_type
            FROM equipmentunit eu
            LEFT JOIN equipmentmodel em on em.id = eu.equipmentmodel_id
	    	LEFT JOIN manufacturer man on man.id = em.manufacturer_id
	    	LEFT JOIN equipmenttype et on et.id = em.equipmenttype_id " . (!empty($customSearchString) ? " WHERE " . $customSearchString : "") . "
            ORDER BY manufacturer_name, model_number, unit_number";

        $equipment_list = R::getAll($customSql);
        
        return $equipment_list;
    }

    public function getFuelUsed($params = [])
	{
		$customSearch = '';

		$append_query = $this->appendFuelUsedQueries($params, $customSearch);

		$sql = 'SELECT s.date_entered, equipmenttype.equipment_type, manufacturer.manufacturer_name, equipmentmodel.model_number, equipmentunit.unit_number, ft.fluid_type, fe.quantity
FROM fluidentry fe
LEFT JOIN servicelog s ON fe.servicelog_id = s.id
LEFT JOIN fluidtype ft ON ft.id = fe.type

LEFT JOIN equipmentunit ON s.unit_number = equipmentunit.id
LEFT JOIN equipmentmodel ON equipmentunit.equipmentmodel_id = equipmentmodel.id
LEFT JOIN manufacturer ON equipmentmodel.manufacturer_id = manufacturer.id
LEFT JOIN equipmenttype ON equipmentmodel.equipmenttype_id = equipmenttype.id

WHERE s.new_id = 0 ' . $append_query . '
ORDER BY s.date_entered DESC, s.id DESC';

		$fluidsUsed = R::getAll($sql);

		return $fluidsUsed;
	}

	public function getFuelUsedTotals($params = [])
	{
		$customSearch = '';

		$append_query = $this->appendFuelUsedQueries($params, $customSearch);

		$sql = 'SELECT ft.fluid_type, SUM(fe.quantity) total_quantity_used
		FROM fluidentry fe
		LEFT JOIN servicelog s ON fe.servicelog_id = s.id
		LEFT JOIN fluidtype ft ON ft.id = fe.type

		LEFT JOIN equipmentunit ON s.unit_number = equipmentunit.id
		LEFT JOIN equipmentmodel ON equipmentunit.equipmentmodel_id = equipmentmodel.id
		LEFT JOIN manufacturer ON equipmentmodel.manufacturer_id = manufacturer.id
		LEFT JOIN equipmenttype ON equipmentmodel.equipmenttype_id = equipmenttype.id

		WHERE s.new_id = 0 ' . (!empty($append_query) ? ' ' . $append_query : '') . ' 
		GROUP BY ft.fluid_type';

		$fluidsUsed = R::getAll($sql);

		return $fluidsUsed;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getSMRUsed($params = [])
	{
		$customSearch = '';

		$append_query = $this->appendSMRUsedQueries($params, $customSearch);

		if (substr_count($append_query, 'AND') >= 1) {
            $append_query = substr($append_query, 4);
        }

		$dbQuery = "SELECT a.*, MIN(smr) min_smr, MAX(smr) max_smr FROM ((
		SELECT s.date_entered, equipmenttype.equipment_type, manufacturer.manufacturer_name, equipmentmodel.model_number, equipmentunit.unit_number,
		CASE equipmentunit.track_type
            WHEN 'mileage' THEN 'Mileage'
            WHEN 'smr' THEN 'SMR'
            WHEN 'time' THEN 'Time'
            ELSE ''
        END AS track_type,
        smr.smr, 'smrupdate' smr_update_type, s.id servicelog_id, smr.id smrupdate_id, equipmentunit.id equipmentunit_id
		FROM smrupdate smr
		LEFT JOIN servicelog s ON smr.servicelog_id = s.id

		LEFT JOIN equipmentunit ON s.unit_number = equipmentunit.id
		LEFT JOIN equipmentmodel ON equipmentunit.equipmentmodel_id = equipmentmodel.id
		LEFT JOIN manufacturer ON equipmentmodel.manufacturer_id = manufacturer.id
		LEFT JOIN equipmenttype ON equipmentmodel.equipmenttype_id = equipmenttype.id
    	WHERE smr.smr > 0
		)
		UNION
		(
		SELECT s.date_entered, equipmenttype.equipment_type, manufacturer.manufacturer_name, equipmentmodel.model_number, equipmentunit.unit_number, 
		CASE equipmentunit.track_type
            WHEN 'mileage' THEN 'Mileage'
            WHEN 'smr' THEN 'SMR'
            WHEN 'time' THEN 'Time'
            ELSE ''
        END AS track_type,
		fsmr.smr, 'fluidentrysmrupdate' smr_update_type, s.id servicelog_id, fsmr.id smrupdate_id, equipmentunit.id equipmentunit_id
		FROM fluidentrysmrupdate fsmr
		LEFT JOIN servicelog s ON fsmr.servicelog_id = s.id

		LEFT JOIN equipmentunit ON s.unit_number = equipmentunit.id
		LEFT JOIN equipmentmodel ON equipmentunit.equipmentmodel_id = equipmentmodel.id
		LEFT JOIN manufacturer ON equipmentmodel.manufacturer_id = manufacturer.id
		LEFT JOIN equipmenttype ON equipmentmodel.equipmenttype_id = equipmenttype.id
        WHERE fsmr.smr > 0
		)) a " . (!empty($append_query) ? ' WHERE ' . $append_query : '') . "
		GROUP BY a.equipmentunit_id
        ORDER BY a.date_entered DESC";

		$units = R::getAll($dbQuery);

		foreach($units as $ctr => $unitData) {
			$units[$ctr]['min_smr'] = (int)$unitData['min_smr'];
			$units[$ctr]['max_smr'] = (int)$unitData['max_smr'];
		}

		return $units;
	}

	/**
	 * @param $params
	 * @param $customSearch
	 * @return array
	 */
	protected function appendFindServiceLogQueries($params, $customSearch)
	{
		$enteredByName = explode(", ", $params['data']['entered_by']);
		$servicedByName = explode(" ", $params['data']['serviced_by']);

		$customSearch .= (!empty($params['data']['date_entered']) ? " AND s.date_entered = '" . date('Y-m-d', strtotime($params['data']['date_entered'])) . "'" : "");
		$customSearch .= (!empty($params['data']['date_entered_starting']) ? " AND s.date_entered >= '" . date('Y-m-d', strtotime($params['data']['date_entered_starting'])) . "'" : "");
		$customSearch .= (!empty($params['data']['date_entered_ending']) ? " AND s.date_entered <= '" . date('Y-m-d', strtotime($params['data']['date_entered_ending'])) . "'" : "");

		$customSearch .= (!empty($params['data']['entered_by']) ? " AND u.last_name = '" . $enteredByName[0] . "' AND u.first_name = '" . $enteredByName[1] . "'" : "");
		$customSearch .= (!empty($params['data']['manufacturer_name']) ? " AND man.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
		$customSearch .= (!empty($params['data']['model_number']) ? " AND em.model_number = '" . $params['data']['model_number'] . "'" : "");
		$customSearch .= (!empty($params['data']['unit_number']) ? " AND eu.unit_number = '" . $params['data']['unit_number'] . "'" : "");

		return array($params, $customSearch);
	}

	protected function appendFuelUsedQueries($params, $customSearch)
	{
		$customSearch .= (!empty($params['data']['date_entered']) ? " AND s.date_entered = '" . date('Y-m-d', strtotime($params['data']['date_entered'])) . "'" : "");
		$customSearch .= (!empty($params['data']['date_entered_starting']) ? " AND s.date_entered >= '" . date('Y-m-d', strtotime($params['data']['date_entered_starting'])) . "'" : "");
		$customSearch .= (!empty($params['data']['date_entered_ending']) ? " AND s.date_entered <= '" . date('Y-m-d', strtotime($params['data']['date_entered_ending'])) . "'" : "");

		$customSearch .= (!empty($params['data']['fluid_type']) ? " AND ft.fluid_type = '" . $params['data']['fluid_type'] . "'" : "");
		$customSearch .= (!empty($params['data']['equipment_type']) ? " AND equipmenttype.equipment_type = '" . $params['data']['equipment_type'] . "'" : "");
		$customSearch .= (!empty($params['data']['manufacturer_name']) ? " AND manufacturer.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
		$customSearch .= (!empty($params['data']['model_number']) ? " AND equipmentmodel.model_number = '" . $params['data']['model_number'] . "'" : "");
		$customSearch .= (!empty($params['data']['unit_number']) ? " AND equipmentunit.unit_number = '" . $params['data']['unit_number'] . "'" : "");

		return $customSearch;
	}

    protected function appendSMRUsedQueries($params, $customSearch)
    {
        $customSearch .= (!empty($params['data']['date_entered']) ? " AND a.date_entered = '" . date('Y-m-d', strtotime($params['data']['date_entered'])) . "'" : "");
        $customSearch .= (!empty($params['data']['date_entered_starting']) ? " AND a.date_entered >= '" . date('Y-m-d', strtotime($params['data']['date_entered_starting'])) . "'" : "");
        $customSearch .= (!empty($params['data']['date_entered_ending']) ? " AND a.date_entered <= '" . date('Y-m-d', strtotime($params['data']['date_entered_ending'])) . "'" : "");

        $customSearch .= (!empty($params['data']['equipment_type']) ? " AND a.equipment_type = '" . $params['data']['equipment_type'] . "'" : "");
        $customSearch .= (!empty($params['data']['manufacturer_name']) ? " AND a.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
        $customSearch .= (!empty($params['data']['model_number']) ? " AND a.model_number = '" . $params['data']['model_number'] . "'" : "");
        $customSearch .= (!empty($params['data']['unit_number']) ? " AND a.unit_number = '" . $params['data']['unit_number'] . "'" : "");

        return $customSearch;
    }

	/**
	 * @param $params
	 * @param $customSearch
	 * @return string
	 */
	protected function appendFindMaintenanceLogReminderQueries($params, $customSearch)
	{
		$customSearch .= (!empty($params['data']['date_entered']) ? " AND s.date_entered = '" . date('Y-m-d', strtotime($params['data']['date_entered'])) . "'" : "");
		$customSearch .= (!empty($params['data']['current_smr']) ? " AND pm.current_smr = '" . $params['data']['current_smr'] . "'" : "");
		$customSearch .= (!empty($params['data']['manufacturer_name']) ? " AND man.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
		$customSearch .= (!empty($params['data']['model_number']) ? " AND em.model_number = '" . $params['data']['model_number'] . "'" : "");
		$customSearch .= (!empty($params['data']['unit_number']) ? " AND eu.unit_number = '" . $params['data']['unit_number'] . "'" : "");
		$customSearch .= (!empty($params['data']['notes']) ? " AND pm.notes = '" . $params['data']['notes'] . "'" : "");
		$customSearch .= (!empty($params['data']['due_units']) ? " AND pm.due_units = '" . $params['data']['due_units'] . "'" : "");

		return $customSearch;
	}

	/**
	 * @param $params
	 * @param $customSearch
	 * @return array
	 */
	protected function appendServiceLogComponentChangeQuery($params, $customSearch)
	{
		$customSearch .= " AND cc.servicelog_id IS NOT NULL";
		$customSearch .= (!empty($params['data']['component_type']) ? " AND ct.component_type = '" . $params['data']['component_type'] . "'" : "");
		$customSearch .= (!empty($params['data']['component']) ? " AND c.component = '" . $params['data']['component'] . "'" : "");
		$customSearch .= (!empty($params['data']['component_data']) ? " AND cc.component_data = '" . $params['data']['component_data'] . "'" : "");
		return array($customSearch, $params);
	}

	/**
	 * @param $servicelog_id
	 * @param $customSearch
	 * @return string
	 */
	protected function appendServiceLogCustomSearch($servicelog_id, $customSearch)
	{
		$append_query = " WHERE (su.servicelog_id <> 'UNKNOWN'
                          OR pm.servicelog_id <> 'UNKNOWN'
                          OR fe.servicelog_id <> 'UNKNOWN'
                          OR cc.servicelog_id <> 'UNKNOWN')
                          AND s.new_id = 0" . $customSearch . " 
                          ORDER BY s.id DESC";

		if ($servicelog_id <> 0) {
			$append_query = " WHERE s.id = '" . $servicelog_id . "'";
		}
		return $append_query;
	}

	/**
	 * @param $servicelog_id
	 * @param $params
	 * @param $append_query
	 * @param $fluidType
	 * @return array|type
	 */
	protected function appendServiceLogChildrenAndSort($servicelog_id, $params, $append_query, $fluidType)
	{
		$service_logs = $this->getAllServiceLogs($append_query);

		$service_logs = $this->appendServicedBy($service_logs, $params);

		if ($servicelog_id <> 0) {
			$service_logs = $this->appendServiceLogChildren($servicelog_id, $service_logs, $params);
			$service_logs = $this->appendServiceLogReplacements($servicelog_id, $service_logs);
		}

		if ($servicelog_id == 0) {
			$service_logs = $this->appendFluidsAdministered($service_logs, $fluidType);
		}

		foreach ($service_logs as $ctr => $sl) {
			if (!empty($fluidType) && strpos($sl['fluid_string'], $fluidType) !== false) {
				// Do nothing
			} elseif (!empty($fluidType)) {
				unset($service_logs[$ctr]);
			}
		}
		sort($service_logs);

		/** Sorts by id DESC */
		array_multisort(array_map(function($element) {
			return $element['id'];
		}, $service_logs), SORT_DESC, $service_logs);

		return $service_logs;
	}

	/**
	 * @param $params
	 * @param $customSearch
	 * @return array
	 */
	protected function buildServiceLogCustomSearch($params, $customSearch)
	{
		$fluidType = "";

		if (!empty($params) && array_key_exists('data', $params)) {
			list($params, $customSearch) = $this->appendFindServiceLogQueries($params, $customSearch);

			if (!empty($params['data']['entry_type'])) {
				switch ($params['data']['entry_type']) {
					case 'Fluid Entry':
						$customSearch .= " AND fe.servicelog_id IS NOT NULL AND su.smr IS NULL";
						$fluidType = $params['data']['fluid_type'];
						break;

					case 'Component Change':
						list($customSearch, $params) = $this->appendServiceLogComponentChangeQuery($params, $customSearch);
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

		return array($params, $customSearch, $fluidType);
	}

	/**
	 * Gets Component Change Detail
	 *
	 * @param type $servicelog_id
	 * @return type
	 */
	public function getInspectionEntries($uuid = null, $params = []) {
		$customSearch = $this->appendInspectionEntryCustomSearch($params);

		$inspectionEntries = R::getAll(
			"SELECT
					i.id, i.uuid AS inspection_uuid,
					eu.unit_number,
					eu.id equipmentunit_id,
					man.manufacturer_name,
					em.model_number,
					et.equipment_type,
					et.id equipmenttype_id,
					eu.track_type,
					i.created,
					u.first_name AS created_by_first_name,
					u.last_name AS created_by_last_name
				FROM inspection i
				LEFT JOIN user u ON i.created_by = u.id
				LEFT JOIN equipmentunit eu ON i.equipmentunit_id = eu.id
				LEFT JOIN equipmentmodel em ON eu.equipmentmodel_id = em.id
				LEFT JOIN manufacturer man ON em.manufacturer_id = man.id
				LEFT JOIN equipmenttype et ON em.equipmenttype_id = et.id
				
				WHERE i.uuid " . (!is_null($uuid) ? " = \"" . $uuid . "\"" : " IS NOT NULL") . $customSearch . "
				ORDER BY i.id DESC"
		);

		$checklist_items = R::getAll(
			"SELECT id, item
					 FROM checklistitem 
					 ORDER BY item ASC"
		);

		foreach($inspectionEntries as $ctr => $entry) {
			$equipmenttype_id = $entry['equipmenttype_id'];

			$inspectionEntries[$ctr]['ratings'] = R::getAll(
				"SELECT cli.id checklistitem_id, cli.item,
					 ir.rating, ir.note
					 FROM inspectionrating ir
					 LEFT JOIN checklistitem cli ON ir.checklistitem_id = cli.id
					 WHERE ir.uuid = \"" . $inspectionEntries[$ctr]['inspection_uuid'] . "\""
			);

			$inspectionEntries[$ctr]['checklist_items'] = $checklist_items;

			$inspectionEntries[$ctr]['ratingCount'] = R::getAll(
				"SELECT count(if(ir.rating = 0, ir.rating, NULL)) count_bad,
                            count(if(ir.rating = 1, ir.rating, NULL)) count_good
					 FROM inspectionrating ir
					 WHERE ir.uuid = \"" . $inspectionEntries[$ctr]['inspection_uuid'] . "\"");

			$inspectionEntries = $this->searchForInspectionImages($inspectionEntries, $ctr);
		}

		return (!is_null($uuid) ? $inspectionEntries[0] : $inspectionEntries);
	}

	/**
	 * @param $params
	 * @return string
	 */
	public function appendInspectionEntryCustomSearch($params)
	{
		$customSearch = "";

		if (!empty($params)) {
			$customSearch .= (!empty($params['data']['date_entered']) ? " AND i.created = '" . date('Y-m-d', strtotime($params['data']['date_entered'])) . "'" : "");
			$customSearch .= (!empty($params['data']['unit_number']) ? " AND eu.unit_number = '" . $params['data']['unit_number'] . "'" : "");
			$customSearch .= (!empty($params['data']['manufacturer_name']) ? " AND man.manufacturer_name = '" . $params['data']['manufacturer_name'] . "'" : "");
			$customSearch .= (!empty($params['data']['model_number']) ? " AND em.model_number = '" . $params['data']['model_number'] . "'" : "");
			$customSearch .= (!empty($params['data']['equipment_type']) ? " AND et.equipment_type = '" . $params['data']['equipment_type'] . "'" : "");
		}
		return $customSearch;
	}

	/**
	 * @param $inspectionEntries
	 * @param $ctr
	 * @return mixed
	 */
	public function searchForInspectionImages($inspectionEntries, $ctr)
	{
		foreach ($inspectionEntries[$ctr]['ratings'] as $rc => $rating) {
			$images = R::getAll(
				"SELECT DISTINCT(ii.photo_id), ii.checklistitem_id, ii.type file_extension, cli.item
					 FROM `inspectionimage` ii
					 LEFT JOIN checklistitem cli ON ii.checklistitem_id = cli.id
					 WHERE uuid = \"" . $inspectionEntries[$ctr]['inspection_uuid'] . "\"
					 AND checklistitem_id = " . $rating['checklistitem_id']
			);

			if (count($images) > 0) {
				$inspectionEntries = $this->appendInspectionImages($inspectionEntries, $ctr, $images, $rating, $rc);
			}

			if (array_key_exists('imageCount', $inspectionEntries[$ctr])) {
				$inspectionEntries[$ctr]['imageCount'] += count($images);
			} else {
				$inspectionEntries[$ctr]['imageCount'] = 0;
			}
		}
		return $inspectionEntries;
	}

	/**
	 * @param $inspectionEntries
	 * @param $ctr
	 * @param $images
	 * @param $rating
	 * @param $rc
	 * @return mixed
	 */
	public function appendInspectionImages($inspectionEntries, $ctr, $images, $rating, $rc)
	{
		foreach ($images as $ictr => $imageInfo) {
			$image_location = "img/inspections/" . $inspectionEntries[$ctr]['inspection_uuid'] . "/" . $inspectionEntries[$ctr]['inspection_uuid'] . "_" . $rating['checklistitem_id'] . "_" . ($ictr + 1) . "." . $imageInfo['file_extension'];

			$inspectionEntries[$ctr]['ratings'][$rc]['images'][] = $image_location;
		}
		return $inspectionEntries;
	}

}
