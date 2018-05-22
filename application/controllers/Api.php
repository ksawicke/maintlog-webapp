<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth is a Controller handling interactions related to app authorization
 *
 * Auth handles routes related mainly to authorizing users to use
 * the application.
 *
 *
 * @package  Maintenance Log Application
 * @author   Kevin Sawicke <kevin@rinconmountaintech.com>

 * @access   public
 */

require (APPPATH.'/libraries/REST_Controller.php');

use \Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');

		switch ($_SERVER['SERVER_NAME']) {
			case '10.132.146.48':
				$this->appDir = '/maintlog';
				break;

			case 'test.rinconmountaintech.com':
			default:
				$this->appDir = '/sites/komatsuna';
				break;
		}
	}

	/**
	 * Check credentials passed from login form.
	 * GET /api/authenticate?user_pin=9999&api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function authenticate_get() {
		$userPin = $_REQUEST['user_pin'];
		$apiKey = $_REQUEST['api_key'];

		$this->load->model('User_model');

		$authObject = $this->User_model->getAuthObject($userPin);

		if($authObject->authenticated && $apiKey==API_KEY) {
			$userObject = $authObject->user;
			$userData =  [
				'user_id' => (int) $userObject->id,
				'username' => $userObject->username,
				'first_name' => $userObject->first_name,
				'last_name' => $userObject->last_name,
				'email_address' => $userObject->email_address,
				'role' => $userObject->role
			];

			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'userData' => $userData
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}

		return;
	}

	/**
	 * Get allchecklists
	 * GET /api/checklist?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 *
	 * Get a single checklist by $id
	 * GET /api/checklist/2?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function checklist_get($id = null) {
		$apiKey = $_REQUEST['api_key'];

		$this->load->model('Checklist_model');

		if(is_null($id)) {
			$checklists = $this->Checklist_model->findAll();
		} else {
			$result = $this->Checklist_model->apiFindOne($id);
			$checklists = (!empty($result) ? $result[0] : []);
		}

		if($apiKey==API_KEY) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'checklists' => $checklists,
				'count' => count($checklists)
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Get all checklist items
	 * GET /api/checklistitem?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 *
	 * Get a single checklist item by $id
	 * GET /api/checklistitem/42?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function checklistitem_get($id = null) {
		$apiKey = $_REQUEST['api_key'];

		$this->load->model('Checklistitem_model');

		if(is_null($id)) {
			$checklistitems = $this->Checklistitem_model->findAll()['checklistitems'];
		} else {
			$checklistitems = $this->Checklistitem_model->findAll('', $id)['checklistitems'][0];
		}

		if($apiKey==API_KEY) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'checklistitems' => $checklistitems,
				'count' => count($checklistitems)
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Get all equipment type items
	 * GET /api/equipmenttype?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 *
	 * Get a single checklist item by $id
	 * GET /api/equipmenttype/11?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function equipmenttype_get($id = null) {
		$apiKey = $_REQUEST['api_key'];

		$this->load->model('Equipmenttype_model');

		if(is_null($id)) {
			$equipmenttypes = $this->Equipmenttype_model->findAll();
		} else {
			$equipmenttypes = $this->Equipmenttype_model->findOne($id);
		}

		if($apiKey==API_KEY) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'equipmenttypes' => $equipmenttypes,
				'count' => count($equipmenttypes)
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Create inspection ratings
	 * POST /api/upload_inspection_ratings?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function upload_inspection_ratings_post() {
		$apiKey = $_REQUEST['api_key'];
		$postBody = file_get_contents('php://input');

//		$this->load->model('Equipmenttype_model');

		if($apiKey==API_KEY) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'post' => json_decode($postBody)
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Create inspection ratings
	 * POST /api/upload_inspection_images?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function upload_inspection_images_post() {
		$apiKey = $_REQUEST['api_key'];
		$inspectionId = $_REQUEST['inspectionId'];
		$photoId = $_REQUEST['photoId'];
		
		$postBody = file_get_contents('php://input');

		$copied = false;
		$uploadsDir = '/home/rinconmo/test.rinconmountaintech.com/sites/komatsuna/assets/img/inspections';
		$tmpName = $_FILES['d']['tmp_name'];
		$name = basename($_FILES['d']['name']);

		if(move_uploaded_file($tmpName, "$uploadsDir/$name")) {
			$copied = true;
		}

		if($apiKey==API_KEY && $copied) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK'
				'd' => $_REQUEST
			], REST_Controller::HTTP_OK);
		} else if ($apiKey==API_KEY && !$copied) {
			$this->response([
				'status' => TRUE,
				'message' => 'Failed to save uploaded image'
			], REST_Controller::HTTP_EXPECTATION_FAILED);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

}
