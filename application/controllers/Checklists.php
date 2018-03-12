<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Checklists is a Controller handling interactions related to checklists
 *
 * Checklists handles routes related mainly to the checklist table
 * used by the application.
 *
 *
 * @package  Maintenance Log Application
 * @author   Kevin Sawicke <kevin@rinconmountaintech.com>

 * @access   public
 */
class Checklists extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');

		$this->load->model('Checklist_model');
	}

	/**
	 * Get checklist items
	 */
	public function getChecklists() {
		$post = json_decode(file_get_contents('php://input'), true);
		$checklistmodel = [];

		$checklistmodel = $this->Checklist_model->findAll();

		if(empty($checklistmodel)) {
			http_response_code(404);
			echo json_encode(['success' => false]);
		} else {
			http_response_code(200);
			echo json_encode(['success' => true, 'data' => $checklistmodel], JSON_NUMERIC_CHECK);
		}

		exit();
	}

	public function save() {
		$this->Checklist_model->store($this->input->post());

		$this->load->library('session');

		$this->session->set_flashdata('data_name', 'data_value');
		redirect('/app/checklists', 'refresh');
	}

	public function delete($checklist_id) {
		$this->load->library('session');

		$this->load->model('Checklist_model');
		$this->Checklist_model->delete($checklist_id);
		$this->session->set_flashdata('data_name', 'data_value');
		redirect('/app/checklists', 'refresh');
	}
}
