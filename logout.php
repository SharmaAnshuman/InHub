<?php
session_start();
 include './config/conn.php';
 $dt = date("Y-m-d H:i:s");
mysql_query("UPDATE login SET `dt`='$dt' where id='$_SESSION[UID]'");

session_destroy();
header("Location: index.php");
?>