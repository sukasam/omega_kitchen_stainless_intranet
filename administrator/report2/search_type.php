<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";
Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");
if ($_GET["page"] == "") {$_REQUEST["page"] = 1;}
$param = get_param($a_param, $a_not_exists);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ค้าหาชนิดสินค้า</title>
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
	function get_typespare(cname){
		var sCustomerName = self.opener.document.getElementById("type_name");
		sCustomerName.value = cname;
		// alert(cid);
		window.close();
	}
</script>
<script type="text/javascript" src="ajax.js"></script>
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
  <tr>
    <td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="getTypeSpare(this.value);"/>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
<tr>
    <th width="50%">ค้นหาชนิดสินค้า</th>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
<?php
$qu_cus = get_type_spare($conn);
while ($row_cus = @mysqli_fetch_array($qu_cus)) {
    ?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_typespare('<?php echo $row_cus['group_type']; ?>');"><?php echo $row_cus['group_type']; ?></A></td>
          </tr>
		<?php
}
?>
</table>

</body>
</html>