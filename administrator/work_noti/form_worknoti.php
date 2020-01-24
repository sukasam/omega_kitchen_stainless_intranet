<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php     

$workNotiInfo = getWorkNotiInfo($conn,$id);

if(in_array('1',$work_list)){$workList1 = 'aroow_ch.png';}else{$workList1 = 'aroow_nch.png';}
if(in_array('2',$work_list)){$workList2 = 'aroow_ch.png';}else{$workList2 = 'aroow_nch.png';}
if(in_array('3',$work_list)){$workList3 = 'aroow_ch.png';}else{$workList3 = 'aroow_nch.png';}
if(in_array('4',$work_list)){$workList4 = 'aroow_ch.png';}else{$workList4 = 'aroow_nch.png';}
if(in_array('5',$work_list)){$workList5 = 'aroow_ch.png';}else{$workList5 = 'aroow_nch.png';}
if(in_array('6',$work_list)){$workList1 = 'aroow_ch.png';}else{$workList6 = 'aroow_nch.png';}
if(in_array('7',$work_list)){$workList7 = 'aroow_ch.png';}else{$workList7 = 'aroow_nch.png';}
if(in_array('8',$work_list)){$workList8 = 'aroow_ch.png';}else{$workList8 = 'aroow_nch.png';}
if(in_array('9',$work_list)){$workList9 = 'aroow_ch.png';}else{$workList9 = 'aroow_nch.png';}
if(in_array('10',$work_list)){$workList10 = 'aroow_ch.png';}else{$workList10 = 'aroow_nch.png';}
if(in_array('11',$work_list)){$workList11 = 'aroow_ch.png';}else{$workList11 = 'aroow_nch.png';}

$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="../images/form/header-work-notification.png" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].' จังหวัด '.province_name($conn,$_POST['cd_province']).'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$_POST["cd_contact"].'<strong>&nbsp;&nbsp;&nbsp;ตำแหน่ง :</strong> '.$_POST["cd_position"].'<br /><br />
            <strong>มือถือ : </strong>'.$_POST["cd_mobile"].'<strong>&nbsp;&nbsp;&nbsp;Line :</strong> '.$_POST["cd_line"].' <br /><br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;อีเมล์ :</strong> '.$_POST["cd_email"].'
            </td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>เลขที่ใบแจ้งงาน :</strong><strong> </strong>'.$_POST["fs_id"].'<br><br>
            <strong>วันที่ :</strong> '.format_date($_POST["date_open"]).'<br /><br />            
            <strong>พนักงานขาย :</strong> '.getsalename($conn,$_POST["sale_contact"]).'<br /><br />
            <strong>มือถือ :</strong> '.$_POST["sale_tel"].'<br /><br />   
			</td>
          </tr>
</table>
  <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2" style="border:1px solid #000000;font-family:Verdana, Geneva, sans-serif;font-size:10px;">
    <tr>
      <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;" width="100%">
        <strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> '.$_POST["loc_name"].'<br /><br /> 
        <strong>ที่อยู่ :</strong> '.$_POST["loc_address"].'<strong><br /><br />
      </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;font-family:Verdana, Geneva, sans-serif;font-size:10px;padding:5px;border-top:0px;line-height: 25px;">
<tr style="">
  <td width="40%" style="text-align:center;font-weight: bold;font-size:10px;"><u>เอกสารประกอบการแจ้งงาน</u></td>
  <td width="40%" style="text-align:center;font-weight: bold;font-size:10px;"><u>รายละเอียดการแจ้งงาน</u></td>
  <td width="20%" style="font-weight: bold;font-size:10px;"><u>วันที่เข้าบริการ</u></td>
</tr>
<tr>
  <td ><img src="../images/'.$workList1.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;แบบร่างและรายะเอียดประกอบแบบ</td>
  <td><img src="../images/'.$workList2.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;เพิ่อเขียนแบบ : '.$_POST['work_detail1'].'</td>
  <td>วันที่ : '.format_date($_POST["date_work1"]).'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList3.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;ไฟล์ CAD</td>
  <td><img src="../images/'.$workList4.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;ตรวจสอบพื้นที่ / ดูหน้างาน / วัดพื้นที่</td>
  <td>วันที่ : '.format_date($_POST["date_work2"]).'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList5.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;แค็ตตาล็อคสินค้า</td>
  <td><img src="../images/'.$workList6.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;เพื่อผลิตสินค้า (อ้างอิงเอกสาร) : '.$_POST['work_detail2'].'</td>
  <td>วันที่ : '.format_date($_POST["date_work3"]).'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList7.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;แบบแปลน ที่ลูกค้าอนุมัติ</td>
  <td><img src="../images/'.$workList8.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;เพื่อแจ้งซ่อม / บริการ : '.$_POST['work_detail3'].'</td>
  <td>วันที่ : '.format_date($_POST["date_work4"]).'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList9.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;แบบ Shop Drawing</td>
  <td><img src="../images/'.$workList10.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;อื่นๆ ระบุ : '.$_POST['work_detail5'].'</td>
  <td>วันที่ : '.format_date($_POST["date_work5"]).'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList11.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;อื่นๆ : '.$_POST['work_detail4'].'</td>
  <td></td>
  <td>วันที่ : '.format_date($_POST["date_work6"]).'</td>
</tr>
</table>
  <br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;line-height: 20px;">
    <tr>
      <td style="text-align:center;padding:5px;">
        <u style="font-family:Verdana, Geneva, sans-serif;font-size:12px;font-weight: bold;">รายละเอียด การแจ้งงาน</u>
      </td>
    </tr>
    <tr>
      <td style="padding:5px;font-size:12px;vertical-align: top;" height="340">
        <div >'.stripslashes($_POST['remark']).'</div>
      </td>
    </tr>
  </table>
  <br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$_POST["sign_work1"].'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้แจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date($_POST["sign_date_work1"]).'</strong></td>
              </tr>
            </table>
        </td>
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >'.$_POST["sign_work2"].'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>หัวหน้า / ผู้แจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date($_POST["sign_date_work2"]).'</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$_POST["sign_work3"].'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับแจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date($_POST["sign_date_work3"]).'</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table> 
  <br><br><br>
  ';
  if($workNotiInfo['images1'] != ""){
    $form .= '<div style="font-family:Verdana, Geneva, sans-serif;text-align:center;font-size:14px;font-weight: bold;"><u>รูปภาพประกอบ การแจ้งงาน</u>
    <br><br>
    <img src="../../upload/work_noti/images/'.$workNotiInfo['images1'].'" style="max-height: 470px;"><br><br>';

    if($workNotiInfo['images2'] != ""){
      $form .= '<img src="../../upload/work_noti/images/'.$workNotiInfo['images2'].'" style="max-height: 470px;"><br><br>';
    }

    if($workNotiInfo['images3'] != ""){
      $form .= '<img src="../../upload/work_noti/images/'.$workNotiInfo['images3'].'" style="max-height: 470px;"><br><br>';
    }

    $form .= '</div>';
  }
?>
	





