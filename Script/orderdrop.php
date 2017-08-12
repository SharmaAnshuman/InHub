<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        $ordId= $_REQUEST["ordid"];
        $pId= $_REQUEST["pid"];
        $reason=$_REQUEST["reason"];
        if($_REQUEST["tt"]==="1")
        {
            if(isset($_REQUEST["o"]))
            {
                $q= "UPDATE `order` SET `status`='Cancel BY Seller',`reason`='$reason' WHERE `id`='$ordId' and `pid`='$pId'";
            }
            else
            {
                $q= "UPDATE `order` SET `status`='Cancel',`reason`='$reason' WHERE `id`='$ordId' and `pid`='$pId'";
            }
        mysql_query($q);
        }
        if($_REQUEST["tt"]==="2")
        {
        $q= "UPDATE `order` SET `status`='Return',`reason`='$reason' WHERE `id`='$ordId' and `pid`='$pId'";
        mysql_query($q);
        }
        if($_REQUEST["tt"]==="3")
        {
        $q= "UPDATE `order` SET `status`='Dispatch',`reason`='$reason' WHERE `id`='$ordId' and `pid`='$pId'";
        mysql_query($q);
        }
    }
 else {
           header("Location: ../index.php");
}
?>