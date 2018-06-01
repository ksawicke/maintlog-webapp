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

	public function importInspectionimages($imagesData) {

		foreach($imagesData as $ctr => $data) {
			$inspectionImage = R::dispense('inspectionimage');
			$inspectionImage->inspectionId = $data['inspectionId'];
			$inspectionImage->photoId = $data['checklistItemId'];
			$inspectionImage->folder = $data['folder'];
			$inspectionImage->name = $data['name'];

			R::store($inspectionImage);
		}
	}

}
