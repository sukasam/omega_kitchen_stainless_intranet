<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";

if ($_POST["mode"] != "") {
    $param = "";
    $a_not_exists = array();
    $param = get_param($a_param, $a_not_exists);

    $a_sdate = explode("/", $_POST['sr_stime']);
    $_POST['sr_stime'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['job_open']);
    $_POST['job_open'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['job_close']);
    $_POST['job_close'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['job_balance']);
    $_POST['job_balance'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['loc_date2']);
    $_POST['loc_date2'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['loc_date3']);
    $_POST['loc_date3'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['sell_date']);
    $_POST['sell_date'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['ref_date']);
    $_POST['ref_date'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    for ($i = 1; $i <= $_POST['rowCalPro']; $i++) {
        $codeChkList .= $_POST['codes_' . $i] . ",";
    }

    $_POST['codelist'] = substr($codeChkList, 0, -1);

    if ($_POST["mode"] == "add") {

        $_POST['approve'] = 0;
        $_POST['st_setting'] = 0;
        $_POST['supply'] = 0;

        if ($_POST['cus_id'] == "") {
            $_POST['cus_id'] = 1;
        }

        $_POST['detail_recom'] = nl2br($_POST['detail_recom']);
        $_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
        $_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);

        $_POST['costSum'] = preg_replace("/,/", "", $_POST['costSum']);
        $_POST['costCut'] = preg_replace("/,/", "", $_POST['costCut']);
        $_POST['costOT'] = preg_replace("/,/", "", $_POST['costOT']);
        $_POST['costLaser'] = preg_replace("/,/", "", $_POST['costLaser']);
        $_POST['costGP'] = preg_replace("/,/", "", $_POST['costGP']);
        $_POST['costElec'] = preg_replace("/,/", "", $_POST['costElec']);
        $_POST['costLost'] = preg_replace("/,/", "", $_POST['costLost']);
        $_POST['costOv'] = preg_replace("/,/", "", $_POST['costOv']);

        $costFactory = $_POST['costCut'] + $_POST['costOT'] + $_POST['costLaser'] + $_POST['costElec'] + $_POST['costLost'];
        $costGPSum = ($costFactory * ($_POST['costGP'] / 100));
        $costOvSum = ($costFactory * ($_POST['costOv'] / 100));
        $costSum = $costFactory + $costGPSum + $costOvSum;

        $codes = $_POST['codes'];
        $lists = $_POST['lists'];
        $units = $_POST['units'];
        $prices = $_POST['prices'];
        $amounts = $_POST['amounts'];
        $opens = $_POST['opens'];
        $remains = $_POST['remains'];

        $_POST['sr_stime'] = date("Y-m-d", strtotime("+7 day", strtotime($_POST['sr_stime'])));

        $_POST['job_last'] = get_lastservice_s($conn, $_POST['cus_id'], "");

        include "../include/m_add.php";

        $id = mysqli_insert_id($conn);

        foreach ($codes as $a => $b) {

            if ($lists[$a] != "") {
                if ($opens[$a] == "") {
                    $opens[$a] = 0;
                }
                @mysqli_query($conn, "INSERT INTO `s_service_report2sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '" . $id . "', '" . $codes[$a] . "', '" . $lists[$a] . "', '" . $units[$a] . "', '" . $prices[$a] . "', '" . $amounts[$a] . "', '" . $opens[$a] . "', '" . ($amounts[$a] - $opens[$a]) . "');");
                @mysqli_query($conn, "UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '" . $opens[$a] . "' WHERE `group_id` = '" . $lists[$a] . "';");
            }
        }

        include_once "../mpdf54/mpdf.php";
        include_once "form_serviceopen.php";
        $mpdf = new mPDF('UTF-8');
        $mpdf->SetAutoFont();
        $mpdf->WriteHTML($form);
        $chaf = preg_replace("/\//", "-", $_POST['sv_id']);
        $mpdf->Output('../../upload/service_report_open/' . $chaf . '.pdf', 'F');

        header("location:index.php?" . $param);
    }
    if ($_POST["mode"] == "update") {

        $_POST['detail_recom'] = nl2br($_POST['detail_recom']);
        $_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);

        $_POST['costSum'] = preg_replace("/,/", "", $_POST['costSum']);
        $_POST['costCut'] = preg_replace("/,/", "", $_POST['costCut']);
        $_POST['costOT'] = preg_replace("/,/", "", $_POST['costOT']);
        $_POST['costLaser'] = preg_replace("/,/", "", $_POST['costLaser']);
        $_POST['costGP'] = preg_replace("/,/", "", $_POST['costGP']);
        $_POST['costElec'] = preg_replace("/,/", "", $_POST['costElec']);
        $_POST['costLost'] = preg_replace("/,/", "", $_POST['costLost']);
        $_POST['costOv'] = preg_replace("/,/", "", $_POST['costOv']);

        $costFactory = $_POST['costCut'] + $_POST['costOT'] + $_POST['costLaser'] + $_POST['costElec'] + $_POST['costLost'];
        $costGPSum = ($costFactory * ($_POST['costGP'] / 100));
        $costOvSum = ($costFactory * ($_POST['costOv'] / 100));
        $costSum = $costFactory + $costGPSum + $costOvSum;

        $_POST['job_last'] = get_lastservice_f($conn, $_POST['cus_id'], $_POST['sv_id']);

        $chaf = preg_replace("/\//", "-", $_POST['sv_id']);

        $codes = $_POST['codes'];
        $lists = $_POST['lists'];
        $units = $_POST['units'];
        $prices = $_POST['prices'];
        $amounts = $_POST['amounts'];
        $opens = $_POST['opens'];
        $remains = $_POST['remains'];
        $rid = $_POST['r_id'];

        $sql2 = "select * from s_service_report2sub where sr_id = '" . $_REQUEST[$PK_field] . "'";
        $quPro = @mysqli_query($conn, $sql2);
        while ($rowPro = mysqli_fetch_array($quPro)) {
            @mysqli_query($conn, "UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`+'" . $rowPro['opens'] . "' WHERE `group_id` = '" . $rowPro['lists'] . "';");
        }

        @mysqli_query($conn, "DELETE FROM `s_service_report2sub` WHERE `sr_id` = '" . $_REQUEST[$PK_field] . "'");

        include "../include/m_update.php";

        $id = $_REQUEST[$PK_field];

        foreach ($codes as $a => $b) {

            if ($lists[$a] != "") {
                if ($opens[$a] == "") {
                    $opens[$a] = 0;
                }
                @mysqli_query($conn, "INSERT INTO `s_service_report2sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '" . $id . "', '" . $codes[$a] . "', '" . $lists[$a] . "', '" . $units[$a] . "', '" . $prices[$a] . "', '" . $amounts[$a] . "', '" . $opens[$a] . "', '" . ($amounts[$a] - $opens[$a]) . "');");
                @mysqli_query($conn, "UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '" . $opens[$a] . "' WHERE `group_id` = '" . $lists[$a] . "';");
            }

        }

        include_once "../mpdf54/mpdf.php";
        include_once "form_serviceopen.php";
        $mpdf = new mPDF('UTF-8');
        $mpdf->SetAutoFont();
        $mpdf->WriteHTML($form);
        $chaf = preg_replace("/\//", "-", $_POST['sv_id']);
        $mpdf->Output('../../upload/service_report_open/' . $chaf . '.pdf', 'F');

        header("location:index.php?" . $param);
    }

}
if ($_GET["mode"] == "add") {
    Check_Permission($conn, $check_module, $_SESSION["login_id"], "add");
    $costFactory = "0.00";
    $costGPSum = "0.00";
    $costOvSum = "0.00";
    $costSum = "0.00";
}
if ($_GET["mode"] == "update") {

    Check_Permission($conn, $check_module, $_SESSION["login_id"], "update");
    $sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] . "'";
    $query = @mysqli_query($conn, $sql);
    while ($rec = @mysqli_fetch_array($query)) {
        $$PK_field = $rec[$PK_field];
        foreach ($fieldlist as $key => $value) {
            $$value = $rec[$value];
        }
    }

    $a_sdate = explode("-", $sr_stime);
    $sr_stime = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $job_open);
    $job_open = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $job_close);
    $job_close = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $job_balance);
    $job_balance = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $loc_date2);
    $loc_date2 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $loc_date3);
    $loc_date3 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $sell_date);
    $sell_date = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $ref_date);
    $ref_date = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $finfo = get_firstorder2($conn, $cus_id, $cus_source);

    $ckf_list = explode(',', $ckf_list);

    $costFactory = $costCut + $costOT + $costLaser + $costElec + $costLost;
    $costGPSum = ($costFactory * ($costGP / 100));
    $costOvSum = ($costFactory * ($costOv / 100));
    $costSum = $costFactory + $costGPSum + $costOvSum;
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
    <SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
    <SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
    <script type="text/javascript" src="scriptform.js"></script>
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
    function check(frm) {
        if (frm.group_name.value.length == 0) {
            alert('Please enter group name !!');
            frm.group_name.focus();
            return false;
        }
    }

    function CountChecks(whichlist, maxchecked, latestcheck, numsa) {

        var listone = new Array();

        for (var t = 1; t <= numsa; t++) {
            listone[t - 1] = 'checkbox' + t;
        }

        // End of customization.
        var iterationlist;
        eval("iterationlist=" + whichlist);
        var count = 0;
        for (var i = 0; i < iterationlist.length; i++) {
            if (document.getElementById(iterationlist[i]).checked == true) {
                count++;
            }
            if (count > maxchecked) {
                latestcheck.checked = false;
            }
        }
        if (count > maxchecked) {
            // alert('Sorry, only ' + maxchecked + ' may be checked.');
        }
    }
    </script>
    <SCRIPT language=Javascript>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    function isNumberDecimalKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
    </SCRIPT>

    <script type="text/javascript">
    function get_customer(cid, cname, chk) {
        // alert(chk);
        // alert(cname);
        var sCustomerName = document.getElementById("cd_names");

        sCustomerName.value = cname;

        var sCustomerSource = document.getElementById("cus_source");

        sCustomerSource.value = chk;
        checkfirstorder(cid, 'cusadd', 'cusprovince', 'custel', 'cusfax', 'contactid', 'datef', 'datet', 'cscont',
            'cstel', 'sloc_name', 'sevlast', 'prolist', 'sr_ctype2', chk);
        document.getElementById("rsnameid").innerHTML = "<input type=\"hidden\" name=\"cus_id\" value=\"" + cid + "\">";
    }

    function get_cus2(pval, chk) {
        /*alert(pval);*/
        var xmlHttp;

        //alert(chk);
        if (chk == 'po') {
            document.getElementById("search_fo").value = '';
        } else if (chk == 'fopj') {
            document.getElementById("search_po").value = '';
        } else {
            document.getElementById("search_po").value = '';
        }

        xmlHttp = GetXmlHttpObject(); //Check Support Brownser
        URL = pathLocal + 'ajax_return.php?action=getcus2&pval=' + pval + '&chk=' + chk;
        if (xmlHttp == null) {
            alert("Browser does not support HTTP Request");
            return;
        }
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
                //document.getElementById('rscus').innerHTML = xmlHttp.responseText;
                //alert(xmlHttp.responseText);
                var ds = xmlHttp.responseText.split("|");
                //alert(ds[3]);
                get_customer(ds[1], ds[2], ds[3]);

            } else {
                //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
            }
        };
        xmlHttp.open("GET", URL, true);
        xmlHttp.send(null);
    }

    function submitForm() {
        document.getElementById("submitF").disabled = true;
        document.getElementById("resetF").disabled = true;
        document.form1.submit()
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
            <P id=page-intro><?php if ($mode == "add") {?>Enter new information<?php } else {?>แก้ไข
                [<?php echo $page_name; ?>]<?php }?> </P>
            <UL class=shortcut-buttons-set>
                <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG alt=icon
                                src="../images/btn_back.gif"><BR>
                            กลับ</SPAN></A></LI>
            </UL>
            <!-- End .clear -->
            <DIV class=clear></DIV><!-- End .clear -->
            <DIV class=content-box>
                <!-- Start Content Box -->
                <DIV class=content-box-header align="right">

                    <H3 align="left"><?php echo $check_module; ?></H3>
                    <DIV class=clear>

                    </DIV>
                </DIV><!-- End .content-box-header -->
                <DIV class=content-box-content>
                    <DIV id=tab1 class="tab-content default-tab">
                        <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"
                            onSubmit="return check(this)">
                            <div class="formArea">
                                <fieldset>
                                    <legend><?php echo $page_name; ?> </legend>
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td>
                                                <style>
                                                .bgheader {
                                                    font-size: 12px;
                                                    position: absolute;
                                                    margin-top: 98px;
                                                    padding-left: 586px;
                                                }

                                                table tr td {
                                                    vertical-align: top;
                                                    padding: 5px;
                                                }

                                                .tb1 {
                                                    margin-top: 5px;
                                                }

                                                .tb1 tr td {
                                                    border: 1px solid #000000;
                                                    font-size: 12px;
                                                    font-family: Verdana, Geneva, sans-serif;
                                                    padding: 5px;
                                                }

                                                .tb2,
                                                .tb3 {
                                                    border: 1px solid #000000;
                                                    margin-top: 5px;
                                                }

                                                .tb2 tr td {
                                                    font-size: 12px;
                                                    font-family: Verdana, Geneva, sans-serif;
                                                    padding: 5px;
                                                }

                                                .tb3 tr td {
                                                    font-size: 12px;
                                                    font-family: Verdana, Geneva, sans-serif;
                                                    padding: 5px;
                                                }

                                                .tb3 img {
                                                    vertical-align: bottom;
                                                }

                                                .ccontact {
                                                    font-size: 12px;
                                                    font-family: Verdana, Geneva, sans-serif;
                                                }

                                                .ccontact tr td {}

                                                .cdetail {
                                                    border: 1px solid #000000;
                                                    padding: 5px;
                                                    font-size: 12px;
                                                    font-family: Verdana, Geneva, sans-serif;
                                                    margin-top: 5px;
                                                }

                                                .cdetail ul li {
                                                    list-style: none;

                                                }

                                                .cdetail2 ul li {
                                                    list-style: none;
                                                    float: left;
                                                }

                                                .clear {
                                                    margin: 0;
                                                    padding: 0;
                                                    clear: both;
                                                }

                                                .tblf5 {
                                                    border: 1px solid #000000;
                                                    font-size: 12px;
                                                    font-family: Verdana, Geneva, sans-serif;
                                                    margin-top: 5px;
                                                }
                                                </style>

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td style="text-align:right;font-size:12px;">
                                                            <div style="position:relative;text-align:center;">
                                                                <img src="../images/form/header_service_report2.png"
                                                                    width="100%" border="0" style="max-width:1182px;" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                    class="tb1">
                                                    <tr>
                                                        <td><strong>ชื่อลูกค้า :</strong>
                                                            <!--<select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
                	<option value="">กรุณาเลือก</option>
                	<?php
$tableDB = '';
if ($cus_source === 'po') {
    $tableDB = 's_project_order';
} else if ($cus_source === 'fopj') {
    $tableDB = 's_fopj';
} else {
    $tableDB = 's_first_order';
}
$qu_cusf = @mysqli_query($conn, "SELECT * FROM " . $tableDB . " ORDER BY cd_name ASC");
while ($row_cusf = @mysqli_fetch_array($qu_cusf)) {
    ?>
							<option value="<?php echo $row_cusf['fo_id']; ?>" <?php if ($row_cusf['fo_id'] == $cus_id) {echo 'selected';}?>><?php echo $row_cusf['cd_name'] . " (" . $row_cusf['loc_name'] . ")"; ?></option>
							<?php
}
?>
                </select>-->
                                                            <!-- <input name="cd_names" type="text" id="cd_names" value="<?php echo get_customername2($conn, $cus_id, $cus_source); ?>" style="width:50%;" readonly> -->
                                                            <span
                                                                id="cd_names"><?php echo get_customername2($conn, $cus_id, $cus_source); ?></span>
                                                            <input type="hidden" name="cus_source" id="cus_source"
                                                                value="<?php echo $cus_source; ?>">
                                                            <span id="rsnameid"><input type="hidden" name="cus_id"
                                                                    value="<?php echo $cus_id; ?>"></span><a
                                                                href="javascript:void(0);"
                                                                onClick="windowOpener('400', '500', '', 'search.php?chk=fo');"><img
                                                                    src="../images/icon2/mark_f2.png" width="25"
                                                                    height="25" border="0" alt=""
                                                                    style="vertical-align:middle;padding-left:5px;"></a>
                                                        </td>
                                                        <td><strong>ประเภทบริการลูกค้า :</strong>
                                                            <select name="sr_ctype" id="sr_ctype">
                                                                <!--<option value="">กรุณาเลือก</option>-->
                                                                <?php
$qu_cusftype = @mysqli_query($conn, "SELECT * FROM s_group_service ORDER BY group_name ASC");
while ($row_cusftype = @mysqli_fetch_array($qu_cusftype)) {
    ?>
                                                                <option
                                                                    value="<?php echo $row_cusftype['group_id']; ?>"
                                                                    <?php if ($row_cusftype['group_id'] == $sr_ctype) {echo 'selected';}?>>
                                                                    <?php echo $row_cusftype['group_name']; ?></option>
                                                                <?php
}
?>
                                                            </select>
                                                            <strong>ประเภทลูกค้า :</strong>
                                                            <select name="sr_ctype2" id="sr_ctype2">
                                                                <!--<option value="">กรุณาเลือก</option>-->
                                                                <?php
$qu_cusftype2 = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");
while ($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)) {
    if (substr($row_cusftype2['group_name'], 0, 2) !== "SR") {
        ?>
                                                                <option
                                                                    value="<?php echo $row_cusftype2['group_id']; ?>"
                                                                    <?php if ($row_cusftype2['group_id'] == $sr_ctype2) {echo 'selected';}?>>
                                                                    <?php echo $row_cusftype2['group_name']; ?>
                                                                </option>
                                                                <?php
}
}
?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>ที่อยู่ :</strong> <span
                                                                id="cusadd"><?php echo $finfo['cd_address']; ?></span>
                                                        </td>
                                                        <td>
                                                            <strong>เลขที่บริการ</strong> :
                                                            <input type="text" name="sv_id"
                                                                value="<?php if ($sv_id == "") {echo check_serviceman($conn);} else {echo $sv_id;}
