
<?php    
	$PK_field = "fo_id";
	//$FR_field = "";
	$check_module = "First Order";
	$page_name = "First Order";
	$tbl_name = "s_first_order";
	$field_confirm_showname= "group_name";
	$fieldlist = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id','r_id','garun_id','date_forder','cg_type','ctype','pro_type','pro_pod1','pro_pod2','pro_pod3','pro_pod4','pro_pod5','pro_pod6','pro_pod7','pro_sn1','pro_sn2','pro_sn3','pro_sn4','pro_sn5','pro_sn6','pro_sn7','po_id','c_contact','c_tel','loc_name','loc_address','loc_shopping','shipS1','shipS2','shipS3','shipS4','shipS5','shipL1','shipL2','shipL3','shipL4','shipL5','warter01','warter02','warter03','warter04','warter05','warter06','warter07','cpro1','cpro2','cpro3','cpro4','cpro5','cpro6','cpro7','camount1','camount2','camount3','camount4','camount5','camount6','camount7','cprice1','cprice2','cprice3','cprice4','cprice5','cprice6','cprice7','cs_sign','ccomment','cs_pro1','cs_pro2','cs_pro3','cs_pro4','cs_pro5','cs_amount1','cs_amount2','cs_amount3','cs_amount4','cs_amount5','date_quf','date_qut','qucomment','cs_contact','cs_tel','cs_ship','cs_setting','cs_company','cs_sell','cs_aceep','remark','st_setting','separate','cusid','money_garuntree','money_setup','notvat1','notvat2','feeder','feeder_type','feeder_type2','feeder_type3','feeder_type4','feeder_type5','feeder_type6','service_type','status_use','status','sign_date1','sign_date2','sign_date3','approve','approve2');
	$search_key = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id','r_id','garun_id','cg_type','ctype','pro_type','po_id','c_contact','c_tel','loc_name','loc_address','loc_shopping','cusid');
	$pagesize = 50;
	$pages="First Order";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');

/*ALTER TABLE `s_first_order` ADD `feeder_type3` VARCHAR(100) NOT NULL AFTER `feeder_type2`, ADD `feeder_type4` VARCHAR(100) NOT NULL AFTER `feeder_type3`, ADD `feeder_type5` VARCHAR(100) NOT NULL AFTER `feeder_type4`, ADD `feeder_type6` VARCHAR(100) NOT NULL AFTER `feeder_type5`;

ALTER TABLE `s_first_order` ADD `shipS` VARCHAR(20) NOT NULL AFTER `loc_shopping`, ADD `shipL1` VARCHAR(255) NOT NULL AFTER `shipS`, ADD `shipL2` VARCHAR(255) NOT NULL AFTER `shipL1`, ADD `shipL3` VARCHAR(255) NOT NULL AFTER `shipL2`, ADD `shipL4` VARCHAR(255) NOT NULL AFTER `shipL3`, ADD `shipL5` VARCHAR(255) NOT NULL AFTER `shipL4`;
*/
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />