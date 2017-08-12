<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        $aId= $_REQUEST["aid"];
        $q= "DELETE FROM `address` WHERE `id`='$aId'";
        mysql_query($q);
        
    }
 else {
           header("Location: ../index.php");
}
?>