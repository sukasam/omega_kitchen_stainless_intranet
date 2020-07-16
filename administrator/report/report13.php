<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";
Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");
if ($_GET["page"] == "") {$_REQUEST["page"] = 1;}
$param = get_param($a_param, $a_not_exists);

if (isset($_GET['priod'])) {$_REQUEST['sh1'] = 1;
    $_REQUEST['sh2'] = 1;
    $_REQUEST['sh3'] = 1;
    $_REQUEST['sh4'] = 1;
    $_REQUEST['sh5'] = 1;
    $_REQUEST['sh6'] = 1;
    $_REQUEST['sh7'] = 1;
    $_REQUEST['sh8'] = 1;
    $_REQUEST['sh9'] = 1;
    $_REQUEST['sh10'] = 1;}

$cd_name = $_REQUEST['cd_name'];
$sale_contact = $_REQUEST['sale_contact'];
$a_sdate = explode("/", $_REQUEST['date_fm']);
$date_fm = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
$a_sdate = explode("/", $_REQUEST['date_to']);
$date_to = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

if ($_REQUEST['priod'] == 0) {
    $daterriod = " AND `date_open` between '" . $date_fm . "' and '" . $date_to . "'";
    $dateshow = "เริ่มวันที่ : " . format_date($date_fm) . "&nbsp;&nbsp;ถึงวันที่ : " . format_date($date_to);
} else {
    $dateshow = "วันที่ค้นหา : " . format_date(date("Y-m-d"));
}

$codi = '';

if ($cd_name != "") {
    $codi .= " AND `cd_name` LIKE '%" . $cd_name . "%'";
}

if ($sale_contact != "") {
    $codi .= " AND `sale_contact` = '" . $sale_contact . "'";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามใบแจ้งงาน (<?php if ($cd_name != "") {echo $cd_name;} else {echo $serT . "ทั้งหมด";}?> )</title>
<style type="text/css">
 .tbreport{
 	font-size:10px;
 }
 .tbreport th{
	font-weight:bold;
	text-align:left;
	border-bottom:1px solid #000000;
	padding:5;
 }
 .tbreport td{
	 padding:5px;
	 vertical-align:top;
	 border-bottom:1px solid #000000;
 }
</style>
</head>

<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
	  <tr>
	    <th colspan="2" style="text-align:left;font-size:12px;"><p>บริษัท โอเมก้า คิทเช่น สแตนเลส จำกัด<br />
	      รายงานตามใบแจ้งงาน (<?php if ($cd_name != "") {echo $cd_name;} else {echo $serT . "ทั้งหมด";}?> )</p></th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php echo $dateshow; ?></th>
      </tr>
      <tr>
        <?php if ($_REQUEST['sh1'] == 1) {?><th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php }?>
        <?php if ($_REQUEST['sh2'] == 1) {?><th width="15%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php }?>
        <?php if ($_REQUEST['sh3'] == 1) {?><th width="10%">จังหวัด</th><?php }?>
		<?php if ($_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1 || $_REQUEST['sh8'] == 1) {?><th width="30%">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php if ($_REQUEST['sh6'] == 1) {?><th style="border:0;text-align:left;" >สินค้า</th><?php }?>
            <?php if ($_REQUEST['sh7'] == 1) {?><th style="border:0;text-align:center;padding-left:70px;;">รุ่น/แบรนด์</th><?php }?>
			<?php if ($_REQUEST['sh6'] == 1) {?><th style="border:0;text-align:left;padding-left:70px;;">จำนวน</th><?php }?>
          </tr>
        </table></th><?php }?>
		<th width="10%">รายละเอียดงาน</th>
        <?php if ($_REQUEST['sh11'] == 1) {?><th width="15%">สถานะติดตามการแจ้งงาน</th><?php }?>
        <?php if ($_REQUEST['sh10'] == 1) {?><th width="10%">พนักงานขาย</th><?php }?>
      </tr>
      <?php
$sql = "SELECT * FROM s_work_noti WHERE 1 " . $daterriod . " " . $codi . " ORDER BY date_open ASC";
$qu_fr = @mysqli_query($conn, $sql);
$sum = 0;
while ($row_fr = @mysqli_fetch_array($qu_fr)) {

    ?>
			<tr>
             <?php if ($_REQUEST['sh1'] == 1) {?><td><?php echo $row_fr['cd_name']; ?><br />
              <?php echo $row_fr['cd_tel']; ?></td><?php }?>
              <?php if ($_REQUEST['sh2'] == 1) {?><td><?php echo $row_fr['loc_name']; ?><br />
              <?php echo $row_fr['loc_address']; ?></td><?php }?>
              <?php if ($_REQUEST['sh3'] == 1) {?><td><?php echo province_name($conn, $row_fr['cd_province']); ?></td><?php }?>
              <?php if ($_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1 || $_REQUEST['sh8'] == 1) {?><td style="padding:0;">
              	<table width="92%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php
$sqlPro = "SELECT * FROM s_work_noti_product WHERE 1 AND `fo_id` = '" . $row_fr['fo_id'] . "' ORDER BY `id` ASC";
        $qu_frList = @mysqli_query($conn, $sqlPro);
        while ($row_proList = @mysqli_fetch_array($qu_frList)) {
            ?>
						<tr>
                          <?php if ($_REQUEST['sh6'] == 1) {?><td style="border:0;padding-bottom:0;text-align:left;" width="31%"><?php echo get_stock_project_name($conn, $row_proList['cpro']); ?></td><?php }?>
                          <?php if ($_REQUEST['sh7'] == 1) {?><td style="border:0;padding-bottom:0;text-align:center;" width="33%"><?php echo get_stock_project_sn($conn, $row_proList['cpro']); ?></td><?php }?>
						  <?php if ($_REQUEST['sh6'] == 1) {?><td style="border:0;padding-bottom:0;text-align:center;" width="33%"><?php echo $row_proList['camount']; ?></td><?php }?>
                        </tr>
						<?php
}
        ?>
              </table></td><?php }?>
			  <td><?php echo stripslashes($row_fr['remark']); ?></td>
              <?php if ($_REQUEST['sh11'] == 1) {?>
			  	<td>
				  <table border="0" cellpadding="0" cellspacing="0" class="tbreport" style="width: 100%;">
				<?php

        $quTracking = mysqli_query($conn, "SELECT * FROM s_group_tracking WHERE group_type = 'WN' AND fo_id = '" . $row_fr['fo_id'] . "' ORDER BY group_id DESC");
        while ($rowTrakking = mysqli_fetch_array($quTracking)) {
            ?>
						<tr>
							<td style="border-bottom: 0;">
							<?php echo format_date_th($rowTrakking['group_date'], 7) . ' ' . $rowTrakking['group_time'] . '<br>' . $rowTrakking['group_detail']; ?>
							</td>
						</tr>
						<?php
}
        ?>
				</table>
				</td>
				  <?php }?>
              <?php if ($_REQUEST['sh10'] == 1) {?><td><?php echo getsalename($conn, $row_fr['sale_contact']); ?></td><?php }?>
            </tr>

			<?php
$sum += 1;
}
?>
       <tr>
		<td colspan="8" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php echo $sum; ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>