;?>"
                                                                id="sv_id" class="inpfoder" style="border:0;">

                                                            <!--&nbsp;&nbsp;<strong>เลขที่ใบงาน</strong> : -->
                                                            <!--<input type="text" name="sv_id" value="<?php if ($sv_id == "") {echo "SR";} else {echo $sv_id;}
;?>" id="sv_id" class="inpfoder" style="border:0;">&nbsp;&nbsp;เลขที่สัญญา  :</strong> <span id="contactid"><?php echo $finfo['fs_id']; ?></span><strong>
<input type="text" name="srid" value="<?php echo $srid; ?>" id="srid" class="inpfoder"></strong>-->

                                                            <span id="contactid"
                                                                style="display: none;"><?php echo $finfo['fs_id']; ?></span>

                                                            <!-- <strong>เลขที่ FO :</strong> <input type="text" name="search_fo" value="<?php echo $search_fo; ?>" id="search_fo" class="inpfoder" onkeyup="get_cus2(this.value,'fo');">&nbsp;&nbsp;
			<strong>เลขที่ PJ :</strong> <input type="text" name="search_po" value="<?php echo $search_po; ?>" id="search_po" class="inpfoder" onkeyup="get_cus2(this.value,'fopj');"> -->
                                                            <strong>เลขที่ FO :</strong> <input type="text"
                                                                name="search_fo" value="<?php echo $search_fo; ?>"
                                                                id="search_fo" class="inpfoder"
                                                                style="border:0;">&nbsp;&nbsp;
                                                            <strong>เลขที่ PJ :</strong> <input type="text"
                                                                name="search_po" value="<?php echo $search_po; ?>"
                                                                id="search_po" class="inpfoder" style="border:0;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>จังหวัด :</strong> <span
                                                                id="cusprovince"><?php echo province_name($conn, $finfo['cd_province']); ?></span>
                                                        </td>
                                                        <td><strong>วันที่เบิกอะไหล่ :</strong> <span id="datef"></span>
                                                            <input type="text" name="job_open" readonly
                                                                value="<?php if ($job_open == "") {echo date("d/m/Y");} else {echo $job_open;}?>"
                                                                class="inpfoder" />
                                                            <script language="JavaScript">
                                                            new tcal({
                                                                'formname': 'form1',
                                                                'controlname': 'job_open'
                                                            });
                                                            </script>
                                                            &nbsp;&nbsp;
                                                            <strong>เลขที่ OP :</strong> <input type="text"
                                                                name="search_op" value="<?php echo $search_op; ?>"
                                                                id="search_op" class="inpfoder" style="border:0;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>โทรศัพท์ :</strong> <span
                                                                id="custel"><?php echo $finfo['cd_tel']; ?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์
                                                                :</strong> <span
                                                                id="cusfax"><?php echo $finfo['cd_fax']; ?></span></td>
                                                        <td>
                                                            <!--<strong>บริการครั้งล่าสุด : </strong> <span id="sevlast"><?php echo get_lastservice_f($conn, $cus_id, $sv_id); ?></span> &nbsp;&nbsp;&nbsp;&nbsp;--><strong>กำหนดคืนอะไหล่
                                                                :</strong>
                                                            <span id="sevlast"
                                                                style="display: none;"><?php echo get_lastservice_f($conn, $cus_id, $sv_id); ?></span>
                                                            <span id="datet"></span>
                                                            <input type="text" name="job_balance" readonly
                                                                value="<?php if ($job_balance == "") {echo date("d/m/Y");} else {echo $job_balance;}?>"
                                                                class="inpfoder" />
                                                            <script language="JavaScript">
                                                            new tcal({
                                                                'formname': 'form1',
                                                                'controlname': 'job_balance'
                                                            });
                                                            </script>
                                                            <input type="hidden" name="job_close"
                                                                value="<?php if ($job_close == "") {echo date("d/m/Y");} else {echo $job_close;}?>"
                                                                class="inpfoder" />&nbsp;&nbsp;<strong>วันที่คืนอะไหล่
                                                                :</strong><span
                                                                style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
                                                                <input type="text" name="sr_stime" readonly
                                                                    value="<?php if ($sr_stime == "") {echo date("d/m/Y");} else {echo $sr_stime;}?>"
                                                                    class="inpfoder" />
                                                                <script language="JavaScript">
                                                                new tcal({
                                                                    'formname': 'form1',
                                                                    'controlname': 'sr_stime'
                                                                });
                                                                </script>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>ชื่อผู้ติดต่อ :</strong> <span
                                                                id="cscont"><?php echo $finfo['c_contact']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร
                                                                :</strong> <span
                                                                id="cstel"><?php echo $finfo['c_tel']; ?></span></td>
                                                        <td><strong>อ้างอิงใบยืม </strong>: <strong>
                                                                <input type="text" name="srid2"
                                                                    value="<?php echo $srid2; ?>" id="srid2"
                                                                    class="inpfoder">
                                                            </strong>&nbsp;&nbsp;<strong>วันที่ :</strong><span
                                                                style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
                                                                <input type="text" name="ref_date" readonly
                                                                    value="<?php if ($ref_date == "") {echo date("d/m/Y");} else {echo $ref_date;}?>"
                                                                    class="inpfoder" />
                                                                <script language="JavaScript">
                                                                new tcal({
                                                                    'formname': 'form1',
                                                                    'controlname': 'ref_date'
                                                                });
                                                                </script>
                                                            </span></td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                    class="tb1">
                                                    <tr>
                                                        <td width="50%"><strong>สถานที่ติดตั้ง / ส่งสินค้า :
                                                            </strong><span
                                                                id="sloc_name"><?php echo $finfo['loc_name']; ?></span><br /><br />

                                                                <p style="font-size: 14px;font-weight: bold;">ค่าใช้จ่ายอื่นๆ : รวมยอดทั้งสิ้น : <?php echo number_format($costSum, 2); ?> บาท</p>
                                                                <p>ค่าแรงช่าง ตับ/พับ/ประกอบ/ขัด : <input type="text"
                                                                name="costCut" value="<?php echo $costCut; ?>"
                                                                id="costCut" class="inpfoder" style="text-align: center;width: 60px;" onkeypress="return isNumberDecimalKey(event)">&nbsp;&nbsp;&nbsp;
                                                                รวม Factory Cost : <input type="text"
                                                                name="costFactory" value="<?php echo number_format($costFactory, 2); ?>"
                                                                id="costFactory" class="inpfoder" style="text-align: center;width: 100px;border: 0;" readonly> บาท</p>
                                                                <p>ค่าล่วงเวลา : <input type="text"
                                                                name="costOT" value="<?php echo $costOT; ?>"
                                                                id="costOT" class="inpfoder" style="text-align: center;width: 60px;" onkeypress="return isNumberDecimalKey(event)">
                                                                 ค่าเลเซอร์ : <input type="text"
                                                                name="costLaser" value="<?php echo $costLaser; ?>"
                                                                id="costLaser" class="inpfoder" style="text-align: center;width: 60px;" onkeypress="return isNumberDecimalKey(event)">
                                                                &nbsp;&nbsp;&nbsp;Gross Profit (GP) : <input type="text"
                                                                name="costGP" value="<?php echo $costGP; ?>"
                                                                id="costGP" class="inpfoder" style="text-align: center;width: 30px;" onkeypress="return isNumberKey(event)"> % = <input type="text"
                                                                name="costGPSum" value="<?php echo number_format($costGPSum, 2); ?>"
                                                                id="costGPSum" class="inpfoder" style="text-align: left;width: 80px;border: 0;" readonly></p>
                                                                <p>ค่าน้ำ/ค่าไฟ : <input type="text"
                                                                name="costElec" value="<?php echo $costElec; ?>"
                                                                id="costElec" class="inpfoder" style="text-align: center;width: 60px;" onkeypress="return isNumberDecimalKey(event)">
                                                                ค่าวัตถุดิบสูญเสีย : <input type="text"
                                                                name="costLost" value="<?php echo $costLost; ?>"
                                                                id="costLost" class="inpfoder" style="text-align: center;width: 60px;" onkeypress="return isNumberDecimalKey(event)">
                                                                &nbsp;&nbsp;&nbsp;ค่า Overhead : <input type="text"
                                                                name="costOv" value="<?php echo $costOv; ?>"
                                                                id="costOv" class="inpfoder" style="text-align: center;width: 30px;" onkeypress="return isNumberKey(event)"> % = <input type="text"
                                                                name="costOvSum" value="<?php echo number_format($costOvSum, 2); ?>"
                                                                id="costOvSum" class="inpfoder" style="text-align: left;width: 80px;border: 0;" readonly></p>

                                                            <div style="display: none;">
                                                                <br>
                                                                <strong>เลือกสินค้า :</strong>
                                                                <span id="prolist">
                                                                    <?php
