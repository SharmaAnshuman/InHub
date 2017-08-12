<?php
session_start();
if(isset($_SESSION["user"]))
{
    include './config/conn.php';
    $uq = mysql_query("select * from `login` where email='$_SESSION[user]'");
    $m = mysql_fetch_array($uq);
    if($_REQUEST['token']===$_SESSION['UID'])
    {
        header("Location: home.php");
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
      <div class="container">
          
                <?php
                $Q = mysql_escape_string($_REQUEST["token"]);
                $q = mysql_query("select * from `login` where id =$Q ");
                $qarr  = mysql_fetch_array($q);
                
              ?>              
          
      </div>
          <br/><br/>
          
            <!-- cover photo -->

              <div class='container'>
                  
          <div class="col-md-8">
              
              <div class="" style="height: 250px;padding:9px" id="uploadCoverPic" >
                  <img src="userPic/<?php echo $qarr["coverimg"]; ?>"  style="background-image:url(images/business_background.jpg);" height="100%" width="100%">
                 
                            <img src="userPic/<?php echo $qarr["profileimg"]; ?>" height="120px" width="120px" style="background-image:url(graphics/default-cover.png);margin-left: 10px;margin-top:-150px;border:none;box-shadow:0px 1px 5px 1px black" id="uploadProfilePic" />

                 
                  <br/>
              </div>
            <br/><br/><br/>
               
            </div>
                  <div class="col-md-4">
                      <h4><?php echo ucfirst($qarr['fname'])." ".ucfirst($qarr['lname']); ?><br/><small  style="color:blue;font-weight: bolder">(<?php echo $qarr['cat'];?>)</small></h4>
              <h5>Visit Hub<br/>
              <?php
              $rowd = mysql_query("select * from `hub` where uid='$Q'");
              while($datahub= mysql_fetch_array($rowd))
              {
              ?>
                  <small><a style="color:blue;font-weight: bolder" href='viewhub.php?hid=<?= $datahub['id'] ?>'><?= $datahub['name'] ?></a></small> / 
                  <?php
              }
                  ?>
              </h5>
              <!-- <h6>Hub Member <br/><small  style="color:blue;font-weight: bolder">1098</small> </h6> -->
              <?php
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
                                ?><a href="Script/becomefrnd.php?tokenRemove=<?php echo $Q; ?>" class="btn btn-default btn-sm">Cancle Request.!</a><?php
                            }
                            $result =mysql_query("select * from `friends` where `sender`=$Q and `receiver`=$_SESSION[UID] and `status`='panding'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                $aq = mysql_fetch_array($result);
                                ?>
                                    <small>You Received Friend Request</small>              <br/>
                                    <a href="Script/becomefrnd.php?OK=<?php echo $Q; ?>" class="btn btn-sm btn-success">Add</a>&nbsp;<a href="Script/becomefrnd.php?NOT=<?php echo $aq['id']; ?>" class="btn btn-sm btn-default">Delete</a>
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
          </div>
          
          </div>
            <br/>
            <div class="container-fluid">
           <div class="col-md-2" >
               <div class="panel panel-primary" style="border-color: #4d88ff">
                    <div class="panel-heading" style="background-color: #4d88ff">
                       <h4 class="panel-title">
                            Circle
                       </h4>
                   </div>
                       <div class="panel-body" style="overflow-y: auto ;overflow-x: auto;max-height: 300px">
                           
                              <?php $row11= mysql_query("select * from `friends` where (`sender`=$Q or `receiver`=$Q) and `status`='ok' and `receiver`!=$_SESSION[UID] and `sender`!=$_SESSION[UID]");
                               while($data=  mysql_fetch_array($row11))
                              {
                                 if($data['receiver']===$Q){
                                     $row12= mysql_query("select * from `login` where id=$data[sender]");
                                 }
                                 else{
                                  $row12= mysql_query("select * from `login` where id=$data[receiver]");
                                 }
                              while($data12=  mysql_fetch_array($row12))
                              {                                
                                  ?>
                                <a href="viewfriend.php?token=<?php echo $data12['id']; ?>"  data-toggle="tooltip" title="<?php echo $data12['fname']; echo ' '; echo $data12['lname']; ?>"><img src="userPic/<?php echo $data12['profileimg']; ?>"  onerror="this.src='userPic/none.png'" height="30px" width="30px" style="border-radius: 2em"></a>
                              <?php 
                              }}?>
                           
                          </div>
                </div>
          </div>
            <span class="hidden-sm hidden-xs">
              <label style="width:350px;"><center><label id="lblInfo" style="cursor: pointer" ondblclick="document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colBussi').setAttribute('style','width:350px');document.getElementById('colNews').setAttribute('style','width:350px');" onclick="if(document.getElementById('colInfo').offsetWidth===900){document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colBussi').setAttribute('style','width:350px');document.getElementById('colNews').setAttribute('style','width:350px');document.getElementById('colNews').style.display='initial';document.getElementById('colBussi').style.display='initial';document.getElementById('lblNews').style.color='black';document.getElementById('lblBussi').style.color='black';}else{document.getElementById('colInfo').setAttribute('style','width:900px');document.getElementById('colNews').setAttribute('style','width:350px');document.getElementById('colBussi').setAttribute('style','width:350px');document.getElementById('colNews').style.display='none';document.getElementById('colBussi').style.display='none';document.getElementById('lblInfo').style.color='black';document.getElementById('lblNews').style.color='#d9d9d9';document.getElementById('lblBussi').style.color='#d9d9d9';}"><p>Information</p></label></center></label>
              <label style="width:350px;"><center><label id="lblNews" style="cursor: pointer" ondblclick="document.getElementById('colNews').setAttribute('style','width:350px');document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colBussi').setAttribute('style','width:350px');" onclick="if(document.getElementById('colNews').offsetWidth===900){document.getElementById('colNews').setAttribute('style','width:350px');document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colBussi').setAttribute('style','width:350px');document.getElementById('colInfo').style.display='initial';document.getElementById('colBussi').style.display='initial';document.getElementById('lblInfo').style.color='black';document.getElementById('lblBussi').style.color='black';}else{document.getElementById('colNews').setAttribute('style','width:900px');document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colBussi').setAttribute('style','width:350px');document.getElementById('colInfo').style.display='none';document.getElementById('colBussi').style.display='none';document.getElementById('lblNews').style.color='black';document.getElementById('lblInfo').style.color='#d9d9d9';document.getElementById('lblBussi').style.color='#d9d9d9';}"><p>News</p></label></center></label>
              <label style="width:350px;"><center><label id="lblBussi" style="cursor: pointer" ondblclick="document.getElementById('colBussi').setAttribute('style','width:350px');document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colNews').setAttribute('style','width:350px');" onclick="if(document.getElementById('colBussi').offsetWidth===900){document.getElementById('colBussi').setAttribute('style','width:350px');document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colNews').setAttribute('style','width:350px');document.getElementById('colNews').style.display='initial';document.getElementById('colInfo').style.display='initial';document.getElementById('lblNews').style.color='black';document.getElementById('lblInfo').style.color='black';}else{document.getElementById('colBussi').setAttribute('style','width:900px');document.getElementById('colInfo').setAttribute('style','width:350px');document.getElementById('colNews').setAttribute('style','width:350px');document.getElementById('colNews').style.display='none';document.getElementById('colInfo').style.display='none';document.getElementById('lblBussi').style.color='black';document.getElementById('lblNews').style.color='#d9d9d9';document.getElementById('lblInfo').style.color='#d9d9d9';}"><p>Business</p></label></center></label>  
          </span>          
          <div class="col-md-10" style="max-height: 600px;overflow-x: auto">
          <div class="col-md-4" id="colInfo">   
              <label class="hidden-md hidden-lg">Informative</label>
                  <?php
                  
                  $row = mysql_query("select * from `posts` where `type`='Informative Deal' and `userid`= $Q or id IN(SELECT postsid from `like` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='Informative Deal')) or id IN(SELECT postsid from `comment` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='Informative Deal')) order by id desc");
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
              
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                <po style="word-wrap: break-word">
                                    <?php 
                                    $temp=0;
                                    $likePostRow=  mysql_query("SELECT postsid from `like` where userid=$Q order by id desc ");
                                    while($likePostData=  mysql_fetch_array($likePostRow))
                                    {
                                        if($data["id"]==$likePostData["postsid"])
                                        {
                                            $temp=1; 
                                            break;
                                        }
                                    }
                                    $ctemp=0;
                                    $likePostRow=  mysql_query("SELECT postsid from `comment` where userid=$Q order by id desc ");
                                    while($likePostData=  mysql_fetch_array($likePostRow))
                                    {
                                        if($data["id"]==$likePostData["postsid"])
                                        {
                                            $ctemp=1; 
                                            break;
                                        }
                                    }     
                                    ?>
                                   <img src="userPic/<?= $qarr['profileimg'] ?>" height="20px" width="20px" class="img-rounded"><?php if($temp==1 && $ctemp==1){ echo $qarr["fname"]." Buzzed and Commnets on ";}else if($temp==1){ echo $qarr["fname"]." Buzzed "; }else if($ctemp==1){echo $qarr["fname"]." Commnets on ";}  ?><small><a style="text-decoration: none" href="viewfriend.php?token=<?= $udata['id'] ?>"> <?= ucfirst($udata['fname'])." ".ucfirst($udata['lname']) ?></a><?php if($temp==1|| $ctemp==1){ ?> 's Informative Deal<?php }  ?></small>
                                </po><hr>
                                  <?php if($data["postimg"]=="")
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
                                    ?> 
                                
                                  
                                    <po style="word-wrap: break-word">                                 
                                        <?php
                                        echo $data["post"];
                                        ?>
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
          <div class="col-md-4" id="colNews">
               <label class="hidden-md hidden-lg">News</label>
                  <?php
                
                    $row = mysql_query("select * from `posts` where `type`='News Deal' and `userid`= $Q or id IN(SELECT postsid from `like` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='News Deal')) or id IN(SELECT postsid from `comment` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='News Deal')) order by id desc");
                
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
                            <div class="panel panel-danger">
                                <div class="panel-body">    
                                <po style="word-wrap: break-word">
                                    <?php 
                                    $temp=0;
                                    $likePostRow=  mysql_query("SELECT postsid from `like` where userid=$Q order by id desc ");
                                    while($likePostData=  mysql_fetch_array($likePostRow))
                                    {
                                        if($data["id"]==$likePostData["postsid"])
                                        {
                                            $temp=1; 
                                            break;
                                        }
                                    }
                                    $ctemp=0;
                                    $likePostRow=  mysql_query("SELECT postsid from `comment` where userid=$Q order by id desc ");
                                    while($likePostData=  mysql_fetch_array($likePostRow))
                                    {
                                        if($data["id"]==$likePostData["postsid"])
                                        {
                                            $ctemp=1; 
                                            break;
                                        }
                                    }     
                                    ?>
                                   <img src="userPic/<?= $qarr['profileimg'] ?>" height="20px" width="20px" class="img-rounded"><?php if($temp==1 && $ctemp==1){echo $qarr["fname"]." Buzzed and Commnets on ";}else if($temp==1){ echo $qarr["fname"]." Buzzed "; }else if($ctemp==1){echo $qarr["fname"]." Commnets on ";}  ?><small><a style="text-decoration: none" href="viewfriend.php?token=<?= $udata['id'] ?>"> <?= ucfirst($udata['fname'])." ".ucfirst($udata['lname']) ?></a><?php if($temp==1 || $ctemp==1){ ?> 's News Deal<?php }  ?></small>
                                </po><hr>
                                 <?php if($data["postimg"]=="")
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
                                    ?> 
                                
                                  
                                    <po style="word-wrap: break-word">                                 
                                        <?php
                                        echo $data["post"];
                                        ?>
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
                                              <com id="Nb<?php echo $data['id']; ?>">
                                                  <center>Be The First To Comment</center>
                                              </com>
                                              <?php

                                              }
                                              while ($CommArr = mysql_fetch_array($rowComm))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$CommArr[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com id="Ncom<?= $CommArr["id"]; ?>">
                                                       <p style="margin-bottom: -1px"><img src="userPic/<?php echo $UData['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <br/><?php echo $UData['fname']; ?> <small><?php $date = date_create($CommArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                                                            <?php if($_SESSION['UID']==$CommArr['userid'])
                                                            {
                                                                ?><span  class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delComm('<?php echo $CommArr['id']; ?>','<?php echo $CommArr['postsid']; ?>','N');"></span><?php
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
                                             <br><label id="Nlbl<?php echo $data['id']; ?>"></label>
                                         </div>
                                         <textarea class="form-control" id="CommentMgs<?php echo $data['id']; ?>"></textarea>
                                         <button class='btn btn-sm btn-info' onclick="CommentIt('<?php echo $data['id']; ?>','N')">Comment</button>
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
                                    <button style="background-color: transparent;border: none" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Comment <span class="badge" id="Nsp<?php echo $data['id']; ?>"><?php echo $TotCom['totCom'];  ?></span></button>
                                    


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
          <div class="col-md-4" id="colBussi">
               <label class="hidden-md hidden-lg">Business</label>
                  <?php
                  
                    $row = mysql_query("select * from `posts` where `type`='Business Deal' and `userid`= $Q or id IN(SELECT postsid from `like` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='Business Deal')) or id IN(SELECT postsid from `comment` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='Business Deal')) order by id desc");
                  
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
                            <div class="panel panel-warning">
                                    
                               <div class="panel-body">    
                                <po style="word-wrap: break-word">
                                    <?php 
                                    $temp=0;
                                    $likePostRow=  mysql_query("SELECT postsid from `like` where userid=$Q order by id desc ");
                                    while($likePostData=  mysql_fetch_array($likePostRow))
                                    {
                                        if($data["id"]==$likePostData["postsid"])
                                        {
                                            $temp=1; 
                                            break;
                                        }
                                    }
                                            $ctemp=0;
                                    $likePostRow=  mysql_query("SELECT postsid from `comment` where userid=$Q order by id desc ");
                                    while($likePostData=  mysql_fetch_array($likePostRow))
                                    {
                                        if($data["id"]==$likePostData["postsid"])
                                        {
                                            $ctemp=1; 
                                            break;
                                        }
                                    }     
                                    ?>
                                   <img src="userPic/<?= $qarr['profileimg'] ?>" height="20px" width="20px" class="img-rounded"><?php if($temp==1 && $ctemp==1){echo $qarr["fname"]." Buzzed and Commnets on ";}else if($temp==1){ echo $qarr["fname"]." Buzzed "; }else if($ctemp==1){echo $qarr["fname"]." Commnets on ";}  ?><small><a style="text-decoration: none" href="viewfriend.php?token=<?= $udata['id'] ?>"> <?= ucfirst($udata['fname'])." ".ucfirst($udata['lname']) ?></a><?php if($temp==1 || $ctemp==1){ ?> 's Business Deal<?php }  ?></small>
                                </po><hr>
                                  <?php if($data["postimg"]=="")
                                    {
                                        
                                    }
                                    else
                                    {
                                        if($data['pid']=="" || $data['pid']==null || $data['pid']==" " )
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
                                        else
                                        {
                                            ?><center><img src="ProImg/<?php echo $data["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></center><?php
                                        }
                                    
                                    }
                                    ?>
                               
                                  
                                    <po style="word-wrap: break-word">                                 
                                        <?php
                                        echo $data["post"];
                                        ?>
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
                                              <com id="Bb<?php echo $data['id']; ?>">
                                                  <center>Be The First To Comment</center>
                                              </com>
                                              <?php

                                              }
                                              while ($CommArr = mysql_fetch_array($rowComm))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$CommArr[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com id="Bcom<?= $CommArr["id"]; ?>">
                                                       <p style="margin-bottom: -1px"><img src="userPic/<?php echo $UData['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <br/><?php echo $UData['fname']; ?> <small><?php $date = date_create($CommArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                                                            <?php if($_SESSION['UID']==$CommArr['userid'])
                                                            {
                                                                ?><span  class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delComm('<?php echo $CommArr['id']; ?>','<?php echo $CommArr['postsid']; ?>','B');"></span><?php
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
                                             <br><label id="Blbl<?php echo $data['id']; ?>"></label>
                                         </div>
                                         <textarea class="form-control" id="CommentMgs<?php echo $data['id']; ?>"></textarea>
                                         <button class='btn btn-sm btn-info' onclick="CommentIt('<?php echo $data['id']; ?>','B')">Comment</button>
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
                                    <button style="background-color: transparent;border: none;margin-left: -10px" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Comment <span class="badge" id="Bsp<?php echo $data['id']; ?>"><?php echo $TotCom['totCom'];  ?></span></button>
                                    <?php
                                    if($data["hid"]>0)
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
          </div>
            </div>
            
              
      
  </body>
</html>