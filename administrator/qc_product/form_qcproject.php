<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$fopj_info = get_fopj($conn, $_POST['cus_id']);
$proList = get_fopj_pro($conn, $_POST['cus_id']);
$order_pro_info = get_qc_product($conn, $id);

if ($order_pro_info['chkpass1'] === '1') {$chkList1 = 'aroow_ch.png';
    $chkList11 = 'aroow_nch.png';} else { $chkList1 = 'aroow_nch.png';
    $chkList11 = 'aroow_ch.png';}
if ($order_pro_info['chkpass2'] === '1') {$chkList2 = 'aroow_ch.png';
    $chkList12 = 'aroow_nch.png';} else { $chkList2 = 'aroow_nch.png';
    $chkList12 = 'aroow_ch.png';}
if ($order_pro_info['chkpass3'] === '1') {$chkList3 = 'aroow_ch.png';
    $chkList13 = 'aroow_nch.png';} else { $chkList3 = 'aroow_nch.png';
    $chkList13 = 'aroow_ch.png';}
if ($order_pro_info['chkpass4'] === '1') {$chkList4 = 'aroow_ch.png';
    $chkList14 = 'aroow_nch.png';} else { $chkList4 = 'aroow_nch.png';
    $chkList14 = 'aroow_ch.png';}
if ($order_pro_info['chkpass5'] === '1') {$chkList5 = 'aroow_ch.png';
    $chkList15 = 'aroow_nch.png';} else { $chkList5 = 'aroow_nch.png';
    $chkList15 = 'aroow_ch.png';}
if ($order_pro_info['chkpass6'] === '1') {$chkList6 = 'aroow_ch.png';
    $chkList16 = 'aroow_nch.png';} else { $chkList6 = 'aroow_nch.png';
    $chkList16 = 'aroow_ch.png';}

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
		padding-left:565px;
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
		margin-top:5px;
	}
	.tb2 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;
		border: 1px solid;
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
	.hide{
		display:none;
	}
	.minHeight{
		min-height:250px !important;
	}

	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_qc_product.png" width="100%" border="0" />
			<div class="bgheader">' . $_POST['sv_id'] . '</div>
		</td>
	  </tr>
	</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="53%" valign="top"><strong>ชื่อลูกค้า :</strong> ' . $fopj_info['cd_name'] . ' <br />              <strong><br />
            ที่อยู่ :</strong> ' . $fopj_info['cd_address'] . '&nbsp;' . province_name($conn, $fopj_info['cd_province']) . '<strong><br />
            <br />
            โทรศัพท์ :</strong> ' . $fopj_info['cd_tel'] . '&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> ' . $fopj_info['cd_fax'] . '<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> ' . $fopj_info['c_contact'] . ' <strong>&nbsp;&nbsp;&nbsp;&nbsp;<br>
            <br>
            เบอร์โทร :</strong> ' . $fopj_info['c_tel'] . '</td>
            <td width="47%"><strong>กลุ่มลูกค้า :</strong> ' . get_groupcusname($conn, $_POST['sr_ctype']) . ' <strong><br>
            <br>
            ประเภทลูกค้า :</strong> ' . custype_name($conn, $_POST['sr_ctype2']) . ' <strong><br />
              <br />
            </strong>';

if ($_POST['search_fo'] != "") {
    $poFoID = '<strong>เลขที่ FO/PJ</strong> (' . $_POST['search_fo'] . ')';
} else {
    $poFoID = '<strong>เลขที่ FO/PJ</strong>';
}

if (empty($_POST['detail_recom'])) {
    $_POST['detail_recom'] = "<br><br><br>";
}

