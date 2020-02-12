<?php    
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST["mode"] <> "") { 
		
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		$a_sdate=explode("/",$_POST['date_forder']);
		$_POST['date_forder']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['cs_ship']);
		$_POST['cs_ship']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['cs_setting']);
		$_POST['cs_setting']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['date_quf']);
		$_POST['date_quf']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['date_qut']);
		$_POST['date_qut']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$_POST['ccomment'] = nl2br($_POST['ccomment']);
		$_POST['qucomment'] = nl2br($_POST['qucomment']);
		$_POST['remark'] = nl2br($_POST['remark']);
		
		$_POST['separate'] = 0;
		
		/*$_POST["cprice1"] = preg_replace("/,/","",$_POST["cprice1"]);
		$_POST["cprice2"] = preg_replace("/,/","",$_POST["cprice2"]);
		$_POST["cprice3"] = preg_replace("/,/","",$_POST["cprice3"]);
		$_POST["cprice4"] = preg_replace("/,/","",$_POST["cprice4"]);
		$_POST["cprice5"] = preg_replace("/,/","",$_POST["cprice5"]);
		$_POST["cprice6"] = preg_replace("/,/","",$_POST["cprice6"]);
		$_POST["cprice7"] = preg_replace("/,/","",$_POST["cprice7"]);*/

		
		if ($_POST["mode"] == "add") { 
		
				/*$_POST['fs_id'] = get_snprojectorders($conn,$_POST['fs_id']);
				$_POST['status_use'] = 1;
				
				include "../include/m_add.php";
				$id = mysqli_insert_id($conn);
			
				for($i=0;$i<=count($_POST['cpro']);$i++){
					if($_POST['cpro'][$i] != ""){
						
						$_POST['cprice'][$i] = preg_replace("/,/","",$_POST['cprice'][$i]);
						
						@mysqli_query($conn,"INSERT INTO `s_fopj_product` (`id`, `fo_id`, `cpro`, `cpod`, `csn`, `camount`, `cprice`) VALUES ('NULL','".$id."', '".$_POST['cpro'][$i]."', '".$_POST['cpod'][$i]."', '".$_POST['csn'][$i]."', '".$_POST['camount'][$i]."', '".$_POST['cprice'][$i]."');");
					}
				}
			
				$_POST['discount'] = preg_replace("/,/","",$_POST['discount']);*/
				
				/*include_once("../mpdf54/mpdf.php");
				include_once("form_fopj.php");
				$mpdf=new mPDF('UTF-8'); 
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = preg_replace("/\//","-",$_POST['fs_id']); 
				$mpdf->Output('../../upload/project_order/'.$chaf.'.pdf','F');*/
				
			header ("location:update.php?mode=update&fo_id=".$_POST['fo_id']."&page=".$_POST['page']); 
		}
		if ($_POST["mode"] == "update" ) { 
			
				$fo_id = $_POST['fo_id'];
			
				$shipL1 = preg_replace("/,/", '', $_POST['shipL1']);
				$shipL2 = preg_replace("/,/", '', $_POST['shipL2']);
				$shipL3 = preg_replace("/,/", '', $_POST['shipL3']);
				$shipL4 = preg_replace("/,/", '', $_POST['shipL4']);
				$shipL5 = preg_replace("/,/", '', $_POST['shipL5']);
				$shipL6 = preg_replace("/,/", '', $_POST['shipL6']);
				$shipL7 = preg_replace("/,/", '', $_POST['shipL7']);
			
				$shipL8 = $shipL1+$shipL2+$shipL3+$shipL4+$shipL5+$shipL6+$shipL7;
			
				$shipM1 = preg_replace("/,/", '', $_POST['shipM1']);
				$shipM2 = preg_replace("/,/", '', $_POST['shipM2']);
				$shipM3 = preg_replace("/,/", '', $_POST['shipM3']);
				$shipM4 = preg_replace("/,/", '', $_POST['shipM4']);
				$shipM5 = preg_replace("/,/", '', $_POST['shipM5']);
				$shipM6 = preg_replace("/,/", '', $_POST['shipM6']);
				$shipM7 = preg_replace("/,/", '', $_POST['shipM7']);
				$shipM8 = preg_replace("/,/", '', $_POST['shipM8']);
			
				$shipM9 = $shipM1+$shipM2+$shipM13+$shipM4+$shipM5+$shipM6+$shipM7+$shipM8;
			
				$shipC1 = preg_replace("/,/", '', $_POST['shipC1']);
				$shipC2 = preg_replace("/,/", '', $_POST['shipC2']);
				$shipC3 = preg_replace("/,/", '', $_POST['shipC3']);
				$shipC4 = preg_replace("/,/", '', $_POST['shipC4']);
				$shipC5 = preg_replace("/,/", '', $_POST['shipC5']);
				$shipC6 = preg_replace("/,/", '', $_POST['shipC6']);
				$shipC7 = preg_replace("/,/", '', $_POST['shipC7']);
			
				$shipC8 = $shipC1+$shipC2+$shipC3+$shipC4+$shipC5+$shipC6+$shipC7;
			
				
				$numCost = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM s_fopj_cost WHERE fo_id = '".$fo_id."'"));
				
				if($numCost == 0){
					mysqli_query($conn,"INSERT INTO `s_fopj_cost` (`id`, `fo_id`, `shipC1`, `shipC2`, `shipC3`, `shipC4`, `shipC5`, `shipC6`, `shipC7`, `shipC8`, `shipM1`, `shipM2`, `shipM3`, `shipM4`, `shipM5`, `shipM6`, `shipM7`, `shipM8`, `shipM9`, `shipL1`, `shipL2`, `shipL3`, `shipL4`, `shipL5`, `shipL6`, `shipL7`, `shipL8`) VALUES (NULL, '".$fo_id."', '".$shipC1."', '".$shipC2."', '".$shipC3."', '".$shipC4."', '".$shipC5."', '".$shipC6."', '".$shipC7."', '".$shipC8."', '".$shipM1."', '".$shipM2."', '".$shipM3."', '".$shipM4."', '".$shipM5."', '".$shipM6."', '".$shipM7."', '".$shipM8."', '".$shipM9."', '".$shipL1."', '".$shipL2."', '".$shipL3."', '".$shipL4."', '".$shipL5."', '".$shipL6."', '".$shipL7."', '".$shipL8."');");
				}else{
					@mysqli_query($conn,"UPDATE `s_fopj_cost` SET `shipC1` = '".$shipC1."', `shipC2` = '".$shipC2."', `shipC3` = '".$shipC3."', `shipC4` = '".$shipC4."', `shipC5` = '".$shipC5."', `shipC6` = '".$shipC6."', `shipC7` = '".$shipC7."', `shipC8` = '".$shipC8."',`shipM1` = '".$shipM1."', `shipM2` = '".$shipM2."', `shipM3` = '".$shipM3."', `shipM4` = '".$shipM4."', `shipM5` = '".$shipM5."', `shipM6` = '".$shipM6."', `shipM7` = '".$shipM7."', `shipM8` = '".$shipM8."', `shipM9` = '".$shipM9."', `shipL1` = '".$shipL1."', `shipL2` = '".$shipL2."', `shipL3` = '".$shipL3."', `shipL4` = '".$shipL4."', `shipL5` = '".$shipL5."', `shipL6` = '".$shipL6."', `shipL7` = '".$shipL7."', `shipL8` = '".$shipL8."' WHERE `fo_id` = ".$fo_id.";");
				}
			
				@mysqli_query($conn,"DELETE FROM `s_fopj_product_cost` WHERE `fo_id` = '".$fo_id."'");
			
				for($i=0;$i<=count($_POST['cproH']);$i++){
					if($_POST['cproH'][$i] != ""){
						
						$_POST['cpriceH'][$i] = preg_replace("/,/","",$_POST['cpriceH'][$i]);
						$_POST['ccost'][$i] = preg_replace("/,/","",$_POST['ccost'][$i]);
						$_POST['costpros'][$i] = preg_replace("/,/","",$_POST['costpros'][$i]);
						
						if($_POST['ccostH'][$i] != $_POST['ccost'][$i]){
							$_POST['ccost'][$i] = $_POST['camountH'][$i]*$_POST['ccost'][$i];
						}
						
						if($_POST['costprosH'][$i] != $_POST['costpros'][$i]){
							$_POST['costpros'][$i] = $_POST['camountH'][$i]*$_POST['costpros'][$i];
						}
						
						
						@mysqli_query($conn,"INSERT INTO `s_fopj_product_cost` (`fo_id`, `ccode`, `cpro`, `cpod`, `csn`, `camount`, `cprice`, `ccost`, `costpros`) VALUES ('".$fo_id."', '".$_POST['ccodeH'][$i]."', '".$_POST['cproH'][$i]."', '".$_POST['cpodH'][$i]."', '".$_POST['csnH'][$i]."', '".$_POST['camountH'][$i]."', '".$_POST['cpriceH'][$i]."', '".$_POST['ccost'][$i]."', '".$_POST['costpros'][$i]."');");
					}
				}
			
			
				//$numCost = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM s_service_cost WHERE job_id = '".$jobID."'"));
			
				//include ("../include/m_update.php");
				/*$id = $_REQUEST[$PK_field];	
			
				@mysqli_query($conn,"DELETE FROM `s_fopj_product` WHERE `fo_id` = '".$id."'");
			
				for($i=0;$i<=count($_POST['cpro']);$i++){
					if($_POST['cpro'][$i] != ""){
						
						$_POST['cprice'][$i] = preg_replace("/,/","",$_POST['cprice'][$i]);
						
						@mysqli_query($conn,"INSERT INTO `s_fopj_product` (`fo_id`, `cpro`, `cpod`, `csn`, `camount`, `cprice`) VALUES ('".$id."', '".$_POST['cpro'][$i]."', '".$_POST['cpod'][$i]."', '".$_POST['csn'][$i]."', '".$_POST['camount'][$i]."', '".$_POST['cprice'][$i]."');");
					}
				}
			
				$_POST['discount'] = preg_replace("/,/","",$_POST['discount']);*/
				
				include_once("../mpdf54/mpdf.php");
				include_once("form_fopj.php");
				$mpdf=new mPDF('UTF-8'); 
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				//$chaf = preg_replace("/\//","-",$fo_id); 
			    //$chaf = preg_replace("/PJ/","PJC",$_POST['fs_id']);
			    $chaf = "PJC ".$fo_id;
				$mpdf->Output('../../upload/fopj_cost/'.$chaf.'.pdf','F');
			
			header ("location:update.php?mode=update&fo_id=".$fo_id."&page=".$_POST['page']); 
			
		}
	}
	if ($_GET["mode"] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"add");
	}
	if ($_GET["mode"] == "update") { 
		Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array ($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}
		
		$a_sdate=explode("-",$date_forder);
		$date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$cs_ship);
		$cs_ship=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$cs_setting);
		$cs_setting=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$date_quf);
		$date_quf=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$date_qut);
		$date_qut=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		
		$sql2 = "select * from s_fopj_cost where fo_id = '" . $_GET[$PK_field] ."'";
		$query2 = @mysqli_query($conn,$sql2);
		while ($rec2 = @mysqli_fetch_array ($query2)) { 
			$$PK_field = $rec2[$PK_field2];
			foreach ($fieldlist2 as $key => $value) { 
				$$value = $rec2[$value];
			}
		}
		
		
		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php     echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
	
