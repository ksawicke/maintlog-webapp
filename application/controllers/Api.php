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
				$this->rootDir = '/var/www/html';
				$this->appDir = '/maintlog';
				break;

			case 'test.rinconmountaintech.com':
			default:
				$this->rootDir = '/home/rinconmo/test.rinconmountaintech.com';
				$this->appDir = '/sites/komatsuna';
				break;
		}

		$this->uploadsInspectionImagesDir = '/assets/img/inspections';
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

	public function equipmentunit_get($id = null) {
		$apiKey = $_REQUEST['api_key'];

		$this->load->model('Equipmentunit_model');

		if(is_null($id)) {
			$equipmentunits = $this->Equipmentunit_model->findAllApi();
		} else {
			$equipmentunits = $this->Equipmentunit_model->findAllApi($id);
		}

		if($apiKey==API_KEY) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'equipmentunits' => $equipmentunits,
				'count' => count($equipmentunits)
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Get all fluid type items
	 * GET /api/fluidtype?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 *
	 * Get a single fluid type by $id
	 * GET /api/fluidtype/11?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function fluidtype_get($id = null) {
		$apiKey = $_REQUEST['api_key'];

		$this->load->model('Fluidtype_model');

		if(is_null($id)) {
			$fluidtypes = $this->Fluidtype_model->findAllApi();
		} else {
			$fluidtypes = $this->Fluidtype_model->findAllApi($id);
		}

		if($apiKey==API_KEY) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'fluidtypes' => $fluidtypes,
				'count' => count($fluidtypes)
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Get all user items
	 * GET /api/user?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 *
	 * Get a single fluid type by $id
	 * GET /api/user/11?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 */
	public function user_get($id = null) {
		$apiKey = $_REQUEST['api_key'];

		$this->load->model('User_model');

		if(is_null($id)) {
			$users = $this->User_model->findAllApi();
		} else {
			$users = $this->User_model->findAllApi($id);
		}

		if($apiKey==API_KEY) {
			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'users' => $users,
				'count' => count($users)
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
		$data = json_decode($postBody);

		if($apiKey==API_KEY) {
			$this->load->model('Inspectionrating_model');
			$this->Inspectionrating_model->importInspectionratings($data->ratings);

			$this->response([
				'status' => TRUE,
				'message' => 'OK',
				'data' => $data
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	public function upload_inspection_images2_post() {
		$this->response([
			'status' => TRUE,
			'message' => 'OK'
		], REST_Controller::HTTP_OK);
//		$basePath = $this->rootDir . $this->appDir . $this->uploadsInspectionImagesDir;
//		if(!is_dir($uploadsDir)) {
//			mkdir($uploadsDir, 0777, true);
//		}
//		try {
//			if (is_uploaded_file($_FILES['image']['tmp_name'])) {
//				$photoPath = $basePath.'/photo1.png';
//
//				if (move_uploaded_file($_FILES['image']['tmp_name'], $photoPath)) {
//					echo 'moved';
//				}
//			}
//		} catch(Exception $ex){
//			echo "ERROR:".$ex->GetMessage()."\n";
//			exit(1);
//		}
//		exit();
	}

	/**
	 * Create inspection ratings
	 * POST /api/upload_inspection_images?api_key=2b3vCKJO901LmncHfUREw8bxzsi3293101kLMNDhf HTTP/1.1
	 *
	 * @see https://stackoverflow.com/questions/5483851/manually-parse-raw-multipart-form-data-data-with-php
	 */
	public function upload_inspection_images_post() {
		$apiKey = $_REQUEST['api_key'];
		$message = "";

		$postBody = file_get_contents('php://input');

		// Match the boundary name by taking the first line with content
//		preg_match('/^(?<boundary>.+)$/m', $postBody, $matches);
//
//		// Explode the response using the previously match boundary
//		$parts = explode($matches['boundary'], $postBody);
//
//		// Create empty array to store our parsed values
//		$form_data = array();
//
//		foreach ($parts as $part)
//		{
//			// Now we need to parse the multi-part content. First match the 'name=' parameter,
//			// then skip the double new-lines, match the body and ignore the terminating new-line.
//			// Using 's' flag enables .'s to match new lines.
//			$matched = preg_match('/name="?(?<key>\w+).*?\n\n(?<value>.*?)\n$/s', $part, $matches);
//
//			// Did we get a match? Place it in our form values array
//			if ($matched)
//			{
//				$form_data[$matches['key']] = $matches['value'];
//			}
//		}
//
//		$uploadsDir = $this->rootDir . $this->appDir . $this->uploadsInspectionImagesDir;
//
////		Decode to image
////		$image = base64_decode($form_data['PICHA']);
//		if(file_put_contents("$uploadsDir/" . rand(10,5948) . ".png", $form_data['PICHA'])) {
//			$copied = true;
//		}

		$filepath = $this->rootDir . $this->appDir .
			$this->uploadsInspectionImagesDir . "/" .
			$_POST['inspectionId'];

		if (!file_exists($filepath)) {
			mkdir($filepath, 0777, true);
		}

		$filename = $filepath . "/" .
			$_FILES['upload']['name'];

		if (!is_uploaded_file($_FILES['upload']['tmp_name']) or
			!copy($_FILES['upload']['tmp_name'], $filename)) {
			$message = "Could not save file as $filename!";
		} else {
			$copied = true;
			$message = "Uploaded image successfully!";
		}

		if($apiKey==API_KEY && $copied) {
			$this->load->model('Inspectionimage_model');
			$this->Inspectionimage_model->importInspectionimage($_POST);

			$this->response([
				'status' => TRUE,
				'message' => $message
			], REST_Controller::HTTP_OK);
		} else if ($apiKey==API_KEY && !$copied) {
			$this->response([
				'status' => FALSE,
				'message' => $message,
				'data' => [ 'files' => $_FILES, 'post' => $_POST ]
			], REST_Controller::HTTP_EXPECTATION_FAILED);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Invalid credentials. Please try again.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Remove slashes from strings, arrays and objects
	 *
	 * @param    mixed   input data
	 * @return   mixed   cleaned input data
	 */
	private function stripslashesFull($input)
	{
		if (is_array($input)) {
			$input = array_map('stripslashesFull', $input);
		} elseif (is_object($input)) {
			$vars = get_object_vars($input);
			foreach ($vars as $k=>$v) {
				$input->{$k} = stripslashesFull($v);
			}
		} else {
			$input = stripslashes($input);
		}
		return $input;
	}

}
