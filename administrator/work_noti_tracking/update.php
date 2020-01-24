<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST["mode"] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);

		$_POST['group_detail'] = addslashes($_POST['group_detail']);

		$a_sdate=explode("/",$_POST['group_date']);
		$_POST['group_date']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		if ($_POST["mode"] == "add") { 
				include "../include/m_add.php";
			header ("location:index.php?tab=".$_POST['group_type']."&fo_id=".$_POST['fo_id']); 
		}
		if ($_POST["mode"] == "update" ) { 
			include ("../include/m_update.php");
			header ("location:index.php?tab=".$_POST['group_type']."&fo_id=".$_POST['fo_id']); 
		}
	}
	if ($_GET[mode] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"add");
	}
	if ($_GET[mode] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array ($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}

		$a_sdate=explode("-",$group_date);
		$group_date=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<!-- <SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT> -->
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
function submitForm() {
	document.getElementById("submitF").disabled = true;
	document.getElementById("resetF").disabled = true;
	document.form1.submit()
}
</script>
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><table class="formFields" cellspacing="0" width="100%">
              <tr >
                <td nowrap class="name">วันที่</td>
                <td><input type="text" name="group_date" readonly value="<?php  if($group_date==""){echo date("d/m/Y");}else{ echo $group_date;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'group_date'});</script></td>
              </tr>
              <tr >
                <td nowrap class="name">เวลา</td>
                <td><input name="group_time" type="time" id="group_time"  value="<?php  echo $group_time; ?>" size="60"></td>
              </tr>
			  <tr >
                <td nowrap class="name" style="vertical-align: top;">รายละเอียดงาน</td>
                <td>
				<input name="group_detail" type="text" id="group_detail"  value="<?php  echo strip_tags($group_detail); ?>" size="150">
				<!-- <textarea rows="4" cols="50" name="group_detail" id="group_detail"><?php  echo $group_detail; ?></textarea> -->
				</td>
              </tr>
			  <!-- <tr >
                <td nowrap class="name"></td>
                <td></td>
              </tr> -->
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
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
	  <input name="group_type" type="hidden" id="group_type" value="<?php  echo $_GET['tab'];?>">
	  <input name="fo_id" type="hidden" id="fo_id" value="<?php  echo $_GET['fo_id'];?>">
      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">
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
