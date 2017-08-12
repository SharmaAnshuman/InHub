<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        $cId= $_REQUEST["cid"];
        $q= "DELETE FROM `cart` WHERE `id`='$cId'";
        mysql_query($q);
        
    }
 else {
           header("Location: ../index.php");
}
?>