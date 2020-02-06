<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php   
	
	
	$finfos = get_fopj($conn,$_POST['cus_id']);
	
	$listShipping = '';
	if($_POST['bill_shipping'] == '1'){
		$listShipping = 'ฝ่ายขนส่งสินค้า-บริษัท ('.$_POST['shipping_dt1'].')';
	}else if($_POST['bill_shipping'] == '2'){
		$listShipping = 'จ้างขนส่งสินค้าภายนอก ('.$_POST['shipping_dt2'].')';
	}else if($_POST['bill_shipping'] == '3'){
		$listShipping = 'ฝ่ายช่าง Omega รับสินค้าเอง (ชื่อช่าง/เบอร์โทร) ('.$_POST['shipping_dt3'].')';
	}else if($_POST['bill_shipping'] == '4'){
		$listShipping = 'อื่นๆ โปรดระบุ ('.$_POST['shipping_dt4'].')';
	}else{
		$listShipping = '';
	}

	$form = '<style>
	.bgheader{
		font-size:10px;
		position:absolute;
		margin-top:100px;
		padding-left:566px;
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
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_shipping_slip.png" width="100%" border="0" />
			<div class="bgheader">'.$_POST['sv_id'].'</div>
		</td>
	  </tr>
	</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="50%" valign="top"><strong>ชื่อลูกค้า :</strong> '.$_POST['cd_names'].' <br />              <strong><br />
            ที่อยู่ :</strong> '.$_POST['cusadd'].'&nbsp;'.province_name($conn,$_POST['cusprovince']).'<strong><br />
            <br />
            โทรศัพท์ :</strong> '.$_POST['custel'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> '.$_POST['cusfax'].'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$_POST['cscont'].' <strong>&nbsp;&nbsp;&nbsp;&nbsp;<br>
            <br>
            เบอร์โทร :</strong> '.$_POST['cstel'].'</td>
			<td width="50%">
			<strong>อ้างอิงใบเบิก : </strong> '.$_POST['srid2'].'&nbsp;&nbsp;<strong>วันที่เบิกสินค้า  :</strong> '.format_date($_POST['job_open']).'&nbsp;&nbsp;<br><br>
			<strong>อ้างอิงเลขที่ FO/PJ  :</strong> '.$_POST['srid'].' &nbsp;&nbsp;
			<strong>วันที่ต้องการสินค้า :</strong> '.format_date($_POST['job_balance']).'<br /><br />
            <strong>ประเภทลูกค้า :</strong> '.getcustom_type($conn,$_POST['sr_ctype2']).'<br /><br />
			<strong>ประเภทสินค้า :</strong> '.protype_name($conn,$_POST['sr_ctype']).' <strong><br><br>
            <strong>ช่องทางการขนส่งสินค้า :</strong> '.$listShipping.' 
            </td>
          </tr>
    </table>
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="53%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>'.$_POST['sloc_name'].'<br /><br />
            <strong>ที่อยู่ : </strong> '.$_POST['sloc_add'].'<br /><br />
            <strong>โทรศัพท์ : </strong> '.$_POST['loc_tel'].' <strong> แฟกซ์ : </strong> '.$_POST['loc_fax'].'<br /><br />
			<strong>ชื่อผู้ติดต่อ : </strong> '.$_POST['loc_cname'].' <strong> เบอร์โทร :</strong> '.$_POST['loc_ctel'].'<br /><br />
		</td>
        <td width="47%" valign="top"><strong>รายละเอียดเพิ่มเติมใบจัดสินค้า</strong><br><br>'.$_POST['detail_recom'].'</td>
      </tr>
</table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class=""tb2>
		<tr>
		<td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
		<td width="35%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
		<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น / แบรนด์</strong></td>
		<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>สต็อคสินค้า</strong></td>
		<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
		</tr>';

		$sumlist = 0;
		foreach($_POST['cpro'] as $a => $v){
			if($v != ''){
				$form .= '<tr>
					<td style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;">'.($a+1).'</td>
					<td style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;">'.get_stock_order_code($conn,$v).'</td>
					<td style="border:1px solid #000000;font-size:12px;text-align:left;padding:5;vertical-align: middle;">'.get_stock_order_name($conn,$v).'</td>
					<td style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;">'.get_stock_order_sn($conn,$v).'</td>
					<td style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;">'.get_stock_order_size($conn,$v).'</td>
					<td style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;">'.get_stock_order_stock($conn,$v).'</td>
					<td style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;">'.$_POST['camount'][$a].'</td>
					</tr>';
					$sumlist++;
			}
		}
        $form .= '<tr >
			<td colspan="6" style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;"><center><strong>รวมจำนวนสินค้าที่จัดส่ง (รายการ)</strong></center></td>
			<td colspan="1" style="border:1px solid #000000;font-size:12px;padding:5;text-align:center;vertical-align: middle;" align="center"><strong>'.$sumlist.'</strong></td>
		</tr>

    </table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
      <tr>
        
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$_POST['loc_contact2'].'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้เบิกสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date2']).'</td>
              </tr>
            </table>
        </td>	
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$_POST['cs_sell'].'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จัดสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['sell_date']).'</td>
              </tr>
            </table>
        </td>
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$_POST['loc_contact3'].'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ / การจัดสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date3']).'</td>
              </tr>
            </table>
        </td>

      </tr>
    </table>';
?>


	

	