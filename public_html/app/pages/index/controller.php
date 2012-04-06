<?php

class App_Pages_Index_Controller extends Pf_Core_Controller
{
	public function index()
	{
		$submissionsMdl = new App_Models_Submissions();
		$latestRegionSubmissions = $submissionsMdl->findMultiple('region',$locations[0]['region_name'],5);
		$latestSubmissions = $submissionsMdl->selectLatest(10);

		$this->view->render(array('latestSubmissions'=>$latestSubmissions));
	}		
}

?>
