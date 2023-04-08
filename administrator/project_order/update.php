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

		$a_sdate=explode("/",$_POST['sign_date1']);
		$_POST['sign_date1']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['sign_date2']);
		$_POST['sign_date2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['sign_date3']);
		$_POST['sign_date3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
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
			
		
				$_POST['fs_id'] = get_snprojectorders($conn,$_POST['fs_id']);
				$_POST['status_use'] = 1;
				$_POST['approve'] = 0;
				$_POST['approve2'] = 0;
				$_POST['discount'] = preg_replace("/,/","",$_POST['discount']);
				
				include "../include/m_add.php";
				$id = mysqli_insert_id($conn);
			
				for($i=0;$i<=count($_POST['cpro']);$i++){
					if($_POST['cpro'][$i] != ""){
						
						$_POST['cprice'][$i] = preg_replace("/,/","",$_POST['cprice'][$i]);
						$_POST['ccost'][$i] = preg_replace("/,/","",$_POST['ccost'][$i]);
						$_POST['cdisc'][$i] = preg_replace("/,/","",$_POST['cdisc'][$i]);
						
						//$_POST['ccost'][$i] = $_POST['camount'][$i] * $_POST['ccost'][$i];
						//$_POST['ccost'][$i] = $_POST['ccost'][$i];

						//echo "INSERT INTO `s_project_product` (`id`, `fo_id`, `ccode`, `cpro`, `cpod`, `csn`, `camount`, `cprice`, `ccost`) VALUES (NULL,'".$id."', '".$_POST['ccode'][$i]."', '".$_POST['cpro'][$i]."', '".$_POST['cpod'][$i]."', '".$_POST['csn'][$i]."', '".$_POST['camount'][$i]."', '".$_POST['cprice'][$i]."', '".$_POST['ccost'][$i]."');<br>";
						
						@mysqli_query($conn,"INSERT INTO `s_project_product` (`id`, `fo_id`, `ccode`, `cpro`, `cpod`, `csn`, `camount`, `cprice`, `ccost`, `cdisc`) VALUES (NULL,'".$id."', '".$_POST['ccode'][$i]."', '".$_POST['cpro'][$i]."', '".$_POST['cpod'][$i]."', '".$_POST['csn'][$i]."', '".$_POST['camount'][$i]."', '".$_POST['cprice'][$i]."', '".$_POST['ccost'][$i]."', '".$_POST['cdisc'][$i]."');");
					}
				}

				include_once("../mpdf54/mpdf.php");
				include_once("form_projectorder.php");
				$mpdf=new mPDF('UTF-8'); 
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = preg_replace("/\//","-",$_POST['fs_id']); 
				$mpdf->Output('../../upload/project_order/'.$chaf.'.pdf','F');
				
			header ("location:index.php?" . $param); 
		}
		if ($_POST["mode"] == "update" ) { 
			
			$_POST['discount'] = preg_replace("/,/","",$_POST['discount']);

				include ("../include/m_update.php");
				$id = $_REQUEST[$PK_field];	
			
				@mysqli_query($conn,"DELETE FROM `s_project_product` WHERE `fo_id` = '".$id."'");
			
			
				for($i=0;$i<=count($_POST['cpro']);$i++){
					
					if($_POST['cpro'][$i] != ""){
						
						$_POST['cprice'][$i] = preg_replace("/,/","",$_POST['cprice'][$i]);
						$_POST['ccost'][$i] = preg_replace("/,/","",$_POST['ccost'][$i]);
						$_POST['cdisc'][$i] = preg_replace("/,/","",$_POST['cdisc'][$i]);
						
						// if($_POST['ccostH'][$i] != $_POST['ccost'][$i]){
						// 	$_POST['ccost'][$i] = $_POST['camount'][$i] * $_POST['ccost'][$i];
						// }
						
						// if($_POST['camountH'][$i] != $_POST['camount'][$i]){
						// 	$_POST['ccost'][$i] = $_POST['camount'][$i] * ($_POST['ccost'][$i]/$_POST['camountH'][$i]);
						// }					
						
						
						@mysqli_query($conn,"INSERT INTO `s_project_product` (`fo_id`, `ccode`, `cpro`, `cpod`, `csn`, `camount`, `cprice`, `ccost`, `cdisc`) VALUES ('".$id."', '".$_POST['ccode'][$i]."', '".$_POST['cpro'][$i]."', '".$_POST['cpod'][$i]."', '".$_POST['csn'][$i]."', '".$_POST['camount'][$i]."', '".$_POST['cprice'][$i]."', '".$_POST['ccost'][$i]."', '".$_POST['cdisc'][$i]."');");
					}
				}

				include_once("../mpdf54/mpdf.php");
				include_once("form_projectorder.php");
				$mpdf=new mPDF('UTF-8'); 
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = preg_replace("/\//","-",$_POST['fs_id']); 
				$mpdf->Output('../../upload/project_order/'.$chaf.'.pdf','F');
			
			header ("location:index.php?" . $param); 
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

		$a_sdate=explode("-",$sign_date1);
		$sign_date1=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
	
		$a_sdate=explode("-",$sign_date2);
		$sign_date2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
	
		$a_sdate=explode("-",$sign_date3);
		$sign_date3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
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
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
-->
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
//----------------------------------------------------------
function check(frm){
		if (frm.group_name.value.length==0){
			alert ('Please enter group name !!');
			frm.group_name.focus(); return false;
		}		
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

function chksign(vals){
	//alert(vals);	
}
	
function get_product(cid){
	
	var x = document.getElementById("cpro"+cid).value;
	$.ajax({
		type: "GET",
		url: "call_return.php?action=chkProject&group_id="+x,
		success: function(data){
			var obj = JSON.parse(data);
			
			//alert(obj.status+obj.group_pro_id+obj.group_size);
			if(obj.status === 'yes'){
//				$("#group_id").val(obj.group_id);
//				$("#group_name").val(obj.group_name);
					document.getElementById('ccodepro'+cid).innerHTML = obj.group_pro_id;
					document.getElementById('cprosize'+cid).innerHTML = obj.group_size;
			}else{
				
			}
		}
	});
	
	
    //document.getElementById("demo").innerHTML = "You selected: " + x;
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
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
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
    <td style="padding-bottom:5px;"><img src="../images/form/header-project-order.png" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php     echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า :</strong> 
            <select name="cg_type" id="cg_type" class="inputselect">
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
             <select name="ctype" id="ctype" class="inputselect" onChange="chksign(this.value);">
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
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php     echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:80%;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ประเภทสินค้า :</strong> 	
            <select name="pro_type" id="pro_type" class="inputselect">
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
            <select name="cd_province" id="cd_province" class="inputselect">
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
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ใบเสนอราคา / PO.NO. :</strong> <input type="text" name="po_id" value="<?php     echo $po_id;?>" id="po_id" class="inpfoder"></td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php     echo $cd_tel;?>" id="cd_tel" class="inpfoder">
              <strong>แฟกซ์ :</strong>
              <input type="text" name="cd_fax" value="<?php     echo $cd_fax;?>" id="cd_fax" class="inpfoder"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ Project order :</strong> <!--<input type="text" name="fs_id" value="<?php     echo $fs_id;?>">--><input type="text" name="fs_id" value="<?php     if($fs_id == ""){echo check_projectorder($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" > <strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php     if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script></td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php     echo $c_contact;?>" id="c_contact" class="inpfoder">
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php     echo $c_tel;?>" id="c_tel" class="inpfoder"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>รหัสลูกค้า<strong> :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="cusid" value="<?php     echo $cusid;?>" id="cusid" class="inpfoder">
            </span></strong></td>
          </tr>
</table>
  <br>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000000;" class="tb2">
  <tr>
    <td style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> <input type="text" name="loc_name" value="<?php     echo $loc_name;?>" id="loc_name" class="inpfoder" style="width:60%;"></td>
    </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="loc_address" value="<?php     echo $loc_address;?>" id="loc_address" class="inpfoder" style="width:80%;"> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ขนส่งโดย :</strong> <input type="text" name="loc_shopping" value="<?php     echo $loc_shopping;?>" id="loc_shopping" class="inpfoder" style="width:80%;"></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>งานระบบ Hood :</strong> <input type="text" name="systemH" value="<?php     echo $systemH;?>" id="systemH" class="inpfoder" style="width:80%;"> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้ติดต่อ :</strong> <input type="text" name="systemHName" value="<?php     echo $systemHName;?>" id="systemHName" class="inpfoder" style="width:35%;"><span style="padding-left: 20px;"><strong>เบอร์โทร :</strong> <input type="text" name="systemHTel" value="<?php     echo $systemHTel;?>" id="systemHTel" class="inpfoder" style="width:35%;"></span></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>งานระบบ แก็ส :</strong> <input type="text" name="systemG" value="<?php     echo $systemG;?>" id="systemG" class="inpfoder" style="width:80%;"> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้ติดต่อ :</strong> <input type="text" name="systemGName" value="<?php     echo $systemGName;?>" id="systemGName" class="inpfoder" style="width:35%;"><span style="padding-left: 20px;"><strong>เบอร์โทร :</strong> <input type="text" name="systemGTel" value="<?php     echo $systemGTel;?>" id="systemGTel" class="inpfoder" style="width:35%;"></span></td>
          </tr>
          <!--<tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เงินค่าประกัน :
                <input type="text" name="money_garuntree" value="<?php     echo $money_garuntree;?>" id="money_garuntree" class="inpfoder" >
            <small style="color:#F00;">ไม่ต้องใส่ (,)</small>
            <input name="notvat1" type="radio" id="radio" value="1" <?php     if($notvat1 == 1){echo 'checked';}?>>
            Not vat
            <input type="radio" name="notvat1" id="radio2" value="2" <?php     if($notvat1 == 2){echo 'checked';}?>>
            Vat 7%</strong></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ค่าขนส่งและติดตั้ง :
                <input type="text" name="money_setup" value="<?php     echo $money_setup;?>" id="money_setup" class="inpfoder" >
            <small style="color:#F00;">ไม่ต้องใส่ (,)</small>
            <input name="notvat2" type="radio" id="radio3" value="1" <?php     if($notvat2 == 1){echo 'checked';}?>>
Not vat
<input type="radio" name="notvat2" id="radio4" value="2" <?php     if($notvat2 == 2){echo 'checked';}?>>
Vat 7%</strong></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เครื่องป้อนน้ำยา : 
                <br>
                <input name="feeder" type="radio" id="radio5" value="1" <?php     if($feeder == 1){echo 'checked';}?>>
              เครื่องป้อนเกาหลี
              <input type="text" name="feeder_type" value="<?php     echo $feeder_type;?>" id="feeder_type1" class="inpfoder" >
              <br>
              <input name="feeder" type="radio" id="radio6" value="2" <?php     if($feeder == 2){echo 'checked';}?>>
              เครื่องป้อน DC906
              <input type="text" name="feeder_type2" value="<?php     echo $feeder_type2;?>" id="feeder_type2" class="inpfoder" >
            </strong></td>
          </tr>-->
    </table></td>
    <td style="vertical-align:top;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
         <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>การติดตั้ง / การขนส่ง</strong>
            </td>
    	</tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<input type="checkbox" name="shipS1" value="1" id="shipS1_0" <?php     if($shipS1 == '1'){echo 'checked';}?>>
				<strong>ช่าง OKS ขนส่งสินค้า :</strong>
                <input type="text" name="shipL1" value="<?php     echo $shipL1;?>" id="shipL1" class="inpfoder">
            </td>
    	  </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<input type="checkbox" name="shipS2" value="1" id="shipS1_1" <?php     if($shipS2 == '1'){echo 'checked';}?>>
             	<strong>ช่าง OKS ติดตั้ง :</strong>
              	<input type="text" name="shipL2" value="<?php     echo $shipL2;?>" id="shipL2" class="inpfoder">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<input type="checkbox" name="shipS3" value="1" id="shipS1_2" <?php     if($shipS3 == '1'){echo 'checked';}?>>
             	<strong>OMEGA ขนส่งสินค้า :</strong>
              	<input type="text" name="shipL3" value="<?php     echo $shipL3;?>" id="shipL3" class="inpfoder">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<input type="checkbox" name="shipS4" value="1" id="shipS1_3" <?php     if($shipS4 == '1'){echo 'checked';}?>>
             	<strong>ช่าง OMEGA ติดตั้ง :</strong>
              	<input type="text" name="shipL4" value="<?php     echo $shipL4;?>" id="shipL4" class="inpfoder">
            </td>
    	  </tr>
    	  <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<input type="checkbox" name="shipS5" value="1" id="shipS1_4" <?php     if($shipS5 == '1'){echo 'checked';}?>>
             	<strong>อื่นๆ ระบุ :</strong>
              	<input type="text" name="shipL5" value="<?php     echo $shipL5;?>" id="shipL5" class="inpfoder">
            </td>
    	  </tr>
</table>
    </td>
  </tr>
</table>


    		
  <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
      <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น / แบรนด์</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ต้นทุนสินค้า 1</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>
	  <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ส่วนลด (ราคา/หน่วย)</strong></td>
      
      
    </tr>
    <tbody id="exp" name="exp">
    <?php    
		$fo_id = $_GET['fo_id'];
		$quQry = mysqli_query($conn,"SELECT * FROM `s_project_product` WHERE fo_id = '".$fo_id."' ORDER BY id ASC");
		$numRowPro = mysqli_num_rows($quQry);
		$rowCal = 1;
		$sumPrice = 0;
		$sumCost = 0;
		while($rowPro = mysqli_fetch_array($quQry)){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;"><?php     echo $rowCal;?></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <input type="text" name="ccode[]" value="<?php echo $rowPro['ccode'];?>" id="ccode<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;"></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" id="ccodepro<?php echo $rowCal;?>">
			  <?php echo get_projectcodepro($conn,$rowPro['cpro']);?></td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <select name="cpro[]" id="cpro<?php echo $rowCal;?>" class="inputselect" style="width:85%;" onChange="get_product(<?php echo $rowCal;?>);">
					<option value="">กรุณาเลือกรายการ</option>
					<?php    
						$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_project ORDER BY group_name ASC");
						while($row_qupro1 = @mysqli_fetch_array($qupro1)){
						  ?>
							<option value="<?php     echo $row_qupro1['group_id'];?>" <?php     if($rowPro['cpro'] == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
						  <?php    	
						}
				  ?>
			  </select>
			  <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro<?php     echo $rowCal;?>&col=<?php echo $rowCal;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <input type="text" name="cpod[]" value="<?php echo $rowPro['cpod'];?>" id="cpod<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;"></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" id="cprosize<?php     echo $rowCal;?>">
			  <input type="hidden" name="csn[]" value="<?php echo $rowPro['csn'];?>" id="csn<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;">
		  	  <?php echo get_projectsize($conn,$rowPro['cpro']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="camount[]" value="<?php     echo $rowPro['camount'];?>" id="camount<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;">
				<input type="hidden" name="camountH[]" value="<?php     echo $rowPro['camount'];?>">
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="ccost[]" value="<?php echo number_format($rowPro['ccost']);?>" id="ccost<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)">
				<input type="hidden" name="ccostH[]" value="<?php  echo $rowPro['ccost'];?>">
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="cprice[]" value="<?php echo number_format($rowPro['cprice']);?>" id="cprice<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)">
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="cdisc[]" value="<?php echo number_format($rowPro['cdisc']);?>" id="cprice<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)">
			  </td>

			</tr>
			<?php    
			$sumPrice = $sumPrice+($rowPro['camount']*$rowPro['cprice']);
			//$sumPrice = $sumPrice+$rowPro['cprice'];
			$sumDisc = $sumDisc+$rowPro['cdisc'];
			$sumCost  = $sumCost+$rowPro['ccost'];
			$rowCal++;
		}
	?>
    </tbody>
    <input type="text" hidden="hidden" value="<?php     echo $rowCal;?>" id="countexp" name="countexp"/>
    
    
    <tr>
      <td colspan="2" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:middle;padding-top:15px;">
		<div id="discount"><strong>ส่วนลด</strong>
              <input type="text" name="discount" value="<?php     if($discount != ""){echo $discount;}else{echo '0';}?>" id="discount" class="inpfoder" style="width:50%;">
              <br><br></div>	
      </td>
      <td colspan="5" style="text-align: right;border: 1px solid #000000;padding: 5;vertical-align: middle;font-size: 15px;font-weight: bold;">ยอดต้นทุนสินค้า 1 / รวมยอดขาย</td>
      <td style="text-align: left;border: 1px solid #000000;padding: 5;vertical-align: middle;text-align: right;font-size: 15px;font-weight: bold;"><?php     echo number_format($sumCost,2);?></td>
      <td style="text-align: left;border: 1px solid #000000;padding: 5;vertical-align: middle;text-align: right;font-size: 15px;font-weight: bold;"><?php     echo number_format($sumPrice,2);?></td>
	  <td style="text-align: left;border: 1px solid #000000;padding: 5;vertical-align: middle;text-align: right;font-size: 15px;font-weight: bold;"><?php     echo number_format($sumDisc,2);?></td>
    </tr>
    
    <tr>
      <td colspan="2" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:middle;"></td>
      <td colspan="6" style="text-align: right;border: 1px solid #000000;padding: 5;vertical-align: middle;font-size: 15px;font-weight: bold;">ยอดรวมกำไรขั้นต้น</td>
      <td  style="text-align: left;border: 1px solid #000000;padding: 5;vertical-align: middle;text-align: right;font-size: 15px;font-weight: bold;">กำไร <?php     if($sumPrice > 0){echo number_format(((($sumPrice-$sumCost)-$sumDisc)*(100))/$sumPrice,2);}else{echo "0.00";};?>%</td>
      <td  style="text-align: left;border: 1px solid #000000;padding: 5;vertical-align: middle;text-align: right;font-size: 15px;font-weight: bold;"><?php     echo number_format(($sumPrice-$sumCost)-$sumDisc,2);?></td>
      
    </tr>
     
     <tr>
      <td colspan="10" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;"><strong>หมายเหตุ :</strong><br><textarea name="ccomment" id="ccomment" ><?php     echo strip_tags($ccomment);?></textarea><br></td>
    </tr>
    
    </table>
    
    <p style="margin-top: 10px;"><span><input  type="button" id="2" value="+ เพิ่มรายการสินค้า"  onclick="addExp()"/></span><span style="padding-left: 10px;"><input  type="button" id="2" value="+ ลบรายการสินค้า"  onclick="delExp()"/></span></p>
    
	<script>
		
		var countBox = 0;
		
	 function addExp(){

			var newChild = document.createElement("tr");
		 
				countBox = $("#countexp").val();
		 
		 		var filedMore  = '<tr>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">'+countBox+'</td>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" >';
      				filedMore += '		<input type="text" name="ccode[]" value="" id="cpod'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
		            filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" id="ccodepro'+countBox+'">';
      				filedMore += '	</td>';
		 			filedMore += '	<td style="border:1px solid #000000;text-align:left;padding:5;">';
		 			filedMore += '		<select name="cpro[]" id="cpro'+countBox+'" class="inputselect" style="width:85%;">';
		 			filedMore += '		<option value="">กรุณาเลือกรายการ</option>';
		 			filedMore += '';
		 			filedMore += '	</select>';	
		 			filedMore += '<a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search.php?protype=cpro'+countBox+'&col='+countBox+'\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>';
		 			filedMore += '	</td>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" >';
      				filedMore += '		<input type="text" name="cpod[]" value="" id="cpod'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" id="cprosize'+countBox+'">';
      				filedMore += '		<input type="hidden" name="csn[]" value=""  class="inpfoder" style="width:100%;text-align:center;"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="camount[]" value="" id="camount'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="ccost[]" value="" id="ccost'+countBox+'" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)"></td>';
					filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="cprice[]" value="" id="cprice'+countBox+'" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)"></td>';
					  filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="cdisc[]" value="" id="cdisc'+countBox+'" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)"></td>';
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
              เลขที่สัญญาซื้อขาย : <input type="text" name="r_id" value="<?php     echo $r_id;?>" id="r_id" class="inpfoder" ><!--<input type="text" name="r_id" value="<?php     if($r_id == ""){echo check_contactfo($conn);}else{echo $r_id;};?>" id="r_id" class="inpfoder" >--><br><br>
              วันเริ่มสัญญา : </strong>
              <input type="text" name="date_quf" readonly value="<?php     if($date_quf==""){echo date("d/m/Y");}else{ echo $date_quf;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script> 
              <strong>&nbsp;สิ้นสุด : </strong>
              <input type="text" name="date_qut" readonly value="<?php     if($date_qut==""){echo date("d/m/Y");}else{ echo $date_qut;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script><br>
              <div id="cssign"><strong>ผู้มีอำนาจเซ็นสัญญา</strong>
              <input type="text" name="cs_sign" value="<?php     echo $cs_sign;?>" id="cs_sign" class="inpfoder" style="width:50%;">
              <br><br>
              <br><strong>เงื่อนไขการชำระเงิน :<br>
              <textarea name="qucomment" id="qucomment" style="height:50px;"><?php     echo strip_tags($qucomment);?></textarea>
              </strong><!--<br>
                <br>
                <strong>กำหนดวางบิล : </strong>ตั้งแต่วันที่ 12-15 ของเดือน-->
              </p></td>
          </tr>
        </table>
  <br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>บุคคลติดต่อทางด้านการเงิน : <input type="text" name="cs_contact" value="<?php     echo $cs_contact;?>" id="cs_contact" class="inpfoder" style="width:50%;"></strong></td>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"> <strong>โทรศัพท์ : </strong><input type="text" name="cs_tel" value="<?php     echo $cs_tel;?>" id="cs_tel" class="inpfoder" style="width:50%;"></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ส่งสินค้า : </strong><input type="text" name="cs_ship" readonly value="<?php     if($cs_ship==""){echo date("d/m/Y");}else{ echo $cs_ship;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_ship'});</script></td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ติดตั้งเครื่อง : </strong><input type="text" name="cs_setting" readonly value="<?php     if($cs_setting==""){echo date("d/m/Y");}else{ echo $cs_setting;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_setting'});</script></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>การบริการ : </strong><strong>
        <select name="service_type" id="service_type" class="inputselect" style="width:50%;">
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
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
	  	<td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong><!--<input type="text" name="cs_sell" value="<?php     echo $cs_sell;?>" id="cs_sell" class="inpfoder" style="width:50%;text-align:center;">-->
                <select name="cs_sell" id="cs_sell" class="inputselect" style="width:50%;">
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date1" value="<?php if($sign_date1 == ""){echo date("d/m/Y");}else{ echo $sign_date1;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date1'});</script></strong>
                </td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  
				<?php 
                    if($cs_company != 0){
                    ?>
                    <?php echo getsalename($conn,$cs_company);?>
                    <?php
                    }else{
                      echo "<br>";
                    }
                    ?>
                    <input type="hidden" name="cs_company" value="<?php echo $cs_company;?>"> 
                  <!-- <strong><input type="text" name="cs_company" value="<?php     echo $cs_company;?>" id="cs_company" class="inpfoder" style="width:50%;text-align:center;"></strong> -->
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>Sale Manager</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date2" value="<?php if($sign_date2 == ""){echo date("d/m/Y");}else{ echo $sign_date2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date2'});</script></strong>
                </td>
              </tr>
            </table>

        </td>
        
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
				<td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
				<?php 
                    if($cs_aceep != 0){
                    ?>
                    <?php echo getsalename($conn,$cs_aceep);?>
                    <?php
                    }else{
                      echo "<br>";
                    }
                    ?>
                    <input type="hidden" name="cs_aceep" value="<?php echo $cs_aceep;?>"> 
				<!-- <strong><input type="text" name="cs_aceep" value="<?php     echo $cs_aceep;?>" id="cs_aceep" class="inpfoder" style="width:50%;text-align:center;"></strong> -->
			</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>GM / ผู้อนุมัติการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date3" value="<?php if($sign_date3 == ""){echo date("d/m/Y");}else{ echo $sign_date3;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date3'});</script></strong>
                </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>หมายเหตุอื่นๆ :</strong>
        <br>
        <textarea name="remark" id="remark" style="height:150px;"><?php     echo strip_tags($remark);?></textarea>
        </td>
      </tr>
    </table>
        </fieldset>
    </div><br>
    <div class="formArea">
	<input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
      <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
      <?php     
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php     echo $_GET["mode"];?>">
      <input name="status_use" type="hidden" id="status_use" value="<?php     echo $status_use;?>">
	  <input name="st_setting" type="hidden" id="st_setting" value="<?php     echo $st_setting;?>">
	  <input name="approve" type="hidden" id="approve" value="<?php  echo $approve;?>">
      <input name="approve2" type="hidden" id="approve2" value="<?php  echo $approve2;?>">
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
