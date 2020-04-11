<?php
    include ("../../include/config.php");
    include ("../../include/connect.php");
    include ("../../include/function.php");

    if($_POST['action'] === "getSaleMobile"){

        $sqlSale = "SELECT * FROM `s_group_sale` WHERE `group_id` = '".$_POST['sale_contact']."' LIMIT 1";
        $quSale = mysqli_query($conn,$sqlSale);
        $rowSale = mysqli_fetch_array($quSale, MYSQLI_ASSOC);
        
        echo $rowSale['group_tel'];
    }
?>