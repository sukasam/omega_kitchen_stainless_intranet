<?php    
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST["mode"] <> "") { 
    $param = "";
    
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		$a_sdate=explode("/",$_POST['date_open']);
    $_POST['date_open']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

    $a_sdate=explode("/",$_POST['sign_date_work1']);
    $_POST['sign_date_work1']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['sign_date_work2']);
    $_POST['sign_date_work2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['sign_date_work3']);
    $_POST['sign_date_work3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

    if($_POST['date_work1'] != ""){
      $a_sdate=explode("/",$_POST['date_work1']);
      $_POST['date_work1']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    }else{
      $_POST['date_work1']= '0000-00-00';
    }
    if($_POST['date_work2'] != ""){
      $a_sdate=explode("/",$_POST['date_work2']);
      $_POST['date_work2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    }else{
      $_POST['date_work2']= '0000-00-00';
    }
    if($_POST['date_work3'] != ""){
      $a_sdate=explode("/",$_POST['date_work3']);
      $_POST['date_work3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    }else{
      $_POST['date_work3']= '0000-00-00';
    }
    if($_POST['date_work4'] != ""){
      $a_sdate=explode("/",$_POST['date_work4']);
      $_POST['date_work4']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    }else{
      $_POST['date_work4']= '0000-00-00';
    }
    if($_POST['date_work5'] != ""){
      $a_sdate=explode("/",$_POST['date_work5']);
      $_POST['date_work5']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    }else{
      $_POST['date_work5']= '0000-00-00';
    }
    if($_POST['date_work6'] != ""){
      $a_sdate=explode("/",$_POST['date_work6']);
      $_POST['date_work6']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    }else{
      $_POST['date_work6']= '0000-00-00';
    }

    $itemIds = "";
    foreach ($_POST['work_list1'] as $itemId) {
		  $itemIds = $itemIds . $itemId . ",";
    }

    $_POST['work_list'] = rtrim($itemIds, ",");

    $work_list = explode(',',$_POST['work_list']);

    $_POST['remark'] = nl2br(addslashes($_POST['remark']));
		
		if ($_POST["mode"] == "add") { 

				$_POST['status'] = 1;
				$_POST['fs_id'] = get_snfirstorders($conn,$_POST['fs_id']);
				
				include "../include/m_add.php";
        $id = mysqli_insert_id($conn);
        
        if ($_FILES['fimages1']['name'] != "") { 
					
					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data = explode(".",$_FILES['fimages1']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;
					
					$target_dir = "../../upload/work_noti/images/";
					$target_file = $target_dir . basename($filename);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages1"]["tmp_name"]);
					
					@move_uploaded_file($_FILES["fimages1"]["tmp_name"], $target_file);
					$sql = "update $tbl_name set images1 = '".$filename."' where $PK_field = '".$id."' ";
					@mysqli_query($conn, $sql);	
	
        } // end if ($_FILES[fimages][name] != "")	
        
        if ($_FILES['fimages2']['name'] != "") { 
					
					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data = explode(".",$_FILES['fimages2']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;
					
					$target_dir = "../../upload/work_noti/images/";
					$target_file = $target_dir . basename($filename);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages2"]["tmp_name"]);
					
					@move_uploaded_file($_FILES["fimages2"]["tmp_name"], $target_file);
					$sql = "update $tbl_name set images2 = '".$filename."' where $PK_field = '".$id."' ";
					@mysqli_query($conn, $sql);	
	
        } // end if ($_FILES[fimages][name] != "")	
        
        if ($_FILES['fimages3']['name'] != "") { 
					
					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data = explode(".",$_FILES['fimages3']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;
					
					$target_dir = "../../upload/work_noti/images/";
					$target_file = $target_dir . basename($filename);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fimages3"]["tmp_name"]);
					
					@move_uploaded_file($_FILES["fimages3"]["tmp_name"], $target_file);
					$sql = "update $tbl_name set images3 = '".$filename."' where $PK_field = '".$id."' ";
					@mysqli_query($conn, $sql);	
	
        } // end if ($_FILES[fimages][name] != "")	
        

        for($i=0;$i<=count($_POST['cpro']);$i++){
					if($_POST['cpro'][$i] != ""){
						@mysqli_query($conn,"INSERT INTO `s_work_noti_product` (`id`, `fo_id`, `ccode`, `cpro`, `cpod`, `csn`, `camount`) VALUES (NULL,'".$id."', '".$_POST['ccode'][$i]."', '".$_POST['cpro'][$i]."', '".$_POST['cpod'][$i]."', '".$_POST['csn'][$i]."', '".$_POST['camount'][$i]."');");
					}
				}
				
				include_once("../mpdf54/mpdf.php");
				include_once("form_worknoti.php");
				$mpdf=new mPDF('UTF-8'); 
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = preg_replace("/\//","-",$_POST['fs_id']); 
				$mpdf->Output('../../upload/work_noti/'.$chaf.'.pdf','F');
				
			header ("location:index.php?" . $param); 
		}
		if ($_POST["mode"] == "update" ) { 
				include ("../include/m_update.php");
        $id = $_REQUEST[$PK_field];			

        @mysqli_query($conn,"DELETE FROM `s_work_noti_product` WHERE `fo_id` = '".$id."'");
        
        for($i=0;$i<=count($_POST['cpro']);$i++){
					if($_POST['cpro'][$i] != ""){
						@mysqli_query($conn,"INSERT INTO `s_work_noti_product` (`fo_id`, `ccode`, `cpro`, `cpod`, `csn`, `camount`) VALUES ('".$id."', '".$_POST['ccode'][$i]."', '".$_POST['cpro'][$i]."', '".$_POST['cpod'][$i]."', '".$_POST['csn'][$i]."', '".$_POST['camount'][$i]."');");
					}
				}

        if ($_FILES['fimages1']['name'] != "") { 
          @unlink("../../upload/work_noti/images/".$_REQUEST['images1']);
          
          $mname="";
          $mname=gen_random_num(5);
          $filename = "";
          if($filename == "")
          $name_data=explode(".",$_FILES['fimages1']['name']);
          $type = $name_data[1];
          $filename = $mname.".".$type;
          
          $target_dir = "../../upload/work_noti/images/";
          $target_file = $target_dir . basename($filename);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["fimages1"]["tmp_name"]);

          move_uploaded_file($_FILES["fimages1"]["tmp_name"], $target_file);
          $sql = "update $tbl_name set images1 = '".$filename."' where $PK_field = '".$id."' ";
          mysqli_query($conn, $sql);	

        } // end if ($_FILES[fimages][name] != "")

        if ($_FILES['fimages2']['name'] != "") { 
          @unlink("../../upload/work_noti/images/".$_REQUEST['images2']);
          
          $mname="";
          $mname=gen_random_num(5);
          $filename = "";
          if($filename == "")
          $name_data=explode(".",$_FILES['fimages2']['name']);
          $type = $name_data[1];
          $filename = $mname.".".$type;
          
          $target_dir = "../../upload/work_noti/images/";
          $target_file = $target_dir . basename($filename);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["fimages2"]["tmp_name"]);

          move_uploaded_file($_FILES["fimages2"]["tmp_name"], $target_file);
          $sql = "update $tbl_name set images2 = '".$filename."' where $PK_field = '".$id."' ";
          mysqli_query($conn, $sql);	

        } // end if ($_FILES[fimages][name] != "")

        if ($_FILES['fimages3']['name'] != "") { 
          @unlink("../../upload/work_noti/images/".$_REQUEST['images3']);
          
          $mname="";
          $mname=gen_random_num(5);
          $filename = "";
          if($filename == "")
          $name_data=explode(".",$_FILES['fimages3']['name']);
          $type = $name_data[1];
          $filename = $mname.".".$type;
          
          $target_dir = "../../upload/work_noti/images/";
          $target_file = $target_dir . basename($filename);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["fimages3"]["tmp_name"]);

          move_uploaded_file($_FILES["fimages3"]["tmp_name"], $target_file);
          $sql = "update $tbl_name set images3 = '".$filename."' where $PK_field = '".$id."' ";
          mysqli_query($conn, $sql);	

        } // end if ($_FILES[fimages][name] != "")
				
				include_once("../mpdf54/mpdf.php");
				include_once("form_worknoti.php");
				$mpdf=new mPDF('UTF-8'); 
        $mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = preg_replace("/\//","-",$_POST['fs_id']); 
				$mpdf->Output('../../upload/work_noti/'.$chaf.'.pdf','F');
			
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
		
		$a_sdate=explode("-",$date_open);
    $date_open=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$sign_date_work1);
    $sign_date_work1=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$sign_date_work2);
    $sign_date_work2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$sign_date_work3);
    $sign_date_work3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    
    if($date_work1 != "0000-00-00"){
      $a_sdate=explode("-",$date_work1);
      $date_work1=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    }else{
      $date_work1= '';
    }
    if($date_work2 != "0000-00-00"){
      $a_sdate=explode("-",$date_work2);
      $date_work2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    }else{
      $date_work2= '';
    }
    if($date_work3 != "0000-00-00"){
      $a_sdate=explode("-",$date_work3);
      $date_work3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    }else{
      $date_work3= '';
    }
    if($date_work4 != "0000-00-00"){
      $a_sdate=explode("-",$date_work4);
      $date_work4=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    }else{
      $date_work4= '';
    }
    if($date_work5 != "0000-00-00"){
      $a_sdate=explode("-",$date_work5);
      $date_work5=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    }else{
      $date_work5= '';
    }
    if($date_work6 != "0000-00-00"){
      $a_sdate=explode("-",$date_work6);
      $date_work6=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    }else{
      $date_work6= '';
    }
    
    $work_list = explode(',',$work_list);

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

function get_product(cid){
	
	var x = document.getElementById("cpro"+cid).value;
	$.ajax({
		type: "GET",
		url: "call_return.php?action=chkProject&group_id="+x,
		success: function(data){
			var obj = JSON.parse(data);
			
			//alert(obj.status+obj.group_pro_id+obj.group_size);
			if(obj.status === 'yes'){
          document.getElementById('ccodepro'+cid).innerHTML = obj.group_spar_id;
          document.getElementById('cpropod'+cid).innerHTML = obj.group_sn;
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

function checkMobileSale(){

  var sale_contact = document.getElementById("sale_contact").value;

  $.post("call_api.php",
  {
    action: "getSaleMobile",
    sale_contact: sale_contact
  },
  function(data, status){
    if(status === "success"){
      document.getElementById("sale_tel").value = data;
    }
  });
  
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

<H3 align="left"><?php     echo $check_module; ?></H3>
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
    <td style="padding-bottom:5px;"><img src="../images/form/header-work-notification.png" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong>ชื่อลูกค้า :</strong>
              <input type="text" name="cd_name" value="<?php echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;">
            </td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong>เลขที่ใบแจ้งงาน :</strong> 
              <input type="text" name="fs_id" value="<?php if($fs_id == ""){echo check_work_noti($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" > 
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong>ที่อยู่ :</strong> 
              <input type="text" name="cd_address" value="<?php echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:60%;">
              &nbsp&nbsp
              <strong>จังหวัด :</strong> 
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
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong> วันที่ :</strong> <input type="text" name="date_open" readonly value="<?php if($date_open==""){echo date("d/m/Y");}else{ echo $date_open;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_open'});</script>
            </td>
          </tr>
          <tr>
          <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="cd_contact" value="<?php echo $cd_contact;?>" id="cd_contact" class="inpfoder">
              <strong>ตำแหน่ง :</strong>
              <input type="text" name="cd_position" value="<?php echo $cd_position;?>" id="cd_position" class="inpfoder">
            </td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
             <strong>พนักงานขาย :</strong>
              <!-- <input type="text" name="sale_contact" value="<?php echo $sale_contact;?>" id="sale_contact" class="inpfoder"> -->
              <select name="sale_contact" id="sale_contact" class="inputselect" style="width:50%;" onchange="checkMobileSale()">
                <option value="">กรุณาเลือกพนักงานขาย</option>
                <?php    
                	$qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
                  while($row_saletype = @mysqli_fetch_array($qusaletype)){
                    ?>
                      <option value="<?php     echo $row_saletype['group_id'];?>" <?php     if($sale_contact == $row_saletype['group_id']){echo 'selected';}?>><?php     echo $row_saletype['group_name'];?></option>
                    <?php    	
                  }
                ?>
            </select>
            </td>
          </tr>
          <tr>
            
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong>มือถือ :</strong> 
              <input type="text" name="cd_mobile" value="<?php echo $cd_mobile;?>" id="cd_mobile" class="inpfoder">
              <strong>Line</strong>
              <input type="text" name="cd_line" value="<?php echo $cd_line;?>" id="cd_line" class="inpfoder">
            </td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>มือถือ :</strong>
              <input type="text" name="sale_tel" value="<?php echo $sale_tel;?>" id="sale_tel" class="inpfoder">
            </td>
          </tr>
          <tr>
            
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong>โทรศัพท์ :</strong> 
              <input type="text" name="cd_tel" value="<?php echo $cd_tel;?>" id="cd_tel" class="inpfoder">
              <strong>อีเมล์ :</strong>
              <input type="text" name="cd_email" value="<?php echo $cd_email;?>" id="cd_email" class="inpfoder">
            </td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              
            </td>
          </tr>
</table>
  <br>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000000;" class="tb2">
    <tr>
      <td style="vertical-align:top;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
            <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> <input type="text" name="loc_name" value="<?php echo $loc_name;?>" id="loc_name" class="inpfoder" style="width:50%;"></td>
            </tr>
            <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="loc_address" value="<?php     echo $loc_address;?>" id="loc_address" class="inpfoder" style="width:50%;"> </td>
            </tr>
        </table>
      </td>
    </tr>
    <tr>
        <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
          <tr>
                <th style="font-weight: bold;"><u>เอกสารประกอบการแจ้งงาน</u></th>
                <th style="font-weight: bold;"><u>รายละเอียดการแจ้งงาน</u></th>
                <th style="font-weight: bold;"><u>วันที่เข้าบริการ</u></th>
          </tr>
          <tr>
                <td><input type="checkbox" name="work_list1[]" value="1" <?php if(in_array(1,$work_list)){echo 'checked';}?>> แบบร่างและรายะเอียดประกอบแบบ</td>
                <td><input type="checkbox" name="work_list1[]" value="2" <?php if(in_array(2,$work_list)){echo 'checked';}?>> เพิ่อเขียนแบบ : <input type="text" name="work_detail1" value="<?php echo $work_detail1;?>" id="work_detail1" class="inpfoder"></td>
                <td>วันที่ : <input type="text" name="date_work1" value="<?php if($date_work1==""){}else{ echo $date_work1;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_work1'});</script></td>
          </tr>
          <tr>
                <td><input type="checkbox" name="work_list1[]" value="3" <?php if(in_array(3,$work_list)){echo 'checked';}?>> ไฟล์ CAD</td>
                <td><input type="checkbox" name="work_list1[]" value="4" <?php if(in_array(4,$work_list)){echo 'checked';}?>> ตรวจสอบพื้นที่ / ดูหน้างาน / วัดพื้นที่</td>
                <td>วันที่ : <input type="text" name="date_work2" value="<?php if($date_work2==""){}else{ echo $date_work2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_work2'});</script></td>
          </tr>
          <tr>
                <td><input type="checkbox" name="work_list1[]" value="5" <?php if(in_array(5,$work_list)){echo 'checked';}?>> แค็ตตาล็อคสินค้า</td>
                <td><input type="checkbox" name="work_list1[]" value="6" <?php if(in_array(6,$work_list)){echo 'checked';}?>> เพื่อแจ้งซ่อม / บริการ : <input type="text" name="work_detail2" value="<?php echo $work_detail2;?>" id="work_detail2" class="inpfoder"></td>
                <td>วันที่ : <input type="text" name="date_work3" value="<?php if($date_work3==""){}else{ echo $date_work3;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_work3'});</script></td>
          </tr>
          <tr>
                <td><input type="checkbox" name="work_list1[]" value="7" <?php if(in_array(7,$work_list)){echo 'checked';}?>> แบบแปลน ที่ลูกค้าอนุมัติ</td>
                <td><input type="checkbox" name="work_list1[]" value="8" <?php if(in_array(8,$work_list)){echo 'checked';}?>> เพื่อผลิตสินค้า (อ้างอิงเอกสาร) : <input type="text" name="work_detail3" value="<?php echo $work_detail3;?>" id="work_detail3" class="inpfoder"></td>
                <td>วันที่ : <input type="text" name="date_work4" value="<?php if($date_work4==""){}else{ echo $date_work4;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_work4'});</script></td>
          </tr>
          <tr>
                <td><input type="checkbox" name="work_list1[]" value="9" <?php if(in_array(9,$work_list)){echo 'checked';}?>> แบบ Shop Drawing</td>
                <td><input type="checkbox" name="work_list1[]" value="10" <?php if(in_array(10,$work_list)){echo 'checked';}?>> อื่นๆ ระบุ : <input type="text" name="work_detail5" value="<?php echo $work_detail5;?>" id="work_detail5" class="inpfoder"></td>
                <td>วันที่ : <input type="text" name="date_work5" value="<?php if($date_work5 ==""){}else{ echo $date_work5;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_work5'});</script></td>
          </tr>
          <tr>
                <td><input type="checkbox" name="work_list1[]" value="11" <?php if(in_array(11,$work_list)){echo 'checked';}?>> อื่นๆ <input type="text" name="work_detail4" value="<?php echo $work_detail4;?>" id="work_detail4" class="inpfoder"></td>
                <td></td>
                <td>วันที่ : <input type="text" name="date_work6" value="<?php if($date_work6 ==""){}else{ echo $date_work6;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_work6'});</script></td>
          </tr>
          <tr>
                <td></td>
                <td></td>
                <td></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>


    		
  <br>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
          <center><strong style="font-size: 15px;">รายละเอียด การแจ้งงาน</strong></center><br>
          <table>
              <tr>
                  <td>
                    <strong>รูปภาพประกอบ ที่ 1</strong><br/><br>
                    <input name="fimages1" type="file" id="fimages1">
                    <br>
                    <?php  
                    if($_GET['mode'] != 'add'){
                      if($images1 != ""){?><br>
                    <a href="../../upload/work_noti/images/<?php  echo $images1;?>" target="_blank">
                      <img src="../../upload/work_noti/images/<?php  echo $images1;?>" height="100">
                    </a>
                    
                    <?php  }?>
                    <input name="images1" type="hidden" value="<?php echo  $images1; ?>">
                    <?php }?>
                  </td>
                  <td>
                    <strong>รูปภาพประกอบ ที่ 2</strong><br/><br/>
                    <input name="fimages2" type="file" id="fimages2">
                    <br>
                    <?php  
                    if($_GET['mode'] != 'add'){
                      if($images2 != ""){?><br>
                    <a href="../../upload/work_noti/images/<?php  echo $images2;?>" target="_blank">
                      <img src="../../upload/work_noti/images/<?php  echo $images2;?>" height="100">
                    </a>
                    
                    <?php  }?>
                    <input name="images2" type="hidden" value="<?php echo  $images2; ?>">
                    <?php }?>
                  </td>
                  <td>
                    <strong>รูปภาพประกอบ ที่ 3</strong><br/><br/>
                    <input name="fimages3" type="file" id="fimages3">
                    <br>
                    <?php  
                    if($_GET['mode'] != 'add'){
                      if($images3 != ""){?><br>
                    <a href="../../upload/work_noti/images/<?php  echo $images3;?>" target="_blank">
                      <img src="../../upload/work_noti/images/<?php  echo $images3;?>" height="100">
                    </a>
                    
                    <?php  }?>
                    <input name="images3" type="hidden" value="<?php echo  $images3; ?>">
                    <?php }?>
                  </td>
              </tr>
          </table>
        <hr>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
      <td width="8%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
      <td width="27%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น / แบรนด์</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>      
    </tr>
    <tbody id="exp" name="exp">
    <?php    
		$fo_id = $_GET['fo_id'];
		$quQry = mysqli_query($conn,"SELECT * FROM `s_work_noti_product` WHERE fo_id = '".$fo_id."' ORDER BY id ASC");
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
			  <?php echo get_stock_project_code($conn,$rowPro['cpro']);?></td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <select name="cpro[]" id="cpro<?php echo $rowCal;?>" class="inputselect" style="width:85%;" onChange="get_product(<?php echo $rowCal;?>);">
					<option value="">กรุณาเลือกรายการ</option>
					<?php    
						$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_stock_project ORDER BY group_name ASC");
						while($row_qupro1 = @mysqli_fetch_array($qupro1)){
						  ?>
							<option value="<?php echo $row_qupro1['group_id'];?>" <?php if($rowPro['cpro'] == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
						  <?php    	
						}
				  ?>
			  </select>
			  <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro<?php     echo $rowCal;?>&col=<?php echo $rowCal;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" id="cpropod<?php echo $rowCal;?>">
			  <input type="hidden" name="cpod[]" value="<?php echo $rowPro['cpod'];?>" class="inpfoder" style="width:100%;text-align:center;">
        <?php echo get_stock_project_sn($conn,$rowPro['cpro']);?>
        </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" id="cprosize<?php echo $rowCal;?>">
			  <input type="hidden" name="csn[]" value="<?php echo $rowPro['csn'];?>" id="csn<?php echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;">
		  	  <?php echo get_stock_project_size($conn,$rowPro['cpro']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="camount[]" value="<?php     echo $rowPro['camount'];?>" id="camount<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;">
				<input type="hidden" name="camountH[]" value="<?php     echo $rowPro['camount'];?>">
			  </td>

			</tr>
			<?php    
			$rowCal++;
		}
	?>
    </tbody>
    <input type="text" hidden="hidden" value="<?php     echo $rowCal;?>" id="countexp" name="countexp"/>

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
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" id="cpropod'+countBox+'">';
      				filedMore += '		<input type="hidden" name="cpod[]" value="" class="inpfoder" style="width:100%;text-align:center;"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" id="cprosize'+countBox+'">';
      				filedMore += '		<input type="hidden" name="csn[]" value=""  class="inpfoder" style="width:100%;text-align:center;"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
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
    <hr>
    <p><strong style="font-size: 15px;">หมายเหตุ</strong></p>
        <textarea name="remark" id="remark" style="height:200px;font-size: 15px;line-height: 25px;"><?php echo strip_tags(stripslashes($remark));?></textarea>
        </td>
      </tr>
    </table>
    <br>
  
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
       <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                  <strong ><input type="text" name="sign_work1" value="<?php echo $sign_work1;?>" id="sign_work1" class="inpfoder" style="width:50%;text-align:center;"></strong>
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>ผู้แจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date_work1" value="<?php if($sign_date_work1 == ""){echo date("d/m/Y");}else{ echo $sign_date_work1;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date_work1'});</script></strong>
                </td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                  <strong ><input type="text" name="sign_work2" value="<?php echo $sign_work2;?>" id="sign_work2" class="inpfoder" style="width:50%;text-align:center;"></strong>
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>หัวหน้า / ผู้แจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date_work2" value="<?php if($sign_date_work2 == ""){echo date("d/m/Y");}else{ echo $sign_date_work2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date_work2'});</script></strong>
                </td>
              </tr>
            </table>

        </td>
        
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
                  <input type="text" name="sign_work3" value="<?php echo $sign_work3;?>" id="sign_work3" class="inpfoder" style="width:50%;text-align:center;"></strong>
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                  <strong>ผู้รับแจ้งงาน</strong>
                </td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date_work3" value="<?php if($sign_date_work3 == ""){echo date("d/m/Y");}else{ echo $sign_date_work3;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date_work3'});</script></strong>
                </td>
              </tr>
            </table>
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
      <input name="mode" type="hidden" id="mode" value="<?php echo $_GET["mode"];?>">
      <input name="status" type="hidden" id="status" value="<?php echo $status;?>">
      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php echo $PK_field;?>" value="<?php     echo $_GET[$PK_field];?>">
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
