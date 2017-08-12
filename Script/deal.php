<?php
session_start();
if(isset($_SESSION["user"]) && isset($_SESSION["UID"] ))
{
   include '../config/conn.php';
   $pid = $_REQUEST["pid"];
   $msg = $_REQUEST["mgs"];
    $dt = date("Y-m-d H:i:s");
   $q = "INSERT INTO `deal`(`postid`, `userid`, `desc`, `dt`) VALUES ('$pid','$_SESSION[UID]','$msg','$dt')";
   mysql_query($q);
   //header("Location: ../home.php");
}
 else {
  // header("Location: ../home.php");
}
?>