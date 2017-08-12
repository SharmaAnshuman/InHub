<?php
session_start();
if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
{
   include '../config/conn.php';
   $pid = $_REQUEST["pid"];
   $qty = $_REQUEST["qty"];
    $dt = date("Y-m-d H:i:s");
   $q = "INSERT INTO `order`(`postsid`, `userid`, `qty`, `dt`) VALUES ('$pid','$_SESSION[UID]',$qty,CURRENT_TIMESTAMP)";
   mysql_query($q);
  // header("Location: ../home.php");
}
 else {
 //  header("Location: ../home.php");
}
?>