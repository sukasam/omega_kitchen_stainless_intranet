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

		$pro_list = '';
		foreach($_POST['pro_list'] as $a => $b){
			$pro_list .= $b.',';
		}
		
		$_POST['pro_list'] = rtrim($pro_list, ",");


		if($_POST['date_chk1'] != ""){
			$a_sdate=explode("/",$_POST['date_chk1']);
			$_POST['date_chk1']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk1']= '0000-00-00';
		}

		if($_POST['date_chk2'] != ""){
			$a_sdate=explode("/",$_POST['date_chk2']);
			$_POST['date_chk2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk2']= '0000-00-00';
		}

		if($_POST['date_chk3'] != ""){
			$a_sdate=explode("/",$_POST['date_chk3']);
			$_POST['date_chk3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk3']= '0000-00-00';
		}

		if($_POST['date_chk4'] != ""){
			$a_sdate=explode("/",$_POST['date_chk4']);
			$_POST['date_chk4']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk4']= '0000-00-00';
		}

		if($_POST['date_chk5'] != ""){
			$a_sdate=explode("/",$_POST['date_chk5']);
			$_POST['date_chk5']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk5']= '0000-00-00';
		}

		if($_POST['date_chk6'] != ""){
			$a_sdate=explode("/",$_POST['date_chk6']);
			$_POST['date_chk6']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk6']= '0000-00-00';
		}

		if($_POST['date_chk7'] != ""){
			$a_sdate=explode("/",$_POST['date_chk7']);
			$_POST['date_chk7']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk7']= '0000-00-00';
		}

		if($_POST['date_chk8'] != ""){
			$a_sdate=explode("/",$_POST['date_chk8']);
			$_POST['date_chk8']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}else{
			$_POST['date_chk8']= '0000-00-00';
		}

		if ($_POST["mode"] == "add") { 
			
			$_POST['approve'] = 0;
			$_POST['st_setting'] = 0;
			$_POST['supply'] = 0;

			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			
			//$_POST['sr_stime'] = date ("Y-m-d", strtotime("+7 day", strtotime($_POST['sr_stime'])));  

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
				
				$target_dir = "../../upload/order_product/images/";
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
				
				$target_dir = "../../upload/order_product/images/";
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
				
				$target_dir = "../../upload/order_product/images/";
				$target_file = $target_dir . basename($filename);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["fimages3"]["tmp_name"]);
				
				@move_uploaded_file($_FILES["fimages3"]["tmp_name"], $target_file);
				$sql = "update $tbl_name set images3 = '".$filename."' where $PK_field = '".$id."' ";
				@mysqli_query($conn, $sql);	

	} // end if ($_FILES[fimages][name] != "")	
	
			include_once("../mpdf54/mpdf.php");
			include_once("form_orderproject.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/order_product/'.$chaf.'.pdf','F');
			
			header ("location:index.php?" . $param); 
		}
		if ($_POST["mode"] == "update" ) {

			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			 
			include ("../include/m_update.php");
			
			$id = $_REQUEST[$PK_field];		

			if ($_FILES['fimages1']['name'] != "") { 
				@unlink("../../upload/order_product/images/".$_REQUEST['images1']);
				
				$mname="";
				$mname=gen_random_num(5);
				$filename = "";
				if($filename == "")
				$name_data=explode(".",$_FILES['fimages1']['name']);
				$type = $name_data[1];
				$filename = $mname.".".$type;
				
				$target_dir = "../../upload/order_product/images/";
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
				@unlink("../../upload/order_product/images/".$_REQUEST['images2']);
				
				$mname="";
				$mname=gen_random_num(5);
				$filename = "";
				if($filename == "")
				$name_data=explode(".",$_FILES['fimages2']['name']);
				$type = $name_data[1];
				$filename = $mname.".".$type;
				
				$target_dir = "../../upload/order_product/images/";
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
				@unlink("../../upload/order_product/images/".$_REQUEST['images3']);
				
				$mname="";
				$mname=gen_random_num(5);
				$filename = "";
				if($filename == "")
				$name_data=explode(".",$_FILES['fimages3']['name']);
				$type = $name_data[1];
				$filename = $mname.".".$type;
				
				$target_dir = "../../upload/order_product/images/";
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
			include_once("form_orderproject.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/order_product/'.$chaf.'.pdf','F');
			
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
		
		$pro_list = explode(',',$pro_list);

		$fopj_info = get_fopj($conn,$cus_id);

		if($date_chk1 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk1);
			$date_chk1=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk1= '';
		}

		if($date_chk2 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk2);
			$date_chk2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk2= '';
		}

		if($date_chk3 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk3);
			$date_chk3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk3= '';
		}

		if($date_chk4 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk4);
			$date_chk4=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk4= '';
		}

		if($date_chk5 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk5);
			$date_chk5=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk5= '';
		}

		if($date_chk6 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk6);
			$date_chk6=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk6= '';
		}

		if($date_chk7 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk7);
			$date_chk7=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk7= '';
		}

		if($date_chk8 != "0000-00-00"){
			$a_sdate=explode("-",$date_chk8);
			$date_chk8=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$date_chk8= '';
		}

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
	
