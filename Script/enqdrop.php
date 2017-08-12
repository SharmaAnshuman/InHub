<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        $enqId= $_REQUEST["enqid"];
        $postId= $_REQUEST["postid"];
        $q= "DELETE FROM `enquiry` WHERE `id`='$enqId' and `postsid`='$postId' and `userid`='$_SESSION[UID]'";
        mysql_query($q);
        
    }
 else {
           header("Location: ../index.php");
}
?>