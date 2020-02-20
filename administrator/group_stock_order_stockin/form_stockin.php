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
		
		$projectPro .= '<tr>
		<td style="border:1px solid #000000;padding:5;">'.($i+1).'</td>
		<td style="border:1px solid #000000;padding:5;">'.get_sparpart_id($conn,$_POST['cpro'][$i]).'</td>
		<td style="border:1px solid #000000;text-align:left;padding:5;">'.get_sparpart_name($conn,$_POST['cpro'][$i]).'</td>
		  <td style="border:1px solid #000000;padding:5;">'.$_POST['camount'][$i].'</td>
		</tr>';
		
	}
}

$sumdiscount = $_POST['discount'];

$sumremainTotal = $sumprice - $sumdiscount;

$sumpricevat = ($sumremainTotal * 7) / 100;
$sumtotal = ($sumprice + $sumpricevat) - $sumdiscount;

$dataApprove = '';

if($_POST['stock_approve_date'] != '0000-00-00' && $_POST['stock_approve_date'] != ''){
  $dataApprove = format_date($_POST['stock_approve_date']);
}else{
  $dataApprove = '';
}

$form = '
<p><h3>รายการรับเข้าสต็อคสินค้าสำเร็จรูป</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อโปรเจ็คลูกค้า :</strong> '.$_POST["sub_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["sub_address"].'<br />
            <br />
            <strong>เบอร์โทร :</strong> '.$_POST["sub_tel"].'<br /><br />
            <strong>วันที่รับเข้า : </strong>'.format_date($_POST["stock_date"]).'<strong></td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ FO/PJ : </strong> '.$_POST['sub_billnum'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>วันที่บิล : </strong>'.format_date($_POST["sub_billdate"]).'<strong><br />
              <br />
            หมายเหตุ :</strong> '.$_POST["sub_comment"].'<br />
            <br />
			</td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;text-align:center;margin-top:10px;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
	  <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
      <td width="30%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
    </tr>
    
	'.$projectPro.'    
	
</table><br><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
<tr>
<td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><br>'.get_technician_name($conn,$_POST['stock_admin']).'</td>
        </tr>
        <tr>
          <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับเข้าสินค้า</strong></td>
        </tr>
        <tr>
          <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['stock_date']).'</td>
        </tr>
      </table>
  </td>

<td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><br>'.get_technician_name($conn,$_POST['stock_approve']).'</td>
        </tr>
        <tr>
          <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ/รับเข้าสินค้า</strong></td>
        </tr>
        <tr>
          <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.$dataApprove.'</td>
        </tr>
      </table>
  </td>

</tr>
</table>
  ';
?>
	





