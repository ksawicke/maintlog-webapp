<?php

/**
 * Handles equipment object interactions
 */
class Servicelog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Rb');
        
        date_default_timezone_set('America/Phoenix');
    }
    
    /**
     * Creates or modifies record
     */
    public function store($post, $prev_service_log) {
		list($now, $servicelog, $servicelog_id) = $this->createServiceLogRecord($post);
        
        $servicedBys = explode("|", $post['serviced_by']);
        foreach($servicedBys as $ctr => $serviceByUserId) {
			$this->createServiceLogServicedByRecord($servicelog_id, $serviceByUserId);
        }
        
        switch($post['subflow']) {
            case 'sus':
                $this->createServiceLogSMRUpdateRecord($post, $servicelog_id);
                break;
            
            case 'flu':
                foreach($post['fluid_added'] as $ctr => $fluid_added) {
                    if(!empty($fluid_added['type'])) {
						$this->createServiceLogFluidEntryRecord($servicelog_id, $fluid_added);
                    }
                }

				$this->createServiceLogFluidEntrySMRUpdateRecord($post, $servicelog_id);
                break;
            
            case 'pss':
                $pmservice_id = $this->createServiceLogPMServiceRecord($post, $servicelog_id);
                
                foreach($post['pss_smr_based_notes'] as $id => $note) {
                    if(!empty($note['note'])) {
						$this->createServiceLogPMServiceNoteRecord($pmservice_id, $note);
                    }
                }
                
                $emailsCaptured = [];
                foreach($post['pss_reminder_recipients'] as $id => $recipient) {
                    if(!empty($recipient['email_addresses'])) {
                        if(!in_array($recipient['email_addresses'][0], $emailsCaptured)) {
                            $emailsCaptured[] = $recipient['email_addresses'][0];
                        }
                    }
                }
                
                foreach($emailsCaptured as $id => $email_address) {
					$this->createServiceLogPMServiceReminderRecord($post, $pmservice_id, $email_address);
                }
                break;
            
            case 'ccs':
                $this->createServiceLogComponentChangeRecord($post, $servicelog_id);
                break;
        }
        
        if($post['id']!=0) {
            $first_check = R::getAll("SELECT new_id from servicelog WHERE id = " . $post['id']);
            $old_id = $post['id'];
            $new_id = $servicelog_id;
            
            if($first_check[0]['new_id']!=0) {
                $second_check = R::getAll("SELECT id AS old_id from servicelog WHERE new_id = " . $old_id);
                if(!empty($second_check)) {
                    $old_id = $second_check[0]['old_id'];
                }
            }
            
            $servicelog = R::load('servicelog', $old_id);
            $servicelog->new_id = $new_id;
            
            R::store($servicelog);            
            
            try {
				$this->createServiceLogReplacementRecord($old_id, $new_id, $now);
            } catch (Exception $ex) {
                echo '<pre>';
                var_dump($ex);
            }
        }
    }

    public function importServicelogs($data) {
		foreach($data as $ctr => $logentry) {

//			echo '<pre>';
//			var_dump($logentry);
//			echo '</pre>';

//			$now = date('Y-m-d h:i:s');
//
//			$this->createInspectionRecord($rating);
//
//			$inspectionRating = R::dispense('inspectionrating');
//			$inspectionRating->uuid = $rating->inspectionId;
//			$inspectionRating->checklistitem_id = $rating->checklistItemId;
//			$inspectionRating->rating = $rating->rating;
//			$inspectionRating->note = $rating->note;
//			$inspectionRating->created = $now;
//
//			R::store($inspectionRating);
		}
	}
    
    /**
     * Deletes a service log and its child records
     * 
     * @param type $servicelog_id
     * @return type
     */
    public function deleteServiceLogAndChildren($servicelog_id) {
        try {
            $servicelog = R::load('servicelog', $servicelog_id);
            R::trash($servicelog);
        } catch (Exception $ex) {
            return ['success' => false, 'message' => $ex->getMessage()];
        }
        
        return ['success' => true, 'message' => 'Deleted records successfully.'];
    }

	/**
	 * @param $post
	 * @param $servicelog_id
	 */
	public function createServiceLogComponentChangeRecord($post, $servicelog_id)
	{
		$componentchange = R::dispense('componentchange');
		$componentchange->servicelog_id = $servicelog_id;
		$componentchange->component_type = $post['ccs_component_type'];
		$componentchange->component = $post['ccs_component'];
		$componentchange->component_data = $post['ccs_component_data'];
		$componentchange->notes = $post['ccs_notes'];
		R::store($componentchange);

		$componentchangesmrupdate = R::dispense('componentchangesmrupdate');
		$componentchangesmrupdate->servicelog_id = $servicelog_id;
		$componentchangesmrupdate->previous_smr = $post['ccs_previous_smr'];
		$componentchangesmrupdate->smr = $post['ccs_current_smr'];
		R::store($componentchangesmrupdate);
	}

	/**
	 * @param $post
	 * @param $pmservice_id
	 * @param $email_address
	 */
	public function createServiceLogPMServiceReminderRecord($post, $pmservice_id, $email_address)
	{
		$pmservicereminder = R::dispense('pmservicereminder');
		$pmservicereminder->pmservice_id = $pmservice_id;
		$pmservicereminder->emails = $email_address;
		$pmservicereminder->pm_type = $post['pss_reminder_pm_type'];
		$pmservicereminder->pm_level = $post['pss_reminder_pm_level'];
		$pmservicereminder->quantity = $post['pss_reminder_quantity'];
		$pmservicereminder->units = $post['pss_reminder_units'];
		$pmservicereminder->date = date("Y-m-d");
		$pmservicereminder->sent = 0;
		R::store($pmservicereminder);
	}

	/**
	 * @param $post
	 * @param $servicelog_id
	 * @return int|string
	 */
	public function createServiceLogPMServiceRecord($post, $servicelog_id)
	{
		$pmservice = R::dispense('pmservice');
		$pmservice->servicelog_id = $servicelog_id;
		$pmservice->pm_type = $post['pss_pm_type'];
		$pmservice->pm_level = $post['pss_smr_based_pm_level'];
		$pmservice->previous_smr = $post['pss_smr_based_previous_smr'];
		$pmservice->current_smr = $post['pss_smr_based_current_smr'];
		$pmservice->due_units = $post['pss_due_units'];
		$pmservice->notes = $post['pss_notes'];
		$pmservice_id = R::store($pmservice);
		return $pmservice_id;
	}

	/**
	 * @param $servicelog_id
	 * @param $fluid_added
	 */
	public function createServiceLogFluidEntryRecord($servicelog_id, $fluid_added)
	{
		$fluidentry = R::dispense('fluidentry');
		$fluidentry->servicelog_id = $servicelog_id;
		$fluidentry->type = $fluid_added['type'];
		$fluidentry->quantity = $fluid_added['quantity'];
		$fluidentry->units = $fluid_added['units'];
		R::store($fluidentry);
	}

	/**
	 * @param $post
	 * @param $servicelog_id
	 */
	public function createServiceLogFluidEntrySMRUpdateRecord($post, $servicelog_id)
	{
		$fluidentrysmrupdate = R::dispense('fluidentrysmrupdate');
		$fluidentrysmrupdate->servicelog_id = $servicelog_id;
		$fluidentrysmrupdate->previous_smr = $post['flu_previous_smr'];
		$fluidentrysmrupdate->smr = $post['flu_current_smr'];
		$fluidentrysmrupdate->note = $post['flu_notes'];
		R::store($fluidentrysmrupdate);
	}

	/**
	 * @param $pmservice_id
	 * @param $note
	 */
	public function createServiceLogPMServiceNoteRecord($pmservice_id, $note)
	{
		$pmservicenote = R::dispense('pmservicenote');
		$pmservicenote->pmservice_id = $pmservice_id;
		$pmservicenote->note = $note['note'];
		R::store($pmservicenote);
	}

	/**
	 * @param $post
	 * @param $servicelog_id
	 */
	public function createServiceLogSMRUpdateRecord($post, $servicelog_id)
	{
		$smrupdate = R::dispense('smrupdate');
		$smrupdate->servicelog_id = $servicelog_id;
		$smrupdate->previous_smr = (int)$post['sus_previous_smr'];
		$smrupdate->smr = (int)$post['sus_current_smr'];
		R::store($smrupdate);
	}

	/**
	 * @param $servicelog_id
	 * @param $serviceByUserId
	 */
	public function createServiceLogServicedByRecord($servicelog_id, $serviceByUserId)
	{
		$servicelog_servicedby = R::dispense('servicelogservicedby');
		$servicelog_servicedby->servicelog_id = $servicelog_id;
		$servicelog_servicedby->user_id = $serviceByUserId;
		$servicelog_servicedby_id = R::store($servicelog_servicedby);
	}

	/**
	 * @param $post
	 * @return array
	 */
	public function createServiceLogRecord($post)
	{
		$now = date('Y-m-d h:i:s');

		$servicelog = R::dispense('servicelog');
		$servicelog->date_entered = date('Y-m-d', strtotime($post['date_entered']));
		$servicelog->entered_by = $post['entered_by'];
		$servicelog->unit_number = $post['unit_number'];
		$servicelog->created = $now;
		$servicelog_id = R::store($servicelog);
		return array($now, $servicelog, $servicelog_id);
	}

	/**
	 * @param $old_id
	 * @param $new_id
	 * @param $now
	 */
	public function createServiceLogReplacementRecord($old_id, $new_id, $now)
	{
		$servicelogreplacement = R::dispense('servicelogreplacement');
		$servicelogreplacement->old_id = $old_id;
		$servicelogreplacement->new_id = $new_id;
		$servicelogreplacement->entered_by = $_SESSION['user_id'];
		$servicelogreplacement->created = $now;
		R::store($servicelogreplacement);
	}

}