function download(id){
	window.open("../../upload/fopj_cost/PJC "+id+".pdf",'_blank');
}

function isNumberKey(e) {
	var keyCode = (e.which) ? e.which : e.keyCode;
	
	//console.log(keyCode);
	
	if ((keyCode >= 48 && keyCode <= 57) || (keyCode == 8))
		return true;
	else if (keyCode == 46) {
		var curVal = document.activeElement.value;
		if (curVal != null && curVal.trim().indexOf('.') == -1)
			return true;
		else
			return false;
	}else if (keyCode == 45) {
		var curVal = document.activeElement.value;
		if (curVal != null && curVal.trim().indexOf('.') == -1)
			return true;
		else
			return false;
	}
	else
		return false;
}

/*function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}*/
//----------------------------------------------------------
function check(frm){
		if (frm.group_name.value.length==0){
			alert ('Please enter group name !!');
			frm.group_name.focus(); return false;
		}		
}	

function chksign(vals){
	//alert(vals);	
}

function submitForm() {
	document.getElementById("submitF").disabled = true;
	document.getElementById("resetF").disabled = true;
	document.form1.submit()
}

</script>
</HEAD>
<?php     include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php     include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php     include('../top.php');?>
<P id=page-intro><?php     if ($mode == "add") { ?>Enter new information<?php     } else { ?>แก้ไข	[<?php     echo $page_name; ?>]<?php     } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="../fo-pj/?page=<?php     echo $_GET['page'];?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php     echo $page_name; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php     echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="../images/form/header-project-order-cost.png" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php     echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;" readonly></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า :</strong>
            <input type="hidden" name="cg_type" value="<?php     echo $cg_type;?>"> 
            <select name="cg_type1" id="cg_type" class="inputselect" disabled>
                <?php    
                	$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
					while($row_cgtype = @mysqli_fetch_array($qucgtype)){
					  ?>
					  	<option value="<?php     echo $row_cgtype['group_id'];?>" <?php     if($cg_type == $row_cgtype['group_id']){echo 'selected';}?>><?php     echo $row_cgtype['group_name'];?></option>
					  <?php    	
					}
				?>
            </select>
             <strong>ประเภทลูกค้า :</strong> 
             <input type="hidden" name="ctype" value="<?php     echo $ctype;?>"> 
             <select name="ctype1" id="ctype" class="inputselect" onChange="chksign(this.value);" disabled>
                <?php    
                	$quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
					while($row_cgcus = @mysqli_fetch_array($quccustommer)){
						if(substr($row_cgcus['group_name'],0,2) != "SR"){
					  ?>
					  	<option value="<?php     echo $row_cgcus['group_id'];?>" <?php     if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php     echo $row_cgcus['group_name'];?></option>
					  <?php    	
						}
					}
				?>
            </select> </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong><input type="text" name="cd_address" value="<?php     echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:100%;border: none;"><?php     //echo $cd_address;?></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ประเภทสินค้า :</strong> 
            <input type="hidden" name="pro_type" value="<?php     echo $pro_type;?>"> 	
            <select name="pro_type2" id="pro_type" class="inputselect" disabled>
                <?php    
                	$quprotype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
					while($row_protype = @mysqli_fetch_array($quprotype)){
					  ?>
					  	<option value="<?php     echo $row_protype['group_id'];?>" <?php     if($pro_type == $row_protype['group_id']){echo 'selected';}?>><?php     echo $row_protype['group_name'];?></option>
					  <?php    	
					}
				?>
            </select>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong> 
            <select name="cd_province" id="cd_province" class="inputselect" disabled>
                <?php    
                	$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
					while($row_province = @mysqli_fetch_array($quprovince)){
					  ?>
					  	<option value="<?php     echo $row_province['province_id'];?>" <?php     if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php     echo $row_province['province_name'];?></option>
					  <?php    	
					}
				?>
            </select>
           	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ใบเสนอราคา / PO.NO. :</strong> <input type="text" name="po_id" value="<?php     echo $po_id;?>" id="po_id" class="inpfoder" readonly></td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php     echo $cd_tel;?>" id="cd_tel" class="inpfoder" readonly>
              <strong>แฟกซ์ :</strong>
              <input type="text" name="cd_fax" value="<?php     echo $cd_fax;?>" id="cd_fax" class="inpfoder" readonly></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ Project order :</strong> <!--<input type="text" name="fs_id" value="<?php     echo $fs_id;?>">--><input type="text" name="fs_id" value="<?php     if($fs_id == ""){echo check_projectorder($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" readonly> <strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php     if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><!--<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script>--></td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php     echo $c_contact;?>" id="c_contact" class="inpfoder" readonly>
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php     echo $c_tel;?>" id="c_tel" class="inpfoder" readonly></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>รหัสลูกค้า<strong> :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="cusid" value="<?php     echo $cusid;?>" id="cusid" class="inpfoder" readonly>
            </span></strong></td>
          </tr>
