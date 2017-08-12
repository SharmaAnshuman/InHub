<?php
session_start();
include './config/conn.php';
if(isset($_SESSION["user"]))
{
    if(isset($_REQUEST["rem"]))
        {
            mysql_query("DELETE FROM `mycart` WHERE id=".$_REQUEST["rem"]." ");  
            header("Location: cart.php");
        }
}
else
{
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: Home :: InHub's</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
        <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="text/jquery-te-1.4.0.css">
<script type="text/javascript" src="text/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="text/jquery-te-1.4.0.min.js" charset="utf-8"></script>
</head>
  <body style="background-image: url(images/business_background.jpg);background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
      
        
            <?php
                include './include/header.php';
                $uq = mysql_query("select * from `login` where email='$_SESSION[UID]'");
                $m = mysql_fetch_array($uq);
                
            ?>

        <?php
        
            
            if(isset($_REQUEST["pqty"]) && isset($_REQUEST["pid"]) && isset($_REQUEST["amount"]))
            {
               
               
                    $cart_pid=$_REQUEST["pid"];
                    $user_qty =$_REQUEST["pqty"] ;
                    //checking that user added to cart that product is in cart. if product in the cart then update product Qty
                    $cartrow=mysql_query("select qty,id from mycart where pid=$cart_pid and userid='$_SESSION[UID]' and status=0 ");
                    $Cart_total_row=mysql_num_rows($cartrow);
                    if($Cart_total_row!=0)
                    {
                        $c_qty = mysql_fetch_array($cartrow);
                        $cart_q= $c_qty["qty"];//here i getting cart item qty.
                        $cart_id =$c_qty["id"];//cart id (where cartid=!)
                        
                            $prow=mysql_query("select qty from product where id=$cart_pid");
                            $p_qty = mysql_fetch_array($prow);
                            $product_q= $p_qty["qty"];//here i getting total product qty

                            if($product_q > $user_qty)//total(MAX) vs. reqested qty(MIN)
                            {
                                $newqty =   $user_qty +$cart_q;
                                 if($product_q  >= $newqty)
                                 { 
                                        if(mysql_query("update mycart set qty='$newqty' where id=$cart_id"))
                                        {
                                         //   header("Location: cart.php");
                                              echo "<script>window.location='cart.php'</script>"; 
                                        }
                                        else
                                        {
                                            echo "<script>alert('Error try agine..!"."update mycart set qty='$newqty' where id=$cart_id"."')</script>";
                                        }       
                                        echo "<br/><br/><center>update mycart set qty='$newqty' where id=$cart_id</center>";
                                 }
                                 else
                                 {
                                     echo "<script>alert('Qty out of bound')</script>";
                                 }
                            }
                            else
                            {
                                echo "<script>alert('Qty out of bound')</script>";
                            }
                    }
                    else
                    {
                        $u_qty =  $_REQUEST["pqty"];
                        $pid  =  $_REQUEST["pid"];
                        $srs = $_REQUEST["amount"];
                        $amount=$srs*$u_qty;

                        date_default_timezone_set("Asia/Kolkata");
                        $dt= date("Y-m-d h:i:s");
                        if(mysql_query("INSERT INTO `mycart`( `pid`,`qty`, `userid`,`price`, `cdate`) VALUES ('$pid','$u_qty','$_SESSION[UID]','$amount','$dt')"))
                        {

                           /* $rpid=mysql_query("select p_qty from product where id=$pid");
                            $rar=mysql_fetch_array($rpid);
                            $up_qty = $rar["p_qty"] - $u_qty;
                            mysql_query("UPDATE `product` SET `p_qty`='$up_qty'  WHERE id=$pid ");*/
                            //header("Location: cart.php");
                              echo "<script>window.location='cart.php'</script>"; 
                        }
                        else
                        {
                            echo "<script>alert('Error try agine..!')</script>";
                            echo "<br/><br/><br/><center>INSERT INTO `mycart`( `pid`,`qty`, `userid`,`price`, `cdate`) VALUES ('$pid','$u_qty','$_SESSION[UID]','$amount','$dt')</center>";                            
                        }
                        echo "<center>".mysql_error()."</center>";
                        
                    }
            }
            
                    
                  
            $cart= mysql_query("select * from mycart where userid='$_SESSION[UID]' and status=0 ");
            $count=mysql_num_rows($cart);
            if($count!=0)
            {
            ?>
            <br/><br/><br/>
  <center><h2>My P<small>Cart</small></h2> </center>
              
            <div class="col-md-6 col-md-offset-3">

            <div class="">
                  <table class="table table-condensed"  >
                      <th><small>Product Name</small></th><th><small>Qty</small></th><th><small>Amount</small></th><th>Remove</th>
          
          
                <?php
            while ($data=  mysql_fetch_array($cart))
            {
                    
                $arow=mysql_query("select * from `product` where id=".$data["pid"]." ");
                $ar=  mysql_fetch_array($arow);
                
                ?>


              <tr>
                  <td>
                      <div style="width: 50px;word-wrap: break-word" >
                          <center><img src="ProImg/<?php echo $ar["prdimg"] ?>" height="140px" width="auto"></center><br/>
                          <?php echo $ar["name"] ?>
                      </div>
                  </td>
                  <td>
                      <?php
                      if($ar["qty"]==0)
                      {
                          echo $data["qty"] ."<br/>"; ?><label class="label label-danger">Out Stock!</label><?php
                      }
                      else
                      {
                        echo $data["qty"] ;
                      }
                              ?>
                  </td>
                  <td>Rs.
                      <?php                         echo $english_format_number = number_format($data["price"],0);   ?>
                      <br/>
                      
                      
                    
                  </td>
                  <td> <a href="cart.php?rem=<?php echo $data["id"] ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
              
              
              
                    
               <?php
                
            }
            
        ?>
    
              
              </table>
                
              <h4><label class="label label-danger">Total Rs. <?php 
              
                        $a=mysql_query("select sum(price)as total from mycart where userid='$_SESSION[UID]' and status=0");
                        $aa= mysql_fetch_array($a);
                        echo $english_format_number = number_format($aa["total"],0);
                        $_SESSION["paymoney"]=$aa["total"];
                                
                                
              
                        ?></label></h4>
                <!--<h4><label class="label label-danger">Total PMoney :<?php 
                echo $TOTAL_PMONEY;
              $_SESSION["pmoney"]=$TOTAL_PMONEY;
                        ?></label></h4>-->
                <br/>
             
                
                  <?php
                      if($ar["qty"]==0)
                      {
                          echo $data["qty"] ."<br/>"; ?><label class="btn btn-default pull-right">Out Stock!</label><?php
                      }
                      else
                      {
                          ?>   <hr>   <a href="home.php" class="btn btn-default pull-left" >Continue Shopping</a>         <a href="BuyNow.php" class="btn btn-primary pull-right" >Make Order</a><?php
                      }
                ?>
                
              <br/><br/><br/><br/>
          </div>
          
      </div>
<?php
            }
            else
            {
                ?>
              <div style="margin-top: 90px">
              
              
              
              <div style="margin-top: 20px">
              <center><h1><span class="glyphicon glyphicon-shopping-cart"></span></h1></center>
              <center><h2><label class=''>Cart is empty..!</label></h2>
              <a href="index.php">Go for shopping</a></center></div>
              
              </div><br/><br/><br/><br/><br/><br/><?php
          
                    
            }
?>




    
   
  </body>
  
  
</html>