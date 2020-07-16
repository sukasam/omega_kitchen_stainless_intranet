<?php
include_once "../../include/aplication_top.php";
header("Content-type: text/html; charset=utf8");
header("Cache-Control: no-cache, must-revalidate");
@mysqli_query($conn, "SET NAMES  UTF8");

if ($_GET['action'] == 'getcus') {
    $cd_name = $_REQUEST['pval'];
    $keys = $_REQUEST['keys'];
    if ($cd_name != "") {
        $consd = "WHERE 1 AND (group_spar_id LIKE '%" . $cd_name . "%' OR group_name LIKE '%" . $cd_name . "%')";
    }
    $qu_cus = mysqli_query($conn, "SELECT * FROM s_group_sparpart " . $consd . " ORDER BY group_name ASC");
    while ($row_cus = @mysqli_fetch_array($qu_cus)) {
        ?>
<tr>
    <td><A href="javascript:void(0);"
            onclick="get_product('<?php echo $row_cus['group_id']; ?>','<?php echo $row_cus['group_name']; ?>','<?php echo "cpro_ecip"; ?>');"><?php echo $row_cus['group_spar_id'] . " | " . $row_cus['group_name']; ?></A>
    </td>
</tr>
<?php
}
    //echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
}

if ($_GET['action'] == 'getcuss') {
    $cd_name = $_REQUEST['pval'];
    if ($cd_name != "") {
        $consd = "WHERE 1 AND (cd_name LIKE '%" . $cd_name . "%' OR cusid LIKE '%" . $cd_name . "%' OR loc_name LIKE '%" . $cd_name . "%')";
    }
    $qu_cus = mysqli_query($conn, "SELECT fo_id,cd_name,loc_name,cusid FROM s_fopj " . $consd . " ORDER BY cd_name ASC");
    while ($row_cus = @mysqli_fetch_array($qu_cus)) {
        ?>
<tr>
    <td><A href="javascript:void(0);"
            onclick="get_customer('<?php echo $row_cus['fo_id']; ?>','<?php echo $row_cus['loc_name']; ?>');"><?php if (!empty($row_cus['cusid'])) {echo $row_cus['cusid'] . " | ";}?><?php echo $row_cus['cd_name'] . " ( " . $row_cus['loc_name'] . " )"; ?></A>
    </td>
</tr>
<?php
}
    //echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
}

if ($_GET['action'] == 'getcussID') {
    $cusid = $_REQUEST['pval'];
    if ($cusid != "") {
        $consd = " AND cusid LIKE '%" . $cusid . "%' GROUP BY cusid ORDER BY cusid ASC";
    }
    $qu_cus = mysqli_query($conn, "SELECT cd_name,loc_name,cusid FROM s_first_order WHERE separate = 0 " . $consd);
    while ($row_cus = @mysqli_fetch_array($qu_cus)) {
        ?>
<tr>
    <td><A href="javascript:void(0);"
            onclick="get_customer('<?php echo $row_cus['cusid']; ?>','<?php echo $row_cus['cusid']; ?>');"><?php echo "<strong>" . $row_cus['cusid'] . "</strong> " . $row_cus['cd_name']; ?></A>
    </td>
</tr>
<?php
}
    //echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
}

if ($_GET['action'] == 'getcusst') {
    $cd_name = $_REQUEST['pval'];
    if ($cd_name != "") {
        $consd = "WHERE cd_name LIKE '%" . $cd_name . "%'";
    }
    $qu_cus = mysqli_query($conn, "SELECT cd_name,loc_name FROM s_first_order " . $consd . " ORDER BY cd_name ASC");
    while ($row_cus = @mysqli_fetch_array($qu_cus)) {
        ?>
<tr>
    <td><A href="javascript:void(0);"
            onclick="get_customer('<?php echo $row_cus['fo_id']; ?>','<?php echo $row_cus['cd_name']; ?>');"><?php echo $row_cus['cd_name'] . " ( " . $row_cus['loc_name'] . " )"; ?></A>
    </td>
</tr>
<?php
}
    //echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
}

if ($_GET['action'] == 'getpodkey') {
    $cd_name = iconv('UTF-8', 'TIS-620', $_REQUEST['pval']);
    $keys = $_REQUEST['keys'];
    if ($cd_name != "") {
        $consd = "WHERE group_name LIKE '%" . $cd_name . "%'";
    }
    //echo "SELECT group_name FROM s_group_typeproduct ".$consd." ORDER BY group_name ASC";
    $qu_cus = mysqli_query($conn, "SELECT * FROM s_group_pod " . $consd . " ORDER BY group_name ASC");
    while ($row_cus = @mysqli_fetch_array($qu_cus)) {
        ?>
<tr>
    <td><A href="javascript:void(0);"
            onclick="get_pod('<?php echo $row_cus['group_id']; ?>','<?php echo $row_cus['group_name']; ?>','<?php echo $keys; ?>');"><?php echo $row_cus['group_name']; ?></A>
    </td>
</tr>
<?php
}
    //echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
}