</table>
  <br>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000000;" class="tb2">
  <tr>
    <td style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
<!--
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> <input type="text" name="loc_name" value="<?php     echo $loc_name;?>" id="loc_name" class="inpfoder" style="width:60%;" readonly></td>
    </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="loc_address" value="<?php     echo $loc_address;?>" id="loc_address" class="inpfoder" style="width:80%;" readonly> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ขนส่งโดย :</strong> <input type="text" name="loc_shopping" value="<?php     echo $loc_shopping;?>" id="loc_shopping" class="inpfoder" style="width:80%;" readonly></td>
          </tr>
-->
          <tr>
          	<td>
			<table>
				<tr>
					<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
         <tr>
            <td style="font-size:15px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>สรุปค่าใช้จ่าย : ฝ่ายควบคุมงาน</strong>
            </td>
    	</tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS1" value="1" id="shipS1_0" <?php     if($shipS1 == '1'){echo 'checked';}?>>-->
				<strong>ค่าน้ำมัน :</strong>
                <input type="text" name="shipC1" value="<?php     echo number_format($shipC1,2);?>" id="shipL1" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS2" value="1" id="shipS1_1" <?php     if($shipS2 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าเดินทาง (อื่นๆ) :</strong>
              	<input type="text" name="shipC2" value="<?php     echo number_format($shipC2,2);?>" id="shipL2" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS3" value="1" id="shipS1_2" <?php     if($shipS3 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าทางด่วน :</strong>
              	<input type="text" name="shipC3" value="<?php     echo number_format($shipC3,2);?>" id="shipL3" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS4" value="1" id="shipS1_3" <?php     if($shipS4 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าเบี้ยเลี้ยง :</strong>
              	<input type="text" name="shipC4" value="<?php     echo number_format($shipC4,2);?>" id="shipL4" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS5" value="1" id="shipS1_4" <?php     if($shipS5 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าที่พัก :</strong>
              	<input type="text" name="shipC5" value="<?php     echo number_format($shipC5,2);?>" id="shipL5" class="inpfoder" onkeypress="return isNumberKey(event)">
              	
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS6" value="1" id="shipS1_5" <?php     if($shipS6 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าใช้จ่ายเบ็ตเตล็ด :</strong>
              	<input type="text" name="shipC6" value="<?php     echo number_format($shipC6,2);?>" id="shipL6" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS7" value="1" id="shipS1_6" <?php     if($shipS7 == '1'){echo 'checked';}?>>-->
             	<strong>อื่นๆ ระบุ :</strong>
              	<input type="text" name="shipC7" value="<?php     echo number_format($shipC7,2);?>" id="shipL7" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:15px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
             	<strong>รวมค่าใช้จ่าย (ฝ่ายควบคุมงาน): <?php     echo number_format($shipC8,2);?></strong>
            </td>
    	  </tr>
