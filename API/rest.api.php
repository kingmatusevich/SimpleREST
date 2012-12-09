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
		$this->dataManager = new DataManager($debug);
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
	protected function getSession()
	{
		$user = $_POST['user'];
		$password = $_POST['password'];
		if ($user && $password)
		{
			$session = $this->dataManager->users->attemptLogin($user, $password);
			if ($session)
			{
				header('Content-Type: application/json');
				echo json_encode(array('session' => $session));
			} else
			{
				header('WWW-Authenticate: Negotiate');
				Error::send(3);
			}
		} else
		{
			header('WWW-Authenticate: Negotiate');
			Error::send(3);
		}
	}
	protected function session()
	{
		if (!$this->RESTParser->isEmpty())
		{
			$this->currentBlock = $this->RESTParser->nextBlock();
			switch($this->currentBlock)
			{
				case 'GET':
				$this->getSession(); break;
				default:
				Error::send(0);
			}
		} else Error::send(1);
	}
	protected function getAllUsers()
	{
		$users = $this->dataManager->users->allItems();
		if ($users)
		{
			header('Content-Type: application/json');
			echo json_encode($users);
		} else Error::send(DatabaseError);
	}
	protected function users()
	{
		if (!$this->RESTParser->isEmpty())
		{
			$this->currentBlock = $this->RESTParser->nextBlock();
			switch($this->currentBlock)
			{
				case 'GET':
				$this->getAllUsers(); break;
				default:
				Error::send(0);
			}
		} else Error::send(1);
	}
	protected function authentification()
	{
		if (!$this->RESTParser->isEmpty())
		{
			$this->currentBlock = $this->RESTParser->nextBlock();
			switch($this->currentBlock)
			{
				case 'session':
				$this->session(); break;
				case 'users':
				$this->users(); break;
				default:
				Error::send(0);
			}
		} else Error::send(1);
	}
	protected function news()
	{
		echo 'news';  // for debug only
	}
}