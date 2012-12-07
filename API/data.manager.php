<?php
include_once('error.debug.php');
include_once('data.object.php');
class Users extends DataObject
{
	public function __construct($debug = false)
	{
		parent::__construct('json', false, 300, $debug);
		$this->name = 'users';
	}
	public function attemptLogin($user, $password)
	{
		if ($user && $password)
		{
			$user = mysql_escape_string($user);
			$password = mysql_escape_string($password);
			$hash = sha1('elvelozmurcielagocomekiwi'.$user.$password);
			$this->debug->message('hash: '.$hash);
			$query = 'SELECT * FROM '.mysql_escape_string($this->name)." WHERE user='".$user."' AND password='".$hash."'";
			if ($this->mysql->arrayWithQuery($query))
			{
				$this->debug->message('has a match');
				$token = sha1('enuncampodearroz'.sha1('elvelozmurcielagocomekiwi'.$user.$password).sha1(time()));
				$query = "INSERT INTO sessions(token,epoch) VALUES('".$token."', ".time().")";
				$this->debug->message(time());
				$this->mysql->query($query);
				return $token;
			} else {$this->debug->message('returns false');return false;} 
		} else {$this->debug->message('returns false');return false;} 
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