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
$sumtotal = $sumprice + $sumpricevat;*/


//break;

if($_POST["shipS1"] == 1){$shipS1 = 'aroow_ch.png';}else{$shipS1 = 'aroow_nch.png';}
if($_POST["shipS2"] == 1){$shipS2 = 'aroow_ch.png';}else{$shipS2 = 'aroow_nch.png';}
if($_POST["shipS3"] == 1){$shipS3 = 'aroow_ch.png';}else{$shipS3 = 'aroow_nch.png';}
if($_POST["shipS4"] == 1){$shipS4 = 'aroow_ch.png';}else{$shipS4 = 'aroow_nch.png';}
if($_POST["shipS5"] == 1){$shipS5 = 'aroow_ch.png';}else{$shipS5 = 'aroow_nch.png';}

$projectPro = '';
$sumprice = 0;
$sumCost = 0;

for($i=0;$i<=count($_POST['cpro']);$i++){
	if($_POST['cpro'][$i] != ""){
		
		$_POST['cprice'][$i] = preg_replace("/,/","",$_POST['cprice'][$i]);
		
		$sumprice += $_POST['camount'][$i]*$_POST['cprice'][$i];
		$sumpriceNot += $_POST['cprice'][$i];
		$sumCost += $_POST['ccost'][$i];
		
		$projectPro .= '<tr>
		<td style="border:1px solid #000000;padding:5;">'.($i+1).'</td>
		<td style="border:1px solid #000000;padding:5;">'.$_POST["ccode"][$i].'</td>
		<td style="border:1px solid #000000;padding:5;">'.get_projectcodepro($conn,$_POST['cpro'][$i]).'</td>
		<td style="border:1px solid #000000;text-align:left;padding:5;">'.get_projectname($conn,$_POST['cpro'][$i]).'</td>
		  <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["cpod"][$i].'</td>
		  <td style="border:1px solid #000000;padding:5;">'.get_projectsize($conn,$_POST['cpro'][$i]).'</td>
		  <td style="border:1px solid #000000;padding:5;">'.$_POST['camount'][$i].'</td>
		  <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($_POST['ccost'][$i]).'&nbsp;&nbsp;</td>
		  <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($_POST['cprice'][$i]).'&nbsp;&nbsp;</td>
		  <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($_POST['camount'][$i] * $_POST['cprice'][$i]).'&nbsp;&nbsp;</td>
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
    <td style="padding-bottom:5px;"><img src="../images/form/header-project-order.png" width="100%" border="0" /></td>
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
            <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> '.$_POST["loc_name"].'<br />
            <br />              <strong>ที่อยู่ :</strong> '.$_POST["loc_address"].'<strong><br />
            <br />
            ขนส่งโดย :</strong> '.$_POST["loc_shopping"].'<br /><br />
			<strong>งานระบบ Hood :</strong> '.$_POST["systemH"].'<br><br>
			<strong>ชื่อผู้ติดต่อ :</strong> '.$_POST["systemHName"].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> '.$_POST["systemHTel"].'<br><br>
			<strong>งานระบบ แก็ส :</strong> '.$_POST["systemG"].'<br><br>
			<strong>ชื่อผู้ติดต่อ :</strong> '.$_POST["systemGName"].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> '.$_POST["systemGTel"].'<br><br></td>
            <td style="vertical-align:top;font-size:10px;padding:5px;">
				<strong>การติดตั้ง / การขนส่ง</strong><br><br>
				<strong><img src="../images/'.$shipS1.'" width="10"  border="0" alt="" />&nbsp;&nbsp;ช่าง OKS ขนส่งสินค้า :</strong> '.$_POST['shipL1'].'<br><br>
				<strong><img src="../images/'.$shipS2.'" width="10"  border="0" alt="" />&nbsp;&nbsp;ช่าง OKS ติดตั้ง :</strong> '.$_POST['shipL2'].'<br><br>
				<strong><img src="../images/'.$shipS3.'" width="10"  border="0" alt="" />&nbsp;&nbsp;OMEGA ขนส่งสินค้า :</strong> '.$_POST['shipL3'].'<br><br>
				<strong><img src="../images/'.$shipS4.'" width="10"  border="0" alt="" />&nbsp;&nbsp;ช่าง OMEGA ติดตั้ง :</strong> '.$_POST['shipL4'].'<br><br>
				<strong><img src="../images/'.$shipS5.'" width="10"  border="0" alt="" />&nbsp;&nbsp;อื่นๆ ระบุ :</strong> '.$_POST['shipL5'].'
            </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;text-align:center;margin-top:10px;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
	  <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
	  <td width="8%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
      <td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น/แบรนด์</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
	  <td width="14%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ต้นทุนสินค้า 1</strong></td>
      <td width="14%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / หน่วย</strong></td>
	  <td width="14%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคารวม (บาท)</strong></td>
    </tr>
    
	'.$projectPro.'    
	
    <tr>
      <td colspan="6" rowspan="7" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;"><strong>หมายเหตุ :</strong> '.nl2br($_POST['ccomment']).'<br>
      </td>
      <td style="border:1px solid #000000;padding:5;font-size:13px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumpriceNot,2).'</strong>&nbsp;&nbsp;</td>
	  <td style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumprice,2).'</strong>&nbsp;&nbsp;</td>
	  <td style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumCost,2).'</strong>&nbsp;&nbsp;</td>
    </tr>
	<tr>
      <td style="border:1px solid #000000;padding:5;font-size:13px;"><strong>ส่วนลด</strong></td>
      <td colspan="3"  style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumdiscount,2).'</strong>&nbsp;&nbsp;</td>
    </tr>
	<tr>
      <td style="border:1px solid #000000;padding:5;font-size:13px;"><strong>คงเหลือยอดเงิน</strong></td>
      <td colspan="3" style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumremainTotal,2).'</strong>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;font-size:13px;"><strong>VAT 7 %</strong></td>
      <td colspan="3"  style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumpricevat,2).'</strong>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;font-size:13px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td colspan="3"  style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumtotal,2).'</strong>&nbsp;&nbsp;</td>
    </tr>
	<tr>
      <td style="border:1px solid #000000;padding:5;font-size:13px;"><strong>ยอดรวมกำไรขั้นต้น</strong></td>
      <td colspan="2"  style="border:1px solid #000000;padding:5;text-align:right;font-size:14px;"><strong>กำไร '.number_format((($sumremainTotal-$sumCost)*(100))/$sumremainTotal,2).'%</strong>&nbsp;&nbsp;</td>
	  <td colspan=""  style="border:1px solid #000000;padding:5;text-align:right;font-size:13px;"><strong>'.number_format($sumremainTotal - $sumCost,2).'</strong>&nbsp;&nbsp;</td>
    </tr>
