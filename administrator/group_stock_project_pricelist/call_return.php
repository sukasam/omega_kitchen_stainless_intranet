<?php
include_once "../../include/connect.php";

//header('Content-Type: text/html; charset=tis-620');

if ($_REQUEST['action'] === "chkProID") {

    $rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn, "SELECT * FROM s_group_stock_project WHERE group_spar_id ='" . $_GET['group_spar_id'] . "'"));

    if ($rowSpar['group_id']) {
        echo json_encode(array('status' => 'yes', 'group_id' => $rowSpar['group_id'], 'group_spar_id' => $rowSpar['group_spar_id'], 'group_name' => $rowSpar['group_name'], 'group_sn' => $rowSpar['group_sn'], 'group_category' => $rowSpar['group_category'], 'group_size' => $rowSpar['group_size'], 'group_unit_price' => $rowSpar['group_unit_price'], 'group_price' => $rowSpar['group_price'], 'group_namecall' => $rowSpar['group_namecall'], 'typespar' => $rowSpar['typespar']));
    } else {
        echo json_encode(array('status' => 'no'));
    }

}

if ($_REQUEST['action'] === "chkProName") {

    $rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn, "SELECT * FROM s_group_stock_project WHERE group_name LIKE '%" . $_GET['group_name'] . "%'"));

    if ($rowSpar['group_id']) {
        echo json_encode(array('status' => 'yes', 'group_id' => $rowSpar['group_id'], 'group_spar_id' => $rowSpar['group_spar_id'], 'group_name' => $rowSpar['group_name'], 'group_sn' => $rowSpar['group_sn'], 'group_category' => $rowSpar['group_category'], 'group_size' => $rowSpar['group_size'], 'group_unit_price' => $rowSpar['group_unit_price'], 'group_price' => $rowSpar['group_price'], 'group_namecall' => $rowSpar['group_namecall'], 'typespar' => $rowSpar['typespar']));
    } else {
        echo json_encode(array('status' => 'no'));
    }

}

if ($_REQUEST['action'] === "chkPrint") {

    $listPro = explode(',', base64_decode($_POST['spar_id']));
    $listProQTY = explode(',', base64_decode($_POST['spar_qty']));

    // if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
    //     $keyWord = " AND (group_spar_id like '%" . $_GET['keyword'] . "%' OR group_name like '%" . $_GET['keyword'] . "%' OR group_size like '%" . $_GET['keyword'] . "%')";
    // } else {
    //     $keyWord = '';
    // }

    $keyWord = "AND (";

    for ($i = 0; $i < count($listPro); $i++) {
        $keyWord .= "`group_spar_id` LIKE '%" . $listPro[$i] . "%' OR ";
    }

    $keyWord2 = substr($keyWord, 0, -3) . ")";

    $sql = 'select * from s_group_stock_project where 1=1 ' . $keyWord2 . ' order by s_group_stock_project.group_spar_id ASC';

    $query = @mysqli_query($conn, $sql);
    $counter = 0;
    $conHtml = '';
    $sumQTY = 0;
    $sumTotal = 0;
    while ($rec = @mysqli_fetch_array($query)) {

        if (in_array(trim($rec["group_spar_id"]), $listPro)) {

            // echo $rec["group_spar_id"];

            $counter++;

            if ($rec["group_unit_price"] !== '') {
                $group_unit_price = $rec["group_unit_price"];
            } else {
                $group_unit_price = 0.00;
            }
            if ($rec["group_price"] !== '') {
                $group_price = $rec["group_price"];
            } else {
                $group_price = 0.00;
            }

            $sumPrice = $group_price * $listProQTY[$counter - 1];
            $sumQTY += $listProQTY[$counter - 1];
            $sumTotal += $sumPrice;

            $conHtml .= '<TR>';
            $conHtml .= '	<TD  style="text-align: center;"><span class="text" >' . sprintf("%04d", $counter) . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_spar_id"] . '</span></TD>';
            $conHtml .= '	<TD><span class="text">' . $rec["group_name"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_sn"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_size"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_category"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: right;"><span class="text">' . number_format($group_price, 2) . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . number_format($listProQTY[$counter - 1]) . '</span></TD>';
            $conHtml .= '	<TD style="text-align: right;"><span class="text">' . number_format($sumPrice, 2) . '</span></TD>';
            $conHtml .= '</TR>';
        }
    }
    $conHtml .= '<TR>
                    <td colspan="4" style="border: none;"></td>
                    <td colspan="3"><strong>รวมเป็นเงิน</strong></td>
                    <td style="text-align: center;"><strong>' . number_format($sumQTY) . '</strong></td>
                    <td style="text-align: right;"><strong>' . number_format($sumTotal, 2) . '</strong></td>
                </TR>';
    echo $conHtml;
}
