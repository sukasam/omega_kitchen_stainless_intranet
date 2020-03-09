<?php    
	include_once("../../include/aplication_top.php");
	header("Content-type: text/html; charset=windows-874");
	header("Cache-Control: no-cache, must-revalidate");
	@mysqli_query($conn,"SET NAMES tis620");
	
	if($_GET['action'] == 'getpro'){
		$pid = $_GET['pid'];
		$rowpro  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_id = '".$pid."'"));
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
		$keys = $_REQUEST['keys'];
		if($cd_name != ""){
			$consd = " AND (fo.cd_name LIKE '%".$cd_name."%' OR qc.sv_id LIKE '%".$cd_name."%')";
		}
		//echo "SELECT fo.fo_id,fo.cd_name,fo.cd_address,fo.cd_tel,fo.fs_id,fo.loc_name,qc.* FROM s_qc_product as qc , s_fopj as fo WHERE fo.fo_id = qc.cus_id AND (qc.approve = '1') ".$consd." ORDER BY qc.sr_id DESC";
		$qu_cus = mysqli_query($conn,"SELECT fo.fo_id,fo.cd_name,fo.cd_address,fo.cd_tel,fo.fs_id,fo.loc_name,qc.* FROM s_qc_product as qc , s_fopj as fo WHERE fo.fo_id = qc.cus_id AND (qc.approve = '1') ".$consd." ORDER BY qc.sr_id DESC");
		while($row_cus = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cus['fo_id'];?>','<?php echo $row_cus['cd_name'];?>','<?php echo $row_cus['cd_address'];?>','<?php echo $row_cus['cd_tel'];?>','<?php echo $row_cus['fs_id'];?>','<?php echo $row_cus['sr_id'];?>','<?php echo $row_cus['sv_id'];?>');"><?php echo $row_cus['sv_id']." | ".$row_cus['cd_name'];?> (<?php echo $row_cus['loc_name']?>)</A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}

	if($_GET['action'] == 'getcusDetail'){
		$qcid =  $_REQUEST['qcid'];
		$qcInfo = get_qc_product($conn,$qcid);
		$pro_listS = explode(',',$qcInfo['pro_list']);
		$proList = get_fopj_pro($conn, $qcInfo['cus_id']);
		$rowCal = 1;
		$rowCalnum = 1;
		$detail = '';
		while ($rowPro = mysqli_fetch_array($proList)) {
			if (in_array($rowCal, $pro_listS)) {
				$detail .= '<tr>
				<td style="border:1px solid #000000;padding:5;text-align:center;">'.$rowCalnum.'</td>
				<td style="border:1px solid #000000;padding:5;text-align:center;"><input type="hidden" name="cpro[]" value="'.$rowPro['cpro'].'">'.get_stock_project_code($conn, $rowPro['cpro']).'</td>
				<td style="border:1px solid #000000;text-align:left;padding:5;">'.get_stock_project_name($conn, $rowPro['cpro']).'</td>
				<td style="border:1px solid #000000;padding:5;text-align:center;">'.get_stock_project_sn($conn, $rowPro['cpro']).'</td>
				<td style="border:1px solid #000000;padding:5;text-align:center;">'.get_stock_project_size($conn, $rowPro['cpro']).'</td>
				<td style="border:1px solid #000000;padding:5;text-align:center;"><input type="hidden" name="camount[]" value="'.$rowPro['camount'].'">'.$rowPro['camount'].'
				</td>
			</tr>';
			}
			$rowCal++;
		}
		echo $detail;
	}

	

	if($_GET['action'] == 'getprojectL'){
		$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
		$keys = $_REQUEST['keys'];
		if($cd_name != ""){
			$consd = "WHERE group_name LIKE '%".$cd_name."%'";
		}
		echo "SELECT group_name FROM s_group_typeproduct ".$consd." ORDER BY group_name ASC";
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_project ".$consd." ORDER BY group_name ASC");
		while($row_cus = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_product('<?php     echo $row_cus['group_id'];?>','<?php     echo $row_cus['group_name'];?>','<?php     echo $keys;?>');"><?php     echo $row_cus['group_name'];?></A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
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
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}

	if($_GET['action'] == 'getsparkey'){
		$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
		$keys = $_REQUEST['keys'];
		$ccode = $_REQUEST['ccode'];
		if($cd_name != ""){
			$consd = "WHERE group_name LIKE '%".$cd_name."%' OR group_spar_id LIKE '%".$cd_name."%'";
		}
		echo "SELECT group_name FROM s_group_stock_project ".$consd." ORDER BY group_name ASC";
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_stock_project ".$consd." ORDER BY group_name ASC");
		while($row_cus = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_spar('<?php     echo $row_cus['group_id'];?>','<?php     echo $row_cus['group_name'];?>','<?php   echo $keys;?>','<?php   echo $ccode;?>','<?php   echo $row_cus['group_spar_id'];?>');"><?php   echo $row_cus['group_spar_id']." | ".$row_cus['group_name'];?></A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getprotype'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		
		$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
		while($row_qupro1 = @mysqli_fetch_array($qupro1)){
		  ?>
			<option value="<?php     echo $row_qupro1['group_id'];?>" <?php     if($group_id == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
		  <?php    	
		}

		//echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
	}

	if($_GET['action'] == 'getproject'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		
		$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_project ORDER BY group_name ASC");
		while($row_qupro1 = @mysqli_fetch_array($qupro1)){
		  ?>
			<option value="<?php     echo $row_qupro1['group_id'];?>" <?php     if($group_id == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
		  <?php    	
		}

		//echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
	}
	
	if($_GET['action'] == 'getpod'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		
		$qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
		while($row_qupros1 = @mysqli_fetch_array($qupros1)){
		  ?>
			<option value="<?php     echo $row_qupros1['group_name'];?>" <?php     if($group_id == $row_qupros1['group_id']){echo 'selected';}?>><?php     echo $row_qupros1['group_name'];?></option>
		  <?php    	
		}

		//echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
	}


	if($_GET['action'] == 'getspar'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		$ccode = $_REQUEST['ccode'];
		
		$qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_stock_project ORDER BY group_name ASC");
		while($row_qupros1 = @mysqli_fetch_array($qupros1)){
		  ?>
			<option value="<?php     echo $row_qupros1['group_id'];?>" <?php     if($group_id == $row_qupros1['group_id']){echo 'selected';}?>><?php   echo $row_qupros1['group_name'];?></option>
		  <?php    	
		}
		
		//echo "|".$row_qupros1['group_spar_id'];
		//echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
	}

?>

