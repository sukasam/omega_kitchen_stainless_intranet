
<?php  
	$PK_field = "fo_id";
	//$FR_field = "";
	$check_module = "Project Order Cost";
	$page_name = "Project Order Cost";
	$tbl_name = "s_project_order";
	$field_confirm_showname= "group_name";
	$fieldlist = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id','r_id','date_forder','cg_type','ctype','pro_type','po_id','c_contact','c_tel','loc_name','loc_address','loc_shopping','systemH','systemHName','systemHTel','systemG','systemGName','systemGTel','shipS1','shipS2','shipS3','shipS4','shipS5','shipL1','shipL2','shipL3','shipL4','shipL5','cs_sign','ccomment','date_quf','date_qut','qucomment','cs_contact','cs_tel','cs_ship','cs_setting','cs_company','cs_sell','cs_aceep','remark','st_setting','separate','cusid','money_garuntree','money_setup','notvat1','notvat2','feeder','feeder_type','feeder_type2','service_type','status_use','discount','status');
	$search_key = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id','r_id','cg_type','ctype','pro_type','po_id','c_contact','c_tel','loc_name','loc_address','loc_shopping','cusid');
	$pagesize = 50;
	$pages="First Order";

	$fieldlist2 = array('shipC1','shipC2','shipC3','shipC4','shipC5','shipC6','shipC7','shipC8','shipM1','shipM2','shipM3','shipM4','shipM5','shipM6','shipM7','shipM8','shipM9','shipL1','shipL2','shipL3','shipL4','shipL5','shipL6','shipL7','shipL8');

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />