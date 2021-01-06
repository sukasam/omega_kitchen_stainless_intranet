<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$finfos = get_firstorder2($conn, $_POST['cus_id'], $_POST['cus_source']);

$chk = get_fixlist($_POST['ckf_list']);

$tecinfos = get_technician($conn, $_POST['loc_contact']);

foreach ($chk as $vals) {
    $sfix .= '
		  <tr>
			<td ><img src="../images/aroow_ch.png" width="10" height="10" border="0" alt="" />&nbsp;' . get_fixname($conn, $vals) . '</td>
		  </tr>
		';
}

$dataApprove = '';

if ($_POST['loc_contact3'] != '0' && $_POST['loc_contact3'] != '') {
    if ($_POST['loc_date3'] != '0000-00-00' && $_POST['loc_date3'] != '') {
        $dataApprove = format_date($_POST['loc_date3']);
    } else {
        $dataApprove = '';
    }
} else {
    $dataApprove = '';
}

$hSaleName = getsalename($conn, $_POST['loc_contact3']);
$hSaleSignature = '<img src="../../upload/user/signature/' . get_sale_signature($conn, $_POST['loc_contact3']) . '" height="50" border="0" />';

$form = '<style>
	.bgheader{
		font-size:10px;
		position:absolute;
		margin-top:100px;
		padding-left:586px;
	}
	table tr td{
		vertical-align:top;
		padding:5px;
	}
	.tb1{
		margin-top:5px;
	}
	.tb1 tr td{
		border:1px solid #000000;
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;
	}
	.tb2,.tb3{
		border:1px solid #000000;
		margin-top:10px;
	}
	.tb2 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;
		border: 1px solid;
	}
	.tb2 tr th{

	}

	.tb3 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;
	}
	.tb3 img{
		vertical-align:bottom;
	}

	.tb4{
		margin-top:5px;
	}

	.ccontact{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
	}
	.ccontact tr td{

	}

	.cdetail{
		border: 1px solid #000000;
		padding:5px;
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
  	}
	.cdetail ul li{
		list-style:none;

	}
	.cdetail2 ul li{
		list-style:none;
		float:left;
	}
	.clear{
		margin:0;
		padding:0;
		clear:both;
	}

	.tblf5{
		border: 1px solid #000000;
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
	}

	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_service_report2.png" width="100%" border="0" />
			<div class="bgheader">' . $_POST['sv_id'] . '</div>
		</td>
	  </tr>
	</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="57%" valign="top"><strong>ชื่อลูกค้า :</strong> ' . $finfos['cd_name'] . ' <br />              <strong><br />
            ที่อยู่ :</strong> ' . $finfos['cd_address'] . '&nbsp;' . province_name($conn, $finfos['cd_province']) . '<strong><br />
            <br />
            โทรศัพท์ :</strong> ' . $finfos['cd_tel'] . '&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> ' . $finfos['cd_fax'] . '<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> ' . $finfos['c_contact'] . ' <strong>&nbsp;&nbsp;&nbsp;&nbsp;<br>
            <br>
            เบอร์โทร :</strong> ' . $finfos['c_tel'] . '</td>
            <td width="43%"><strong>ประเภทบริการลูกค้า :</strong> ' . get_servicename($conn, $_POST['sr_ctype']) . ' <strong><br>
            <br>
			ประเภทลูกค้า :</strong> ' . custype_name($conn, $_POST['sr_ctype2']) . '  &nbsp;&nbsp;
			<strong>ใบสั่งผลิต :</strong> ' . $_POST['search_op'] . ' </strong>
			<br />
              <br />
			</strong><strong>วันที่เบิกอะไหล่  :</strong> ' . format_date($_POST['job_open']) . ' <strong>&nbsp;&nbsp;

			';

$poFoID = '';
if ($_POST['search_po'] != "") {
    $poFoID = '<strong>เลขที่ </strong> ' . $_POST['search_po'];
} else {
    $poFoID = '<strong>เลขที่ </strong> ' . $_POST['search_fo'];
}

