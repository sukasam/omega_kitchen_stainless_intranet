<?php     
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST["page"] = 1;	}
	$param = get_param($a_param,$a_not_exists);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ค้าหาชื่อสินค้า</title>
<style type="text/css">
	.tv_search{
		font-size:12px;
		margin-top:10px;
	}
	.tv_search tr{
		
	}
	.tv_search tr th{ 
		font-weight:bold;
		text-align:left;
		padding-left:5px;
		padding-right:5px;
		padding-bottom:5px;
	}
	.tv_search tr td{
		padding:5px;
	}
	a{
		color:#000000;	
		outline:0;
		text-decoration:none;
	}
	a:hover{
		text-decoration:underline;
	}
	
</style>

<!--<script type="text/javascript">
	function get_customer(cid,cname){
		var sCustomerName = self.opener.document.getElementById("<?php     echo $_GET['pro']?>");
		sCustomerName.value = cname;
		window.close();
	}
</script>-->
<script type="text/javascript" src="ajax.js?v=2"></script> 
<script type="text/javascript">
   function get_customer(cid,cname,caddress,ctel,cfopj){


		self.opener.document.getElementById("sub_name").value = cname;
		self.opener.document.getElementById("sub_address").value = caddress;
		self.opener.document.getElementById("sub_tel").value = ctel;
		self.opener.document.getElementById("sub_billnum").value = cfopj;
		window.close();
	}
</script> 
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
  <tr>
    <td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_cus(this.value,'<?php echo $_GET['protype']?>');"/>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
<?php     

	$tableDB = 's_fopj';
	//echo "SELECT fo_id,cd_name,loc_name FROM ".$tableDB." WHERE 1 AND (status_use = '0') ORDER BY cd_name ASC";
  	$qu_cus = mysqli_query($conn,"SELECT * FROM ".$tableDB." WHERE 1 AND (status_use = '0') ORDER BY cd_name ASC");
	
	while($row_cus = @mysqli_fetch_array($qu_cus)){
		?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cus['fo_id'];?>','<?php echo $row_cus['cd_name'];?>','<?php echo $row_cus['cd_address'];?>','<?php echo $row_cus['cd_tel'];?>','<?php echo $row_cus['fs_id'];?>');"><?php echo $row_cus['cd_name'];?> (<?php echo $row_cus['loc_name']?>)</A></td>
          </tr>
		<?php    	
	}
  ?>
</table>

</body>
</html>