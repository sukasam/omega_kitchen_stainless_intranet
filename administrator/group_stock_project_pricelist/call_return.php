<?php
include_once "../../include/connect.php";

//header('Content-Type: text/html; charset=tis-620');

if ($_GET['action'] === "chkProID") {

    $rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn, "SELECT * FROM s_group_stock_project WHERE group_spar_id ='" . $_GET['group_spar_id'] . "'"));

    if ($rowSpar['group_id']) {
        echo json_encode(array('status' => 'yes', 'group_id' => $rowSpar['group_id'], 'group_spar_id' => $rowSpar['group_spar_id'], 'group_name' => $rowSpar['group_name'], 'group_sn' => $rowSpar['group_sn'], 'group_category' => $rowSpar['group_category'], 'group_size' => $rowSpar['group_size'], 'group_unit_price' => $rowSpar['group_unit_price'], 'group_price' => $rowSpar['group_price'], 'group_namecall' => $rowSpar['group_namecall'], 'typespar' => $rowSpar['typespar']));
    } else {
        echo json_encode(array('status' => 'no'));
    }

}

if ($_GET['action'] === "chkProName") {

    $rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn, "SELECT * FROM s_group_stock_project WHERE group_name LIKE '%" . $_GET['group_name'] . "%'"));

    if ($rowSpar['group_id']) {
        echo json_encode(array('status' => 'yes', 'group_id' => $rowSpar['group_id'], 'group_spar_id' => $rowSpar['group_spar_id'], 'group_name' => $rowSpar['group_name'], 'group_sn' => $rowSpar['group_sn'], 'group_category' => $rowSpar['group_category'], 'group_size' => $rowSpar['group_size'], 'group_unit_price' => $rowSpar['group_unit_price'], 'group_price' => $rowSpar['group_price'], 'group_namecall' => $rowSpar['group_namecall'], 'typespar' => $rowSpar['typespar']));
    } else {
        echo json_encode(array('status' => 'no'));
    }

}

if ($_GET['action'] === "chkPrint") {
    $listPro = explode(',', base64_decode($_GET['spar_id']));

    if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
        $keyWord = " AND (group_spar_id like '%" . $_GET['keyword'] . "%' OR group_name like '%" . $_GET['keyword'] . "%' OR group_size like '%" . $_GET['keyword'] . "%')";
    } else {
        $keyWord = '';
    }

    $sql = 'select *,s_group_stock_project.create_date as c_date from s_group_stock_project where 1 ' . $keyWord . ' order by s_group_stock_project.group_spar_id ASC';

    $query = @mysqli_query($conn, $sql);
    $counter = 0;
    $conHtml = '';
    while ($rec = @mysqli_fetch_array($query)) {
        if (in_array($rec["group_spar_id"], $listPro)) {

            if ($rec["group_unit_price"] !== '') {
                $group_unit_price = number_format($rec["group_unit_price"], 2);
            } else {
                $group_unit_price = 0.00;
            }
            if ($rec["group_price"] !== '') {
                $group_price = number_format($rec["group_price"], 2);
            } else {
                $group_price = 0.00;
            }

            $counter++;
            $conHtml .= '<TR>';
            $conHtml .= '	<TD  style="text-align: center;"><span class="text" >' . sprintf("%04d", $counter) . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_spar_id"] . '</span></TD>';
            $conHtml .= '	<TD><span class="text">' . $rec["group_name"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_sn"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_size"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: center;"><span class="text">' . $rec["group_category"] . '</span></TD>';
            $conHtml .= '	<TD style="text-align: right;"><span class="text">' . $group_unit_price . '</span></TD>';
            $conHtml .= '	<TD style="text-align: right;"><span class="text">' . $group_price . '</span></TD>';
            $conHtml .= '</TR>';
        }
    }
    echo $conHtml;
}
