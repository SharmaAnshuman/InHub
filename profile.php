<?php
session_start();
if(isset($_SESSION["user"]))
{
    include './config/conn.php';
    $uq = mysql_query("select * from `login` where email='$_SESSION[user]'");
    $m = mysql_fetch_array($uq);
    if(isset($_REQUEST["btn_editcat"]))
   {
       $catName = $_REQUEST["catName"];
       mysql_query("UPDATE `login` SET `cat`='$catName' where id=$_SESSION[UID]");
       echo "<script>window.location='profile.php'</script>";
        
   }  
   if(isset($_REQUEST["btn_editname"]))
   {
       $fName = $_REQUEST["fname"];
       $lName = $_REQUEST["lname"];
       mysql_query("UPDATE `login` SET `fname`='$fName',`lname`='$lName' where id=$_SESSION[UID]");
       echo "<script>window.location='profile.php';</script>"; 
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
    <title>:: Profile :: InHub's</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
        <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="text/jquery-te-1.4.0.css">
<script type="text/javascript" src="text/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="text/jquery-te-1.4.0.min.js" charset="utf-8"></script>
    <script>
    $(document).ready(function()
    {
        $("#ProfilePic").click(function()
           {
               $("#profilePicModal").modal('show');
           });
           
           $("#CoverPic").click(function()
           {
               $("#coverPicModal").show();
              
           });
        
        $("#ecat").click(function()
           {
               $("#editcat").show();
              
           });
        $("#ename").click(function()
           {
               $("#editname").show();
              
           });
   
   
    function postShare()
        {
            var c=$("#shareTxt").val();
            
            if(c==="" || c===" ")
            {
                alert("Enter Details to Post");
            }
            else
            {
                
                    var zxc =  $('input[name="s"]:checked').val();
                   
                    
                  /*  $.post("Script/post.php",{post:c,protype:zxc},function(data)
                    {
                       if(data == "Posted")
                       {
                           window.location='home.php';
                       }
                       else
                       {
                           window.location='home.php';
                       }
                    });*/
                
                
            }
            return true;
        }
        
      

	$('.jqte-test').jqte();
	
    });
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
        
        function dpost(pi)
        {
             if(confirm("Are you want to sure Delete!"))
             {
            $("#PDis"+pi).hide();
            $.post("deletepost.php",{PID:pi},function(data)
            {
            });
             }
             
        }
    </script>
 
<style>
.mySlides {display:none;}
#myProgress {
    position: relative;
    width: 20%;
    height: 30px;
    
}
#myBar {
    position: absolute;
    width: 1%;
    height: 100%;
    background-color: green;
}
#label {
  text-align: center;
  line-height: 20px;
  color: white;
}
</style>
<script type="text/javascript">
function move() {
    var elem = document.getElementById("myBar"); 
    var width = 1;
    var id = setInterval(frame, 10);
    
    function frame() {
        if (width >= 100) {
            clearInterval(id);
            brk=1;
            
            document.getElementById("myBar").style.display="none";
            document.getElementById("ep").style.display="initial";
            document.getElementById("b").innerHTML="Uplaod Picture";
            
        } else {
            width++; 
            elem.style.width = width + '%'; 
             document.getElementById("label").innerHTML = 'Uploading..';
        }       
    }
}
 function ePreviewImage() {
     
       var fileUpload = document.getElementById("a1");
  
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("ep");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:\*\[\]\{\}\(\)])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileUpload.files.length; i++) {
                var file = fileUpload.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.height = "50";
                        img.width = "50";
                        img.src = e.target.result;
                        dvPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert(file.name + " is not a valid image file. OR invalid name");
                    dvPreview.innerHTML = "";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }
    

