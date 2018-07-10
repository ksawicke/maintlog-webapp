<?php

/**
 * Handles inspection rating object interactions.
 */
class Inspectionrating_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Rb');

		date_default_timezone_set('America/Phoenix');
	}

	/**
	 * Finds a count of Inspection Rating by Inspection Id
	 *
	 * @param type $count
	 * @return count
	 */
	public function findCountByInspectionId($inspectionId) {
		$count = R::count('inspectionrating', ' uuid = :inspectionId ', [':inspectionId' => $inspectionId]);

		return $count;
	}

	public function importInspectionratings($data) {
		foreach($data as $ctr => $rating) {
			$now = date('Y-m-d h:i:s');

			$this->createInspectionRecord($rating);

			$inspectionRating = R::dispense('inspectionrating');
			$inspectionRating->uuid = $rating->inspectionId;
			$inspectionRating->checklistitem_id = $rating->checklistItemId;
			$inspectionRating->rating = $rating->rating;
			$inspectionRating->note = $rating->note;
			$inspectionRating->created = $now;

			R::store($inspectionRating);
		}
	}

	public function createInspectionRecord($rating) {
		$numOfInspectionsFoundWithUUID = R::count( 'inspection', ' uuid = ? ', [ $rating->inspectionId ] );

		if($numOfInspectionsFoundWithUUID == 0) {
			$now = date('Y-m-d h:i:s');

			$inspection = R::dispense('inspection');
			$inspection->uuid = $rating->inspectionId;
			$inspection->equipmentunit_id = $rating->equipmentUnitId;
			$inspection->created = $now;
			$inspection->created_by = $rating->userId;

			R::store($inspection);
		}
	}

	/**
	 * @param
	 * $data{["equipmentUnitId": "4", "smr": "55555", "userId": "1", "inspectionId": "E5FC3133-7EB1-4F3E-AD26-C758F298C9CC"], ["equipmentUnitId": "30", "smr": "66666", "userId": "1", "inspectionId": "7BCB5881-1855-4D81-8CE3-5D152C4056A1"], ["equipmentUnitId": "6", "smr": "44444", "userId": "1", "inspectionId": "E4952D60-6CEA-4CE8-A26F-97ECC81DF966"], ["equipmentUnitId": "6", "smr": "33333", "userId": "1", "inspectionId": "AA0B77CE-3774-449C-B0D4-1F282AAF1E4F"]}
	 */
	public function doSMRUpdate($data) {
		foreach($data as $ctr => $smrupdate) {
//			$now = date('Y-m-d h:i:s');

			$inspectionSmrUpdate = R::dispense('inspectionsmrupdate');
			$inspectionSmrUpdate->uuid = $smrupdate->inspectionId;
			$inspectionSmrUpdate->smr = $smrupdate->smr;
			$inspectionSmrUpdate->previous_smr = $this->findLastSMR($smrupdate->equipmentUnitId);

			R::store($inspectionSmrUpdate);
		}
	}

	// TODO: See also Equipmentunit_model.php
	public function findLastSMR($equipment_unit_id) {
		$sql = "SELECT unit_number, MAX(smr) last_smr FROM
                (SELECT '" . $equipment_unit_id . "' unit_number, MAX(fes.smr) smr from fluidentrysmrupdate fes
                        LEFT JOIN servicelog s ON s.id = fes.servicelog_id
                        LEFT JOIN equipmentunit eu ON eu.unit_number = s.unit_number
                        WHERE s.unit_number = " . $equipment_unit_id . "
                        
                UNION ALL
                	SELECT '" . $equipment_unit_id . "' unit_number, MAX(ccsu.smr) smr from componentchangesmrupdate ccsu
                		LEFT JOIN servicelog s ON s.id = ccsu.servicelog_id
                		LEFT JOIN equipmentunit eu ON eu.unit_number = s.unit_number
                		WHERE s.unit_number = " . $equipment_unit_id . "        
                        
                UNION ALL
					SELECT '" . $equipment_unit_id . "' unit_number, MAX(isu.smr) smr from inspectionsmrupdate isu
							LEFT JOIN inspection i ON i.uuid = isu.uuid
							LEFT JOIN equipmentunit eu ON eu.id = i.equipmentunit_id
							WHERE eu.unit_number = " . $equipment_unit_id . "
                UNION ALL
                    SELECT '" . $equipment_unit_id . "' unit_number, MAX(pms.current_smr) smr from pmservice pms
                        LEFT JOIN servicelog s ON s.id = pms.servicelog_id
                        LEFT JOIN equipmentunit eu ON eu.unit_number = s.unit_number
                        WHERE s.unit_number = " . $equipment_unit_id . "
                UNION ALL
                    SELECT '" . $equipment_unit_id . "' unit_number, MAX(smr.smr) smr from smrupdate smr
                        LEFT JOIN servicelog s ON s.id = smr.servicelog_id
                        LEFT JOIN equipmentunit eu ON eu.unit_number = s.unit_number
                        WHERE s.unit_number = " . $equipment_unit_id . ") AS smrvalues
                GROUP BY unit_number";

		$values = R::getAll($sql);

		return $values[0]['last_smr'];
	}

}
