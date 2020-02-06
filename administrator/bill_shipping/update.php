<?php   
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST["mode"] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		$a_sdate=explode("/",$_POST['sr_stime']);
		$_POST['sr_stime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_open']);
		$_POST['job_open']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_close']);
		$_POST['job_close']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_balance']);
		$_POST['job_balance']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date2']);
		$_POST['loc_date2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date3']);
		$_POST['loc_date3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['sell_date']);
		$_POST['sell_date']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		

		if ($_POST["mode"] == "add") { 
			
			$_POST['approve'] = 0;
			$_POST['st_setting'] = 0;
			$_POST['supply'] = 0;
			
			if($_POST['cus_id'] == ""){
				$_POST['cus_id'] = 1;
			}

			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);

			include "../include/m_add.php";
			
			$id = mysqli_insert_id($conn);

			foreach($_POST['cpro'] as $a => $v){
				if($v != ''){
					//echo $a."|".$v."<br>";
					if($_POST['camount'][$a] == ""){
						$_POST['camount'][$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_bill_shippingsub` (`r_id`, `sr_id`,`lists`, `amounts`) VALUES (NULL, '".$id."', '".$v."', '".$_POST['camount'][$a]."');");
					@mysqli_query($conn,"UPDATE `s_group_stock_order` SET `group_stock` = `group_stock` - '".$_POST['camount'][$a]."' WHERE `group_id` = '".$v."';");
				}
			}
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_billshipping.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/bill_shipping/'.$chaf.'.pdf','F');
			
			header ("location:index.php?" . $param); 
		}
		if ($_POST["mode"] == "update" ) {

			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);

			include ("../include/m_update.php");

			$id = $_REQUEST[$PK_field];		

			$sql2 = "select * from s_bill_shippingsub where sr_id = '".$_REQUEST[$PK_field]."'";
			$quPro = @mysqli_query($conn,$sql2);
			while($rowPro = mysqli_fetch_array($quPro)){
				@mysqli_query($conn,"UPDATE `s_group_stock_order` SET `group_stock` = `group_stock`+'".$rowPro['amounts']."' WHERE `group_id` = '".$rowPro['lists']."';");
			}

			@mysqli_query($conn,"DELETE FROM `s_bill_shippingsub` WHERE `sr_id` = '".$_REQUEST[$PK_field]."'");

			foreach($_POST['cpro'] as $a => $v){
				if($v != ''){
					//echo $a."|".$v."<br>";
					if($_POST['camount'][$a] == ""){
						$_POST['camount'][$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_bill_shippingsub` (`r_id`, `sr_id`,`lists`, `amounts`) VALUES (NULL, '".$id."', '".$v."', '".$_POST['camount'][$a]."');");
					@mysqli_query($conn,"UPDATE `s_group_stock_order` SET `group_stock` = `group_stock` - '".$_POST['camount'][$a]."' WHERE `group_id` = '".$v."';");
				}
			}

			include_once("../mpdf54/mpdf.php");
			include_once("form_billshipping.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/bill_shipping/'.$chaf.'.pdf','F');
			
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
		
		$a_sdate=explode("-",$sr_stime);
		$sr_stime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_open);
		$job_open=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_close);
		$job_close=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_balance);
		$job_balance=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date2);
		$loc_date2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date3);
		$loc_date3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$sell_date);
		$sell_date=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$finfo = get_fopj($conn,$cus_id);
		
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php    echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<script type="text/javascript" src="scriptform.js"></script> 
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

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

	function CountChecks(whichlist,maxchecked,latestcheck,numsa) {
	
	var listone = new Array();
 	
	for (var t=1;t<=numsa;t++){
		listone[t-1] = 'checkbox'+t;
	}
	
	// End of customization.
	var iterationlist;
	eval("iterationlist="+whichlist);
	var count = 0;
	for( var i=0; i<iterationlist.length; i++ ) {
	   if( document.getElementById(iterationlist[i]).checked == true) { count++; }
	   if( count > maxchecked ) { latestcheck.checked = false; }
	   }
	if( count > maxchecked ) {
	  // alert('Sorry, only ' + maxchecked + ' may be checked.');
	   }
	}

	function get_product(cid){
	
	var x = document.getElementById("cpro"+cid).value;

	$.ajax({
		type: "GET",
		url: "call_return.php?action=chkProject&group_id="+x,
		success: function(data){
			var obj = JSON.parse(data);
			
			
						
			if(obj.status === 'yes'){
					if(obj.group_stock <= 0){
						if(obj.group_spar_id != ''){
							alert(obj.group_spar_id+' : สินค้าตัวนี้ไม่เพียงพอสำหรับการจัดส่ง');
						}
					}

					document.getElementById('ccodepro'+cid).innerHTML = obj.group_spar_id;
					document.getElementById('cpropod'+cid).innerHTML = obj.group_sn;
					document.getElementById('cprosize'+cid).innerHTML = obj.group_size;
					document.getElementById('cprostock'+cid).innerHTML = obj.group_stock;
					document.getElementById('camount'+cid).value = '0';

			}else{
					document.getElementById('ccodepro'+cid).innerHTML = '';
					document.getElementById('cpropod'+cid).innerHTML = '';
					document.getElementById('cprosize'+cid).innerHTML = '';
					document.getElementById('cprostock'+cid).innerHTML = '';
					document.getElementById('camount'+cid).value = '';
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
<SCRIPT language=Javascript>
      function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</SCRIPT>
</HEAD>
<?php    include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php    include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php    include('../top.php');?>
<P id=page-intro><?php    if ($mode == "add") { ?>Enter new information<?php    } else { ?>แก้ไข	[<?php    echo $page_name; ?>]<?php    } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="../bill_shipping/"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php    echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php    echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><style>
	.bgheader{
		font-size:12px;
		position:absolute;
		margin-top:98px;
		padding-left:586px;
	}
	table tr td{
		vertical-align:top;
		padding:5px;
	}	
	.tb1{
		margin-top:5px;
	}
	.tb1 tr td{
		border:1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;	
	}
	.tb2,.tb3{
		border:1px solid #000000;	
		margin-top:5px;
	}
	.tb2 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	
	.tb3 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	.tb3 img{
		vertical-align:bottom;
	}
	
	.ccontact{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
	}
	.ccontact tr td{
		
	}
	
	.cdetail{
		border: 1px solid #000000;
		padding:5px;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
  	}	
	.cdetail ul li{
		list-style:none;
		
	}
	.cdetail2 ul li{
		list-style:none;
		float:left;
	}
	.clear{
		margin:0;
		padding:0;
		clear:both;	
	}
	
	.tblf5{
		border: 1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
	}
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<div style="position:relative;text-align:center;">
            	<img src="../images/form/header_shipping_slip.png" width="100%" border="0" style="max-width:1182px;"/>
            </div>
		</td>
	  </tr>
	</table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td><strong>ชื่อลูกค้า :</strong> 
                <input name="cd_names" type="text" id="cd_names"  value="<?php echo $cd_names;?>" style="width:80%;">
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td>
				<strong>เลขที่ใบจัดส่ง</strong> :
<input type="text" name="sv_id" value="<?php   if($sv_id == ""){echo check_billshipping($conn);}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">
&nbsp;&nbsp;<strong>วันที่เบิกสินค้า  :</strong> <span id="datef"></span>
              <input type="text" name="job_open" readonly value="<?php  if($job_open==""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_open'});</script>
			  <!-- &nbsp;&nbsp;<strong>อ้างอิงใบเบิก</strong> : <input type="text" name="srid2" value="<?php   echo $srid2;?>" id="srid2" class="inpfoder"> -->
				</td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> 
			<input type="text" name="cusadd" value="<?php echo $cusadd;?>" id="cusadd" class="inpfoder" style="width: 90%;">
			</td>
            <td>
			<strong>อ้างอิงเลขที่ FO/PJ</strong> : <input type="text" name="srid" value="<?php   echo $srid;?>" id="srid" class="inpfoder">&nbsp;&nbsp;
<strong>วันที่ต้องการสินค้า :</strong> <span id="datet"></span>
              <input type="text" name="job_balance" readonly value="<?php  if($job_balance==""){echo date("d/m/Y");}else{ echo $job_balance;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_balance'});</script>
			</td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <!--<span id="cusprovince"><?php   echo province_name($conn,$finfo['cd_province']);?></span>-->
			<select name="cusprovince" id="cusprovince" class="inputselect">

                <?php 
                	$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
                  while($row_province = @mysqli_fetch_array($quprovince)){
                    ?>
                      <option value="<?php  echo $row_province['province_id'];?>" <?php  if($cusprovince == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
                    <?php 	
                  }
				        ?>

            </select>
			</td>
            <td>
			<strong>ประเภทลูกค้า :</strong>
            	<select name="sr_ctype2" id="sr_ctype2">
            	  <!--<option value="">กรุณาเลือก</option>-->
            	  <?php   
						$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
							if(substr($row_cusftype2['group_name'],0,2) !== "SR"){
							?>
            	  <option value="<?php   echo $row_cusftype2['group_id'];?>" <?php   if($row_cusftype2['group_id'] == $sr_ctype2){echo 'selected';}?>><?php   echo $row_cusftype2['group_name'];?></option>
            	  <?php  
							}
						}
					?>
          	  </select>
			&nbsp;&nbsp;
				<strong>ประเภทสินค้า :</strong> 	

				<select name="sr_ctype" id="sr_ctype" class="inputselect">
					<?php 
						$quprotype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
						while($row_protype = @mysqli_fetch_array($quprotype)){
						?>
							<option value="<?php  echo $row_protype['group_id'];?>" <?php  if($sr_ctype == $row_protype['group_id']){echo 'selected';}?>><?php  echo $row_protype['group_name'];?></option>
						<?php 	
						}
					?>
				</select>
			</td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <input type="text" name="custel" value="<?php echo $custel;?>" id="custel" class="inpfoder"><!--<span id="custel"><?php   echo $finfo['cd_tel'];?></span>--><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <input type="text" name="cusfax" value="<?php echo $cusfax;?>" id="cusfax" class="inpfoder"><!--<span id="cusfax"><?php   echo $finfo['cd_fax'];?></span>--></td>
            <td><!--<strong>บริการครั้งล่าสุด : </strong> <span id="sevlast"><?php   echo get_lastservice_f($conn,$cus_id,$sv_id);?></span> &nbsp;&nbsp;&nbsp;&nbsp;-->
			<strong>ช่องทางการขนส่งสินค้า</strong> <input type="radio" name="bill_shipping" value="1" <?php if($bill_shipping == '1'){echo 'checked';}?>> ฝ่ายขนส่งสินค้า-บริษัท&nbsp;&nbsp;<input type="text" name="shipping_dt1" value="<?php   echo $shipping_dt1;?>" id="shipping_dt1" class="inpfoder">&nbsp;&nbsp;
			<input type="radio" name="bill_shipping" value="2" <?php if($bill_shipping == '2'){echo 'checked';}?>> จ้างขนส่งสินค้าภายนอก&nbsp;&nbsp;<input type="text" name="shipping_dt2" value="<?php   echo $shipping_dt2;?>" id="shipping_dt2" class="inpfoder">
              <input type="hidden" name="job_close" value="<?php  if($job_close==""){echo date("d/m/Y");}else{ echo $job_close;}?>" class="inpfoder"/>&nbsp;&nbsp;
			  <!-- <strong>วันที่คืนอะไหล่  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="sr_stime" readonly value="<?php  if($sr_stime==""){echo date("d/m/Y");}else{ echo $sr_stime;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sr_stime'});</script> -->
            </span></td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <input type="text" name="cscont" value="<?php echo $cscont;?>" id="cscont" class="inpfoder"><!--<span id="cscont"><?php   echo $finfo['c_contact'];?></span>-->&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <input type="text" name="cstel" value="<?php echo $cstel;?>" id="cstel" class="inpfoder"><!--<span id="cstel"><?php   echo $finfo['c_tel'];?></span>--></td>
            <td><input type="radio" name="bill_shipping" value="3" <?php if($bill_shipping == '3'){echo 'checked';}?>> ฝ่ายช่าง Omega รับสินค้าเอง (ชื่อช่าง/เบอร์โทร)&nbsp;&nbsp;<input type="text" name="shipping_dt3" value="<?php   echo $shipping_dt3;?>" id="shipping_dt3" class="inpfoder">&nbsp;&nbsp;
			<input type="radio" name="bill_shipping" value="4" <?php if($bill_shipping == '4'){echo 'checked';}?>> อื่นๆ โปรดระบุ&nbsp;&nbsp;<input type="text" name="shipping_dt4" value="<?php   echo $shipping_dt4;?>" id="shipping_dt4" class="inpfoder"></td>
          </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
      <tr>
        <td width="50%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : <input type="text" name="sloc_name" value="<?php echo $sloc_name;?>" id="sloc_name" class="inpfoder" style="width: 70%;"></strong><!--<span id="sloc_name"><?php   echo $finfo['loc_name'];?></span>--><br />
          <br>
		  <strong>ที่อยู่ : <input type="text" name="sloc_add" value="<?php echo $sloc_add;?>" id="sloc_add" class="inpfoder" style="width: 80%;"></strong>
		  <br><br>
		  <strong>โทรศัพท์ : </strong><input type="text" name="loc_tel" value="<?php echo $loc_tel;?>" id="loc_tel" class="inpfoder" style="width: 30%;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ : <input type="text" name="loc_fax" value="<?php echo $loc_fax;?>" id="loc_fax" class="inpfoder" style="width: 30%;"></strong>
		  <br><br>
		  <strong>ชื่อผู้ติดต่อ : </strong><input type="text" name="loc_cname" value="<?php echo $loc_cname;?>" id="loc_cname" class="inpfoder" style="width: 30%;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <input type="text" name="loc_ctel" value="<?php echo $loc_ctel;?>" id="loc_ctel" class="inpfoder" style="width: 30%;">
          </td>
                
        <td width="50%"><center><strong>รายละเอียดเพิ่มเติมใบจัดสินค้า</strong></center><br><br>
        <textarea name="detail_recom" class="inpfoder" id="detail_recom" style="width:50%;height:100px;background:#FFFFFF;"><?php   echo strip_tags($detail_recom);?></textarea></td>
      </tr>
    </table>
    
    <center>
      <br>
      <span style="font-size:18px;font-weight:bold;">รายการสินค้าที่ต้องการจัดส่ง</span></center><br>

	  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
		<tr>
		<td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
		<td width="35%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
		<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น / แบรนด์</strong></td>
		<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>สต็อคสินค้า</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
		</tr>

		<tbody id="exp" name="exp">
		
		<?php    
		$quQry = mysqli_query($conn,"SELECT * FROM `s_bill_shippingsub` WHERE sr_id = '".$_GET['sr_id']."' ORDER BY r_id ASC");
		$numRowPro = mysqli_num_rows($quQry);
		$rowCal = 1;
		$sumPrice = 0;
		$sumCost = 0;

		while($rowPro = mysqli_fetch_array($quQry)){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;"><?php     echo $rowCal;?></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="ccodepro<?php echo $rowCal;?>">
			  <?php echo get_stock_order_code($conn,$rowPro['lists']);?></td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;vertical-align: middle;">
			  <select name="cpro[]" id="cpro<?php echo $rowCal;?>" class="inputselect" style="width:85%;" onChange="get_product(<?php echo $rowCal;?>);">
					<option value="">กรุณาเลือกรายการ</option>
					<?php    
						$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_stock_order ORDER BY group_name ASC");
						while($row_qupro1 = @mysqli_fetch_array($qupro1)){
						  ?>
							<option value="<?php echo $row_qupro1['group_id'];?>" <?php if($rowPro['lists'] == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
						  <?php    	
						}
				  ?>
			  </select>
			  <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=<?php     echo $rowCal;?>&col=<?php echo $rowCal;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cpropod<?php echo $rowCal;?>">
			  <?php echo get_stock_order_sn($conn,$rowPro['lists']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprosize<?php echo $rowCal;?>">
		  	  <?php echo get_stock_order_size($conn,$rowPro['lists']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprostock<?php echo $rowCal;?>">
			  <?php echo get_stock_order_stock($conn,$rowPro['lists']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;">
				<input type="text" name="camount[]" value="<?php echo $rowPro['amounts'];?>" id="camount<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;">
			  </td>
			</tr>
			<?php    

			$rowCal++;
		}
	?>

		</tbody>
		<input type="text" hidden="hidden" value="<?php echo $rowCal;?>" id="countexp" name="countexp"/>

    </table>

	<p style="margin-top: 10px;"><span><input  type="button" id="2" value="+ เพิ่มรายการสินค้า"  onclick="addExp()"/></span><span style="padding-left: 10px;"><input  type="button" id="2" value="+ ลบรายการสินค้า"  onclick="delExp()"/></span></p>
    
	<script>
		
		var countBox = 0;
		
	 function addExp(){

			var newChild = document.createElement("tr");
		 
				countBox = $("#countexp").val();
		 
		 		var filedMore  = '<tr>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;">'+countBox+'</td>';
		            filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="ccodepro'+countBox+'">';
      				filedMore += '	</td>';
		 			filedMore += '	<td style="border:1px solid #000000;text-align:left;padding:5;vertical-align: middle;">';
		 			filedMore += '		<select name="cpro[]" id="cpro'+countBox+'" class="inputselect" style="width:85%;">';
		 			filedMore += '		<option value="">กรุณาเลือกรายการสินค้า</option>';
		 			filedMore += '';
		 			filedMore += '	</select>';	
		 			filedMore += '<a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search2.php?protype='+countBox+'&col='+countBox+'\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>';
		 			filedMore += '	</td>';
					filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cpropod'+countBox+'"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprosize'+countBox+'"></td>';
					filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprostock'+countBox+'"></td>';
					filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;">';
      				filedMore += '		<input type="text" name="camount[]" value="" id="camount'+countBox+'" class="inpfoder" style="width:100%;text-align:center;"></td>';
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

	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
	  <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  <input type="text" name="loc_contact2" id="loc_contact2" style="text-align: center;" value="<?php echo $loc_contact2;?>">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้เบิกสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>
                  <input type="text" name="loc_date2" readonly value="<?php  if($loc_date2==""){echo date("d/m/Y");}else{ echo $loc_date2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date2'});</script></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
				  <input type="text" name="cs_sell" id="cs_sell" style="text-align: center;" value="<?php echo $cs_sell;?>">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จัดสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="sell_date" readonly value="<?php  if($sell_date==""){echo date("d/m/Y");}else{ echo $sell_date;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sell_date'});</script></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top: 15px;"><strong >
				  <input type="text" name="loc_contact3" id="loc_contact3" style="text-align: center;" value="<?php echo $loc_contact3;?>">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ / จัดสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="loc_date3" readonly value="<?php  if($loc_date3==""){echo date("d/m/Y");}else{ echo $loc_date3;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date3'});</script></td>


              </tr>
            </table>
        </td>
      </tr>
</table></td>
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
      <input name="mode" type="hidden" id="mode" value="<?php   echo $_GET["mode"];?>">  
      <input name="st_setting" type="hidden" id="    border: 1px solid;" value="<?php   echo $st_setting;?>">       
      <input name="approve" type="hidden" id="approve" value="<?php   echo $approve;?>">  
      <input name="supply" type="hidden" id="supply" value="<?php   echo $supply;?>"> 
      <input name="<?php   echo $PK_field;?>" type="hidden" id="<?php   echo $PK_field;?>" value="<?php   echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php  if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>
</BODY>
</HTML>
