<?php
class Error
{
	private static $errors = array(0 => 'Invalid or null query',1 => 'Undefined');
	
	public static function send($i)
	{
		if(array_key_exists($i, self::$errors))
		{
			echo self::$errors[$i];
		}
		else
		{
			
		}
	}
	

}
class RESTParser
{
	private $queryString;
	private $remainingQueryString;
	
	public function __construct($query)
	{
		$this->queryString = $query;
		//echo $this->queryString; // to be deleted, debug
	}
	public function getQueryString()
	{
		return $queryString;
	}
	public function nextBlock()
	{
		// return current block and trim it from remaining query string
	}
	public function isEmpty()
	{
		// Do logic here
		return true; // or return false
	}
}
class RESTAPI
{
	private $queryString;
	private $RESTParser;
	private $currentBlock;
	
	public function __construct()
	{
		$this->queryString = $_SERVER['QUERY_STRING'];
		$this->RESTParser = new RESTParser($this->queryString);
	}
	public function start()
	{
		if (!$this->RESTParser->isEmpty())
		{
			$this->currentBlock = $this->RESTParser->nextBlock();
			switch($this->currentBlock)
			{
				case 'API':
				$this->start; break;
				case 'auth':
				$this->authentification; break;
				case 'news':
				$this->news; break;
				default:
				Error::send(0);
			}
		} else
		{
			Error::send(0);
		}		
	}
	public function authentification()
	{
		
	}
	public function news()
	{
		
	}
}

$API = new RESTAPI();
$API->start();
?>