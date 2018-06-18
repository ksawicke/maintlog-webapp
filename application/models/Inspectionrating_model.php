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

}
