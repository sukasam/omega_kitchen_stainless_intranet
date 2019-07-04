<?php   
	$conn = mysql_connect("localhost","root","") or die("connection to db fail");
	mysql_select_db("omega_kitchen_intranet");
	@mysql_query("SET NAMES UTF8")
	
	/*$conn = mysql_connect("localhost","sukasamc_sptools","sptools") or die("connection to db fail");
	mysql_select_db("sukasamc_sptools");
	@mysql_query("SET NAMES UTF8")*/
?>