$form .= $poFoID . '<br />
            <br />
            กำหนดคืนอะไหล่ :</strong> ' . format_date($_POST['job_balance']) . ' &nbsp;<strong>วันที่คืนอะไหล่ :</strong> ' . format_date($_POST['sr_stime']) . '<br /><br />
            <strong>อ้างอิงใบยืม :</strong> ' . $_POST['srid2'] . '&nbsp;&nbsp;<strong>วันที่ :</strong> ' . format_date($_POST['ref_date']) . '</td>
          </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
		<td width="53%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>' . $finfos['loc_name'] . '<br /><br />
		<div><strong>ค่าใช้จ่ายอื่นๆ : รวมยอดทั้งสิ้น :</strong> ' . number_format($_POST['costSum']) . ' <strong>บาท</strong></div><br />
		<div><strong>ค่าแรงช่าง ตับ/พับ/ประกอบ/ขัด :</strong> ' . number_format($_POST['costCut']) . ' บาท&nbsp;&nbsp;<strong>ค่าวัตถุดิบสูญเสีย :</strong> ' . number_format($_POST['costLost']) . ' บาท</div><br />
		<div><strong>ค่าน้ำ/ค่าไฟ :</strong> ' . number_format($_POST['costElec']) . ' บาท&nbsp;&nbsp;<strong>ค่าล่วงเวลา :</strong> ' . number_format($_POST['costOT']) . ' บาท&nbsp;&nbsp;<strong>ค่าเลเซอร์ :</strong> ' . number_format($_POST['costLaser']) . ' บาท</div><br />
		<div><strong>รวม Factory Cost :</strong> ' . number_format($costFactory) . ' บาท<br><br><strong>Gross Profit (GP) :</strong> ' . $_POST['costGP'] . '% = ' . number_format($costGPSum) . ' <strong>บาท</strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>ค่า Overhead :</strong> ' . $_POST['costOv'] . '% = ' . number_format($costOvSum) . ' <strong>บาท</strong></div>
           </td>
        <td width="47%" valign="top"><strong>รายละเอียดการเปลี่ยนอะไหล่</strong><br><br>' . $_POST['detail_recom'] . '</td>
      </tr>
</table>
	<div class="ccontact" style="margin-top:10px;font-weight: bold;">รายละเอียดสินค้าสั่งผลิต</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="4%" align="center"><strong>ลำดับ</strong></td>
        <td width="8%" align="center"><strong>รหัสสินค้า</strong></td>
        <td width="35%"><strong>รายการ</strong></td>
		<td width="9%" align="center"><strong>รุ่น/แบรนด์</strong></td>
		<td width="9%" align="center"><strong>ขนาด</strong></td>
		<td width="9%" align="center"><strong>จำนวน</strong></td>
        <td width="9%" align="center"><strong>Code</strong></td>
		</tr>';

$getProList2 = get_fopj_pro($conn, $_POST['cus_id']);
$rowCal = 1;
$chkOp = get_checkOP($conn, $_POST['cus_id'], $id);
$proOpList = explode(',', $chkOp);
$rowCalLev2 = 0;
$proOpCodeList = explode(',', $_POST['codelist']);
$rowCalNumPro = mysqli_num_rows($getProList);

$chkPOItem = chkPOItemSelect($conn, $_POST['cus_id'], $_POST['search_po']);

