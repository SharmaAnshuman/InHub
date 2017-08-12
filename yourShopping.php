<?php 
    session_start();
    include './config/conn.php';
    if(isset($_SESSION["user"]))
    { 
            unset($_SESSION["hid"]);
       
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
    <title><?php
        $TRow=  mysql_query("select * from `login` where `id`=$_SESSION[UID]");
        $TData= mysql_fetch_array($TRow);
    echo $TData["fname"]; echo " "; echo $TData["lname"]; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyle.css" />
    <link href="mycss.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body style="background-image: url(images/business_background.jpg);background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
 <!-- shafron color #ffad33;
        blue #4d88ff
 -->
     <?php
                include './include/header.php';
               
            ?>
 <div class="container">
     <center> <h3>Y<small>our</small> S<small>hopping...</small><img src="images/cart2.png" style="height: 25px ; width: 30px"></h3></center>
                            
                                <table class="table table-condensed">
                                    <tr><td><b>Item No.</td><td><b>Item</td><td><b>Order Date</td><td><b>Qty</td><td><b>Price</td><td><b>Total</td><td><b>Shipping Address</td><td><b>Status</td></tr>
                                          <?php
                                            $Gtotal=0;
                                            $counter=0;
                                            $OrdRow=  mysql_query("select * from `order` where uid=$_SESSION[UID] order by id desc");
                                            while($OrdData= mysql_fetch_array($OrdRow))
                                            {
                                                $counter=$counter+1;
                                                ?>
                                          <tr><td><?php echo $counter; ?></td>
                                              <td><label>
                                                    <?php $PRow=  mysql_query("select * from `product` where id=$OrdData[pid]"); 
                                                          $PData= mysql_fetch_array($PRow);
                                                          $HRow= mysql_query("select * from `hub` where id=$PData[hid]");
                                                          $HData=mysql_fetch_array($HRow);
                                                          ?><img src="ProImg/<?php echo $PData["prdimg"]; ?>" style="width:100px; height:100px;"/><br>
                                                          <?php echo $PData["name"]; ?><br>
                                                          By:(<a href="viewhub.php?hid=<?php echo $PData["hid"]; ?>"><?php echo $HData["name"]." Hub/".$HData["cat"]; ?></a>)
                                                  </label>
                                              </td>
                                              <?php $date=date_create($OrdData['dt']); ?>
                                              <td><?php echo date_format($date,"d/m/Y");echo "<br>"; echo date('l', strtok($OrdData['dt'])); ?></td>
                                              <td><?php echo $OrdData["qty"]; ?></td>
                                              <td><?php echo $PData["price"]; ?></td>
                                              <td><?php echo $OrdData["qty"]*$PData["price"]; ?></td>
                                              <td><b>
                                                  <?php 
                                                        $addRow=  mysql_query("SELECT * From `address` where id=$OrdData[aid] ");
                                                        $addData=  mysql_fetch_array($addRow);
                                                        echo $addData["fullname"];?></b><br>
                                                        <?php echo $addData["line1"]; ?><br>
                                                        <?php echo $addData["line2"]; ?>
                                                        <?php echo $addData["landmark"]; ?><br>        
                                                        <?php echo $addData["city"]; ?><br>
                                                        <?php echo $addData["state"]; ?><br>
                                                        <?php echo "Mo. No.:".$addData["mno"]; ?><br>
                                              </td>
                                              <td><?php if($OrdData["status"]=="Cancel")
                                                        {
                                                            echo "Canceled <b>Reason:</b>".$OrdData["reason"];
                                                        }
                                                        else if($OrdData["status"]=="Cancel BY Seller")
                                                        {
                                                            echo "Cancel By Seller <b>Reason:</b>".$OrdData["reason"]; 
                                                        }
                                                        else if($OrdData["status"]=="Return")
                                                        {
                                                            echo "Returned <b>Reason:</b>".$OrdData["reason"];
                                                        }
                                                        else if($OrdData["status"]=="Dispatch")
                                                        {
                                                            echo "Dispatched";
                                                        }
                                                        else
                                                        { 
                                                            echo "Order In Process...";
                                                  ?>
                                                    <ul class="dropdown nav navbar-nav navbar-right">
                                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                                                      <ul class="dropdown-menu">
                                                        <li><a  href="javascript:reason(1,<?php echo $OrdData["id"]; ?>)">Cancle Order</a></li>
                                                        <li><a  href="javascript:reason(2,<?php echo $OrdData["id"]; ?>)">Return Order</a></li>
                                                    </ul>
                                                        </ul><?php } ?>
                                              </td>
                                              <td>
                                                  <input type="text" id="reason<?php echo $OrdData["id"]; ?>" name="reason<?php echo $OrdData["id"]; ?>" placeholder="Reason " hidden="">
                                                  <a href="javascript:delOrd(<?php echo $OrdData['id']; ?>,<?php echo $OrdData['pid']; ?>,1);" id="reasonlink1<?php echo $OrdData["id"]; ?>" hidden=""><button class="btn btn-default">ok</button></a>  
                                                  <a href="javascript:delOrd(<?php echo $OrdData['id']; ?>,<?php echo $OrdData['pid']; ?>,2);" id="reasonlink2<?php echo $OrdData["id"]; ?>" hidden=""><button class="btn btn-default">ok</button></a>  
                                                  <script>
                                                        function reason(w,i)
                                                        {
                                                            $("#reason"+i).show();
                                                            if(w===1)
                                                            {
                                                                $("#reasonlink1"+i).show();
                                                            }
                                                            else
                                                            {
                                                                $("#reasonlink2"+i).show();
                                                            }
                                                        }
                                                        function delOrd(cidc,pidp,tpp)
                                                        { 
                                                            var r=$("#reason"+cidc).val();
                                                            $.post("Script/orderdrop.php",{ordid:cidc,pid:pidp,tt:tpp,reason:r},function(data)
                                                            { 
                                                                window.location='yourShopping.php';
                                                            });
                                                        }
                                                    </script>
                                              </td>
                                              </tr>
                                              
                                        <?php 
                                                //$Gtotal=$Gtotal+($OrdData["qty"]*$PData["price"]);
                                            }     ?>
                                         <!-- <tr><td></td><td></td><td></td><td><b>Grand Total</b></td><td><?php echo $Gtotal; ?></td></tr> -->
                                    </table>
                          
 </div>
  </body>
</html>