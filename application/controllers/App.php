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
        $this->load->model('Equipmenttype_model');
        $this->load->model('Fluidtype_model');
        
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['fluidtypes'] = $this->Fluidtype_model->findAll();
        
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
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/employees/index', $data, true);
                
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
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/users/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function manufacturers()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Manufacturer_model');
        
        $data['manufacturers'] = $this->Manufacturer_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/manufacturers/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addManufacturer($manufacturer_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];
        
        $this->load->library('template');
        $this->load->model('Manufacturer_model');
        
        $data['manufacturers'] = $this->Manufacturer_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $manufacturer = (!is_null($manufacturer_id) ? $this->Manufacturer_model->findOne($manufacturer_id) : []);
        $data['manufacturer_id'] = (!is_null($manufacturer_id) ? $manufacturer_id : 0);
        $data['manufacturer_manufacturer_name'] = (!empty($manufacturer) ? $manufacturer->manufacturer_name : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/manufacturers/add', $data, true);
                
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
        $this->load->model('Equipment_model');
        
        $data['equipment'] = $this->Equipment_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipment/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addEquipment($equipment_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Manufacturer_model');
        $this->load->model('Equipment_model');
        $this->load->model('Equipmenttype_model');
        
        $data['manufacturers'] = $this->Manufacturer_model->findAll();
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $equipment = (!is_null($equipment_id) ? $this->Equipment_model->findOne($equipment_id) : []);
        $data['equipment_id'] = (!is_null($equipment_id) ? $equipment_id : 0);
        $data['equipment_unit_number'] = (!empty($equipment) ? $equipment->unit_number : '');
        $data['equipment_manufacturer_id'] = (!empty($equipment) ? $equipment->manufacturer_id : '');
        $data['equipment_model_number'] = (!empty($equipment) ? $equipment->model_number : '');
        $data['equipment_equipmenttype_id'] = (!empty($equipment) ? $equipment->equipmenttype_id : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipment/add', $data, true);
                
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
        $this->load->model('Equipmenttype_model');
        
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentTypes/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addEquipmentType($equipmenttype_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmenttype_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $equipmenttype = (!is_null($equipmenttype_id) ? $this->Equipmenttype_model->findOne($equipmenttype_id) : []);
        $data['equipmenttype_id'] = (!is_null($equipmenttype_id) ? $equipmenttype_id : 0);
        $data['equipmenttype_equipment_type'] = (!empty($equipmenttype) ? $equipmenttype->equipment_type : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentTypes/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function fluidTypes()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Fluidtype_model');
        
        $data['fluidtypes'] = $this->Fluidtype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
                
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/fluidTypes/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addFluidType($fluidtype_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Fluidtype_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $fluidtype = (!is_null($fluidtype_id) ? $this->Fluidtype_model->findOne($fluidtype_id) : []);
        $data['fluidtype_id'] = (!is_null($fluidtype_id) ? $fluidtype_id : 0);
        $data['fluidtype_fluid_type'] = (!empty($fluidtype) ? $fluidtype->fluid_type : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/fluidTypes/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function pmTypeChoices()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/pmTypeChoices/index', $data, true);
                
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
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
}