$prolist = get_profirstorder2($conn, $cus_id, $cus_source);
//$lispp = explode(",",$prolist);
$plid = "<select name=\"bbfpro\" id=\"bbfpro\" onchange=\"get_podsn(this.value,'lpa1','lpa2','lpa3','" . $cus_id . "')\">
								<option value=\"\">กรุณาเลือก</option>
							 ";
for ($i = 0; $i < count($prolist); $i++) {
    $plid .= "<option value=" . $i . ">" . get_proname($conn, $prolist[$i]) . "</option>";
}
echo $plid .= "</select>";
?>
                                                                </span>
                                                                <br>
                                                                <br />
                                                                <strong>เครื่องล้างจาน / ยี่ห้อ : </strong><span
                                                                    style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"
                                                                    id="lpa1">
                                                                    <input type="text" name="loc_pro"
                                                                        value="<?php echo $loc_pro; ?>" id="loc_pro"
                                                                        class="inpfoder" style="width:50%;">
                                                                </span><br>
                                                                <br />
                                                                <strong>รุ่นเครื่อง : </strong><span id="lpa2"><input
                                                                        type="text" name="loc_seal"
                                                                        value="<?php echo $loc_seal; ?>" id="loc_seal"
                                                                        class="inpfoder"
                                                                        style="width:20%;"></span>&nbsp;&nbsp;&nbsp;<strong>S/N</strong>&nbsp;<span
                                                                    id="lpa3"><input type="text" name="loc_sn"
                                                                        value="<?php echo $loc_sn; ?>" id="loc_sn"
                                                                        class="inpfoder"
                                                                        style="width:20%;"></span><br /><br />
                                                                <strong>เครื่องป้อนน้ำยา : </strong><input type="text"
                                                                    name="loc_clean" value="<?php echo $loc_clean; ?>"
                                                                    id="loc_clean" class="inpfoder"
                                                                    style="width:50%;"><br />
                                                                <br>
                                                                <strong>ช่างบริการประจำ :</strong>
                                                                <select name="loc_contact" id="loc_contact">
                                                                    <option value="">กรุณาเลือก</option>
                                                                    <?php
