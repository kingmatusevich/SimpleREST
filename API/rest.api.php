<?php
include_once('rest.parser.php');
include_once('error.debug.php');
class RESTAPI
{
	protected $queryString;
	protected $RESTParser;
	protected $currentBlock;
	protected $debug;
	public function __construct($debug = false)
	{
		$this->queryString = $_SERVER['QUERY_STRING'];
		$this->RESTParser = new RESTParser($this->queryString, $debug);
		$this->debug = new Debug($debug);
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