$form .= $poFoID . ' &nbsp;&nbsp; <strong>เลขที่ใบสั่งผลิต :</strong> ' . $_POST['sv_id2'] . '<br />
			<br />
			<strong>วันที่สั่งผลิตสินค้า  :</strong> ' . format_date($_POST['job_open']) . ' &nbsp;&nbsp;
			<strong>กำหนดผลิตเสร็จ :</strong> ' . format_date($_POST['job_balance']) . '<br /><br />
			<strong>กำหนดส่งสินค้า :</strong> ' . format_date($_POST['sr_stime']) . ' &nbsp;&nbsp; <strong>พนักงานขาย :</strong> ' . getsalename($conn, $fopj_info['cs_sell']) . '
            </td>
          </tr>
    </table>
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
		<td width="53%" style="padding:5;"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>' . $fopj_info['loc_name'] . '
		<br><br>
		<div class="hide">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide">
			<tr>
				<td style="border: 0px;padding:5;width: 50%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;"><strong>กว้าง :</strong></td>
							<td style="border: 0px;padding:5;">' . $_POST['chkpro1'] . '</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList1 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ผ่าน</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList11 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ไม่ผ่าน</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;width: 50%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;"><strong>ลึก :</strong></td>
							<td style="border: 0px;padding:5;">' . $_POST['chkpro2'] . '</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList2 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ผ่าน</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList12 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ไม่ผ่าน</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;width: 50%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;"><strong>สูง :</strong></td>
							<td style="border: 0px;padding:5;">' . $_POST['chkpro3'] . '</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList3 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ผ่าน</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList13 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ไม่ผ่าน</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;width: 50%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;"><strong>การ์ด :</strong></td>
							<td style="border: 0px;padding:5;">' . $_POST['chkpro4'] . '</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList4 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ผ่าน</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList14 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ไม่ผ่าน</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;width: 50%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;"><strong>รอยเชื่อม :</strong></td>
							<td style="border: 0px;padding:5;">' . $_POST['chkpro5'] . '</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList5 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ผ่าน</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList15 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ไม่ผ่าน</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;width: 50%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;"><strong>การใช้งาน :</strong></td>
							<td style="border: 0px;padding:5;">' . $_POST['chkpro6'] . '</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList6 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ผ่าน</td>
						</tr>
					</table>
				</td>
				<td style="border: 0px;padding:5;width: 25%;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border: 0px;padding:5;">&nbsp;&nbsp;<img src="../images/' . $chkList16 . '" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;</td>
							<td style="border: 0px;padding:5;">ไม่ผ่าน</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</div>
           </td>
        <td width="47%" valign="top"><strong>รายละเอียดเพิ่มเติม</strong><br><br>' . $_POST['detail_recom'] . '</td>
      </tr>
</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
		<td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
		<td width="27%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
		<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น / แบรนด์</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ตรวจสอบ</strong></td>
	</tr>';

$rowCal = 1;
$rowCalIn = 1;
$rowProList = 0;
$rowProAmount = 0;
$pro_list2 = explode(',', $_POST['pro_list']);

$checklistpro = explode(',', $listChkPro);

while ($rowPro = mysqli_fetch_array($proList)) {

    if (in_array($rowCal, $pro_list2)) {

        $chkName = '';
        if ($checklistpro[$rowCalIn - 1] == 1) {
            $chkName = 'ผ่าน';
        } else {
            $chkName = 'ไม่ผ่าน';
        }

        $form .= '<tr>
					<td style="border:1px solid #000000;padding:5;text-align:center;">' . $rowCalIn . '</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">' . get_stock_project_code($conn, $rowPro['cpro']) . '</td>
					<td style="border:1px solid #000000;text-align:left;padding:5;">' . get_stock_project_name($conn, $rowPro['cpro']) . '</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">' . get_stock_project_sn($conn, $rowPro['cpro']) . '</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">' . get_stock_project_size($conn, $rowPro['cpro']) . '</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">' . $rowPro['camount'] . '</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;"><strong>' . $chkName . '</strong></td>
				</tr>';
        $rowProList += 1;
        $rowCalIn++;
        $rowProAmount += $rowPro['camount'];
    }

    $rowCal++;
}

$form .= '<tr >
			<td colspan="5"><center><strong>รวมจำนวนที่สั่งผลิต ( รายการ )</strong></center></td>
			<td colspan="1" align="center"><strong>' . $rowProList . '</strong></td>
			<td colspan="1" align="center"><strong></strong></td>
		</tr>

        <tr >
          <td colspan="5"><center><strong>รวมจำนวนที่สั่งผลิต ( ชิ้น )</strong></center></td>
		  <td colspan="1" align="center"><strong>' . $rowProAmount . '</strong></td>
		  <td colspan="1" align="center"><strong></strong></td>
          </tr>
    </table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
      <tr>

		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . $_POST['loc_contact2'] . '<br></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>QC / ผู้ตรวจสอบสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>' . format_date($_POST['loc_date2']) . '</td>
              </tr>
            </table>
		</td>

		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . $_POST['cs_sell'] . '<br></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับสินค้าสำเร็จรูป</strong></td>
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
				<td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติ / หัวหน้าฝ่ายผลิต</strong></td>
			</tr>
			<tr>
				<td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ ' . $dataApprove . '</strong></td>
			</tr>
			</table>
        </td>

      </tr>
	</table>
	<br><br><br>
  ';
if ($order_pro_info['images1'] != '') {
    $form .= '<div style="font-family:Verdana, Geneva, sans-serif;text-align:center;font-size:14px;font-weight: bold;"><u>รูปภาพประกอบ</u>
    <br><br>
    <img src="../../upload/qc_product/images/' . $order_pro_info['images1'] . '" style="max-height: 470px;"><br><br>';

    if ($order_pro_info['images2'] != '') {
        $form .= '<img src="../../upload/qc_product/images/' . $order_pro_info['images2'] . '" style="max-height: 470px;"><br><br>';
    }

    if ($order_pro_info['images3'] != '') {
        $form .= '<img src="../../upload/qc_product/images/' . $order_pro_info['images3'] . '" style="max-height: 470px;"><br><br>';
    }

    $form .= '</div>';
}
?>