while ($rowPro = mysqli_fetch_array($getProList2)) {
    if (in_array($rowCal, $proOpList)) {
        if ($rowCal == $_POST['chkprolists']) {
            $form .= '<tr>
            <td width="4%" align="center">' . ($rowCalLev2 + 1) . '</td>
            <td width="8%" align="center">' . get_stock_project_code($conn, $rowPro['cpro']) . '</td>
            <td width="35%">' . get_stock_project_name($conn, $rowPro['cpro']) . '</td>
            <td width="9%">' . get_stock_project_sn($conn, $rowPro['cpro']) . '</td>
            <td width="9%">' . get_stock_project_size($conn, $rowPro['cpro']) . '</td>
            <td width="9%" align="center">' . $rowPro['camount'] . '</td>
            <td width="9%" align="center">' . $proOpCodeList[$rowCalLev2] . '</td>
			</tr>';
        }
        $rowCalLev2++;
    }
    $rowCal++;
}
$form .= '</table>
<div class="ccontact" style="margin-top:10px;font-weight: bold;">รายละเอียดการเบิกอะไหล่เพื่อผลิต</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="4%" align="center"><strong>ลำดับ</strong></td>
        <td width="8%" align="center"><strong>รหัสสินค้า</strong></td>
        <td width="35%"><strong>รายการ</strong></td>
		<td width="9%" align="center"><strong>สถานที่จัดเก็บ</strong></td>
		<td width="9%" align="center"><strong>หน่วยนับ</strong></td>
		<td width="9%" align="center"><strong>คงเหลือ Stock</strong></td>
        <td width="9%" align="center"><strong>ราคา/หน่วย</strong></td>
        <td width="9%" align="center"><strong>จำนวนเบิก</strong></td>
        </tr>';

$sumtotal = 0;
$total = 0;

foreach ($codes as $a => $b) {
    //if($units[$a] != 0){$bunits = $units[$a];$units[$a] = number_format($units[$a]);}
    if ($prices[$a] != 0) {
        $bprices = $prices[$a];
        $prices[$a] = number_format($prices[$a], 2);
    }
    if ($amounts[$a] != 0) {
        $amounts[$a] = number_format($amounts[$a], 2);
    }
    if ($opens[$a] != 0) {
        $bopens = $opens[$a];
        $opens[$a] = number_format($opens[$a], 2);
    }
    if ($remains[$a] != 0) {
        $remains[$a] = number_format($remains[$a], 2);
    }
    if ($codes[$a] != "" || $lists[$a] != "") {
        $sumlist = $sumlist + 1;
    }

    $sumtotal = $bopens * $bprices;

    $form .= '<tr >
			<td><center>' . ($a + 1) . '</center></td>
			<td>' . $codes[$a] . '</td>
			<td>' . get_sparpart_name($conn, $lists[$a]) . '</td>
			<td align="center">' . get_nameStock($conn, $lists[$a]) . '</td>
			<td align="center">' . $units[$a] . '</td>
			<td align="right">' . getStockSpar($conn, $lists[$a]) . '</td>
			<td align="right">' . $prices[$a] . '</td>
			<td align="right">' . $opens[$a] . '</td>
			</tr>';

    if ($codes[$a] != "" || $lists[$a] != "") {
        $total += $sumtotal;
    }
}
$form .= '<tr >
			<td colspan="5"><center><strong>รวมจำนวนที่เบิก</strong></center></td>
			<td colspan="3" align="right"><strong>' . $sumlist . '&nbsp;&nbsp;รายการ</strong></td>
		</tr>

        <tr >
          <td colspan="5"><center><strong>ใช้จ่ายรวม (รวมมูลค่าอะไหล่ที่เบิก)</strong></center></td>
          <td colspan="3" align="right"><strong>' . number_format($total, 2) . '&nbsp;&nbsp;บาท</strong></td>
          </tr>
    </table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
      <tr>

		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . getsalename($conn, $_POST['loc_contact2']) . '</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างเบิก</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>' . format_date($_POST['loc_date2']) . '</td>
              </tr>
            </table>
        </td>

		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . getsalename($conn, $_POST['cs_sell']) . '</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จ่ายอะไหล่</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>' . format_date($_POST['sell_date']) . '</td>
              </tr>
            </table>
        </td>

		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >' . $hSaleSignature . '</strong></td>
		  </tr>
		  <tr>
			<td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>' . $hSaleName . '</strong></td>
		  </tr>
		  <tr>
			<td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ</strong></td>
		  </tr>
		  <tr>
			<td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ ' . $dataApprove . '</strong></td>
		  </tr>
            </table>
        </td>

      </tr>
    </table>';
?>