</table>
					</td>
					<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
					 <tbody><tr class="alt-row">
						<td style="font-size:15px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<strong>สรุปค่าใช้จ่าย : โรงงาน</strong>
						</td>
					</tr>
					  <tr>
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS1" value="1" id="shipS1_0" checked>-->
							<strong>ค่าน้ำมัน :</strong>
							<input type="text" name="shipM1" value="<?php     echo number_format($shipM1,2);?>" id="shipM1" class="inpfoder" onkeypress="return isNumberKey(event)">
						</td>
					  </tr>
					  <tr class="alt-row">
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS2" value="1" id="shipS1_1" >-->
							<strong>ค่าเดินทาง (อื่นๆ) :</strong>
							<input type="text" name="shipM2" value="<?php     echo number_format($shipM2,2);?>" id="shipM2" class="inpfoder" onkeypress="return isNumberKey(event)">
						</td>
					  </tr>
					  <tr>
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS3" value="1" id="shipS1_2" >-->
							<strong>ค่าทางด่วน :</strong>
							<input type="text" name="shipM3" value="<?php     echo number_format($shipM3,2);?>" id="shipM3" class="inpfoder" onkeypress="return isNumberKey(event)">
						</td>
					  </tr>
					  <tr class="alt-row">
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS4" value="1" id="shipS1_3" checked>-->
							<strong>ค่าเบี้ยเลี้ยง :</strong>
							<input type="text" name="shipM4" value="<?php     echo number_format($shipM4,2);?>" id="shipM4" class="inpfoder" onkeypress="return isNumberKey(event)">
						</td>
					  </tr>
					  <tr>
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS5" value="1" id="shipS1_4" >-->
							<strong>ค่าขนส่งสินค้า :</strong>
							<input type="text" name="shipM5" value="<?php     echo number_format($shipM5,2);?>" id="shipM5" class="inpfoder" onkeypress="return isNumberKey(event)">

						</td>
					  </tr>
					  <tr>
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS5" value="1" id="shipS1_4" >-->
							<strong>ค่าโอที :</strong>
							<input type="text" name="shipM6" value="<?php     echo number_format($shipM6,2);?>" id="shipM6" class="inpfoder" onkeypress="return isNumberKey(event)">

						</td>
					  </tr>
					  <tr class="alt-row">
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS6" value="1" id="shipS1_5" >-->
							<strong>ค่าใช้จ่ายเบ็ตเตล็ด :</strong>
							<input type="text" name="shipM7" value="<?php     echo number_format($shipM7,2);?>" id="shipM7" class="inpfoder" onkeypress="return isNumberKey(event)">
						</td>
					  </tr>
					  <tr>
						<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<!--<input type="checkbox" name="shipS7" value="1" id="shipS1_6" >-->
							<strong>อื่นๆ ระบุ :</strong>
							<input type="text" name="shipM8" value="<?php     echo number_format($shipM8,2);?>" id="shipM8" class="inpfoder" onkeypress="return isNumberKey(event)">
						</td>
					  </tr>
					  <tr class="alt-row">
						<td style="font-size:15px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
							<strong>รวมค่าใช้จ่าย (โรงงาน): <?php     echo number_format($shipM9,2);?></strong> 
						</td>
					  </tr>
					</tbody></table>
					</td>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
         <tr>
            <td style="font-size:15px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>สรุปค่าใช้จ่าย : ฝ่ายขาย</strong>
            </td>
    	</tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS1" value="1" id="shipS1_0" <?php     if($shipS1 == '1'){echo 'checked';}?>>-->
				<strong>ค่าน้ำมัน :</strong>
                <input type="text" name="shipL1" value="<?php     echo number_format($shipL1,2);?>" id="shipL1" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS2" value="1" id="shipS1_1" <?php     if($shipS2 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าเดินทาง (อื่นๆ) :</strong>
              	<input type="text" name="shipL2" value="<?php     echo number_format($shipL2,2);?>" id="shipL2" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS3" value="1" id="shipS1_2" <?php     if($shipS3 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าทางด่วน :</strong>
              	<input type="text" name="shipL3" value="<?php     echo number_format($shipL3,2);?>" id="shipL3" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS4" value="1" id="shipS1_3" <?php     if($shipS4 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าเบี้ยเลี้ยง :</strong>
              	<input type="text" name="shipL4" value="<?php     echo number_format($shipL4,2);?>" id="shipL4" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS5" value="1" id="shipS1_4" <?php     if($shipS5 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าที่พัก :</strong>
              	<input type="text" name="shipL5" value="<?php     echo number_format($shipL5,2);?>" id="shipL5" class="inpfoder" onkeypress="return isNumberKey(event)">
              	
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS6" value="1" id="shipS1_5" <?php     if($shipS6 == '1'){echo 'checked';}?>>-->
             	<strong>ค่าใช้จ่ายเบ็ตเตล็ด :</strong>
              	<input type="text" name="shipL6" value="<?php     echo number_format($shipL6,2);?>" id="shipL6" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<!--<input type="checkbox" name="shipS7" value="1" id="shipS1_6" <?php     if($shipS7 == '1'){echo 'checked';}?>>-->
             	<strong>อื่นๆ ระบุ :</strong>
              	<input type="text" name="shipL7" value="<?php     echo number_format($shipL7,2);?>" id="shipL7" class="inpfoder" onkeypress="return isNumberKey(event)">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:15px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
             	<strong>รวมค่าใช้จ่าย (ฝ่ายขาย): <?php     echo number_format($shipL8,2);?></strong>
            </td>
    	  </tr>
