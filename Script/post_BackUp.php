<?php
session_start();
include '../config/conn.php';
if(isset($_SESSION["user"]))
{
    if(isset($_REQUEST["post"]))
    {
        $post=  mysql_escape_string($_REQUEST["post"]);
        if($post!=null || $post!="" || $post!=" ")
        {
            $email = $_SESSION["user"];
            $row=mysql_query("select * from `login` where email='$email' ");
            $arr=mysql_fetch_array($row);
            $Userid=$arr["id"];
            $dt = date("Y-m-d H:i:s");
            if(mysql_query("INSERT INTO `posts`(`userid`, `post`, `dt`,`like`,`active`) VALUES ('$Userid','$post','$dt','0','1')"))
            {
                echo "Posted";
            }
            else
            {
                echo "<script>alert('Error Try Agine..!');</script>";
            }
        }
    }
   
}
?>