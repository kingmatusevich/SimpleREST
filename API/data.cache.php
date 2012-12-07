<?php
include_once('error.debug.php');
include_once('global.vars.php');
class Cache
{
	protected $expiration;
	protected $format;
	protected $enabled;
	public function __construct($enabled = true, $expiration = 300, $format = 'json')
	{
		$this->enabled = $enabled;
		$this->format = $format;
		$this->expiration = $expiration;
	} 
	public function isExpired($query)
	{
		if (!$this->enabled)
		{
			return true;
		} else
		{
			$last = filemtime('/API/cache/'.md5($query).'.cache');
			if ($last)
			{
				$dif = time() - $last;
				if ($dif > $this->expiration)
				{
					return true;
				} else return false;
			} else return true;
		}
	}
	public function data($query)
	{
		$data = file_get_contents('/API/cache/'.md5($query).'.cache');
		if ($this->enabled && $data) 
		{
			return $data;
		} else return false;
	}
	public function setData($query, $data)
	{
		if ($this->enabled && $query && $data)
		{
			file_put_contents('/API/cache/'.md5($query).'.cache', $data);
			return true;
		} else return false;
	}
}
?>