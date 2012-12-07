<?php
include_once('error.debug.php');

class DataManager
{
	protected $debug;
	
	public function __construct($debug = false)
	{
		$this->debug = new Debug($debug);
	}
	
	
	
	
}
?>