
<?php
session_start();
$mid = mysql_escape_string($_REQUEST['mid']);
$hid = $_SESSION['hid'];
$uid = $_SESSION['UID'];
include '../config/conn.php';
$row = mysql_query("select * from `subcategory` where `hid`='$hid' and `uid`='$uid' and `cid`='$mid' ");
while($data = mysql_fetch_array($row))
{
    echo "<option value='$data[id]'>$data[name]</option>";
}
?>