<link rel="stylesheet" href="css/bootstrap.min.css" />
<!--<nav class="navbar" style="background-color: #2aabd2" >
  <div class="container-fluid">
    <div class="navbar-header">
        
    </div>-->
<nav class="navbar navbar-default"  style="background-color: #4d88ff" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><img src="images/logo/2.png" height="120px" width="160px" style="position: static;margin-top: -20px;margin-left:-16px">  </a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php 
      if(isset($_SESSION["user"]))
      {
            ?>
            <form class="navbar-form navbar-left" role="search" action="user.php">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" name="Q">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
             <?php
      }
       ?>
<?php
       if(isset($_SESSION["user"]))
       {?>
          
      <ul class="nav navbar-nav navbar-right">
           <?php
              
                 $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$_SESSION[UID]");
                 $UData  = mysql_fetch_array($RowUser);
                 $RowNotify = mysql_query("SELECT * FROM `notification` WHERE `uid`=$_SESSION[UID]");
                 $NData  = mysql_fetch_array($RowNotify);
                 
                 
                ?>
                              
              <li><a href="profile.php"  role="button" aria-haspopup="true" aria-expanded="false" style="color:white"><img src="userPic/<?php echo $UData['profileimg']; ?>"   style="border-radius: 2em;height: 20px ; width: 20px"><?php echo " ".$UData['fname']; ?> </a></li>  
          <?php 
            $RowTotCrt = mysql_query("SELECT count(*)as `totCrt` FROM `mycart` WHERE `userid`='$_SESSION[UID]'");
            $TotCart = mysql_fetch_array($RowTotCrt);
          ?>
          <li><a href="./cart.php"  role="button" aria-haspopup="true" aria-expanded="false" style="color:white"> Cart<img src="./images/cart.png" style="height: 20px ; width: 20px"> <span class="badge"><?php echo $TotCart["totCrt"]; ?></span></a></li>
      <li class="dropdown">
          <?php
          
          $row = mysql_query("select * from `friends` where `receiver`=$_SESSION[UID] and `status`='panding' ");
          $totRowReq = mysql_num_rows($row);
          $row1 = mysql_query("select * from `posts` WHERE `dt` >  '$NData[dt]' and userid!=$_SESSION[UID]");
          $totRowReq = $totRowReq + mysql_num_rows($row1);
          
          $bTemp=0;
          $row11= mysql_query("select * from `friends` where (`sender`=$_SESSION[UID] or `receiver`=$_SESSION[UID]) and `status`='ok'");
          while($data=  mysql_fetch_array($row11))
          {
            if($data['receiver']===$_SESSION["UID"])
            {
                $row12= mysql_query("select * from `login` where id=$data[sender]");
            }
            else{
                $row12= mysql_query("select * from `login` where id=$data[receiver]");
            }
            while($data12=  mysql_fetch_array($row12))
            {
                $row2 = mysql_query("select * from `userinfo` WHERE uid=$data12[id] and `dob` = CURRENT_DATE"); 
                if(mysql_affected_rows()==1){
                $totRowReq = $totRowReq + 1;
                $bTemp=$bTemp+1;
                } 
            }
          }
          ?>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:white"><lable id="bdge"><span class="glyphicon glyphicon-envelope"></span> Notification <span id="sp" class="badge"><?= $totRowReq ?></span></lable> <span class="caret"></span></a>          
          <script>
          $("#bdge").click(function(){
              $("#sp").text("<?= $bTemp; ?>");
              <?php mysql_query("UPDATE `notification` SET `dt`=CURRENT_TIMESTAMP WHERE `uid`=$_SESSION[UID]"); ?>
          });
          </script>
          <ul class="dropdown-menu" >
          <div class="panel" style="overflow-x: auto;max-height: 300px;width: 400px">
              
              
 <?php
                      
                      /*if($totRowReq==0)
                      {
                          echo "<center style='padding:10px'><span class='glyphicon glyphicon-envelope'></span> Notification Empty</center>";
                      }*/
                      $X01=0;
                      while($aq = mysql_fetch_array($row))
                      {
                                $Q = $aq['sender'];
                                $q = mysql_query("select * from `login` where id =$Q ");
                                $qarr  = mysql_fetch_array($q);
                                    if($X01==0)
                                    {
                                        $X01=1;
                                    }
                                    else
                                    {
                                        echo "<li class='divider'></li>";
                                    }
                          ?>
                                <li>
                                    <div style="margin-left: 10px;margin-bottom:6px">
                                        <name>
                                            <a style="text-decoration: none" href="user.php?user=<?php echo $qarr['id']; ?>"><img src="userPic/<?= $qarr['profileimg'] ?>" height="20px" width="20px" class="img-rounded"> <?php echo ucfirst($qarr['fname'])." ".ucfirst($qarr['lname']); ?></a></name><br/>
                                            <x><center><a href="Script/becomefrnd.php?OK=<?php echo $aq['id']; ?>" class="btn btn-xs btn-sm btn-primary">Add</a>&nbsp;<a href="Script/becomefrnd.php?NOT=<?php echo $aq['id']; ?>" class="btn btn-xs btn-danger" >Delete</a></center></x>        
                                    </div>
                                </li>
                          <?php
                         
                      }
                       $row11= mysql_query("select * from `friends` where (`sender`=$_SESSION[UID] or `receiver`=$_SESSION[UID]) and `status`='ok'");
                               while($data=  mysql_fetch_array($row11))
                              {
                                   if($data['receiver']===$_SESSION["UID"])
                                   {
                                        $row12= mysql_query("select * from `login` where id=$data[sender]");
                                   }
                                 else{
                                  $row12= mysql_query("select * from `login` where id=$data[receiver]");
                                 }
                                 
                              while($data12=  mysql_fetch_array($row12))
                              {
                                  $row = mysql_query("select * from `userinfo` WHERE uid=$data12[id] and `dob` = CURRENT_DATE"); 
                                 
                      while($aq = mysql_fetch_array($row))
                      {
                                $q = mysql_query("select * from `login` where id =$aq[uid] ");
                                $qarr  = mysql_fetch_array($q);
                                    
                                   
                          ?>
                                <li>
                                    <div style="margin-left: 10px;margin-bottom:6px">
                                        <name>
                                            
                                            <a style="text-decoration: none" href="viewfriend.php?token=<?php echo $qarr['id']; ?>"><img src="userPic/<?= $qarr['profileimg'] ?>" height="20px" width="20px" class="img-rounded"> <?php echo ucfirst($qarr['fname'])." ".ucfirst($qarr['lname']); ?></a></name> Birthday Today<br/>
                                            
                                    </div>
                                </li>
                          <?php
                         
                       }    
                              } 
                              
                              }
                      $row = mysql_query("select * from `posts` WHERE `dt` >  '$UData[dt]' and userid!=$_SESSION[UID]"); 
                      
                      
                      while($aq = mysql_fetch_array($row))
                      {
                                $q = mysql_query("select * from `login` where id =$aq[userid] ");
                                $qarr  = mysql_fetch_array($q);
                                    
                          ?>
                                <li>
                                    <div style="margin-left: 10px;margin-bottom:6px">
                                        <name>
                                            <a style="text-decoration: none" href="viewfriend.php?token=<?php echo $qarr['id']; ?>"><img src="userPic/<?= $qarr['profileimg'] ?>" height="20px" width="20px" class="img-rounded"> <?php echo ucfirst($qarr['fname'])." ".ucfirst($qarr['lname']); ?></a></name> Posted <?php echo $aq["type"] ?><br/>
                                            
                                    </div>
                                </li>
                          <?php
                         
                      }
                      
                               
                      
                      ?>
          </div>
          </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:white">Settings<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="edit.php">Edit Account</a></li>
            <li><a href="yourShopping.php">Your Shopping Orders</a></li>
            <li><a href="yourProductOrder.php">Your Product Orders</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      <?php
       }
       ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>