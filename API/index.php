<?php

include_once('error.debug.php');
include_once('rest.parser.php');
include_once('rest.api.php');
$globalDebugEnabled = false;		
$API = new RESTAPI(true);									
$API->start();		

?>