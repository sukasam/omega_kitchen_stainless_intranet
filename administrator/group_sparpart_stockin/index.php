<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
include("config.php");
Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");
if ($_GET["page"] == "") {
	$_REQUEST["page"] = 1;
}
$param = get_param($a_param, $a_not_exists);

if ($_GET["action"] == "delete") {

	$code = Check_Permission($conn, $check_module, $_SESSION["login_id"], "delete");

	if ($code == "1") {
		$sql = "delete from $tbl_name  where $PK_field = '" . $_GET[$PK_field] . "'";
		@mysqli_query($conn, $sql);

		$sql2 = "select * from s_group_sparpart_bill_pro where id_bill = '" . $_GET[$PK_field] . "'";
		$quPro = @mysqli_query($conn, $sql2);
		while ($rowPro = mysqli_fetch_array($quPro)) {
			@mysqli_query($conn, "UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`-'" . $rowPro['sparpart_qty'] . "' WHERE `group_id` = '" . $rowPro['sparpart_id'] . "';");
		}

		$sql = "delete from s_group_sparpart_bill_pro  where id_bill = '" . $_GET[$PK_field] . "'";
		@mysqli_query($conn, $sql);

		header("location:index.php");
	}
}

//-------------------------------------------------------------------------------------
if ($_GET["b"] != "" && $_GET["s"] != "") {
	if ($_GET["s"] == 0) $status = 1;
	if ($_GET["s"] == 1) $status = 0;
	Check_Permission($conn, $check_module, $_SESSION["login_id"], "update");
	$sql_status = "update $tbl_name set st_setting = '$status' where $PK_field = '" . $_GET["b"] . "'";
	@mysqli_query($conn, $sql_status);
	/*$sql_fostatus = "update s_first_order set status = '$status' where fo_id = '$_GET[cus_id]'";
		@mysqli_query($conn,$sql_fostatus);*/
	if ($_GET["page"] != "") {
		$conpage = "page=" . $_GET["page"];
	}
	header("location:?" . $conpage);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">

<HEAD>
    <TITLE><?php echo $s_title; ?></TITLE>
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
    function confirmDelete(delUrl, text) {
        if (confirm("Are you sure you want to delete\n" + text)) {
            document.location = delUrl;
        }
    }
    //----------------------------------------------------------
    function check_select(frm) {
        if (frm.choose_action.value == "") {
            alert('Choose an action');
            frm.choose_action.focus();
            return false;
        }
    }

    function MM_jumpMenu(targ, selObj, restore) { //v3.0
        eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
        if (restore) selObj.selectedIndex = 0;
    }
    </script>
</HEAD>
<?php include("../../include/function_script.php"); ?>

<BODY>
    <DIV id=body-wrapper>
        <?php include("../left.php"); ?>
        <DIV id=main-content>
            <NOSCRIPT>
            </NOSCRIPT>
            <?php include('../top.php'); ?>
            <P id=page-intro><?php echo $page_name; ?></P>

            <UL class=shortcut-buttons-set>
                <LI><A class=shortcut-button href="../group_sparpart/index.php"><SPAN><IMG alt=icon
                                src="../images/menu/mn_serting06.png"><BR>
                            สต๊อคอะไหล่</SPAN></A></LI>
                <LI><A class=shortcut-button href="../group_sparpart/update.php"><SPAN><IMG alt=icon
                                src="../images/menu/mn_serting21.png"><BR>
                            เพิ่ม/แก้ไข อะไหล่</SPAN></A></LI>
                <LI><A class=shortcut-button href="update.php?mode=add"><SPAN><IMG alt=icon
                                src="../images/menu/mn_serting22.png"><BR>
                            รับเข้าสต๊อค</SPAN></A></LI>
                <LI><A class=shortcut-button href="../group_sparpart_approve/"><SPAN><IMG alt=icon
                                src="../images/icons/icon-48-user.png" width="60"><BR>
                            อนุมัติรับเข้าสต็อก</SPAN></A></LI>
                <LI><A class=shortcut-button href="../report2/?mid=16&act=16"><SPAN><IMG alt=icon
                                src="../images/menu/mn_serting23.png"><BR>
                            รายงานสต็อค</SPAN></A></LI>

                <?php
				if ($FR_module <> "") {
					$param2 = get_return_param();
				?>
                <LI><A class=shortcut-button
                        href="../<?php echo $FR_module; ?>/?<?php if ($param2 <> "") echo $param2; ?>"><SPAN><IMG
                                alt=icon src="../images/btn_back.gif"><BR>
                            กลับ</SPAN></A></LI>
                <?php     } ?>

            </UL>

            <!-- End .shortcut-buttons-set -->
            <DIV class=clear></DIV><!-- End .clear -->
            <DIV class=content-box>
                <!-- Start Content Box -->
                <DIV class=content-box-header align="right" style="padding-right:15px;">

                    <H3 align="left"><?php echo $page_name; ?></H3>
                    <div style="float:right;padding-top:5px;">
                        <form name="form1" method="get" action="index.php">
                            <input name="keyword" type="text" id="keyword" value="<?php echo $keyword; ?>">
                            <input name="Action" type="submit" id="Action" value="ค้นหา">
                            <?php
							$a_not_exists = array('keyword');
							$param2 = get_param($a_param, $a_not_exists);
							?>
                            <a href="index.php?<?php echo $param2; ?>">แสดงทั้งหมด</a>
                            <?php
							/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
							?>
                        </form>
                    </div>
                    <div style="float:right;margin-right:20px;padding-top:5px;">
                        <label><strong>สถานะการยืนยัน : </strong></label>
                        <select name="catalog_master" id="catalog_master" style="height:24px;"
                            onChange="MM_jumpMenu('parent',this,0)">
                            <option value="index.php?app_id=0" <?php if ($_GET['app_id'] == 0) {
																	echo "selected";
																} ?>>รอการอนุมัติ</option>
                            <option value="index.php?app_id=1" <?php if ($_GET['app_id'] == 1) {
																	echo "selected";
																} ?>>อนุมัติ</option>
                            <option value="index.php?app_id=2" <?php if ($_GET['app_id'] == 2) {
																	echo "selected";
																} ?>>ไม่อนุมัติ</option>
                        </select>
                    </div>
                    <DIV class=clear>

                    </DIV>
                </DIV><!-- End .content-box-header -->
                <DIV class=content-box-content>
                    <DIV id=tab1 class="tab-content default-tab">
                        <!-- This is the target div. id must match the href of this div's tab -->
                        <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
                            <TABLE>
                                <THEAD>
                                    <TR>

                                        <TH width="5%">ลำดับ</TH>
                                        <TH width="12%">เลขที่บิล</TH>
                                        <TH width="35%">ผู้จำหน่าย / ส่งสินค้า</TH>
                                        <TH width="18%">วันที่รับเข้า</TH>
                                        <TH width="8%">
                                            <div align="center"><a>การยืนยัน</a></div>
                                        </TH>
                                        <TH width="8%">
                                            <div align="center"><a>Open / Close</a></div>
                                        </TH>
                                        <TH width="5%">ดาวน์โหลด</TH>
                                        <TH width="5%"><a>แก้ไข</a></TH>
                                        <TH width="5%"><a>ลบ</a></TH>
                                    </TR>
                                </THEAD>
                                <TFOOT>
                                </TFOOT>
                                <TBODY>
                                    <?php
									if ($orderby == "") $orderby = $tbl_name . "." . $PK_field;
									if ($sortby == "") $sortby = "DESC";

									$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1";
									if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";
									if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";
									if ($_GET["keyword"] <> "") {
										$sql .= "and ( " .  $PK_field  . " like '%" . $_GET["keyword"] . "%' ";
										if (count($search_key) > 0) {
											$search_text = " and ( ";
											foreach ($search_key as $key => $value) {
												$subtext .= "or " . $value  . " like '%" . $_GET["keyword"] . "%'";
											}
										}
										$sql .=  $subtext . " ) ";
									}

									if ($_GET['app_id'] <> "") {
										$sql .= " and ( approve = '" . $_GET["app_id"] . "' ";
										$sql .=  $subtext . " ) ";
									} else {
										$sql .= " and ( approve = '0' ";
										$sql .=  $subtext . " ) ";
									}

									if ($orderby <> "") $sql .= " order by " . $orderby;
									if ($sortby <> "") $sql .= " " . $sortby;
									include("../include/page_init.php");
									//echo $sql;
									$query = @mysqli_query($conn, $sql);
									if ($_GET["page"] == "") $_GET["page"] = 1;
									$counter = ($_GET["page"] - 1) * $pagesize;

									while ($rec = @mysqli_fetch_array($query)) {
										$counter++;
									?>
                                    <TR>
                                        <TD><span class="text"><?php echo sprintf("%04d", $counter); ?></span></TD>
                                        <TD><span class="text"><?php echo $rec["sub_billnum"]; ?></span></TD>
                                        <TD><span class="text"><?php echo $rec["sub_name"]; ?></span></TD>
                                        <TD><span class="text"><?php echo format_date($rec["stock_date"]); ?></span>
                                        </TD>
                                        <TD style="vertical-align:middle"><?php if ($rec["approve"] == 1) { ?>
                                            <IMG src="../images/icons/yes_approve.png" height="28" title="อนุมัติ">
                                            <?php  } else if ($rec["approve"] == 2) { ?>
                                            <IMG src="../images/icons/no_approve.png" height="28" title="ไม่อนุมัติ">
                                            <?php  } else { ?>
                                            <IMG src="../images/icons/wait_approve.png" height="28" title="รออนุมัติ">
                                            <?php  } ?></TD>
                                        <TD style="vertical-align:middle">
                                            <div align="center">
                                                <?php if ($rec["st_setting"] == 0) { ?>
                                                <a
                                                    href="../group_sparpart_stockin/?b=<?php echo $rec[$PK_field]; ?>&s=<?php echo $rec["st_setting"]; ?>&page=<?php echo $_GET["page"]; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>&cus_id=<?php echo $rec["cus_id"]; ?>"><img
                                                        src="../icons/status_on.gif" width="10" height="10"></a>
                                                <?php  } else { ?>
                                                <a
                                                    href="../group_sparpart_stockin/?b=<?php echo $rec[$PK_field]; ?>&s=<?php echo $rec["st_setting"]; ?>&page=<?php echo $_GET["page"]; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>&cus_id=<?php echo $rec["cus_id"]; ?>"><img
                                                        src="../icons/status_off.gif" width="10" height="10"></a>
                                                <?php  } ?>
                                            </div>
                                        </TD>
                                        <TD>
                                            <center><A title="view"
                                                    href="../../upload/stockin/<?php echo $rec["sub_id"]; ?>.pdf"
                                                    target="_blank"><IMG alt="view" src="../images/icon2/backup.png"
                                                        width="25"></A></center>
                                        </TD>
                                        <TD>
                                            <!-- Icons -->
                                            <A title=Edit href="update.php?mode=update&<?php echo $PK_field; ?>=<?php echo $rec[$PK_field];
																														if ($param <> "") { ?>&<?php echo $param;
																																											} ?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete
                                                href="#"></A></TD>

                                        <TD><A title=Delete href="#"><IMG alt=Delete src="../images/cross.png"
                                                    onClick="confirmDelete('?action=delete&<?php echo $PK_field; ?>=<?php echo $rec[$PK_field]; ?>','เลขที่บิล  <?php echo $rec[$PK_field]; ?> : <?php echo $rec["sub_billnum"]; ?>')"></A>
                                        </TD>
                                    </TR>
                                    <?php     } ?>
                                </TBODY>
                            </TABLE>
                            <br><br>
                            <!--
    <DIV class="bulk-actions align-left">
            <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>            
            <?php
			$a_not_exists = array();
			post_param($a_param, $a_not_exists);
			?>
            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง">
          </DIV> 
-->
                            <DIV class=pagination> <?php include("../include/page_show.php"); ?> </DIV>
                        </form>
                    </DIV><!-- End #tab1 -->


                </DIV><!-- End .content-box-content -->
            </DIV><!-- End .content-box -->
            <!-- End .content-box -->
            <!-- End .content-box -->
            <DIV class=clear></DIV><!-- Start Notifications -->
            <!-- End Notifications -->

            <?php include("../footer.php"); ?>
        </DIV><!-- End #main-content -->
    </DIV>
</BODY>

</HTML>