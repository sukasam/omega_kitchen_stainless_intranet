<?php    
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST["page"] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
  if ($_GET["action"] == "apps") { 
	 
		$cc = $_GET['cc'];
	  $ids = $_GET['fo_id'];
	   
	   Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");

     $appID = userSaleGroupID($conn,$_SESSION["login_id"]);
     
		// echo $appID;
		// exit();
     
    if($cc == 1){
      if($appID == '') $appID = '0';
      $sql_status = "update $tbl_name set approve2 = '".$cc."', sign_work3 = '".$appID."', sign_date_work3 = '".date("Y-m-d")."' where $PK_field = '".$ids."'";
      @mysqli_query($conn,$sql_status);
     }else{
      if($appID == '') $appID = '0';
      $sql_status = "update $tbl_name set approve2 = '".$cc."', sign_work3 = '', sign_date_work3 = '".date("Y-m-d")."' where $PK_field = '".$ids."'";
      @mysqli_query($conn,$sql_status);
     }

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
    Project Order</SPAN></A></LI>
    <LI><A class=shortcut-button href="../fo-pj/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
    FO/PJ</SPAN></A></LI>
  <LI><A class=shortcut-button href="../work_noti/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-section.png"><BR>
    ใบแจ้งงาน</SPAN></A></LI> -->
    <LI><A class=shortcut-button href="../work_noti/"><SPAN><IMG  alt=icon src="../images/btn_back.gif" width="32"><BR><BR>
  กลับ</SPAN></A></LI>
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php     echo $check_module; ?></H3>
<br>
<div style="float:right;padding-top:0px;">
<form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php     echo $keyword;?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php    
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?<?php     echo $param2;?>">แสดงทั้งหมด</a>
    <?php     
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
  </form>
  </div>
  <div style="float:right;margin-right:20px;padding-top:0px;">  
	<label><strong>สถานะการยืนยัน : </strong></label>
    <select name="catalog_master" id="catalog_master" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
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
          <TH width="10%">ลำดับ.</TH>
          <TH width="10%">ใบแจ้งงาน</TH>
          <TH width="25%">ชื่อลูกค้า</TH>
          <TH width="25%"><strong>สถานที่ติดตั้ง</strong></TH>
          <TH width="15%"><strong>ชื่อผู้แจ้ง</strong></TH>
          <TH width="15%"><div align="center">การยืนยัน</div></TH>
          <TH width="10%"><div align="center">ดาวน์โหลด</div></TH>
          <!-- <TH width="15%" nowrap ><div align="center"><a>Open / Close</a></div></TH>
          <TH width="15%"><div align="center"><a>ติดตามสถานะ<br/>ใบสั่งงาน/แจ้งงาน</a></div></TH>
          <TH width="5%"><a>แก้ไข</a></TH>
          <TH width="5%"><a>ลบ</a></TH> -->
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php     
					if($orderby=="") $orderby = $tbl_name.".".$PK_field;
					if ($sortby =="") $sortby ="DESC";
					
				  $sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 AND approve = 1";
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
						$sql .= " and ( approve2 = '".$_GET["app_id"]."' ";
						$sql .=  $subtext . " ) ";
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
          $chaf = preg_replace("/\//","-",$rec["fs_id"]);
				   ?>
        <TR>
          <TD style="vertical-align: middle;"><span class="text"><?php     echo sprintf("%04d",$counter); ?></span></TD>
          <TD style="vertical-align: middle;"><span class="text"><a href="../../upload/work_noti/<?php     echo $chaf;?>.pdf" target="_blank"><?php     echo $rec["fs_id"] ; ?></a></span></TD>
          <TD style="vertical-align: middle;"> <span class="text"><?php     echo $rec["cd_name"] ; ?></span></TD>
          <TD style="vertical-align: middle;"> <span class="text"><?php echo $rec["loc_name"] ; ?></span></TD>
          <TD style="vertical-align: middle;"> <span class="text"><?php echo getsalename($conn,$rec["sign_work1"]); ?></span></TD>
          <!-- <TD nowrap style="vertical-align:middle"><div align="center">
            <?php if($rec["status"]== "1") {?>
            <a href="../work_noti/?bb=<?php     echo $rec[$PK_field]; ?>&ss=<?php echo $rec["status"]; ?>&page=<?php     echo $_GET['page']; ?>&<?php     echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php } else{?>
            <a href="../work_noti/?bb=<?php     echo $rec[$PK_field]; ?>&ss=<?php echo $rec["status"]; ?>&page=<?php     echo $_GET['page']; ?>&<?php     echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php }?>
          </div></TD>
          <TD style="vertical-align: middle;"><div align="center"><a href="../work_noti_tracking?tab=WO&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"];?>"><img src="../images/tracking.png" width="40" border="0" alt=""></a></div></TD>
          <TD style="vertical-align: middle;">
            <A title=Edit href="update.php?mode=update&<?php     echo $PK_field; ?>=<?php     echo $rec[$PK_field]; if($param <> "") {?>&<?php     echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          <TD style="vertical-align: middle;"><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php     echo $PK_field; ?>=<?php     echo $rec[$PK_field];?>','Group  <?php     echo $rec[$PK_field];?> : <?php     echo $rec["group_name"];?>')"></A></TD> -->
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
		
          <TD>
		    <center><A title="view" href="../../upload/work_noti/<?php echo $chaf;?>.pdf" target="_blank"><IMG alt="view" src="../images/icon2/backup.png" width="25"></A></center></TD>
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
