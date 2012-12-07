<?php
include_once('error.debug.php');
include_once('global.vars.php');

class Database
{
	protected $mysql;
	protected $name;
	protected $connected;
	protected $settings;
	public function __construct($name, $dbSettings)
	{
		$this->connected = false;
		$this->settings = $dbSettings;
		$this->name = $name;
	}
	public function connect()
	{
		if (!$this->connected)
		{
			$this->mysql = mysqli_connect($this->settings['host'], $this->settings['user'], $this->settings['password'], $this->settings['database']);
			$this->connected = true;
		} else return true;
	}
	public function disconnect()
	{
		if ($this->connected) mysqli_close($this->mysql);
	}
	public function arrayWithQuery($query)
	{
		$this->connect();
		$result = mysqli_query($this->mysql, $query);
		while($rows[] = mysqli_fetch_assoc($result));
		array_pop($rows);
		$this->disconnect();
		return $rows;
		
	}
}
?>