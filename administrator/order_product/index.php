<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";
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

        $sql2 = "select * from s_order_productsub where sr_id = '" . $_GET[$PK_field] . "'";
        $quPro = @mysqli_query($conn, $sql2);
        while ($rowPro = mysqli_fetch_array($quPro)) {
            @mysqli_query($conn, "UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`+'" . $rowPro['opens'] . "' WHERE `group_id` = '" . $rowPro['lists'] . "';");
        }

        $sql = "delete from s_order_productsub  where sr_id = '" . $_GET[$PK_field] . "'";
        @mysqli_query($conn, $sql);

        header("location:index.php");
    }
}

//-------------------------------------------------------------------------------------
if ($_GET["b"] != "" && $_GET["s"] != "") {
    if ($_GET["s"] == 0) {
        $status = 1;
    }

    if ($_GET["s"] == 1) {
        $status = 0;
    }

    Check_Permission($conn, $check_module, $_SESSION["login_id"], "update");
    $sql_status = "update $tbl_name set st_setting = '" . $status . "', job_close = '" . date("Y-m-d") . "' where $PK_field = '" . $_GET["b"] . "'";
    @mysqli_query($conn, $sql_status);
    if ($_GET['page'] != "") {
        $conpage = "page=" . $_GET['page'];
    }
    header("location:?" . $conpage);
}

if ($_GET['act'] == "chkQC") {
    $sqlOrPro = "SELECT * FROM s_order_product WHERE sr_id = '" . $_GET['sr_id'] . "' LIMIT 1";
    $quOrPro = mysqli_query($conn, $sqlOrPro);
    $rowOrPro = mysqli_fetch_array($quOrPro, MYSQLI_ASSOC);

    $sqlQcPro = "SELECT * FROM s_qc_product WHERE sr_id2 = '" . $rowOrPro['sr_id'] . "' LIMIT 1";
    $quQcPro = mysqli_query($conn, $sqlQcPro);
    $rowQcPro = mysqli_fetch_array($quQcPro, MYSQLI_ASSOC);

    if ($rowQcPro['sr_id'] == "") {

        $sv_id = check_qcorder($conn);

        $sqlQcProAdd = "INSERT INTO `s_qc_product` (`sr_id`, `sv_id`, `sr_id2`, `sv_id2`, `cus_id`, `srid`, `sr_ctype`, `sr_ctype2`, `job_open`, `job_close`, `job_balance`, `sr_stime`, `loc_contact2`, `loc_contact3`, `cs_sell`, `detail_recom`, `approve`, `supply`, `st_setting`, `loc_date2`, `sell_date`, `loc_date3`, `search_fo`, `pro_list`, `images1`, `images2`, `images3`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`)
							VALUES
							(NULL, '" . $sv_id . "', '" . $rowOrPro['sr_id'] . "', '" . $rowOrPro['sv_id'] . "', '" . $rowOrPro['cus_id'] . "', '" . $rowOrPro['srid'] . "', '" . $rowOrPro['sr_ctype'] . "', '" . $rowOrPro['sr_ctype2'] . "', '" . $rowOrPro['job_open'] . "', '" . $rowOrPro['job_close'] . "', '" . $rowOrPro['job_balance'] . "', '" . $rowOrPro['sr_stime'] . "', '" . $rowOrPro['loc_contact2'] . "', '', '" . $rowOrPro['cs_sell'] . "', '" . $rowOrPro['detail_recom'] . "', '0', '0', '0', '" . $rowOrPro['loc_date2'] . "', '" . $rowOrPro['sell_date'] . "', '" . $rowOrPro['loc_date3'] . "', '" . $rowOrPro['search_fo'] . "', '" . $rowOrPro['pro_list'] . "', '" . $rowOrPro['images1'] . "', '" . $rowOrPro['images2'] . "', '" . $rowOrPro['images3'] . "', 'Admin', '" . date("Y-m-d H:i:s") . "', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');";
        mysqli_query($conn, $sqlQcProAdd);
        $idQcProAdd = mysqli_insert_id($conn);

        if (!empty($rowOrPro['images1'])) {
            copy('../../upload/order_product/images/' . $rowOrPro['images1'], '../../upload/qc_product/images/' . $rowOrPro['images1']);
        }
        if (!empty($rowOrPro['images2'])) {
            copy('../../upload/order_product/images/' . $rowOrPro['images2'], '../../upload/qc_product/images/' . $rowOrPro['images2']);
        }
        if (!empty($rowOrPro['images3'])) {
            copy('../../upload/order_product/images/' . $rowOrPro['images3'], '../../upload/qc_product/images/' . $rowOrPro['images3']);
        }

        @header("Location:../qc_product/update.php?mode=update&sr_id=" . $idQcProAdd);
    } else {
        @header("Location:../qc_product/update.php?mode=update&sr_id=" . $rowQcPro['sr_id']);
    }

    exit();
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
<?php include "../../include/function_script.php";?>

<BODY>
    <DIV id=body-wrapper>
        <?php include "../left.php";?>
        <DIV id=main-content>
            <NOSCRIPT>
            </NOSCRIPT>
            <?php include '../top.php';?>
            <P id=page-intro><?php echo $page_name; ?></P>

            <UL class=shortcut-buttons-set>
                <LI><A class=shortcut-button
                        href="update.php?mode=add<?php if ($param != "") {
    echo "&" . $param;
}
?>"><SPAN><IMG alt=icon
                                src="../images/pencil_48.png"><BR>
                            เพิ่ม<br><br></SPAN></A></LI>
                <LI><A class=shortcut-button href="../order_product_approve/"><SPAN><IMG alt=icon
                                src="../images/icons/icon-48-user.png"><BR>
                            อนุมัติใบสั่งผลิตสินค้า</SPAN></A></LI>
                <!-- <LI><A class=shortcut-button href="../qc_product/"><SPAN><IMG alt=icon
                                src="../images/icons/icon-48-section.png"><BR>
                            ใบตรวจรับสินค้าสำเร็จรูป</SPAN></A></LI> -->
                <?php
if ($FR_module != "") {
    $param2 = get_return_param();
    ?>
                <LI><A class=shortcut-button
                        href="../<?php echo $FR_module; ?>/?<?php if ($param2 != "") {
        echo $param2;
    }
    ?>"><SPAN><IMG
                                alt=icon src="../images/btn_back.gif"><BR>
                            กลับ</SPAN></A></LI>
                <?php }?>
            </UL>

            <!-- End .shortcut-buttons-set -->
            <DIV class=clear></DIV><!-- End .clear -->
            <DIV class=content-box>
                <!-- Start Content Box -->
                <DIV class=content-box-header align="right" style="padding-right:15px;">

                    <H3 align="left"><?php echo $check_module; ?></H3>
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
}?>>รอการอนุมัติ</option>
                            <option value="index.php?app_id=1" <?php if ($_GET['app_id'] == 1) {
    echo "selected";
}?>>อนุมัติ</option>
                            <option value="index.php?app_id=2" <?php if ($_GET['app_id'] == 2) {
    echo "selected";
}?>>ไม่อนุมัติ</option>
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
                                        <!-- <TH width="5%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH> -->
                                        <TH width="5%">
                                            <div align="center"><a>ลำดับ.</a></div>
                                        </TH>
                                        <TH width="10%">
                                            <div align="center"><a>เลขที่</a></div>
                                        </TH>
                                        <TH width="20%"><a>ชื่อลูกค้า</a></TH>
                                        <TH width="10%">
                                            <div align="left"><a>เลขที่ FO/PJ</a></div>
                                        </TH>
                                        <TH width="10%">
                                            <div align="left"><a>พนักงานขาย</a></div>
                                        </TH>
                                        <TH width="10%">
                                            <div align="left"><a>กำหนดเสร็จ</a></div>
                                        </TH>
                                        <TH width="5%">
                                            <div align="center"><a>การยืนยัน</a></div>
                                        </TH>
                                        <TH width="10%">
                                            <div align="center"><a>ใบตรวจสอบสินค้า (QC)</a></div>
                                        </TH>
                                        <TH width="10%">
                                            <div align="center"><a>Open / Close</a></div>
                                        </TH>
                                        <TH width="5%">
                                            <div align="center"><a>แก้ไข</a></div>
                                        </TH>
                                        <TH width="5%">
                                            <div align="center"><a>ลบ</a></div>
                                        </TH>
                                    </TR>
                                </THEAD>
                                <TFOOT>
                                </TFOOT>
                                <TBODY>
                                    <?php
