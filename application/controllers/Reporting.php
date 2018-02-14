<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
class Reporting extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    protected function initScreenReport() {
        $data = [
            'applicationName' => 'Komatsu NA Maintenance Log',
            'title' => 'Komatsu NA Maintenance Log',
            'assetDirectory' => $this->appDir . '/assets/templates/bootstrap/',
            'assetDirectoryCustom' => $this->appDir . '/assets/templates/komatsuna/' 
        ];

        $this->load->library('template');
        
        $data['flashdata'] = $this->session->flashdata();
        
        $this->load->model('Report_model');
        
        return $data;
    }
    
    protected function outputScreenReport($report_type, $data = []) {        
        $data['report_type'] = $report_type;
        $data['reports_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/reports_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/' . $report_type, $data, true);
        
        $this->template->load('authenticated_default', null, $data);
    }
    
    protected function initSpreadsheetReport() {
        $helper = new Sample();
        if ($helper->isCli()) {
            $helper->log('This example should only be run from a Web Browser' . PHP_EOL);

            return;
        }
    }
    
    protected function outputSpreadsheetReport($spreadsheet) {
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
    
    protected function outputAjaxReport($data) {
        return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
    }
    
    protected function getServiceLogsData() {
        $this->load->model('Fluidtype_model');
        $data['service_logs'] = $this->Report_model->findServiceLogs();
        $fluid_types_tmp = $this->Fluidtype_model->findAll();
        $fluid_types = [];
        foreach($fluid_types_tmp as $fluid_type_tmp) {
            $val = $fluid_type_tmp['fluid_type'];
            $fluid_types[$val] = $val;
        }
        $data['fluid_types'] = json_encode($fluid_types);
        
        return $data;
    }
    
    protected function getEditServiceLogEdit($id = 0) {
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
        
        return $data;
    }
    
    protected function getServiceLogDetail($id = 0) {
        $this->load->model('Report_model');
        
        $data['service_log'] = $this->Report_model->findServiceLogs($id);
        
        return $data;
    }
    
    protected function getPMServiceReminders() {
        $this->load->model('Report_model');
        
        $data['pmservice_reminders'] = $this->Report_model->findPMServiceEmailReminders();
        
        return $data;
    }
    
    protected function getMaintenanceLogReminders() {
        $this->load->model('Report_model');
        
        $data['maintenance_log_reminders'] = $this->Report_model->findMaintenanceLogReminders();
        
        return $data;
    }
    
    protected function getReportData($report_type = 'maintenance_log_reminders', $datatmp = [], $id = 0) {
       switch($report_type) {
            case 'service_logs':
                $data = $this->getServiceLogsData();
                break;
                
            case 'service_log_edit':
                $data = $this->getServiceLogEdit($id);
                break;
            
            case 'service_log_detail':
                $data = $this->getServiceLogDetail($id);
                break;
            
            case 'pmservice_reminders':
                $data = $this->getPMServiceReminders();
                break;
            
            case 'maintenance_log_reminders':
                $data = $this->getMaintenanceLogReminders();
                break;
        }

        $data = array_merge($data, $datatmp);
        
        return $data;
    }
    
    public function output($method = 'screen', $report_type = 'maintenance_log_reminders', $id = 0) {
        if($method=='screen') {
            $datatmp = $this->initScreenReport();
        } elseif($method=='spreadsheet') {
            $this->initSpreadsheetReport();
        }
        
        $data = $this->getReportData($report_type, $datatmp, $id);

        switch($method) {
            case 'screen':
                $this->outputScreenReport($report_type, $data);
                break;
            
            case 'spreadsheet':
                $this->outputSpreadsheetReport($spreadsheet);
                break;
            
            case 'ajax':
                $this->outputAjaxReport($data);
                break;
        }
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
            case 'xlsx':
                // Create new Spreadsheet object
                $spreadsheet = new Spreadsheet();

                // Set document properties
                $spreadsheet->getProperties()->setCreator('Maarten Balliauw')
                    ->setLastModifiedBy('Maarten Balliauw')
                    ->setTitle('Office 2007 XLSX Test Document')
                    ->setSubject('Office 2007 XLSX Test Document')
                    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
                    ->setKeywords('office 2007 openxml php')
                    ->setCategory('Test result file');

                // Add some data
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Hello')
                    ->setCellValue('B2', 'world!')
                    ->setCellValue('C1', 'Hello')
                    ->setCellValue('D2', 'world!');

                // Miscellaneous glyphs, UTF-8
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'Miscellaneous glyphs')
                    ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

                // Rename worksheet
                $spreadsheet->getActiveSheet()->setTitle('Simple');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $spreadsheet->setActiveSheetIndex(0);

                
                break;
            
//            case 'service_logs':
//                $this->load->model('Fluidtype_model');
//                $data['service_logs'] = $this->Report_model->findServiceLogs();
//                $fluid_types_tmp = $this->Fluidtype_model->findAll();
//                $fluid_types = [];
//                foreach($fluid_types_tmp as $fluid_type_tmp) {
//                    $val = $fluid_type_tmp['fluid_type'];
//                    $fluid_types[$val] = $val;
//                }
//                $data['fluid_types'] = json_encode($fluid_types);
//                break;
            
//            case 'service_log_edit':
//                $this->load->model('User_model');
//                $this->load->model('Equipmenttype_model');
//                $this->load->model('Fluidtype_model');
//                $this->load->model('Componenttype_model');
//                $this->load->model('Component_model');
//                $this->load->model('Smrchoice_model');
//                $this->load->model('Timechoice_model');
//                $this->load->model('Mileagechoice_model');
//        
//                $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
//                $data['fluidtypes'] = $this->Fluidtype_model->findAll();
//                $data['componenttypes'] = $this->Componenttype_model->findAll();
//                $data['components'] = $this->Component_model->findAll();
//                $data['users'] = (object) $this->User_model->findAll();
//                $data['smrchoices'] = $this->Smrchoice_model->findAll();
//                $data['timechoices'] = $this->Timechoice_model->findAll();
//                $data['mileagechoices'] = $this->Mileagechoice_model->findAll();
//                $data['service_log'] = $this->Report_model->findServiceLogs($id);
//                break;    
              
//            case 'service_log_detail_ajax':
//                $this->load->model('User_model');
//                $this->load->model('Equipmenttype_model');
//                $this->load->model('Fluidtype_model');
//                $this->load->model('Componenttype_model');
//                $this->load->model('Component_model');
//                $this->load->model('Smrchoice_model');
//                $this->load->model('Timechoice_model');
//                $this->load->model('Mileagechoice_model');
//        
//                $data['id'] = $id;
//                $data['equipmenttypes'] = $this->Equipmenttype_model->findAll();
//                $data['fluidtypes'] = $this->Fluidtype_model->findAll();
//                $data['componenttypes'] = $this->Componenttype_model->findAll();
//                $data['components'] = $this->Component_model->findAll();
//                $data['users'] = (object) $this->User_model->findAll();
//                $data['smrchoices'] = $this->Smrchoice_model->findAll();
//                $data['timechoices'] = $this->Timechoice_model->findAll();
//                $data['mileagechoices'] = $this->Mileagechoice_model->findAll();
//                $data['service_log'] = $this->Report_model->findServiceLogs($id);
//                
//                return $this->output
//                    ->set_content_type('application/json')
//                    ->set_status_header(200)
//                    ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
//                break;
            
//            case 'service_log_detail':
//                $data['service_log'] = $this->Report_model->findServiceLogs($id);
//                break;
            
//            case 'pmservice_reminders':
//                $data['pmservice_reminders'] = $this->Report_model->findPMServiceEmailReminders();
//                break;
            
//            case 'maintenance_log_reminders':
//            default:
//                $report_type = 'maintenance_log_reminders';
//                $data['maintenance_log_reminders'] = $this->Report_model->findMaintenanceLogReminders();
//                break;
        }
        
        $data['report_type'] = $report_type;
        $data['reports_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/reports_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/' . $report_type, $data, true);
                
        $this->template->load('authenticated_default', null, $data);
    }
}