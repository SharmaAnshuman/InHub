<?php 
    session_start();
    include './config/conn.php';
    if(isset($_SESSION["user"]))
    { 
        if(isset($_REQUEST["hid"]))
        {
        $_SESSION["hid"]=$_REQUEST["hid"];
        }
        if(isset($_SESSION["hid"]) )
        {
           
        }
        else
        {
            echo "Hub Not Found";
            die();
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
      
    $(document).ready(function()
    {
            
           $("#hubcoverPic").click(function()
           {
               $("#hubcoverPicModal").modal('show');
           });
        $("#ProductPic").click(function()
           {
               $("#ProductPicModal").modal('show');
           });
       
        $("#btn_website_save").click(function()
        {
            var M4_www = $("#M4_www").val();
            $("#showwww").html("<a href='http://"+M4_www+"'>"+M4_www+"</a>");
            $.post("updateAccount.php",{M4_www:M4_www},function(data)
            {
                alert("Save");
            });
                
        });
        
        
         $("#btn_bod_save").click(function()
        {
           var gen =  $("#gen").val();
           $("#showgen").html(gen);
           var bod =  $("#bod").val();
           $("#showdob").html(bod);
            $.post("updateAccount.php",{gen:gen,bod:bod},function(data)
            {
                alert("Save");
            });
                
        });
        
        
          $("#btn_edu_save").click(function()
        {
           var clgNM =  $("#clgNM").val();
           $("#showclgnm").html(clgNM);
           var courseNM =  $("#courseNM").val();
           $("#showcourseNM").html(courseNM);
           var aboutCourse =  $("#aboutCourse").val();
           $("#showaboutCourse").html(aboutCourse);
           
           var CstartDate = $("#CstartDate").val();
           var CEndDate = $("#CEndDate").val();
           $("#showDt").html(CstartDate+" to "+CEndDate);
           
           $.post("updateAccount.php",{clgNM:clgNM,courseNM:courseNM,aboutCourse:aboutCourse,Cstart:CstartDate,CEnd:CEndDate},function(data){
               alert("Save");
           });
        });
        
        $("#btn_person_details").click(function()
        {
            var mobileNo =  $("#mobileNo").val();
            $("#showMo").html(mobileNo);
            var emailAdd =  $("#emailAdd").val();
            $("#showEmailAdd").html(emailAdd);
            var PersonAdd =  $("#PersonAdd").val();
            $("#showAddress").html(PersonAdd);
            $.post("updateAccount.php",{mobileNo:mobileNo,emailAdd:emailAdd,PersonAdd:PersonAdd},function(data){
               alert("Save");
           });
           
        });
        
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
                if(c.length<5)
                {
                    
                    alert("Check Post Length..!");
                    return false;
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
                
            }
            return true;
        }
        function postProduct()
        {
            var c=$("#prd").val();
            var pr=$("#prc").val();
            var pc=$("#ppcat").val();
            var sb=$("#sbcat").val();
            var pdesc=$("#pdesc").val();
            if(pc==="0")
            {
                alert("Select Category");
                return false;
            }
            if(sb==="0")
            {
                alert("Select Sub Category");
                return false;
            }
            if(pr==="" || pr===" ")
            {
                alert("Enter Product Price");
                return false;
            }
            if(c==="" || c===" ")
            {
                alert("Enter Product Name");
                return false;
            }
            if(pdesc==="" || pdesc===" ")
            {
                alert("Enter Product Description");
                return false;
            }
       
            return true;
        }
        function Category()
        {
            var c=$("#cat").val();
            
            if(c==="" || c===" ")
            {
                alert("Enter Category Name");
                return false;
            }
       
            return true;
        }
        function SubCategory()
        {
            var c=$("#scat").val();
            var pc=$("#pcat").val();
            if(c==="" || c===" ")
            {
                alert("Enter Sub Category Name");
                return false;
            }
            if(pc==="0")
            {
                alert("Select Category");
                return false;
            }
       
            return true;
        }
        function delPro(pidp)
        {
            var pid = pidp;
           
            $.post("Script/ProCatdrop.php",{pid:pid},function(data)
            {
                window.location='hub.php?uid=<?php echo $_SESSION["UID"]; ?>&hid=<?php echo $_SESSION["hid"]; ?>';
            });
        }
        function delCat(cidc)
        {
            var cid = cidc;
           
            $.post("Script/ProCatdrop.php",{cid:cid},function(data)
            {
                window.location='hub.php?uid=<?php echo $_SESSION["UID"]; ?>&hid=<?php echo $_SESSION["hid"]; ?>';
            });
        }
        function delSCat(sids)
        {
            var sid = sids;
           
            $.post("Script/ProCatdrop.php",{sid:sid},function(data)
            {
                window.location='hub.php?uid=<?php echo $_SESSION["UID"]; ?>&hid=<?php echo $_SESSION["hid"]; ?>';
            });
        }
    </script>
   
  </head>
  <body style="background-color:  #fff5e6; background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
 <!-- shafron color #ffad33;
        blue #4d88ff
 -->
     <?php
                include './include/header.php';
                $hid=$_SESSION["hid"];
                $uid=$_SESSION["UID"];
                $uq = mysql_query("select * from `hub` where id=$hid and uid=$uid");
                $m = mysql_fetch_array($uq);
                $uq1 = mysql_query("select * from `login` where id=$uid");
                $m1 = mysql_fetch_array($uq1);
            ?>
 <br>
 <div class="container-fluid">
    <div class="col-md-8" style="margin-bottom: 10px">
            <!-- cover photo -->
            <div class="text-center" style="color: black;text-shadow:1px 2px 2px #ffad33"><h2>  <font style="font-size: medium">  Welcome to <?php echo $m1["fname"]; echo ' '; echo $m1["lname"]; ?>'s</font>  <?php echo $m["name"]; ?> Hub</h2></div>
              <div class="jumbotron container" style="height: 250px; max-width:800px ;padding:1px;" id="uploadCoverPic" >
                  <img src="userPic/<?php echo $m["hubimg"]; ?>"  style="background-image:url(images/business_background.jpg);box-shadow:0px 1px 5px 1px #ffad33;border:none;" height="100%" width="100%">
                  <h3><span class="glyphicon glyphicon-pencil pull-right" style="color:white ;margin-top:-60px;margin-right: 10px;cursor: pointer" id="hubcoverPic">upload</span></h3>
                </div>
    </div>
 <div class="col-md-4" >
                  <div class="panel panel-primary" style="max-width:400px;overflow-y: hidden ;">
                   <div class="panel-heading"  style="cursor: pointer">
                       <h4 class="panel-title">
                           <a>Authentication</a>
                       </h4>
                   </div>
                      <div class="panel-body" style="overflow-y: scroll;height: 250px;">
                          <samll>Document's </samll><br/>
                      </div>
              </div>
          </div>
  </div>
<div class="container">
        <div class="col-md-6 col-md-offset-2">
         <form action="Script/post.php" method="post" enctype="multipart/form-data" onsubmit="return postShare()">
             <label for="a1" style="cursor: pointer">Upload Picture<img src="images/CAMERA.png" style="height: 30px; width: 30px"></label>
              <input type="file" name="bpostPic" style="display: none" id="a1"/> 
             <textarea placeholder="" class="form-control" id="shareTxt" name="bpost"></textarea>
               <script>
                  $(document).ready(function()
                  {
                      $("#price").hide();
                      //$("#category").hide();
                      $("#product").hide();
                      $("#shareTxt").focusin(function()
                      {
                          
                            //  $("#price").show();
                             // $("#category").show();    
                             //  $("#product").show();
                      });
                     // $("#category").change(function(){
                     
                 //     });
                      
                  });
              </script>
              <input type="text" id="price" name="price" placeholder="Product Price" style="width: 100px"/>
 <!--             <select id="category" name="category">
               <?php   
               $CROW=  mysql_query("select * from `category` where hid=$hid and uid=$_SESSION[UID]");
               while($CDATA= mysql_fetch_array($CROW))
               {?>
                  <option value="<?php echo $CDATA["name"] ?>"><?php echo $CDATA["name"] ?></option>
               <?php }?>
              </select> 
 -->
              <select id="product" name="product">
               <?php   
               $PROW=  mysql_query("select * from `product` where hid=$hid and uid=$_SESSION[UID]");
               while($PDATA= mysql_fetch_array($PROW))
               {?>
                  <option value="<?php echo $PDATA["name"] ?>"><?php echo $PDATA["name"] ?></option>
               <?php }?>
              </select>        
          <button class="btn btn-success pull-right" >Share Business Activity</button>
          </form>      
         </div>
         </div>
           <br/>
  <center>      
           <div class="col-md-2" style="max-width: 200px;overflow:hidden">
               <div class="panel panel-primary" style="max-width: 200px;overflow:hidden">
                   <div class="panel-heading">
                       <h4 class="panel-title">My Circle</h4>
                   </div>
                   
                       <div class="panel-body" style="overflow-y: scroll ;overflow-x: hidden;height: 300px">
                           <center>
                              <?php $row11= mysql_query("select * from `friends` where (`sender`=$_SESSION[UID] or `receiver`=$_SESSION[UID]) and `status`='ok'");
                               while($data=  mysql_fetch_array($row11))
                              {
                                   if($data['receiver']===$_SESSION["UID"]){
                                        $row12= mysql_query("select * from `login` where id=$data[sender]");
                                   }
                                 else{
                                  $row12= mysql_query("select * from `login` where id=$data[receiver]");
                                 }
                              while($data12=  mysql_fetch_array($row12))
                              {                              
                                  ?>
                           <span style="white-space: nowrap"><a href="#" id="vv<?php echo $data12['id']; ?>" data-toggle="tooltip" title="<?php echo $data12['fname']; echo ' '; echo $data12['lname'];  ?>"><img src="userPic/<?php echo $data12['profileimg']; ?>" onerror="this.src='userPic/none.png'" height="30px" width="30px" style="border-radius: 2em"/><?php echo $data12['fname']; echo ' '; echo $data12['lname'];  ?></a></span><br>
                              <script>
                              $("#vv<?php echo $data12['id']; ?>").click(function ()
                              {
                                  //alert("d");
                                  window.location='friend.php?token=<?php echo $data12['id']; ?>';
                              });
                              </script>
                              <?php 
                                }
                              }?>
                           </center>
                          </div>
                      </div>
                       </div>
                   
      
           <div class="col-md-7" style="width: 240px;height: 900px; overflow: auto">
                  <?php
                 
                    $row = mysql_query("select * from `posts` where `type`='Business Deal' and `userid`=$uid and `hid`=$hid order by id desc");
                    
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `login` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      
                                ?>
              
               <div class="panel panel-primary">
                                
                                <div class="panel-heading">
                                  <a style="text-decoration: none;color: white" href="user.php?user=<?php echo $data["userid"];?>"><?php echo ucfirst($udata["fname"]); ?>'s </a>
                                  <small class="pull-right"><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></small>
                                  <small class="pull-left"><div class="btn-group">
                                         <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret" style="color: white"></span></a>
                                            <ul class="dropdown-menu">
                                               <li><a href="#" id="del<?php echo $data['id']; ?>">Delete This Post</a></li>
                                               <script>
                  $("#del<?php echo $data['id']; ?>").click(function()
           {
                 
                      window.location='deletepost.php?PID=<?php echo $data["id"]?>';
           });
              </script>
                                            </ul>
                                    </div>
                                  </small>
                                   
                                      
                                </div>
                                  <?php if($data["postimg"]=="")
                                    {
                                        
                                    }
                                    else
                                    {
                                    ?>
                                <center><img src="PostImages/<?php echo $data["postimg"] ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></center>
                                    <?php
                                    }
                                    ?>
                                <div class="panel-body">
                                  
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
                                              $rowEnq = mysql_query("SELECT `id`, `postsid`, `userid`, `enquiry`, `dt` FROM `Enquiry` WHERE `postsid`='$data[id]' ");
                                              if(mysql_num_rows($rowEnq)==0)
                                              {
                                                  ?>
                                              <com>
                                                  <center>No Enquiry Yet</center>
                                              </com>
                                              <?php

                                              }
                                              while ($EnqArr = mysql_fetch_array($rowEnq))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$EnqArr[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com>
                                                       <p style="margin-bottom: -1px"><img src="userPic/<?php echo $UData['profileimg']; ?>" height="30px" width="30px" style="border-radius: 2em"> <br/><?php echo $UData['fname']; ?> <small><?php $date = date_create($EnqArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                                                            <?php if($_SESSION['UID']==$EnqArr['userid'])
                                                            {
                                                                ?><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delEnq('<?php echo $EnqArr['id']; ?>','<?php echo $EnqArr['postsid']; ?>');"></span><?php
                                                            }
                                                           else 
                                                           {
                                                           }
                                                           ?>
                                                          </p>
                                                       <commnet1 style="padding: 10px;margin-left:9px;color: red"><?php echo $EnqArr['enquiry'];?></commnet1>
                                                   </com>
                                                  <?php
                                              }
                                             ?>
                                         </div>
                                         
                                      </div>
                                    <div id="y1<?php echo $data['id']; ?>"  class="collapse">
                                         <hr>
                                         <!--<a ><span class="glyphicon glyphicon-arrow-up"> </span>Show All Comments</a>-->
                                         <div style="padding: 10px">
                                             <?php
                                              $rowOrd = mysql_query("SELECT `id`, `postsid`, `userid`, `qty`, `dt` FROM `Order` WHERE `postsid`='$data[id]' ");
                                              if(mysql_num_rows($rowOrd)==0)
                                              {
                                                  ?>
                                              <com>
                                                  <center>No Order Yet</center>
                                              </com>
                                              <?php

                                              }
                                              while ($OrdArr = mysql_fetch_array($rowOrd))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$OrdArr[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com>
                                                       <p style="margin-bottom: -1px"><img src="userPic/<?php echo $UData['profileimg']; ?>" height="30px" width="30px" style="border-radius: 2em"> <br/><?php echo $UData['fname']; ?> <small><?php $date = date_create($OrdArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                                                            <?php if($_SESSION['UID']==$OrdArr['userid'])
                                                            {
                                                                ?><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delOrd('<?php echo $OrdArr['id']; ?>','<?php echo $OrdArr['postsid']; ?>');"></span><?php
                                                            }
                                                           else 
                                                           {
                                                           }
                                                           ?>
                                                          </p>
                                                       <commnet1 style="padding: 10px;margin-left:9px;color: red"><?php echo $OrdArr['qty'];?></commnet1>
                                                   </com>
                                                  <?php
                                              }
                                             ?>
                                         </div>
                                        
                                         
                                      </div>
                                </div>
                                <div class="panel-footer">
                                    <?php
                                    $RowTotEnq = mysql_query("SELECT count(*)as `totCom` FROM `enquiry` WHERE `postsid`='$data[id]'");
                                    $TotEnq = mysql_fetch_array($RowTotEnq);
                                    $RowTotOrd = mysql_query("SELECT count(*)as `totCom` FROM `order` WHERE `postsid`='$data[id]'");
                                    $TotOrd = mysql_fetch_array($RowTotOrd);
                                    ?>
                                    <button style="background-color: transparent;border: none" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Enquiry <span class="badge"><?php echo $TotEnq['totCom'];  ?></span></button>
                                    <button style="background-color: transparent;border: none" data-toggle="collapse" data-target="#y1<?php echo $data['id']; ?>">Order <span class="badge"><?php echo $TotOrd['totCom'];  ?></span></button> 
                                    
                                </div>
                            </div>
                                <?php                      
                  }
                  ?>
              
          </div>
        
            
                <div class="col-md-8" style="max-width: 1000px">
            <div class=" panel panel-primary" >
                   <div class="panel-heading" style="cursor: pointer">
                       <h4 class="panel-title">  Your Products </h4>
                   </div>
                  <div class="panel-body" style="overflow-y: scroll ;overflow-x: scroll;height: 1000px">
                           <ul>
                               
                               <div class="col-md-8">
                                 
                                   <table class="table table-striped">
                                       <tbody>
                                       <?php
                                   $CROW=  mysql_query("select * from `category` where hid='$hid' and uid='$_SESSION[UID]'");
                                   
                                   while($CDATA= mysql_fetch_array($CROW))
                                   {
                                   ?>
                                       <tr>
                                           <td><b><?php echo $CDATA["name"] ?></b></td>
                                           <td><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delCat('<?php echo $CDATA['id']; ?>');" data-toggle="tooltip" title="Delete Category"></span></td>
                                       </tr>
                                       
                                       <tr style="" ><td>
                                           <table class="table" id="t<?php echo $CDATA["id"] ?>">
                                            <tbody>
                                       <?php
                                   $SCROW=  mysql_query("select * from `subcategory` where hid=$hid and uid=$_SESSION[UID] and cid=$CDATA[id]");
                                   while($SCDATA= mysql_fetch_array($SCROW))
                                   {
                                   ?>
                                       <tr>
                                           <td><?php echo $SCDATA["name"] ?></td>
                                           
                                           <td><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delSCat('<?php echo $SCDATA['id']; ?>');" data-toggle="tooltip" title="Delete Sub Category"></span></td>
                                       </tr>
                                       <tr style="" ><td>
                                           <table class="table" id="t<?php echo $SCDATA["id"] ?>">
                                            <tbody>
                                       <?php
                                   $PROW=  mysql_query("select * from `product` where hid=$hid and uid=$_SESSION[UID] and cid=$CDATA[id] and sid=$SCDATA[id]");
                                   while($PDATA= mysql_fetch_array($PROW))
                                   {
                                   ?>
                                       <tr>
                                           <td><?php echo $PDATA["name"] ?></td>
                                           <td><?php echo $PDATA["price"] ?></td>
                                           <td><?php echo $PDATA["qty"] ?></td>
                                           <td><?php echo $PDATA["descr"] ?></td>
                                           <td><?php echo $PDATA["prdimg"] ?></td>
                                           <td><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delPro('<?php echo $PDATA['id']; ?>');" data-toggle="tooltip" title="Delete Prroduct"></span></td>
                                       </tr>
                                   <?php } ?>
                                       </tbody>
                                   </table>
                                           </td></tr>
                                   <?php } ?>
                                       </tbody>
                                   </table>
                                           </td></tr>
                                   <?php } ?>
                                       </tbody>
                                   </table>
                                 
                                   
                                   
                               </div>
                               <div class="col-md-2">
                                  
                                <span id="newcategory">
                                    <form action="Script/post.php" method="post" enctype="multipart/form-data" onsubmit="return Category()" class="form-control-group">
                                        <input type="text" placeholder="Category Name" name="cat" id="cat" class="form-control">
                                    <button type="submit" class="btn btn-success pull-left">ADD NEW CATEGORY</button>
                                    </form>
                                </span>
                                   <br><br><br>
                                   <span id="newsubcategory">
                                    <form action="Script/post.php" method="post" enctype="multipart/form-data" onsubmit="return SubCategory()">
                                    <input type="text" placeholder="Sub Category Name" name="scat" id="scat">
                                    <select id="pcat" name="pcat" style="width:100%">
                                   <option value="0">Select Category</option>
                                <?php   
                                   $CROW=  mysql_query("select * from `category` where hid=$hid and uid=$_SESSION[UID]");
                                  while($CDATA= mysql_fetch_array($CROW))
                                  {?>
                                   <option value="<?php echo $CDATA["id"] ?>"><?php echo $CDATA["name"] ?></option>
                                  <?php }?>
                                </select> 
                                    <button type="submit" class="btn btn-success pull-left">ADD NEW SUB CATEGORY</button>
                                    </form>
                                </span>
                                   <br><br><br>
                                   <span id="newproduct">
                               <form action="Script/post.php" method="post" enctype="multipart/form-data" onsubmit="return postProduct()">
                               <input id="uploadProduct" name="ProductPic" type="file" style="display: none" onchange="PreviewImage();" /> 
                               <label for="uploadProduct"><img src="" id="productImg" style="width: 100px; height: 100px;" onerror="this.src='images/productupload.png'" /></label><br>
                               <select id="ppcat" name="ppcat" style="width:100%">
                                   <option value="0">Select Category</option>
                                <?php   
                                   $CROW=  mysql_query("select * from `category` where hid=$hid and uid=$_SESSION[UID]");
                                  while($CDATA= mysql_fetch_array($CROW))
                                  {?>
                                   <option value="<?php echo $CDATA["id"] ?>"><?php echo $CDATA["name"] ?></option>
                                  <?php }?>
                                </select> 
                               <select id="sbcat" name="sbcat" style="width:100%">
                                   <option value="0">Select Sub Category</option>
                                <?php   
                                   $SROW=  mysql_query("select * from `subcategory` where hid=$hid and uid=$_SESSION[UID]");
                                  while($SDATA= mysql_fetch_array($SROW))
                                  {?>
                                   <option value="<?php echo $SDATA["id"] ?>"><?php echo $SDATA["name"] ?></option>
                                  <?php }?>
                                </select> 
                               <input type="text" placeholder="Product Name" name="prd" id="prd"/>
                               <input type="text" placeholder="Product Price(e.g. Rs.,$)" name="prc" id="prc"/><br>
                               Qty:<input type="text"  id="pqty" value="1" size="2"> 
                                   <span id="uppy" class="glyphicon glyphicon-chevron-up"></span><span id="downy" class="glyphicon glyphicon-chevron-down"></span>
                               <textarea placeholder="Product Description" name="pdesc" id="pdesc"></textarea> <br>

<script type="text/javascript">
 //   var upButton = ;
 //   var downButton = ;
 //   var resultBox = ;

   // upButton.innerHTML = "+";
   // downButton.innerHTML = "-";

   document.getElementById("uppy").onclick = function () {
        var current = parseInt(document.getElementById("pqty").value);
        current++;
        document.getElementById("pqty").value = current;
    };

    document.getElementById("downy").onclick = function () {
        var current = parseInt(document.getElementById("pqty").value);
        if(current>0){
               current--;
            }
        document.getElementById("pqty").value = current;
    };
</script>
                               <button type="submit" class="btn btn-success pull-left">ADD NEW PRODUCT</button>
                               </form>
                                   </span>
                                   </div>
<script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadProduct").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("productImg").src = oFREvent.target.result;
        };
    };

</script>
                               <!-- <font style="color: black">  
                                  <?php
                                  $dealrow=  mysql_query("select * from `deal` where `postid` IN (select `id` from `posts` where `userid`=$uid)");
                                  while($dealdata=  mysql_fetch_array($dealrow))
                                  {
                                           $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$dealdata[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com>
                                                       <p style="margin-bottom: -1px"><img src="userPic/<?php echo $UData['profileimg']; ?>" height="30px" width="30px" style="border-radius: 2em"> <?php echo $UData['fname']; ?> <small><?php $date = date_create($dealrow['dt']); echo date_format($date, 'd-M H:i a'); ?></small>
                                                            </p>
                                                       <commnet1 style="padding: 10px;margin-left:9px;color: red"><?php echo $dealdata['desc'];?></commnet1>
                                                   </com>
                                                  <?php
                                              }
                                  ?>
                                  </font>-->
                                     
                           </ul>
                       </div>
                   
               </div>
               
        </div>
           
           <div class="col-md-8" style="max-width:800px">
               <div id="map" data-toggle="tooltip" title="Click to Locate/Save your HUB Address/Near by Address" style="max-width:800px;height:500px;"></div>
                </div>
            <script async defer
    src="https://maps.googleapis.com/maps/api/js?callback=initMap">
    </script>
               <script>
                
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
var lt1;
var lg1;
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            
            infoWindow.setPosition(pos);
           
          var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': pos }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        //alert("Location: " + results[1].formatted_address);
                        infoWindow.setContent(""+results[1].formatted_address);
                         add=""+results[0].formatted_address;
                          map.setCenter(pos);
                    }
                }
            });
            google.maps.event.addListener(map, 'click', function( event ){
                 var pos = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
                 infoWindow.setPosition(pos);
                var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': pos }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        
                         infoWindow.setContent(""+results[0].formatted_address);
                        
                          map.setCenter(pos);
                          if(confirm("Is Your Store Loketed here....?" + results[0].formatted_address))
                          {
                              lt1 = parseFloat(""+event.latLng.lat());
            lg1 = parseFloat(""+event.latLng.lng());
            $.post("Script/latlng.php",{lt:lt1,lg:lg1,hid:<?php echo $hid; ?>},function()
                                              {  
                                                // alert("test");
                                                  });
                          }
                    }
                }
            });
  //alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng() ); 
  //alert(""+add);
  
});
             
            
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
         
          
          
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    
               
    </script>
  </center>
    <br/>
    <div class="col-lg-11">       
        <div class="container">      
   <?php  include './include/footer.php'; ?>   
    </div>
    </div>
  </body>  
  
</html>










<div id="hubcoverPicModal" class="modal fade" role="dialog">
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
                        alert("Select Hub's Cover Pic");
                        return false;
                    }
                return true;
              }
               
          </script>
          <form action="Script/upload.php" method="post" onsubmit="return uploadCover()" enctype="multipart/form-data">
              <input type="file" name="hubcoverPic" style="display: none" id="up"/>
              <label class="btn btn-warning" for="up">Select File</label>
              <input type="submit" value="Upload" name="btn_hubcoverPic" class="btn btn-success">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