</table>
					</td>
				</tr>
			</table>  
         	</td>
          </tr>
          
          <!--<tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>งานระบบ Hood :</strong> <input type="text" name="systemH" value="<?php     echo $systemH;?>" id="systemH" class="inpfoder" style="width:80%;"> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ราคาต้นทุน :</strong> <input type="text" name="systemHName" value="<?php     echo number_format($systemHName,2);?>" id="systemHName" class="inpfoder" style="width:35%;" onkeypress="return isNumberKey(event)"><span style="padding-left: 20px;"><strong>ราคาที่เสนอ :</strong> <input type="text" name="systemHTel" value="<?php     echo number_format($systemHTel,2);?>" id="systemHTel" class="inpfoder" style="width:35%;" onkeypress="return isNumberKey(event)"></span></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>งานระบบ แก็ส :</strong> <input type="text" name="systemG" value="<?php     echo $systemG;?>" id="systemG" class="inpfoder" style="width:80%;"> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ราคาต้นทุน :</strong> <input type="text" name="systemGName" value="<?php     echo number_format($systemGName,2);?>" id="systemGName" class="inpfoder" style="width:35%;" onkeypress="return isNumberKey(event)"><span style="padding-left: 20px;"><strong>ราคาที่เสนอ :</strong> <input type="text" name="systemGTel" value="<?php     echo number_format($systemGTel,2);?>" id="systemGTel" class="inpfoder" style="width:35%;" onkeypress="return isNumberKey(event)"></span></td>
          </tr>
          <tr>
            <td style="font-size:16px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>รวมต้นทุน งานระบบ :</strong> <input type="text" name="systemHGCost" value="<?php     echo number_format($systemHGCost,2);?>" id="systemHGCost" class="inpfoder" style="width:25%;border: none;font-size: 15px;font-weight: bold;" readonly><span style="padding-left: 20px;"><strong>รวมยอดราคาที่เสนอ :</strong> <input type="text" name="systemGHTotal" value="<?php     echo number_format($systemGHTotal,2);?>" id="systemGHTotal" class="inpfoder" style="width:25%;border: none;    font-size: 15px;font-weight: bold;" readonly></span></td>
          </tr>-->
    </table></td>
  </tr>
  