$qu_custec = @mysqli_query($conn, "SELECT * FROM s_group_technician ORDER BY group_name ASC");
while ($row_custec = @mysqli_fetch_array($qu_custec)) {
    ?>
                                                                    <option
                                                                        value="<?php echo $row_custec['group_id']; ?>"
                                                                        <?php if ($row_custec['group_id'] == $loc_contact) {echo 'selected';}?>>
                                                                        <?php echo $row_custec['group_name'] . " (Tel : " . $row_custec['group_tel'] . ")"; ?>
                                                                    </option>
                                                                    <?php
}
?>
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td width="50%">
                                                            <center style="font-size:19px;font-weight:bold;">
                                                                <strong>รายละเอียดการเบิกอะไหล่เพื่อผลิต</strong>
                                                            </center><br><br>
                                                            <textarea name="detail_recom" class="inpfoder"
                                                                id="detail_recom"
                                                                style="width:50%;height:100px;background:#FFFFFF;"><?php echo strip_tags($detail_recom); ?></textarea>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <div>
                                                    <center><strong
                                                            style="font-size:18px;font-weight:bold;">รายละเอียดสินค้าสั่งผลิต</strong>
                                                    </center><br>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                        style="font-size:12px;text-align:center;">
                                                        <tr>
                                                            <td width="3%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong></strong></td>
                                                            <td width="3%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong>ลำดับ</strong></td>
                                                            <td width="10%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong>รหัสสินค้า</strong></td>
                                                            <td width="24%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong>รายการ</strong></td>
                                                            <td width="15%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong>รุ่น / แบรนด์</strong></td>
                                                            <td width="10%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong>ขนาด</strong></td>
                                                            <td width="10%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong>จำนวน</strong></td>
                                                            <td width="10%"
                                                                style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                                                                <strong>Code</strong></td>

                                                        </tr>
                                                        <tbody id="expPro" name="expPro">
                                                            <?php

