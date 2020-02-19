<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php   
	
	
	$fopj_info = get_fopj($conn,$_POST['cus_id']);
	$proList = get_fopj_pro($conn,$_POST['cus_id']);
	$order_pro_info = get_order_product($conn,$id); 

	$dateW1 = ($_POST["date_chk1"] != '0000-00-00') ? format_date($_POST["date_chk1"]) : "-";
	$dateW2 = ($_POST["date_chk2"] != '0000-00-00') ? format_date($_POST["date_chk2"]) : "-";
	$dateW3 = ($_POST["date_chk3"] != '0000-00-00') ? format_date($_POST["date_chk3"]) : "-";
	$dateW4 = ($_POST["date_chk4"] != '0000-00-00') ? format_date($_POST["date_chk4"]) : "-";
	$dateW5 = ($_POST["date_chk5"] != '0000-00-00') ? format_date($_POST["date_chk5"]) : "-";
	$dateW6 = ($_POST["date_chk6"] != '0000-00-00') ? format_date($_POST["date_chk6"]) : "-";
	$dateW7 = ($_POST["date_chk7"] != '0000-00-00') ? format_date($_POST["date_chk7"]) : "-";
	$dateW8 = ($_POST["date_chk8"] != '0000-00-00') ? format_date($_POST["date_chk8"]) : "-";

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
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_order_product.png" width="100%" border="0" />
			<div class="bgheader">'.$_POST['sv_id'].'</div>
		</td>
	  </tr>
	</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="53%" valign="top"><strong>ชื่อลูกค้า :</strong> '.$fopj_info['cd_name'].' <br />              <strong><br />
            ที่อยู่ :</strong> '.$fopj_info['cd_address'].'&nbsp;'.province_name($conn,$fopj_info['cd_province']).'<strong><br />
            <br />
            โทรศัพท์ :</strong> '.$fopj_info['cd_tel'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> '.$fopj_info['cd_fax'].'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$fopj_info['c_contact'].' <strong>&nbsp;&nbsp;&nbsp;&nbsp;<br>
            <br>
            เบอร์โทร :</strong> '.$fopj_info['c_tel'].'</td>
            <td width="47%"><strong>กลุ่มลูกค้า :</strong> '.get_groupcusname($conn,$_POST['sr_ctype']).' <strong><br>
            <br>
            ประเภทลูกค้า :</strong> '.custype_name($conn,$_POST['sr_ctype2']).' <strong><br />
              <br />
            </strong>';
			
			if($_POST['search_fo'] != ""){
				$poFoID = '<strong>เลขที่ FO/PJ</strong> ('.$_POST['search_fo'].')';
			}else{
				$poFoID = '<strong>เลขที่ FO/PJ</strong>';
			}

			$form .= $poFoID.'<br />
			<br />
			<strong>วันที่สั่งผลิตสินค้า  :</strong> '.format_date($_POST['job_open']).' &nbsp;&nbsp;
			<strong>กำหนดผลิตเสร็จ :</strong> '.format_date($_POST['job_balance']).'<br /><br />
			<strong>กำหนดส่งสินค้า :</strong> '.format_date($_POST['sr_stime']).' &nbsp;&nbsp; <strong>พนักงานขาย :</strong> '.getsalename($conn,$fopj_info['cs_sell']).' 
            </td>
          </tr>
    </table>
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
		<td width="53%" style="padding:5;"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>'.$fopj_info['loc_name'].'
		<br><br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="30%" style="border: 0px;border-bottom: 1px solid;"><strong>รายละเอียดงาน</strong></td>
				<td width="30%" style="border: 0px;border-bottom: 1px solid;"><strong>วันที่รับงาน</strong></td>
				<td width="30%" style="border: 0px;border-bottom: 1px solid;"><strong>วันที่แล้วเสร็จ</strong></td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;"><strong>แผนกตัด/พับ</strong></td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW1.'</td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW2.'</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;"><strong>แผนกเชื่อม/ประกอบ</strong></td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW3.'</td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW4.'</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;"><strong>แผนกขัด/แต่ง</strong></td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW5.'</td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW6.'</td>
			</tr>
			<tr>
				<td style="border: 0px;padding:5;"><strong>แผนกล้าง/แพ็ค</strong></td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW7.'</td>
				<td style="border: 0px;padding:5;"><strong>วันที่ : </strong>'.$dateW8.'</td>
			</tr>
		</table>
           </td>
        <td width="47%" valign="top"><strong>รายละเอียดสินค้าสั่งผลิต</strong><br><br>'.$_POST['detail_recom'].'</td>
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
	</tr>';
	
		$rowCal = 1;
		$rowCalIn = 1;
		$rowProList = 0;
		$rowProAmount = 0;
		$pro_list2 = explode(',',$_POST['pro_list']);

		while($rowPro = mysqli_fetch_array($proList)){

			if(in_array($rowCal,$pro_list2)){
				$form .= '<tr>
					<td style="border:1px solid #000000;padding:5;text-align:center;">'.$rowCalIn.'</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">'.get_stock_project_code($conn,$rowPro['cpro']).'</td>
					<td style="border:1px solid #000000;text-align:left;padding:5;">'.get_stock_project_name($conn,$rowPro['cpro']).'</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">'.get_stock_project_sn($conn,$rowPro['cpro']).'</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">'.get_stock_project_size($conn,$rowPro['cpro']).'</td>
					<td style="border:1px solid #000000;padding:5;text-align:center;">'.$rowPro['camount'].'</td>

				</tr>';
				$rowProList += 1;
				$rowCalIn++;
				$rowProAmount += $rowPro['camount'];
			}
	    
		$rowCal++;
		}
		
        $form .= '<tr >
			<td colspan="5"><center><strong>รวมจำนวนที่สั่งผลิต ( รายการ )</strong></center></td>
			<td colspan="1" align="center"><strong>'.$rowProList.'</strong></td>
		</tr>
		
        <tr >
          <td colspan="5"><center><strong>รวมจำนวนที่สั่งผลิต ( ชิ้น )</strong></center></td>
          <td colspan="1" align="center"><strong>'.$rowProAmount.'</strong></td>
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้สั่งผลิตสินค้า</strong></td>
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ตรวจสอบแบบและการผลิตสินค้า</strong></td>
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติ / หัวหน้าฝ่ายผลิต</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date3']).'</td>
              </tr>
            </table>
        </td>

      </tr>
	</table>
	<br><br><br>
  ';
  if($order_pro_info['images1'] != ''){
    $form .= '<div style="font-family:Verdana, Geneva, sans-serif;text-align:center;font-size:14px;font-weight: bold;"><u>รูปภาพประกอบ</u>
    <br><br>
    <img src="../../upload/order_product/images/'.$order_pro_info['images1'].'" style="max-height: 470px;"><br><br>';

    if($order_pro_info['images2'] != ''){
      $form .= '<img src="../../upload/order_product/images/'.$order_pro_info['images2'].'" style="max-height: 470px;"><br><br>';
    }

    if($order_pro_info['images3'] != ''){
      $form .= '<img src="../../upload/order_product/images/'.$order_pro_info['images3'].'" style="max-height: 470px;"><br><br>';
    }

    $form .= '</div>';
  }
?>


	

	