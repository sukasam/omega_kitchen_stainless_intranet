<?php    
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST["page"] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if($_GET["action"] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '".$_GET[$PK_field]."'";
			@mysqli_query($conn,$sql);			
			header ("location:index.php");
		} 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET["b"] <> "" and $_GET["s"] <> "") { 
		if ($_GET["s"] == 0) $status = 1;
		if ($_GET["s"] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql_status = "update $tbl_name set st_setting = '".$status."' where $PK_field = '".$_GET["b"]."'";
		@mysqli_query($conn,$sql_status);
		if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
		header ("location:?".$conpage); 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET["bb"] <> "" and $_GET["ss"] <> "") { 
		if ($_GET["ss"] == 0) $status = 1;
		if ($_GET["ss"] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql_status = "update $tbl_name set status = '".$status."' where $PK_field = '".$_GET["bb"]."'";
		@mysqli_query($conn,$sql_status);
		$sql_svstatus = "update s_service_report set st_setting = '".$status."' where cus_id = '".$_GET["foid"]."'";
		@mysqli_query($conn,$sql_svstatus);
		if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
		header ("location:?".$conpage); 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET["ff"] <> "" and $_GET["gg"] <> "") { 
		if ($_GET["gg"] == 0) $status_use = 0;
		if ($_GET["gg"] == 1) $status_use = 1;
		if ($_GET["gg"] == 2) $status_use = 2;
		Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql_status = "update $tbl_name set status_use = '".$status_use."' where $PK_field = '".$_GET["ff"]."'";
		@mysqli_query($conn,$sql_status);
		
		if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
		header ("location:?".$conpage); 
  }
  
  if ($_GET["action"] == "apps") { 
	 
	$cc = $_GET['cc'];
	$ids = $_GET['fo_id'];
   
   Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");

 $appID = userSaleGroupID($conn,$_SESSION["login_id"]);

  if($cc == 1){
  if($appID == '') $appID = '0';
  $sql_status = "update $tbl_name set approve2 = '".$cc."', cs_aceep = '".$appID."', sign_date3 = '".date("Y-m-d")."' where $PK_field = '".$ids."'";
  @mysqli_query($conn,$sql_status);
 }else{
  if($appID == '') $appID = '0';
  $sql_status = "update $tbl_name set approve2 = '".$cc."', cs_aceep = '', sign_date3 = '".date("Y-m-d")."' where $PK_field = '".$ids."'";
  @mysqli_query($conn,$sql_status);
 }
   

// echo $appID;
	// exit();
   header("Location:update.php?mode=update&fo_id=".$ids);
  
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
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check_select(frm){
		if (frm.choose_action.value==""){
			alert ('Choose an action');
			frm.choose_action.focus(); return false;
		}
}	
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
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
<P id=page-intro><?php     echo $page_name; ?></P>

<UL class=shortcut-buttons-set>
  <!-- <LI><A class=shortcut-button href="update.php?mode=add<?php     if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN></A></LI>
    <LI><A class=shortcut-button href="../first_order/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
    First Order</SPAN></A></LI>
    <LI><A class=shortcut-button href="../project_order/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
    Project Order<br><br></SPAN></A></LI>
    <LI><A class=shortcut-button href="../project_order_approve/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-user.png"><BR>
    อนุมัติใบ PJ (Superviser)</SPAN></A></LI>
    <LI><A class=shortcut-button href="../project_order_approve2/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-user.png"><BR>
    อนุมัติใบ PJ (GM)</SPAN></A></LI>
    <LI><A class=shortcut-button href="../fo-pj/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
    FO/PJ</SPAN></A></LI>
    <LI><A class=shortcut-button href="../work_noti/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-section.png"><BR>
    ใบแจ้งงาน</SPAN></A></LI> -->
    <LI><A class=shortcut-button href="../project_order/"><SPAN><IMG  alt=icon src="../images/btn_back.gif" width="32"><BR><BR>
  กลับ</SPAN></A></LI>
    <?php     
	if ($FR_module <> "") { 
	$param2 = get_return_param();
	?>
  <LI><A class=shortcut-button href="../<?php     echo $FR_module; ?>/?<?php     if($param2 <> "") echo $param2;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
  <?php     }?>

</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php     echo $page_name; ?></H3>
<br>
<div style="float:right;padding-top:0px;">
<form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php     echo $keyword;?>">
    <input name="app_id" type="hidden" id="app_id" value="<?php  echo $_GET['app_id'];?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php    
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
     <a href="index.php?<?php if(isset($_GET['app_id'])){echo 'app_id='.$_GET['app_id'].'&';}?><?php  echo $param2;?>">แสดงทั้งหมด</a>
    <?php     
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
  </form>
</div>
<div style="float:right;margin-right:20px;padding-top:0px;">  
	<label><strong>สถานะการยืนยัน : </strong></label>
    <select name="catalog_master" id="catalog_master" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
		<option value="index.php?app_id=4" <?php  if($_GET['app_id'] == 4){echo "selected";}?>>ทั้งหมด</option>
		<option value="index.php?app_id=0" <?php  if($_GET['app_id'] == 0){echo "selected";}?>>รอการอนุมัติ</option>
		 <option value="index.php?app_id=1" <?php  if($_GET['app_id'] == 1){echo "selected";}?>>อนุมัติ</option>
         <option value="index.php?app_id=2" <?php  if($_GET['app_id'] == 2){echo "selected";}?>>ไม่อนุมัติ</option>
  	</select>
    </div>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
      <TR>
          <TH width="5%" <?php  Show_Sort_bg ("user_id", $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ("user_id", "ลำดับ.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
          <TH width="12%">PJ ID</TH>
          <TH width="35%">ชื่อลูกค้า</TH>
          <TH width="25%"><strong>สถานที่ติดตั้ง</strong></TH>
          <TH width="15%"><div align="center">การยืนยัน</div></TH>
          <TH width="10%"><div align="center">ดาวน์โหลด</div></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php     
					if($orderby=="") $orderby = $tbl_name.".".$PK_field;
					if ($sortby =="") $sortby ="DESC";
					
				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 AND separate = 0 AND approve = 1";
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET["keyword"] <> "") { 
						$sql .= "and ( " .  $PK_field  . " like '%".$_GET["keyword"]."%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= "or " . $value  . " like '%" . $_GET["keyword"] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
          } 
          
					if ($_GET['app_id'] <> "") { 
						if($_GET['app_id'] != 4){
							$sql .= " and ( approve2 = '".$_GET["app_id"]."' ";
							$sql .=  $subtext . " ) ";
						}
					}else{
						$sql .= " and ( approve2 = '0' ";
						$sql .=  $subtext . " ) ";
					}

					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					//echo $sql;
					$query = @mysqli_query($conn,$sql);
					if($_GET["page"] == "") $_GET["page"] = 1;
					$counter = ($_GET["page"]-1)*$pagesize;
					
					while ($rec = @mysqli_fetch_array ($query)) { 
					$counter++;
				   ?>
        <TR>
         
         <TD style="vertical-align: middle;"><span class="text"><?php  echo sprintf("%04d",$counter); ?></span></TD>
         <TD style="vertical-align: middle;"><?php  $chaf = preg_replace("/\//","-",$rec["fs_id"]); ?><span class="text"><a href="../../upload/project_order/<?php  echo $chaf;?>.pdf" target="_blank"><?php  echo $rec["fs_id"] ; ?></a></span></TD>
         <TD style="vertical-align: middle;">          
           <span class="text"><?php  echo $rec["cd_name"] ; ?></span>
         </TD>
         <TD style="vertical-align: middle;"><span class="text"><?php  echo $rec["loc_name"] ; ?></span></TD>
         <TD style="vertical-align:middle;">
         <center>
          <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)" style=" <?php  if($rec["approve2"] == "0"){echo "background:#FF0;color:#000;";}elseif($rec["approve2"] == "1"){echo "background:#090;color:#FFF;";}elseif($rec["approve2"] == "3"){echo "background:#C60;color:#FFF;";}else{echo "background:#F00;color:#FFF;";}?>">
                  <option value="index.php?action=apps&cc=0&fo_id=<?php  echo $rec["fo_id"];?>&page=<?php  echo $_GET["page"];?>" <?php  if($rec["approve2"] == "0"){echo 'selected="selected"';}?> style="background:#FFF;color:#000;">รอการอนุมัติ</option>
                  <option value="index.php?action=apps&cc=1&fo_id=<?php  echo $rec["fo_id"];?>&page=<?php  echo $_GET["page"];?>" <?php  if($rec["approve2"] == "1"){echo 'selected="selected"';}?> style="background:#FFF;color:#000;">อนุมัติ</option>
                  <option value="index.php?action=apps&cc=2&fo_id=<?php  echo $rec["fo_id"];?>&page=<?php  echo $_GET["page"];?>" <?php  if($rec["approve2"] == "2"){echo 'selected="selected"';}?> style="background:#FFF;color:#000;">ไม่อนุมัติ</option>
                  <!--<option value="index.php?action=apps&cc=3&fo_id=<?php  echo $rec["fo_id"];?>&page=<?php  echo $_GET["page"];?>" <?php  if($rec["approve2"] == "3"){echo 'selected="selected"';}?> style="background:#FFF;color:#000;">จ่ายแล้ว</option>-->
                </select>
          </center>
         </TD>
          <TD style="vertical-align: middle;"><div align="center"><a href="../../upload/project_order/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20" border="0" alt=""></a></div></TD>

       </TR>  
		<?php     }?>
      </TBODY>
    </TABLE>
    <br><br>
    <DIV class="bulk-actions align-left">
            <!-- <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>             -->
            <?php    
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
            <!-- <input class=button name="Action2" type="submit" id="Action2" value="ตกลง"> -->
          </DIV> <DIV class=pagination> <?php     include("../include/page_show.php");?> </DIV>
  </form>  
</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php     include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>
