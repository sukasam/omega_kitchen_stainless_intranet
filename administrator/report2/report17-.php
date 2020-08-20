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
$type_name = $_POST['type_name'];
$source_by = $_POST['source_by'];

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

$orderBy = '';
if ($source_by == 2) {
    $orderBy = 'st.sr_id';
} else if ($source_by == 3) {
    $orderBy = 'st.sr_id';
} else if ($source_by == 4) {
    $orderBy = 'st.sr_id';
} else {
    $orderBy = 'st.sr_id';
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

                        <?php if ($_REQUEST['sh4'] == 1) {?><td style="border-bottom:none;white-space: nowrap;" width="20%">
                            <strong>รหัสอะไหล่</strong></td><?php }?>

                        <?php if ($_REQUEST['sh5'] == 1) {?><td style="border-bottom:none;" width="50%">
                            <center><strong>รายการอะไหล่</strong></center>
                        </td><?php }?>

                        <?php if ($_REQUEST['sh6'] == 1) {?><td style="border-bottom:none;" width="15%">
                            <strong>จำนวนเบิก</strong></td><?php }?>

                            <td style="border-bottom:none;white-space: nowrap;" width="15%">
                            <strong>รวมยอดเงิน</strong></td>

                    </tr>

                </table>
            </th><?php }?>



            <th width="6%"><strong>รวมมูลค่าอะไหล่</strong></th>

            <?php /*if($_REQUEST['sh7'] == 1){?><th width="6%"><strong>รวมราคาซื้ิอ</strong></th><?php  }*/?>

            <?php if ($_REQUEST['sh8'] == 1) {?><th width="6%"><strong>ผู้เบิก</strong></th><?php }?>


        </tr>

        <?php

$dbservice = "s_service_report2";

$dbservicesub = "s_service_report2sub";

$sql = "SELECT * FROM " . $dbservice . " as st, " . $dbservicesub . " as stp WHERE st.sr_id = stp.sr_id " . $condi . " " . $daterriod . " GROUP BY st.sr_id ORDER BY " . $orderBy . " DESC";

$qu_fr = @mysqli_query($conn, $sql);

$sum = 0;

$totals = 0;

$sumTotalAll = 0;

$moneyTCTota = 0;

$svList = array();
$svListPro = array();

while ($row_bill = @mysqli_fetch_array($qu_fr, MYSQLI_ASSOC)) {

    $foppj_info = get_firstorder2($conn, $row_bill['cus_id'], $row_bill['cus_source']);

    $getProList = get_fopj_pro($conn, $row_bill['cus_id']);
    $numPro = mysqli_num_rows($getProList);
    $rowCal = 1;
    $chkOp = get_checkOP($conn, $row_bill['cus_id'], $row_bill['sr_id']);
    $proOpList = explode(',', $chkOp);
    $proOpRadioList = explode(',', $row_bill['chkprolists']);
    $rowCalLev2 = 0;
    $proOpCodeList = explode(',', $row_bill['codelist']);
    $rowCalNumPro = mysqli_num_rows($getProList);

    $ListPro = array();
    while ($rowPro = mysqli_fetch_array($getProList)) {
        //echo $rowPro
        if (in_array($rowCal, $proOpList)) {
            $ReChkOp = (in_array($rowCal, $proOpRadioList)) ? '1' : '0';

            // echo $ReChkOp;
            if ($ReChkOp == '1') {
                array_push($ListPro, array("stock_pro" => get_stock_project_code($conn, $rowPro['cpro']), "code_pro" => $proOpCodeList[$rowCalLev2], "amount_pro" => $rowPro['camount']));
                ?>
                <!-- <td><center><?php echo get_stock_project_code($conn, $rowPro['cpro']); ?></center></td>
                <td style="white-space: nowrap;"><center><?php echo $proOpCodeList[$rowCalLev2]; ?></center></td>
                <td><center><?php echo $rowPro['camount']; ?></center></td> -->
                <?php

            }
            $rowCalLev2++;
        }
        $rowCal++;
    }

    $qu_pfirst = @mysqli_query($conn, "SELECT * FROM " . $dbservicesub . " WHERE sr_id = '" . $row_bill['sr_id'] . "'");

    $ListSpare = array();

    $totalamount = 0;
    $totalTA = 0;
    $totalSumSpare = 0;

    while ($row = @mysqli_fetch_array($qu_pfirst)) {
        if ($row['lists'] != "") {
            $total = $row['prices'] * $row['opens'];
            $totalamount += $row['opens'];
            $totalSumSpare += get_spare_unit_price($conn, $row['lists']) * $row['opens'];

            $sumTotalAll += $total;
            $totalTA += $total;

            array_push($ListSpare, array(get_sparpart_id($conn, $row['lists']), get_sparpart_name($conn, $row['lists']), $row['opens'], get_spare_unit_price($conn, $row['lists']) * $row['opens']));
        }
    }

    $svInfo = array("svInfo" => $row_bill);
    $foInfo = array("foInfo" => $foppj_info);
    $proinfo = array("proInfo" => $ListPro);
    $spareinfo = array("spareInfo" => $ListSpare);

    array_push($svList, array_merge($svInfo, $foInfo, $proinfo, $spareinfo));

}

// $keysSour = array_column($svList, 'cd_name');
// array_multisort($keysSour, SORT_ASC, $newSour);

echo "<pre>";
print_r($svList);
echo "</pre>";

foreach ($svList as $key => $value) {
    //echo $value['svInfo']['sv_id'];
    //array_search("red", $value);
    ?>
    <tr>
    <td><?php echo $value['svInfo']['sv_id']; ?></td>
    <td><?php echo format_date_th($value['svInfo']['job_open'], 7); ?></td>
    <td><?php echo $value['svInfo']['sv_id']; ?></td>
    <td><?php echo $value['foInfo']['cd_name'] . ' / ' . $value['foInfo']['cd_tel']; ?></td>
    <td><?php echo $value['proInfo'][0]['stock_pro']; ?></td>
    <td><?php echo $value['proInfo'][0]['code_pro']; ?></td>
    <td><?php echo $value['proInfo'][0]['amount_pro']; ?></td>
    <td>
        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="tbreport">
        <?php
foreach ($value['spareInfo'] as $key2 => $value2) {
        ?>
         <tr>
            <td style="border-bottom:none;" width="20%"><?php echo $value2[0]; ?></td>
            <td style="border-bottom:none;" width="50%"><?php echo $value2[1]; ?></td>
            <td style="border-bottom:none;" width="15%"><?php echo $value2[2]; ?></td>
            <td style="border-bottom:none;" width="15%"><?php echo number_format($value2[3], 2); ?></td>
        </tr>
        <?php
}
    ?>
        </table>
    </td>
    <td></td>
    <td><?php echo getsalename($conn, $value['svInfo']['sr_id']); ?></td>
    </tr>
    <?php
}
?>

        <tr>

            <td colspan="13" style="text-align:right;">
                <strong>จำนวนใบเบิกทั้งหมด&nbsp;&nbsp;<?php echo $sum; ?>&nbsp;&nbsp;ใบ&nbsp;&nbsp;</strong>
            </td>

        </tr>



        <!--
      <tr>

			  <td colspan="9" style="text-align:right;"> <strong>รวมอะไหล่ที่เบิก&nbsp;&nbsp;<?php echo $totals; ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>
-->

     <tr>

			  <td colspan="13" style="text-align:right;"> <strong>รวมยอดมูลค่าอะไหล่ทั้งสิ้น&nbsp;&nbsp;<?php echo number_format($sumTotalAll + $moneyTCTota, 2); ?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

	  </tr>

    </table>



</body>

</html>