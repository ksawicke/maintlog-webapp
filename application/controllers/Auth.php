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
* @version  $Revision: tag v2.3.2 $
* @access   public
*/
class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
        
        switch($_SERVER['SERVER_NAME']) {
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
     * Present the login form.
     */
    public function index() {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();

        $data['body'] = $this->load->view('templates/bootstrap/public/auth/login', $data, true);
                
        $this->template->load('public_auth', null, $data);
    }
    
    /**
     * Check credentials passed from login form.
     */
    public function check() {
        $authObject = $this->User_model->getAuthObject($this->input->post('pin'));
        
        if($authObject->authenticated) {
            $this->createUserSession($authObject->user);
            
//            switch($authObject->user->role) {
//                case 'admin':
                    $redirectTo = '/app/index';
//                    break;
//
//                case 'developer':
//                    $redirectTo = '/auth/index';
//                    break;
//            }
            
            $this->session->set_flashdata('alert_success', 'You have logged in successfully.');
            redirect($redirectTo, 'refresh');
        }
        
        $this->session->set_flashdata('alert_danger', 'Invalid PIN. Please try again.');
        redirect('/auth/index', 'refresh');
    }
    
    public function logout() {
        $this->destroyUserSession();
        
        $this->session->set_flashdata('alert_success', 'You have been logged out.');
        redirect('/auth/index', 'refresh');
    }
    
    /**
     * Creates a session for an authenticated user.
     * 
     * @param type $username
     */
    private function createUserSession($userObject) {
        $sessionData = array(
            'user_id' => $userObject->id,
            'username' => $userObject->username,
            'first_name' => $userObject->first_name,
            'last_name' => $userObject->last_name,
            'email_address' => $userObject->email_address,
            'role' => $userObject->role,
            'logged_in' => TRUE
        );

        $this->session->set_userdata($sessionData);
    }
    
    /**
     * Destroys a session for an authenticated user.
     */
    private function destroyUserSession() {
        unset(
            $_SESSION['user_id'],
            $_SESSION['username'],
            $_SESSION['first_name'],
            $_SESSION['username'],
            $_SESSION['last_name'],
            $_SESSION['email_address'],
            $_SESSION['role'],
            $_SESSION['logged_in'],
            $_SESSION['__ci_last_regenerate']
        );
    }
}
