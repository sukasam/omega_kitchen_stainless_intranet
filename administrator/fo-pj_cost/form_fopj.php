<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php     

if($_POST["cprice1"] != ""){$prpro1 = number_format($_POST["cprice1"],2);}
if($_POST["cprice2"] != ""){$prpro2 = number_format($_POST["cprice2"],2);}
if($_POST["cprice3"] != ""){$prpro3 = number_format($_POST["cprice3"],2);}
if($_POST["cprice4"] != ""){$prpro4 = number_format($_POST["cprice4"],2);}
if($_POST["cprice5"] != ""){$prpro5 = number_format($_POST["cprice5"],2);}
if($_POST["cprice6"] != ""){$prpro6 = number_format($_POST["cprice6"],2);}
if($_POST["cprice7"] != ""){$prpro7 = number_format($_POST["cprice7"],2);}


$prspro1 = get_sprice($_POST["cprice1"],$_POST["camount1"]);
$prspro2 = get_sprice($_POST["cprice2"],$_POST["camount2"]);
$prspro3 = get_sprice($_POST["cprice3"],$_POST["camount3"]);
$prspro4 = get_sprice($_POST["cprice4"],$_POST["camount4"]);
$prspro5 = get_sprice($_POST["cprice5"],$_POST["camount5"]);
$prspro6 = get_sprice($_POST["cprice6"],$_POST["camount6"]);
$prspro7 = get_sprice($_POST["cprice7"],$_POST["camount7"]);



/*$sumprice  = preg_replace("/,/","",$prspro1) + preg_replace("/,/","",$prspro2) + preg_replace("/,/","",$prspro3) + preg_replace("/,/","",$prspro4) + preg_replace("/,/","",$prspro5) + preg_replace("/,/","",$prspro6) + preg_replace("/,/","",$prspro7);
$sumpricevat = ($sumprice * 7) / 100;
$sumtotal = $sumprice + $sumpricevat;


<td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> '.$_POST["loc_name"].'<br />
            <br />              <strong>ที่อยู่ :</strong> '.$_POST["loc_address"].'<strong><br />
            <br />
            ขนส่งโดย :</strong> '.$_POST["loc_shopping"].'<br /><br />
			<strong>งานระบบ Hood :</strong> '.$_POST["systemH"].'<br><br>
			<strong>ราคาต้นทุน :</strong> '.$_POST["systemHName"].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>ราคาที่เสนอ :</strong> '.$_POST["systemHTel"].'<br><br>
			<strong>งานระบบ แก็ส :</strong> '.$_POST["systemG"].'<br><br>
			<strong>ราคาต้นทุน :</strong> '.$_POST["systemGName"].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>ราคาที่เสนอ :</strong> '.$_POST["systemGTel"].'<br><br>
			<strong style="font-size: 12px;">รวมต้นทุน งานระบบ : '.number_format($systemHGCost,2).'</strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong style="font-size: 12px;">รวมยอดราคาที่เสนอ : '.number_format($systemGHTotal,2).'</strong><br><br></td>
			*/


//break;

$projectPro = '';
$sumprice = 0;

for($i=0;$i<=count($_POST['cproH']);$i++){
	if($_POST['cproH'][$i] != ""){
		
		$_POST['cpriceH'][$i] = preg_replace("/,/","",$_POST['cpriceH'][$i]);
		$_POST['ccost'][$i] = preg_replace("/,/","",$_POST['ccost'][$i]);
		$_POST['costpros'][$i] = preg_replace("/,/","",$_POST['costpros'][$i]);
		
		$sumprice += $_POST['camountH'][$i]*$_POST['cpriceH'][$i];
		$sumTotalCost += $_POST['ccost'][$i];
		$sumTotalCost2 += $_POST['costpros'][$i];
		
		$projectPro .= '<tr>
		<td style="border:1px solid #000000;padding:5;">'.($i+1).'</td>
		<td style="border:1px solid #000000;padding:5;">'.get_stock_project_code($conn,$_POST['cproH'][$i]).'</td>
		<td style="border:1px solid #000000;text-align:left;padding:5;">'.get_stock_project_name($conn,$_POST['cproH'][$i]).'</td>
		<td style="border:1px solid #000000;padding:5;">'.get_stock_project_size($conn,$_POST['cproH'][$i]).'</td>  
		<td style="border:1px solid #000000;padding:5;width:100px;">'.get_stock_project_sn($conn,$_POST['cproH'][$i]).'</td>
		  <td style="border:1px solid #000000;padding:5;">'.$_POST['camountH'][$i].'</td>
		  <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($_POST['cpriceH'][$i],2).'&nbsp;&nbsp;</td>
		  <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($_POST['ccost'][$i],2).'&nbsp;&nbsp;</td>
		  <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($_POST['costpros'][$i],2).'&nbsp;&nbsp;</td>
		</tr>';
		
	}
}

$sumdiscount = $_POST['discount'];

$sumremainTotal = $sumprice - $sumdiscount;

$sumpricevat = ($sumremainTotal * 7) / 100;
$sumtotal = ($sumprice + $sumpricevat) - $sumdiscount;


