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
<title>ค้าหาชื่อร้าน-ชื่อบริษัท</title>
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

<script type="text/javascript">
	function get_customer(cid,cname,chk){
		/*alert(cid);
		alert(cname);*/
		var sCustomerName = self.opener.document.getElementById("cd_names");
		
		sCustomerName.value = cname;
		
		var sCustomerSource = self.opener.document.getElementById("cus_source");
		
		sCustomerSource.value = chk;
		self.opener.checkfirstorder(cid,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist','sr_ctype2',chk);
		self.opener.document.getElementById("rsnameid").innerHTML="<input type=\"hidden\" name=\"cus_id\" value=\""+cid+"\">";
		window.close();
	}
</script>

<script language="javascript">
function checkVal(c){
//		if( document.form1.tmp.value == c.value)
//		{
//			alert('Checked already!');
//		}
//		else
//		{
//			document.form1.tmp.value = c.value;
//		}
	document.form1.tmp.value = c.value;
	window.location='search.php?chk='+c.value;
}
</script>
<script type="text/javascript" src="ajax.js"></script> 
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
 <tr>
    <td colspan="2">
     <form action="search.php" method="post" name="form1">
      <input type="hidden" name="tmp" value="<?php echo $_GET['chk'];?>">
      <input type="radio" name="cusSource" value="fo" <?php if($_GET['chk'] == "fo" || !isset($_GET['chk'])){echo 'checked';}?> Onclick="checkVal(this)"> First Order&nbsp;&nbsp;&nbsp;
	  <input type="radio" name="cusSource" value="po" <?php if($_GET['chk'] == "po"){echo 'checked';}?> Onclick="checkVal(this)"> Project Order
	  </form>
    </td>
  </tr>
  <tr>
    <td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_cus(this.value,'<?php echo $_GET['chk'];?>');"/>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
<tr>
    <th width="50%">ชื่อร้าน-ชื่อบริษัท</th>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
<?php     
	$tableDB = '';
	if($_GET['chk'] == "po"){
		$tableDB = 's_project_order';
	}else{
		$tableDB = 's_first_order';
		
	}
  	$qu_cus = mysqli_query($conn,"SELECT fo_id,cd_name,loc_name FROM ".$tableDB." WHERE (status_use = '3' or status_use = '0') ORDER BY cd_name ASC");
	
	while($row_cus = @mysqli_fetch_array($qu_cus)){
		?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cus['fo_id'];?>','<?php     echo $row_cus['cd_name'];?>','<?php echo $_GET['chk'];?>');"><?php echo $row_cus['cd_name'];?> (<?php echo $row_cus['loc_name']?>)</A></td>
          </tr>
		<?php    	
	}
  ?>
</table>

</body>
</html>