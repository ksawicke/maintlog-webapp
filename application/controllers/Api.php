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
	 *
	 * POST /api/authenticate?user_pin=9999&api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function authenticate_post() {
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
	 * Get checklists
	 *
	 * GET /api/checklist?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
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
				'checklists' => $checklists
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Get checklist items
	 *
	 * GET /api/checklistitem?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
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
				'checklistitems' => $checklistitems
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

}
