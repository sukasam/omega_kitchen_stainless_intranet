<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");

$qu = mysqli_query($conn, "SELECT * FROM s_service_report2sub WHERE 1 ORDER BY r_id DESC");

while ($row = mysqli_fetch_array($qu)) {

    $rowSD = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM s_group_sparpart WHERE group_id = '" . $row['lists'] . "' ORDER BY group_id DESC"));
    //echo $row['lists'] . '=>' . $rowSD['group_name'] . '=>' . $rowSD['group_unit_price'];
    mysqli_query($conn, "UPDATE `s_service_report2sub` SET `prices` = '" . $rowSD['group_unit_price'] . "' WHERE `s_service_report2sub`.`r_id` = '" . $row['r_id'] . "';");
    //exit();
}

echo "Done";