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
* @version  $Revision: Tag v2.2.1 $
* @access   public
*/
class App extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    /**
     * Display app menu
     */
    public function index()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Enter a service log
     */
    public function log_entry()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmenttype_model');
        $this->load->model('Fluidtype_model');
        
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['fluidtypes'] = $this->Fluidtype_model->findAll();
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/log_entry', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View users
     */
    public function users()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('User_model');
        
        $data['users'] = (object) $this->User_model->findAll();
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/users/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add user to access the system
     * 
     * @param type $user_id
     */
    public function addUser($user_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
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
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View manufacturers
     */
    public function manufacturers()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Manufacturer_model');
        
        $data['manufacturers'] = $this->Manufacturer_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'manufacturers';
        $data['equipment_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/equipment_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/manufacturers/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add a manufacturer
     * 
     * @param type $manufacturer_id
     */
    public function addManufacturer($manufacturer_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
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
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View equipment units
     */
    public function equipmentunit()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmentunit_model');
        
        $data['equipmentunits'] = $this->Equipmentunit_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'equipmentunit';
        $data['equipment_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/equipment_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentUnits/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add an equipment unit
     * 
     * @param type $equipmentunit_id
     */
    public function addEquipmentunit($equipmentunit_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Manufacturer_model');
        $this->load->model('Equipmentunit_model');
        $this->load->model('Equipmentmodel_model');
        $this->load->model('Equipmenttype_model');
        $this->load->model('Fluidtype_model');
        $this->load->model('User_model');
        
        $data['manufacturers'] = $this->Manufacturer_model->findAll();
        $data['equipmentmodels'] = $this->Equipmentmodel_model->findAll();
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['users'] = $this->User_model->findAll();
        $data['fluidtypes'] = $this->Fluidtype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $equipmentunit = (!is_null($equipmentunit_id) ? $this->Equipmentunit_model->findOne($equipmentunit_id) : []);
        $data['equipmentunit_id'] = (!is_null($equipmentunit_id) ? $equipmentunit_id : 0);
        $data['equipment_unit_number'] = (!empty($equipmentunit) ? $equipmentunit->unit_number : '');
        $data['equipment_manufacturer_id'] = (!empty($equipmentunit) ? $equipmentunit->manufacturer_id : '');
        $data['equipment_model_id'] = (!empty($equipmentunit) ? $equipmentunit->model_number : '');
        $data['equipment_equipmentmodel_id'] = (!empty($equipmentunit) ? $equipmentunit->equipmentmodel_id : '');
        $data['equipment_equipmenttype_id'] = (!empty($equipmentunit) ? $equipmentunit->equipment_type_id : '');
        $data['equipment_track_type'] = (!empty($equipmentunit) ? $equipmentunit->track_type : '');
        $data['equipment_person_responsible'] = (!empty($equipmentunit) ? $equipmentunit->person_responsible : '');
        $data['equipment_fluids_tracked'] = (!empty($equipmentunit) ? $equipmentunit->fluids_tracked : '');
        $data['unit_active'] = (!empty($equipmentunit) ? $equipmentunit->active : 1);
        
        $personResponsibleThisUnit = explode("|", $data['equipment_person_responsible']);
        $fluidsTrackedThisUnit = explode("|", $data['equipment_fluids_tracked']);
        
        foreach($data['users'] as $key => $personData) {
            if(in_array($personData['id'], $personResponsibleThisUnit)) {
                $data['users'][$key]['person_responsible'] = "1";
            } else {
                $data['users'][$key]['person_responsible'] = "0";
            }
        }
        
        foreach($data['fluidtypes'] as $key => $fluidData) {
            if(in_array($fluidData['id'], $fluidsTrackedThisUnit)) {
                $data['fluidtypes'][$key]['fluids_tracked'] = "1";
            } else {
                $data['fluidtypes'][$key]['fluids_tracked'] = "0";
            }
        }
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentUnits/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View equipment models
     */
    public function equipmentmodel()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmentmodel_model');
        
        $data['equipmentmodel'] = $this->Equipmentmodel_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'equipmentmodel';
        $data['equipment_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/equipment_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentmodel/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }

    /**
     * Add an equipment model
     * 
     * @param type $equipment_id
     */
    public function addEquipmentmodel($equipment_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Manufacturer_model');
        $this->load->model('Equipmentmodel_model');
        $this->load->model('Equipmenttype_model');
        
        $data['manufacturers'] = $this->Manufacturer_model->findAll();
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $equipmentmodel = (!is_null($equipment_id) ? $this->Equipmentmodel_model->findOne($equipment_id) : []);
        $data['equipment_id'] = (!is_null($equipment_id) ? $equipment_id : 0);
        $data['equipment_unit_number'] = (!empty($equipmentmodel) ? $equipmentmodel->unit_number : '');
        $data['equipment_manufacturer_id'] = (!empty($equipmentmodel) ? $equipmentmodel->manufacturer_id : '');
        $data['equipment_model_number'] = (!empty($equipmentmodel) ? $equipmentmodel->model_number : '');
        $data['equipment_equipmenttype_id'] = (!empty($equipmentmodel) ? $equipmentmodel->equipmenttype_id : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentmodel/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View equipment types
     */
    public function equipmentTypes()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmenttype_model');
        
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'equipmentTypes';
        $data['equipment_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/equipment_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentTypes/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add an equipment type
     * 
     * @param type $equipmenttype_id
     */
    public function addEquipmentType($equipmenttype_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmenttype_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $equipmenttype = (!is_null($equipmenttype_id) ? $this->Equipmenttype_model->findOne($equipmenttype_id) : []);
        $data['equipmenttype_id'] = (!is_null($equipmenttype_id) ? $equipmenttype_id : 0);
        $data['equipmenttype_equipment_type'] = (!empty($equipmenttype) ? $equipmenttype->equipment_type : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentTypes/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View fluid type choices
     */
    public function fluidTypes()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Fluidtype_model');
        
        $data['fluidtypes'] = $this->Fluidtype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
                
        $data['navigation_highlight'] = 'fluidTypes';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/fluidTypes/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add fluid type choice
     * 
     * @param type $fluidtype_id
     */
    public function addFluidType($fluidtype_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Fluidtype_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $fluidtype = (!is_null($fluidtype_id) ? $this->Fluidtype_model->findOne($fluidtype_id) : []);
        $data['fluidtype_id'] = (!is_null($fluidtype_id) ? $fluidtype_id : 0);
        $data['fluidtype_fluid_type'] = (!empty($fluidtype) ? $fluidtype->fluid_type : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/fluidTypes/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View component type choices
     */
    public function componentTypes()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Componenttype_model');
        
        $data['componenttypes'] = $this->Componenttype_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'componentTypes';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/componentTypes/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add component choice
     * 
     * @param type $component_id
     */
    public function addComponent($component_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Component_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $component = (!is_null($component_id) ? $this->Component_model->findOne($component_id) : []);
        $data['component_id'] = (!is_null($component_id) ? $component_id : 0);
        $data['component_component'] = (!empty($component) ? $component->component : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/components/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View component choices
     */
    public function components()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Component_model');
        
        $data['components'] = $this->Component_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'components';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/components/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add a component type choice
     * 
     * @param type $componenttype_id
     */
    public function addComponentType($componenttype_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Componenttype_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $componenttype = (!is_null($componenttype_id) ? $this->Componenttype_model->findOne($componenttype_id) : []);
        $data['componenttype_id'] = (!is_null($componenttype_id) ? $componenttype_id : 0);
        $data['componenttype_component_type'] = (!empty($componenttype) ? $componenttype->component_type : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/componentTypes/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View SMR choices
     */
    public function smrChoices()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Smrchoice_model');
        
        $data['smrchoices'] = $this->Smrchoice_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'smrChoices';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/smrChoices/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add an SMR choice
     * 
     * @param type $smrchoice_id
     */
    public function addSmrChoice($smrchoice_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Smrchoice_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $smrchoice = (!is_null($smrchoice_id) ? $this->Smrchoice_model->findOne($smrchoice_id) : []);
        $data['smrchoice_id'] = (!is_null($smrchoice_id) ? $smrchoice_id : 0);
        $data['smrchoice_smr_choice'] = (!empty($smrchoice) ? $smrchoice->smr_choice : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/smrChoices/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View mileage choices
     */
    public function mileageChoices()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Mileagechoice_model');
        
        $data['mileagechoices'] = $this->Mileagechoice_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'mileageChoices';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/mileageChoices/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add a mileage choice
     * 
     * @param type $mileagechoice_id
     */
    public function addMileageChoice($mileagechoice_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Mileagechoice_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $mileagechoice = (!is_null($mileagechoice_id) ? $this->Mileagechoice_model->findOne($mileagechoice_id) : []);
        $data['mileagechoice_id'] = (!is_null($mileagechoice_id) ? $mileagechoice_id : 0);
        $data['mileagechoice_mileage_choice'] = (!empty($mileagechoice) ? $mileagechoice->mileage_choice : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/mileageChoices/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View time choices
     */
    public function timeChoices()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Timechoice_model');
        
        $data['timechoices'] = $this->Timechoice_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['navigation_highlight'] = 'timeChoices';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/timeChoices/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add a time choice
     * 
     * @param type $timechoice_id
     */
    public function addTimeChoice($timechoice_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Timechoice_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $timechoice = (!is_null($timechoice_id) ? $this->Timechoice_model->findOne($timechoice_id) : []);
        $data['timechoice_id'] = (!is_null($timechoice_id) ? $timechoice_id : 0);
        $data['timechoice_time_choice'] = (!empty($timechoice) ? $timechoice->time_choice : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/timeChoices/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View reminder recipients
     */
    public function reminderRecipients()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Reminderrecipient_model');
        
        $data['reminderrecipients'] = $this->Reminderrecipient_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reminderRecipients/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * Add reminder recipient
     * 
     * @param type $reminderrecipient_id
     */
    public function addReminderRecipient($reminderrecipient_id = null)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Reminderrecipient_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $reminderrecipient = (!is_null($reminderrecipient_id) ? $this->Reminderrecipient_model->findOne($reminderrecipient_id) : []);
        $data['reminderrecipient_id'] = (!is_null($reminderrecipient_id) ? $reminderrecipient_id : 0);
        $data['reminderrecipient_reminder_recipient'] = (!empty($reminderrecipient) ? $reminderrecipient->reminder_recipient : '');
        
        $data['navigation_highlight'] = 'addReminderRecipient';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reminderRecipients/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }

	public function checklists() {
		$data = [
			'applicationName' => 'Komatsu NA Maintenance Log',
			'title' => 'Komatsu NA Maintenance Log',
			'assetDirectory' => $this->appDir . '/assets/',
			'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/'
		];

		$this->load->library('template');
		$this->load->model('Checklist_model');

		$data['checklists'] = $this->Checklist_model->findAll();
		$data['flashdata'] = $this->session->flashdata();
		$data['navigation_highlight'] = 'checklists';
		$data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
		$data['body'] = $this->load->view('templates/bootstrap/authenticated/app/checklists/index', $data, true);

		$this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
	}

	public function addChecklist($checklistId = null) {
		$data = [
			'applicationName' => 'Komatsu NA Maintenance Log',
			'title' => 'Komatsu NA Maintenance Log',
			'assetDirectory' => $this->appDir . '/assets/',
			'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/'
		];

		$this->load->library('template');
		$this->load->model('Checklist_model');
		$this->load->model('Equipmenttype_model');

		$checklist = (!is_null($checklistId) ? $this->Checklist_model->findOne($checklistId) : []);
		$data['checklist_id'] = (!is_null($checklistId) ? $checklistId : 0);
		$data['checklist_category_id'] = (!is_null($checklistId) ? $checklist->checklistcategory_id : '');
		$data['checklist_equipmenttype_id'] = (!is_null($checklistId) ? $checklist->equipmenttype_id : '');
		$data['equipmenttypes'] = $this->Equipmenttype_model->findAllWithoutChecklistDefined($data['checklist_equipmenttype_id']);
		$data['checklist_json'] = '{"preStartData":[],"postStartData":[]}';
		$data['flashdata'] = $this->session->flashdata();
		$data['body'] = $this->load->view('templates/bootstrap/authenticated/app/checklists/add', $data, true);

		$this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
	}
    
    public function checklistCategories() {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Checklistcategory_model');
        
        $data['checklistcategories'] = $this->Checklistcategory_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        $data['navigation_highlight'] = 'checklistCategories';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/checklistCategories/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    public function addChecklistCategory($checklistCategoryId = null) {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Checklistcategory_model');
        
        $checklistcategory = (!is_null($checklistCategoryId) ? $this->Checklistcategory_model->findOne($checklistCategoryId) : []);
        $data['checklistcategory_id'] = (!is_null($checklistCategoryId) ? $checklistCategoryId : 0);
        $data['checklistcategory_category'] = (!is_null($checklistCategoryId) ? $checklistcategory->category : '');
        
        $data['flashdata'] = $this->session->flashdata();
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/checklistCategories/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    public function checklistItems() {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Checklistitem_model');
        
        $data['checklistitems'] = $this->Checklistitem_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        $data['navigation_highlight'] = 'checklistItems';
        $data['appsetting_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/appsetting_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/checklistItems/index', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    public function addChecklistItem($checklistItemId = null) {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Checklistcategory_model');
        $this->load->model('Checklistitem_model');
        
        $checklistitem = (!is_null($checklistItemId) ? $this->Checklistitem_model->findOne($checklistItemId) : []);
        $data['checklistitem_item'] = (!empty($checklistitem) ? $checklistitem->item : '');
        $data['checklistitem_id'] = (!empty($checklistitem) ? $checklistitem->id : '');
        
        $data['flashdata'] = $this->session->flashdata();
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/checklistItems/add', $data, true);
                
        $this->template->load('authenticated_default_bootstrap-4.0.0', null, $data);
    }
    
    /**
     * View reporting screen
     * 
     * @param string $report_type
     * @param type $id
     */
    public function reporting($report_type = 'index', $id = 0)
    {
        switch($report_type) {
            case 'service_logs':
                redirect('/reporting/screen/service_logs');
                break;
            
            case 'service_log_edit':
                redirect('/reporting/screen/edit_service_log/' . $id);
                break;    
              
            case 'service_log_detail_ajax':
                redirect('/reporting/ajax/service_log_detail');
                break;
            
            case 'service_log_detail':
                redirect('/reporting/screen/service_log_detail/' . $id);
                break;
            
            case 'pmservice_reminders':
                redirect('/reporting/screen/pmservice_reminders');
                break;
            
            case 'maintenance_log_reminders':
            default:
                redirect('/reporting/screen/maintenance_log_reminders');
                break;
        }
    }
}
