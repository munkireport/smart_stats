<?php 

/**
 * Smart_stats_controller class
 *
 * @package smart_stats
 * @author tuxudo
 **/
class Smart_stats_controller extends Module_controller
{
	function __construct()
	{
		$this->module_path = dirname(__FILE__);

		// Add local config
		configAppendFile(__DIR__ . '/config.php', 'smart_stats');
	}

	/**
	 * Default method
	 *
	 * @author AvB
	 **/
	function index()
	{
		echo "You've loaded the smart_stats module!";
	}
    
    /**
    * Get data for SSD Service Program widget
    * https://www.apple.com/support/13-inch-macbook-pro-solid-state-drive-service-program/
    * Research done by @eholtam/@poundbangbash
    *
    * @return void
    * @author tuxudo
    **/
    public function ssd_service_check()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Smart_stats_model();
        $sql = "SELECT COUNT(
                            CASE WHEN `firmware_version` = 'CXS4JA0Q' AND (SUBSTRING(`serial_number`, 4, 1) = 'V' 
                            OR SUBSTRING(`serial_number`, 4, 1) = 'W') 
                            THEN 1 END) AS 'unfixed',

                        COUNT(
                            CASE WHEN `firmware_version` = 'CXS4LA0Q' AND (SUBSTRING(`serial_number`, 4, 1) = 'V'
                            OR SUBSTRING(`serial_number`, 4, 1) = 'W')
                            THEN 1 END) AS 'fixed',

                        COUNT(
                            CASE WHEN (`firmware_version` = 'CXS4JA0Q' OR `firmware_version` = 'CXS4LA0Q') AND SUBSTRING(`serial_number`, 4, 1) <> 'V'
                            AND SUBSTRING(`serial_number`, 4, 1) <> 'W'
                            THEN 1 END) AS 'not_affected'
                        
                        FROM smart_stats
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE `model_number` = 'APPLE SSD SM0256L'
                        ".get_machine_group_filter('AND');

        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
     * Retrieve data in json format for client tab
     *
     * @return void
     * @author tuxudo
     **/
    public function get_client_tab_data($serial_number = '')
    {        
        if (! $this->authorized()) {
            die('Authenticate first.'); // Todo: return json
            return;
        }

        $queryobj = new Smart_stats_model();
        
        $sql = "SELECT * FROM smart_stats WHERE serial_number = '$serial_number' ORDER BY disk_number";
        
        $smart_stats_tab = $queryobj->query($sql);

        // Add the temperature type to the object for the client tab
        $array_id = (count($smart_stats_tab) -1 );
        while ($array_id > -1) {
             $smart_stats_tab[$array_id]->temperature_unit = conf('temperature_unit');
             $array_id--;
        }
        
        $obj = new View();
        $obj->view('json', array('msg' => current(array('msg' => $smart_stats_tab)))); 
    }

    public function get_smart_stats()
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }
        
        $smart_stats_report = new Smart_stats_model;
        $obj->view('json', array('msg' =>$smart_stats_report->getSmartStats()));
    }


	/**
     * Retrieve data in json format
     *
     **/
    function get_data($serial_number = '')
    {
        $obj = new View();

        if( ! $this->authorized())
        {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }

        $smart_stats = new Smart_stats_model($serial_number);
        $obj->view('json', array('msg' => $smart_stats->rs));
    }
} // END class Smart_stats_controller
