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
* @version  $Revision: Tag v2.0.0-alpha2 $
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
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    /**
     * Enter a service log
     */
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
    
    /**
     * View users
     */
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
        
        $data['users'] = (object) $this->User_model->findAll();
        
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/users/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
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
    
    /**
     * View manufacturers
     */
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
    
    /**
     * View equipment units
     */
    public function equipmentunit()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmentunit_model');
        
        $data['equipmentunits'] = $this->Equipmentunit_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentUnits/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
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
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Manufacturer_model');
        $this->load->model('Equipmentunit_model');
        $this->load->model('Equipmentmodel_model');
        $this->load->model('Equipmenttype_model');
        $this->load->model('User_model');
        
        $data['manufacturers'] = $this->Manufacturer_model->findAll();
        $data['equipmentmodels'] = $this->Equipmentmodel_model->findAll();
        $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
        $data['users'] = $this->User_model->findAll();
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
        $data['unit_active'] = (!empty($equipmentunit) ? $equipmentunit->active : '');
        
        $personResponsibleThisUnit = explode("|", $data['equipment_person_responsible']);
        
        foreach($data['users'] as $key => $personData) {
            if(in_array($personData['id'], $personResponsibleThisUnit)) {
                $data['users'][$key]['person_responsible'] = "1";
            } else {
                $data['users'][$key]['person_responsible'] = "0";
            }
        }
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentUnits/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    /**
     * View equipment models
     */
    public function equipmentmodel()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Equipmentmodel_model');
        
        $data['equipmentmodel'] = $this->Equipmentmodel_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentmodel/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
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
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
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
        $data['equipment_unit_number'] = (!empty($equipmentmodel) ? $equipment->unit_number : '');
        $data['equipment_manufacturer_id'] = (!empty($equipmentmodel) ? $equipment->manufacturer_id : '');
        $data['equipment_model_number'] = (!empty($equipmentmodel) ? $equipment->model_number : '');
        $data['equipment_equipmenttype_id'] = (!empty($equipmentmodel) ? $equipment->equipmenttype_id : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/equipmentmodel/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    /**
     * View equipment types
     */
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
    
    /**
     * View fluid type choices
     */
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
    
    /**
     * View component type choices
     */
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
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Component_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $component = (!is_null($component_id) ? $this->Component_model->findOne($component_id) : []);
        $data['component_id'] = (!is_null($component_id) ? $component_id : 0);
        $data['component_component'] = (!empty($component) ? $component->component : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/components/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    /**
     * View component choices
     */
    public function components()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Component_model');
        
        $data['components'] = $this->Component_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/components/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
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
    
    /**
     * View SMR choices
     */
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
    
    /**
     * View mileage choices
     */
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
    
    /**
     * View time choices
     */
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
    
    /**
     * View reminder recipients
     */
    public function reminderRecipients()
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Reminderrecipient_model');
        
        $data['reminderrecipients'] = $this->Reminderrecipient_model->findAll();
        $data['flashdata'] = $this->session->flashdata();
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reminderRecipients/index', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
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
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        $this->load->model('Reminderrecipient_model');
        
        $data['flashdata'] = $this->session->flashdata();
        $reminderrecipient = (!is_null($reminderrecipient_id) ? $this->Reminderrecipient_model->findOne($reminderrecipient_id) : []);
        $data['reminderrecipient_id'] = (!is_null($reminderrecipient_id) ? $reminderrecipient_id : 0);
        $data['reminderrecipient_reminder_recipient'] = (!empty($reminderrecipient) ? $reminderrecipient->reminder_recipient : '');
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reminderRecipients/add', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    /**
     * View app settings
     */
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
        $data['additional_email_reminder_recipient'] = $appsetting->additional_email_reminder_recipient;
        
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/appsettings/edit', $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
    
    /**
     * View reporting screen
     * 
     * @param string $report_type
     * @param type $id
     */
    public function reporting($report_type = 'index', $id = 0)
    {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $this->load->model('Report_model');
        
        switch($report_type) {
            case 'service_logs':
                $this->load->model('Fluidtype_model');
                $data['service_logs'] = $this->Report_model->findServiceLogs();
                $fluid_types_tmp = $this->Fluidtype_model->findAll();
                $fluid_types = [];
                foreach($fluid_types_tmp as $fluid_type_tmp) {
                    $val = $fluid_type_tmp['fluid_type'];
                    $fluid_types[$val] = $val;
                }
                $data['fluid_types'] = json_encode($fluid_types);
                break;
            
            case 'service_log_edit':
                $this->load->model('User_model');
                $this->load->model('Equipmenttype_model');
                $this->load->model('Fluidtype_model');
                $this->load->model('Componenttype_model');
                $this->load->model('Component_model');
                $this->load->model('Smrchoice_model');
                $this->load->model('Timechoice_model');
                $this->load->model('Mileagechoice_model');
        
                $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
                $data['fluidtypes'] = $this->Fluidtype_model->findAll();
                $data['componenttypes'] = $this->Componenttype_model->findAll();
                $data['components'] = $this->Component_model->findAll();
                $data['users'] = (object) $this->User_model->findAll();
                $data['smrchoices'] = $this->Smrchoice_model->findAll();
                $data['timechoices'] = $this->Timechoice_model->findAll();
                $data['mileagechoices'] = $this->Mileagechoice_model->findAll();
                $data['service_log'] = $this->Report_model->findServiceLogs($id);
                break;    
              
            case 'service_log_detail_ajax':
                $this->load->model('User_model');
                $this->load->model('Equipmenttype_model');
                $this->load->model('Fluidtype_model');
                $this->load->model('Componenttype_model');
                $this->load->model('Component_model');
                $this->load->model('Smrchoice_model');
                $this->load->model('Timechoice_model');
                $this->load->model('Mileagechoice_model');
        
                $data['id'] = $id;
                $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
                $data['fluidtypes'] = $this->Fluidtype_model->findAll();
                $data['componenttypes'] = $this->Componenttype_model->findAll();
                $data['components'] = $this->Component_model->findAll();
                $data['users'] = (object) $this->User_model->findAll();
                $data['smrchoices'] = $this->Smrchoice_model->findAll();
                $data['timechoices'] = $this->Timechoice_model->findAll();
                $data['mileagechoices'] = $this->Mileagechoice_model->findAll();
                $data['service_log'] = $this->Report_model->findServiceLogs($id);
                
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($data));
                break;
            
            case 'service_log_detail':
                $data['service_log'] = $this->Report_model->findServiceLogs($id);
                break;
            
            case 'pmservice_reminders':
                $data['pmservice_reminders'] = $this->Report_model->findPMServiceEmailReminders();
                break;
            
            case 'maintenance_log_reminders':
            default:
                $report_type = 'maintenance_log_reminders';
                $data['maintenance_log_reminders'] = $this->Report_model->findMaintenanceLogReminders();
                break;
        }
        
        $data['report_type'] = $report_type;
        $data['reports_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/reports_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/' . $report_type, $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
}