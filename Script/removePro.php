<?php
session_start();
$uid = $_SESSION['UID'];
$hid = $_SESSION['hid'];
$id = mysql_escape_string($_REQUEST['key']);
include '../config/conn.php';
mysql_query("delete from `product` where id=$id");
mysql_query("delete from `posts` where pid='$id'");
echo "<script>history.back();</script>";


?>