<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        $lat= $_REQUEST["lt"];
        $lng= $_REQUEST["lg"];
        $hid= $_REQUEST["hid"]; 
        $q= "UPDATE `hub` SET `lat`=$lat,`lng`=$lng WHERE `id`=$hid";
        mysql_query($q);
        
    }
 else {
           header("Location: ../index.php");
}
?>