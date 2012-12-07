<?php
include_once('rest.api.php');
$globalDebugEnabled = false;		
$API = new RESTAPI(true);			
$API->start();						
$sysDebug = new Debug(true);
?>
