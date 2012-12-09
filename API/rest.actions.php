<?php
php_include('rest.object.php');
class RESTAction extends RESTObject()
{
	public function start()
	{
		return false;
	}
}

class DebugAction extends RESTAction()
{
	public function start()
	{
			echo 'debug </br>';
			while (!$this->RESTParser->isEmpty())
			{
				echo $this->RESTParser->nextBlock().'</br>';
			}
	}
}

class SessionGETAction extends RESTAction()
{
	public function start()
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
}

class UsersGETAction extends RESTAction()
{
	public function start()
	{
		$users = $this->dataManager->users->allItems();
		if ($users)
		{
			header('Content-Type: application/json');
			echo json_encode($users);
		} else Error::send(DatabaseError);
	}
}
?>