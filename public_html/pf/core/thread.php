<?php
// Currently only works in Unix servers
// Requires PHP5
class Pf_Core_Thread
{
	// path to the controller to execute as seperate thread
	private $controllerUrl;
	private $arguments;
	// reference to the process (unix process id)
	private $processId;
	
	public function __construct($controllerUrl)
	{	
		$this->controllerUrl = $controllerUrl;
		$this->processId = null;
	}
	
	// Executes the process in a seperate thread.
	// Will not do anything if the process is already started.
	public function start()
	{
		if ($this->isRunning() == false) {
			// run silently in background
			$cmd = 'wget '.$this->controllerUrl;
			$cmd .= ' > /dev/null 2>&1 & echo $!';
			
			exec($cmd, $output);
			
			// get and store the process id
			$this->processId = $output[0];
		}
	}
	
	//Stops a process. If the process is not running will not do anything.
	public function stop()
	{	
		if ($this->isRunning() == true) {
			$cmd = 'kill '.$this->processId;
			exec($cmd, $output);
		}
	}
	
	public function forceStop()
	{	
		if ($this->isRunning() == true) {
			$cmd = 'kill -9 '.$this->processId;
			exec($cmd, $output);
		}
	}

	public function isRunning()
	{	
		if ($this->processId != null) { 
			$cmd = 'ps ax | grep '.$this->processId.' 2>&1';
			exec($cmd, $output);
			
			foreach($output as $row) {
				$rowArray = explode(' ', trim($row));
				$checkProcessId = $rowArray[0];
				
				if ($this->processId == $checkProcessId) {
					return true;
				}	
			}
		}
		return false;
	}
	
	/*	
	public static function getRunningProcesses()
	{
		$cmd = "ps -ef";
		exec($cmd, $output);
		return $output;
	}
	*/
}

?>