</script>
<SCRIPT language=Javascript>
      function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
	  }
	  
	  
</SCRIPT>

<script type="text/javascript">
	
	
	function get_customer(cid,cname,chk){
		/*alert(cid);
		alert(cname);*/
		var sCustomerName = document.getElementById("cd_names");
		
		sCustomerName.value = cname;
		
		var sCustomerSource = document.getElementById("cus_source");
		
		sCustomerSource.value = chk;
		checkfirstorder(cid,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist','sr_ctype2',chk);
		document.getElementById("rsnameid").innerHTML="<input type=\"hidden\" name=\"cus_id\" value=\""+cid+"\">";
	}
	
	function get_cus2(pval,chk){
		/*alert(pval);*/
		var xmlHttp;
		
		//alert(chk);
		if(chk == 'po'){
			document.getElementById("search_fo").value = '';
		}else{
			document.getElementById("search_po").value = '';
		}
		
	   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
	   URL = pathLocal+'ajax_return.php?action=getcus2&pval='+pval+'&chk='+chk;
	   if (xmlHttp==null){
		  alert ("Browser does not support HTTP Request");
		  return;
	   }
		xmlHttp.onreadystatechange=function (){
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
				//document.getElementById('rscus').innerHTML = xmlHttp.responseText;
				//alert(xmlHttp.responseText);
				var ds = xmlHttp.responseText.split("|");
				//alert(ds[1]);
				get_customer(ds[1],ds[2],ds[3]);
				
			} else{
			  //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
			}
	   };
	   xmlHttp.open("GET",URL,true);
	   xmlHttp.send(null);
	}

	function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
	}
	


</script>
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
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
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
            	<img src="../images/form/header_order_product.png" width="100%" border="0" style="max-width:1182px;"/>
            </div>
		</td>
	  </tr>
	</table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td><strong>ชื่อลูกค้า :</strong> 
                <input name="cd_names" type="text" id="cd_names"  value="<?php echo $fopj_info['cd_name'];?>" style="width:50%;" readonly>
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php echo $fopj_info['fo_id'];?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?chk=fo');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td><strong>กลุ่มลูกค้า :</strong> 
				<select name="sr_ctype" id="sr_ctype" class="inputselect">
                <?php    
                	$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
					while($row_cgtype = @mysqli_fetch_array($qucgtype)){
					  ?>
					  	<option value="<?php echo $row_cgtype['group_id'];?>" <?php if($sr_ctype == $row_cgtype['group_id']){echo 'selected';}?>><?php     echo $row_cgtype['group_name'];?></option>
					  <?php    	
					}
				?>
            </select>
				<strong>ประเภทลูกค้า :</strong>
				<select name="sr_ctype2" id="sr_ctype2" class="inputselect" onChange="chksign(this.value);">
                <?php    
                	$quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
					while($row_cgcus = @mysqli_fetch_array($quccustommer)){
						if(substr($row_cgcus['group_name'],0,2) != "SR"){
					  ?>
					  	<option value="<?php     echo $row_cgcus['group_id'];?>" <?php     if($sr_ctype2 == $row_cgcus['group_id']){echo 'selected';}?>><?php     echo $row_cgcus['group_name'];?></option>
					  <?php    	
						}
					}
				?>
            </select>
            	</td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php   echo $fopj_info['cd_address'];?></span></td>
            <td>
            <strong>เลขที่ใบผลิตสินค้า</strong> :
<input type="text" name="sv_id" value="<?php   if($sv_id == ""){echo check_product_order($conn);}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">

