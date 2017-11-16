<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* App is a Controller handling generic app interactions
*
* App handles routes that are more generic in focus.
*
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
*/
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
//        $this->load->model('Appsetting_model');
        
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['fluidtypes'] = $this->Fluidtype_model->findAll();
//        $appsetting = $this->Appsetting_model->findOne(15000);
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/log_entry', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function log_entry2()
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
//        $this->load->model('Appsetting_model');
        
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['fluidtypes'] = $this->Fluidtype_model->findAll();
//        $appsetting = $this->Appsetting_model->findOne(15000);
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/log_entry2', $data, true);
                
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
        $this->load->model('User_model');
        
        $data['users'] = $this->User_model->findAll();
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/users/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addUser($user_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];
        
        $this->load->library('template');
        $this->load->model('User_model');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $user = (!is_null($user_id) ? $this->User_model->findOne($user_id) : []);
        $data['user_id'] = (!is_null($user_id) ? $user_id : 0);
        $data['user_first_name'] = (!empty($user) ? $user->first_name : '');
        $data['user_last_name'] = (!empty($user) ? $user->last_name : '');
        $data['user_email_address'] = (!empty($user) ? $user->email_address : '');
        $data['user_role'] = (!empty($user) ? $user->role : '');
        $data['user_active'] = (!empty($user) ? $user->active : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/users/add', $data, true);
                
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
    
    public function componentTypes()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Componenttype_model');
        
        $data['componenttypes'] = $this->Componenttype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/componentTypes/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addComponentType($componenttype_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Componenttype_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $componenttype = (!is_null($componenttype_id) ? $this->Componenttype_model->findOne($componenttype_id) : []);
        $data['componenttype_id'] = (!is_null($componenttype_id) ? $componenttype_id : 0);
        $data['componenttype_component_type'] = (!empty($componenttype) ? $componenttype->component_type : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/componentTypes/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function smrChoices()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Smrchoice_model');
        
        $data['smrchoices'] = $this->Smrchoice_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/smrChoices/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addSmrChoice($smrchoice_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Smrchoice_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $smrchoice = (!is_null($smrchoice_id) ? $this->Smrchoice_model->findOne($smrchoice_id) : []);
        $data['smrchoice_id'] = (!is_null($smrchoice_id) ? $smrchoice_id : 0);
        $data['smrchoice_smr_choice'] = (!empty($smrchoice) ? $smrchoice->smr_choice : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/smrChoices/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function mileageChoices()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Mileagechoice_model');
        
        $data['mileagechoices'] = $this->Mileagechoice_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/mileageChoices/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addMileageChoice($mileagechoice_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Mileagechoice_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $mileagechoice = (!is_null($mileagechoice_id) ? $this->Mileagechoice_model->findOne($mileagechoice_id) : []);
        $data['mileagechoice_id'] = (!is_null($mileagechoice_id) ? $mileagechoice_id : 0);
        $data['mileagechoice_mileage_choice'] = (!empty($mileagechoice) ? $mileagechoice->mileage_choice : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/mileageChoices/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function timeChoices()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Timechoice_model');
        
        $data['timechoices'] = $this->Timechoice_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/timeChoices/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function addTimeChoice($timechoice_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Timechoice_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $timechoice = (!is_null($timechoice_id) ? $this->Timechoice_model->findOne($timechoice_id) : []);
        $data['timechoice_id'] = (!is_null($timechoice_id) ? $timechoice_id : 0);
        $data['timechoice_time_choice'] = (!empty($timechoice) ? $timechoice->time_choice : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/timeChoices/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    public function appSettings()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Appsetting_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $appsetting = $this->Appsetting_model->findOne(15000);
        
        $data['smr_based_choices'] = $appsetting->smr_based_choices;
        $data['mileage_based_choices'] = $appsetting->mileage_based_choices;
        $data['time_based_choices'] = $appsetting->time_based_choices;
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/appsettings/edit', $data, true);
                
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