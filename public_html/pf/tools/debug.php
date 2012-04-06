<?php
class Pf_Tools_Debug
{
	public function __construct()
	{
	}
	        
	// prints cleanly an array or structure to the screan
    // useful for debugging
    public function printStruct($struct, $die = false)
    {
        echo '<pre>';
        print_r($struct);
        echo '</pre>';
        if ($die == true) {
            die();
        }
    }
    
    public function printLine($string, $die = false)
    {
    	echo $string,'<br/>';
       	if ($die == true) {
            die();
        }
    }
    
    public function printConsoleLine($string, $die = false)
    {
       	echo $string,"\n\r";
       	if ($die == true) {
            die();
        }
    }
    
    public function debugPrintStruct($struct, $die = false)
    {
    	if ($this->isDebugModeOn()) {
    		$this->printStruct($struct, $die);
    	}
    }
    
    public function debugPrintLine($string, $die = false)
    {
    	if ($this->isDebugModeOn()) {
    		$this->printLine($string, $die = false);
    	}
    }
    
    // returns true if currently in debug mode, false otherwise
    private function isDebugModeOn()
    {
		if (defined(PF_DEBUG_ON)) {
			return true;
		}
		return false;
    }
}

?>