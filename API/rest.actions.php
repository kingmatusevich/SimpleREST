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
		protected function debug()
		{
			echo 'debug </br>';
			while (!$this->RESTParser->isEmpty())
			{
				echo $this->RESTParser->nextBlock().'</br>';
			}
		}
	}
}
?>