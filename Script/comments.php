<?php
session_start();
if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
{
   include '../config/conn.php';
   $pid = $_REQUEST["pid"];
   $msg = $_REQUEST["mgs"];
    
   $q = "INSERT INTO `comment`(`postsid`, `userid`, `comments`, `dt`) VALUES ('$pid','$_SESSION[UID]','$msg',CURRENT_TIMESTAMP)";
   mysql_query($q);
   $aq=  mysql_fetch_array(mysql_query("SELECT * FROM `comment` WHERE id IN(select max(id) from `comment` where userid=$_SESSION[UID])"));
   $ap=  mysql_fetch_array(mysql_query("SELECT count(*)as `totCom` FROM `comment` WHERE `postsid`='$pid'"));
   echo $aq["id"]."/".$ap["totCom"];
  // header("Location: ../home.php");
}
 else {
 //  header("Location: ../home.php");
}
?>