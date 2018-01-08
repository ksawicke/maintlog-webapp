<?php

/**
* Tools is a Controller handling CLI interactions.
* The scripts here would be run via cron jobs and should
* use the is_cli() function call to verify they are being
* run not via a URL, but CLI call only.
*
* @package  Maintenance Log Application
* @author   Kevin Sawicke <kevin@rinconmountaintech.com>
* @version  $Revision: 0.2 $
* @access   public
* @see https://codeigniter.com/user_guide/general/cli.html?highlight=cron
*/
class Tools extends CI_Controller {

    function __construct() {
        parent::__construct();
//        if(!is_cli()) {
//            die("This script can not be run via a URL.");
//        }
    }
    
    /**
     * Send PM Service Reminder emails
     */
    public function send_service_reminders() {
        $CI =& get_instance();
        
        $CI->load->model('Report_model');
        $pmservice_reminders = $CI->Report_model->findPMServiceReminders();
        
        
        $message = '<html><head><title>Komatsu Maintenance Log App</title></head><body>This is a test of a message.<br />' . 
                'sadljkakfajsdlfajslfaksjfkalsjfasf<br /><br />' .
                'asdfasdfsdfsdafas</body></html>';
        
        $CI->load->library('email');

        $CI->email->from('komatsumaintenancelogapp@rinconmountaintech.com', 'Komatsu NA Maintenance Log App');
        $CI->email->to('kevin@rinconmountaintech.com');
        $CI->email->cc('kevinsawicke@gmail.com');

        $CI->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $CI->email->set_header('Content-type', 'text/html');
        
        $CI->email->subject('Email Test');
        $CI->email->message($message);
        
        $CI->email->send();
        
        echo '<pre>';
        var_dump($pmservice_reminders);
        exit();
    }
}