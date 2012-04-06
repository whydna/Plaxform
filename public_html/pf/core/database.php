<?php
// Implements the singleton pattern
class Pf_Core_Database extends PDO
{
	private static $instance = null;
    
    public static function getInstance()
    {
          if (!isset(self::$instance)) {
              self::$instance = new Pf_Core_Database();
          }

          return self::$instance;
    }
	
	public function __construct()
	{		
		$config = parse_ini_file('./config.ini',true);
		
		try {
			parent::__construct(
					"mysql:host=".$config['mysql']['host'].";dbname=".$config['mysql']['database'],
	            	$config['mysql']['user'], 
	            	$config['mysql']['password']
				);
		} catch (Exception $e) {
			// throw our own exception (PDO's exception gives away way too much info)
			throw new Exception('Could not connect to database.');
		}
		//parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
}

?>