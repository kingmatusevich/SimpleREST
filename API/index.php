<?php
include_once('error.debug.php');	// Already included inside rest.api, included for documentation
include_once('rest.parser.php');	// Already included inside rest.api, included for documentation
include_once('rest.api.php');		// This includes rest.api, rest.parser, error.debug	
$globalDebugEnabled = false;		// Debugging of global errors in error.debug, default behaviour if not specified is set to true

$API = new RESTAPI(true);		/////////////////////////////////////////////////////////////////////////////////////////////////	
					/* instantiation of rest.api with internal debugging set to true, this also sets the debugging of 
					the instance of rest.parser in rest.api to true. Default behaviour is false. Default behaviour of
					rest.parser if it were not set by rest.api is set to false. */
					/////////////////////////////////////////////////////////////////////////////////////////////////

$API->start();						//initiates the parsing and processing process inside the instantiated rest.api
?>