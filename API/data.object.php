<?php
include_once('error.debug.php');	//debugs
include_once('global.vars.php');	//stores $dbSettings, $globalDebugEnabled
include_once('data.cache.php');		//caches the results, object Cache
include_once('data.source.php'); 	//stores the Database object
class DataObject
{
	protected $debug;
	public $name;
	public $fields;
	protected $format;
	protected $mysql;
	protected $cache;
	private function setFormat($format = 'json')
	{
		if ($format == 'json')
		{
			$this->format = $format;
		} else if ($format == 'XML')
		{
			$this->format = $format;
		} else 
		{
			$this->format = 'json';
		}
		
	}
	protected function fieldsInitialization() // This has to be overriden by subclassing it.
	{
		$this->fields = array();
	}
	public function __construct($format = 'json', $cache = true, $expiration = 300, $debug = false)
	{
		global $dbSettings;
		$this->setFormat($format);
		$this->debug = new Debug($debug);
		$this->cache = new Cache($cache, $expiration, $this->format);
		
		$this->fieldsInitialization();
		$this->mysql = new Database($name, $fields, $dbSettings);		
	}
	
	public function allItems()
	{
		$query = 'SELECT * FROM '.mysql_escape_string($this->name);
		if (!$cache->isExpired())
		{
			return $cache->data($query);
		} else
		{
			$array = $this->mysql->arrayWithQuery($query);
			$result;
			if ($this->format == 'json')
			{
				$result = json_encode($array);
				$cache->setData($query, $result);
			}
			return $result;
		}
	}
} 

?>