<!--&nbsp;&nbsp;<strong>เลขที่ใบงาน</strong> : -->
<!--<input type="text" name="sv_id" value="<?php   if($sv_id == ""){echo "SR";}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">&nbsp;&nbsp;เลขที่สัญญา  :</strong> <span id="contactid"><?php   echo $finfo['fs_id'];?></span><strong>
<input type="text" name="srid" value="<?php   echo $srid;?>" id="srid" class="inpfoder"></strong>-->
		
			
			<strong>เลขที่ FO/PJ :</strong> <input type="text" name="search_fo" value="<?php echo $search_fo;?>" id="search_fo" class="inpfoder">&nbsp;&nbsp;
			<!-- <strong>เลขที่ PJ :</strong> <input type="text" name="search_po" value="<?php echo $search_po;?>" id="search_po" class="inpfoder" onkeyup="get_cus2(this.value,'po');"> -->
			</td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php   echo province_name($conn,$fopj_info['cd_province']);?></span></td>
            <td><strong>วันที่สั่งผลิตสินค้า  :</strong> <span id="datef"></span>
              <input type="text" name="job_open" readonly value="<?php  if($job_open==""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_open'});</script>
			  &nbsp;&nbsp;
			  <strong>กำหนดผลิตเสร็จ :</strong>
              <input type="text" name="job_balance" readonly value="<?php  if($job_balance==""){echo date("d/m/Y");}else{ echo $job_balance;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_balance'});</script>
              <input type="hidden" name="job_close" value="<?php  if($job_close==""){echo date("d/m/Y");}else{ echo $job_close;}?>" class="inpfoder"/>
			  </td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php   echo $fopj_info['cd_tel'];?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php   echo $fopj_info['cd_fax'];?></span></td>
            <td>
			  <strong>กำหนดส่งสินค้า  :</strong>
			  <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="sr_stime" readonly value="<?php  if($sr_stime==""){echo date("d/m/Y");}else{ echo $sr_stime;}?>" class="inpfoder"/>
			  <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sr_stime'});</script>
			  &nbsp;&nbsp; 
			  <strong>พนักงานขาย  :</strong> <span id="cssale"><?php   echo getsalename($conn,$fopj_info['cs_sell']);?></span>
            </span></td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php   echo $fopj_info['c_contact'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php   echo $fopj_info['c_tel'];?></span></td>
            <td></td>
          </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
      <tr>
        <td width="50%">
			<strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong><span id="sloc_name"><?php   echo $fopj_info['loc_name'];?></span><br />
			<br>
			<table>
				<tr>
					<td style="border: 0px;border-bottom: 1px solid;"><strong>รายละเอียดงาน</strong></td>
					<td style="border: 0px;border-bottom: 1px solid;"><strong>วันที่รับงาน</strong></td>
					<td style="border: 0px;border-bottom: 1px solid;"><strong>วันที่แล้วเสร็จ</strong></td>
				</tr>
				<tr>
					<td style="border: 0px;"><strong>แผนกตัด/พับ</strong></td>
					<td style="border: 0px;"><strong>วันที่ : 
						<input type="text" name="date_chk1" value="<?php  if($date_chk1==""){}else{ echo $date_chk1;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk1'});</script>
					</td>
					<td style="border: 0px;"><strong>วันที่ :</strong>
						<input type="text" name="date_chk2" value="<?php  if($date_chk2==""){}else{ echo $date_chk2;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk2'});</script>
					</td>
				</tr>
				<tr>
					<td style="border: 0px;"><strong>แผนกเชื่อม/ประกอบ</strong></td>
					<td style="border: 0px;"><strong>วันที่ :</strong>
						<input type="text" name="date_chk3" value="<?php  if($date_chk3==""){}else{ echo $date_chk3;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk3'});</script>
					</td>
					<td style="border: 0px;"><strong>วันที่ :</strong>
						<input type="text" name="date_chk4" value="<?php  if($date_chk4==""){}else{ echo $date_chk4;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk4'});</script>	
					</td>
				</tr>
				<tr>
					<td style="border: 0px;"><strong>แผนกขัด/แต่ง</strong></td>
					<td style="border: 0px;"><strong>วันที่ :</strong>
						<input type="text" name="date_chk5" value="<?php  if($date_chk5 ==""){echo '';}else{ echo $date_chk5;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk5'});</script>	
					</td>
					<td style="border: 0px;"><strong>วันที่ :</strong>
						<input type="text" name="date_chk6" value="<?php  if($date_chk6==""){}else{ echo $date_chk6;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk6'});</script>	
					</td>
				</tr>
				<tr>
					<td style="border: 0px;"><strong>แผนกล้าง/แพ็ค</strong></td>
					<td style="border: 0px;"><strong>วันที่ :</strong>
						<input type="text" name="date_chk7" value="<?php  if($date_chk7==""){}else{ echo $date_chk7;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk7'});</script>	
					</td>
					<td style="border: 0px;"><strong>วันที่ :</strong>
						<input type="text" name="date_chk8" value="<?php  if($date_chk8==""){}else{ echo $date_chk8;}?>" class="inpfoder"/>
						<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_chk8'});</script>
					</td>
				</tr>
			</table>
		</td>
                
        <td width="50%"><center><strong>รายละเอียดสินค้าสั่งผลิต</strong></center><br><br>
        <textarea name="detail_recom" class="inpfoder" id="detail_recom" style="width:50%;height:100px;background:#FFFFFF;"><?php   echo strip_tags($detail_recom);?></textarea></td>
      </tr>
    </table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
          <table>
              <tr>
                  <td>
                    <strong>รูปภาพประกอบ ที่ 1</strong><br/><br>
                    <input name="fimages1" type="file" id="fimages1">
                    <br>
                    <?php  
                    if($_GET['mode'] != 'add'){
                      if($images1 != ""){?><br>
                    <a href="../../upload/order_product/images/<?php  echo $images1;?>" target="_blank">
                      <img src="../../upload/order_product/images/<?php  echo $images1;?>" height="100">
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
                    <a href="../../upload/order_product/images/<?php  echo $images2;?>" target="_blank">
                      <img src="../../upload/order_product/images/<?php  echo $images2;?>" height="100">
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
                    <a href="../../upload/order_product/images/<?php  echo $images3;?>" target="_blank">
                      <img src="../../upload/order_product/images/<?php  echo $images3;?>" height="100">
                    </a>
                    
                    <?php  }?>
                    <input name="images3" type="hidden" value="<?php echo  $images3; ?>">
                    <?php }?>
                  </td>
              </tr>
          </table>
        <hr>
    
    <center>
      <br>
      <span style="font-size:18px;font-weight:bold;">รายละเอียดสินค้าสั่งผลิต</span></center><br>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
	  <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong></strong></td>
      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
      <td width="24%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น / แบรนด์</strong></td>
	  <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      
    </tr>
    <tbody id="expPro" name="expPro">
	<?php    
	
		$proList = get_fopj_pro($conn,$cus_id);
		$rowCal = 1;
		$chkOp = get_checkOP($conn,$cus_id,$_GET['sr_id']);
		$proOpList = explode(',',$chkOp);

		while($rowPro = mysqli_fetch_array($proList)){

			$checkPPList = (in_array($rowCal,$pro_list)) ? 'checked="checked"' : '';
			$ReChkOp = (in_array($rowCal,$proOpList)) ? '' : '<input type="checkbox" name="pro_list[]" value="'.$rowCal.'" '.$checkPPList.'>' ;

			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $ReChkOp;?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;"><?php     echo $rowCal;?></td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo get_stock_project_code($conn,$rowPro['cpro']);?></td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_stock_project_name($conn,$rowPro['cpro']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" id="cpropod<?php echo $rowCal;?>">
			  <?php echo get_stock_project_sn($conn,$rowPro['cpro']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" id="cprosize<?php echo $rowCal;?>">
		  	  <?php echo get_stock_project_size($conn,$rowPro['cpro']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $rowPro['camount'];?>
			  </td>
			</tr>
			<?php    
			$rowCal++;
		}
	?>
    </tbody>
    </table>
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
	  <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  
				  <input type="text" name="loc_contact2" id="loc_contact2" value="<?php echo $loc_contact2;?>" style="text-align: center;">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้สั่งผลิตสินค้า</strong></td>
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
                 
				  <input type="text" name="cs_sell" id="cs_sell" value="<?php echo $cs_sell;?>" style="text-align: center;">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ตรวจสอบแบบและการผลิตสินค้า</strong></td>
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
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  
				  <input type="text" name="loc_contact3" id="loc_contact3" value="<?php echo $loc_contact3;?>" style="text-align: center;">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติ / หัวหน้าฝ่ายผลิต</strong></td>
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
