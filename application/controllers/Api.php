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
		$this->load->model('User_model');

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
	 */
	public function check_login_post() {
		$pin = $this->input->post('pin');

		$authObject = $this->User_model->getAuthObject($pin);

		if($authObject->authenticated) {
			$userObject = $authObject->user;
			$userData =  [
				'user_id' => $userObject->id,
				'username' => $userObject->username,
				'first_name' => $userObject->first_name,
				'last_name' => $userObject->last_name,
				'email_address' => $userObject->email_address,
				'role' => $userObject->role,
				'logged_in' => TRUE
			];

			http_response_code(200);
			echo json_encode(['status' => true, 'userData' => $userData]);
		} else {
			http_response_code(404);
			echo json_encode(['status' => false]);
		}

		exit();
	}

}
