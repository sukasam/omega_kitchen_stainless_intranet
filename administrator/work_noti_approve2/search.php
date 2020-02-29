<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}
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
	function get_customer(cid){

		var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcusDetail&cus_id='+cid;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
			self.opener.document.getElementById('cd_name').value = ds[1];
			self.opener.document.getElementById('cd_address').value = ds[2];
			self.opener.document.getElementById('cd_province').innerHTML = ds[3];
			self.opener.document.getElementById('cd_contact').value = ds[4];
			self.opener.document.getElementById('cd_mobile').value = ds[5];
			self.opener.document.getElementById('loc_name').value = ds[6];
			self.opener.document.getElementById('loc_address').value = ds[7];
			self.opener.document.getElementById('sale_contact').innerHTML = ds[8];
			self.opener.document.getElementById('sale_tel').value = ds[9];
			self.opener.document.getElementById('cd_position').value = '';
			self.opener.document.getElementById('cd_line').value = '';
			self.opener.document.getElementById('cd_tel').value = '';
			self.opener.document.getElementById('cd_email').value = '';
			window.close();
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);

		// var sCustomerName = self.opener.document.getElementById("cd_names");
		// sCustomerName.value = cname;
		// self.opener.checkfirstorder(cid,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist','sr_ctype2','loc_clean','garunM','garunF','garunT');
		// self.opener.document.getElementById("rsnameid").innerHTML="<input type=\"hidden\" name=\"cus_id\" value=\""+cid+"\">";
		// window.close();
	}
</script>
<script type="text/javascript" src="ajax.js"></script> 
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
  <tr>
    <td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_cus(this.value);"/>
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
	//echo "SELECT fo_id,cd_name,loc_name FROM s_fopj WHERE 1 AND (status_use = '1') ORDER BY cd_name ASC";
  	$qu_cus = @mysqli_query($conn,"SELECT fo_id,cd_name,loc_name FROM s_fopj WHERE 1 AND (status_use = '0') ORDER BY cd_name ASC");
	while($row_cus = @mysqli_fetch_array($qu_cus)){
		?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_customer('<?php  echo $row_cus['fo_id'];?>')"><?php  echo $row_cus['cd_name'];?> (<?php  echo $row_cus['loc_name']?>)</A></td>
          </tr>
		<?php 	
	}
  ?>
</table>

</body>
</html>