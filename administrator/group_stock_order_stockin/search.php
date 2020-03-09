<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
include("config.php");
Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");
if ($_GET["page"] == "") {
	$_REQUEST["page"] = 1;
}
$param = get_param($a_param, $a_not_exists);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ค้าหาชื่อสินค้า</title>
	<style type="text/css">
		.tv_search {
			font-size: 12px;
			margin-top: 10px;
		}

		.tv_search tr {}

		.tv_search tr th {
			font-weight: bold;
			text-align: left;
			padding-left: 5px;
			padding-right: 5px;
			padding-bottom: 5px;
		}

		.tv_search tr td {
			padding: 5px;
		}

		a {
			color: #000000;
			outline: 0;
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}
	</style>

	<!--<script type="text/javascript">
	function get_customer(cid,cname){
		var sCustomerName = self.opener.document.getElementById("<?php echo $_GET['pro'] ?>");
		sCustomerName.value = cname;
		window.close();
	}
</script>-->
	<script type="text/javascript" src="ajax.js?v=2"></script>
	<script type="text/javascript">
		function get_customer(cid, cname, caddress, ctel, cfopj, qcid, qcnumber) {

			var xmlHttp;
			xmlHttp = GetXmlHttpObject(); //Check Support Brownser
			URL = pathLocal + 'ajax_return.php?action=getcusDetail&qcid=' + qcid;
			if (xmlHttp == null) {
				alert("Browser does not support HTTP Request");
				return;
			}
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					
					self.opener.document.getElementById("sub_name").value = cname;
					self.opener.document.getElementById("sub_address").value = caddress;
					self.opener.document.getElementById("sub_tel").value = ctel;
					self.opener.document.getElementById("sub_billnum").value = cfopj;
					self.opener.document.getElementById("qc_id").value = qcid;
					self.opener.document.getElementById("qc_number").innerHTML = qcnumber;
					self.opener.document.getElementById("exp").innerHTML = xmlHttp.responseText;
					window.close();

				} else {
					//document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
				}
			};
			xmlHttp.open("GET", URL, true);
			xmlHttp.send(null);

		}
	</script>
</head>

<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
		<tr>
			<td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
				<input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_cus(this.value,'<?php echo $_GET['protype'] ?>');" />
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
		<?php

		$tableDB = 's_qc_product as qc , s_fopj as fo';
		//echo "SELECT fo.fo_id,fo.cd_name,fo.cd_address,fo.cd_tel,fo.fs_id,fo.loc_name,qc.* FROM ".$tableDB." WHERE fo.fo_id = qc.cus_id AND (qc.approve = '1') ORDER BY qc.sr_id ASC";
		$qu_cus = mysqli_query($conn, "SELECT fo.fo_id,fo.cd_name,fo.cd_address,fo.cd_tel,fo.fs_id,fo.loc_name,qc.* FROM " . $tableDB . " WHERE fo.fo_id = qc.cus_id AND (qc.approve = '1') ORDER BY qc.sr_id DESC");

		while ($row_cus = @mysqli_fetch_array($qu_cus)) {
			if(checkQC($conn,$row_cus['sr_id'])){
		?>
			<tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cus['fo_id']; ?>','<?php echo $row_cus['cd_name']; ?>','<?php echo $row_cus['cd_address']; ?>','<?php echo $row_cus['cd_tel']; ?>','<?php echo $row_cus['fs_id']; ?>','<?php echo $row_cus['sr_id']; ?>','<?php echo $row_cus['sv_id']; ?>');"><?php echo $row_cus['sv_id'] . " | " . $row_cus['cd_name']; ?> (<?php echo $row_cus['loc_name'] ?>)</A></td>
			</tr>
		<?php
			}
		}
		?>
	</table>

</body>

</html>