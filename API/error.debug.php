<?php 
const InvalidQuery = 0;
const NullQuery = 1;
const InvalidError = 2;
const ValidationError = 3;
const DatabaseError = 4;
$globalDebugEnabled = true;
class Error
{
	protected static $errors = array(0 => 'Invalid query',1 => 'Null query', 2 => 'Invalid Error', 3 => 'Validation Error', 4 => 'Database Error');
	
	public static function send($i)
	{
		if(array_key_exists($i, self::$errors))
		{
			Debug::globalError($i);
		}
		else
		{
			Debug::globalError(2);
		}
	}
	

}
class Debug extends Error
{
	protected $enabled;

	protected static function isEnabledGlobally()
	{
		global $globalDebugEnabled;
		return $globalDebugEnabled;
	}
	public static function send($i)
	{
		$this->warning('send is not enabled in DEBUG');
	}
	public function __construct($state)
	{
		$this->enabled = $state;
		
	}
	public function enable()
	{
		$this->enabled = true;
	}
	public function disable()
	{
		$this->enabled = false;
	}
	protected function isEnabled()
	{
		return $this->enabled;
	}
	public function message($string)
	{
		if ($this->isEnabled() && $string)
		{
			echo '</br>'.'message: '.$string.'</br>';
		}
	}
	public function error($int)
	{
		if ($this->isEnabled() && array_key_exists($int, self::$errors))
		{
			echo '</br>'.'error '.$int.': '.self::$errors[$int].'</br>';
		} else if ($this->isEnabled() && !array_key_exists($int, self::$errors))
		{
			echo '</br>'.'error '.$int.': '.self::$errors[2].'</br>';
		}
	}
	public function warning($string)
	{
		if ($this->isEnabled() && $string)
		{
			echo '</br>'.'warning: '.$string.'</br>';
		}
	}
	
	public static function globalMessage($string)
	{
		if (self::isEnabledGlobally() && $string)
		{
			echo '</br>'.'message: '.$string.'</br>';
		}
	}
	public static function globalError($int)
	{
		if (self::isEnabledGlobally() && array_key_exists($int, self::$errors))
		{
			echo '</br>'.'error '.$int.': '.self::$errors[$int].'</br>';
		} else if (self::isEnabledGlobally() && !array_key_exists($int, self::$errors))
		{
			echo '</br>'.'error '.$int.': '.self::$errors[2].'</br>';
		}
	}
	public static function globalWarning($string)
	{
		if (self::isEnabledGlobally() && $string)
		{
			echo '</br>'.'warning: '.$string.'</br>';
		}
	}
}
?>