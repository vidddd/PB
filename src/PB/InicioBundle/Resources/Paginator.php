<?php
namespace PB\InicioBundle\Resources;

class Paginator {

//current displayed page
protected $currentpage;
//limit items on one page
protected $limit;
//total number of pages that will be generated
protected $numpages;
//total items loaded from database
protected $itemscount;
//starting item number to be shown on page
protected $offset;
//pages to show at left and right of current page
protected $mid_range;
//range initial page
protected $start_range;
//range end page
protected $end_range;

function __construct($itemsCount, $currentPage = 1, $limit = 20, $midRange = 7)
{
	//set total items count from controller
	$this->itemsCount = $itemsCount;
	$this->currentPage = $currentPage;
	$this->limit = $limit;
	$this->midRange= $midRange;

	//Set defaults
	$this->setDefaults();

	//Calculate number of pages total
	$this->getInternalNumPages();

	//Calculate first shown item on current page
	$this->calculateOffset();
	$this->calculateRange();
}

private function calculateRange()
{
	$startRange = $this->currentPage - floor($this->midRange/2);
	$endRange = $this->currentPage + floor($this->midRange/2);

	if($startRange <= 0)
	{
		$endRange += abs($startRange)+1;
		$startRange = 1;
	}

	if($endRange > $this->numPages)
	{
		$startRange -= $endRange-$this->numPages;
		$endRange = $this->numPages;
	}

	$this->range = range($startRange, $endRange);
}

private function setDefaults()
{
	//If currentPage is set to null or is set to 0 or less
	//set it to default (1)
	if ($this->currentPage == null || $this->currentPage < 1)
	{
		$this->currentPage = 1;
	}
	//if limit is set to null set it to default (20)
	if ($this->limit == null)
	{
		$this->limit = 20;
		//if limit is any number less than 1 then set it to 0 for displaying
		//items without limit
	}
	else if ($this->limit < 1)
	{
		$this->limit = 0;
	}
}

private function getInternalNumPages()
{
	//If limit is set to 0 or set to number bigger then total items count
	//display all in one page
	if ($this->limit < 1 || $this->limit > $this->itemsCount)
	{
		$this->numPages = 1;
	}
	else
	{
		//Calculate rest numbers from dividing operation so we can add one
		//more page for this items
		$restItemsNum = $this->itemsCount % $this->limit;
		//if rest items > 0 then add one more page else just divide items
		//by limit
		$this->numPages = $restItemsNum > 0 ? intval($this->itemsCount / $this->limit) + 1 : intval($this->itemsCount / $this->limit);
	}
}


private function calculateOffset() {
   //Calculet offset for items based on current page number
   $this->offset = ($this->currentpage - 1) * $this->limit;
}

public function getCurrentpage() {
   return $this->currentpage;
}

public function getCurrentUrl() {
   return $this->currentUrl;
}

   //For using from controller
public function getLimit() {
   return $this->limit;
}
//For using from controller
public function getOffset() {
   return $this->offset;
}

public function getRange()
{
   return $this->range;
}

public function getMidRange()
{
   return $this->mid_range;
}

}




