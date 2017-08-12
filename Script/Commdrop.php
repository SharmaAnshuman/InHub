<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        $commId= $_REQUEST["commid"];
        $postId= $_REQUEST["postid"];
        $q= "DELETE FROM `comment` WHERE `id`='$commId' and `userid`='$_SESSION[UID]'";
        mysql_query($q);
        $ap=  mysql_fetch_array(mysql_query("SELECT count(*)as `totCom` FROM `comment` WHERE `postsid`='$postId'"));
        echo $ap["totCom"];
    }
 else {
           header("Location: ../index.php");
}
?>