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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo $s_title; ?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check_select(frm){
		if (frm.choose_action.value==""){
			alert ('Choose an action');
			frm.choose_action.focus(); return false;
		}
}
function addRemovePro(id,type){
  //console.log("ID:"+id);
  const selectPro = JSON.parse(sessionStorage.getItem('selectPro'));

  //{ id:"string 1", qty: "1" }

  var proValue = selectPro.filter(obj=>obj.id===id);

  // console.log(proValue);

  if(type === "pro"){
    if(proValue.length == 1){

    // get index of object with id:37
    var removeIndex = selectPro.map(function(item) { return item.id; }).indexOf(id);
    // remove object
    selectPro.splice(removeIndex, 1);
      $("#qty_"+id).addClass('hide');
      $("#qty_"+id).val('0');
    }else{
      selectPro.push({id:id,qty:"0"});
      $("#qty_"+id).removeClass('hide');
    }
    sessionStorage.setItem('selectPro',JSON.stringify(selectPro));

  }else{
    var objIndex = selectPro.findIndex((obj => obj.id == id));
    if($("#qty_"+id).val().length >= 1){
      selectPro[objIndex].qty = $("#qty_"+id).val();
      sessionStorage.setItem('selectPro',JSON.stringify(selectPro));
    }else{
      selectPro[objIndex].qty = "0";
      sessionStorage.setItem('selectPro',JSON.stringify(selectPro));
    }
  }

  if(selectPro.length >= 1){
    $("#btPrint").removeClass('hide');
  }else{
    $("#btPrint").addClass('hide');
  }

}
function clearSessionStorage(){
  var product = [];
    sessionStorage.setItem('selectPro',JSON.stringify(product));
    sessionStorage.setItem('comment','');
    window.location="index.php";
}
function keyComment(){
  sessionStorage.setItem('comment',$("#comment").val());
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
    function(m,key,value) {
      vars[key] = value;
    });
    return vars;
  }

