<?php
include_once('rest.parser.php');
include_once('error.debug.php');
include_once('data.manager.php');
include_once('rest.objects.php');
class RESTAPI extends RESTObject
{
	public function __construct($list = false, $parameter = false, $parser = false, $debug = false)
	{
		parent::__construct($list, false, $parser, $debug);
	}
}