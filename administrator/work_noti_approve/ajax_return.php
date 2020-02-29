<?php    
	include_once("../../include/aplication_top.php");
	header("Content-type: text/html; charset=windows-874");
	header("Cache-Control: no-cache, must-revalidate");
	@mysqli_query($conn,"SET NAMES tis620");
	
	if($_GET['action'] == 'getpro'){
		$pid = $_GET['pid'];
		$rowpro  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 WHERE group_id = '".$pid."'"));
		echo $rowpro['group_pro_pod']."|".$rowpro['group_pro_sn']."|".number_format($rowpro['group_pro_price']);
	}
	
	if($_GET['action'] == 'getprice'){
		$pid = $_GET['pid'];
		$prid = $_GET['prid'];
		$rowpro  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_id = '".$pid."'"));
		$sumprice = $prid * $rowpro['group_pro_price'];
		echo number_format($sumprice);
	}
	
	if($_GET['action'] == 'getcus'){
		$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
		if($cd_name != ""){
			$consd = "WHERE cd_name LIKE '%".$cd_name."%'";
		}
		//echo "SELECT * FROM s_first_order ".$consd." ORDER BY cd_name ASC";
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_fopj ".$consd." AND (status_use = '0') ORDER BY cd_name ASC");
		while($row_cus = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cus['fo_id'];?>');"><?php echo $row_cus['cd_name']." (".$row_cus['loc_name'].")";?></A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_work_noti ".$consd." ORDER BY cd_name ASC";
	}

	if($_GET['action'] == 'getcusDetail'){

		$cus_id =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['cus_id']);
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_fopj WHERE 1 AND `fo_id` = '".$cus_id."' LIMIT 1");
		$row_cus = @mysqli_fetch_array($qu_cus);

		$cProvince = '';
		$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
		while($row_province = @mysqli_fetch_array($quprovince)){

			$CpChk = ($row_cus['cd_province'] == $row_province['province_id']) ? 'selected':'';
			$cProvince .= '<option value="'.$row_province['province_id'].'" '.$CpChk.'>'.$row_province['province_name'].'</option>';	
		}
		$cSale = '';
		$CsTel = '';
		$qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
		while($row_saletype = @mysqli_fetch_array($qusaletype)){

			$CsChk = ($row_cus['cs_sell'] == $row_saletype['group_id']) ? 'selected':'';
			if($row_cus['cs_sell'] == $row_saletype['group_id']){
				$CsTel = $row_saletype['group_tel'];
			}
			$cSale .= '<option value="'.$row_saletype['group_id'].'" '.$CsChk.'>'.$row_saletype['group_name'].'</option>';  	
		}

		echo "|".$row_cus['cd_name']."|".$row_cus['cd_address']."|".$cProvince."|".$row_cus['c_contact']."|".$row_cus['c_tel']."|".$row_cus['loc_name']."|".$row_cus['loc_address']."|".$cSale.'|'.$CsTel.'|'.$row_cus['cd_tel'];

	}

	if($_GET['action'] == 'getproDetail'){
		$pid = $_GET['pro_id'];
		$rowpro  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_stock_project WHERE group_id = '".$pid."'"));

		$amount = '0';
		$listPRo = '';
		$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_stock_project ORDER BY group_name ASC");
		while($row_qupro1 = @mysqli_fetch_array($qupro1)){

			$chkL = ($pid == $row_qupro1['group_id']) ? 'selected' : '';
			$listPRo .='<option value="'.$row_qupro1['group_id'].'" '.$chkL.'>'.$row_qupro1['group_name'].'</option>';
		    	
		}

		echo "|".$rowpro['group_spar_id']."|".$listPRo."|".$rowpro['group_sn']."|".$rowpro['group_size']."|".$amount;
	}


	if($_GET['action'] == 'get_pros'){
		$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
		if($cd_name != ""){
			$consd = "WHERE 1 AND (group_name LIKE '%".$cd_name."%' OR group_spar_id LIKE '%".$cd_name."%')";
		}
		$col = $_REQUEST['col'];
		//echo "SELECT * FROM s_group_typeproduct ".$consd." ORDER BY group_name ASC";
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_stock_project ".$consd." ORDER BY group_name ASC");
		while($row_pros = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_products('<?php echo $row_pros['group_id'];?>','<?php echo $col;?>');"><?php  echo $row_pros['group_spar_id']." | ".$row_pros['group_name']. " | ".$row_pros['group_size'];?></A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_work_noti ".$consd." ORDER BY cd_name ASC";
	}


	
	
	if($_GET['action'] == 'getpodkey'){
		$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
		$keys = $_REQUEST['keys'];
		if($cd_name != ""){
			$consd = "WHERE group_name LIKE '%".$cd_name."%'";
		}
		//echo "SELECT group_name FROM s_group_typeproduct ".$consd." ORDER BY group_name ASC";
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_pod ".$consd." ORDER BY group_name ASC");
		while($row_cus = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_pod('<?php     echo $row_cus['group_id'];?>','<?php     echo $row_cus['group_name'];?>','<?php     echo $keys;?>');"><?php     echo $row_cus['group_name'];?></A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_work_noti ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getprotype'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		
		$listPRo = '';
		$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
		while($row_qupro1 = @mysqli_fetch_array($qupro1)){
			if($group_id == $row_qupro1['group_id']){
				$listPRo .= '<option value="'.$row_qupro1['group_id'].'" selected="selected">'.$row_qupro1['group_name'].'</option>';
			}else{
				$listPRo .= '<option value="'.$row_qupro1['group_id'].'">'.$row_qupro1['group_name'].'</option>';
			}
		}
		echo '|'.$listPRo.'|'.get_pro_code($conn,$group_id);
	}
	
	if($_GET['action'] == 'getpod'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		
		$qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
		while($row_qupros1 = @mysqli_fetch_array($qupros1)){
		  ?>
			<option value="<?php     echo $row_qupros1['group_id'];?>" <?php     if($group_id == $row_qupros1['group_id']){echo 'selected';}?>><?php     echo $row_qupros1['group_name'];?></option>
		  <?php    	
		}

		//echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
	}

?>