</table>


    		
  <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
      <td width="2%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
      <td width="27%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
	  <td width="14%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
      <td width="8%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น / แบรนด์</strong></td>
      <td width="8%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคาขาย / ต่อหน่วย</strong></td>
      <td width="13%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคาต้นทุนสินค้า/ต่อหน่วย</strong></td>
      <td width="13%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคาต้นทุนสินค้าโรงงาน/ต่อหน่วย</strong></td>
      
      
    </tr>
    <tbody id="exp" name="exp">
    <?php    
		$fo_id = $_GET['fo_id'];
		$quQry2 = mysqli_query($conn,"SELECT * FROM `s_fopj_product_cost` WHERE fo_id = '".$fo_id."' ORDER BY id ASC");
		$numRowPro2 = mysqli_num_rows($quQry2);
		$quQry = mysqli_query($conn,"SELECT * FROM `s_fopj_product` WHERE fo_id = '".$fo_id."' ORDER BY id ASC");
		$numRowPro = mysqli_num_rows($quQry);

		$quQryss = mysqli_query($conn,"SELECT * FROM `s_fopj_product` WHERE fo_id = '".$fo_id."' ORDER BY id ASC");

		$rowCal = 1;
		
		if($numRowPro2 == 0){
			$rowRun = $quQry;			
		}else{
			$rowRun = $quQry2;
		}
		
		//$arrPJ = [];
		while($rowPJ = mysqli_fetch_array($quQryss)){
			$arrPJ[] = $rowPJ['ccost'];
		}

		//print_r($arrPJ);
		
		$sumTotalCost = 0;
		$sumTotalCost2 = 0;
		$sumPrice = 0;
		$runPJ = 0;
		while($rowPro = mysqli_fetch_array($rowRun)){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;"><?php     echo $rowCal;?></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <input type="text" name="ccode[]" value="<?php     echo $rowPro['ccode'];?>" id="ccode<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
			  <input type="hidden" name="ccodeH[]" value="<?php     echo $rowPro['ccode'];?>"></td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <input type="hidden" name="cproH[]" value="<?php     echo $rowPro['cpro'];?>">
			  <select name="cpro[]" id="cpro<?php     echo $rowCal;?>" class="inputselect" style="width:100%;" disabled>
					<option value="">กรุณาเลือกรายการ</option>
					<?php    
						$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_stock_project ORDER BY group_name ASC");
						while($row_qupro1 = @mysqli_fetch_array($qupro1)){
						  ?>
							<option value="<?php     echo $row_qupro1['group_id'];?>" <?php     if($rowPro['cpro'] == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
						  <?php    	
						}
				  ?>
			  </select>
			  <!--<a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro<?php     echo $rowCal;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>-->
			  </td>
			  
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <input type="text" name="csn[]" value="<?php echo get_stock_project_size($conn,$rowPro['cpro']);?>" id="csn<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
			  <input type="hidden" name="csnH[]" value="<?php echo get_stock_project_size($conn,$rowPro['cpro']);?>"></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <input type="text" name="cpod[]" value="<?php     echo get_stock_project_sn($conn,$rowPro['cpro']);?>" id="cpod<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
			  <input type="hidden" name="cpodH[]" value="<?php     echo get_stock_project_sn($conn,$rowPro['cpro']);?>"></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="camount[]" value="<?php     echo $rowPro['camount'];?>" id="camount<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
				<input type="hidden" name="camountH[]" value="<?php     echo $rowPro['camount'];?>">
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="cprice[]" value="<?php     echo number_format($rowPro['cprice']);?>" id="cprice<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
				<input type="hidden" name="cpriceH[]" value="<?php     echo number_format($rowPro['cprice']);?>">
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<?php    
				if($rowPro['ccost'] == 0 && $rowPro['cprice'] != 0){
					?>
					<input type="text" name="ccost[]" value="<?php echo number_format($arrPJ[$runPJ]);?>" id="ccost<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
					<input type="hidden" name="ccostH[]" value="<?php     echo $rowPro['ccost']?>">
					<?php    
				}else{
					?>
					<input type="text" name="ccost[]" value="<?php echo number_format($rowPro['ccost']);?>" id="ccost<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
					<input type="hidden" name="ccostH[]" value="<?php echo $rowPro['ccost']?>">
					<?php    
				}
				?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php
				if($rowPro['costpros'] == ""){
					?>
					<input type="text" name="costpros[]" value="<?php echo number_format(get_stock_project_unit_price($conn,$rowPro['cpro']));?>" id="costpros<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
					<input type="hidden" name="costprosH[]" value="<?php echo get_stock_project_unit_price($conn,$rowPro['cpro']);?>">
					<?php
				}else{
					?>
					<input type="text" name="costpros[]" value="<?php  echo number_format($rowPro['costpros']);?>" id="costpros<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" readonly>
					<input type="hidden" name="costprosH[]" value="<?php     echo $rowPro['costpros']?>">
					<?php
				} 
			  ?>
			  </td>

			</tr>
			<?php    
			$sumPrice += $rowPro['camount'] * $rowPro['cprice'];
			$sumTotalCost += $rowPro['camount'] * $rowPro['ccost'];
			$sumTotalCost2 += $rowPro['camount'] * $rowPro['costpros'];
			$rowCal++;
			$runPJ++;
		}
	?>
    </tbody>
    <input type="text" hidden="hidden" value="<?php     echo $rowCal;?>" id="countexp" name="countexp"/>
    <tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong>รวมยอดขาย / ยอดต้นทุน 1 / ยอดต้นทุน 2</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong><?php     echo number_format($sumPrice,2);?> บาท</strong></td>
      <td style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong><?php     echo number_format($sumTotalCost,2);?> บาท</strong></td>
      <td style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong><?php     echo number_format($sumTotalCost2,2);?> บาท</strong></td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong>รวมค่าใช้จ่าย ขนส่ง น้ำมัน ที่พักฯ อื่นๆ</strong></td>
      <td colspan="4" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong><?php     echo number_format($shipC8+$shipM9+$shipL8,2);?> บาท</strong></td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong>รวมกำไรขั้นต้น</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong>กำไร <?php     if($sumPrice > 0){echo number_format((($sumPrice-$sumTotalCost)*100)/$sumPrice,2);}else{echo "0.00";}?> %</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong><?php     echo number_format($sumPrice-$sumTotalCost,2);?> บาท</strong></td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong>รวมกำไรสุทธิ</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong>กำไร <?php     if($sumPrice > 0){echo number_format(($sumPrice-($shipC8+$shipM9+$shipL8)-$sumTotalCost2)*100/$sumPrice,2);}else{echo "0.00";}?> %</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 18px;"><strong><?php     echo number_format($sumPrice-($shipC8+$shipM9+$shipL8)-$sumTotalCost2,2);?> บาท</strong></td>
    </tr>
    
    <tr style="display: none;">
      <td colspan="9" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;">
		<div id="discount"><strong>ส่วนลด</strong>
              <input type="text" name="discount" value="<?php     if($discount != ""){echo $discount;}else{echo '0';}?>" id="discount" class="inpfoder" style="width:20%;" readonly>
              <br><br></div>	
      </td>
    </tr>
     
     <tr style="display: none;">
      <td colspan="9" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;"><strong>หมายเหตุ : </strong><!--<textarea name="ccomment" id="ccomment" ><?php     echo strip_tags($ccomment);?></textarea>--><?php     echo strip_tags($ccomment);?><br></td>
    </tr>
    
    </table>
    
    <!--<p style="margin-top: 10px;"><span><input  type="button" id="2" value="+ เพิ่มรายการสินค้า"  onclick="addExp()"/></span><span style="padding-left: 10px;"><input  type="button" id="2" value="+ ลบรายการสินค้า"  onclick="delExp()"/></span></p>-->
    
	<script>
		
		var countBox = 0;
		
	 function addExp(){

			var newChild = document.createElement("tr");
		 
				countBox = $("#countexp").val();
		 
		 		var filedMore  = '<tr>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">'+countBox+'</td>';
		 			filedMore += '	<td style="border:1px solid #000000;text-align:left;padding:5;">';
		 			filedMore += '		<select name="cpro[]" id="cpro'+countBox+'" class="inputselect" style="width:90%;">';
		 			filedMore += '		<option value="">กรุณาเลือกรายการ</option>';
		 			filedMore += '';
		 			filedMore += '	</select>';	
		 			filedMore += '<a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search.php?protype=cpro'+countBox+'\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>';
		 			filedMore += '	</td>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" >';
      				filedMore += '		<input type="text" name="cpod[]" value="" id="cpod'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" >';
      				filedMore += '		<input type="text" name="csn[]" value="" id="csn'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="camount[]" value="" id="camount'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="cprice[]" value="" id="cprice'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
     				filedMore += '</tr>';
	

				$("#exp").append(filedMore);

				 countBox = parseInt(countBox) + parseInt(1);
		 
		 		$("#countexp").val(countBox);
		}
		
		function delExp() {
			
			var rowCount = document.getElementById("exp").rows.length;
			
			
			if(rowCount >= 1){
				document.getElementById("exp").deleteRow(-1);
				
				countBox = $("#countexp").val();
				
				countBox = parseInt(countBox) - parseInt(1);
				$("#countexp").val(countBox);
			}
			
		}
		
	</script>
    <br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="display: none;">
          <tr>
            <td style="border:0;padding:0;width:60%;vertical-align:top;display: none;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <th width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>
                  <th width="75%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>
                  <th width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">1</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro1" value="<?php     echo $cs_pro1;?>" id="cs_pro1" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount1" value="<?php     echo $cs_amount1;?>" id="cs_amount1" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">2</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro2" value="<?php     echo $cs_pro2;?>" id="cs_pro2" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount2" value="<?php     echo $cs_amount2;?>" id="cs_amount2" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">3</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro3" value="<?php     echo $cs_pro3;?>" id="cs_pro3" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount3" value="<?php     echo $cs_amount3;?>" id="cs_amount3" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">4</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro4" value="<?php     echo $cs_pro4;?>" id="cs_pro4" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount4" value="<?php     echo $cs_amount4;?>" id="cs_amount4" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">5</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro5" value="<?php     echo $cs_pro5;?>" id="cs_pro5" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount5" value="<?php     echo $cs_amount5;?>" id="cs_amount5" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
            </table></td>
            <td style="border:0;padding:0;width:40%;vertical-align:top;padding-left:5px;font-size:12px;border:1px solid #000000;padding-top:10px;"><p><strong>
              เลขที่สัญญาซื้อขาย : <input type="text" name="r_id" value="<?php     echo $r_id;?>" id="r_id" class="inpfoder" readonly><!--<input type="text" name="r_id" value="<?php     if($r_id == ""){echo check_contactfo($conn);}else{echo $r_id;};?>" id="r_id" class="inpfoder" >--><br><br>
              วันเริ่มสัญญา : </strong>
              <input type="text" name="date_quf" readonly value="<?php     if($date_quf==""){echo date("d/m/Y");}else{ echo $date_quf;}?>" class="inpfoder" readonly/>
              <!--<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script> -->
              <strong>&nbsp;สิ้นสุด : </strong>
              <input type="text" name="date_qut" readonly value="<?php     if($date_qut==""){echo date("d/m/Y");}else{ echo $date_qut;}?>" class="inpfoder" readonly/>
              <!--<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script>--><br>
              <div id="cssign"><strong>ผู้มีอำนาจเซ็นสัญญา</strong>
              <input type="text" name="cs_sign" value="<?php     echo $cs_sign;?>" id="cs_sign" class="inpfoder" style="width:50%;" readonly>
              <br><br>
              <br><strong>เงื่อนไขการชำระเงิน : <br><br>
              <!--<textarea name="qucomment" id="qucomment" style="height:50px;"><?php     echo strip_tags($qucomment);?></textarea>-->
              <?php     echo strip_tags($qucomment);?>
              </strong><!--<br>
                <br>
                <strong>กำหนดวางบิล : </strong>ตั้งแต่วันที่ 12-15 ของเดือน-->
              </p></td>
          </tr>
        </table>
  <br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="display: none;">
    <tr>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>บุคคลติดต่อทางด้านการเงิน : <input type="text" name="cs_contact" value="<?php     echo $cs_contact;?>" id="cs_contact" class="inpfoder" style="width:50%;" readonly></strong></td>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"> <strong>โทรศัพท์ : </strong><input type="text" name="cs_tel" value="<?php     echo $cs_tel;?>" id="cs_tel" class="inpfoder" style="width:50%;" readonly></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ส่งสินค้า : </strong><input type="text" name="cs_ship" readonly value="<?php     if($cs_ship==""){echo date("d/m/Y");}else{ echo $cs_ship;}?>" class="inpfoder"/><!--<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_ship'});</script>--></td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ติดตั้งเครื่อง : </strong><input type="text" name="cs_setting" readonly value="<?php     if($cs_setting==""){echo date("d/m/Y");}else{ echo $cs_setting;}?>" class="inpfoder"/><!--<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_setting'});</script>--></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>การบริการ : </strong><strong>
        <select name="service_type" id="service_type" class="inputselect" style="width:50%;" disabled>
         	<option value="">กรุณาเลือกการบริการ</option>
          <?php    
                	$quservicetype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");
					while($row_servicetype = @mysqli_fetch_array($quservicetype)){
					  ?>
          <option value="<?php     echo $row_servicetype['group_id'];?>" <?php     if($service_type == $row_servicetype['group_id']){echo 'selected';}?>><?php     echo $row_servicetype['group_name'];?></option>
          <?php    	
					}
				?>
        </select>
      </strong></td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;">&nbsp;</td>
    </tr>
  </table>
  <br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;display: none;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  <!--<select name="cs_company" id="cs_company" class="inputselect" style="width:50%;display: none;">
                    <option value="">กรุณาเลือกช่างบริการ</option>
                    <?php    
						/*$qutechtype = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_techtype = @mysqli_fetch_array($qutechtype)){
						  ?>
						<option value="<?php     echo $row_techtype['group_id'];?>" <?php     if($cs_company == $row_techtype['group_id']){echo 'selected';}?>><?php     echo $row_techtype['group_name'];?></option>
						<?php    	
						}*/
					?>
                  </select>-->
                  
                  <strong><input type="text" name="cs_company" value="<?php     echo $cs_company;?>" id="cs_company" class="inpfoder" style="width:50%;text-align:center;" readonly></strong>
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>Sale Manager</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong><!--<input type="text" name="cs_sell" value="<?php     echo $cs_sell;?>" id="cs_sell" class="inpfoder" style="width:50%;text-align:center;">-->
                <select name="cs_sell" id="cs_sell" class="inputselect" style="width:50%;" disabled>
                <?php    
                	$qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
					while($row_saletype = @mysqli_fetch_array($qusaletype)){
					  ?>
					  	<option value="<?php     echo $row_saletype['group_id'];?>" <?php     if($cs_sell == $row_saletype['group_id']){echo 'selected';}?>><?php     echo $row_saletype['group_name'];?></option>
					  <?php    	
					}
				?>
            </select></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;" disabled><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong><input type="text" name="cs_aceep" value="<?php     echo $cs_aceep;?>" id="cs_aceep" class="inpfoder" style="width:50%;text-align:center;" readonly></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;display: none;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>หมายเหตุอื่นๆ : </strong>
        <br><br>
        <!--<textarea name="remark" id="remark" style="height:150px;"><?php     echo strip_tags($remark);?></textarea>-->
        <?php     echo strip_tags($remark);?>
        </td>
      </tr>
    </table>
        </fieldset>
    </div>
    <div class="formArea" style="text-align: center;">
	<input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
      <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
      <?php     
		$filename = '../../upload/fopj_cost/PJC '.$_GET['fo_id'].'.pdf';

		if (file_exists($filename)) {
			?>
			<input type="button" name="Download" value="Download" class="button" onClick="download(<?php     echo $_GET['fo_id']?>)">
			<?php    
		}
	  ?>
      
      <?php     
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php     echo $_GET["mode"];?>">
      <input name="fo_id" type="hidden" id="fo_id" value="<?php     echo $_GET[fo_id];?>">
      <input name="page" type="hidden" id="page" value="<?php     echo $_GET["page"];?>">
      <input name="status_use" type="hidden" id="status_use" value="<?php     echo $status_use;?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php     echo $st_setting;?>">
      <input name="<?php     echo $PK_field;?>" type="hidden" id="<?php     echo $PK_field;?>" value="<?php     echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php     include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php     if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php     }?>
</BODY>
</HTML>
