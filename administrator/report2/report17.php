<?php

include "../../include/config.php";

include "../../include/connect.php";

include "../../include/function.php";

include "config.php";

Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");

if ($_GET["page"] == "") {
    $_REQUEST['page'] = 1;
}

$param = get_param($a_param, $a_not_exists);

$a_sdate = explode("/", $_REQUEST['date_fm']);

$date_fm = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

$a_sdate = explode("/", $_REQUEST['date_to']);

$date_to = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

$gspar = $_POST['pro_pod'];
$cus_id = $_POST['cus_id'];

$condi = '';

if ($_REQUEST['priod'] == 0) {

    $daterriod = " AND `job_open` between '" . $date_fm . "' and '" . $date_to . "'";

    $dateshow = "เริ่มวันที่ : " . format_date($date_fm) . "&nbsp;&nbsp;ถึงวันที่ : " . format_date($date_to);
} else {

    $dateshow = "วันที่ดำเนินการ : " . format_date(date("Y-m-d"));
}

if ($cus_id != "") {
    $condi .= " AND (st.cus_id = '" . $cus_id . "')";
}

if ($gspar != "") {
    $condi .= " AND stp.lists = '" . $gspar . "'";
}

?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>เลือกตามใบเบิกวัตถุดิบเพื่อผลิต</title>

    <style type="text/css">
    .tbreport {

        font-size: 10px;

    }

    .tbreport th {

        font-weight: bold;

        text-align: left;

        border-bottom: 1px solid #000000;

        padding: 5;

    }

    .tbreport td {

        padding: 5px;

        vertical-align: top;

        border-bottom: 1px solid #000000;

    }
    </style>

</head>



