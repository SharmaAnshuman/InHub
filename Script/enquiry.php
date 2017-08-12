<?php
session_start();
if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
{
   include '../config/conn.php';
   $pid = $_REQUEST["pid"];
   $msg = $_REQUEST["mgs"];
  
   $q = "INSERT INTO `enquiry`(`pid`, `uid`, `enquiry`, `dt`) VALUES ('$pid','$_SESSION[UID]','$msg',CURRENT_TIMESTAMP)";
   mysql_query($q);
  // header("Location: ../home.php");
}
 else {
 //  header("Location: ../home.php");
}
?>