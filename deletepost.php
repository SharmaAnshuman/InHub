<?php
session_start();
include './config/conn.php';
if(isset($_SESSION["user"]))
{
    if(isset($_REQUEST["PID"]))
    {
        $pid = mysql_escape_string($_REQUEST['PID']);
         $row1 = mysql_query("select * from `posts` where id=$pid");
         while($data= mysql_fetch_array($row1))
         {
             if($data['pid']=="" ||$data['pid']==" " ||$data['pid']==null  )
             {
                unlink("./PostImages/".$data["postimg"]);
             }
             else
             {
                unlink("./ProImg/".$data["postimg"]); 
             }
         }
         $row = mysql_query("delete from `posts` where id=$_REQUEST[PID]");
         
    }
}
else
{
     header("Location: home.php");
}
?>
