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
		$chk = $_GET['chk'];
		
		$tableDB = '';
		if($chk == 'po'){
			$tableDB = 's_project_order';
		}else if($chk == 'fopj'){
			$tableDB = 's_fopj';
		}else{
			$tableDB = 's_first_order';
		}

		//echo "SELECT * FROM ".$tableDB." WHERE fo_id  = '".$fpid."'";
			
		$rowcus  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM ".$tableDB." WHERE fo_id  = '".$fpid."'"));
		
		$prolist = get_profirstorder($conn,$fpid);
		//$lispp = explode(",",$prolist);
		$plid = "<select name=\"bbfpro\" id=\"bbfpro\" onchange=\"get_podsn(this.value,'lpa1','lpa2','lpa3','".$fpid."')\">
						<option value=\"\"><<== Select ==>></option>       
					 ";
		for($i=0;$i<count($prolist);$i++){
			$plid .= "<option value=".$i.">".get_proname($conn,$prolist[$i])."</option>";
		}	
		$plid .=	 "</select>";
		
		$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
			while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
					$ctyp .= "<option value=".$row_cusftype2['group_id']." ";
					if($row_cusftype2['group_id'] == $rowcus['ctype']){$ctyp .= "selected=selected";}
					$ctyp .= ">".$row_cusftype2['group_name']."</option>";
					
			}
		
		$foID = '';
		$poID = '';
			
		if($chk == 'po'){
			$foID = '';
			$poID = $rowcus['fs_id'];
		}else if($chk == 'fopj'){
			$foID = '';
			$poID = $rowcus['fs_id'];
		}else{
			$foID = $rowcus['fs_id'];
			$poID = '';
		}
		
		$displ = "|".$rowcus['cd_address']."|".province_name($conn,$rowcus['cd_province'])."|".$rowcus['cd_tel']."|".$rowcus['cd_fax']."|".$rowcus['fs_id']."|".format_date($rowcus['date_quf'])."||".$rowcus['c_contact']."|".$rowcus['c_tel']."|".$rowcus['loc_name']."|".get_lastservice_s($conn,$fpid,"").'|'.$plid.'|'.$ctyp.'|'.$foID.'|'.$poID;
		echo $displ;
	}

	if($_GET['action'] === 'getCusDetail'){


		$fo_id = $_REQUEST['fo_id'];
		$sr_id = $_REQUEST['sr_id'];

		//echo "SELECT * FROM s_fopj WHERE fo_id  = '".$foid."'";
		$rowcus  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_fopj WHERE fo_id  = '".$fo_id."'"));

		$roworpro  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_order_product WHERE sr_id  = '".$sr_id."'"));

		$ctyp = "";

		//echo "SELECT * FROM s_group_custommer ORDER BY group_name ASC";
		$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
			while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
					$ctyp .= "<option value=".$row_cusftype2['group_id']." ";
					if($row_cusftype2['group_id'] == $roworpro['sr_ctype2']){$ctyp .= "selected=selected";}
					$ctyp .= ">".$row_cusftype2['group_name']."</option>";
			}

		$displ = "|".$rowcus['cd_name']."|".$rowcus['cd_address']."|".province_name($conn,$rowcus['cd_province'])."|".$rowcus['cd_tel']."|".$rowcus['cd_fax']."|".$rowcus['c_contact']."|".$rowcus['c_tel']."|".$rowcus['loc_name']."|".$rowcus['fs_id']."|".$ctyp."|".$roworpro['sv_id'];

		echo $displ;

	}
	
	if($_GET['action'] == 'getcus'){
		$cd_name = $_REQUEST['pval'];
		$chk = $_REQUEST['chk'];
		
		if($cd_name != ""){
			$consd = "AND cd_name LIKE '%".$cd_name."%'";
		}
		
		$tableDB = '';
		if($chk == 'po'){
			$tableDB = 's_project_order';
		}else if($chk == 'fopj'){
			$tableDB = 's_fopj';
		}else{
			$tableDB = 's_first_order';
		}
		
		$qu_cus = mysqli_query($conn,"SELECT fo_id,cd_name,loc_name FROM ".$tableDB." WHERE 1 ".$consd." AND (status_use = '0') ORDER BY cd_name ASC");
		
		while($row_cusx = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php     echo $row_cusx['fo_id'];?>','<?php     echo $row_cusx['cd_name'];?>','<?php echo $chk;?>');"><?php     echo $row_cusx['cd_name'];?> (<?php     echo $row_cusx['loc_name']?>)</A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}

	if($_GET['action'] == 'get_cusorprod'){
		$cd_name = $_REQUEST['pval'];
		$chk = $_REQUEST['chk'];
		
		if($cd_name != ""){
			$consd = "AND (fopj.cd_name LIKE '%".$cd_name."%' OR fopj.loc_name LIKE '%".$cd_name."%' OR op.sv_id LIKE '%".$cd_name."%')";
		}
		
		$tableDB = 's_fopj';

		//echo "SELECT fopj.cd_name,fopj.loc_name,op.* FROM s_fopj as fopj, s_order_product as op  WHERE op.cus_id = fopj.fo_id ".$consd."";
		
		$qu_cus = mysqli_query($conn,"SELECT fopj.cd_name,fopj.loc_name,op.* FROM s_fopj as fopj, s_order_product as op  WHERE op.cus_id = fopj.fo_id ".$consd." ORDER BY op.sv_id DESC");
		
		while($row_cusx = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cusx['fo_id'];?>','<?php echo $row_cusx['cd_name'];?>','<?php echo 'fopj';?>','<?php echo $row_cusx['sr_id'];?>');"><?php echo $row_cusx['sv_id']." | ".$row_cusx['cd_name'];?> (<?php     echo $row_cusx['loc_name']?>)</A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}

	if($_GET['action'] == 'getcus2'){
		$cd_name = $_REQUEST['pval'];
		$chk = $_REQUEST['chk'];

		if($cd_name != ""){
			$consd = "AND fs_id = '".$cd_name."'";
		}

		$tableDB = '';
		if($chk == 'po'){
			$tableDB = 's_project_order';
		}else if($chk == 'fopj'){
			$tableDB = 's_fopj';
		}else{
			$tableDB = 's_first_order';
		}

		$qu_cus = mysqli_query($conn,"SELECT * FROM ".$tableDB." WHERE 1 ".$consd);
		$row_cusx = @mysqli_fetch_array($qu_cus);
		
		echo '|'.$row_cusx['fo_id'].'|'.$row_cusx['cd_name'].'|'.$chk;
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getsparpart'){
		$cd_name = $_REQUEST['pval'];
		if($cd_name != ""){
			$consd = "WHERE typespar != '2' AND (group_spar_id LIKE '%".$cd_name."%' OR group_name LIKE '%".$cd_name."%')";
		}
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_sparpart ".$consd." ORDER BY group_spar_id ASC");
		while($row_cusx = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_sparactive('<?php     echo $row_cusx['group_id'];?>','codes<?php     echo $_REQUEST['resdata']?>','listss<?php     echo $_REQUEST['resdata']?>','units<?php     echo $_REQUEST['resdata']?>','prices<?php echo $_REQUEST['resdata']?>','amounts<?php     echo $_REQUEST['resdata']?>','<?php echo $_REQUEST['resdata']?>','locations<?php echo $_REQUEST['resdata']?>');"><?php     echo $row_cusx['group_spar_id'].'&nbsp;&nbsp;'.$row_cusx['group_name'];?></A></td>
			  </tr>
			<?php    	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getsparactive'){
		$sparval = $_REQUEST['spid'];
		$ressdata = $_REQUEST['resdata'];
		$qu_spare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart  WHERE  group_id = '".$sparval."'");
		$row_spare = @mysqli_fetch_array($qu_spare);
		
		$selclist = "<select name=\"lists[]\" id=\"lists".$ressdata."\" class=\"inputselect\" style=\"width:92%\" onchange=\"showspare(this.value,'codes".$ressdata."','units".$ressdata."','prices".$ressdata."','amounts".$ressdata."','".$ressdata."','locations".$ressdata."')\">";
                	$qucgspare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE typespar != '2' ORDER BY group_name ASC");
					$selclist .= "<option value=\"\">กรุณาเลือกรายการอะไหล่</option>";

					while($row_spares = @mysqli_fetch_array($qucgspare)){
						$selclist .= "<option value=\"".$row_spares['group_id']."\"";
						if($sparval == $row_spares['group_id']){$selclist .= "selected=selected";}
						$selclist .= ">".$row_spares['group_name']."</option>";
					}
           $selclist .= "</select>";
		   
		//   $selclist = 'mkung';
		   
		$res_spares = "".'|'.$row_spare['group_spar_id'].'|'.$selclist.'|'.$row_spare['group_namecall'].'|'.$row_spare['group_price'].'|'.$row_spare['group_stock'].'|'.$row_spare['group_location'];
		echo $res_spares;
	}
	
	if($_GET['action'] == 'getspare'){
		$sparval = $_REQUEST['sval'];
		$qu_spare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart  WHERE  group_id = '".$sparval."'");
		$row_spare = @mysqli_fetch_array($qu_spare);
		$res_spare = " ".'|'.$row_spare['group_spar_id'].'|'.$row_spare['group_namecall'].'|'.$row_spare['group_price'].'|'.$row_spare['group_stock'].'|'.$row_spare['group_location'];
		echo $res_spare;
	}

?>

