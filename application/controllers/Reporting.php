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
    
    /**
     * Initialize a screen report
     * 
     * @return type
     */
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
    
    /**
     * Output a screen report
     * 
     * @param type $report_type
     * @param type $data
     */
    protected function outputScreenReport($report_type, $data = []) {        
        $data['report_type'] = $report_type;
        $data['reports_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/reports_navigation', $data, true);
        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/' . $report_type, $data, true);
        
        $this->template->load('authenticated_default', null, $data);
    }
    
    /**
     * Initialize a spreadsheet report
     * 
     * @return type
     */
    protected function initSpreadsheetReport() {
        $helper = new Sample();
        if ($helper->isCli()) {
            $helper->log('This example should only be run from a Web Browser' . PHP_EOL);

            return;
        }
    }
    
    protected function createSpreadsheetFilename($report_type) {
        return $report_type . "_" . date('m-d-Y_His') . '.xlsx';
    }
    
    /**
     * Output a spreadsheet report
     * 
     * @param type $spreadsheet
     */
    protected function outputSpreadsheetReport($spreadsheet, $report_type) {
        $filename = $this->createSpreadsheetFilename($report_type);
        
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
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
    
    /**
     * Output an AJAX report
     * @param type $data
     * @return type
     */
    protected function outputAjaxReport($data) {
        return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
    }
    
    /**
     * Get Service Logs data
     * 
     * @return type
     */
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
    
    /**
     * Get Edit Service Log data
     * 
     * @param type $id
     * @return type
     */
    protected function getEditServiceLogEditData($id = 0) {
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
    
    /**
     * Get Service Log detail
     * 
     * @param type $id
     * @return type
     */
    protected function getServiceLogDetailData($id = 0) {
        $this->load->model('Report_model');
        
        $data['service_log'] = $this->Report_model->findServiceLogs($id);
        
        return $data;
    }
    
    /**
     * Get PM Service Reminders data
     * @return type
     */
    protected function getPMServiceRemindersData() {
        $this->load->model('Report_model');
        
        $data['pmservice_reminders'] = $this->Report_model->findPMServiceEmailReminders();
        
        return $data;
    }
    
    /**
     * Get Maintenance Log Reminders Data
     * 
     * @return type
     */
    protected function getMaintenanceLogRemindersData() {
        $this->load->model('Report_model');
        
        $data['maintenance_log_reminders'] = $this->Report_model->findMaintenanceLogReminders();
        
        return $data;
    }
    
    protected function getSpreadsheetReportData($report_type = 'maintenance_log_reminders', $id) {
        $data = [
            'spreadsheetProperties' =>
                [ 'creator' => 'Komatsu NA',
                  'lastModifiedBy' => 'Maintenance Log Application',
                  'title' => 'Test Title',
                  'subject' => 'Subject here',
                  'description' => 'Here is a description',
                  'keywords' => 'test 1 2 3',
                  'category' => 'category',
                  'sheetTitle' => 'BLAH BLAH'
                ],
            'cellData' =>
                [ 'A1' => 'asfafafasfd',
                  'B2' => 'sadfdsafsadfasf',
                  'C3' => 'asdfdsafdsafadsfasfsdafsdf'
                ]
        ];
        
        return $data;
    }
    
    protected function buildSpreadsheet($data) {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator($data['spreadsheetProperties']['creator'])
            ->setLastModifiedBy($data['spreadsheetProperties']['lastModifiedBy'])
            ->setTitle($data['spreadsheetProperties']['title'])
            ->setSubject($data['spreadsheetProperties']['subject'])
            ->setDescription($data['spreadsheetProperties']['description'])
            ->setKeywords($data['spreadsheetProperties']['keywords'])
            ->setCategory($data['spreadsheetProperties']['category']);

        // Add some data
        foreach($data['cellData'] as $cell => $cellData) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell, $cellData);
        }
        
//        $spreadsheet->setActiveSheetIndex(0)
//            ->setCellValue('A1', 'Hello')
//            ->setCellValue('B2', 'world!')
//            ->setCellValue('C1', 'Hello')
//            ->setCellValue('D2', 'world!');
//
//        // Miscellaneous glyphs, UTF-8
//        $spreadsheet->setActiveSheetIndex(0)
//            ->setCellValue('A4', 'Miscellaneous glyphs')
//            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle($data['spreadsheetProperties']['sheetTitle']);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        
        return $spreadsheet;
    }
    
    /**
     * Get Report data
     * 
     * @param type $report_type
     * @param type $datatmp
     * @param type $id
     * @return type
     */
    protected function getReportData($report_type = 'maintenance_log_reminders', $datatmp = [], $id = 0) {
       switch($report_type) {
            case 'service_logs':
                $data = $this->getServiceLogsData();
                break;
                
            case 'service_log_edit':
                $data = $this->getServiceLogEditData($id);
                break;
            
            case 'service_log_detail':
                $data = $this->getServiceLogDetailData($id);
                break;
            
            case 'pmservice_reminders':
                $data = $this->getPMServiceRemindersData();
                break;
            
            case 'maintenance_log_reminders':
                $data = $this->getMaintenanceLogRemindersData();
                break;
        }

        $data = array_merge($data, $datatmp);
        
        return $data;
    }
    
    /**
     * Output report
     * 
     * @param type $method
     * @param type $report_type
     * @param type $id
     */
    public function output($method = 'screen', $report_type = 'maintenance_log_reminders', $id = 0) {
        if($method=='screen' || $method=='ajax') {
            $datatmp = $this->initScreenReport();
            $data = $this->getReportData($report_type, $datatmp, $id);
        } elseif($method=='spreadsheet') {
            $this->initSpreadsheetReport();
            $data = $this->getSpreadsheetReportData($report_type, $id);
            $spreadsheet = $this->buildSpreadsheet($data);
        }
        
        switch($method) {
            case 'screen':
                $this->outputScreenReport($report_type, $data);
                break;
            
            case 'spreadsheet':
                $this->outputSpreadsheetReport($spreadsheet, $report_type);
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
//    public function reporting($report_type = 'index', $id = 0)
//    {
//        
//        
//        switch($report_type) {
//            case 'xlsx':
//                // Create new Spreadsheet object
//                $spreadsheet = new Spreadsheet();
//
//                // Set document properties
//                $spreadsheet->getProperties()->setCreator('Maarten Balliauw')
//                    ->setLastModifiedBy('Maarten Balliauw')
//                    ->setTitle('Office 2007 XLSX Test Document')
//                    ->setSubject('Office 2007 XLSX Test Document')
//                    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
//                    ->setKeywords('office 2007 openxml php')
//                    ->setCategory('Test result file');
//
//                // Add some data
//                $spreadsheet->setActiveSheetIndex(0)
//                    ->setCellValue('A1', 'Hello')
//                    ->setCellValue('B2', 'world!')
//                    ->setCellValue('C1', 'Hello')
//                    ->setCellValue('D2', 'world!');
//
//                // Miscellaneous glyphs, UTF-8
//                $spreadsheet->setActiveSheetIndex(0)
//                    ->setCellValue('A4', 'Miscellaneous glyphs')
//                    ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
//
//                // Rename worksheet
//                $spreadsheet->getActiveSheet()->setTitle('Simple');
//
//                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
//                $spreadsheet->setActiveSheetIndex(0);
//
//                
//                break;
//            
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
//        }
//        
//        $data['report_type'] = $report_type;
//        $data['reports_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/reports_navigation', $data, true);
//        $data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/' . $report_type, $data, true);
//                
//        $this->template->load('authenticated_default', null, $data);
//    }
}