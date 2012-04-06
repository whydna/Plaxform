<?php
/**
 * Plaxform Rapid Development Framework
 * Copyright (c) 2008, Andory Internet Ventures (http://www.andory.com)
 */

/**
 * Class for a basic logger
 * 
 * Used to log events onto a log file
 */
class Pf_Tools_Log
{
    /**
     * Define enums for the different types of events 
     *
     * @access private
     * @var array $types
     */
    private $types = null;
    
    /**
     * An array of the event log messages
     *
     * @access private
     * @var array $messages Array of ...
     */
    private $messages = null;
    
    /**
     * Path to the directory where logs are saved
     *
     * @access private
     * @var string $outputDir Path to the directory where logs are saved
     */
    private $outputDir = null;
        
    /**
     * Constructor
     *
     * @access public
     * @param string $outputDir Path to the directory where logs are saved
     * @return void
     */
    public function __construct($outputDir)
    {
    	$this->types = array("error", "debug", "info");    
        $this->messages = array();
        $this->outputDir = $outputDir;
    }
    
    /**
     * Adds a new event to the log
     *
     * @access public
     * @param int $type The type of message by enum (see $this->types)
     * @param string $msg The log message
     * @return void
     * 
     */
    public function add($type, $msg)
    {
    	
        $type = strtolower($type);

        if (in_array($type, $this->types) == false) {
            throw new Exception("Not a valid type of log message: " . $type);
        }
   
        $this->messages[$type][] = array(
            date("D M j G:i:s T Y"),
            $msg
        );
    }
    
    /**
     * Writes contents of log to a file
     *
     * @access public
     * @return void
     */
    public function write()
    {
        if (sizeof($this->messages) > 0) {
            /* file name is based on date */
            $fileName = date('Y-m-d') . ".log";
            $file = $this->outputDir . "/" . $fileName;
            
            /* loop through all messages to build the file output */
            $outputString = "";
            foreach ($this->messages as $type => $entries) {
                foreach ($entries as $entry) {
                	$date = $entry[0];
					$msg = $entry[1];
                    $outputString .= "[".$type."]"."[".$date."] - ".$msg."\n\r";
                }                
            }
            
            /* if file doesn't exist, create it */
            if (file_exists($file) == false) {
                touch($file);
                chmod($file, 0644);
            }
            
            /* append messages to the log file */
            file_put_contents($file, $outputString, FILE_APPEND);
            
            /* clear the current log since it is already in the file */
            $this->clear();
        }
    }
    
    /**
     * Clears the log
     *
     * @access public
     * @return void
     */
    public function clear()
    {
        unset($this->messages);
        $this->messages = array();
    }

}

?>
