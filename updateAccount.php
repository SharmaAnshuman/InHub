<?php
session_start();
if(isset($_SESSION["user"]))
{
    include './config/conn.php';
        //getting UID
        $q = mysql_query("select * from `login` where email='$_SESSION[user]'");
        $ar = mysql_fetch_array($q);
        $UID = $ar["id"];
       
        //Check Update or Insert ?
        
        
            //insert
            if(isset($_REQUEST["M4_www"]))
            {
                $website="http://".$_REQUEST["M4_www"];
                mysql_query("update `userinfo` set `website`='$website' where `uid`='$UID'");
            }
            else if(isset($_REQUEST["gen"]) && isset($_REQUEST["bod"]))
            {
                 $gen = $_REQUEST["gen"];
                 $bod = $_REQUEST["bod"];
                 mysql_query("update `userinfo` set `gender`='$gen',`dob`='$bod' where `uid`='$UID'");
            }
            else if(isset($_REQUEST["clgNM"]) && isset($_REQUEST["courseNM"]) && isset ($_REQUEST["aboutCourse"]) && isset($_REQUEST["Cstart"]) && isset($_REQUEST["CEnd"]))
            {
                    $clgNM  = $_REQUEST["clgNM"];
                    $courseNM = $_REQUEST["courseNM"];
                    $aboutCourse = $_REQUEST["aboutCourse"];
                    $Cstart  = $_REQUEST["Cstart"];
                    $CEnd  = $_REQUEST["CEnd"];
                    $clgyear = $Cstart."-".$CEnd;
                    mysql_query("update `userinfo` set `clgnm`='$clgNM',`coursenm`='$courseNM',`courseabout`='$aboutCourse',`clgyear`='$clgyear' where `uid`='$UID'");
            }
            else if(isset($_REQUEST["mobileNo"]) && isset($_REQUEST["emailAdd"]) && isset ($_REQUEST["PersonAdd"]))
            {
                $mobileNo = $_REQUEST["mobileNo"];
                $emailAdd = $_REQUEST["emailAdd"];
                $PersonAdd = $_REQUEST["PersonAdd"];
                mysql_query("update `userinfo` set `mobile`='$mobileNo',`emailaddress`='$emailAdd',`address`='$PersonAdd' where `uid`='$UID'");
            }
            else 
            {
             echo "error";   
            }
            
    
}
?>