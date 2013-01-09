<?php
include_once('error.debug.php');	//debugs
include_once('global.vars.php');	//stores $dbSettings, $globalDebugEnabled
include_once('data.cache.php');		//caches the results, object Cache
include_once('data.source.php'); 	//stores the Database object
class DataObject
{
	protected $debug;
	public $name;
	protected $format;
	protected $mysql;
	protected $cache;
	private function setFormat($format = 'json')
	{
		switch($format)
		{
			case 'json': $this->format = $format; break;
			case 'JSON': $this->format = 'json'; break;
			case 'XML': $this->format = $format; break; //experimental, not currently baked in
			case 'xml': $this->format = 'XML'; break; 	//experimental, not currently baked in
			default: $this->format = 'json';
		}
	}
	public function __construct($format = 'json', $cache = true, $expiration = 300, $debug = false)
	{
		global $dbSettings;
		//$dbSettings = array('host' => 'mysql16.000webhost.com', 'user' => 'a3584161_admin', 'password' => '5f5xqa', 'database' => 'a3584161_main');
		$this->setFormat($format);
		$this->debug = new Debug($debug);
		$this->cache = new Cache($cache, $expiration, $this->format);
		$this->mysql = new Database($name, $dbSettings);		
	}
	
	public function allItems()
	{
		$query = 'SELECT * FROM '.mysql_escape_string($this->name);
		if (!$this->cache->isExpired($query))
		{
			return $this->cache->data($query);
		} else
		{
			$array = $this->mysql->arrayWithQuery($query);
			$result;
			if ($this->format == 'json')
			{

				$result = json_encode($array);
				$this->cache->setData($query, $result);
			}
			return $result;
		}
	}
} 

?>