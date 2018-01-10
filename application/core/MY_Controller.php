<?php

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');
        
        switch($_SERVER['SERVER_NAME']) {
            case '10.132.146.48':
                $this->appDir = '/maintlog';
                break;
            
            case 'test.rinconmountaintech.com':
            default:
                $this->appDir = '/sites/komatsuna';
                break;
        }
        
        if(!array_key_exists('username', $_SESSION) || !array_key_exists('role', $_SESSION)) {
            redirect('/auth/index', 'refresh');
        }
    }
}