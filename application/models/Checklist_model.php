<?php

/**
 * Handles checklist object interactions.
 */
class Checklist_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('Rb');

		date_default_timezone_set('America/Phoenix');
	}

	/**
	 * Finds a single checklist object.
	 *
	 * @param integer $checklist_id
	 * @return array
	 */
	public function findOne($checklist_id) {
		$checklist = R::findOne('checklist', ' id = :checklist_id ', [':checklist_id' => $checklist_id]);

		return $checklist;
	}

	/**
	 * Finds all checklist objects.
	 *
	 * @return array
	 */
	public function findAll() {
		$checklists = R::findAll('checklist', ' ORDER BY id ASC');

		return $checklists;
	}

	/**
	 * Creates or modifies a checklist object.
	 */
	public function store($post) {
		$now = date('Y-m-d h:i:s');

		$checklist = ($post['checklist_id']==0 ? R::dispense('checklist') : R::load('checklist', $post['checklist_id']));
		$checklist->equipment_type = $post['equipment_type'];

		if($post['checklist_id']==0) {
			$checklist->created = $now;
			$checklist->created_by = $_SESSION['user_id'];
		} else {
			$checklist->modified = $now;
			$checklist->modified_by = $_SESSION['user_id'];
		}

		R::store($checklist);
	}

	/**
	 * Deletes a checklist type object.
	 *
	 * @param integer $checklist_id
	 */
	public function delete($checklist_id = null) {
		if(!is_null($checklist_id)) {
			$checklist = R::load('checklist', $checklist_id);
			R::trash($checklist);
		}
	}

}
