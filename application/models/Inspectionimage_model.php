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
		$inspectionImage = R::dispense('inspectionimage');
		$inspectionImage->uuid = $imagesData['inspectionId'];
		$inspectionImage->photoId = $imagesData['photoId'];
		$inspectionImage->type = $imagesData['type'];

		R::store($inspectionImage);
	}

}