if ($orderby == "") {
    $orderby = "sr." . $PK_field;
}

if ($sortby == "") {
    $sortby = "DESC";
}

//$sql = "SELECT sr . * , fd.cd_name FROM $tbl_name AS sr, s_first_order AS fd WHERE sr.cus_id = fd.fo_id";
$sql = "SELECT sr . * FROM $tbl_name AS sr WHERE 1";
if ($_GET[$PK_field] != "") {
    $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";
}

if ($_GET[$FR_field] != "") {
    $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";
}

if ($_GET["keyword"] != "") {
    $sql .= " and ( " . $PK_field . " like '%" . $_GET["keyword"] . "%' ";
    if (count($search_key) > 0) {
        $search_text = " and ( ";
        foreach ($search_key as $key => $value) {
            $subtext .= "or " . $value . " like '%" . $_GET["keyword"] . "%'";
        }
    }
    $sql .= $subtext . " ) ";
}

if ($_GET['app_id'] != "") {
    $sql .= " and ( approve = '" . $_GET['app_id'] . "' ";
    $sql .= $subtext . " ) ";
} else {
    $sql .= " and ( approve = '0' ";
    $sql .= $subtext . " ) ";
}

if ($orderby != "") {
    $sql .= " order by " . $orderby;
}

if ($sortby != "") {
    $sql .= " " . $sortby;
}