if ($_GET['action'] == 'getpod') {
    $group_id = $_REQUEST['group_id'];
    $group_name = $_REQUEST['group_name'];
    $protype = $_REQUEST['protype'];

    $qupros1 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
    while ($row_qupros1 = @mysqli_fetch_array($qupros1)) {
        ?>
<option value="<?php echo $row_qupros1['group_name']; ?>" <?php if ($group_id == $row_qupros1['group_id']) {
            echo 'selected';
        }?>><?php echo $row_qupros1['group_name']; ?></option>
<?php
}

    //echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
}

if ($_GET["action"] == 'getprotype2') {
    $group_id = $_REQUEST['group_id'];
    $group_name = $_REQUEST['group_name'];
    $protype = $_REQUEST['protype'];

    $qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart WHERE group_id = '" . $group_id . "'");
    $row_qupro1 = @mysqli_fetch_array($qupro1);
    echo "|" . $row_qupro1['group_id'] . "|" . $row_qupro1['group_spar_id'] . "|" . $row_qupro1['group_name'];
}

if ($_GET["action"] == 'getProductS') {
    $cd_name = $_REQUEST['pval'];
    $keys = $_REQUEST['keys'];
    if ($cd_name != "") {
        $consd = "WHERE 1 AND (group_spar_id LIKE '%" . $cd_name . "%' OR group_name LIKE '%" . $cd_name . "%')";
    }
    $qu_cus = @mysqli_query($conn, "SELECT * FROM s_group_sparpart " . $consd . " ORDER BY group_name ASC");
    while ($row_cus = @mysqli_fetch_array($qu_cus)) {
        ?>
<tr>
    <td><A href="javascript:void(0);"
            onclick="get_product2('<?php echo $row_cus['group_id']; ?>','<?php echo $row_cus['group_name']; ?>','<?php echo "cpro_ecip"; ?>');"><?php echo $row_cus['group_spar_id'] . " | " . $row_cus['group_name']; ?></A>
    </td>
</tr>
<?php
}
    //echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
}

if ($_GET['action'] == 'getspar') {
    $group_id = $_REQUEST['group_id'];
    $group_name = $_REQUEST['group_name'];
    $protype = $_REQUEST['protype'];
    $ccode = $_REQUEST['ccode'];

    $qupros1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
    ?>
<option value="">กรุณาเลือกรายการอะไหล่</option>
<?php
while ($row_qupros1 = @mysqli_fetch_array($qupros1)) {
        ?>
<option value="<?php echo $row_qupros1['group_id']; ?>" <?php if ($group_id == $row_qupros1['group_id']) {
            echo 'selected';
        }?>><?php echo $row_qupros1['group_spar_id'] . " | " . $row_qupros1['group_name']; ?></option>
<?php
}

    //echo "|".$row_qupros1['group_spar_id'];
    //echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
}

if ($_GET['action'] == 'getsparkey') {
    //$cd_name = iconv('UTF-8', 'TIS-620', $_REQUEST['pval']);
    $cd_name = $_REQUEST['pval'];
    //echo $cd_name;
    $keys = $_REQUEST['protype'];
    $ccode = $_REQUEST['ccode'];
    if ($cd_name != "") {
        $consd = "WHERE group_name LIKE '%" . $cd_name . "%' OR group_spar_id LIKE '%" . $cd_name . "%'";
    }
    //echo "SELECT group_name FROM s_group_sparpart ".$consd." ORDER BY group_name ASC";
    $qu_cus = mysqli_query($conn, "SELECT * FROM s_group_sparpart " . $consd . " ORDER BY group_name ASC");
    while ($row_cus = @mysqli_fetch_array($qu_cus)) {
        $row_cus['group_name'] = str_replace("'", "", $row_cus['group_name']);
        $row_cus['group_name'] = str_replace('"', "", $row_cus['group_name']);
        ?>
<tr>
    <td><A href="javascript:void(0);"
            onclick="get_spar('<?php echo $row_cus['group_id']; ?>','<?php echo $row_cus['group_name']; ?>','<?php echo $keys; ?>','<?php echo $ccode; ?>','<?php echo $row_cus['group_spar_id']; ?>');"><?php echo $row_cus['group_spar_id'] . " | " . $row_cus['group_name']; ?></A>
    </td>
</tr>
<?php
}
    //echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
}
?>