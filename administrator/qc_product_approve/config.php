
<?php    
	$PK_field = "sr_id";
	//$FR_field = "";
	$check_module = "อนุมัติใบตรวจสินค้าสำเร็จรูป";
	$page_name = "Approve Finished Goods Sheet (ใบตรวจสินค้าสำเร็จรูป)";
	$tbl_name = "s_qc_product";
	$field_confirm_showname= "cus_id";
	$fieldlist = array('cus_id','sv_id','sr_id2','sv_id2','srid','sr_ctype','sr_ctype2','job_open','job_close','job_balance','sr_stime','loc_contact2','loc_contact3','cs_sell','detail_recom','approve','supply','st_setting','loc_date2','sell_date','loc_date3',"search_fo","pro_list","images1","images2","images3","chkpro1","chkpro2","chkpro3","chkpro4","chkpro5","chkpro6","chkpass1","chkpass2","chkpass3","chkpass4","chkpass5","chkpass6");
	$search_key = array("sv_id");
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />