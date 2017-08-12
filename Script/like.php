<?php
session_start();
if(isset($_SESSION["user"]))
{
 if(isset($_REQUEST["id"]))
   {
     
     include '../config/conn.php';
       $Postid= $_REQUEST["id"];
       
       
       //getting user id
        $email = $_SESSION["user"];
        $row1=mysql_query("select * from `login` where email='$email' ");
        $arr1=mysql_fetch_array($row1);
        $Userid=$arr1["id"];
       
        
        //cheking user already liked.
        $rowCOu = mysql_query("SELECT * FROM `like` WHERE `postsid`='$Postid' and `userid`='$Userid' ");
        $c = mysql_num_rows($rowCOu);
        if($c==0)//0== not liked
        {
            //0 to 1 for like
            mysql_query("INSERT INTO `like`(`postsid`, `userid`) VALUES ('$Postid','$Userid')");
            
            $r1 = mysql_query("select count(*)as `tot` from `like` where `postsid`='$Postid' ");
            $ar1 = mysql_fetch_array($r1);
                if(mysql_query("update `posts` set `like`='$ar1[tot]' where `id`=$Postid"))
                {
                    echo "Like".$ar1['tot'];
                }

        }
        else
        {

            mysql_query("DELETE FROM `like` WHERE `postsid`='$Postid' and `userid`='$Userid'");
            $r1 = mysql_query("select count(*)as `tot` from `like` where `postsid`='$Postid' ");
            $ar1 = mysql_fetch_array($r1);
            if(mysql_query("update `posts` set `like`='$ar1[tot]' where `id`=$Postid"))
            {
                    echo "Unlike".$ar1['tot'];
            }
            
        }
       
   }
}
?>