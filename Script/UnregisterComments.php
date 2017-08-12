<?php
session_start();
if((isset($_REQUEST['Email']))&&(isset($_REQUEST['Mobile'])))
{
    include '../config/conn.php';
    
    $email = mysql_real_escape_string($_REQUEST['Email']);
    $mobile = mysql_real_escape_string($_REQUEST['Mobile']);
    $hubid = mysql_real_escape_string($_REQUEST['Hid']);
    $postid = mysql_real_escape_string($_REQUEST['Id']);
    $mgs = mysql_real_escape_string($_REQUEST['Mgs']);
    $dt = date("Y-m-d H:i:s");
      if(mysql_query("INSERT INTO `uncomm`(`hid`, `postid`, `msg`, `email`, `mobile`, `dt`) VALUES ('$hubid','$postid','$mgs','$email','$mobile','$dt')"))
       {
       header("Location: ../viewReplay.php");
       }
       else
       {
           header("Location: error.php");
       }
}
 else {
       header("Location: error.php");
}



?>