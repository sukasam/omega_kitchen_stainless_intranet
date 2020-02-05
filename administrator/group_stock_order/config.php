
<?php    
	$PK_field = "group_id";
	//$FR_field = "";
	$check_module = "รายการสินค้าสำเร็จรูป";
	$page_name = "รายการสินค้าสำเร็จรูป";
	$tbl_name = "s_group_stock_order";
	$field_confirm_showname= "group_name";
	$fieldlist = array('group_spar_id','group_name','group_sn','group_category','group_namecall','group_size','group_unit_price','group_price','typespar');
	$search_key = array('group_spar_id','group_name','group_sn','group_category','group_namecall','group_size');
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />