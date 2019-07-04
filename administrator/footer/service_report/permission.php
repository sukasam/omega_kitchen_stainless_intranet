<?
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$a_param = array('page','orderby','sortby','keyword','pagesize','group_id');
	$param = get_param($a_param,$a_not_exists);

	if($_POST[Submit] == "Submit"){
			header ("location:index.php?" . $param); 
		}

	//if ($_REQUEST[mode] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		if ($_REQUEST[option] == "Add") { 
			//include "../include/m_add.php";
			// filedlist(group_id,module_id,read_p,add_p,update_p,delete_p)
			$sql = "insert into s_user_p (group_id,module_id,read_p,add_p,update_p,delete_p) values ";
			$sql.= "('$_POST[group_id]','$_POST[module_id]','$_POST[read_p]','$_POST[add_p]','$_POST[update_p]','$_POST[delete_p]')";
			@mysql_query($sql);
			header ("location:?" . $param); 
		}
		if ($_REQUEST[option] == "Edit" ) { 
			//include ("../include/m_update.php");
			$sql = "update s_user_p  set group_id = '$_POST[group_id]',module_id = '$_POST[module_id]',read_p = '$_POST[read_p]',add_p = '$_POST[add_p]',update_p = '$_POST[update_p]',delete_p = '$_POST[delete_p]', update_date = '".date("Y-m-d H:i:s")."', update_by= '$_SESSION[login_id]' where user_p_id = '$_REQUEST[user_p_id]' ";
			@mysql_query($sql);
			header ("location:?" . $param); 
		}
//	}
	
	if($_GET[action] == "delete"){
		$sql = "delete from s_user_p where user_p_id = '$_GET[user_p_id]'";
		@mysql_query($sql);
		header ("location:?" . $param); 
	}
	
	if ($_GET[mode] == "add") { 
		 Check_Permission ($check_module,$_SESSION[login_id],"add");
	}
	if ($_GET[mode] == "update") { 
		 Check_Permission ($check_module,$_SESSION[login_id],"update");
		 $_SESSION[s_user_id] = $_GET[user_id];
		/*$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysql_query ($sql);
		while ($rec = @mysql_fetch_array ($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}*/
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><? echo $s_title;?></TITLE>
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

</script>
</HEAD>
<? include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<? include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<? include('../top.php');?>
<P id=page-intro><? if ($mode == "add") { ?>Enter new information<? } else { ?>Update  details	[<? echo $page_name; ?>]<? } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>Back</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><? echo ucfirst ($check_module); ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"  >
    <div class="formArea">
      <fieldset>
      <legend><? echo ucfirst ($page_name); ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
          <td height="54"><table width="100%" border="0" cellspacing="0" class="formFields">
              <tr >
                <td width="199" class="name" style="color:#0C0;">Group &gt;
                    <? 
							$sql = "select * from $tbl_name where $PK_field = '$_GET[$PK_field]' ";
							$rec = @mysql_fetch_array(@mysql_query($sql));
							echo $rec[group_name];
						?>
                </td>
                <td colspan="6">&nbsp;</td>
              </tr>
              <tr >
                <td height="26" class="name">Module</td>
                <td width="43"><div align="center">Read</div></td>
                <td width="35"><div align="center">Add</div></td>
                <td width="56"><div align="center">Update</div></td>
                <td width="50"><div align="center">Delete</div></td>
                <td width="82"><div align="center"></div></td>
                <td width="131"><div align="center"></div></td>
              </tr>
              <?
					$i =0;
	$sql = "select *,s_module.module_id as module_id from $tbl_name left join s_user_p on $tbl_name.$PK_field = s_user_p.$PK_field  inner join s_module on s_module.module_id = s_user_p.module_id where user_id = '0' and $tbl_name.$PK_field = '$_GET[$PK_field]' ";
		$query = @mysql_query($sql);
		while($rec = @mysql_fetch_array($query)){
			$i++;
	?>
              <tr <? if ($counter++%2) { ?>class="oddrowbg" <? } else { ?> class="evenrowbg"<? } ?>>
                <td height="26" class="name">&nbsp;&nbsp; <? echo $rec[module_name];?></td>
                <td><div align="center">
                    <? if($rec[read_p] == 1) $image = 1; else $image = 0;?>
                    <img src="../images/check<? echo $image?>.gif" border="0"> </div></td>
                <td valign="middle"><div align="center">
                    <? if($rec[add_p] == 1) $image = 1; else $image = 0;?>
                    <img src="../images/check<? echo $image?>.gif" border="0"> </div></td>
                <td valign="middle"><div align="center">
                    <? if($rec[update_p] == 1) $image = 1; else $image = 0;?>
                    <img src="../images/check<? echo $image?>.gif" border="0"> </div></td>
                <td valign="middle"><div align="center">
                    <? if($rec[delete_p] == 1) $image = 1; else $image = 0;?>
                    <img src="../images/check<? echo $image?>.gif" border="0"> </div></td>
                <td><div align="center"><a href="?action=Edit&mode=<? echo $_GET[mode]?>&<? echo "$PK_field=".$rec[$PK_field];?>&user_p_id=<? echo $rec[user_p_id];?>&module_id=<? echo $rec[module_id];?>&<? echo $param;?>">Edit</a></div></td>
                <td><div align="center"> <a href="permission.php?action=delete&mode=<? echo $_GET[mode]?>&<? echo "$PK_field=".$rec[$PK_field];?>&user_p_id=<? echo $rec[user_p_id];?>&module_id=<? echo $rec[module_id];?>&<? echo $param;?>" onClick="return confirm('คุณต้องการลบ module <? echo $rec[module_name]; ?>')">Delete</a></div></td>
              </tr>
              <? } // end while?>
              <tr >
                <td height="26" class="name"><?
					  	if($_GET[action] == "Edit"){
							$sql = "select * from s_user_p  where user_p_id = '$_GET[user_p_id]'  ";
							$query = @mysql_query($sql);
							$rec = @mysql_fetch_array($query);
							$module_id = $rec[module_id];
							$read_p = $rec[read_p];
							$add_p = $rec[add_p];
							$update_p = $rec[update_p];
							$delete_p = $rec[delete_p];
						}
							
							$sql = "select * from s_module ";
							if($_GET[action] == "Edit")
								$sql .= "where module_id = '$_GET[module_id]' ";
							$sql .= "order by module_id desc";
							$query = @mysql_query($sql);
					  ?>
                    <select name="module_id">
                      <? if($_GET[action] <> "Edit") { ?>
                      <option>Select One</option>
                      <? } 
								while($rec = @mysql_fetch_array($query)){
							?>
                      <option value="<? echo $rec[module_id];?>" <? if($module_id == $rec[module_id]) echo "selected";?>><? echo $rec[module_name];?></option>
                      <? } // end while ?>
                    </select>
                  <a href="javascript:;" onClick="select_all();">Select All</a></td>
                <td><div align="center">
                    <input name="read_p" type="checkbox" id="read_p" value="1" <? if($read_p == "1") echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input name="add_p" type="checkbox" id="add_p" value="1" <? if($add_p == "1") echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input name="update_p" type="checkbox" id="update_p" value="1" <? if($update_p == "1") echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input name="delete_p" type="checkbox" id="delete_p" value="1" <? if($delete_p == "1") echo "checked"; ?>>
                </div></td>
                <td colspan="2"><?
							if($_GET[action] <> "Edit") $option_value = "Add";
							else $option_value = "Edit";
						?>
                    <div align="left">
                      <input name="option" type="submit" id="option" value="<? echo $option_value;?>" class="button">
                  </div></td>
              </tr>
          </table></td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea"><? 
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<? echo $_REQUEST[mode];?>">
      <input name="<? echo $PK_field;?>" type="hidden" id="<? echo $PK_field;?>" value="<? echo $_REQUEST[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<? include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<? if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<? }?>
</BODY>
</HTML>
