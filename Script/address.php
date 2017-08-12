<?php
session_start();
if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
{
   include '../config/conn.php';
   $f = $_REQUEST["fullname"];
   $mno=$_REQUEST["mno"];
   $l1 = $_REQUEST["line1"];
   $l2 = $_REQUEST["line2"];
   $l = $_REQUEST["landmark"];
   $c = $_REQUEST["city"];
   $s = $_REQUEST["state"];
   $q = "INSERT INTO `address` (`uid`, `fullname`, `mno`, `line1`, `line2`, `landmark`, `city`, `state`) VALUES ('$_SESSION[UID]','$f','$mno','$l1','$l2','$l','$c','$s')";
   mysql_query($q);
   $addid=  mysql_query("select max(id) as lid from address");
   $add=  mysql_fetch_array($addid);
   if(isset($_REQUEST["b"]))
   {
       header("Location: ../BuyNow.php?addr=$add[lid]&b=$_REQUEST[b]");
   }
 else {
       header("Location: ../BuyNow.php?addr=$add[lid]");
   }
   
}
 else {
   header("Location: ../home.php");
}
?>