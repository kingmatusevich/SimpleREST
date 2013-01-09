<?php
include_once('error.debug.php');
include_once('data.object.php');
class TokenAdministrator extends DataObject
{
	public function __construct($debug = false)
	{
		parent::__construct('json', false, 300, $debug);
		$this->name = 'users';
	}
	public function allItems()
		{
			return false;
		}
	public function getToken($user, $password, $level)
		{
			if ($user && $password && $level)
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
					$query = "INSERT INTO sessions(token,epoch, user, level) VALUES('".$token."', ".time().", '".$user."', ".$level.")";
					$this->debug->message(time());
					$this->mysql->query($query);
					return $token;
				} else {$this->debug->message('returns false');return false;} 
			} else {$this->debug->message('returns false');return false;} 
		}
	public function verifyToken($token, $level)
		{
			$query= "SELECT * FROM sessions WHERE token='".mysql_escape_string($token)."'";
			$array = $this->mysql->arrayWithQuery($query);
			if ($array)
			{
				$l = count($array);
				$i = 0;
				$done = false;
				$max = -1; //means error
				while($i< $l && !$done)
					{
						$dif = time() - $array[$i]['epoch'];
						switch($array[$i]['level'])
							{
								case 0:
									$max = 1800;break;
								case 1:
									$max = -2; break;//means unlimited
								default:
									$max = -1;
							}
						if ($dif < $max)
							{
								$done = true;
							}
						else if ($max = -2)
							{
								$done = true;
							}
						else $done = false;	
						$i++;
					}
				return $done;
			}
		}
}

?> 