$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="../images/form/header-project-order-cost.png" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> '.$_POST["cd_fax"].'<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' </td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า : </strong> '.get_groupcusname($conn,$_POST['cg_type']).'&nbsp;&nbsp;&nbsp;&nbsp;<strong>ประเภทลูกค้า : </strong>'.custype_name($conn,$_POST["ctype"]).'<strong><br />
              <br />
            ประเภทสินค้า :</strong> '.protype_name($conn,$_POST["pro_type"]).'<br />
            <br />
            <strong>เลขที่ใบเสนอราคา / PO.NO. : </strong>'.$_POST["po_id"].'<br />
            <br />            
            <strong>เลขที่ Project order :</strong>'.$_POST["fs_id"].'<strong>&nbsp;&nbsp;&nbsp;&nbsp;วันที่ :</strong> '.format_date($_POST["date_forder"]).'
			<br /><br />    
            <strong>รหัสลูกค้า : </strong>'.$_POST["cusid"].'
			</td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2" style="border:1px solid #000000;margin-top:10px;">
          <tr>
			<td style="vertical-align:top;font-size:10px;padding:5px;">
				<strong style="font-size:12px;">สรุปค่าใช้จ่าย : ฝ่ายควบคุมงาน</strong><br><br>
				<strong>ค่าน้ำมัน :</strong> '.$shipC1.'<br><br>
				<strong>ค่าเดินทาง (อื่นๆ) :</strong> '.$shipC2.'<br><br>
				<strong>ค่าทางด่วน :</strong> '.$shipC3.'<br><br>
				<strong>ค่าเบี้ยเลี้ยง :</strong> '.$shipC4.'<br><br>
				<strong>ค่าที่พัก :</strong> '.$shipC5.'<br><br>
				<strong>ค่าใช้จ่ายเบ็ตเตล็ด :</strong> '.$shipC6.'<br><br>
				<strong>อื่นๆ ระบุ :</strong> '.$shipC7.'<br><br>
				<strong style="font-size: 12px;">รวมค่าใช้จ่าย : '.number_format($shipC8,2).'</strong><br><br>
            </td>
			<td style="vertical-align:top;font-size:10px;padding:5px;">
				<strong style="font-size:12px;">สรุปค่าใช้จ่าย : โรงงาน</strong><br><br>
				<strong>ค่าน้ำมัน :</strong> '.$shipM1.'<br><br>
				<strong>ค่าเดินทาง (อื่นๆ) :</strong> '.$shipM2.'<br><br>
				<strong>ค่าทางด่วน :</strong> '.$shipM3.'<br><br>
				<strong>ค่าเบี้ยเลี้ยง :</strong> '.$shipM4.'<br><br>
				<strong>ค่าขนส่งสินค้า :</strong> '.$shipM5.'<br><br>
				<strong>ค่าโอที : </strong> '.$shipM6.'<br><br>
				<strong>ค่าใช้จ่ายเบ็ตเตล็ด : </strong> '.$shipM7.'<br><br>
				<strong>อื่นๆ ระบุ :</strong> '.$shipM8.'<br><br>
				<strong style="font-size: 12px;">รวมค่าใช้จ่าย : '.number_format($shipM9,2).'</strong><br><br>
            </td>
            <td style="vertical-align:top;font-size:10px;padding:5px;">
				<strong style="font-size:12px;">สรุปค่าใช้จ่าย : ฝ่ายขาย</strong><br><br>
				<strong>ค่าน้ำมัน :</strong> '.$shipL1.'<br><br>
				<strong>ค่าเดินทาง (อื่นๆ) :</strong> '.$shipL2.'<br><br>
				<strong>ค่าทางด่วน :</strong> '.$shipL3.'<br><br>
				<strong>ค่าเบี้ยเลี้ยง :</strong> '.$shipL4.'<br><br>
				<strong>ค่าที่พัก :</strong> '.$shipL5.'<br><br>
				<strong>ค่าใช้จ่ายเบ็ตเตล็ด :</strong> '.$shipL6.'<br><br>
				<strong>อื่นๆ ระบุ :</strong> '.$shipL7.'<br><br>
				<strong style="font-size: 12px;">รวมค่าใช้จ่าย : '.number_format($shipL8,2).'</strong><br><br>
            </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;text-align:center;margin-top:10px;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
	  <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
      <td width="30%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
	  <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
	  <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น/แบรนด์</strong></td>
	  <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคาขาย/หน่วย</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ต้นทุนสินค้า1/หน่วย</strong></td>
	  <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ต้นทุนสินค้า2/หน่วย</strong></td>
    </tr>
    
	'.$projectPro.'    
	
    <tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 14px;"><strong>รวมยอดขาย / ยอดต้นทุน 1 / ยอดต้นทุน 2</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 14px;"><strong>'.number_format($sumprice,2).' บาท</strong></td>
      <td style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 14px;"><strong>'.number_format($sumTotalCost,2).' บาท</strong></td>
      <td style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 14px;"><strong>'.number_format($sumTotalCost2,2).' บาท</strong></td>
    </tr>
	<tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 14px;"><strong>รวมค่าใช้จ่าย ขนส่ง น้ำมัน ที่พักฯ อื่นๆ</strong></td>
      <td colspan="4" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 14px;"><strong>'.number_format($shipC8+$shipM9+$shipL8,2).' บาท</strong></td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 16px;"><strong>รวมกำไรขั้นต้น</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 16px;"><strong>กำไร '.number_format((($sumprice-$sumTotalCost)*100)/$sumprice,2).' %</strong></td>
	  <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 16px;"><strong>'.number_format($sumprice-$sumTotalCost,2).' บาท</strong></td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 16px;"><strong>รวมกำไรสุทธิ</strong></td>
      <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 16px;"><strong>กำไร '.number_format(($sumprice-($shipC8+$shipM9+$shipL8)-$sumTotalCost2)*100/$sumprice,2).' %</strong></td>
	  <td colspan="2" style="text-align:right;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size: 16px;"><strong>'.number_format($sumprice-($shipC8+$shipM9+$shipL8)-$sumTotalCost2,2).' บาท</strong></td>
    </tr>
</table>';
	
?>
	





