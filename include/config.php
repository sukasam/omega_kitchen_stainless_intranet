<?php    
ob_start();
@session_start();
error_reporting(0);
$cookie_time = time() + (3600 * 24 * 15) ;
$s_title="Omega Intranet";
define("S_TITLE","Omega Kitchen Intranet");
define("S_DOMAIN","http://localhost/");
define("S_PATHS","omega_kitchen_intranet/");
define("S_IMAGES","images/");
?>
