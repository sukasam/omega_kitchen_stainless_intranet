<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";
Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");
if ($_GET["page"] == "") {$_REQUEST["page"] = 1;}
$param = get_param($a_param, $a_not_exists);

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
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
		<script>
		function chkPrint(){
      var keyword = getUrlVars()["keyword"];
      const selectPro = JSON.parse(sessionStorage.getItem('selectPro'));
      const comment = sessionStorage.getItem('comment');
      $("#comment").html(comment);

      var spar_id = [];
      var spar_qty = [];
      for(var i=0;i<selectPro.length;i++){
        spar_id.push(selectPro[i]['id']);
        spar_qty.push(selectPro[i]['qty']);
      }

      var dataPost = {
        "action":"chkPrint",
        "spar_id":window.btoa(spar_id),
        "spar_qty":window.btoa(spar_qty),
        "keyword":keyword,
      }
      $.ajax({
					type: "POST",
					url: "call_return.php",
          data: dataPost,
					success: function(data){
						$("#contentPro").html(data);
            	setTimeout(function () { window.print(); }, 500);
			        window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
					}
				});


		}

    function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
    function(m,key,value) {
      vars[key] = value;
    });
    return vars;
  }
		</script>
	</header>
    <body onLoad="javascript:chkPrint();">
    <div style="margin-bottom: 10px;margin-top: 50px;float: left;"><strong>หมายเหตุ :</strong> <span id="comment"></span></div>
    <div style="float: right;margin-bottom: 20px;"><img src="../images/template/logo_main.png" width="260" height="121" border="0" alt=""></div>
	<TABLE class="tbMain">
      <THEAD>
        <TR>
<!--          <TH width="4%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
		  <TH width="5%"><a>ลำดับ</a></TH>
          <TH width="11%"><a>รหัสสินค้า</a></TH>
          <TH width="19%"><a>ชื่อสินค้า</a></TH>
          <!-- <TH width="11%"><a>คงเหลือ</a></TH> -->
          <TH width="11%"><a>ขนาดสินค้า</a></TH>
          <TH width="11%"><a>รุ่น/แบรนด์</a></TH>
          <TH width="11%"><a>หมวดสินค้า</a></TH>
          <!-- <TH width="11%"><a>ราคาต้นทุนสินค้าโรงงาน/หน่วย</a></TH> -->
          <TH width="11%"><a>ราคาต้นทุนสินค้า/หน่วย</a></TH>
          <TH width="11%"><a>จำนวน</a></TH>
          <TH width="11%"><a>รวมเป็นเงิน</a></TH>
        </TR>
      </THEAD>
      <TBODY id="contentPro">

      </TBODY>
      <TFOOT>
        </TFOOT>
    </TABLE>
    <div>ซื่อ : <?php echo $_SESSION["fullname"]; ?> (ผู้ที่เข้าระบบ)</div>
	</body>
</html>
