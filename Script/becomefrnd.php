<?php
session_start();
include '../config/conn.php';
if(isset($_SESSION["user"]))
{
    if(isset($_REQUEST["token"]))
    {
        if ($_SESSION["UID"]!=$_REQUEST["token"])
        {
            $Q = mysql_escape_string($_REQUEST["token"]);
            
            mysql_query("INSERT INTO `friends`(`sender`, `receiver`, `status`, `dt`) VALUES ('$_SESSION[UID]','$Q','panding',CURRENT_TIMESTAMP)");
            header("Location: ../viewfriend.php?token=".$_REQUEST['token']."");
        }
    }
    elseif(isset($_REQUEST["tokenRemove"]))
    {
        if ($_SESSION["UID"]!=$_REQUEST["tokenRemove"])
        {
            $Q = mysql_escape_string($_REQUEST["tokenRemove"]);
            mysql_query("DELETE FROM `friends` WHERE `sender`=$_SESSION[UID] and `receiver`=$Q  or `receiver`=$_SESSION[UID] and `sender`=$Q");
            header("Location: ../viewfriend.php?token=".$_REQUEST['tokenRemove']."");
        }
    }
    
    if(isset($_REQUEST["OK"]))
    {
        $OK= mysql_escape_string($_REQUEST["OK"]);
        mysql_query("update `friends` set `status` = 'ok' where id=$OK");
        header("Location: ../home.php");
    }
        
    if(isset($_REQUEST["NOT"]))
    {
        $OK= mysql_escape_string($_REQUEST["NOT"]);
        mysql_query("DELETE FROM `friends` WHERE id=$OK");
        header("Location: ../home.php");
    }
}
else
{
    header("Location: ../viewfriend.php?token=".$_REQUEST['token']."");
}

?>