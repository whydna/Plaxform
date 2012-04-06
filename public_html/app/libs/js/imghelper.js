function ImgHelper()
{
}

ImgHelper.calcResize = function(width, height, maxWidth, maxHeight, html)
{
	var newDims = new Array();
	
    var wRatio = width / maxWidth;
    var hRatio = height / maxHeight;
    var maxRatio = Math.max(wRatio, hRatio);
    
    if (maxRatio > 1) {
        newDims['width'] = Math.round(width / maxRatio);
        newDims['height'] = Math.round(height / maxRatio);
    } else {
        newDims['width'] = width;
        newDims['height'] = height;
    }
    
    if (html==true) {
    	return 'width="'+newDims['width']+'" height="'+newDims['height']+'"';
    } else {
    	return newDims;
    }
};



