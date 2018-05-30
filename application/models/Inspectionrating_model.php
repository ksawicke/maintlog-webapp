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

	public function importInspectionratings($ratingsData) {

		foreach($ratingsData as $ctr => $data) {
			$now = date('Y-m-d h:i:s');

			$inspectionrating = R::dispense('inspection');
			$inspectionrating->uuid = $data->inspectionId;
			$inspectionrating->equipmentunit_id = $data->equipmentUnitId;
			$inspectionrating->created = $now;
			$inspectionrating->created_by = $data->userId;

			R::store($inspectionrating);
		}

		/**
		 * $inspectionrating->checklist_id = $data->checklistId;
		$inspectionrating->rating = $data->rating;
		$inspectionrating->note = $data->note;
		 */
	}

}
