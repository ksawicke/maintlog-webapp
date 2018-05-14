<?php

/**
 * Handles checklist item object interactions.
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
	 * @param type $checklist_id
	 * @return array
	 */
	public function findOne($checklist_id) {
		$checklist = R::findOne('checklist', ' id = :checklist_id ', [':checklist_id' => $checklist_id]);

		return $checklist;
	}

	public function apiFindOne($checklist_id) {
		return R::getAll("SELECT c.id, et.id AS equipmenttype_id, et.equipment_type, c.checklist_json FROM checklist c LEFT JOIN equipmenttype et ON et.id = c.equipmenttype_id WHERE c.id = " . $checklist_id);
	}

	/**
	 * Finds all checklist objects.
	 *
	 * @return array
	 */
	public function findAll() {
		$result = R::getAll("SELECT c.id, et.id AS equipmenttype_id, et.equipment_type, c.checklist_json FROM checklist c LEFT JOIN equipmenttype et ON et.id = c.equipmenttype_id");

		return $result;
	}

	/**
	 * Creates or modifies a checklist object.
	 */
	public function store($post) {
		$now = date('Y-m-d h:i:s');

		$checklist = ($post['checklist_id']==0 ? R::dispense('checklist') : R::load('checklist', $post['checklist_id']));
		
		$checklist->equipmenttype_id = $post['equipmenttype_id'];
		$checklist->checklist_json = $post['checklist_json'];

		if($post['checklist_id']==0) {
			$checklist->created = $now;
			$checklist->created_by = $_SESSION['user_id'];
		} else {
			$checklist->modified = $now;
			$checklist->modified_by = $_SESSION['user_id'];
		}

//		echo '<pre>';
//		var_dump($post);
//		var_dump($checklist);
//		echo '</pre>';
//		exit();
		
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