$getProList = get_fopj_pro($conn, $cus_id);
$rowCal = 1;
$chkOp = get_checkOP($conn, $cus_id, $_GET['sr_id']);
$proOpList = explode(',', $chkOp);
$proOpRadioList = explode(',', $chkprolists);
$rowCalLev2 = 0;
$proOpCodeList = explode(',', $codelist);
$rowCalNumPro = mysqli_num_rows($getProList);

$chkPOItem = chkPOItemSelect($conn, $cus_id, $search_op);

while ($rowPro = mysqli_fetch_array($getProList)) {
    if (in_array($rowCal, $proOpList)) {

        // if (in_array($rowCal, $chkPOItem)) {
        //     $ReChkOp = (in_array($rowCal, $proOpRadioList)) ? '<input type="radio" name="chkprolists" value="' . $rowCal . '" checked="checked">' : '';
        // } else {
        //     $ReChkOp = (in_array($rowCal, $proOpRadioList)) ? '<input type="radio" name="chkprolists" value="' . $rowCal . '" checked="checked">' : '<input type="radio" name="chkprolists" value="' . $rowCal . '">';
        // }
        $ReChkOp = (in_array($rowCal, $proOpRadioList)) ? '<input type="radio" name="chkprolists" value="' . $rowCal . '" checked="checked">' : '<input type="radio" name="chkprolists" value="' . $rowCal . '">';
        ?>
            <?php if ($_GET['mode'] === "update") {
            if (in_array($rowCal, $proOpRadioList)) {
                ?>
            <tr>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo $ReChkOp; ?>
                    </td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo ($rowCalLev2 + 1); ?></td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo get_stock_project_code($conn, $rowPro['cpro']); ?>
                    </td>
                    <td
                        style="border:1px solid #000000;text-align:left;padding:5;">
                        <?php echo get_stock_project_name($conn, $rowPro['cpro']); ?>
                    </td>
                    <td style="border:1px solid #000000;padding:5;text-align:center;"
                        id="cpropod<?php echo $rowCal; ?>">
                        <?php echo get_stock_project_sn($conn, $rowPro['cpro']); ?>
                    </td>
                    <td style="border:1px solid #000000;padding:5;text-align:center;"
                        id="cprosize<?php echo $rowCal; ?>">
                        <?php echo get_stock_project_size($conn, $rowPro['cpro']); ?>
                    </td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo $rowPro['camount']; ?>
                    </td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <input type="text"
                            name="codes_<?php echo $rowCal; ?>"
                            value="<?php echo $proOpCodeList[$rowCalLev2]; ?>"
                            style="width:100%">
                    </td>
                </tr>
        <?php
}
        } else {
            ?>
            <tr>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo $ReChkOp; ?>
                    </td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo ($rowCalLev2 + 1); ?></td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo get_stock_project_code($conn, $rowPro['cpro']); ?>
                    </td>
                    <td
                        style="border:1px solid #000000;text-align:left;padding:5;">
                        <?php echo get_stock_project_name($conn, $rowPro['cpro']); ?>
                    </td>
                    <td style="border:1px solid #000000;padding:5;text-align:center;"
                        id="cpropod<?php echo $rowCal; ?>">
                        <?php echo get_stock_project_sn($conn, $rowPro['cpro']); ?>
                    </td>
                    <td style="border:1px solid #000000;padding:5;text-align:center;"
                        id="cprosize<?php echo $rowCal; ?>">
                        <?php echo get_stock_project_size($conn, $rowPro['cpro']); ?>
                    </td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <?php echo $rowPro['camount']; ?>
                    </td>
                    <td
                        style="border:1px solid #000000;padding:5;text-align:center;">
                        <input type="text"
                            name="codes_<?php echo $rowCal; ?>"
                            value="<?php echo $proOpCodeList[$rowCalLev2]; ?>"
                            style="width:100%">
                    </td>
                </tr>
            <?php
}?>

                                                            <?php
$rowCalLev2++;
    }
    ?>
                                                            <?php
$rowCal++;
}
?>
                                                            <input type="hidden" name="rowCalPro"
                                                                value="<?php echo $rowCalNumPro; ?>">
                                                        </tbody>
                                                    </table>
                                    </table>
                            </div>

                            <center>
                                <br>
                                <span style="font-size:18px;font-weight:bold;">รายละเอียดการเบิกอะไหล่เพื่อผลิต</span>
                            </center><br>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable"
                                style="text-align:center;margin-top:5px;">
                                <tr>
                                    <td width="4%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>ลำดับ</strong></td>
                                    <td width="10%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>รหัสสินค้า</strong></td>
                                    <td width="30%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <strong>รายการ</strong></td>
                                    <td width="9%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>สถานที่จัดเก็บ</strong></td>
                                    <td width="9%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>หน่วยนับ</strong></td>
                                    <td width="9%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>คงเหลือ Stock</strong></td>
                                    <td width="9%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>ราคา/หน่วย</strong></td>
                                    <td width="9%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>จำนวนเบิก</strong></td>
                                    <!--<td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนคงเหลือ</strong></td>-->
                                </tr>
                                <?php
