<?php
session_start();
if(isset($_SESSION["user"]))
{
    include './config/conn.php';
    $uq = mysql_query("select * from `login` where email='$_SESSION[user]'");
    $m = mysql_fetch_array($uq);
    $Sqry="";
    if(isset($_REQUEST['Q']))
    {
        $Sqry = mysql_escape_string($_REQUEST['Q']);
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
    <title>Account Information</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    
     function CommentIt(ppp,typ)
        {
            var mmm = $("#CommentMgs"+ppp).val();
            if(typ=="I")
            {t=1;}
            if(typ=="N")
            {t=2;}
            if(typ=="B")
            {t=3;}
            $.post("Script/comments.php",{pid:ppp,mgs:mmm},function(data){
                      $("#"+typ+"lbl"+ppp).html("<p style='margin-bottom: -1px'><img src='userPic/<?php echo $m['profileimg']; ?> ' height='30px' width='30px' style='border-radius: 2em'> <br/><?php echo $m['fname']; ?> <small><?php echo 'Just Now'; ?></small> <span class='glyphicon glyphicon-remove' style='cursor:pointer' onclick='delComm("+data.substring(0,data.indexOf("/"))+","+ppp+","+t+")'></span></p><commnet1 style='padding: 10px;margin-left:9px;color: red'>"+mmm+"</commnet1>");
                      $("#"+typ+"lbl"+ppp).show();
                      $("#CommentMgs"+ppp).val("");
                      $("#"+typ+"sp"+ppp).text(data.substring(data.indexOf("/")+1));
                      $("#"+typ+"b"+ppp).hide();
                      //location.reload();
                                                   
            });
            
        }
        function delComm(cidc,pidp,typ1)
        {
            var cid = cidc;
            var pid = pidp;
            if(typ1==1)
            {typ1="I"}
            if(typ1==2)
            {typ1="N"}
            if(typ1==3)
            {typ1="B"}
            $.post("Script/Commdrop.php",{commid:cid,postid:pid},function(data)
            {
                
                    $("#"+typ1+"com"+cidc).hide();
                    $("#"+typ1+"lbl"+pidp).hide();
                    $("#"+typ1+"sp"+pidp).text(data);
                    //location.reload();
            });
        }
    
    </script>
  </head>
  <body style="background-image: url(images/business_background.jpg);background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
      <?php include 'include/header.php'; ?> 
     <br/>
      <div class="container col-md-offset-1">
          
        <div class="col-md-3">
            
          <?php
          $temp=0;
          $srow = mysql_query("select * from `login` where `fname` like '%$Sqry%'");
          while($data= mysql_fetch_array($srow))
          { 
              if($temp===0)
              {  
                ?><p>People</p><?php 
                $temp=1;
              }
              if($data['id']==$_SESSION['UID'])
              {
              }
              else
              {
              
          ?>
       
           <div class="panel panel-primary">
               <center><img src="userPic/<?php echo $data['profileimg']; ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></center>
               <div class="panel-body">
                   <?php  echo ucfirst($data['fname'])." ".$data['lname'];  ?><br/>
                   <?php  echo $data['cat']; ?><br/>
                   
               </div>
               <div class="panel-footer">
                   <?php
                   $Q = $data['id'];
                   $result =mysql_query("select * from `friends` where (`sender`=$_SESSION[UID] and `receiver`=$Q) or (`sender`=$Q and `receiver`=$_SESSION[UID])");
                            $co1 = mysql_num_rows($result);
                            if($co1==0)
                            {
                                ?><a href="Script/becomefrnd.php?token=<?php echo $Q; ?>" class='btn btn-primary btn-sm'>Add to Circle</a><?php
                            }
              
              
                            $result =mysql_query("select * from `friends` where `sender`=$_SESSION[UID] and `receiver`=$Q and `status`='panding'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                ?><a href="Script/becomefrnd.php?tokenRemove=<?php echo $data['id']; ?>" class="btn btn-default btn-sm">Cancle Request.!</a><?php
                            }
                            $result =mysql_query("select * from `friends` where `sender`=$Q and `receiver`=$_SESSION[UID] and `status`='panding'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                $aq = mysql_fetch_array($result);
                                ?>
                                    <small>You Received Friend Request</small>              <br/>
                                    <a href="Script/becomefrnd.php?OK=<?php echo $aq['id']; ?>" class="btn btn-sm btn-success">Add</a>&nbsp;<a href="Script/becomefrnd.php?NOT=<?php echo $aq['id']; ?>" class="btn btn-sm btn-default">Delete</a>
                                <?php
                                
                            }
                            $result =mysql_query("select * from `friends` where ((`sender`=$Q and `receiver`=$_SESSION[UID]) or (`sender`=$_SESSION[UID] and `receiver`=$Q)) and `status`='ok'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                //echo "unfrnd";
                                
                                ?><a href="Script/becomefrnd.php?tokenRemove=<?php echo $Q; ?>" class="btn btn-danger btn-sm">Unfriend</a><?php
                            }?>
                   <script>
                       $("#btnAdd").click(function(){
                           $("#btnAdd").text("Sended.!");
                       });
                   </script>
                   <a class="btn btn-success btn-sm pull-right" href="viewfriend.php?token=<?php echo $data['id']?>">View Profile</a>
               </div>
           </div>
          <?php
          }
          }
          ?>
       </div>
         
       <div class="col-md-3">
           <?php
                $temp=0;  
                $pRow = mysql_query("select * from `posts` where `post` like '%$Sqry%'");
                  while($data = mysql_fetch_array($pRow))
                  {
                    if($temp===0)
                     {  
                        ?><p>Post's</p><?php 
                        $temp=1;
                    } ?>
              <div class="panel panel-danger">
                                    
                                <!--<div class="panel-heading">
                                   <a style="text-decoration: none;color: white" href="user.php?user=<?php echo $data["userid"];?>"><?php echo ucfirst($udata["fname"]); ?>'s </a><small class="pull-right"><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></small> <?php echo "<center>".$data["type"]."</center>"; ?>
                                </div>-->
                                  <?php 
                                  $x=0;
                                  if($data["pid"]=="" || $data["pid"]==" " || $data["pid"]==null)
                                  {
                                     if($data["postimg"]=="")
                                    {
                                        
                                    }
                                    else
                                    {
                                       
                                            $postimgRow=  mysql_query("SELECT * FROM `postimage` WHERE `postsid`=$data[id]");
                                            if(mysql_affected_rows()===1)
                                            { ?>
                                                <center><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></center>
                                            <?php }else{ 
                                            while($postimgData=  mysql_fetch_array($postimgRow))
                                            {
                                            ?>
                                            <label><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:50px;padding:1px;margin-top:5px"></label>
                                            <?php
                                            } 
                                            }
                                         
                                    }
                                    
                                  }
                                  else
                                  {
                                      
                                      if($data["postimg"]=="")
                                    {
                                        
                                    }
                                    else
                                    {
                                        $x=1;
                                    ?>
                               <center><img src="ProImg/<?php echo $data["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></center><br/>
                               
                                    <?php
                                    }
                                  }
                                    ?>
                                <div class="panel-body">
                                  
                                    <po style="word-wrap: break-word">                                 
                                        <?php
                                        echo $data["post"];
                                        ?>
                                        <br>
                                        
                                       
                                    </po>
                                     <div id="x1<?php echo $data['id']; ?>"  class="collapse">
                                         <hr>
                                         <!--<a ><span class="glyphicon glyphicon-arrow-up"> </span>Show All Comments</a>-->
                                         <div style="padding: 10px">
                                             <?php
                                              $rowComm = mysql_query("SELECT `id`, `postsid`, `userid`, `comments`, `dt` FROM `comment` WHERE `postsid`='$data[id]' ");
                                              if(mysql_num_rows($rowComm)==0)
                                              {
                                                  ?>
                                              <com id="Ib<?php echo $data['id']; ?>">
                                                  <center>Be The First To Comment</center>
                                              </com>
                                              <?php

                                              }
                                              while ($CommArr = mysql_fetch_array($rowComm))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$CommArr[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com id="Icom<?= $CommArr["id"]; ?>">
                                                       <p style="margin-bottom: -1px"><img src="userPic/<?php echo $UData['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <br/><?php echo $UData['fname']; ?> <small><?php $date = date_create($CommArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                                                            <?php if($_SESSION['UID']==$CommArr['userid'])
                                                            {
                                                                ?><span  class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delComm('<?php echo $CommArr['id']; ?>','<?php echo $CommArr['postsid']; ?>','I');"></span><?php
                                                            }
                                                           else 
                                                           {
                                                           }
                                                           ?>
                                                          </p>
                                                       <commnet1 style="padding: 10px;margin-left:9px;color: red"><?php echo $CommArr['comments'];?></commnet1>
                                                   </com>
                                                  <?php
                                              }
                                             ?>
                                             <br><label id="Ilbl<?php echo $data['id']; ?>"></label>
                                         </div>
                                         <textarea class="form-control" id="CommentMgs<?php echo $data['id']; ?>"></textarea>
                                         <button class='btn btn-sm btn-info' onclick="CommentIt('<?php echo $data['id']; ?>','I')">Comment</button>
                                      </div>
                                </div>
                                <div class="panel-footer">
                                    <?php
                                    //Getting user like or Unlike
                                    $RowLike= mysql_query("select * from `like` where `userid`='$_SESSION[UID]' and `postsid`='$data[id]' ");
                                    if(mysql_num_rows($RowLike)==0)
                                    {   $Cheer="<img src='images/logo/BATURFLY2.png' widht=20px height=20px></img>";    }
                                    else
                                    {   $Cheer="<img src='images/logo/BATURFLY.png' widht=20px height=20px></img>";    }
                                    ?>
                                    <button class=" " style="background-color: transparent;border: none" id='btn_nice<?php echo $data["id"]; ?>' value="<?php echo $data["id"]; ?>"><?php echo $Cheer; ?> <span class="badge"><?php echo $data["like"]; ?></span></button>
                                    <?php
                                    $RowTotCom = mysql_query("SELECT count(*)as `totCom` FROM `comment` WHERE `postsid`='$data[id]'");
                                    $TotCom = mysql_fetch_array($RowTotCom);
                                    
                                    ?>
                                    <button style="background-color: transparent;border: none;margin-left: -10px" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Comment <span class="badge" id="Isp<?php echo $data['id']; ?>"><?php echo $TotCom['totCom'];  ?></span></button>
                                    <?php
                                    if($x==1)
                                    {
                                        if($data['userid']==$_SESSION['UID'])
                                        {
                                            ?><a href="Hub.php?hid=<?= $data['hid'] ?>&uid=<?= $data['userid'] ?>" style="text-decoration: none"><small style="font-size:8px;font-weight: bold">HUB</small></a><?php
                                        }
                                        else 
                                        {
                                        ?><a href="viewhub.php?hid=<?= $data['hid'] ?>&uid=<?= $data['userid'] ?>" style="text-decoration: none"><small style="font-size:8px;font-weight: bold">HUB</small></a><?php    
                                        }
                                    }
?>




                                    <script>
                                         $("#btn_nice<?php echo $data["id"]; ?>").click(function()
                                          {


                                              var postIDI=$("#btn_nice<?php echo $data["id"]; ?>").val();

                                              $.post("Script/like.php",{id:postIDI},function(data1)
                                              {
                                                  if(data1.substring(0,4)==="Like")
                                                  {         
                                                      
                                                       $("#btn_nice<?php echo $data["id"]; ?>").html("<img src='images/logo/BATURFLY.png' widht=20px height=20px></img> <span class='badge'>"+data1.substring(4)+"</span>");
                                                      //location.reload();
                                                  }
                                                  else
                                                  {
                                                     // location.reload();
                                                     $("#btn_nice<?php echo $data["id"]; ?>").html("<img src='images/logo/BATURFLY2.png' widht=20px height=20px></img> <span class='badge'>"+data1.substring(6)+"</span>");
                                                  }


                                              });

                                          });
                                    </script>
                                   <?php
                                    
                                    if($data["ytlink"]=="" ||$data["ytlink"]==" "||$data==null)
                                    {

                                    }
                                    else 
                                    {
                                        ?><span class="glyphicon glyphicon-film" style="cursor: pointer" data-toggle="modal" data-target="#myYT<?= $data["id"] ?>"></span>
                                            <div id="myYT<?= $data["id"] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">YouTube Video</h4>
                                                </div>
                                                <div class="modal-body">
                                                      <div class="embed-responsive embed-responsive-4by3">
                                                  <iframe width="565px" height="280px" src="https://www.youtube.com/embed/<?= $data["ytlink"] ?>" frameborder="0" allowfullscreen></iframe>
                                                      </div>s
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>

                                            </div>
                                          </div>
                                            <?php   
                                    }
                                    ?>
                                </div>
                            </div>
           <?php
                  }
           ?>
       </div>
      
       <div class="col-md-3">
         
           <?php
                    $temp=0;
                      $prorow = mysql_query("select * from `product` where `name` like '%$Sqry%'");
                      while($prodata = mysql_fetch_array($prorow))
                      {
                        
                          if($temp===0)
                            {  
                                ?><p>Products</p><?php 
                                $temp=1;
                            } ?>
                        <div class="panel panel-primary">
                            <center><img src="ProImg/<?= $prodata['prdimg'] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></center>
                            <div class="panel-body">
                                <?php
                                $h= mysql_query(" select * from `hub` where id = $prodata[hid]");
                                      $d11 = mysql_fetch_array($h);
                                      echo "Hub : <a href='viewhub.php?hid=$prodata[hid]&uid=$prodata[uid]'>".ucfirst($d11['name'])."</a><br/>";
                                ?> 
                                <?php $h= mysql_query(" select * from `category` where id = $prodata[cid]");
                                      $d11 = mysql_fetch_array($h);
                                      echo "Category : ".ucfirst($d11['name']);
                                ?> / 
                                <?php $h= mysql_query(" select * from `subcategory` where id = $prodata[sid]");
                                      $d11 = mysql_fetch_array($h);
                                      echo ucfirst($d11['name']);
                                ?> <br/>
                                    <?php echo "ProductName : ".$prodata['name']; ?><br/>
                                
                                    <span class="badge">Rs.<?php echo $prodata['price']; ?>/-</span>
                            </div>
                            <div class="panel-footer">
                                <a href="viewhub.php?hid=<?php echo $prodata["hid"]; ?>" class="btn btn-default">View Product</a>
                            </div>
                        </div>
                        <?php
                       }
           ?>
       </div>
          
          <div class="col-md-3">
           
           <?php
                    $temp=0;
                      $prorow = mysql_query("select * from `hub` where `name` like '%$Sqry%'");
                      while($prodata = mysql_fetch_array($prorow))
                      {
                        
                         if($temp===0)
                        {  
                            ?><p>Hub</p><?php 
                            $temp=1;
                        } ?>
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
                                <small>Created By <a href="viewfriend.php?token=<?php echo $dataOfU["id"]; ?>"><?php echo ucfirst($dataOfU['fname'])." ".ucfirst($dataOfU['lname']); ?></a></small>
                            </div>
                            <div class="panel-footer">
                                <a href="viewhub.php?hid=<?php echo $prodata['id']; ?>" class="btn btn-default">Explore Hub</a>
                            </div>
                        </div>
                        <?php
                       }
           ?>
       </div>
      </div>
  </body>
</html>

      
      
  </body>
</html>