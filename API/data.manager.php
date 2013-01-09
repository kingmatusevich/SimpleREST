<?php
include_once('error.debug.php');
include_once('data.object.php');
include_once('token.admin.php');
class Users extends DataObject
{
	protected $TokenAdmin;
	public function __construct($debug = false)
	{
		parent::__construct('json', false, 300, $debug);
		$this->name = 'users';
		$this->TokenAdmin = new TokenAdministrator($debug);
	}
	public function attemptLogin($user, $password)
	{
		return $this->TokenAdmin->getToken($user, $password, 0);
	}
	
	public function allUsers($token)
	{
		if($this->TokenAdmin->verifyToken($token, 0))
			{
				$res = $this->allItems();
				return $res;
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
		$this->users = new Users($debug);
	}
	
	
	
	
}
?>