</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
          <tr>
            <td style="border:0;padding:0;width:40%;vertical-align:top;padding-left:5px;font-size:10px;border:1px solid #000000;padding-top:10px;">';
			
			  //if($_POST['ctype'] != 1){
				  	 $form .= '<strong>เลขที่สัญญาซื้อขาย : </strong> ' .$_POST["r_id"]. '<br><br />';
				  if(($_POST["date_quf"] == date("Y-m-d")) && ($_POST["date_qut"] == date("Y-m-d"))){
					  $form .= '<strong>วันเริ่มสัญญา : </strong> - <strong>&nbsp;สิ้นสุดสัญญา : </strong> - <br><br>';
				  }else{
					  $form .= '<strong>วันเริ่มสัญญา : </strong>'.format_date($_POST["date_quf"]).' <strong>&nbsp;สิ้นสุดสัญญา : </strong>'.format_date($_POST["date_qut"]).'
			  <br><br>';  
				  }
				  
				  
			  //}
			
			  if($_POST["cs_sign"] != ""){
				  $form .='<div id="cssign"><strong>ผู้มีอำนาจเซ็นสัญญา : </strong>
              	  '.$_POST["cs_sign"].'
              <br><br></div>';
			  }
			  $form .='
              <strong>เงื่อนไขการชำระเงิน :</strong> '.nl2br($_POST["qucomment"]).'
		   </td>
          </tr>
</table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
    <tr>
      <td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>บุคคลติดต่อทางด้านการเงิน : '.$_POST["cs_contact"].'</strong></td>
      <td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:10px;"> <strong>โทรศัพท์ : </strong>'.$_POST["cs_tel"].'</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ส่งสินค้า : '.format_date($_POST["cs_ship"]).'</strong></td>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ติดตั้งเครื่อง : '.format_date($_POST["cs_setting"]).'</strong></td>
    </tr>
  </table>
  <br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$_POST["cs_company"].'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>Sale Manager</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.getsalename($conn,$_POST["cs_sell"]).'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$_POST["cs_aceep"].'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>


              </tr>
            </table>
        </td>
      </tr>
    </table>
  ';
	
	if($_POST['remark'] != ""){
		$form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="padding-bottom:5px;"><img src="../images/form/header-project-order.png" width="100%" border="0" /></td>
	  </tr>
	</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].'&nbsp;'.province_name($conn,$_POST["cd_province"]).'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> '.$_POST["cd_fax"].'<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' </td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า : </strong> '.get_groupcusname($conn,$_POST['cg_type']).'&nbsp;&nbsp;&nbsp;&nbsp;<strong>ประเภทลูกค้า : </strong>'.custype_name($conn,$_POST["ctype"]).'<strong><br />
              <br />
            สินค้า :</strong> '.protype_name($conn,$_POST["pro_type"]).'<br />
            <br />
            <strong>เลขที่ใบเสนอราคา / PO.NO. : </strong>'.$_POST["po_id"].'<br />
            <br />            <strong>เลขที่ Project order :</strong><strong> </strong>'.$_POST["fs_id"].'<strong>&nbsp;&nbsp;&nbsp;&nbsp;วันที่ :</strong> '.format_date($_POST["date_forder"]).'<strong></td>
          </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:15px;"><strong>หมายเหตุอื่นๆ : </strong>'.$_POST["remark"].'</td>
          </tr>
</table>';	
	}
	;
?>
	





