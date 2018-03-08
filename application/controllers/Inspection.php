<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Inspection is a Controller handling inspections to save data
 *
 * Inspection handles routes related mainly to the inspection entry form.
 *
 *
 * @package  Maintenance Log Application
 * @author   Kevin Sawicke <kevin@rinconmountaintech.com>
 * @version  $Revision: Tag v2.3.1 $
 * @access   public
 */
class Inspection extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
	}

	/**
	 * Returns a block of HTML to be used in the current Inspection Entry form.
	 * It is based on the selected Equipment Type.
	 */
	public function getInspectionHTML() {
		$data = [];
		$post = json_decode(file_get_contents('php://input'), true);

		$this->load->library('stringconversion');

		$ctr = 0;
		foreach($post['preStart'] as $key => $preStartData) {
			$preStartItemNameAdjusted = $this->stringconversion->removeSpecialCharacters($preStartData['item']);

			$data['inspectionItems'][$ctr]['sectionName'] = 'pre-start';
			$data['inspectionItems'][$ctr]['id'] = $preStartData['id'];
			$data['inspectionItems'][$ctr]['item'] = $preStartData['item'];
			$data['inspectionItems'][$ctr]['itemNameAdjusted'] = $preStartItemNameAdjusted;
			$data['inspectionItems'][$ctr]['itemFieldName'] = 'pre-start[' . $preStartItemNameAdjusted . ']';

			$ctr++;
		}

		foreach($post['postStart'] as $key => $postStartData) {
			$postStartItemNameAdjusted = $this->stringconversion->removeSpecialCharacters($postStartData['item']);

			$data['inspectionItems'][$ctr]['sectionName'] = 'post-start';
			$data['inspectionItems'][$ctr]['id'] = $postStartData['id'];
			$data['inspectionItems'][$ctr]['item'] = $postStartData['item'];
			$data['inspectionItems'][$ctr]['itemNameAdjusted'] = $postStartItemNameAdjusted;
			$data['inspectionItems'][$ctr]['itemFieldName'] = 'post-start[' . $postStartItemNameAdjusted . ']';

			$ctr++;
		}

		$html = $this->load->view('templates/bootstrap/authenticated/app/inspectionEntry/inspectionButtonHtml', $data, true);

		http_response_code(200);
		echo json_encode(['success' => true, 'data' => $html]);
		exit();
	}

//	public function save() {
//		$post = json_decode(file_get_contents('php://input'), true);
//
//		$prev_service_log = $this->Report_model->findServiceLogs($post['id'], 'compare');
//
//		$this->Servicelog_model->store($post, $prev_service_log);
//	}
//
//	public function deleteServiceLog() {
//		$post = json_decode(file_get_contents('php://input'), true);
//		$servicelog = [];
//
//		if(!$this->input->is_ajax_request() && !array_key_exists('action', $post) && is_int($post['servicelogid']) && $post['tokenCheck']!='CBxjkc6b32cb2ccy23b!8acbac%5654@6sdsassf') {
//			http_response_code(404);
//			$servicelog = ['success' => false, 'message' => 'There was an error deleting this service log. Please try again.'];
//		} else {
//			$servicelog = $this->Servicelog_model->deleteServiceLogAndChildren($post['servicelogid']);
//		}
//
//		if($servicelog['success']) {
//			http_response_code(200);
//		} else {
//			http_response_code(404);
//		}
//
//		echo json_encode($servicelog);
//		exit();
//	}
}