</script>
  </head>
  <body style="background-image: url(images/business_background.jpg);background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
      
        
            <?php
                include './include/header.php';
                 
               
                $Q = $_SESSION["UID"];
                $q = mysql_query("select * from `login` where id =$Q ");
                $qarr  = mysql_fetch_array($q);
                
            ?>
          <br/><br/>
          <div class="container" style="margin-bottom: 10px">
            <!-- cover photo -->

              <div class="jumbotron container col-md-9" style="max-width:870px ;height: 250px;padding:9px" id="uploadCoverPic" >
                  <img src="userPic/<?php echo $m["coverimg"]; ?>"  style="background-image:url(images/business_background.jpg);" height="100%" width="100%">
                  <h3><span class="glyphicon glyphicon-pencil pull-right" style="color:white ;margin-top:-60px;margin-right: 10px;cursor: pointer" id="CoverPic" data-toggle="modal" data-target="#coverPicModal">upload</span></h3>
                  
                  <?php
                              $hRow = mysql_query("select * from `hub` where `uid`=$_SESSION[UID]");
                              $toKK = mysql_num_rows($hRow);
                               ?><img src="userPic/<?php echo $m["profileimg"]; ?>" class="mySlides" name="mySlides" height="120px" width="120px" style="background-image:url(graphics/default-cover.png);margin-left: 10px;margin-top:-150px;border:none;box-shadow:0px 1px 5px 1px black" /><?php
                              if($toKK!=0)
                              {
                                while($hdata = mysql_fetch_array($hRow))
                                {
                                    if($hdata['hubimg']=="" ||$hdata['hubimg']==" " ||$hdata['hubimg']==null)
                                    {
                                        ?><img src="images/logo/HubLogo.png" class="mySlides" name="mySlides" height="120px" width="120px" style="background-image:url(graphics/default-cover.png);margin-left: 10px;margin-top:-150px;border:none;box-shadow:0px 1px 5px 1px black" /><?php
                                    }
                                    else {
                                        ?><img src="userPic/<?php echo $hdata["hubimg"]; ?>" class="mySlides" name="mySlides" height="120px" width="120px" style="background-image:url(graphics/default-cover.png);margin-left: 10px;margin-top:-150px;border:none;box-shadow:0px 1px 5px 1px black" /><?php
                                    }
                                }
                              }
                                 
                              
                  ?>
                  
                  
                  
                                            <script>
                                                
                                         var myIndex = 0;
                                         carousel();

                                         function carousel() {
                                             var i;
                                             var x = document.getElementsByClassName("mySlides");
                                             for (i = 0; i < x.length; i++) {
                                                x[i].style.display = "none"; 
                                             }
                                             myIndex++;
                                             if (myIndex > x.length) {myIndex = 1}    
                                             x[myIndex-1].style.display = "block";  
                                             setTimeout(carousel, 2000); // Change image every 2 seconds
                                         }
                                         </script>
                  <span class="glyphicon glyphicon-pencil" style="cursor: pointer;margin-left: 10px;padding-top: 20px;margin-left: 20px" data-toggle="modal" data-target="#profilePicModal">
                      <x style="margin-left: -10px">UploadPicture</x></span>
                  <br/>
              </div>
            <div class="col-md-2">
                
                    <h4><?php echo ucfirst($qarr['fname'])." ".ucfirst($qarr['lname']); ?><br/><small  style="color:blue;font-weight: bolder">(<?php echo $qarr['cat'];?>)</small></h4>
              <h5>Visit Hub<br/><small>
              <?php
              $rowd = mysql_query("select * from `hub` where uid='$Q'");
              while($datahub= mysql_fetch_array($rowd))
              {
              ?>
                  <a style="color:blue;font-weight: bolder" href='hub.php?hid=<?= $datahub['id'] ?>'><?= $datahub['name'] ?></a>/ 
                  <?php
              }
                  ?>
                  </small> 
              </h5>
                </div>
           

            </div>
            <br/>
    <div class="container">
        <div class="col-md-2" >
             <a href="profile.php"><img src="userPic/<?php echo $m["profileimg"]; ?>" style="height: 30px;width:30px"> <?php echo ucfirst($m["fname"]." ".$m["lname"]); ?>  </a><a id="ename" data-toggle="modal" data-target="#editname"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
             <?php echo "(".$m["cat"].")"; ?><a id="ecat" data-toggle="modal" data-target="#editcat"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
       </div>  
      <div class="col-md-7">
          
          <form action="Script/post.php?p" method="post" enctype="multipart/form-data" onsubmit="return postShare()">
              <div style="margin-bottom: -30px;"><textarea class="jqte-test" id="shareTxt" name="post"></textarea></div>
              <input type="text" name="ytlink" placeholder="Youtube Link" id="otherBtn" class="form-control col-md-12"/> 
              <label id="ep"></label><br>
              <label for="a1" style="cursor: pointer;background-color: transparent"  id="myProgress"><div id="myBar" class="btn btn-default"><div id="label"></div></div><div><small id="b">Upload Picture</small></div></label>
               <label id="video" style="cursor: pointer" class="btn btn-default" ><small>Video</small></label>
               <input type="file" name="postPic[]" style="display: none" id="a1" onchange="ePreviewImage();move();" multiple="multiple"/>
              
              <script>
                  $(document).ready(function()
                  {
                      $("#otherBtn").hide();
                       $("#myBar").hide();
                       $("#ep").hide();
                       
                       $("#a1").change(function(){
                           $("#ep").hide();
                           $("#myBar").show();
                           $("#b").text("Uploding");
                       });
                      $("#video").click(function()
                      {
                              $("#otherBtn").show();
                      });
                  });
              </script>
              <select style="margin-left: 2px" id="posttype" name="posttype" class="btn btn-toolbar">
                  <option value="Informative Deal">Informative Deal</option>
                  <option value="News Deal">News Deal</option>
                  <option value="Business Deal">Business Deal</option>
              </select>
             
              
              <button class="btn btn-success pull-right" style="margin-top: 5px">Share</button>
          </form>
          </div>
       
      </div>
      
      
      <br/>
      <div class="container-fluid">  
            <div class="col-md-2">
               <div class="panel panel-primary">
                   <div class="panel-heading" data-toggle="" data-parent="#accordion" href="#collapse2" style="cursor: pointer;background-color: #4d88ff">
                       <h4 class="panel-title">
                           <a data-toggle="" data-parent="#accordion" href="#collapse2">My Circle</a>
                       </h4>
                   </div>
                   <div id="collapse2" class="panel-collapse    ">
                       <div class="panel-body" style="border-color: #4d88ff;max-height: 300px">
                           
                               <?php 
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
                                  ?>
                           <a href="#" id="vv<?php echo $data12['id']; ?>" data-toggle="tooltip" title="<?php echo ucfirst($data12['fname']); echo ' '; echo ucfirst($data12['lname']);  ?>"><img src="userPic/<?php echo $data12['profileimg']; ?>" onerror="this.src='userPic/none.png'" height="30px" width="30px" style="border-radius: 2em"></a>
                              <script>
                              $("#vv<?php echo $data12['id']; ?>").click(function ()
                              {
                                  //alert("d");
                                  window.location='viewfriend.php?token=<?php echo $data12['id']; ?>';
                              });
                              </script>
                              <?php 
                              }}?>
                       </div>
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
                  <?php
                  
                  $row = mysql_query("select * from `posts` where `type`='Informative Deal' and `userid`= $Q or id IN(SELECT postsid from `like` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='Informative Deal')) or id IN(SELECT postsid from `comment` where userid=$Q and postsid IN(SELECT id FROM `posts` where type='Informative Deal')) order by id desc");
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
              
                            <div class="panel panel-primary" id="PDis<?= $data['id'] ?>">
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
                                   <img src="userPic/<?= $qarr['profileimg'] ?>" height="20px" width="20px" class="img-rounded"><?php if($temp==1 && $ctemp==1){echo $qarr["fname"]." Buzzed and Commnets on ";}else if($temp==1){ echo $qarr["fname"]." Buzzed "; }else if($ctemp==1){echo $qarr["fname"]." Commnets on ";}  ?><small><a style="text-decoration: none" href="viewfriend.php?token=<?= $udata['id'] ?>"> <?= ucfirst($udata['fname'])." ".ucfirst($udata['lname']) ?></a><?php if($temp==1 || $ctemp==1){ ?> 's Informative Deal<?php }  ?></small>
                                   <?php
                                         if($_SESSION["UID"]==$udata['id'])
                                         {
                                             ?><span style="cursor:pointer" class="pull-right glyphicon glyphicon-remove" onclick="dpost(<?= $data['id'] ?>)"></span><br/><?php
                                         }
                                         ?><br>
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
                            <div class="panel panel-danger" id="PDis<?= $data['id'] ?>">
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
                                <?php
                                         if($_SESSION["UID"]==$udata['id'])
                                         {
                                             ?><span style="cursor:pointer" class="pull-right glyphicon glyphicon-remove" onclick="dpost(<?= $data['id'] ?>)"></span><br/><?php
                                         }
                                         ?><br>
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
                            <div class="panel panel-warning" id="PDis<?= $data['id'] ?>">
                                    
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
                                <?php
                                         if($_SESSION["UID"]==$udata['id'])
                                         {
                                             ?><span style="cursor:pointer" class="pull-right glyphicon glyphicon-remove" onclick="dpost(<?= $data['id'] ?>)"></span><br/><?php
                                         }
                                         ?><br>
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



<div id="coverPicModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Cover Pic</h4>
      </div>
      <div class="modal-body">
          <div class="alert">
              File size must be lessthen 2 MB <br/>
              please choose a JPEG,JPG or PNG file.
          </div>
          <script>
              function uploadCover()
              {
                    var imgVal = $('#up').val();
                    if(imgVal=='')
                    {
                        alert("Select Cover Pic");
                        return false;
                    }
                return true;
              }
               
          </script>
          <form action="Script/upload.php?p" method="post" onsubmit="return uploadCover()" enctype="multipart/form-data">
              <input type="file" name="coverPic" style="display: none" id="up"/>
              <label class="btn btn-warning" for="up">Select File</label>
              <input type="submit" value="Upload" name="btn_coverPic" class="btn btn-success">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="profilePicModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Profile Pic</h4>
      </div>
      <div class="modal-body">
          <div class="alert">
              File size must be excately 2 MB<br/>
              please choose a JPEG,JPG or PNG file.
          </div>
          <script>
              function uploadProfile()
              {
                    var imgVal = $('#up1').val();
                    if(imgVal=='')
                    {
                        alert("Select Profile Pic");
                        return false;
                    }
                return true;
              }
               
          </script>
          <form action="Script/upload.php?p" method="post" onsubmit="return uploadProfile()" enctype="multipart/form-data">
              <input type="file" name="profilePic" style="display: none" id="up1"/>
              <label  class="btn btn-warning" for="up1">Select File</label>
              <input type="submit" value="Upload" name="btn_profilePic"  class="btn btn-success">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="editcat" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Change Category</h4>
      </div>
      <div class="modal-body">
       <div class="input-group">
                                 <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-lock"></i></small></span>
                                 <select required class="form-control" name="catName">
                                     <option>Select Your Profession</option>
                                     <option value="Science">Science</option>
                                     <option value="Arts">Art's</option>
                                     <option value="Commerce">Commerce</option>
                                     <option value="Government Employees">Government Employees</option>
                                     <option value="Corporate Employees">Corporate Employees</option>
                                     <option value="Self Employees">Self Employees</option>
                                     <option value="House Worker">House Worker</option>
                                     <option value="Politicians">Politicians</option>
                                     <option value="Social Activity">Social Activity</option>
                                 </select>
                                 
                             </div>
          
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-default" value="Change" name="btn_editcat"/>
      </div>
    </div>
</form>

  </div>
</div>
<div id="editname" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Change Category</h4>
      </div>
      <div class="modal-body">
      <div class="input-group">
          <?php 
                $nmrow=  mysql_query("SELECT * FROM `login` WHERE id=$_SESSION[UID]");
                $nmdata=  mysql_fetch_array($nmrow);
          ?>
            <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-edit"></i></small></span>
            <input type="text" class="form-control" placeholder="Frist Name" value="<?=  $nmdata["fname"]?>" required="" name="fname">
            <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-edit"></i></small></span>
            <input type="text" class="form-control" placeholder="Last Name" value="<?=  $nmdata["lname"]?>" required=""  name="lname">
      </div><br/>
          
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-default" value="Change" name="btn_editname"/>
      </div>
    </div>
</form>

  </div>
</div>