if ($_GET['mode'] == "update") {
    $qu = @mysqli_query($conn, "SELECT * FROM s_service_report2sub WHERE sr_id = '" . $sr_id . "' ORDER BY r_id ASC");
    while ($row_sub = @mysqli_fetch_array($qu)) {
        $brid[] = $row_sub['r_id'];
        $bcodes[] = $row_sub['codes'];
        $blists[] = $row_sub['lists'];
        $bunits[] = $row_sub['units'];
        $bprices[] = $row_sub['prices'];
        $bamounts[] = $row_sub['amounts'];
        $bopens[] = $row_sub['opens'];
        $bremains[] = $row_sub['remains'];
    }
}
for ($i = 1; $i <= 14; $i++) {
    ?>

                                <tr>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <?php echo $i; ?></td>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <input type="text" name="codes[]" id="codes<?php echo $i; ?>"
                                            value="<?php echo $bcodes[$i - 1]; ?>" style="width:100%" readonly></td>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <span id="listss<?php echo $i; ?>"><select name="lists[]"
                                                id="lists<?php echo $i; ?>" class="inputselect" style="width:92%"
                                                onchange="showspare(this.value,'<?php echo "codes" . $i; ?>','<?php echo "units" . $i; ?>','<?php echo "prices" . $i; ?>','<?php echo "amounts" . $i; ?>','<?php echo $i; ?>','<?php echo "locations" . $i; ?>')">
                                                <option value="">กรุณาเลือกรายการอะไหล่</option>
                                                <?php
$qucgspare = @mysqli_query($conn, "SELECT * FROM s_group_sparpart WHERE typespar != '2' ORDER BY group_spar_id ASC");
    while ($row_spare = @mysqli_fetch_array($qucgspare)) {
        ?>
                                                <option value="<?php echo $row_spare['group_id']; ?>"
                                                    <?php if ($blists[$i - 1] == $row_spare['group_id']) {echo 'selected';}?>>
                                                    <?php echo $row_spare['group_name']; ?>
                                                </option>
                                                <?php
}
    ?>
                                            </select></span><a href="javascript:void(0);"
                                            onClick="windowOpener('400', '500', '', 'search2.php?resdata=<?php echo $i; ?>');"><img
                                                src="../images/icon2/mark_f2.png" width="25" height="25" border="0"
                                                alt="" style="vertical-align:middle;padding-left:5px;"></a>
                                    </td>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <input type="text" name="locations[]" id="locations<?php echo $i; ?>"
                                            value="<?php echo get_nameStock($conn, $blists[$i - 1]); ?>"
                                            style="width:100%;text-align:center;" readonly></td>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <input type="hidden" name="r_id[]" value="<?php echo $brid[$i - 1] ?>"><input
                                            type="text" name="units[]" id="units<?php echo $i; ?>"
                                            value="<?php echo $bunits[$i - 1]; ?>" style="width:100%;text-align:center;"
                                            readonly></td>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <input type="text" name="amounts[]" id="amounts<?php echo $i; ?>" value="<?php
echo getStockSpar($conn, $blists[$i - 1]);
    ?>" style="width:100%;text-align:right;" readonly></td>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <input type="text" name="prices[]" id="prices<?php echo $i; ?>"
                                            value="<?php if ($bprices[$i - 1] != 0) {echo $bprices[$i - 1];}?>"
                                            style="width:100%;text-align:right;" readonly></td>
                                    <td
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
                                        <input type="text" name="opens[]" id="opens<?php echo $i; ?>"
                                            value="<?php if ($bopens[$i - 1] != 0) {echo $bopens[$i - 1];}?>"
                                            style="width:100%;text-align:right;" onkeypress="return isNumberDecimalKey(event)">
                                    </td>
                                    <!--<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="remains[]" id="remains<?php echo $i; ?>" value="<?php if ($bremains[$i - 1] != 0) {echo $bremains[$i - 1];}?>" style="width:100%;text-align:right;"></td>
        </tr>-->
                                    <?php
}
?>
                                <tr>
                                    <td colspan="6"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>รวมจำนวนที่เบิก</strong></td>
                                    <td colspan="3"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;">
                                        <strong>รายการ</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
                                        <strong>ใช้จ่ายรวม (รวมมูลค่าอะไหล่ที่เบิก)</strong></td>
                                    <td colspan="3"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;">
                                        <strong>บาท</strong></td>
                                </tr>
                            </table>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="text-align:center;margin-top:5px;">
                                <tr>
                                    <td width="33%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td
                                                    style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>
                                                        <select name="loc_contact2" id="loc_contact2"
                                                            style="width:50%;">
                                                            <?php
