<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
include("config.php");
Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");
if ($_GET["page"] == "") {
    $_REQUEST['page'] = 1;
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

if ($_GET["action"] == "chksum") {
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
    <script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
    <script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../Carlender/calendar.css">

    <script>
    function confirmDelete(delUrl, text) {
        if (confirm("Are you sure you want to delete\n" + text)) {
            document.location = delUrl;
        }
    }
    //----------------------------------------------------------
    function check5(frm) {
        if (frm.pro_pod.value.length == 0) {
            alert('กรุณากรอกชื่อรุ่นเครื่อง !!');
            frm.pro_pod.focus();
            return false;
        }
    }

    function check8(frm) {
        if (frm.cs_company.value.length == 0) {
            alert('กรุณากรอกชื่อช่างติดตั้งเครื่อง !!');
            frm.cs_company.focus();
            return false;
        }
    }

    function check9(frm) {
        if (frm.cs_sell.value.length == 0) {
            alert('กรุณากรอกชื่อผู้ขาย !!');
            frm.cs_sell.focus();
            return false;
        }
    }
    </script>
    <link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
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
                <LI><A class=shortcut-button href="../report/?mid=16"><SPAN><IMG alt=icon
                                src="../images/icons/icon-48-category.png"><BR>
                            <strong>รายงาน <br>First Order</strong></SPAN></A></LI>
                <LI><A class=shortcut-button href="../report2/?mid=16"><SPAN><IMG alt=icon
                                src="../images/icons/icon-48-section.png"><BR>
                            <strong>รายงาน <br>Factory</strong></SPAN></A></LI>
            </UL>

            <!-- End .shortcut-buttons-set -->
            <DIV class=clear></DIV><!-- End .clear -->


            <!-- End .content-box -->
            <!-- End .content-box -->
            <!-- End .content-box -->
            <DIV class=clear></DIV><!-- Start Notifications -->
            <!-- End Notifications -->

            <?php include("../footer.php"); ?>
        </DIV><!-- End #main-content -->
    </DIV>
    <script type="text/javascript">
    var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    </script>
</BODY>

</HTML>