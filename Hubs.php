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
 <br><br>
 <div class="container">
                              <?php
                      $prorow = mysql_query("select * from `hub` where id!='$_SESSION[UID]'");
                      while($prodata = mysql_fetch_array($prorow))
                      {
                        ?>
                        <div class="col-md-3">
                        <div class="panel panel-primary">
                            
                             <?php
                          if($prodata["hubimg"]=="" || $prodata["hubimg"]==" "||$prodata["hubimg"]==null)
                          {
                              ?>
                           <center><img src="images/logo/MYHubCoverPost.png"  class="img-responsive" style="height:165px;padding:1px;margin-top:5px"> </center>
                          <?php
                          }
                          else
                          {
                          ?>
                           <center><img src="userPic/<?php echo $prodata["hubimg"]; ?>"   class="img-responsive" style="height:165px;padding:1px;margin-top:5px"> </center>
                          <?php
                          }
                          ?>
                          
                          
                           
                            <div class="panel-body">
                                <b><span> <a href="viewhub.php?hid=<?php echo $prodata['id']; ?>"><?php echo ucfirst($prodata['name']); ?></a></span></b><br/>
                                <span><?php echo ucfirst($prodata['cat']); ?></span><br/>
                                <?php
                                    $RowU = mysql_query("select * from `login` where id=$prodata[uid]");
                                    $dataOfU = mysql_fetch_array($RowU);
                                ?>
                                <small>Created By <a href="viewfriend.php?token=<?php echo $dataOfU['id']; ?>"><?php echo ucfirst($dataOfU['fname'])." ".ucfirst($dataOfU['lname']); ?></a></small>
                            </div>
                            <div class="panel-footer">
                                <a href="viewhub.php?hid=<?php echo $prodata['id']; ?>" class="btn btn-default">Explore Hub</a>
                            </div>
                        </div>
                        </div>
                        <?php
                       }
           ?>
              </div>
   </body>
</html>