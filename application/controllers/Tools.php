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
        if(!is_cli()) {
            die("This script can not be run via a URL.");
        }
    }
    
    public function message($to = 'World') {
        echo "Hello {$to}!".PHP_EOL;
    }
    
    /**
     * Create a new function to send PM Service Reminders.
     */
    public function send_service_reminders() {
        $CI =& get_instance();
        
        $CI->load->model('Report_model');
        $pmservice_reminders = $CI->Report_model->findPMServiceReminders();
        
        echo '<pre>';
        var_dump($pmservice_reminders);
        exit();
    }
}