<body>

    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

        <tr>

            <th colspan="6" style="text-align:left;font-size:12px;">บริษัท โอเมก้า คิทเช่น สแตนเลส จำกัด<br />

                รายงานใบเบิกวัตถุดิบเพื่อผลิต</th>

            <th colspan="7" style="text-align:right;font-size:11px;"><?php echo $dateshow; ?></th>

        </tr>

        <tr>

            <?php if ($_REQUEST['sh9'] == 1) {?><th width="5%">เลขที่ใบเบิก</th><?php }?>

            <th width="10%">วันที่เบิกอะไหล่</th>

            <th width="10%">เลขที่ FO,FO/JP</th>

            <?php if ($_REQUEST['sh1'] == 1) {?><th width="16%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php }?>

            <th style="white-space: nowrap;"><center>รหัสสินค้าสั่งผลิต</center></th>
            <th><center>Code</center></th>
            <th style="white-space: nowrap;"><center>จำนวนสั่งผลิต</center></th>

            <?php /*if ($_REQUEST['sh2'] == 1) { ?><th width="15%"> ชื่อร้าน / สถานที่ติดตั้ง</th><?php  } */?>

            <?php /*if ($_REQUEST['sh3'] == 1) { ?><th width="10%">จังหวัด</th><?php  } */?>



            <?php if ($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1) {?><th width="30%">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

                    <tr>

                        <?php if ($_REQUEST['sh4'] == 1) {?><td style="border-bottom:none;white-space: nowrap;" width="25%">
                            <strong>รหัสอะไหล่</strong></td><?php }?>

                        <?php if ($_REQUEST['sh5'] == 1) {?><td style="border-bottom:none;" width="50%">
                            <center><strong>รายการอะไหล่</strong></center>
                        </td><?php }?>

                        <?php if ($_REQUEST['sh6'] == 1) {?><td style="border-bottom:none;" width="25%">
                            <strong>จำนวนเบิก</strong></td><?php }?>

                    </tr>

                </table>
            </th><?php }?>

            <th width="6%"><strong>รวมจำนวนที่เบิก</strong></th>

            <th width="6%"><strong>รวมมูลค่าอะไหล่</strong></th>

            <?php /*if($_REQUEST['sh7'] == 1){?><th width="6%"><strong>รวมราคาซื้ิอ</strong></th><?php  }*/?>

            <?php if ($_REQUEST['sh8'] == 1) {?><th width="6%"><strong>ผู้เบิก</strong></th><?php }?>


        </tr>

        <?php

$dbservice = "s_service_report2";

$dbservicesub = "s_service_report2sub";

$sql = "SELECT * FROM " . $dbservice . " as st, " . $dbservicesub . " as stp WHERE st.sr_id = stp.sr_id " . $condi . " " . $daterriod . " GROUP BY st.sr_id ORDER BY st.sr_id DESC";

$qu_fr = @mysqli_query($conn, $sql);

$sum = 0;

$totals = 0;

$sumTotalAll = 0;

$moneyTCTota = 0;

while ($row_bill = @mysqli_fetch_array($qu_fr)) {

    //echo $row_bill['cus_source'];
    $foppj_info = get_firstorder2($conn, $row_bill['cus_id'], $row_bill['cus_source']);
    ?>

        <tr>

            <?php if ($_REQUEST['sh9'] == 1) {?><td><?php echo $row_bill['sv_id']; ?></td><?php }?>

            <td><?php echo format_date_th($row_bill['job_open'], 7); ?></td>

            <td><?php echo $foppj_info['fs_id']; ?></td>

            <?php if ($_REQUEST['sh1'] == 1) {?><td>
                <?php echo $foppj_info['cd_name'] . ' / ' . $foppj_info['cd_tel']; ?></td><?php }?>

            <?php
$getProList = get_fopj_pro($conn, $row_bill['cus_id']);
    $numPro = mysqli_num_rows($getProList);
    $rowCal = 1;
    $chkOp = get_checkOP($conn, $row_bill['cus_id'], $row_bill['sr_id']);
    $proOpList = explode(',', $chkOp);
    $proOpRadioList = explode(',', $row_bill['chkprolists']);
    $rowCalLev2 = 0;
    $proOpCodeList = explode(',', $row_bill['codelist']);
    $rowCalNumPro = mysqli_num_rows($getProList);

    while ($rowPro = mysqli_fetch_array($getProList)) {
        //echo $rowPro
        if (in_array($rowCal, $proOpList)) {
            $ReChkOp = (in_array($rowCal, $proOpRadioList)) ? '1' : '0';

            // echo $ReChkOp;
            if ($ReChkOp == '1') {
                ?>
                <td><center><?php echo get_stock_project_code($conn, $rowPro['cpro']); ?></center></td>
                <td style="white-space: nowrap;"><center><?php echo $proOpCodeList[$rowCalLev2]; ?></center></td>
                <td><center><?php echo $rowPro['camount']; ?></center></td>
                <?php

            }
            $rowCalLev2++;
        }
        $rowCal++;
    }
    if ($numPro <= 0) {
        ?>
        <td></td>
        <td></td>
        <td></td>
        <?php
}

    if (empty($foppj_info['fs_id'])) {
        ?>
        <td></td>
        <td></td>
        <td></td>
        <?php
}

    ?>


            <?php /*if ($_REQUEST['sh2'] == 1) { ?><td><?php echo $foppj_info['cd_address']; ?></td><?php  } */?>

            <?php /*if ($_REQUEST['sh3'] == 1) { ?><td><?php echo province_name($conn, $foppj_info['cd_province']); ?>
    </td><?php  } */?>



            <?php if ($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh8'] == 1) {?><td
                style="padding:0;">

                <?php

        $qu_pfirst = @mysqli_query($conn, "SELECT * FROM " . $dbservicesub . " WHERE sr_id = '" . $row_bill['sr_id'] . "'");

        ?>

                <table border="0" width="90%" cellspacing="0" cellpadding="0" class="tbreport">

                    <?php

        $totalamount = 0;

        $totalTA = 0;

        while ($row = @mysqli_fetch_array($qu_pfirst)) {

            if ($row['lists'] != "") {

                $total = $row['prices'] * $row['opens'];

                $totalamount += $row['opens'];

                ?>

                    <tr>

                        <?php if ($_REQUEST['sh4'] == 1) {?><td style="border-bottom:none;" width="25%">
                            <?php echo get_sparpart_id($conn, $row['lists']); ?></td><?php }?>

                        <?php if ($_REQUEST['sh5'] == 1) {?><td align="left" style="border-bottom:none;" width="50%">
                            <?php echo get_sparpart_name($conn, $row['lists']); ?></td><?php }?>

                        <?php if ($_REQUEST['sh6'] == 1) {?><td align="center" style="border-bottom:none;" width="25%">
                            <?php echo number_format($row['opens']); ?></td><?php }?>

                    </tr>

                    <?php

                $sumTotalAll += $total;

                $totalTA += $total;
            }
        }

        $totals += $totalamount

        ?>

                </table>

            </td><?php }?>

            <td style="padding:0;">
                <?php echo $totalamount; ?></td>

            <td style="padding:0;">
                <?php echo number_format($totalTA + $moneyTC, 2); ?></td>

            <?php /*if($_REQUEST['sh7'] == 1){?><td style="padding:0;">
    <?php  echo number_format($totalTA+$moneyTC,2);?></td><?php  }*/?>

            <?php if ($_REQUEST['sh8'] == 1) {?><td style="padding:0;">
                <?php echo getsalename($conn, $row_bill['loc_contact2']); ?></td><?php }?>

        </tr>

        <?php

    $sum += 1;

    $moneyTCTota += $moneyTC;
}

?>

        <tr>

            <td colspan="13" style="text-align:right;">
                <strong>จำนวนใบเบิกวัถุดิบเพื่อผลิตทั้งหมด&nbsp;&nbsp;<?php echo $sum; ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong>
            </td>

        </tr>

        <!--
      <tr>

			  <td colspan="9" style="text-align:right;"> <strong>รวมอะไหล่ที่เบิก&nbsp;&nbsp;<?php echo $totals; ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>
-->

        <!-- <tr>

			  <td colspan="8" style="text-align:right;"> <strong>คิดเป็นมูลค่ารวมทั้งสิ้น&nbsp;&nbsp;<?php echo number_format($sumTotalAll + $moneyTCTota, 2); ?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

	  </tr> -->

    </table>



</body>

</html>