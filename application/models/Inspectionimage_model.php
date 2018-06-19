<?php

/**
 * Handles inspection rating object interactions.
 */
class Inspectionimage_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Rb');

		date_default_timezone_set('America/Phoenix');
	}

	public function importInspectionimage($imagesData) {
		$now = date('Y-m-d h:i:s');

		$inspectionImage = R::dispense('inspectionimage');
		$inspectionImage->uuid = $imagesData['inspectionId'];
		$inspectionImage->checklistitem_id = $imagesData['checklistItemId'];
		$inspectionImage->photo_id = $imagesData['photoId'];
		$inspectionImage->type = $imagesData['type'];
		$inspectionImage->created = $now;

		R::store($inspectionImage);
	}

}
