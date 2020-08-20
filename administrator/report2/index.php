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
        header("location:index.php");
    }
}
if ($_GET['action'] == "chksum") {
    $_POST['date_fm'];
    $_POST['date_to'];

    $a_sdate = explode("/", $_REQUEST['date_fm']);
    $date_fm = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    $a_sdate = explode("/", $_REQUEST['date_to']);
    $date_to = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    if ($_POST['priod'] == 0) {
        @header("Location:?mid=16&act=11&res=show&df=" . $date_fm . "&dt=" . $date_to . "&poi=" . $_POST['priod'] . "");
    } else {
        @header("Location:?mid=16&act=11&res=show&poi=" . $_POST['priod'] . "");
    }

    //
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
    <SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
    <META name=GENERATOR content="MSHTML 8.00.7600.16535">

    <script language="JavaScript" src="../Carlender/calendar_us.js"></script>
    <link rel="stylesheet" href="../Carlender/calendar.css">

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

    $(document).ready(function() {

        $("#group_spar_id18").blur(function() {
            var group_spar_id = $("#group_spar_id18").val();
            if (group_spar_id != "") {
                $.ajax({
                    type: "GET",
                    url: "call_return.php?action=chkProID&group_spar_id=" + group_spar_id,
                    success: function(data) {
                        //console.log(data);
                        var obj = JSON.parse(data);

                        if (obj.status === 'yes') {
                            $("#group_spar_id18").val(obj.group_spar_id);
                            $("#cpro_ecip18").val(obj.group_name);
                            $("#cpro18").val(obj.group_id);
                        } else {
                            $("#cpro_ecip18").val('');
                            $("#cpro18").val("");
                        }

                    }
                });
            }
        });

        $("#cpro_ecip18").blur(function() {
            var cpro_ecip = $("#cpro_ecip18").val();
            if (cpro_ecip != "") {
                $.ajax({
                    type: "GET",
                    url: "call_return.php?action=chkProName&cpro_ecip=" + cpro_ecip,
                    success: function(data) {
                        //console.log(data);
                        var obj = JSON.parse(data);

                        if (obj.status === 'yes') {
                            $("#group_spar_id18").val(obj.group_spar_id);
                            $("#cpro_ecip18").val(obj.group_name);
                            $("#cpro18").val(obj.group_id);
                        } else {
                            $("#group_spar_id18").val('');
                            $("#cpro18").val("");
                        }

                    }
                });
            }
        });


    });
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
                <LI><A class=shortcut-button href="../report/?mid=16"><SPAN><IMG alt=icon
                                src="../images/icons/icon-48-category.png"><BR>
                            <strong>รายงาน <br>First Order</strong></SPAN></A></LI>
                <LI><A class=shortcut-button href="../report2/?mid=16"><SPAN><IMG alt=icon
                                src="../images/icons/icon-48-section.png"><BR>
                            <strong>รายงาน <br>Factory</strong></SPAN></A></LI>
            </UL>

            <!-- End .shortcut-buttons-set -->
            <DIV class=clear></DIV><!-- End .clear -->
            <DIV class=content-box>
                <!-- Start Content Box -->
                <DIV class=content-box-header align="right" style="padding-right:15px;">

                    <H3 align="left"><?php echo $page_name; ?></H3>
                    <DIV class=clear>

                    </DIV>
                </DIV><!-- End .content-box-header -->
                <DIV class=content-box-content>
                    <DIV id=tab1 class="tab-content default-tab">
                        <!-- This is the target div. id must match the href of this div's tab -->
                        <UL class=shortcut-buttons-set>
                            <UL class=shortcut-buttons-set>
                                <LI><A class=shortcut-button href="../report2/?mid=16&act=16"><SPAN><IMG alt=icon
                                                src="../images/icons/icon-48-category.png"><BR>
                                            <strong>การรับอะไหล่<br>เข้าสต๊อค<br></strong></SPAN></A></LI>
                                <LI><A class=shortcut-button href="../report2/?mid=16&act=17"><SPAN><IMG alt=icon
                                                src="../images/icons/icon-48-category.png"><BR>
                                            <strong>ใบเบิกวัตถุดิบ<br>เพื่อผลิต<br></strong></SPAN></A></LI>
                                <!-- <LI><A class=shortcut-button href="../report/?mid=16&act=14"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>การรับสินค้า<br>โปรเจ็คเข้าสต๊อค<br></strong></SPAN></A></LI> -->
                                <LI><A class=shortcut-button href="../report2/?mid=16&act=15"><SPAN><IMG alt=icon
                                                src="../images/icons/icon-48-category.png"><BR>
                                            <strong>การรับสินค้า<br>สำเร็จรูปเข้าสต๊อค<br></strong></SPAN></A></LI>
                            </UL>

                        </UL>
                        <DIV class="clear"></DIV>
                    </DIV><!-- End #tab1 -->


                    <?php
if ($_GET['act'] == 15) {

    ?>

                    <DIV class=content-box>
                        <!-- Start Content Box -->

                        <DIV class=content-box-header align="right" style="padding-right:15px;">

                            <H3 align="left">เลือกตามการรับสินค้าสำเร็จรุปเข้าสต๊อค</H3>

                            <DIV class=clear>

                            </DIV>
                        </DIV><!-- End .content-box-header -->

                        <DIV class=content-box-content>

                            <DIV id=tab1 class="tab-content default-tab">
                                <!-- This is the target div. id must match the href of this div's tab -->
                                <form action="report15.php" method="post" name="form1" id="form1" target="_blank"
                                    onSubmit="return check3(this)">
                                    <div class="formArea">
                                        <fieldset>
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tr>

                                                    <td>
                                                        <table class="formFields" cellspacing="0" width="100%">

                                                            <tr>

                                                                <td nowrap class="name">&nbsp;</td>

                                                                <td><span class="name">

                                                                        <input name="priod" type="radio" value="0"
                                                                            checked>

                                                                        กำหนดช่วงเวลา&nbsp;

                                                                        <input name="priod" type="radio" value="1">

                                                                        ไม่กำหนดช่วงเวลา</span></td>

                                                            </tr>

                                                            <tr>

                                                                <td width="10%" nowrap class="name">เริ่มวันที่</td>

                                                                <td width="90%"><input type="text" name="date_fm"
                                                                        readonly value="<?php echo date("d/m/Y"); ?>"
                                                                        class="inpfoder" />
                                                                    <script language="JavaScript">
                                                                    new tcal({
                                                                        'formname': 'form1',
                                                                        'controlname': 'date_fm'
                                                                    });
                                                                    </script>
                                                                </td>

                                                            </tr>

                                                            <tr>

                                                                <td width="10%" nowrap class="name">ถึงวันที่</td>

                                                                <td width="90%"><input type="text" name="date_to"
                                                                        readonly value="<?php echo date("d/m/Y"); ?>"
                                                                        class="inpfoder" />
                                                                    <script language="JavaScript">
                                                                    new tcal({
                                                                        'formname': 'form1',
                                                                        'controlname': 'date_to'
                                                                    });
                                                                    </script>
                                                                </td>

                                                            </tr>

                                                            <tr>

                                                                <td nowrap class="name">รายการแสดง</td>

                                                                <td><input name="sh9" type="checkbox" id="sh9" value="1"
                                                                        checked>

                                                                    วันที่รับเข้า

                                                                    <input name="sh1" type="checkbox" id="sh1" value="1"
                                                                        checked>

                                                                    ชื่อโปรเจ็ค / ลูกค้า

                                                                    <input name="sh2" type="checkbox" id="sh2" value="1"
                                                                        checked>

                                                                    ที่อยู่ / ลูกค้าโปรเจ็ค

                                                                    <input name="sh3" type="checkbox" id="sh3" value="1"
                                                                        checked>

                                                                    เลขที่ FO,FO/PJ

                                                                    <input name="sh4" type="checkbox" id="sh4" value="1"
                                                                        checked>

                                                                    รหัสสินค้า<br>


                                                                    <input name="sh5" type="checkbox" id="sh5" value="1"
                                                                        checked>

                                                                    รายการสินค้า

                                                                    <input name="sh6" type="checkbox" id="sh6" value="1"
                                                                        checked>

                                                                    จำนวน

                                                                    <!--      <input name="sh7" type="checkbox" id="sh7" value="1" checked>

                        รวมราคาซื้ิอ -->

                                                                    <input name="sh8" type="checkbox" id="sh8" value="1"
                                                                        checked>

                                                                    ผู้รับสินค้าเข้า
                                                                </td>

                                                            </tr>



                                                        </table>
                                                    </td>

                                                </tr>

                                            </table>

                                        </fieldset>

                                    </div><br>

                                    <div class="formArea">

                                        <input type="submit" name="Submit" value="Submit" class="button">

                                    </div>

                                </form>

                            </DIV><!-- End #tab1 -->





                        </DIV><!-- End .content-box-content -->

                    </DIV>

                    <?php

}

if ($_GET['act'] == 16) {

    ?>

                    <DIV class=content-box>
                        <!-- Start Content Box -->

                        <DIV class=content-box-header align="right" style="padding-right:15px;">

                            <H3 align="left">เลือกตามการรับอะไหล่เข้าสต๊อค</H3>

                            <DIV class=clear>

                            </DIV>
                        </DIV><!-- End .content-box-header -->

                        <DIV class=content-box-content>

                            <DIV id=tab1 class="tab-content default-tab">
                                <!-- This is the target div. id must match the href of this div's tab -->
                                <form action="report16.php" method="post" name="form1" id="form1" target="_blank"
                                    onSubmit="return check3(this)">
                                    <div class="formArea">
                                        <fieldset>
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tr>

                                                    <td>
                                                        <table class="formFields" cellspacing="0" width="100%">

                                                            <tr>
                                                                <td width="10%" nowrap class="name">รหัสอะไหล่ |
                                                                    ชื่ออะไหล่</td>
                                                                <td width="90%">
                                                                    <select name="pro_pod" id="pro_pod"
                                                                        class="inputselect">
                                                                        <option value="">กรุณาเลือกรายการอะไหล่</option>
                                                                        <?php
$qupros1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
    while ($row_qupros1 = @@mysqli_fetch_array($qupros1)) {
        ?>
                                                                        <option
                                                                            value="<?php echo $row_qupros1['group_id']; ?>">
                                                                            <?php echo $row_qupros1['group_spar_id'] . " | " . $row_qupros1['group_name']; ?>
                                                                        </option>
                                                                        <?php
}
    ?>
                                                                    </select><a href="javascript:void(0);"
                                                                        onClick="windowOpener('400', '500', '', 'search_spar.php?protype=pro_pod');"><img
                                                                            src="../images/icon2/mark_f2.png" width="25"
                                                                            height="25" border="0" alt=""
                                                                            style="vertical-align:middle;padding-left:5px;"></a>
                                                                </td>
                                                            </tr>

                                                            <tr>

                                                                <td nowrap class="name">&nbsp;</td>

                                                                <td><span class="name">

                                                                        <input name="priod" type="radio" value="0"
                                                                            checked>

                                                                        กำหนดช่วงเวลา&nbsp;

                                                                        <input name="priod" type="radio" value="1">

                                                                        ไม่กำหนดช่วงเวลา</span></td>

                                                            </tr>

                                                            <tr>

                                                                <td width="10%" nowrap class="name">เริ่มวันที่</td>

                                                                <td width="90%"><input type="text" name="date_fm"
                                                                        readonly value="<?php echo date("d/m/Y"); ?>"
                                                                        class="inpfoder" />
                                                                    <script language="JavaScript">
                                                                    new tcal({
                                                                        'formname': 'form1',
                                                                        'controlname': 'date_fm'
                                                                    });
                                                                    </script>
                                                                </td>

                                                            </tr>

                                                            <tr>

                                                                <td width="10%" nowrap class="name">ถึงวันที่</td>

                                                                <td width="90%"><input type="text" name="date_to"
                                                                        readonly value="<?php echo date("d/m/Y"); ?>"
                                                                        class="inpfoder" />
                                                                    <script language="JavaScript">
                                                                    new tcal({
                                                                        'formname': 'form1',
                                                                        'controlname': 'date_to'
                                                                    });
                                                                    </script>
                                                                </td>

                                                            </tr>

                                                            <tr>

                                                                <td nowrap class="name">รายการแสดง</td>

                                                                <td><input name="sh9" type="checkbox" id="sh9" value="1"
                                                                        checked>

                                                                    วันที่รับเข้า

                                                                    <input name="sh1" type="checkbox" id="sh1" value="1"
                                                                        checked>

                                                                    ผู้จำหน่าย / ส่งสินค้า

                                                                    <!-- <input name="sh2" type="checkbox" id="sh2" value="1"
                                                                        checked>

                                                                    ชื่ที่อยู่ /ผู้จำหน่าย / เบอร์โทร -->

                                                                    <input name="sh3" type="checkbox" id="sh3" value="1"
                                                                        checked>

                                                                    เลขที่บิล

                                                                    <input name="sh4" type="checkbox" id="sh4" value="1"
                                                                        checked>

                                                                    รหัสอะไหล่<br>


                                                                    <input name="sh5" type="checkbox" id="sh5" value="1"
                                                                        checked>

                                                                    รายการอะไหล่

                                                                    <input name="sh6" type="checkbox" id="sh6" value="1"
                                                                        checked>

                                                                    ราคาซื้อ

                                                                    <input name="sh7" type="checkbox" id="sh7" value="1"
                                                                        checked>

                                                                    รวมราคาซื้ิอ

                                                                    <input name="sh8" type="checkbox" id="sh8" value="1"
                                                                        checked>

                                                                    ผู้รับสินค้าเข้า
                                                                </td>

                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                            </table>

                                        </fieldset>

                                    </div><br>

                                    <div class="formArea">

                                        <input type="submit" name="Submit" value="Submit" class="button">

                                    </div>

                                </form>

                            </DIV><!-- End #tab1 -->





                        </DIV><!-- End .content-box-content -->

                    </DIV>

                    <?php

}

if ($_GET['act'] == 17) {

    ?>

                    <DIV class=content-box>
                        <!-- Start Content Box -->

                        <DIV class=content-box-header align="right" style="padding-right:15px;">

                            <H3 align="left">เลือกตามใบเบิกวัตถุดิบเพื่อผลิต</H3>

                            <DIV class=clear>

                            </DIV>
                        </DIV><!-- End .content-box-header -->

                        <DIV class=content-box-content>

                            <DIV id=tab1 class="tab-content default-tab">
                                <!-- This is the target div. id must match the href of this div's tab -->
                                <form action="report17.php" method="post" name="form1" id="form1" target="_blank"
                                    onSubmit="return check3(this)">
                                    <div class="formArea">
                                        <fieldset>
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tr>

                                                    <td>
                                                        <table class="formFields" cellspacing="0" width="100%">

                                                            <tr>
                                                                <td width="10%" nowrap class="name">รหัสลูกค้า | ชื่อร้าน | ชื่อบริษัท
                                                                </td>
                                                                <td width="90%"><input name="cd_name" type="text"
                                                                        id="cd_name" value="" style="width:40%;"
                                                                        readonly><a href="javascript:void(0);"
                                                                        onClick="windowOpener('400', '500', '', 'search.php?cus_source=fopj');"><img
                                                                            src="../images/icon2/mark_f2.png" width="25"
                                                                            height="25" border="0" alt=""
                                                                            style="vertical-align:middle;padding-left:5px;"></a>
                                                                    <input name="cus_id" type="hidden" id="cus_id"
                                                                        value="" style="width:40%;">
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td width="10%" nowrap class="name">รหัสอะไหล่ |
                                                                    ชื่ออะไหล่</td>
                                                                <td width="90%">
                                                                    <select name="pro_pod" id="pro_pod"
                                                                        class="inputselect">
                                                                        <option value="">กรุณาเลือกรายการอะไหล่</option>
                                                                        <?php
$qupros1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_spar_id ASC");
    while ($row_qupros1 = @@mysqli_fetch_array($qupros1)) {
        ?>
                                                                        <option
                                                                            value="<?php echo $row_qupros1['group_id']; ?>">
                                                                            <?php echo $row_qupros1['group_spar_id'] . " | " . $row_qupros1['group_name']; ?>
                                                                        </option>
                                                                        <?php
}
    ?>
                                                                    </select><a href="javascript:void(0);"
                                                                        onClick="windowOpener('400', '500', '', 'search_spar.php?protype=pro_pod');"><img
                                                                            src="../images/icon2/mark_f2.png" width="25"
                                                                            height="25" border="0" alt=""
                                                                            style="vertical-align:middle;padding-left:5px;"></a>
                                                                </td>
                                                            </tr>

                                                            <!-- <tr>
                                                                <td width="10%" nowrap class="name">ชนิดสินค้า :
                                                                </td>
                                                                <td width="90%"><input name="type_name" type="text"
                                                                        id="type_name" value="" style="width:40%;"
                                                                        readonly><a href="javascript:void(0);"
                                                                        onClick="windowOpener('400', '500', '', 'search_type.php');"><img
                                                                            src="../images/icon2/mark_f2.png" width="25"
                                                                            height="25" border="0" alt=""
                                                                            style="vertical-align:middle;padding-left:5px;"></a>
                                                                </td>
                                                            </tr> -->

                                                            <!-- <tr>
                                                                <td width="10%" nowrap class="name">เรียงตาม</td>
                                                                <td width="90%">
                                                                    <select name="source_by" id="source_by"
                                                                        class="inputselect">
                                                                        <option value="1">เลขที่ใบเบิกวัตถุดิบ</option>
                                                                        <option value="2">ชื่อลูกค้า (รหัสลูกค้า)</option>
                                                                        <option value="3">รหัสอะไหล่</option>
                                                                        <option value="4">ชนิดสินค้า</option>
                                                                    </select>
                                                                </td>
                                                            </tr> -->

                                                            <tr>

                                                                <td nowrap class="name">&nbsp;</td>

                                                                <td><span class="name">

                                                                        <input name="priod" type="radio" value="0"
                                                                            checked>

                                                                        กำหนดช่วงเวลา&nbsp;

                                                                        <input name="priod" type="radio" value="1">

                                                                        ไม่กำหนดช่วงเวลา</span></td>

                                                            </tr>

                                                            <tr>

                                                                <td width="10%" nowrap class="name">เริ่มวันที่</td>

                                                                <td width="90%"><input type="text" name="date_fm"
                                                                        readonly value="<?php echo date("d/m/Y"); ?>"
                                                                        class="inpfoder" />
                                                                    <script language="JavaScript">
                                                                    new tcal({
                                                                        'formname': 'form1',
                                                                        'controlname': 'date_fm'
                                                                    });
                                                                    </script>
                                                                </td>

                                                            </tr>

                                                            <tr>

                                                                <td width="10%" nowrap class="name">ถึงวันที่</td>

                                                                <td width="90%"><input type="text" name="date_to"
                                                                        readonly value="<?php echo date("d/m/Y"); ?>"
                                                                        class="inpfoder" />
                                                                    <script language="JavaScript">
                                                                    new tcal({
                                                                        'formname': 'form1',
                                                                        'controlname': 'date_to'
                                                                    });
                                                                    </script>
                                                                </td>

                                                            </tr>

                                                            <tr>

                                                                <td nowrap class="name">รายการแสดง</td>

                                                                <td><input name="sh9" type="checkbox" id="sh9" value="1"
                                                                        checked>

                                                                    เลขที่ใบเบิก

                                                                    <input name="sh1" type="checkbox" id="sh1" value="1"
                                                                        checked>

                                                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                                                    <input name="sh2" type="checkbox" id="sh2" value="1"
                                                                        checked>

                                                                    ชื่อร้าน / สถานที่ติดตั้ง

                                                                    <input name="sh3" type="checkbox" id="sh3" value="1"
                                                                        checked>

                                                                    จังหวัด

                                                                    <input name="sh4" type="checkbox" id="sh4" value="1"
                                                                        checked>

                                                                    รหัสอะไหล่<br>


                                                                    <input name="sh5" type="checkbox" id="sh5" value="1"
                                                                        checked>

                                                                    รายการอะไหล่

                                                                    <input name="sh6" type="checkbox" id="sh6" value="1"
                                                                        checked>

                                                                    จำนวนเบิก

                                                                    <!--  <input name="sh7" type="checkbox" id="sh7" value="1" checked>

                            รวมราคาซื้ิอ-->

                                                                    <input name="sh8" type="checkbox" id="sh8" value="1"
                                                                        checked>

                                                                    ผู้เบิก
                                                                </td>

                                                            </tr>
                                                            <!-- <tr>
                                                                <td></td>
                                                                <td></td>
                                                            </tr> -->

                                                        </table>
                                                    </td>

                                                </tr>

                                            </table>

                                        </fieldset>

                                    </div><br>

                                    <div class="formArea">

                                        <input type="submit" name="Submit" value="Submit" class="button">

                                    </div>

                                </form>

                            </DIV><!-- End #tab1 -->





                        </DIV><!-- End .content-box-content -->

                    </DIV>

                    <?php

}
?>


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