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
    <script>
    </script>
  </head>
  <body style="background-image: url(images/business_background.jpg);background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
 <!-- shafron color #ffad33;
        blue #4d88ff
 -->
     <?php
                include './include/header.php';
               
            ?>
 <br><br>   
 <div class="container">
     <?php if(isset($_REQUEST["p"])){ ?><a href="yourProductOrder.php"><?php echo "See All"; ?> </a> <?php } ?>     
     <center><h3>O<small>rder of Your</small> P<small>roducts</small></h3></center>
                                <table class="table table-condensed">
                                    <tr><td>Product ID</td><td>Product</td><td>Order Date</td><td>Qty</td><td>Price</td><td>Total</td><td>Order From</td><td>Shipping Address</td><td>Status</td></tr>
                                          <?php
                                            if(isset($_REQUEST["p"]))
                                            {
                                                $OrdRow=  mysql_query("select * from `order` where pid IN (select id from product where uid=$_SESSION[UID]) and status='panding' order by id desc");
                                            }
                                            else
                                            {
                                                $OrdRow=  mysql_query("select * from `order` where pid IN (select id from product where uid=$_SESSION[UID]) order by id desc");
                                            }
                                            while($OrdData= mysql_fetch_array($OrdRow))
                                            { ?>
                                               
                                          <tr><td><?php echo $OrdData["pid"];   ?></td>
                                              <td><label>
                                                    <?php $PRow=  mysql_query("select * from `product` where id=$OrdData[pid]"); 
                                                          $PData= mysql_fetch_array($PRow);
                                                          $HRow= mysql_query("select * from `hub` where id=$PData[hid]");
                                                          $HData=mysql_fetch_array($HRow);
                                                          ?><img src="ProImg/<?php echo $PData["prdimg"]; ?>" style="width:100px; height:100px;"/><br>
                                                    <?php echo $PData["name"]; ?><br>
                                                    (<?php echo $HData["name"]." Hub/".$HData["cat"]; ?>)
                                                      </label>
                                              </td>
                                              <?php $date=date_create($OrdData['dt']); ?>
                                              <td><?php echo date_format($date,"d/m/Y");?></td>
                                              
                                              <td><?php echo $OrdData["qty"]; ?></td>
                                              <td><?php echo $PData["price"]; ?></td>
                                              <td><?php echo $OrdData["qty"]*$PData["price"]; ?></td>
                                              <td><label>
                                                  <?php $URow=  mysql_query("select * from `login` where id=$OrdData[uid]"); 
                                                          $UData= mysql_fetch_array($URow);
                                                          ?><a href="viewfriend.php?token=<?php echo $UData['id']; ?>"><img src="userPic//<?php echo $UData["profileimg"]; ?>" style="width:50px; height:50px;border-radius: 2em"/><br>
                                                          <?php echo $UData["fname"]; echo " "; echo $UData["lname"]; ?></a><br>
                                                          <?php echo "(".$UData["cat"].")"; ?>
                                                          </label>
                                              </td>
                                              <td><b>
                                                  <?php 
                                                        $addRow=  mysql_query("SELECT * From `address` where id=$OrdData[aid] ");
                                                        $addData=  mysql_fetch_array($addRow);
                                                        echo $addData["fullname"];?></b><br>
                                                        <?php echo $addData["line1"]; ?><br>
                                                        <?php echo $addData["line2"]; ?>
                                                        <?php echo $addData["landmark"].","; ?><br>        
                                                        <?php echo $addData["city"].","; ?><br>
                                                        <?php echo $addData["state"]; ?><br>
                                                        <?php echo "Mo. No.:".$addData["mno"]; ?><br>
                                              </td>
                                              <td><?php 
                                                        if($OrdData["status"]=="Cancel")
                                                        {
                                                            echo "Canceled <b>Reason:</b>".$OrdData["reason"]; 
                                                        }
                                                        else if($OrdData["status"]=="Cancel BY Seller")
                                                        {
                                                            echo "Cancel By You <b>Reason:</b>".$OrdData["reason"]; 
                                                        }
                                                        else if($OrdData["status"]=="Return")
                                                        {
                                                            echo "Returned <b>Reason:</b>".$OrdData["reason"]; 
                                                        }
                                                        else 
                                                        {
                                                            echo $OrdData["status"];
                                                            
                                                        }
                                                        ?>      
                                              </td>
                                              
                                              <td><?php 
                                                        if($OrdData["status"]=="panding")
                                                        { ?>
                                                  <ul class="dropdown nav navbar-nav navbar-right">
                                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                                                      <ul class="dropdown-menu">
                                                        <li><a  href="javascript:reason(<?php echo $OrdData["id"]; ?>)">Cancle Order</a></li>    
                                                        <li><a  href="javascript:delOrd(<?php echo $OrdData["id"]; ?>,<?php echo $OrdData['pid']; ?>,3)">Dispatch</a></li>
                                                    </ul>
                                                        </ul>
                                                        <?php } ?>
                                              </td>
                                              <td>
                                                  <input type="text" id="reason<?php echo $OrdData["id"]; ?>" name="reason<?php echo $OrdData["id"]; ?>" placeholder="Reason " hidden="">
                                                  <a href="javascript:delOrd(<?php echo $OrdData['id']; ?>,<?php echo $OrdData['pid']; ?>,1);" id="reasonlink1<?php echo $OrdData["id"]; ?>" hidden=""><button class="btn btn-default">ok</button></a>                                                    
                                                  <script>
                                                        function reason(i)
                                                        {
                                                            $("#reason"+i).show();
                                                            $("#reasonlink1"+i).show();
                                                        }
                                                        function delOrd(cidc,pidp,tpp)
                                                        { 
                                                            var r=$("#reason"+cidc).val();
                                                            $.post("Script/orderdrop.php",{ordid:cidc,pid:pidp,tt:tpp,reason:r,o:1},function(data)
                                                            { 
                                                                window.location='yourProductOrder.php';
                                                            });
                                                        }
                                                    </script>
                                              </td>
                                              </tr>
                                              
                                        <?php 
                                                
                                            }     ?>
                                    </table>
                         
 </div>
  </body>
</html>