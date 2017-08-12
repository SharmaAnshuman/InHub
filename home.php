<?php
session_start();
include './config/conn.php';
if(isset($_SESSION["user"]))
{
    $uq = mysql_query("select * from `login` where email='$_SESSION[user]'");
    $m = mysql_fetch_array($uq);
    if(isset($_REQUEST["btn_editcat"]))
   {
       $catName = $_REQUEST["catName"];
       mysql_query("UPDATE `login` SET `cat`='$catName' where id=$_SESSION[UID]");
       echo "<script>window.location='home.php'</script>";
        
   }  
   if(isset($_REQUEST["btn_editname"]))
   {
       $fName = $_REQUEST["fname"];
       $lName = $_REQUEST["lname"];
       mysql_query("UPDATE `login` SET `fname`='$fName',`lname`='$lName' where id=$_SESSION[UID]");
       echo "<script>window.location='home.php';</script>"; 
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
        $("#hubmodal").click(function()
           {
               $("#myModal").show();
              
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
                
                
            ?>
          <br/><br/>
          <div class="container" style="margin-bottom: 10px">
            <!-- cover photo -->

              <div class="jumbotron container col-md-9" style="height: 250px;padding:9px" id="uploadCoverPic" >
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
            
              <div class="col-md-3">
          <!--Product orders -->
                           <?php 
                            $TotOrdRow=  mysql_query("select count(*) as Totord from `order` where pid IN (select id from product where uid=$_SESSION[UID]) and status='panding'");
                            $TotOrdData= mysql_fetch_array($TotOrdRow);
                            if($TotOrdData['Totord']>0)
                            {
                           ?>
                    <label><small>Your Hub Product Orders <span class="badge"><?php echo $TotOrdData['Totord']; ?> </span></small></label>
                      
                    
                         <div id="myCarousel1" class="carousel slide" data-ride="carousel"> 
                         <!-- Wrapper for slides -->
                         <div class="carousel-inner" role="listbox" style="min-height: 200px;">
                             
                              <?php
                                $temp=1;
                                $OrdRow=  mysql_query("select * from `order` where pid IN (select id from product where uid=$_SESSION[UID]) and status='panding'");
                                while($OrdData= mysql_fetch_array($OrdRow))
                                { 
                                    $PRow=  mysql_query("select * from `product` where id=$OrdData[pid]"); 
                                    $PData= mysql_fetch_array($PRow);
                                    $URow=  mysql_query("select * from `login` where id=$OrdData[uid]"); 
                                    $UData= mysql_fetch_array($URow);
                                    ?>
                                    <div class="item <?php if($temp==1){ $temp=0;  ?>active<?php } ?>">
                                        <center>
                                            <img src="ProImg//<?php echo $PData["prdimg"]; ?>"  style="height: 150px;width: 200px"/><br>
                                            <?php echo ucfirst($PData['name']); ?><br>
                                                <a href="viewfriend.php?token=<?php echo $UData['id']; ?>"><img src="userPic//<?php echo $UData["profileimg"]; ?>" style="width:20px; height:20px;"><?php echo ucfirst($UData["fname"]); echo " "; echo ucfirst($UData["lname"]); ?></a><br>
                                            Qty:<?php echo $OrdData["qty"]; ?><br>
                                       </center>
                                    </div>
                               <?php }
                                ?>
                         </div>
                         <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a> 
                      </div>
                          <a href="yourProductOrder.php">View All Product Orders</a>
                            <?php } ?>
              </div>

            </div>
            <br/>
    <div class="container">
         <div class="col-md-2" >
             <a href="profile.php"><img src="userPic/<?php echo $m["profileimg"]; ?>" style="height: 30px;width:30px"> <?php echo ucfirst($m["fname"]." ".$m["lname"]); ?>  </a><a id="ename" data-toggle="modal" data-target="#editname"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
             <?php echo "(".$m["cat"].")"; ?><a id="ecat" data-toggle="modal" data-target="#editcat"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
            
                       
                      </div>
      <div class="col-md-7">
          
          <form action="Script/post.php" method="post" enctype="multipart/form-data" onsubmit="return postShare()">
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
        <!--Suggested Hubs -->
        <div class="col-md-3" >
                 
            <label>  Suggested Hubs</label>
                        <div id="myCarousel2" class="carousel slide" data-ride="carousel"> 
                        <!--  <ol class="carousel-indicators">
                              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                               <?php
                          $counter=0;
                          mysql_query("select * from `hub` where uid!=$m[id]");
                          $CounterRow=  mysql_affected_rows();
                          while($counter<=$CounterRow)
                          { ?>
                              <li data-target="#myCarousel" data-slide-to="<?php echo $counter++; ?>"></li>
                       <?php   }
                          ?>
                          </ol> -->
                          <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                             
                              <?php
                          $HubRow=  mysql_query("select * from `hub` where uid!=$m[id]");
                           $temp= 1;
                          while($HubData= mysql_fetch_array($HubRow))
                          { 
                             
                            $HusrRow=  mysql_query("select * from `login` where id=$HubData[uid]");
                            $HusrData = mysql_fetch_array($HusrRow);
                             
                            ?>
                                    <div class="item <?php if($temp==1){ $temp=0;  ?>active<?php } ?>">
                                        <a href="viewhub.php?hid=<?php echo $HubData['id']; ?>" data-toggle="tooltip" title="<?php echo ucfirst($HusrData['fname']); echo ' '; echo ucfirst($HusrData['lname']);  ?>"><img src="userPic/<?php echo $HubData['hubimg']; ?>" onerror="this.src='images/logo/MYHubCoverPost.png'" style="height: 100px;width: 500px"/><br><center><?php echo ucwords($HubData['name']); ?></center></a>
                                 </div>
                                
                    <?php }
                          ?> 
                            </div>
                          <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                          <a href="Hubs.php">See All</a>
                      </div>
      </div>
      
      
      <br/>
      <div class="container-fluid">  
          
          <div class="col-md-2"><br><br>
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
              <label style="width:240px;"><center><label id="lblInfo" style="cursor: pointer" ondblclick="document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colBussi').setAttribute('style','width:240px');document.getElementById('colNews').setAttribute('style','width:240px');" onclick="if(document.getElementById('colInfo').offsetWidth===720){document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colBussi').setAttribute('style','width:240px');document.getElementById('colNews').setAttribute('style','width:240px');document.getElementById('colNews').style.display='initial';document.getElementById('colBussi').style.display='initial';document.getElementById('lblNews').style.color='black';document.getElementById('lblBussi').style.color='black';}else{document.getElementById('colInfo').setAttribute('style','width:720px');document.getElementById('colNews').setAttribute('style','width:240px');document.getElementById('colBussi').setAttribute('style','width:240px');document.getElementById('colNews').style.display='none';document.getElementById('colBussi').style.display='none';document.getElementById('lblInfo').style.color='black';document.getElementById('lblNews').style.color='#d9d9d9';document.getElementById('lblBussi').style.color='#d9d9d9';}"><p>Information</p></label></center></label>
              <label style="width:240px;"><center><label id="lblNews" style="cursor: pointer" ondblclick="document.getElementById('colNews').setAttribute('style','width:240px');document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colBussi').setAttribute('style','width:240px');" onclick="if(document.getElementById('colNews').offsetWidth===720){document.getElementById('colNews').setAttribute('style','width:240px');document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colBussi').setAttribute('style','width:240px');document.getElementById('colInfo').style.display='initial';document.getElementById('colBussi').style.display='initial';document.getElementById('lblInfo').style.color='black';document.getElementById('lblBussi').style.color='black';}else{document.getElementById('colNews').setAttribute('style','width:720px');document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colBussi').setAttribute('style','width:240px');document.getElementById('colInfo').style.display='none';document.getElementById('colBussi').style.display='none';document.getElementById('lblNews').style.color='black';document.getElementById('lblInfo').style.color='#d9d9d9';document.getElementById('lblBussi').style.color='#d9d9d9';}"><p>News</p></label></center></label>
              <label style="width:240px;"><center><label id="lblBussi" style="cursor: pointer" ondblclick="document.getElementById('colBussi').setAttribute('style','width:240px');document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colNews').setAttribute('style','width:240px');" onclick="if(document.getElementById('colBussi').offsetWidth===720){document.getElementById('colBussi').setAttribute('style','width:240px');document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colNews').setAttribute('style','width:240px');document.getElementById('colNews').style.display='initial';document.getElementById('colInfo').style.display='initial';document.getElementById('lblNews').style.color='black';document.getElementById('lblInfo').style.color='black';}else{document.getElementById('colBussi').setAttribute('style','width:720px');document.getElementById('colInfo').setAttribute('style','width:240px');document.getElementById('colNews').setAttribute('style','width:240px');document.getElementById('colNews').style.display='none';document.getElementById('colInfo').style.display='none';document.getElementById('lblBussi').style.color='black';document.getElementById('lblNews').style.color='#d9d9d9';document.getElementById('lblInfo').style.color='#d9d9d9';}"><p>Business</p></label></center></label>  
          </span>          
          <div class="col-md-9" style="max-height: 600px;max-width: 800px;overflow-x: auto">
          <div class="col-md-3" style="width: 240px;" id="colInfo">
              <label class="hidden-md hidden-lg">Informative</label>
                  <?php
                    $row = mysql_query("select * from `posts` where `type`='Informative Deal' order by id desc");
                  
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
              
                            <div class="panel panel-primary" id="PDis<?= $data['id'] ?>">

                                <!--<div class="panel-heading">
                                   <a style="text-decoration: none;color: white" href="user.php?user=<?php echo $data["userid"];?>"><?php echo ucfirst($udata["fname"]); ?>'s </a><small class="pull-right"><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></small> <?php echo "<center>".$data["type"]."</center>"; ?>
                                </div>-->
                                
                                <div class="panel-body">
                                <po style="word-wrap: break-word">
                                        <a style="text-decoration: none" href="viewfriend.php?token=<?= $udata['id'] ?>"><img src="userPic/<?= $udata['profileimg'] ?>" height="20px" width="20px" class="img-rounded"> <?= ucfirst($udata['fname'])." ".ucfirst($udata['lname']) ?></a>
                                        <?php
                                         if($_SESSION["UID"]==$udata['id'])
                                         {
                                             ?><span style="cursor:pointer" class="pull-right glyphicon glyphicon-remove" onclick="dpost(<?= $data['id'] ?>)"></span><br/><?php
                                         }
                                         ?>
                                        <br/>
                                    </po>                                
                                  <?php if($data["postimg"]=="")
                                    {
                                        
                                    }
                                    else
                                    {
                                        $postimgRow=  mysql_query("SELECT * FROM `postimage` WHERE `postsid`=$data[id]");
                                        $postimgData=  mysql_fetch_array($postimgRow);
                                        if(mysql_affected_rows()===1)
                                        { ?>
                                    <center><a data-toggle="modal" data-target="#ImyModal<?php echo $postimgData["id"] ?>"><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></a></center>
<!-- Modal -->
<div id="ImyModal<?php echo $postimgData["id"] ?>" class="modal fade" role="dialog">
    <h1><button type="button" class="close" data-dismiss="modal">&times;</button></h1>
    <div class="modal-dialog" style="max-width: 700px">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-body" >
   
        <table>
            
            <td><img src="userPic/<?php echo $udata['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <?php echo $udata['fname']." ".$udata["lname"]; ?> </td>
        <tr><td>
                <img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:500px;width:500px">
            </td>
            <td> 
                
                <?php echo "    ".$data["post"];  ?> 
            </td>
        </tr>
        </table>
    
      </div>
    </div>
    </div>
</div>
                                    
                                       <?php }else{ 
                                           while($postimgData=  mysql_fetch_array($postimgRow))
                                        {
                                    ?>
                                    <label><a data-toggle="modal" data-target="#ImyModal<?php echo $postimgData["id"] ?>"><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:50px;padding:1px;margin-top:5px"></a></label>
<!-- Modal -->
<div id="ImyModal<?php echo $postimgData["id"] ?>" class="modal fade" role="dialog">
    <h1><button type="button" class="close" data-dismiss="modal">&times;</button></h1>
    <div class="modal-dialog" style="max-width: 700px">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-body" >
   
        <table>
            
            <td><img src="userPic/<?php echo $udata['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <?php echo $udata['fname']." ".$udata["lname"]; ?> </td>
        <tr><td>
                <img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:500px;width:500px">
            </td>
            <td> 
                
                <?php echo "    ".$data["post"];  ?> 
            </td>
        </tr>
        </table>
    
      </div>
    </div>
    </div>
</div>
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
                                    <button class=" " style="background-color: transparent;border: none" id='btn_nice<?php echo $data["id"]; ?>' value="<?php echo $data["id"]; ?>">
                                        <?php 
                                        echo $Cheer; 
                                    if($Cheer=="<span class=''>Unlike</span>")
                                    {
                                        
                                    }
                                    else 
                                    {
                                    
                                        ?> <span class="badge"><?php echo $data["like"]; ?></span></button><?php
                                    }
                                        ?>
                                    
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
           <div class="col-md-3" style="width: 240px;" id="colNews">
                <label class="hidden-md hidden-lg">News</label>
                  <?php
                 
                    $row = mysql_query("select * from `posts` where `type`='News Deal' order by id desc");
                 
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
                            <div class="panel panel-danger" id="PDis<?= $data['id'] ?>">
                                    
                                <!--<div class="panel-heading">
                                   <a style="text-decoration: none;color: white" href="user.php?user=<?php echo $data["userid"];?>"><?php echo ucfirst($udata["fname"]); ?>'s </a><small class="pull-right"><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></small> <?php echo "<center>".$data["type"]."</center>"; ?>
                                </div>-->

                                <div class="panel-body">
                                  
                                    <po style="word-wrap: break-word">                                 
                                        <a style="text-decoration: none" href="viewfriend.php?token=<?= $udata['id'] ?>"><img src="userPic/<?= $udata['profileimg'] ?>" height="20px" width="20px" class="img-rounded"> <?= ucfirst($udata['fname'])." ".ucfirst($udata['lname']) ?></a>
                                        <?php
                                         if($_SESSION["UID"]==$udata['id'])
                                         {
                                              ?><span  style="cursor:pointer"  class="pull-right glyphicon glyphicon-remove" onclick="dpost(<?= $data['id'] ?>)"></span><br/><?php
                                         }
                                         ?><br/></po>
                                    <?php if($data["postimg"]=="")
                                    {
                                        
                                    }
                                    else
                                    {
                                        $postimgRow=  mysql_query("SELECT * FROM `postimage` WHERE `postsid`=$data[id]");
                                        $postimgData=  mysql_fetch_array($postimgRow);
                                        if(mysql_affected_rows()===1)
                                        { ?>
                                    <center><a data-toggle="modal" data-target="#NmyModal<?php echo $postimgData["id"] ?>"><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></a></center>
<!-- Modal -->
<div id="NmyModal<?php echo $postimgData["id"] ?>" class="modal fade" role="dialog">
    <h1><button type="button" class="close" data-dismiss="modal">&times;</button></h1>
    <div class="modal-dialog" style="max-width: 700px">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-body" >
   
        <table>
            
            <td><img src="userPic/<?php echo $udata['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <?php echo $udata['fname']." ".$udata["lname"]; ?> </td>
        <tr><td>
                <img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:500px;width:500px">
            </td>
            <td> 
                
                <?php echo "    ".$data["post"];  ?> 
            </td>
        </tr>
        </table>
    
      </div>
    </div>
    </div>
</div>
                                    
                                       <?php }else{ 
                                           while($postimgData=  mysql_fetch_array($postimgRow))
                                        {
                                    ?>
                                    <label><a data-toggle="modal" data-target="#NmyModal<?php echo $postimgData["id"] ?>"><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:50px;padding:1px;margin-top:5px"></a></label>
<!-- Modal -->
<div id="NmyModal<?php echo $postimgData["id"] ?>" class="modal fade" role="dialog">
    <h1><button type="button" class="close" data-dismiss="modal">&times;</button></h1>
    <div class="modal-dialog" style="max-width: 700px">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-body" >
   
        <table>
            
            <td><img src="userPic/<?php echo $udata['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <?php echo $udata['fname']." ".$udata["lname"]; ?> </td>
        <tr><td>
                <img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:500px;width:500px">
            </td>
            <td> 
                
                <?php echo "    ".$data["post"];  ?> 
            </td>
        </tr>
        </table>
    
      </div>
    </div>
    </div>
</div>
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
                                    <button class=" " style="background-color: transparent;border: none" id='btn_nice<?php echo $data["id"]; ?>' value="<?php echo $data["id"]; ?>">
                                        <?php 
                                        echo $Cheer; 
                                    if($Cheer=="<span class=''>Unlike</span>")
                                    {
                                        
                                    }
                                    else 
                                    {
                                    
                                        ?> <span class="badge"><?php echo $data["like"]; ?></span></button><?php
                                    }
                                        ?>
                                    
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
                                        ?><span class="glyphicon glyphicon-film"  data-toggle="modal" data-target="#myYT<?= $data["id"] ?>"></span>
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
                                                    </div>
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
           <div class="col-md-3" style="width: 240px;" id="colBussi">
               <label class="hidden-md hidden-lg">Business</label>
                  <?php
                  $row = mysql_query("select * from `posts` where `type`='Business Deal' order by id desc");
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
                            <div class="panel panel-warning" id="PDis<?= $data['id'] ?>">
                               
                                <div class="panel-body">
                                  
                                    <po style="word-wrap: break-word">                                 
                                        <a style="text-decoration: none" href="viewfriend.php?token=<?= $udata['id'] ?>"><img src="userPic/<?= $udata['profileimg'] ?>" height="20px" width="20px" class="img-rounded"> <?= ucfirst($udata['fname'])." ".ucfirst($udata['lname']) ?></a><?php
                                         if($_SESSION["UID"]==$udata['id'])
                                         {
                                              ?><span  style="cursor:pointer"  class="pull-right glyphicon glyphicon-remove" onclick="dpost(<?= $data['id'] ?>)"></span><br/><?php
                                         }
                                         ?><br/>
                                    </po>
                                       <?php if($data["postimg"]=="")
                                    {
                                        
                                    }
                                    else
                                    {
                                        if($data['pid']=="" || $data['pid']==null || $data['pid']==" " )
                                        {
                                           
                                             $postimgRow=  mysql_query("SELECT * FROM `postimage` WHERE `postsid`=$data[id]");
                                        $postimgData=  mysql_fetch_array($postimgRow);
                                        if(mysql_affected_rows()===1)
                                        { ?>
                                    <center><a data-toggle="modal" data-target="#BmyModal<?php echo $postimgData["id"] ?>"><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></a></center>
<!-- Modal -->
<div id="BmyModal<?php echo $postimgData["id"] ?>" class="modal fade" role="dialog">
    <h1><button type="button" class="close" data-dismiss="modal">&times;</button></h1>
    <div class="modal-dialog" style="max-width: 700px">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-body" >
   
        <table>
            
            <td><img src="userPic/<?php echo $udata['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <?php echo $udata['fname']." ".$udata["lname"]; ?> </td>
        <tr><td>
                <img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:500px;width:500px">
            </td>
            <td> 
                
                <?php echo "    ".$data["post"];  ?> 
            </td>
        </tr>
        </table>
    
      </div>
    </div>
    </div>
</div>
                                    
                                       <?php }else{ 
                                           while($postimgData=  mysql_fetch_array($postimgRow))
                                        {
                                    ?>
                                    <label><a data-toggle="modal" data-target="#BmyModal<?php echo $postimgData["id"] ?>"><img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:50px;padding:1px;margin-top:5px"></a></label>
<!-- Modal -->
<div id="BmyModal<?php echo $postimgData["id"] ?>" class="modal fade" role="dialog">
    <h1><button type="button" class="close" data-dismiss="modal">&times;</button></h1>
    <div class="modal-dialog" style="max-width: 700px">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-body" >
   
        <table>
            
            <td><img src="userPic/<?php echo $udata['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <?php echo $udata['fname']." ".$udata["lname"]; ?> </td>
        <tr><td>
                <img src="PostImages/<?php echo $postimgData["postimg"] ?>" class="img-responsive" style="height:500px;width:500px">
            </td>
            <td> 
                
                <?php echo "    ".$data["post"];  ?> 
            </td>
        </tr>
        </table>
    
      </div>
    </div>
    </div>
</div>
                                    <?php
                                        } 
                                       }
                                                      
                                        }
                                        else
                                        {
                                            ?><center><a data-toggle="modal" data-target="#PromyModal<?php echo $data["id"] ?>"><img src="ProImg/<?php echo $data["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></a></center>
                                            <!-- Modal -->
<div id="PromyModal<?php echo $data["id"] ?>" class="modal fade" role="dialog">
    <h1><button type="button" class="close" data-dismiss="modal">&times;</button></h1>
    <div class="modal-dialog" style="max-width: 700px">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-body" >
   
        <table>
            
            <td><img src="userPic/<?php echo $udata['profileimg']; ?> " height="30px" width="30px" style="border-radius: 2em"> <?php echo $udata['fname']." ".$udata["lname"]; ?> </td>
        <tr><td>
                <img src="ProImg/<?php echo $data["postimg"] ?>" class="img-responsive" style="height:500px;width:500px">
            </td>
            <td> 
                
                <?php if($data["pid"]=="" || $data["pid"]==" " ||$data["pid"]==null)
                                        {
                                            
                                            echo $data["post"];
                                        
                                        }
                                        else
                                        {
                                            $prow = mysql_query("select * from `product` where id=$data[pid]");
                                            $dAR = mysql_fetch_array($prow);
                                            ?>
                                                 <b>Name </b><?= $dAR['name'] ?><br/>
                                                <b>Rs </b><?= $dAR['price'] ?>/-
                                            <?php
                                            echo "<p><small>".$data["post"]."</small></p>";
                                        }  ?> 
            </td>
        </tr>
        </table>
    
      </div>
    </div>
    </div>
</div>    
                                                <?php
                                        }
                                    
                                    }
                                    ?>
                                    <po style="word-wrap: break-word">  
                                        <?php 
                                        if($data["pid"]=="" || $data["pid"]==" " ||$data["pid"]==null)
                                        {
                                            
                                            echo $data["post"];
                                        
                                        }
                                        else
                                        {
                                            $prow = mysql_query("select * from `product` where id=$data[pid]");
                                            $dAR = mysql_fetch_array($prow);
                                            ?>
                                                 <b>Name </b><?= $dAR['name'] ?><br/>
                                                <b>Rs </b><?= $dAR['price'] ?>/-
                                            <?php
                                            echo "<p><small>".$data["post"]."</small></p>";
                                        }
                                        ?>
                                        <!-- <p><small><?php  $date = date_create($data['dt']); echo date_format($date, 'd/m H:i a'); ?></small></p> -->
                                        
                                        <?php 
                                         if($data["ytlink"]=="" ||$data["ytlink"]==" "||$data==null)
                                                {

                                                }
                                                else 
                                                {
                                                    ?><span class="glyphicon glyphicon-film" style="cursor: pointer" data-toggle="modal" data-target="#myYT<?= $data["id"] ?>"></span> <x style="cursor: pointer" data-toggle="modal" data-target="#myYT<?= $data["id"] ?>">Watch Video</x>
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
                                                                  </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                          </div>

                                                        </div>
                                                      </div>
                                                        <?php   
                                                }
                                                
                                        if($data["pid"]=="" || $data["pid"]==" " ||$data["pid"]==null )
                                        {
                                            
                                        }
                                        else
                                        {                                 
                                            $pprow = mysql_query("select * from `product` where `id`=$data[pid] and uid!=$_SESSION[UID]");
                                            $PdataAR = mysql_fetch_array($pprow);
                                            if(mysql_affected_rows()>0){
                                            ?><a data-toggle="modal" data-target="#cart<?= $data['pid'] ?>" class="btn btn-sm btn-success col-md-12 ">Add To Cart</a>
                                                    <form action="cart.php" method="post">
                                                                        <!-- Modal -->
                                                                   <div id="cart<?= $data['pid'] ?>" class="modal fade" role="dialog">
                                                                     <div class="modal-dialog">

                                                                       <!-- Modal content-->
                                                                       <div class="modal-content">
                                                                         <div class="modal-header">
                                                                           <button type="button" class="close" data-dismiss="modal">×</button>
                                                                           <h4 class="modal-title"><span class="glyphicon glyphicon-shopping-cart"></span>My Cart</h4>
                                                                         </div>
                                                                         <div class="modal-body">
                                                                             <!-- BODy  -->
                                                                           <div class="">
                                                                             <div>
                                                                                   <table class="table table-striped">
                                                                                 <tbody><tr><th><small>Product Name</small></th><th><small>Amount</small></th><th><small>Qnt</small></th>
                                                                                  </tr><tr>
                                                                                     <td>
                                                                                         <div style="width: 150px;word-wrap: break-word">
                                                                                             <center>
                                                                                                 <?php
                                                                                                      if($PdataAR["prdimg"]=="" || $PdataAR["prdimg"]==" "||$PdataAR["prdimg"]==null)
                                                                                                      {
                                                                                                          ?>
                                                                                                      <img src="images/logo/MYHubCoverPost.png"  style="border:none;" height="100%" width="100%">
                                                                                                      <?php
                                                                                                      }
                                                                                                      else
                                                                                                      {
                                                                                                      ?>
                                                                                                      <img src="ProImg/<?php echo $PdataAR["prdimg"]; ?>"  style="border:none;" height="100%" width="100%">
                                                                                                      <?php
                                                                                                      }
                                                                                                      ?>
                                                                                             </center><br>
                                                                                             <?= $PdataAR['name'] ?>                             </div>
                                                                                     </td>
                                                                                     <td>Rs.<?= $PdataAR['price'] ?>/-</td>
                                                                                     <td>
                                                                                        <input type="hidden" id="pid" name="pid" value="<?php echo $data["pid"]; ?>"> 
                                                                                        <input type="hidden" id="amount" name="amount" value="<?php echo $PdataAR["price"]; ?>"> 
                                                                                         <select name="pqty" id="pqty">
                                                                                            <?php
                                                                                            for($i=1;$i<=$PdataAR['qty'];$i++)
                                                                                              echo "<option value='$i'>$i</option>";
                                                                                            ?>
                                                                                          </select>
                                                                                     </td>
                                                                                 </tr>

                                                                                 </tbody></table>



                                                                             </div>

                                                                         </div>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                                                                          

                                                                                    <input class="btn btn-primary pull-right" value="Add to Cart" type="submit"> 
                                                                                         </div>
                                                                    </div>

                                                              </div>
                                                            </div>
                                                                  </form>
                                                    <a href="BuyNow.php?b=<?php echo $dAR["id"]; ?>" class="btn btn-sm col-md-12" style="background-color:black;color: white" >Buy Now</a>
                                                
                                                <?php
                                            }
                                        }
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
                                    <button class=" " style="background-color: transparent;border: none" id='btn_nice<?php echo $data["id"]; ?>' value="<?php echo $data["id"]; ?>">
                                        <?php 
                                        echo $Cheer; 
                                    if($Cheer=="<span class=''>Unlike</span>")
                                    {
                                        
                                    }
                                    else 
                                    {
                                    
                                        ?> <span class="badge"><?php echo $data["like"]; ?></span></button><?php
                                    }
                                        ?>
                                    
                                    <?php
                                    $RowTotCom = mysql_query("SELECT count(*)as `totCom` FROM `comment` WHERE `postsid`='$data[id]'");
                                    $TotCom = mysql_fetch_array($RowTotCom);
                                    
                                    ?>
                                    <button style="background-color: transparent;border: none;margin-left: -10px" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Comment <span class="badge" id="Bsp<?php echo $data['id']; ?>"><?php echo $TotCom['totCom'];  ?></span></button>
                                    <?php
                                    if($data["hid"]>0){
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
                                   
                                </div>
                            </div>
                                <?php                      
                  }
                  ?>
              
          </div>
              </div>
          <div class="col-md-2">
               <div class="panel panel-primary" style="border-color: #4d88ff">
                   <div class="panel-heading" style="cursor: pointer;background-color: #4d88ff">
                       <h4 class="panel-title">
                           My Hub's
                       </h4>
                   </div>
                   
                       <div class="panel-body" style="overflow-y: auto ;overflow-x: auto;">
                          <?php
                           $result = mysql_query("select * from `hub` where uid='$_SESSION[UID]'");
                           ?>  <button class="btn btn-default" id="hubmodal" data-toggle="modal" data-target="#myModal"><div class="glyphicon glyphicon-plus" style="cursor: pointer"></div>New Hub</button><br><br>
                           
                        <?php   while ($data = mysql_fetch_array($result))
                           {
                            ?><label>
                               
                                <a href="hub.php?hid=<?php echo $data["id"]; ?>" data-toggle="tooltip" title="<?php echo ucwords($data["name"]); ?>"><img src="userPic/<?php echo $data['hubimg']; ?>" height="80px" width="130px" onerror="this.src='images/logo/MYHubCoverPost.png'"><br><small><?php echo ucwords($data["name"]); ?></small></a>
                                
                            </label>
                            <br/> <?php
                           }
                           
                           ?>
                       </div>
                   
               </div>
              
              
               <div class="panel panel-warning">
                   <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#order" style="cursor: pointer">
                       <h4 class="panel-title">
                           <a style="text-decoration: none" data-toggle="collapse" data-parent="#accordion" href="#order">Order's N<small>otification</small></a>
                       </h4>
                   </div>
                   <div id="order" class="panel-collapse ">
                       <div class="panel-body">
                           <?php
                                $count=0;
                                $HRow= mysql_query("select * from `hub` where uid=$_SESSION[UID]");
                                while($HData=mysql_fetch_array($HRow))
                                {
                                    $count=1;
                                    $CountRow=  mysql_query("select count(*) as totord from `order` where pid IN (select id from `product` where hid=$HData[id]) and status='panding'");
                                    $CountData=  mysql_fetch_array($CountRow); ?>
                                    <a href="yourProductOrder.php?p"><small><?php echo $HData["name"]; ?><span class="badge"><?php echo $CountData['totord']; ?></span></small></a>
                                    <?php 
                                }
                                if($count==0){ ?><small>No Order!</small><?php }
                                ?>
                       </div>
                   </div>
                   
               </div>
              <div class="panel" style="overflow-y: auto" >
                  Suggested People:<br><hr>
                              <?php 
                              
                          $usrRow=  mysql_query("select * from `login` where id!=$_SESSION[UID] order by id desc");
                          
                          
                              $temp=1;
                          while($usrData = mysql_fetch_array($usrRow))
                          { 
                              $friendrow= mysql_query("select * from `friends` where (sender=$_SESSION[UID] or receiver=$_SESSION[UID]) and Status='ok' ");
                              while($fdata=  mysql_fetch_array($friendrow))
                              {
                                  if($usrData["id"]==$fdata["sender"]) 
                                  {$temp=0;break;}
                                  else if($usrData["id"]==$fdata["receiver"])
                                  {$temp=0;break;}
                                  else{$temp=1;}
                              }
                                      if($temp==1){
                                          
                                          ?>
                                  <label>
                                    <a href="viewfriend.php?token=<?php echo $usrData['id'];?>"  data-toggle="tooltip" title="<?php echo $usrData['fname']; echo ' '; echo $usrData['lname'];  ?>"><img src="userPic/<?php echo $usrData['profileimg']; ?>" onerror="this.src='userPic/none.png'" style="height: 50px;width: 50px"/><br></a>
                                    </label>
                                  
                    <?php           
                                    
                                 
                              }
                          }
                          ?> 
                              <br>   
                        <a href="user.php">See All</a>
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
          <form action="Script/upload.php" method="post" onsubmit="return uploadCover()" enctype="multipart/form-data">
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
          <form action="Script/upload.php" method="post" onsubmit="return uploadProfile()" enctype="multipart/form-data">
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



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
<form>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <form>
        <h4 class="modal-title">Create Your Hub</h4>
      </div>
      <div class="modal-body">
       
          <input type="text" name="HubName" class="form-control" placeholder="Enter Hub Name" required/><br/>
          <select class="form-control" name="HubCat" required>
                  <option></option>
                  <option>Select Category</option>
                  <option value="Airport">Airport</option>
                  <option value="Arts/Entertainment/Nightlife">Arts/Entertainment/Nightlife</option>
                  <option value="Attractions/Things to Do">Attractions/Things to Do</option>
                  <option value="Bank/Financial Services">Bank/Financial Services</option>
                  <option value="Bar">Bar</option>
                  <option value="Bookshop">Bookshop</option>
                  <option value="Business Services">Business Services</option>
                  <option value="Church/Religious Organisation">Church/Religious Organisation</option>
                  <option value="Cinema">Cinema</option>
                  <option value="Club">Club</option>
                  <option value="Community/Government">Community/Government</option>
                  <option value="Concert Venue">Concert Venue</option>
                  <option value="DIY">DIY</option>
                  <option value="Doctor">Doctor</option>
                  <option value="Event Planning/Event Services">Event Planning/Event Services</option>
                  <option value="Food/Groceries">Food/Groceries</option>
                  <option value="Vehicles">Vehicles</option>
              </select><br/>
              <select class='form-control' name="HubState" required>
                  <option></option>
                  <option>Select Stage</option>
                  <option value="AndhraPradesh">Andhra Pradesh</option>
                  <option value="ArunachalPradesh">Arunachal Pradesh</option>
                  <option value="Assam">Assam</option>
                  <option value="Bihar">Bihar</option>
                  <option value="Chhattisgarh">Chhattisgarh</option>
                  <option value="Delhi">Delhi</option>
                  <option value="Goa">Goa</option>
                  <option value="Gujarat">Gujarat</option>
                  <option value="Haryana">Haryana</option>
                  <option value="HimachalPradesh">Himachal Pradesh</option>
                  <option value="JammuKashmir">Jammu Kashmir</option>
                  <option value="Jharkhand">Jharkhand</option>
                  <option value="Karnataka">Karnataka</option>
                  <option value="Kerala">Kerala</option>
                  <option value="MadhyaPradesh">Madhya Pradesh</option>
                  <option value="Maharashtra">Maharashtra</option>
                  <option value="Manipur">Manipur</option>
                  <option value="Meghalaya">Meghalaya</option>
                  <option value="Mizoram">Mizoram</option>
                  <option value="Nagaland">Nagaland</option>
                  <option value="Orissa">Orissa</option>
                  <option value="Punjab">Punjab</option>
                  <option value="Rajasthan">Rajasthan</option>
                  <option value="Sikkim">Sikkim</option>
                  <option value="TamilNadu">Tamil Nadu</option>
                  <option value="Telangana">Telangana</option>
                  <option value="Tripura">Tripura</option>
                  <option value="UttarPradesh">Uttar Pradesh</option>
                  <option value="Uttarakhand">Uttarakhand</option>
                  <option value="WestBengal">West Bengal</option>                  
              </select>
          </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-default" value="Create Hub" name="btn_hubCreate"/>
      </div>
    </div>
</form>

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

<?php
   if(isset($_REQUEST["btn_hubCreate"]))
   {
       $HubName = $_REQUEST["HubName"];
       $HubCat = $_REQUEST["HubCat"];
       $HubState  = $_REQUEST["HubState"];
       if(mysql_query("INSERT INTO `hub`(`uid`, `name`, `cat`,`state`) VALUES ('$_SESSION[UID]','$HubName','$HubCat','$HubState')"))
       {
           $hidrow=  mysql_query("SELECT max(id) as maxid FROM hub");
           $hiddata=  mysql_fetch_array($hidrow);
           echo "<script>window.location='hub.php?hid=$hiddata[maxid]'</script>";
       }
       else 
       {
           echo "<script>alert('Error Please Try Agine..!');</script>";
       }
       
   }
    
?>