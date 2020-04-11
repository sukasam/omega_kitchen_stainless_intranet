<?php  
	include_once("../../include/connect.php");
	
	if($_GET['action'] === "chkProject"){
		
		$group_id = $_REQUEST['group_id'];
		$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_stock_project WHERE group_id ='".$group_id."'"));
		
		if($rowSpar['group_id']){
			echo json_encode(array('status' => 'yes','group_id'=> $rowSpar['group_id'],'group_spar_id'=> $rowSpar['group_spar_id'],'group_name'=> $rowSpar['group_name'],'group_size'=> $rowSpar['group_size'],'group_sn'=> $rowSpar['group_sn'],'group_price'=> $rowSpar['group_price']));
		}else{
			echo json_encode(array('status' => 'no'));
		}
		
	}
?>