<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission ($check_module,$_SESSION[login_id],"read");
	if ($_GET[page] == ""){$_REQUEST[page] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	//-------------------------------------------------------------------------------------
	if($_REQUEST[action] == "delete"){
		$code = Check_Permission ($check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '$_GET[$PK_field]'";
			@mysql_query($sql);			
			
			if(file_exists("../../upload/news/".$_GET[del_id]))
			@unlink("../../upload/news/".$_GET[del_id]);		
	
			$sql = "update $tbl_name set image_name=' ' where $PK_field = '$_GET[$PK_field]' ";
			@mysql_query($sql);
			header ("location:index.php"); 
		} 
	}
	//-------------------------------------------------------------------------------------
	 if ($_GET[b] <> "" and $_GET[s] <> "") { 
		if ($_GET[s] == 0) $status = 1;
		if ($_GET[s] == 1) $status = 0;
		Check_Permission ($check_module,$_SESSION[login_id],"update");
		$sql_status = "update $tbl_name set status = '$status' where $PK_field = '$_GET[b]'";
		@mysql_query ($sql_status);
		header ("location:?"); 
	}
	//-------------------------------------------------------------------------------------
	
	header ("location:update.php?mode=update&user_id=".$_SESSION['login_id']."&page=1&mid=".$_GET['mid']); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php   echo $s_title;?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    window.location = delUrl;
  }
}
//----------------------------------------------------------
function check_select(frm){
		if (frm.choose_action.value==""){
			alert ('Choose an action');
			frm.choose_action.focus(); return false;
		}
}	
</script>
</HEAD>
<?php   include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php   include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php   include('../top.php');?>
<P id=page-intro><?php   echo ucfirst ($page_name); ?></P>

<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="update.php?mode=add<?php   if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่มข้อมูล</SPAN></A></LI> 
    <?php   
	if ($FR_module <> "") { 
	$param2 = get_return_param();
	?>
  <LI><A class=shortcut-button href="../profiles/?<?php   if($param2 <> "") echo $param2;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>ย้อนกลับ</SPAN></A></LI>
  <?php   }?> 
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php   echo ucfirst ($page_name); ?></H3>
<br><form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php   echo $keyword;?>">
    <input name="Action" type="submit" id="Action" value="Search">
    <?php  
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?<?php   echo $param2;?>">แสดงทั้งหมด</a>
    <?php   
			$a_not_exists = array();
			post_param($a_param,$a_not_exists);
			?>
  </form>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
          <TH width="7%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>
          <TH width="7%" <?php   Show_Sort_bg ($PK_field, $orderby) ?>> <?php  
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php    Show_Sort_new ($PK_field, "ลำดับ.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
          <TH width="61%" <?php   Show_Sort_bg ("usetype_name", $orderby) ?>>
            <a>ชื่อข้อมูล</a>
            &nbsp;</TH>
          <TH width="9%"><a>แก้ไข</a></TH>
          <TH width="7%"><a>ลบ</a></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php   
					if($orderby=="") $orderby = $tbl_name.".".$PK_field;
					if ($sortby =="") $sortby ="desc";
					
				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ";
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET[keyword] <> "") { 
						$sql .= "and ( " .  $PK_field  . " like '%$_GET[keyword]%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= "or " . $value  . " like '%" . $_GET[keyword] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
					} 
					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					//echo $sql;
					$query = @mysql_query ($sql);
					if($_GET[page] == "") $_GET[page] = 1;
					$counter = ($_GET[page]-1)*$pagesize;
					
					while ($rec = @mysql_fetch_array ($query)) { 
					$counter++;
				   ?>
        <TR>
          <TD><INPUT type=checkbox name="del[]" value="<?php   echo $rec[$PK_field]; ?>" ></TD>
          <TD><span class="text"><?php   echo $counter ; ?></span></TD>
          <TD style="vertical-align:middle"><span class="text" style="text-transform:uppercase;">&nbsp;<?php   echo $rec["usetype_name"]; ?></span></TD>
          <TD><!-- Icons -->
            <A title=Edit href="update.php?mode=update&<?php   echo $PK_field; ?>=<?php   echo $rec["$PK_field"]; if($param <> "") {?>&<?php   echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          <TD><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php   echo $PK_field; ?>=<?php   echo $rec[$PK_field];?>&del_id=<?php   echo $rec[file_name];?>','<?php   echo $title_del;?>  <?php   echo $rec[$PK_field];?> : <?php   echo $rec[$title_del_name];?>')"></A></TD>
        </TR>  
		<?php   }?>
      </TBODY>
    </TABLE>
    <br><br>
    <DIV class="bulk-actions align-left">
            <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>            
            <?php  
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
            <input class=button name="Action2" type="submit" id="Action2" value="ยืนยันการเลือก">
          </DIV> <DIV class=pagination> <?php   include("../include/page_show.php");?> </DIV>
  </form>  
</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php   include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>
