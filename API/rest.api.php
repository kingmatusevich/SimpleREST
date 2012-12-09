<?php
include_once('rest.parser.php');
include_once('error.debug.php');
include_once('data.manager.php');
class RESTAPI extends RESTObject
{
	public function __construct($list = false, $parameter = false, $parser = false, $debug = false)
	{
		parent::_construct($list, false, $parser, $debug);
	}
}