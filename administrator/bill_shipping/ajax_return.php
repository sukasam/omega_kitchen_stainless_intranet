<?php    
	include_once("../../include/aplication_top.php");
	header("Content-type: text/html; charset=utf8");
	header("Cache-Control: no-cache, must-revalidate");
	@mysqli_query($conn,"SET NAMES  UTF8");
	
	if($_GET['action'] == 'getprodetail'){
		
			$pid = $_GET['pid'];
			$fid = $_GET['fid'];
			
			$prolistname = get_profirstorder($conn,$fid);
			$prolistpod = get_podfirstorder($conn,$fid);
			$prolistsn = get_snfirstorder($conn,$fid);
			
			echo '<input type="text" name="loc_pro" value="'.get_proname($conn,$prolistname[$pid]).'" id="loc_pro" class="inpfoder" style="width:50%;">|<input type="text" name="loc_seal" value="'.$prolistpod[$pid].'" id="loc_seal" class="inpfoder" style="width:20%;">|<input type="text" name="loc_sn" value="'.$prolistsn[$pid].'" id="loc_sn" class="inpfoder" style="width:20%;">';
	}
	
		if($_GET['action'] == 'getcusfirsh'){

		$fpid = $_GET['pid'];
		$rowcus  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_fopj WHERE fo_id  = '".$fpid."'"));
		
		//$prolist = get_profirstorder($conn,$fpid);

		$sr_ctype2 = '';
		$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
		while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
			if(substr($row_cusftype2['group_name'],0,2) !== "SR"){

				if($rowcus['ctype'] == $row_cusftype2['group_id']){
					$sr_ctype2 .= '<option value="'.$row_cusftype2['group_id'].'" selected=selected>'.$row_cusftype2['group_name'].'</option>';
				}else{
					$sr_ctype2 .= '<option value="'.$row_cusftype2['group_id'].'" >'.$row_cusftype2['group_name'].'</option>';
				}
			}
		}

		$sr_ctype = '';
		$qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
		while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){
			if(substr($row_cusftype['group_name'],0,2) !== "SR"){

				if($rowcus['pro_type'] == $row_cusftype['group_id']){
					$sr_ctype .= '<option value="'.$row_cusftype['group_id'].'" selected=selected>'.$row_cusftype['group_name'].'</option>';
				}else{
					$sr_ctype .= '<option value="'.$row_cusftype['group_id'].'" >'.$row_cusftype['group_name'].'</option>';
				}
			}
		}

		$sprovince = '';
		$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
		while($row_province = @mysqli_fetch_array($quprovince)){
			if($rowcus['cd_province'] == $row_province['province_id']){
				$sprovince .= '<option value="'.$row_province['province_id'].'" selected=selected>'.$row_province['province_name'].'</option>';
			}else{
				$sprovince .= '<option value="'.$row_province['province_id'].'" >'.$row_province['province_name'].'</option>';
			}
		}

  
		$proListfopj = '';
		//$proListfopj .= "SELECT * FROM `s_fopj_product` WHERE fo_id = '".$fpid."' ORDER BY id ASC";
		$quQry = mysqli_query($conn,"SELECT * FROM `s_fopj_product` WHERE fo_id = '".$fpid."' ORDER BY id ASC");
		$numRowPro = mysqli_num_rows($quQry);
		$rowCal = 1;
		$sumPrice = 0;
		$sumCost = 0;

		while($rowPro = mysqli_fetch_array($quQry)){
			
			$proListfopj .= '<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;">'.$rowCal.'</td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="ccodepro'.$rowCal.'">'.get_stock_project_code($conn,$rowPro['cpro']).'</td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;vertical-align: middle;">
			  <input type="hidden" name="cpro[]" value="'.$rowPro['cpro'].'">
			 '.get_stock_project_name($conn,$rowPro['cpro']).' 
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cpropod'.$rowCal.'">'.get_stock_project_sn($conn,$rowPro['cpro']).'</td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprosize'.$rowCal.'">'.get_stock_project_size($conn,$rowPro['cpro']).'</td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprostock'.$rowCal.'">'.get_stock_project_stock($conn,$rowPro['cpro']).'</td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;">
				<input type="text" name="camount[]" value="'.$rowPro['camount'].'" id="camount'.$rowCal.'" class="inpfoder" style="width:100%;text-align:center;">
			  </td>
			</tr>';
			

			$rowCal++;
		}

		//$proListfopj = '<tr><td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;">1</td>	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="ccodepro1">	</td>	<td style="border:1px solid #000000;text-align:left;padding:5;vertical-align: middle;">		<select name="cpro[]" id="cpro1" class="inputselect" style="width:85%;">		<option value="">กรุณาเลือกรายการสินค้า</option>	</select><a href="javascript:void(0);" onclick="windowOpener(\'400\', \'500\', \'\', \'search2.php?protype=1&amp;col=1\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>	</td>	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cpropod1"></td>	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprosize1"></td>	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;" id="cprostock1"></td>	<td style="border:1px solid #000000;padding:5;text-align:center;vertical-align: middle;">		<input type="text" name="camount[]" value="" id="camount1" class="inpfoder" style="width:100%;text-align:center;"></td></tr>';
		
		$displ = "|".$rowcus['cd_address']."|".$sprovince."|".$rowcus['cd_tel']."|".$rowcus['cd_fax']."|".$rowcus['c_contact']."|".$rowcus['c_tel']."|".$rowcus['loc_name']."|".$rowcus['loc_address']."|".$rowcus['loc_tel']."|".$rowcus['loc_fax']."|".$rowcus['loc_cname']."|".$rowcus['loc_ctel'].'|'.$sr_ctype2.'|'.$sr_ctype.'|'.$rowcus['fs_id'].'|'.$proListfopj;
		echo $displ;
	}
	
	if($_GET['action'] == 'getcus'){
		$cd_name = $_REQUEST['pval'];
		if($cd_name != ""){
			$consd = "AND cd_name LIKE '%".$cd_name."%'";
		}
		$qu_cus = mysqli_query($conn,"SELECT fo_id,cd_name,loc_name FROM s_fopj WHERE 1 ".$consd." AND (status_use = '0') AND `fs_id` NOT LIKE 'SV' ORDER BY cd_name ASC");
		while($row_cusx = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cusx['fo_id'];?>','<?php     echo $row_cusx['cd_name'];?>');"><?php     echo $row_cusx['cd_name'];?> (<?php     echo $row_cusx['loc_name']?>)</A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_fopj ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getsparpart'){
		$cd_name = $_REQUEST['pval'];
		if($cd_name != ""){
			$consd = "WHERE 1 AND (group_spar_id LIKE '%".$cd_name."%' OR group_name LIKE '%".$cd_name."%')";
		}
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_stock_order ".$consd." ORDER BY group_spar_id ASC");
		while($row_cusx = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_sparactive('<?php echo $row_cusx['group_id'];?>','<?php echo $_REQUEST['resdata']?>');"><?php     echo $row_cusx['group_spar_id'].'&nbsp;&nbsp;'.$row_cusx['group_name'];?></A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_fopj ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getsparactive'){

		$sparval = $_REQUEST['spid'];
		$ressdata = $_REQUEST['resdata'];
		$qu_spare = @mysqli_query($conn,"SELECT * FROM s_group_stock_order  WHERE  group_id = '".$sparval."'");
		$row_spare = @mysqli_fetch_array($qu_spare);
		
		$selclist = "<select name=\"lists[]\" id=\"lists".$ressdata."\" class=\"inputselect\" style=\"width:92%\" onchange=\"get_product('".$ressdata."')\">";
                	$qucgspare = @mysqli_query($conn,"SELECT * FROM s_group_stock_order WHERE 1 ORDER BY group_name ASC");
					$selclist .= "<option value=\"\">กรุณาเลือกรายการสินค้า</option>";

					while($row_spares = @mysqli_fetch_array($qucgspare)){
						$selclist .= "<option value=\"".$row_spares['group_id']."\"";
						if($sparval == $row_spares['group_id']){$selclist .= "selected=selected";}
						$selclist .= ">".$row_spares['group_name']."</option>";
					}
           $selclist .= "</select>";
		   
		//   $selclist = 'mkung';
		   
		$res_spares = '|'.$row_spare['group_spar_id'].'|'.$selclist.'|'.$row_spare['group_sn'].'|'.$row_spare['group_size'].'|'.$row_spare['group_stock'];
		echo $res_spares;
	}
	
	if($_GET['action'] == 'getspare'){
		$sparval = $_REQUEST['sval'];
		$qu_spare = @mysqli_query($conn,"SELECT * FROM s_group_stock_order  WHERE  group_id = '".$sparval."'");
		$row_spare = @mysqli_fetch_array($qu_spare);
		$res_spare = '|'.$row_spare['group_spar_id'].'|'.$row_spare['group_stock'].'|'.$row_spare['group_location'];
		echo $res_spare;
	}

?>