$qu_custec = @mysqli_query($conn, "SELECT * FROM s_group_sale ORDER BY group_name ASC");
while ($row_custec = @mysqli_fetch_array($qu_custec)) {
    ?>
                                                            <option value="<?php echo $row_custec['group_id']; ?>"
                                                                <?php if ($row_custec['group_id'] == $loc_contact2) {echo 'selected';}?>>
                                                                <?php echo $row_custec['group_name'] . " (Tel : " . $row_custec['group_tel'] . ")"; ?>
                                                            </option>
                                                            <?php
}
?>
                                                        </select>
                                                    </strong></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>ช่างเบิก</strong></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>วันที่ : </strong>
                                                    <input type="text" name="loc_date2" readonly
                                                        value="<?php if ($loc_date2 == "") {echo date("d/m/Y");} else {echo $loc_date2;}?>"
                                                        class="inpfoder" />
                                                    <script language="JavaScript">
                                                    new tcal({
                                                        'formname': 'form1',
                                                        'controlname': 'loc_date2'
                                                    });
                                                    </script>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td width="33%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td
                                                    style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>
                                                        <select name="cs_sell" id="cs_sell" class="inputselect"
                                                            style="width:50%;">
                                                            <?php
$qu_custec = @mysqli_query($conn, "SELECT * FROM s_group_sale WHERE 1 ORDER BY group_name ASC");
while ($row_custec = @mysqli_fetch_array($qu_custec)) {
    ?>
                                                            <option value="<?php echo $row_custec['group_id']; ?>"
                                                                <?php if ($row_custec['group_id'] == $cs_sell) {echo 'selected';}?>>
                                                                <?php echo $row_custec['group_name'] . " (Tel : " . $row_custec['group_tel'] . ")"; ?>
                                                            </option>
                                                            <?php
}
?>
                                                        </select>
                                                    </strong></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>ผู้จ่ายอ่ะไหล่</strong></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>วันที่ :</strong>
                                                    <input type="text" name="sell_date" readonly
                                                        value="<?php if ($sell_date == "") {echo date("d/m/Y");} else {echo $sell_date;}?>"
                                                        class="inpfoder" />
                                                    <script language="JavaScript">
                                                    new tcal({
                                                        'formname': 'form1',
                                                        'controlname': 'sell_date'
                                                    });
                                                    </script>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="33%"
                                        style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td
                                                    style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>

                                                        <?php