include "../include/page_init.php";
//                    echo $sql;
//                    break;
$query = @mysqli_query($conn, $sql);
if ($_GET["page"] == "") {
    $_GET["page"] = 1;
}

$counter = ($_GET["page"] - 1) * $pagesize;

while ($rec = @mysqli_fetch_array($query)) {
    $counter++;
    ?>
                                    <TR>
                                        <!-- <TD style="vertical-align:middle;"><INPUT type=checkbox name="del[]" value="<?php echo $rec[$PK_field]; ?>" ></TD> -->
                                        <TD style="vertical-align:middle;"><span
                                                class="text"><?php echo sprintf("%04d", $counter); ?></span></TD>
                                        <TD style="vertical-align:middle;">
                                            <?php $chaf = preg_replace("/\//", "-", $rec["sv_id"]);?><div
                                                align="center"><span class="text"><a
                                                        href="../../upload/order_product/<?php echo $chaf; ?>.pdf"
                                                        target="_blank"><?php echo $rec["sv_id"]; ?></a></span></div>
                                        </TD>
                                        <TD style="vertical-align:middle;"><span
                                                class="text"><?php echo get_cname_fopj($conn, $rec["cus_id"]) . "<br><strong>สถานที่ติดตั้ง :</strong> " . get_csetup_fopj($conn, $rec["cus_id"]); ?></span>
                                        </TD>
                                        <TD style="vertical-align:middle;"><?php echo $rec["search_fo"]; ?></TD>
                                        <TD style="vertical-align:middle;">
                                            <?php echo get_csale_fopj($conn, $rec["cus_id"]); ?></TD>
                                        <TD style="vertical-align:middle;">
                                            <?php echo format_date_th($rec["job_balance"], 7); ?></TD>
                                        <TD style="vertical-align:middle"><?php if ($rec["approve"] == 1) {?>
                                            <IMG src="../images/icons/yes_approve.png" height="28" title="อนุมัติ">
                                            <?php } else if ($rec["approve"] == 2) {?>
                                            <IMG src="../images/icons/no_approve.png" height="28" title="ไม่อนุมัติ">
                                            <?php } else {?>
                                            <IMG src="../images/icons/wait_approve.png" height="28" title="รออนุมัติ">
                                            <?php }?></TD>
                                        <TD style="vertical-align:middle;">
                                            <div align="center"><a
                                                    href="index.php?act=chkQC&<?php echo $PK_field; ?>=<?php echo $rec[$PK_field]; ?>"><img
                                                        alt="icon" src="../images/icons/icon-48-install.png"></a></div>
                                        </TD>
                                        <TD style="vertical-align:middle">
                                            <div align="center">
                                                <?php if ($rec["st_setting"] == 0) {?>
                                                <a
                                                    href="../order_product/?b=<?php echo $rec[$PK_field]; ?>&s=<?php echo $rec["st_setting"]; ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>"><img
                                                        src="../icons/status_on.gif" width="10" height="10"></a>
                                                <?php } else {?>
                                                <a
                                                    href="../order_product/?b=<?php echo $rec[$PK_field]; ?>&s=<?php echo $rec["st_setting"]; ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>"><img
                                                        src="../icons/status_off.gif" width="10" height="10"></a>
                                                <?php }?>
                                            </div>
                                        </TD>
                                        <TD style="vertical-align:middle;">
                                            <!-- Icons -->
                                            <div align="center"><A title=Edit href="update.php?mode=update&<?php echo $PK_field; ?>=<?php echo $rec[$PK_field];
    if ($param != "") { ?>&<?php echo $param;
    } ?>"><IMG src="../images/icons/paper_content_pencil_48.png" alt=Edit
                                                        width="25" height="25" title="แก้ไข"></A></div>
                                        </TD>
                                        <TD style="vertical-align:middle;">
                                            <div align="center"><A title=Delete href="#"><IMG alt=Delete
                                                        src="../images/cross.png"
                                                        onClick="confirmDelete('?action=delete&<?php echo $PK_field; ?>=<?php echo $rec[$PK_field]; ?>','Group  <?php echo $rec[$PK_field]; ?> : <?php echo $rec["group_name"]; ?>')"></A>
                                            </div>
                                        </TD>
                                    </TR>
                                    <?php }?>
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
post_param($a_param, $a_not_exists);
?>
                                <!-- <input class=button name="Action2" type="submit" id="Action2" value="ตกลง"> -->
                            </DIV>
                            <DIV class=pagination> <?php include "../include/page_show.php";?> </DIV>
                        </form>
                    </DIV><!-- End #tab1 -->


                </DIV><!-- End .content-box-content -->
            </DIV><!-- End .content-box -->
            <!-- End .content-box -->
            <!-- End .content-box -->
            <DIV class=clear></DIV><!-- Start Notifications -->
            <!-- End Notifications -->

            <?php include "../footer.php";?>
        </DIV><!-- End #main-content -->
    </DIV>
</BODY>

</HTML>