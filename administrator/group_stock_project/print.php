<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";
Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");
if ($_GET["page"] == "") {$_REQUEST["page"] = 1;}
$param = get_param($a_param, $a_not_exists);

if ($_GET["action"] == "delete") {
    $code = Check_Permission($conn, $check_module, $_SESSION["login_id"], "delete");
    if ($code == "1") {
        $sql = "delete from $tbl_name  where $PK_field = '" . $_GET[$PK_field] . "'";
        @mysqli_query($conn, $sql);
        header("location:index.php");
    }
}
?>

<html>
	 <header>
		<style>
			.tbMain{
				width: 100%;
			}
			.tbMain tr{

			}
			.tbMain tr th{
				border: 1px solid #DDDDDD;
				padding: 5px;
			}
			.tbMain tr td{
				border: 1px solid #DDDDDD;
				padding: 5px;
			}
		</style>

		<script>
		function chkPrint(){
			setTimeout(function () { window.print(); }, 500);
			window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
		}
		</script>
	</header>
    <body onLoad="javascript:chkPrint();">

	<TABLE class="tbMain">
      <THEAD>
        <TR>
<!--          <TH width="4%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
		  <TH width="5%"><a>ลำดับ</a></TH>
          <TH width="11%"><a>รหัสสินค้า</a></TH>
          <TH width="18%"><a>ชื่อสินค้า</a></TH>
          <!-- <TH width="11%"><a>คงเหลือ</a></TH> -->
          <TH width="11%"><a>ขนาดสินค้า</a></TH>
          <TH width="11%"><a>รุ่น/แบรนด์</a></TH>
          <TH width="11%"><a>หมวดสินค้า</a></TH>
          <TH width="11%"><a>ราคาต้นทุนสินค้าโรงงาน/หน่วย</a></TH>
          <TH width="11%"><a>ราคาต้นทุนสินค้า/หน่วย</a></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php
//                    if($orderby=="") $orderby = $tbl_name.".group_spar_id";
//                    if ($sortby =="") $sortby ="ASC";
//
//                       $sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ";
//                    if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";
//                    if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";
//                     if ($_GET["keyword"] <> "") {
//                        $sql .= "and ( " .  $PK_field  . " like '%".$_GET["keyword"]."%' ";
//                        if (count ($search_key) > 0) {
//                            $search_text = " and ( " ;
//                            foreach ($search_key as $key=>$value) {
//                                    $subtext .= "or " . $value  . " like '%" . $_GET["keyword"] . "%'";
//                            }
//                        }
//                        $sql .=  $subtext . " ) ";
//                    }
//                    if ($orderby <> "") $sql .= " order by " . $orderby;
//                    if ($sortby <> "") $sql .= " " . $sortby;
//
//                    include ("../include/page_init.php");

if ($_GET['keyword']) {
    $keyWord = " AND (group_spar_id like '%" . $_GET['keyword'] . "%' OR group_name like '%" . $_GET['keyword'] . "%' OR group_size like '%" . $_GET['keyword'] . "%')";
}

$sql = 'select *,s_group_stock_project.create_date as c_date from s_group_stock_project where 1 ' . $keyWord . ' order by s_group_stock_project.group_spar_id ASC';

$query = @mysqli_query($conn, $sql);
if ($_GET["page"] == "") {
    $_GET["page"] = 1;
}

$counter = ($_GET["page"] - 1) * $pagesize;

while ($rec = @mysqli_fetch_array($query)) {
    $counter++;
    ?>
        <TR>
<!--          <TD><INPUT type=checkbox name="del[]" value="<?php echo $rec[$PK_field]; ?>" ></TD>-->
          <TD  style="text-align: center;"><span class="text" ><?php echo sprintf("%04d", $counter); ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php echo $rec["group_spar_id"]; ?></span></TD>
          <TD><span class="text"><?php echo $rec["group_name"]; ?></span></TD>
          <!-- <TD style="text-align: center;"><span class="text"><?php echo number_format($rec["group_stock"]); ?></span></TD> -->
		  <TD style="text-align: center;"><span class="text"><?php echo $rec["group_sn"]; ?></span></TD>
		  <TD style="text-align: center;"><span class="text"><?php echo $rec["group_size"]; ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php echo $rec["group_category"]; ?></span></TD>
          <TD style="text-align: right;"><span class="text"><?php echo number_format($rec["group_unit_price"], 2); ?></span></TD>
          <TD style="text-align: right;"><span class="text"><?php echo number_format($rec["group_price"], 2); ?></span></TD>

        </TR>
		<?php }?>
      </TBODY>
    </TABLE>
	</body>
</html>
