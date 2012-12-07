<?php
include_once('rest.parser.php');
include_once('error.debug.php');
include_once('data.manager.php');
class RESTAPI
{
	protected $queryString;
	protected $RESTParser;
	protected $currentBlock;
	protected $dataManager;
	protected $debug;
	public function __construct($debug = false)
	{
		$this->queryString = $_SERVER['QUERY_STRING'];
		$this->RESTParser = new RESTParser($this->queryString, $debug);
		$this->debug = new Debug($debug);
		$this->dataManager = new DataManager(true);
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
				case 'LOGIN':
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
		$user = $_POST['user'];
		$pwd = $_POST['password'];
		
		if ($user && $pwd)
		{
			$session = $this->dataManager->users->attemptLogin($user, $pwd);
			if ($session)
			{
				$this->debug->message($session);
				
			} else if ($session == false)
			{
				Error::send(3);
			}
		}
		
	}
	protected function news()
	{
		echo 'news';  // for debug only
	}
}