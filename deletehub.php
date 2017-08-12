<?php
session_start();
include './config/conn.php';
if(isset($_SESSION["user"]))
{
    if(isset($_SESSION["hid"]))
    {
         $row = mysql_query("select * from `posts` where userid=$_SESSION[UID] and hid=$_SESSION[hid]");
         $row1 = mysql_query("select * from `hub` where uid=$_SESSION[UID] and id=$_SESSION[hid]");
         while($data=  mysql_fetch_array($row))
         {
             unlink("./PostImages/".$data["postimg"]);
         }
         while($data=  mysql_fetch_array($row1))
         {
            unlink("./userPic/".$data["hubimg"]);
         }
        mysql_query("delete from `hub` where id=$_SESSION[hid]");
        mysql_query("delete from `posts` where hid=$_SESSION[hid] and userid=$_SESSION[UID]");
        
        unset($_SESSION["hid"]);
        header("Location: home.php");
    }
}

?>
