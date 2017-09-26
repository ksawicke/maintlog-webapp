<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

    function __construct() {
        parent::__construct();
        
//        $this->load->helper('url');
//        $this->load->library('session');
        
//        $this->load->model('Project_model');
//        $this->load->model('Client_model');
//        $this->load->model('Website_model');
        
//        $this->appDir = ($_SERVER['HTTP_HOST']=='projects.rinconmountaintech.com' ? '' : '/project');
//        
//        if(!array_key_exists('username', $_SESSION) || !array_key_exists('role', $_SESSION)) {
//            redirect('/auth/index', 'refresh');
//        }
    }
    
    /**
     * Display app menu
     */
    public function index()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function log_entry()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/log_entry', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function employees()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/employees', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function users()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/users', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function equipment()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipment', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function equipmentTypes()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentTypes', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function reporting()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
}