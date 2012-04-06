<?php
/**
 * Plaxform Rapid Development Framework
 * Copyright (c) 2008, Andory Internet Ventures (http://www.andory.com)
 */

/**
 * Benchmarking class
 * 
 * This class is used for benchmarking and timing processes
 */
class Pf_Tools_Benchmark
{
    /**
     * The marks/times for different processes
     *
     * @access private
     * @var array $marks An array of: array("start", "stop");
     */
    private $marks = null;
    
    /**
     * Constructor for the benchmark object
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->marks = array();
    }
    
    /**
     * Starts the benchmark for a given process
     *
     * @access public
     * @param string $name The name of the process
     * @return void
     */
    public function start($name)
    {
        if (isset($this->marks[$name]) == false) {
            $this->marks[$name] = array(
                "start" => microtime(true),
                "stop" => null
            );
        }
    }
    
    /**
     * Stops the benchmark for a given process
     *
     * @access public
     * @param string $name The name of the process
     * @return void
     */
    public function stop($name)
    {
        if (isset($this->marks[$name]) == true && 
            isset($this->marks[$name]["stop"]) == false ) {
            
            $this->marks[$name]["stop"] = microtime(true);
        }
    }
    
    /**
     * Returns the time of a process
     *
     * @access public
     * @param string $name The name of the process
     * @param int $decimals Number of decimals to round to
     * @return double The benchmark time for the process
     */
    public function get($name, $decimals = 4)
    {
        if (isset($name) == true) {
            /* Make sure that the mark exists and it has been started */
            if (isset($this->marks[$name]) == true &&
                    isset($this->marks[$name]["start"]) == true) {
                    
                /* If it hasn't been stopped yet, stop it */
                if(isset($this->marks[$name]["stop"]) == false) {
                    $this->stop($name);
                }
                
                /* Get the time difference and return */
                return number_format(
                        $this->marks[$name]["stop"] - $this->marks[$name]["start"],
                        $decimals
                    );                
            }        
        }
        
        return void;
    }

}

?>
