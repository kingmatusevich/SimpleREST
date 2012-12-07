<?php
include_once('error.debug.php');
include_once('global.vars.php');

class Database
{
	protected $mysql;
	protected $name;
	protected $connected;
	protected $settings;
	protected $debug;
	public function __construct($name, $dbSettings)
	{
		$this->connected = false;
		$this->settings = $dbSettings;
		$this->name = $name;
		$this->debug = new Debug(true);
	}
	public function __destruct()
	{
		$this->disconnect();
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
		$this->connected = false;
	}
	public function query($query)
	{
		if ($query)
		{
			$this->connect();
			mysqli_query($this->mysql, $query);

		}

	}
	public function arrayWithQuery($query)
	{
		$this->connect();
		$result = mysqli_query($this->mysql, $query);
		if ($result)
		{
			while($rows[] = mysqli_fetch_assoc($result));
			array_pop($rows);

			return $rows;
		} 
		else
		{
			$this->debug->message(mysqli_error($this->mysql));
		}

		
	}
}
?>