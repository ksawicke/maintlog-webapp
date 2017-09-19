<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authorization class.
 */
class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
        
        $this->appDir = ($_SERVER['HTTP_HOST']=='test.rinconmountaintech.com' ? '/sites/komatsuna' : '/project');
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
//        exit();
        
//        if(isset($_SESSION['message_danger'])) {
//        echo '<pre>';
//            var_dump($_SESSION);
//            exit();
//        }
        
//        $this->User_model->wipe();
//        $this->User_model->create();
        
//        $data['contacts'] = $this->Contact_model->findAll();
        
//        $data['navigationTop'] = $this->load->view('templates/adminlte/authenticated/navigation_top', $data, true);
//        $data['navigationSidebar'] = $this->load->view('templates/adminlte/authenticated/navigation_sidebar', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/public/auth/login', $data, true);
                
        $this->template->load('public_auth', null, $data);
    }
    
    /**
     * Check credentials passed from login form.
     */
    public function check() {
        $found = $this->User_model->findCountByUsername($this->input->post('username'));
        $authObject = $this->User_model->getAuthObject($this->input->post('username'), $this->input->post('pin'));
        
        if($authObject->authenticated) {
            $this->createUserSession($authObject->user);
            
            switch($authObject->user->role) {
            case 'admin':
                $redirectTo = '/projects/index';
                break;
            
            case 'developer':
                $redirectTo = '/projects/index'; /* TODO: CHANGE TO PROJECTS */
                break;
            }
            
            $this->session->set_flashdata('alert_success', 'You have logged in successfully.');
            redirect($redirectTo, 'refresh');
        }
//        die("dsalfihadlads");
        
        $this->session->set_flashdata('alert_danger', 'Username and/or password incorrect. Please try again.');
        redirect('/auth/index', 'refresh');
    }
    
    public function logout() {
        $this->destroyUserSession();
        
        redirect('/auth/index', 'refresh');
    }
    
    /**
     * Creates a session for an authenticated user.
     * 
     * @param type $username
     */
    private function createUserSession($userObject) {
        $sessionData = array(
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