function checkSelectPro(){
  const selectPro = JSON.parse(sessionStorage.getItem('selectPro'));
  var spar_id = [];
  var spar_qty = [];
  for(var i=0;i<selectPro.length;i++){
    if(document.getElementById("chk_"+selectPro[i]['id']) != null){
    document.getElementById("chk_"+selectPro[i]['id']).checked = true;
    document.getElementById("qty_"+selectPro[i]['id']).value = selectPro[i]['qty'];
    document.getElementById("qty_"+selectPro[i]['id']).classList.remove("hide");
    }
  }

  document.getElementById("comment").value = sessionStorage.getItem('comment');

  if(selectPro.length >= 1){
    $("#btPrint").removeClass('hide');
  }else{
    $("#btPrint").addClass('hide');
  }
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
</HEAD>
<?php include "../../include/function_script.php";?>
<BODY onload="checkSelectPro()">
<DIV id=body-wrapper>
<?php include "../left.php";?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php include '../top.php';?>
<P id=page-intro><?php echo $check_module; ?></P>

<UL class=shortcut-buttons-set>
<LI><A class=shortcut-button href="../fo-pj/"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>

  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php echo $page_name; ?></H3>
<br><form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php echo $keyword; ?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php
$a_not_exists = array('keyword');
$param2 = get_param($a_param, $a_not_exists);
?>
    <a href="index.php">แสดงทั้งหมด</a>
    <?php
/*$a_not_exists = array();
post_param($a_param,$a_not_exists);*/
?>
  </form>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
  <div id="btPrint" class="hide" style="float: right;width: 20%;margin-top: 30px;">
    	<center style="margin-bottom: 10px;"><a href="print.php?keyword=<?php echo $_GET['keyword']; ?>" target="_blank"><input class=button name="btprint" type="button" value="พิมพ์รายการสินค้า" style="width: 120px;"></a></center>
      <center><input class=button name="btclear" id="btclear" type="button" value="เริ่มต้นใหม่" onclick="clearSessionStorage();" style="width: 120px;"></center>
    </div>
  <div style="margin-bottom: 10px;font-size: 20px;line-height: 30px;width: 80%;"><strong>หมายเหตุ :</strong> <textarea id="comment" name="comment" onkeyup="keyComment()" style="padding: 10px;font-size: 20px;"></textarea></div>
    <TABLE class="tbMain">
      <THEAD>
        <TR>
<!--          <TH width="4%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
          <TH width="5%"><a>ลำดับ</a></TH>
          <TH width="5%"><a>เลือก</a></TH>
          <TH width="10%"><a>รหัสสินค้า</a></TH>
          <TH width="18%" ><a>ชื่อสินค้า</a></TH>
          <!-- <TH width="10%"><a>คงเหลือ</a></TH> -->
          <TH width="10%"><a>รุ่น/แบรนด์</a></TH>
          <TH width="10%"><a>ขนาดสินค้า</a></TH>
          <TH width="10%"><a>หมวดสินค้า</a></TH>
          <!-- <TH width="10%"><a>ราคาต้นทุนสินค้าโรงงาน/หน่วย</a></TH> -->
          <TH width="10%"><a>ราคาสินค้า/หน่วย</a></TH>
          <TH width="10%"><a>จำนวน</a></TH>
<!--          <TH width="12%"><a>ราคาขาย</a></TH>-->
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php
if ($orderby == "") {
    $orderby = $tbl_name . ".group_spar_id";
}

if ($sortby == "") {
    $sortby = "ASC";
}

$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ";
if ($_GET[$PK_field] != "") {
    $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";
}

if ($_GET[$FR_field] != "") {
    $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";
}

if ($_GET["keyword"] != "") {
    $sql .= "and ( " . $PK_field . " like '%" . $_GET["keyword"] . "%' ";
    if (count($search_key) > 0) {
        $search_text = " and ( ";
        foreach ($search_key as $key => $value) {
            $subtext .= "or " . $value . " like '%" . $_GET["keyword"] . "%'";
        }
    }
    $sql .= $subtext . " ) ";
}
if ($orderby != "") {
    $sql .= " order by " . $orderby;
}

if ($sortby != "") {
    $sql .= " " . $sortby;
}

include "../include/page_init.php";
//echo $sql;
$query = @mysqli_query($conn, $sql);
if ($_GET["page"] == "") {
    $_GET["page"] = 1;
}

$counter = ($_GET["page"] - 1) * $pagesize;

while ($rec = @mysqli_fetch_array($query)) {
    $counter++;
    ?>
        <TR>
          <TD><span class="text"><?php echo sprintf("%04d", $counter); ?></span></TD>
          <TD style="text-align: center;"><span class="text"><input type='checkbox' id="chk_<?php echo trim($rec["group_spar_id"]); ?>" onclick="addRemovePro('<?php echo trim($rec["group_spar_id"]); ?>','pro')" value='<?php echo trim($rec["group_spar_id"]); ?>'/></span></TD>
          <TD style="text-align: center;"><span class="text"><?php echo $rec["group_spar_id"]; ?></span></TD>
          <TD><span class="text"><?php echo $rec["group_name"]; ?></span></TD>
          <!-- <TD style="text-align: center;"><span class="text"><?php echo number_format($rec["group_stock"]); ?></span></TD> -->
          <TD><span class="text"><?php echo $rec["group_sn"]; ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php echo $rec["group_size"]; ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php echo $rec["group_category"]; ?></span></TD>
          <!-- <TD style="text-align: right;"><span class="text"><?php echo number_format($rec["group_unit_price"], 2); ?></span></TD> -->
          <TD style="text-align: right;"><span class="text"><?php echo number_format($rec["group_price"], 2); ?></span></TD>
          <TD style="text-align: center;"><span class="text"><input type='text' class="hide" onKeyup="addRemovePro('<?php echo trim($rec["group_spar_id"]); ?>','qty')" id="qty_<?php echo trim($rec["group_spar_id"]); ?>" value='0' style="text-align: center;width: 50px;" onkeypress="return isNumberKey(event)"/></span></TD>
        </TR>
		<?php }?>
      </TBODY>
    </TABLE>
    <br><br>

    <DIV class="bulk-actions align-left">
<!--
            <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>

            <?php
$a_not_exists = array();
post_param($a_param, $a_not_exists);
?>
            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง">-->
          </DIV> <DIV class=pagination> <?php include "../include/page_show.php";?> </DIV>
  </form>
</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php include "../footer.php";?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>
