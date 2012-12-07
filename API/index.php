<?php
include_once('error.debug.php');
include_once('rest.api.php');
$globalDebugEnabled = true;

$API = new RESTAPI(true);
$API->start();
?>