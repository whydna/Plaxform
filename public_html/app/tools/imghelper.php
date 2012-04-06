<?php
class App_Tools_ImgHelper
{
	// Resizes an image proportionally.
	// $html: if set to true, will return string for use in HTML <img> tag
	public static function calcResize($width, $height, $maxWidth, $maxHeight, $html = false)
	{
		$newDims = array();
		
		if ($width == 0 || $height == 0) {
			// if not enough data is provided to resize proportionately,
			// force the resize.
			$newDims['width'] = $maxWidth;
			$newDims['height'] = $maxHeight;
		} else {			
		    $wRatio = $width / $maxWidth;
		    $hRatio = $height / $maxHeight;
		    $maxRatio = max($wRatio, $hRatio);
		    
		    if ($maxRatio > 1) {
		        $newDims['width'] = round($width / $maxRatio);
		        $newDims['height'] = round($height / $maxRatio);
		    } else {
		        $newDims['width'] = $width;
		        $newDims['height'] = $height;
		    }
		}
	    
	    if ($html) {
	    	return 'width="'.$newDims['width'].'" height="'.$newDims['height'].'"';
	    } else {
	    	return $newDims;
	    }
	}
	
	public static function getImageType($imageFilePath) 
	{
		switch(exif_imagetype($imageFilePath)) {
			case(1):
				return "gif";
				break;
			case(2):
				return "jpg";
				break;
			case(3):
				return "png";
				break;
			default:
				return -1;
				break;
		}
	}
	
}