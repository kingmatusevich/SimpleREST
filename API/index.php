<?php
include_once('error.debug.php');	// Already included inside rest.api, included for documentation
include_once('rest.parser.php');	// Already included inside rest.api, included for documentation
include_once('rest.api.php');		// This includes rest.api, rest.parser, error.debug	
include_once('rest.objects.php');	
include_once('rest.actions.php');
include_once('global.vars.php');
////////////////////////////////////////////////////////////////////////
//SHARED OBJECTS
$queryString = $_SERVER['QUERY_STRING'];
$RESTParser = new RESTParser($queryString);

////////////////////////////////////////////////////////////////////////
//DEBUG
$debug = new DebugAction(array(), 'debug', $RESTParser);

////////////////////////////////////////////////////////////////////////
//USERS GET
$usersGET = new UsersGETAction(array(), 'GET', $RESTParser);

//USERS
$usersList = array($usersGET);
$users = new RESTObject($usersList, 'users', $RESTParser);

////////////////////////////////////////////////////////////////////////
//AUTH SESSION GET
$authSessionGET = new SessionGETAction(array(), 'GET');

//AUTH SESSION
$authSessionList = array($authSessionGET);
$authSession = new RESTObject($authSessionList, 'session', $RESTParser);

//AUTH
$authList = array($authSession);
$auth = new RESTObject($authList, 'auth', $RESTParser);

////////////////////////////////////////////////////////////////////////
//API
$APIList = array($auth, $users, $debug);
$API = new RESTAPI($APIList, false, $RESTParser, false);			

					/////////////////////////////////////////////////////////////////////////////////////////////////	
					/* instantiation of rest.api with internal debugging set to true, this also sets the debugging of 
					the instance of rest.parser in rest.api to true. Default behaviour is false. Default behaviour of
					rest.parser if it were not set by rest.api is set to false. */
					/////////////////////////////////////////////////////////////////////////////////////////////////

$API->start();	//initiates the parsing and processing process inside the instantiated rest.api
?>