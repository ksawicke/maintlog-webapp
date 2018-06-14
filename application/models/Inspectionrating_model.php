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

	public function importInspectionratings($ratingsData) {

		foreach($ratingsData as $ctr => $data) {
			$this->createInspectionRecord($data);

			$inspectionRating = R::dispense('inspectionrating');
			$inspectionRating->uuid = $data->inspectionId;
			$inspectionRating->checklistitem_id = $data->checklistItemId;
			$inspectionRating->rating = $data->rating;
			$inspectionRating->note = $data->note;

			R::store($inspectionRating);
		}
	}

	public function createInspectionRecord($data) {
		$numOfInspectionsFoundWithUUID = R::count( 'inspection', ' uuid = ? ', [ $data->inspectionId ] );

		if($numOfInspectionsFoundWithUUID == 0) {
			$now = date('Y-m-d h:i:s');

			$inspection = R::dispense('inspection');
			$inspection->uuid = $data->inspectionId;
			$inspection->equipmentunit_id = $data->equipmentUnitId;
			$inspection->created = $now;
			$inspection->created_by = $data->userId;

			R::store($inspection);
		}
	}

}
