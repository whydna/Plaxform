<?php
class App_Tools_Pagination
{
    private $totalItems;
    private $itemsPerPage;
    private $currPage;
 	
    // $totalItems: total items in the set
    // $itemsPerPage: number of items displayed per page
    // $currPage: the current page number
    public function __construct($totalItems, $itemsPerPage, $currPage)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currPage = $currPage;
    }
 
    public function getLinksHtml($baseUrl, $pageVar)
    {
        $html = "";
 
        if ($this->hasPrev()) {
            $html .= '<a href="'.self::appendGetVar($baseUrl,$pageVar,$this->currPage-1).'">';
            $html .= 'Previous';
            $html .= '</a> ';
        }
        
        $startPageNum = ($this->currPage-5 >= 1) ? $this->currPage-5 : 1;
        $endPageNum = ($this->currPage+5 <= $this->getNumPages()) ? $this->currPage+5 : $this->getNumPages(); 
        for($i=$startPageNum; $i<=$endPageNum; $i++) {
            if ($i != $this->currPage) {
                $html .= ' <a href="'.self::appendGetVar($baseUrl,$pageVar,$i).'">'.$i.'</a> ';
            } else {
                $html .= ' '.$i.' ';
            }
        }
 
        if ($this->hasNext()) {
            $html .= ' <a href="'.self::appendGetVar($baseUrl,$pageVar,$this->currPage+1).'">';
            $html .= 'Next';
            $html .= '</a>';
        }
 
        return $html;
    }
 
    public function hasPrev()
    {
        if ($this->currPage > 1) {
            return true;
        } else {
            return false;
        }
    }
 
    public function hasNext()
    {
        if ($this->currPage < $this->getNumPages()) {
            return true;
        } else {
            return false;
        }
    }
 
    public function getNumPages()
    {
        $numPages = ceil($this->totalItems/$this->itemsPerPage);
 
        return $numPages;
    } 
	
	private static function appendGetVar($url, $varName, $value) 
	{
		// check if there are already GET variables in the url
		if (strpos($url, "?") === false) {
			// no get vars found
			$url .= "?".$varName."=".$value;
		} else {
			$url .= "&".$varName."=".$value;
		}
		
		return $url;
	}
}
?>