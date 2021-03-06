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
 * @access   public
 */
class Reporting extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Initialize a screen report
	 *
	 * @return array
	 */
	protected function initScreenReport()
	{
		$data = [
			'applicationName' => 'Komatsu NA Maintenance Log',
			'title' => 'Komatsu NA Maintenance Log',
			'assetDirectory' => $this->appDir . '/assets/',
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
	 * @param string $report_type
	 * @param array $data
	 */
	protected function outputScreenReport($report_type = '', $data = [])
	{
		$data['dateEnteredStarting'] = (array_key_exists('data', $_REQUEST) && array_key_exists('date_entered_starting', $_REQUEST['data']) && !empty($_REQUEST['data']['date_entered_starting']) ? $_REQUEST['data']['date_entered_starting'] : '');

		$data['dateEnteredEnding'] = (array_key_exists('data', $_REQUEST) && array_key_exists('date_entered_ending', $_REQUEST['data']) && !empty($_REQUEST['data']['date_entered_ending']) ? $_REQUEST['data']['date_entered_ending'] : '');

		$data['report_type'] = $report_type;
		
		$data['reports_navigation'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/reports_navigation', $data, true);
		$data['body'] = $this->load->view('templates/bootstrap/authenticated/app/reporting/' . $report_type, $data, true);

		$this->template->load('authenticated_default_bootstrap-4.0.0.php', null, $data);
	}

	/**
	 * Initialize a spreadsheet report
	 *
	 * @return null
	 */
	protected function initSpreadsheetReport()
	{
		$helper = new Sample();
		if ($helper->isCli()) {
			$helper->log('This example should only be run from a Web Browser' . PHP_EOL);

			return;
		}
	}

	/**
	 * Create Spreadsheet filename with report type and date/time
	 *
	 * @param string $report_type
	 * @return string
	 */
	protected function createSpreadsheetFilename($report_type)
	{
		return $report_type . "_" . date('m-d-Y_His') . '.xlsx';
	}

	/**
	 * Output a spreadsheet report
	 *
	 * @param object $spreadsheet
	 */
	protected function outputSpreadsheetReport($spreadsheet, $report_type)
	{
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
	 * @param array $data
	 * @return object
	 */
	protected function outputAjaxReport($data = [])
	{
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data, JSON_NUMERIC_CHECK));
	}

	/**
	 * Get Service Logs data
	 *
	 * @return array
	 */
	protected function getServiceLogsData()
	{
		$this->load->model('Report_model');
		$this->load->model('Fluidtype_model');
		$data['service_logs'] = $this->Report_model->findServiceLogs(0, $_REQUEST);
		$fluid_types_tmp = $this->Fluidtype_model->findAll();
		$fluid_types = [];
		foreach ($fluid_types_tmp as $fluid_type_tmp) {
			$val = $fluid_type_tmp['fluid_type'];
			$fluid_types[$val] = $val;
		}

		$data['fluid_types'] = json_encode($fluid_types);

		return $data;
	}

	/**
	 * Get Edit Service Log data
	 *
	 * @param integer $id
	 * @return array
	 */
	protected function getEditServiceLogEditData($id = 0)
	{
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
		$data['users'] = (object)$this->User_model->findAll();
		$data['smrchoices'] = $this->Smrchoice_model->findAll();
		$data['timechoices'] = $this->Timechoice_model->findAll();
		$data['mileagechoices'] = $this->Mileagechoice_model->findAll();
		$data['service_log'] = $this->Report_model->findServiceLogs($id);

		return $data;
	}

	/**
	 * Get Service Log detail
	 *
	 * @param integer $id
	 * @return array
	 */
	protected function getServiceLogDetailData($id = 0)
	{
		$this->load->model('Report_model');
		$this->load->model('Equipmentunit_model');

		$data['service_log'] = $this->Report_model->findServiceLogs($id);
		$equipmentunit_id = $data['service_log']['equipmentunit_id'];

		$data['service_log']['last_smr'] = $this->Equipmentunit_model->findLastSMR($equipmentunit_id);

		return $data;
	}

	/**
	 * Get PM Service Reminders data
	 * @return array
	 */
	protected function getPMServiceRemindersData()
	{
		$this->load->model('Report_model');

		$data['pmservice_reminders'] = $this->Report_model->findPMServiceEmailReminders($_REQUEST);

		return $data;
	}

	/**
	 * Get Maintenance Log Reminders Data
	 *
	 * @return array
	 */
	protected function getMaintenanceLogRemindersData()
	{
		$this->load->model('Report_model');

		$data['maintenance_log_reminders'] = $this->Report_model->findMaintenanceLogReminders($_REQUEST);

		return $data;
	}

	/**
	 * Get Maintenance Log Reminders Data
	 *
	 * @return string
	 */
	protected function getEquipmentListData()
	{
		$this->load->model('Report_model');

		$data['equipment_list'] = $this->Report_model->getEquipmentList($_REQUEST);

		return $data;
	}

	protected function getFuelUsedData()
	{
		$this->load->model('Report_model');

		$data['fuelUsed'] = $this->Report_model->getFuelUsed($_REQUEST);
		$data['fuelUsedTotals'] = $this->Report_model->getFuelUsedTotals($_REQUEST);

		return $data;
	}

	protected function getSMRUsedData()
	{
		$this->load->model('Report_model');

		$data['smrUsed'] = $this->Report_model->getSMRUsed($_REQUEST);

		return $data;
	}

	protected function getInspectionEntryData($uuid = null)
	{
		$this->load->model('Report_model');
		$this->load->model('Equipmentunit_model');

		$data['inspectionEntry'] = $this->Report_model->getInspectionEntries($uuid, $_REQUEST);

		if($uuid==null) {
			foreach ($data['inspectionEntry'] as $ctr => $inspection) {
				$data['inspectionEntry'][$ctr]['last_smr'] = $this->Equipmentunit_model->findLastSMR($data['inspectionEntry'][$ctr]['equipmentunit_id']);
			}
		} else {
			$data['inspectionEntry']['last_smr'] = $this->Equipmentunit_model->findLastSMR($data['inspectionEntry']['equipmentunit_id']);
		}

		return $data;
	}

	/**
	 * Get spreadsheet report data
	 *
	 * @param string $report_type
	 * @param array $data
	 * @param integer $id
	 * @return array
	 */
	protected function getSpreadsheetReportData($report_type = 'maintenance_log_reminders', $data = [], $id)
	{
		$spreadsheetReportData = [
			'spreadsheetProperties' =>
				['creator' => 'Komatsu NA',
					'lastModifiedBy' => 'Maintenance Log Application',
					'title' => 'Report',
					'subject' => 'Report',
					'description' => 'Report',
					'keywords' => 'Komatsu NA',
					'category' => 'Report',
					'sheetTitle' => $report_type
				]
		];

		switch ($report_type) {
			case 'maintenance_log_reminders':
				$spreadsheetReportData['cellData'] = $this->getMaintenanceLogReminderCellData($data);
				break;

			case 'service_logs':
				$spreadsheetReportData['cellData'] = $this->getServiceLogsCellData($data);
				break;

			case 'pmservice_reminders':
				$spreadsheetReportData['cellData'] = $this->getPMServiceRemindersCellData($data);
				break;

			case 'equipment_list':
				$spreadsheetReportData['cellData'] = $this->getEquipmentListCellData($data);
				break;

			case 'fuel_used':
				$spreadsheetReportData['cellData'] = $this->getFuelUsedCellData($data);
				break;

			case 'smr_used':
				$spreadsheetReportData['cellData'] = $this->getSMRUsedCellData($data);
				break;

			case 'inspection_entry':
				$spreadsheetReportData['cellData'] = $this->getInspectionEntryCellData($data);
		}

		return $spreadsheetReportData;
	}

	/**
	 * Get Equipment List Cell data
	 *
	 * @param array $data
	 * @return array
	 */
	protected function getEquipmentListCellData($data)
	{
		$cellData = [
			'A1' => 'Manufacturer Name',
			'B1' => 'Model Name',
			'C1' => 'Unit Number',
			'D1' => 'Equpment Type'
		];

		$row = 2;
		foreach ($data['equipment_list'] as $ctr => $e) {
			$cellData['A' . $row] = $e['manufacturer_name'];
			$cellData['B' . $row] = $e['model_number'];
			$cellData['C' . $row] = $e['unit_number'];
			$cellData['D' . $row] = $e['equipment_type'];

			$row++;
		}

		return $cellData;
	}

	protected function getFuelUsedCellData($data)
	{
		$cellData = [
			'A1' => 'Date Entered',
			'B1' => 'Fluid Type',
			'C1' => 'Amount Used (gal)',
			'D1' => 'Equipment Type',
			'E1' => 'Manufacturer Name',
			'F1' => 'Model Number',
			'G1' => 'Unit Number'
		];

		$row = 2;
		foreach ($data['fuelUsed'] as $ctr => $d) {
			$date = new DateTime($d['date_entered']);

			$cellData['A' . $row] = $date->format('m/d/Y');
			$cellData['B' . $row] = $d['fluid_type'];
			$cellData['C' . $row] = $d['quantity'];
			$cellData['D' . $row] = $d['equipment_type'];
			$cellData['E' . $row] = $d['manufacturer_name'];
			$cellData['F' . $row] = $d['model_number'];
			$cellData['G' . $row] = $d['unit_number'];

			$row++;
		}

		$row++;

		$cellData['A' . $row] = 'TOTALS:';

		foreach($data['fuelUsedTotals'] as $ctr => $d) {

			$cellData['B' . $row] = $d['fluid_type'];
			$cellData['C' . $row] = $d['total_quantity_used'];

			$row++;
		}

		return $cellData;
	}

	protected function getInspectionEntryCellData($data)
	{
		$this->load->model('Equipmentunit_model');

		$cellData = [
			'A1' => 'Date Entered',
			'B1' => 'Time of Inspection',
			'C1' => 'Inspected By',
			'D1' => 'Unit Number',
			'E1' => 'Manufacturer Name',
			'F1' => 'Model Number',
			'G1' => 'Equipment Type',
			'H1' => 'SMR/Mileage',
			'I1' => 'Good Items',
			'J1' => 'Bad Items',
			'K1' => 'Images Taken'
		];

		/**
		 * Output additional column names with each
		 * checklist item in alphabetical order.
		 */
		$num = 11;
		foreach($data['inspectionEntry'][0]['checklist_items'] as $clc => $cli) {
			$col = $this->getNameFromNumber($num);
			$cellData[$col . '1'] = $cli['item'];
			$num++;
		}

		$row = 2;
		foreach ($data['inspectionEntry'] as $ctr => $s) {
			$date = new DateTime($s['created']);
			$startAt = 11;

			$cellData['A' . $row] = $date->format('m/d/Y');
			$cellData['B' . $row] = $date->format('h:i A');
			$cellData['C' . $row] = $s['created_by_first_name'] . " " . $s['created_by_last_name'];
			$cellData['D' . $row] = $s['unit_number'];
			$cellData['E' . $row] = $s['manufacturer_name'];
			$cellData['F' . $row] = $s['model_number'];
			$cellData['G' . $row] = $s['equipment_type'];
			$cellData['H' . $row] = $s['last_smr'];
			$cellData['I' . $row] = $s['ratingCount'][0]['count_good'];
			$cellData['J' . $row] = $s['ratingCount'][0]['count_bad'];
			$cellData['K' . $row] = $s['imageCount'];

			$num = 11;
			foreach($data['inspectionEntry'][0]['checklist_items'] as $clc => $cli) {
				$col = $this->getNameFromNumber($num);

				foreach($s['ratings'] as $rctr => $rating) {
					if ($rating['item'] == $cli['item']) {
						$cellData[$col . $row] = ($rating['rating'] == 1 ? 'GOOD' : $rating['note']);
					}
				}

				$num++;
			}



			$row++;
		}

		return $cellData;
	}

	protected function getNameFromNumber($num) {
		$numeric = $num % 26;
		$letter = chr(65 + $numeric);
		$num2 = intval($num / 26);
		if ($num2 > 0) {
			return $this->getNameFromNumber($num2 - 1) . $letter;
		} else {
			return $letter;
		}
	}

	protected function getSMRUsedCellData($data)
	{
        $cellData = [
            'A1' => 'Date Entered',
            'B1' => 'Equipment Type',
            'C1' => 'Manufacturer Name',
            'D1' => 'Model Number',
            'E1' => 'Unit Number',
            'F1' => 'Track Type',
            'G1' => 'Beginning SMR/Miles/Time Used',
            'H1' => 'End SMR/Miles/Time Used',
            'I1' => 'Total SMR/Miles/Time Used'
        ];

        $row = 2;
        foreach ($data['smrUsed'] as $ctr => $s) {
            $date = new DateTime($s['date_entered']);
            $total = (($s['max_smr'] > $s['min_smr']) ? ($s['max_smr'] - $s['min_smr']) : '');

            $cellData['A' . $row] = $date->format('m/d/Y');
            $cellData['B' . $row] = $s['equipment_type'];
            $cellData['C' . $row] = $s['manufacturer_name'];
            $cellData['D' . $row] = $s['model_number'];
            $cellData['E' . $row] = $s['unit_number'];
            $cellData['F' . $row] = $s['track_type'];
            $cellData['G' . $row] = $s['min_smr'];
            $cellData['H' . $row] = $s['max_smr'];
            $cellData['I' . $row] = $total;

            $row++;
        }

        return $cellData;
    }

	/**
	 * Get Maintenance Log Reminder Cell Data
	 *
	 * @param type $data
	 */
	protected function getMaintenanceLogReminderCellData($data)
	{
		$cellData = [
			'A1' => 'Last Entry Date',
			'B1' => 'Last SMR',
			'C1' => 'Manufacturer Name',
			'D1' => 'Model Name',
			'E1' => 'Unit Number',
			'F1' => 'Notes',
			'G1' => 'SMR Due'
		];

		$row = 2;
		foreach ($data['maintenance_log_reminders'] as $ctr => $d) {
			$date = new DateTime($d['date_entered']);

			$cellData['A' . $row] = $date->format('m/d/Y');
			$cellData['B' . $row] = $d['current_smr'];
			$cellData['C' . $row] = $d['manufacturer_name'];
			$cellData['D' . $row] = $d['model_number'];
			$cellData['E' . $row] = $d['unit_number'];
			$cellData['F' . $row] = $d['notes'];
			$cellData['G' . $row] = $d['due_units'];

			$row++;
		}

		return $cellData;
	}

	/**
	 * Get Service Logs Cell Data
	 *
	 * @param type $data
	 * @return type
	 */
	protected function getServiceLogsCellData($data)
	{
		$cellData = [
			'A1' => 'Date Entered',
			'B1' => 'Entered By',
			'C1' => 'Serviced By',
			'D1' => 'Manufacturer Name',
			'E1' => 'Model Name',
			'F1' => 'Unit Number',
			'G1' => 'Entry Type',
			'H1' => 'SMR / Miles / Time',
			'I1' => 'Type / Amount of Fluid',
			'J1' => 'Component Type',
			'K1' => 'Component',
			'L1' => 'Component Data'
		];

		sort($data['service_logs']);

		switch ($data['service_logs'][0]['entry_type']) {
			case 'Fluid Entry':
				$cellData['I1'] = 'Type / Amount of Fluid';
				break;

			case 'Component Change':
				$cellData['J1'] = 'Component Type';
				$cellData['K1'] = 'Component';
				$cellData['L1'] = 'Component Data';
				break;

			case 'SMR Update':
				$cellData['H1'] = 'SMR / Miles / Time';
				break;
		}

		$row = 2;
		
		foreach ($data['service_logs'] as $ctr => $d) {
			$date = new DateTime($d['date_entered']);

			$servicedByArray = [];
			$servicedByString = "";

			if(!empty($d['serviced_by'])) {
				foreach ($d['serviced_by'] as $sbctr => $servicedBy) {
					$servicedByArray[] = $servicedBy['servicedby_last_name'] . ", " . $servicedBy['servicedby_first_name'];
				}
			}

			$servicedByString = implode(" & ", $servicedByArray);

			$cellData['A' . $row] = $date->format('m/d/Y');
			$cellData['B' . $row] = $d['enteredby_last_name'] . ", " . $d['enteredby_first_name'];
			$cellData['C' . $row] = $servicedByString;
			$cellData['D' . $row] = $d['manufacturer_name'];
			$cellData['E' . $row] = $d['model_number'];
			$cellData['F' . $row] = $d['unit_number'];
			$cellData['G' . $row] = $d['entry_type'];
			$cellData['H' . $row] = $d['smr'];

			switch ($data['service_logs'][$ctr]['entry_type']) {
				case 'Fluid Entry':
					$cellData['I' . $row] = str_replace(", ", "\n", $d['fluid_string']);
					break;

				case 'Component Change':
					$cellData['J' . $row] = $d['component_type'];
					$cellData['K' . $row] = $d['component'];
					$cellData['L' . $row] = $d['component_data'];
					break;

				case 'SMR Update':
					$cellData['H' . $row] = $d['smr'];
					break;
			}

			$row++;
		}

		return $cellData;
	}

	/**
	 * Get PM Service Reminders Cell Data
	 *
	 * @param array $data
	 * @return string
	 */
	protected function getPMServiceRemindersCellData($data)
	{
		$cellData = [
			'A1' => 'Manufacturer Name',
			'B1' => 'Model Name',
			'C1' => 'Unit Number',
			'D1' => 'Email Address',
			'E1' => 'Warn At',
			'F1' => 'Last SMR Recorded',
			'G1' => 'PM Service Due At',
			'H1' => 'Email Sent On'
		];

		$row = 2;
		foreach ($data['pmservice_reminders'] as $ctr => $d) {
			if (!is_null($d['sent_on'])) {
				$date = new DateTime($d['sent_on']);
				$sent_on = $date->format('m/d/Y');
			} else {
				$sent_on = '';
			}

			$cellData['A' . $row] = $d['manufacturer_name'];
			$cellData['B' . $row] = $d['model_number'];
			$cellData['C' . $row] = $d['unit_number'];
			$cellData['D' . $row] = $d['emails'];
			$cellData['E' . $row] = $d['warn_on_quantity'] . " " . $d['warn_on_units'];
			$cellData['F' . $row] = (($d['last_smr_recorded'] != 'NULL') ? $d['last_smr_recorded'] : '');
			$cellData['G' . $row] = $d['pmservice_due_quantity'];
			$cellData['H' . $row] = $sent_on;

			$row++;
		}

		return $cellData;
	}

	/**
	 * Build spreadsheet
	 *
	 * @param type $data
	 * @return object
	 */
	protected function buildSpreadsheet($data)
	{
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

        PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );

		// Add some data
		foreach ($data['cellData'] as $cell => $cellData) {
			$spreadsheet->setActiveSheetIndex(0)->setCellValue($cell, $cellData);
		}

		$highestRowAndColumn = $spreadsheet->getActiveSheet()->getHighestRowAndColumn();
        $highestRow = $highestRowAndColumn['row'];
        $highestColumn = $highestRowAndColumn['column'];

        // Make first row bold
		$spreadsheet->getActiveSheet()->getStyle("A1:".$highestColumn."1")->getFont()->setBold(true);

		// Make all rows vertical align top
		$spreadsheet->getActiveSheet()->getStyle("A1:".$highestColumn.$highestRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

		// Make all columns centered
		$spreadsheet->getActiveSheet()->getStyle("A1:".$highestColumn.$highestRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		// Search for text 'TOTALS:' (below the spreadsheet) and make it BOLD
		$this->makeSpreadsheetTotalsHeaderBold($spreadsheet);

		// Auto-size columns
		$sheet = $spreadsheet->getActiveSheet();

		for ($i = 'A'; $i <= $highestColumn; $i++) {
			$sheet->getColumnDimension($i)->setAutoSize(TRUE);
		}

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
	protected function getReportData($report_type = 'maintenance_log_reminders', $datatmp = [], $id = 0)
	{
		switch ($report_type) {
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

			case 'equipment_list':
				$data = $this->getEquipmentListData();
				break;

			case 'fuel_used':
				$data = $this->getFuelUsedData();
				break;

			case 'smr_used':
				$data = $this->getSMRUsedData();
				break;

			case 'inspection_entry':
				$data = $this->getInspectionEntryData();
				break;

			case 'inspection_entry_detail':
				$data = $this->getInspectionEntryData($id);
				break;
		}

		$data = array_merge($data, $datatmp);

		return $data;
	}

	/**
	 * Output report
	 *
	 * @param string $method
	 * @param string $report_type
	 * @param integer $id
	 */
	public function output($method = 'screen', $report_type = 'maintenance_log_reminders', $id = 0)
	{
		if ($method == 'screen' || $method == 'ajax') {
			$datatmp = $this->initScreenReport();
			$data = $this->getReportData($report_type, $datatmp, $id);
		} elseif ($method == 'spreadsheet') {
			$datatmp = [];
			$this->initSpreadsheetReport();

			$data = $this->getReportData($report_type, $datatmp, $id);

			$data = $this->getSpreadsheetReportData($report_type, $data, $id);

			$spreadsheet = $this->buildSpreadsheet($data);
		}

		switch ($method) {
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
	 * @param $spreadsheet
	 */
	protected function makeSpreadsheetTotalsHeaderBold($spreadsheet)
	{
		$foundInCells = [];
		$searchValue = 'TOTALS:';

		foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
			$ws = $worksheet->getTitle();
			foreach ($worksheet->getRowIterator() as $row) {
				$cellIterator = $row->getCellIterator();
				foreach ($cellIterator as $cell) {
					if ($cell->getValue() == $searchValue) {
						$foundInCells[] = $cell->getCoordinate();

						$from = $cell->getCoordinate();
						$to = $cell->getCoordinate();
						$spreadsheet->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
					}
				}
			}
		}
	}
}
