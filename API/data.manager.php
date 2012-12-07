<?php
include_once('error.debug.php');
include_once('data.object.php');
class Users extends DataObject
{
	public function __construct()
	{
		parent::__construct('json', false, 300, true);
		$this->name = 'users';
	}
	public function attemptLogin($user, $password)
	{
		if ($user && $password)
		{
			$user = mysql_escape_string($user);
			$password = mysql_escape_string($password);
			$query = 'SELECT * FROM'
		}
	}
}



class DataManager
{
	protected $debug;
	public $users;
	public $news;
	public $sessions;
	public function __construct($debug = false)
	{
		$this->debug = new Debug($debug);
		$this->users = new Users('json', false, 300, true);
	}
	
	
	
	
}
?>