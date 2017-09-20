<?php

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');
        
        $this->appDir = ($_SERVER['HTTP_HOST']=='test.rinconmountaintech.com' ? '/sites/komatsuna' : '/project');
        
        if(!array_key_exists('username', $_SESSION) || !array_key_exists('role', $_SESSION)) {
            redirect('/auth/index', 'refresh');
        }
    }
}