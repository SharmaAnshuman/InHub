<?php 
    session_start();
    include './config/conn.php';
    if(isset($_SESSION["user"]))
    { 
            unset($_SESSION["hid"]);
            if(isset($_REQUEST["rem"]))
            {
            mysql_query("DELETE FROM `mycart` WHERE id=".$_REQUEST["rem"]." ");  
            header("Location: BuyNow.php");
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
    function addr()
    {
        var f=$("#fullname").val();
        var m=$("#mno").val();
        var l1=$("#line1").val();
        var l=$("#landmark").val();
        var c=$("#city").val();
        var s=$("#state").val();
        if(f==="" || f===" ")
        {
            alert("Enter Full Name");
            return false;
        }
        if(m==="" || m===" ")
        {
            alert("Enter Mobile No.");
            return false;
        }
        if(l1==="" || l1===" ")
        {
            alert("Enter Address");
            return false;
        }
        if(l==="" || l===" ")
        {
            alert("Enter Landmark");
            return false;
        }
        if(c==="" || c===" ")
        {
            alert("Enter City Name");
            return false;
        }
        if(s==="" || s===" ")
        {
            alert("Enter State Name");
            return false;
        }
        
        return true;
    }
     
   function delAddr(aida)
    {
            
            $.post("Script/addrDrop.php",{aid:aida},function(data)
            {
               window.location='BuyNow.php';
            });
    }  
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
    <?php 
    if(isset($_REQUEST["addr"]))
    {
    ?>
    <h1>Select Payment Method</h1>  <br>
    <div>
        <form method="post" enctype="multipart/form-data" action="BuyNow.php?placeaddr=<?php echo $_REQUEST['addr']; if(isset($_REQUEST["b"])){echo "&b=".$_REQUEST["b"];} ?>">
            <input type="radio" checked>Cash On Delivery<br><br>
            <button class="btn btn-info">Continue</button>
        </form>
    </div>
    <?php     
    }
    else if(isset($_REQUEST["placeaddr"]))
    {   ?>
    <form action="Script/placeOrder.php" method="post">
    <div class="col-md-7"> 
        <table class="table table-condensed">
            <h3>Your Cart Contain These Items</h3>
            <tr><td>Item No.</td><td>Item</td><td>Qty</td><td>Price</td></tr>
            <?php
        if(isset($_REQUEST["b"]))
        {
            $Gtotal=0; ?>
            <tr><td>1</td>
                <td><label><center>
                <?php $PRow=  mysql_query("select * from `product` where id=$_REQUEST[b]"); 
                $PData= mysql_fetch_array($PRow);
                ?><img src="ProImg/<?php echo $PData["prdimg"]; ?>" style="width:100px; height:100px;"/><br>
                <?php echo $PData["name"]; ?><br>
                </td>
                <input type="hidden" id="qty" name="qty" value="1">
                 <input type="hidden" id="price" name="price" value="<?php echo $PData["price"]; ?>">
                 <input type="hidden" id="pid" name="pid" value="<?php echo $PData["id"]; ?>">
                <td><label id="qlbl">1</label><input type="text" value="1" style="width:50px" id="qt"><small><a style="cursor: pointer"  id="updt">Update|</a></small><small><a style="cursor: pointer" id="chng">Change</a></small></td>
                <script>
                    $("#qt").hide();
                   $("#updt").hide();
                $("#chng").click(function(){
                   //alert(1);
                   $("#qlbl").hide();
                   $("#qt").show();
                   $("#updt").show();
                });
                
                $("#updt").click(function(){
                   
                   $("#qlbl").text(document.getElementById('qt').value); 
                   $("#plbl").text(document.getElementById('price').value*document.getElementById('qt').value); 
                   document.getElementById('qty').value= document.getElementById('qt').value;
                   document.getElementById('price').value=document.getElementById('price').value*document.getElementById('qt').value;
                   $("#qlbl").show();
                   $("#qt").hide();
                   $("#updt").hide();
                   
                });
                </script>
                <td><label id="plbl"><?php echo $PData["price"]; ?></label></td>
                </tr>  
        <?php    
        }else{
            $counter=0;
            $Gtotal=0;
            
            $CartRow=  mysql_query("select * from `mycart` where userid=$_SESSION[UID]");
            while($CartData= mysql_fetch_array($CartRow))
            {
                $counter=$counter+1;
                ?>
                <tr><td><?php echo $counter; ?></td>
                <td><label><center>
                <?php $PRow=  mysql_query("select * from `product` where id=$CartData[pid]"); 
                $PData= mysql_fetch_array($PRow);
                ?><img src="ProImg/<?php echo $PData["prdimg"]; ?>" style="width:100px; height:100px;"/><br>
                <?php echo $PData["name"]; ?><br>
                </td>
                <td><?php echo $CartData["qty"]; ?></td>
                <td><?php echo $CartData["price"]; ?></td>
                </tr>                      
                <?php 
                $Gtotal=$Gtotal+$CartData["price"];
            }
        }?>
            <tr><td></td><td></td><td><b>Grand Total</b></td><td><?php echo $Gtotal; ?></td></tr>
            
        </table>
       
    </div>
    <div class="col-md-4">
        <div>
        <label>Shipping Address</label>
        <hr>
       <?php $addRow=  mysql_query("select * from address where id=$_REQUEST[placeaddr]");
        $addData= mysql_fetch_array($addRow);
         ?>
                <h4><?php echo $addData["fullname"]; ?></h4>
                <?php echo $addData["line1"]; ?>
                <?php echo $addData["line2"]; ?>,<br>
                <?php echo $addData["landmark"]; ?>,<br>
                <?php echo $addData["city"]; ?><br>
                <?php echo $addData["state"]; ?><br>
                <b>Mobile No.</b><?php echo $addData["mno"]; ?><br>  
        </div>
        <input type="hidden" id="addr" name="addr" value="<?php echo $_REQUEST["placeaddr"]; ?>">
        
        <button class="btn btn-success"> Place Order</button>
    </div>
    </form>
    <?php
    }
    else 
    { ?>
    <table><tr>
       <?php $addRow=  mysql_query("select * from address where uid=$_SESSION[UID]");
        while($addData= mysql_fetch_array($addRow))
        { ?>
    
            <td><form id="add<?php echo $addData["id"]; ?>" method="post" action="BuyNow.php?addr=<?php echo $addData["id"]; if(isset($_REQUEST["b"])){echo "&b=".$_REQUEST["b"];} ?>">
               <span class="glyphicon glyphicon-remove" style="cursor: pointer"  onclick="delAddr('<?php echo $addData['id']; ?>');" data-toggle="tooltip" title="Delete Address"></span>
               <h3><?php echo $addData["fullname"]; ?></h3><br>
                <?php echo $addData["line1"]; ?><br>
                <?php echo $addData["line2"]; ?><br>
                <?php echo $addData["landmark"]; ?><br>
                <?php echo $addData["city"]; ?><br>
                <?php echo $addData["state"]; ?><br>
                Mobile No.:<?php echo $addData["mno"]; ?><br>                
                </form>
                    <button class="btn btn-info" onclick="document.getElementById('add<?php echo $addData["id"]; ?>').submit()">Deliver To This Address</button>
        </td>
        <td>&nbsp;&nbsp;</td>
        <?php 
        }
        ?>
        </tr></table>
        <h2>ADD NEW ADDRESS:<br></h2>  <br>
       
                <form method="post" enctype="multipart/form-data" action="Script/address.php<?php if(isset($_REQUEST["b"])){echo "?&b=".$_REQUEST["b"];} ?>" onsubmit="return addr()">
                    Full Name:<br>
                    <input class="form-control" style="width:500px" type="text" id="fullname" name="fullname"><br>
                    Mobile Number:<br>
                    <input class="form-control" style="width:500px" type="text" id="mno" name="mno"><br>
                    Address Line 1: <br>
                    <input class="form-control" style="width:500px" type="text" id="line1" name="line1"><br>
                    Address Line 2: <br>
                    <input class="form-control" style="width:500px" type="text" id="line2" name="line2" placeholder="optional"><br>
                    Landmark: <br>
                    <input class="form-control" style="width:500px" type="text" id="landmark" name="landmark" placeholder="e.g. Near Balaji Hanuman, Behind Temple etc.."><br>
                    Town/City: <br>
                    <input class="form-control" style="width:500px" type="text" id="city" name="city" placeholder="Your Town/City Name"><br>
                    State: <br>
                    <input class="form-control" style="width:500px" type="text" id="state" name="state" placeholder="Your State Name"><br>
                    <button class="btn btn-info">Deliver To This Address</button>
                </form>
            
    <?php
    }
    ?>
</div>
   </body>
</html>