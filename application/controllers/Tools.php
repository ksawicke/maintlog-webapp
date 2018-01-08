<?php

/**
* Tools is a Controller handling CLI interactions.
* The scripts here would be run via cron jobs and should
* use the is_cli() function call to verify they are being
* run not via a URL, but CLI call only.
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: Tag Alpha1 $
* @access   public
* @see https://codeigniter.com/user_guide/general/cli.html?highlight=cron
*/
class Tools extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!is_cli()) {
            die("This script can not be run via a URL.");
        }
    }
    
    /**
     * Send PM Service Reminder emails
     */
    public function send_pm_service_email_reminders() {
        $CI =& get_instance();
        $CI->load->model('Report_model');
        $pmservicereminders = $CI->Report_model->findPMServiceEmailReminders("send_emails_now");
        
        foreach($pmservicereminders as $ctr => $reminder) {
            $send_email = $this->isTimeToPMSendServiceEmailReminder($reminder);
            
            if($send_email) {
                $to = $reminder['emails'];
                $unit = $reminder['manufacturer_name'] . " " . $reminder['model_number'] . " " . $reminder['unit_number'];
                if($this->send_email_reminder($to, $unit)) {
                    $CI->Report_model->markPMServiceReminderEmailAsSent($reminder['reminder_id']);
                }
            }
        }
        
        die("Email check and send is complete.");
    }
    
    /**
     * Check if it's time to send an email service reminder for each record
     * 
     * @param type $reminder
     * @return int
     */
    protected function isTimeToPMSendServiceEmailReminder($reminder) {
        $send_email = 0;
        
        if($reminder['reminder_date_sent']==0 &&
            $reminder['warn_on_units']=="Days" &&
            date("Y-m-d") >= date('Y-m-d', strtotime($reminder['reminder_date_created']. ' + ' . $reminder['warn_on_quantity'] . ' days'))) {
             $send_email = 1;
         }

         if($reminder['reminder_date_sent']==0 &&
            $reminder['warn_on_units']=="SMR" &&
            $reminder['last_smr_recorded'] >= $reminder['warn_on_quantity']) {
             $send_email = 1;
         }

         if($reminder['reminder_date_sent']==0 &&
            $reminder['warn_on_units']=="Miles" &&
            $reminder['last_smr_recorded'] >= $reminder['warn_on_quantity']) {

             $send_email = 1;
         }
         
         return $send_email;
    }
    
    /**
     * Send email of an individual service reminder
     * 
     * @param type $to
     * @param type $unit
     * @return type
     */
    protected function send_email_reminder($to, $unit) {
        $CI =& get_instance();
        
        $header = '<html><head><title>Komatsu Maintenance Log App</title></head><body>';
        $footer = '</body></html>';
        
        $body = 'THIS EMAIL WAS AUTO-GENERATED. PLEASE DO NOT REPLY TO THIS EMAIL.<br/ ><br />
                 =================================================================
                 <br />
                 This is a PM Service Reminder for the following unit:<br /><br />
                 ' . $unit . '<br /><br />
                 =================================================================';
        
        $message = $header . $body . $footer;
        
        $CI->load->library('email');

        $CI->email->from('komatsumaintenancelogapp@rinconmountaintech.com', 'Komatsu NA Maintenance Log App');
        $CI->email->to('kevin@rinconmountaintech.com');
//        $CI->email->cc('someemail@email.com');

        $CI->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $CI->email->set_header('Content-type', 'text/html');
        
        $CI->email->subject('PM Service Reminder for: ' . $unit);
        $CI->email->message($message);
        
        return ($CI->email->send());
    }
}