if ($loc_contact3 != '') {
    ?>
                                                        <?php echo getsalename($conn, $loc_contact3); ?>
                                                        <?php
} else {
    echo "<br>";
}
?>
                                                        <input type="hidden" name="loc_contact3"
                                                            value="<?php echo $loc_contact3; ?>">
                                                    </strong></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>ผู้อนุมัติ</strong></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                                                    <strong>วันที่ :</strong>
                                                    <input type="text" name="loc_date3" readonly
                                                        value="<?php if ($loc_date3 == "") {echo date("d/m/Y");} else {echo $loc_date3;}?>"
                                                        class="inpfoder" />
                                                    <script language="JavaScript">
                                                    new tcal({
                                                        'formname': 'form1',
                                                        'controlname': 'loc_date3'
                                                    });
                                                    </script>
                                                </td>


                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            </td>
                            </tr>
                            </table>
                            </fieldset>
                    </div><br>
                    <div class="formArea">
                        <input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
                        <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
                        <?php
$a_not_exists = array();
post_param($a_param, $a_not_exists);
?>
                        <input name="mode" type="hidden" id="mode" value="<?php echo $_GET["mode"]; ?>">
                        <input name="st_setting" type="hidden" id="    border: 1px solid;"
                            value="<?php echo $st_setting; ?>">
                        <input name="approve" type="hidden" id="approve" value="<?php echo $approve; ?>">
                        <input name="supply" type="hidden" id="supply" value="<?php echo $supply; ?>">
                        <input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>"
                            value="<?php echo $_GET[$PK_field]; ?>">
                    </div>
                    </form>
                </DIV>
            </DIV><!-- End .content-box-content -->
        </DIV><!-- End .content-box -->
        <!-- End .content-box -->
        <!-- End .content-box -->
        <DIV class=clear></DIV><!-- Start Notifications -->
        <!-- End Notifications -->

        <?php include "../footer.php";?>
    </DIV><!-- End #main-content -->
    </DIV>
    <?php if ($msg_user == 1) {?>
    <script language=JavaScript>
    alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');
    </script>
    <?php }?>
</BODY>

</HTML>