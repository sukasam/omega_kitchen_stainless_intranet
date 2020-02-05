
<?php    
	$PK_field = "sr_id";
	//$FR_field = "";
	$check_module = "ใบสั่งผลิตสินค้า";
	$page_name = "Order Product (ใบสั่งผลิตสินค้า)";
	$tbl_name = "s_order_product";
	$field_confirm_showname= "cus_id";
	$fieldlist = array('cus_id','sv_id','srid','sr_ctype','sr_ctype2','job_open','job_close','job_balance','sr_stime','loc_contact2','loc_contact3','cs_sell','detail_recom','approve','supply','st_setting','loc_date2','sell_date','loc_date3',"search_fo","pro_list");
	$search_key = array("sv_id","cd_name","loc_name");
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />