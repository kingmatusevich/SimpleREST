<?php 
include_once('error.debug.php');
class RESTParser
{
	protected $queryString;
	protected $components;
	protected $current;
	protected $debug;
	public function __construct($query, $debug = false)
	{
		$this->queryString = $query;
		$this->components = array_filter(explode('/', $this->queryString));
		$this->current = 1;
		$this->debug = new Debug($debug);
		$this->debug->message($this->queryString);
	}
	public function getQueryString()
	{
		return $queryString;
	}
	public function nextBlock()
	{
		// return current block and trim it from remaining query string
		$tmp = $this->components[$this->current];
		$this->current++;
		return $tmp;
		
	}
	public function isEmpty()
	{
		// Do logic here
		$comp = count($this->components);
		$curr = $this->current;

		if ($curr <= $comp)
		{
			return false;
		} else return true;
		

	}
}
?>