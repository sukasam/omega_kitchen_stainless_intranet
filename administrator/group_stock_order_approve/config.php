
<?php 
	$PK_field = "sub_id";
	//$FR_field = "";
	$check_module = "อนุมัติรับเข้าสต็อก/สินค้าสำเร็จรูป";
	$page_name = "อนุมัติรับเข้าสต็อกสินค้าสำเร็จรูป";
	$tbl_name = "s_group_stock_order_bill";
	$field_confirm_showname= "sub_name";
	$fieldlist = array('sub_name','sub_address','sub_tel','sub_billnum','sub_billdate','sub_comment','sub_vat','stock_date','st_setting','approve','stock_admin','stock_approve');
	$search_key = array('sup_name','sub_address','sup_tel','sub_billnum','sub_billdate','stock_date');
	$pagesize = 50;
	$pages="รายการรับเข้าสต็อคสินค้าสำเร็จรูป";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />