<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config/conn.php';
        $aid=$_REQUEST["addr"]; 
        $dt = date("Y-m-d H:i:s");
        if(isset($_REQUEST["qty"]))
        {
            mysql_query("INSERT INTO `order` (`uid`,`pid`,`aid`,`qty`,`price`,`status`,`dt`) VALUES ('$_SESSION[UID]','$_REQUEST[pid]','$aid','$_REQUEST[qty]','$_REQUEST[price]','panding',CURRENT_TIMESTAMP)");
             header("Location: ../home.php"); 
        }
        else{
            $cartRow=  mysql_query("SELECT * from `mycart` where userid=$_SESSION[UID]");
            while($cartData=  mysql_fetch_array($cartRow))
            {
                mysql_query("INSERT INTO `order` (`uid`,`pid`,`aid`,`qty`,`price`,`status`,`dt`) VALUES ('$_SESSION[UID]','$cartData[pid]','$aid','$cartData[qty]','$cartData[price]','panding',CURRENT_TIMESTAMP)");
            
            }
            mysql_query("DELETE From `mycart` where userid=$_SESSION[UID]");
       
            header("Location: ../cart.php");   
        }
    }
 else {
            header("Location: ../index.php");
}
?>