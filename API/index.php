<?php
class Error
{
	protected static $errors = array(0 => 'Invalid query',1 => 'Null query', 2 => 'Invalid Error');
	
	public static function send($i)
	{
		if(array_key_exists($i, self::$errors))
		{
			echo self::$errors[$i];
		}
		else
		{
			echo self::$errors[2];
		}
	}
	

}
class RESTParser
{
	protected $queryString;
	protected $components;
	protected $current;
	public function __construct($query)
	{
		$this->queryString = $query;
		echo $query.'</br>';
		$this->components = array_filter(explode('/', $this->queryString));
		$this->current = 1;
		//echo $this->queryString; // to be deleted, debug
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
class RESTAPI
{
	protected $queryString;
	protected $RESTParser;
	protected $currentBlock;
	
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
			//echo '</br>'.$this->currentBlock.'</br>';
			switch($this->currentBlock)
			{
				case 'API':
				$this->start(); break;
				case 'auth':
				$this->authentification(); break;
				case 'news':
				$this->news(); break;
				case 'debug':
				$this->debug(); break;
				default:
				Error::send(0);
			}
		} else
		{
			Error::send(1);
		}		
	}
	protected function debug()
	{
		echo 'debug </br>';
		while (!$this->RESTParser->isEmpty())
		{
			echo $this->RESTParser->nextBlock().'</br>';
		}
	}
	protected function authentification()
	{
		echo 'authentification'; // for debug only

	}
	protected function news()
	{
		echo 'news';  // for debug only
	}
}

$API = new RESTAPI();
$API->start();
?>