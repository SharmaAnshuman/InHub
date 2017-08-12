<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        if(isset($_REQUEST["pid"]))
        {
            $PId= $_REQUEST["pid"];
            $q= "DELETE FROM `product` WHERE `id`='$PId' and `uid`='$_SESSION[UID]' and hid='$_SESSION[hid]'";
         }
        else if(isset($_REQUEST["cid"]))
            { 
            $CId= $_REQUEST["cid"];
            $q= "DELETE FROM `category` WHERE `id`='$CId' and `uid`='$_SESSION[UID]' and hid='$_SESSION[hid]'";
        }
        else if(isset($_REQUEST["sid"]))
            { 
            $SId= $_REQUEST["sid"];
            $q= "DELETE FROM `subcategory` WHERE `id`='$SId' and `uid`='$_SESSION[UID]' and hid='$_SESSION[hid]'";
        }
            mysql_query($q);
    }
 else {
           header("Location: ../index.php");
}
?>