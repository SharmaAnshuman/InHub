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
    <title>
        <?php
            $TRow=  mysql_query("select * from `hub` where `id`=$_SESSION[hid]");
            $TData= mysql_fetch_array($TRow);
            echo $TData["name"]; 
        ?>
    </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyle.css" />
    <link href="mycss.css" rel="stylesheet">
    <link rel="stylesheet" href="dataTables/dataTables.bootstrap.css" />       
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function()
    {
            
           $("#hubcoverPic").click(function()
           {
               $("#hubcoverPicModal").modal('show');
           });
    });
    </script>
  </head>
  <body style="background-image: url(images/business_background.jpg); background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
     <?php
                include './include/header.php';
                $hid=$_SESSION["hid"];
                $uid=$_SESSION["UID"];
                $uq = mysql_query("select * from `hub` where id=$hid and uid=$uid");
                $m = mysql_fetch_array($uq);
                $uq1 = mysql_query("select * from `login` where id=$uid");
                $m1 = mysql_fetch_array($uq1);
    ?>
      
      <div class="container-fluid"><br/>
            <div class="col-md-8" style="margin-bottom: 10px">
                    <!-- cover photo -->
                    <div class="text-center" style="color: black;text-shadow:1px 2px 2px #ffad33">  <font style="font-size: medium">  Welcome to </font>  <?php echo $m["name"]; ?> Hub</div>
                      <div class="jumbotron container" style="height: 250px; max-width:800px ;padding:1px;" id="uploadCoverPic" >
                          <img src="userPic/<?php echo $m["hubimg"]; ?>"  style="background-image:url(images/business_background.jpg);box-shadow:0px 1px 5px 1px #ffad33;border:none;" height="100%" width="100%">
                          <h3><span class="glyphicon glyphicon-pencil pull-right" style="color:white ;margin-top:-60px;margin-right: 10px;cursor: pointer" id="hubcoverPic">upload</span></h3>
                        </div>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs" >
                  <div class="panel panel-primary" style="max-width:400px;overflow-y: hidden ;">
                   <div class="panel-heading"  style="cursor: pointer">
                       <h4 class="panel-title">
                           <a>Authentication</a>
                       </h4>
                   </div>
                      <div class="panel-body" style="overflow-y: scroll;height: 250px;">
                          <a href="" style="text-decoration: none"><span class="glyphicon glyphicon-plus-sign"> </span><samll> Add Authentication Document's </samll></a><br/>
                      </div>
              </div>
            </div>
      </div>
      <!-- Post Share -->
      <div class="container">
        <div class="col-md-7 col-md-offset-2">
         <form action="Script/post.php" method="post" enctype="multipart/form-data" onsubmit="return postShare()">
              <textarea placeholder="" class="form-control" id="shareTxt" name="bpost"></textarea>
              
              <select style="padding:3px;border-radius:6px;border: none">
                  <option>Category</option>
              </select>
              <select style="padding:3px;border-radius:6px;border: none">
                  <option>SubCategory</option>
              </select>
              <select style="padding:3px;border-radius:6px;border: none">
                  <option>Product</option>
              </select>
          <button class="btn btn-success pull-right" >Share Business Activity</button>
          </form>      
         </div>
      </div>
      <br/>
      
      <!-- Friend's -->
      <div class="col-md-2 hidden-sm hidden-xs" style="max-width: 200px;overflow:hidden">
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
      
      <!-- post's -->
      <div class="col-md-3" style="overflow: auto">
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
                  <small class="pull-left">
                      <div class="btn-group">
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
                  <?php 
                      if($data["postimg"]=="")
                      {
                      }
                      else
                      {
                        ?><center><img src="ProImg/<?php echo $data['postimg']; ?>" class="img-responsive" style="height:165px;padding:1px;margin-top:5px"></center><?php
                      }
                   ?>
                        <div class="panel-body">
                            
                            <?php
                                $qrow = mysql_query("select * from `product` where id =  $data[pid]");
                                $pORdata=mysql_fetch_array($qrow);
                            ?>
                            <p>Product Name: <?= $pORdata["name"] ?></p>
                            <p>Rs: <?= $pORdata["price"] ?>/-</p>
                            <p>Product Info:<br/><small> <?= $pORdata["descr"] ?></small></p>
                            <hr>
                            <po style="word-wrap: break-word"><small><?php echo $data["post"]; ?></small></po>
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
      
      
      <!-- Hub product -->
      <div class='jumbotron col-md-7'>
          <center>Product Management</center><br/>
          <small>
              <button type="button" class='btn btn-default' data-toggle="modal" data-target="#CateAdd"><small>Add Category</small></button>
          <button type="button" class='btn btn-default' data-toggle="modal" data-target="#SubCateAdd"><small>Add Sub-Category</small></button>
          <button type="button" class='btn btn-default' data-toggle="modal" data-target="#ProAdd"><small>Add Product</small></button>
          <button type="button" class='btn btn-default' data-toggle="modal" data-target="#UpdateCate"><small>Edit Category</small></button>
          <button type="button" class='btn btn-default' data-toggle="modal" data-target="#UpdateSubCate"><small>Edit SubCategory</small></button>
          
          </small>
          <br/><br/>
          <script src="dataTables/jquery-1.10.2.js"></script>
        <script src="dataTables/dataTables.bootstrap.js"></script>
        <script src="dataTables/jquery.dataTables.js"></script>
        <script>
             $(document).ready(function () {
                 
                $('#dataTables-example').dataTable();
            });
        </script>
          <table id="dataTables-example" class="table table-bordered">
              <thead>
              <th>
                  Code
              </th>
              <th>
                  Category
              </th><th>
                  Sub-Category
              </th><th>
                  Qty
              </th><th>
                  Product
              </th><th>
                  Operation
              </th>
              <thead>
                  <tbody>
              <?php
                    $row1=mysql_query("select * from `product` where hid='$_SESSION[hid]' and uid='$_SESSION[UID]'");
                    while($prodata = mysql_fetch_array($row1))
                    {
              ?>
              <tr>
                  <td><?php echo $prodata['id']; ?></td>
                  <td>
                      <?php 
                      $rowc1=mysql_query("select * from `category` where id=$prodata[cid]");
                      $Cdata = mysql_fetch_array($rowc1);
                        echo $Cdata['name']; 
                      ?>
                  </td>
                  <td>
                      <?php 
                      $rowc1=mysql_query("select * from `subcategory` where id=$prodata[sid]");
                      $Cdata = mysql_fetch_array($rowc1);
                        echo $Cdata['name']; 
                      ?>
                  </td>
                  <td> <?php echo $prodata['qty']; ?>   </td>
                  <td>  <?php
                                          if($prodata['prdimg']=="" || $prodata['prdimg']==null ||$prodata['prdimg']==" ")
                                          {
                                              ?><small><div class="alert-danger" title="Goto Change And Upload Image">Upload Product Image</div></small><?php
                                          }
                                          else
                                          {
                                              ?><img src="ProImg/<?php echo $prodata['prdimg']; ?>" height="160px" width="160px" class="img-thumbnail"/><?php
                                          }
                                          ?><br/><?php echo $prodata['name']; ?><br/>Rs.<?php echo $prodata['price']; ?>/-</td>
                  <td style="font-size:1px">
                      <p style="font-size:15px"><span class="glyphicon glyphicon-edit"   style="cursor: pointer" onclick="show(<?php echo $prodata['id']; ?>)">Change</span></p><br/>  
                      <p style="font-size:15px"><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delete1(<?php echo $prodata['id']; ?>)" id="btnremove<?php echo $prodata['id']; ?>">Remove</span></p><br/>
                      <p style="font-size:15px"><span class="glyphicon glyphicon-envelope" style="cursor: pointer" onclick="post(<?php echo $prodata['id']; ?>)">Post</span> </p><br/>
                      <p style="font-size:15px">Enquiry <span class="badge">0</span> Order <span class='badge'>0</span></p>
                      
                  </td>
              </tr>
              
            
                  <script>
                      
                      $("#btnremove<?php echo $prodata['id']; ?>").click(function(){
                         $("#btnremove<?php echo $prodata['id']; ?>").text("Removing..");
                      });
                  function show(a)
                  {
                      $("#update"+a).modal();
                  }
                  
                  function post(a)
                  {
                      alert(a);
                      $("#ProPost"+a).modal();
                  }
                  
                  function delete1(a)
                  {
                      $.post("Script/removePro.php",{key:a},function(data)
                      {
                         window.location='hub.php?uid=<?php echo $_SESSION['UID'].'&hid='.$_SESSION['hid'];?>';
                             
                      });
                  }
              </script>
            <!-- update pro-->
            <div id="update<?php echo $prodata['id']; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Product</h4>
                  </div>
                  <div class="modal-body">
                      <form method="post" enctype="multipart/form-data">
                          Product Name
                          <input type="text" name="UpProName" value="<?php echo $prodata['name']; ?>" class="form-control"/> <br/>
                          Product Info
                          <textarea name="UpProInfo" class="form-control"><?php echo $prodata['descr']; ?></textarea>
                            Category
                            <select required="" name="ProMainCat<?php echo $prodata['id']; ?>" class='form-control' id="ProMainCat<?php echo $prodata['id']; ?>">
                                <option>Select Category</option>
                            <?php
                                 $catRow = mysql_query("select * from `category` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]'");
                                 while($MainCat = mysql_fetch_array($catRow))
                                 {
                                     echo "<option value='$MainCat[id]'>$MainCat[name]</option>";
                                 }
                            ?>
                          </select><br/>
                        
                        <script>
                            $("#ProMainCat<?php echo $prodata['id']; ?>").change(function()
                            {
                                    var d=$("#ProMainCat<?php echo $prodata['id']; ?>").val();
                                    $.post('Script/getSubCat.php',{mid:d},function(data)
                                    {
                                        $("#ProSubCat<?php echo $prodata['id']; ?>").html(data);   
                                    }); 
                            });

                        </script>
                        Sub Category
                        <select id="ProSubCat<?php echo $prodata['id']; ?>" name="ProSubCat<?php echo $prodata['id']; ?>" class="form-control" required>
                            
                        </select><br/>
                        Qty.
                        <input type="number" name="UpProQty" value="<?php echo $prodata['qty']; ?>" class="form-control"/> <br/>
                          RS.<input type="number" name="UpProAmount" value="<?php echo $prodata['price']; ?>" class="form-control"/> <br/>
                          <input type="file" name="fileToUpload1" >
                          <br/>
                          <input type="submit" value="Save Change" name="btn_updatePro<?php echo $prodata['id']; ?>" class="btn btn-success"/>
                      </form>
                      <?php
                      
                      if(isset($_REQUEST['btn_updatePro'.$prodata['id']]))
                      {
                            $UpProName = $_REQUEST['UpProName'];
                            $UpProMainCat = $_REQUEST['ProMainCat'.$prodata['id']];
                            $UpProSubCat = $_REQUEST['ProSubCat'. $prodata['id']];
                            $UpProQty = $_REQUEST['UpProQty'];
                            $UpProAmount = $_REQUEST['UpProAmount'];
                            $UpProInfo = $_REQUEST['UpProInfo'];
                            //file
                            
                            $target_dir = "ProImg/".$_SESSION['UID'].$_SESSION['hid'];
                            $target_file = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            $FileImg='';
                                $check = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
                                if($check !== false) {
                                    $uploadOk = 1;
                                } else {
                                    $uploadOk = 0;
                                }

                                if ($uploadOk == 0) 
                                {
                                   // echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                                }
                                else 
                                {

                                        if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file)) 
                                        {
                                            $FileImg=$_SESSION['UID'].$_SESSION['hid'].$_FILES["fileToUpload1"]["name"];
                                        } 
                                        else 
                                        {
                                            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                                        }
                                }
                                $chrw = mysql_query("select * from `posts` where pid='$prodata[id]'");
                                while($dataforchk = mysql_fetch_array($chrw))
                                {
                                    mysql_query("update `posts` set `postimg`='$FileImg' where `id`=$dataforchk[id]");
                                }
                            
                            if(mysql_query("UPDATE `product` SET `uid`='$_SESSION[UID]',`hid`='$_SESSION[hid]',`name`='$UpProName',`price`='$UpProAmount',`qty`='$UpProQty',`descr`='$UpProInfo',`cid`='$UpProMainCat',`sid`='$UpProSubCat',`prdimg`='$FileImg' WHERE id = $prodata[id]"))
                            {
                                
                                    echo "<script>alert('One Product Updated');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
                            }
                            else 
                            {
                                
                                  echo "<script>alert('Error..!');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]'; </script>";
                            }
                      
                      }
                      
                      ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

            
            <!-- post product -->
            <div id="ProPost<?php echo $prodata['id']; ?>" class="modal" role="dialog">
                <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Post Your Product</h4>
                </div>
                    <div class="modal-body">
                                  <div>
                                      <div style="float: left;margin-right: 20px">
                                          <?php
                                          if($prodata['prdimg']=="" || $prodata['prdimg']==null ||$prodata['prdimg']==" ")
                                          {
                                              ?> <small><div class="alert-danger" title="Goto Change And Upload Image">Product Image Not Found</div></small><?php
                                          }
                                          else
                                          {
                                              ?><img src="ProImg/<?php echo $prodata['prdimg']; ?>" height="200px" width="200px" class="img-thumbnail"/><?php
                                          }
                                          ?>
                                      
                                      </div>
                                      <div style="float:left;margin-right: 20px">
                        <?php
                                          $h= mysql_query(" select * from `hub` where id = $prodata[hid]");
                                                $d11 = mysql_fetch_array($h);
                                                echo "<small>Hub Name: </small>".ucfirst($d11['name']);
                                          ?><br/>
                                          <?php $h= mysql_query(" select * from `category` where id = $prodata[cid]");
                                                $d11 = mysql_fetch_array($h);
                                                echo "<small>Category: </small>".ucfirst($d11['name']);
                                          ?> <br/> 
                                          <?php $h= mysql_query(" select * from `subcategory` where id = $prodata[sid]");
                                                $d11 = mysql_fetch_array($h);
                                                echo "<small>Sub Category: </small>".ucfirst($d11['name']);
                                          ?> <br/>
                                              <?php echo "<small>Product Name: </small>".$prodata['name']; ?><br/>

                                             Rs. <?php echo $prodata['price']; ?>/-<br/>
                                      </div>
                                             <div style="float:left">
                                                 <small>Product Info</small><br/>
                                                 <?php echo $prodata['descr']; ?>
                                             </div>
                    </div>    <br/>
                    <form>
                        <textarea name="postInfo" class='form-control'>Promote Your Product</textarea>
                    <br/>
                        <input type="submit" value="Post" class="btn btn-success" name="btn_promote<?php echo $prodata['id']; ?>">
                    </form>
                    <?php 
                    if(isset($_REQUEST['btn_promote'.$prodata['id']]))
                    {
                         $post =mysql_escape_string($_REQUEST['postInfo']);
                         $dt = date("Y-m-d H:i:s");
                         $fileNM= $prodata['prdimg'];
                         $pid = $prodata['id'];
                         if(mysql_query("INSERT INTO `posts`(`userid`, `post`, `dt`, `like`, `active`, `type`, `postimg`, `hid`,`pid`) VALUES ('$_SESSION[UID]','$post','$dt','0','1','Business Deal','$fileNM','$_SESSION[hid]','$pid')"))
                         {
                             
                             //unset($_REQUEST['btn_promote']);
                             echo "<script>window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
                         }
                           
                    }                 
                    ?>
                               
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
            </tbody>
          </table>
      </div>
      
  </body>
</html>



<div id="CateAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <form method="post">
            <input type="text" name="catname" placeholder="Enter Category" class="form-control"/><br/>
              <input type="submit" value="Add Category" name="btn_addCate" class='btn btn-success'/>
          </form>
          <?php
          if(isset($_REQUEST['btn_addCate']))
          {
              $cat = mysql_escape_string($_REQUEST['catname']);
              if(mysql_query("INSERT INTO `category`(`uid`, `hid`, `name`) VALUES ('$_SESSION[UID]','$_SESSION[hid]','$cat')"))
              {
                  echo "<script>alert('One Category Added')window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              else 
              {
                  echo "<script>alert('Error Category Not Added.!')window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              
          }
          ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<div id="SubCateAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Sub-Category</h4>
      </div>
      <div class="modal-body">
       <form method="post">
           
           <select name="MainCat" class='form-control'>
               <?php
                    $catRow = mysql_query("select * from `category` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]'");
                    while($MainCat = mysql_fetch_array($catRow))
                    {
                        echo "<option value='$MainCat[id]'>$MainCat[name]</option>";
                    }
               ?>
           </select><br/>
              <input type="text" name="subcatname" placeholder="Enter Sub-Category" class='form-control'/><br/>
              <input type="submit" value="Add Sub-Category" name="btn_subaddCate" class='btn btn-success'/>
          </form>
          <?php
          if(isset($_REQUEST['btn_subaddCate']))
          {
              $maincat = mysql_escape_string($_REQUEST['MainCat']);
              $subcat = mysql_escape_string($_REQUEST['subcatname']);
              if(mysql_query("INSERT INTO `subcategory`(`cid`, `name`, `uid`, `hid`) VALUES ('$maincat','$subcat','$_SESSION[UID]','$_SESSION[hid]')"))
              {
                  echo "<script>alert('One Sub-Category Added')window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              else 
              {
                  echo "<script>alert('Error Sub-Category Not Added.!')window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              
          }
          ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<div id="ProAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body">
          <form method="post" enctype="multipart/form-data">
              <input type="text" name="proname" placeholder="Enter Product Name" class="form-control"/><br/>
              <textarea name="proinfo" placeholder="Product Detail"  class="form-control"></textarea><br/>
              <input type='number' name='proqty' placeholder='Qty'  class="form-control"><br/>
              <select name="ProMainCat" class='form-control' id="ProMainCat">
                   <option value="null">Select Category</option>
               <?php
                    $catRow = mysql_query("select * from `category` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]'");
                    while($MainCat = mysql_fetch_array($catRow))
                    {
                        echo "<option value='$MainCat[id]'>$MainCat[name]</option>";
                    }
               ?>
           </select><br/>
           <script>
               $("#ProMainCat").change(function()
               {
                       var d=$("#ProMainCat").val();
                       $.post('Script/getSubCat.php',{mid:d},function(data)
                       {
                           $("#ProSubCat").html(data);   
                       }); 
               });
               
           </script>
           <select id="ProSubCat" name="ProSubCat" class="form-control" >
               <option>Select Sub Category</option>
           </select><br/>
           <input type="number" name="proprice" placeholder="Product Amount" class="form-control"/><br/>
              <input type="file" name="fileToUpload" ><br/>
              <input type="submit" value="Add Product" name="btn_addPro" class="btn btn-success"/>
          </form>
          <?php
          if(isset($_REQUEST['btn_addPro']))
          {
              $proname = mysql_escape_string($_REQUEST['proname']);
              $ProSubCat = mysql_escape_string($_REQUEST['ProSubCat']);
              $proinfo = mysql_escape_string($_REQUEST['proinfo']);
              $proqty = mysql_escape_string($_REQUEST['proqty']);
              $ProMainCat = mysql_escape_string($_REQUEST['ProMainCat']);
              $proprice = mysql_escape_string($_REQUEST['proprice']);
              //file upload
              //ProImg
                
                $target_dir = "ProImg/".$_SESSION['UID'].$_SESSION['hid'];
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $FileImg='';
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                    
                    if ($uploadOk == 0) 
                    {
                       // echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                    }
                    else 
                    {
                    
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                            {
                                $FileImg=$_SESSION['UID'].$_SESSION['hid'].$_FILES["fileToUpload"]["name"];
                            } 
                            else 
                            {
                                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                            }
                    }
                
              if(mysql_query("INSERT INTO `product`(`uid`, `hid`, `name`, `price`, `qty`, `descr`, `prdimg`, `cid`, `sid`) VALUES ('$_SESSION[UID]','$_SESSION[hid]','$proname','$proprice','$proqty','$proinfo','$FileImg','$ProMainCat','$ProSubCat')"))
              {
                  echo "<script>alert('One Product Added'); window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              else 
              {
                  echo "<script>alert('Error Product Not Added.!'); window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              
          }
          ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<div id="UpdateCate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Category</h4>
      </div>
      <div class="modal-body">
        <form method="post">
            <select name="UpdateCatID" class='form-control'>
                                <option>Select Category</option>
                            <?php
                                 $catRow = mysql_query("select * from `category` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]'");
                                 while($MainCat = mysql_fetch_array($catRow))
                                 {
                                     echo "<option value='$MainCat[id]'>$MainCat[name]</option>";
                                 }
                            ?>
                          </select><br/>
            <input type="text" name="updatecatname" placeholder="Enter Category New Name" class="form-control"/><br/>
              <input type="submit" value="Change Category" name="btn_UpCate" class='btn btn-success'/>
          </form>
          <?php
          if(isset($_REQUEST['btn_UpCate']))
          {
              $catid = mysql_escape_string($_REQUEST['UpdateCatID']);
              $updatecatname = mysql_escape_string($_REQUEST['updatecatname']);
              if(mysql_query("update `category` set `uid`='$_SESSION[UID]' , `hid`='$_SESSION[hid]',`name`='$updatecatname' where id= $catid"))
              {
                  
                  echo "<script>alert('One Category Updated');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              else 
              {
                  
                  echo "<script>alert('Error Category Not updated.!');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              
          }
          ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


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







<div id="UpdateSubCate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change SubCategory</h4>
      </div>
      <div class="modal-body">
        <form method="post">
             <select name="ProMainCat1" class='form-control' id="ProMainCat1">
                   <option value="null">Select Category</option>
               <?php
                    $catRow = mysql_query("select * from `category` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]'");
                    while($MainCat = mysql_fetch_array($catRow))
                    {
                        echo "<option value='$MainCat[id]'>$MainCat[name]</option>";
                    }
               ?>
           </select><br/>
           <script>
               $("#ProMainCat1").change(function()
               {
                       var d=$("#ProMainCat1").val();
                       $.post('Script/getSubCat.php',{mid:d},function(data)
                       {
                           $("#ProSubCat1").html(data);   
                       }); 
               });
               
           </script>
           <select id="ProSubCat1" name="ProSubCatUpdate" class="form-control" >
               <option>Select Sub Category</option>
           </select><br/>
            <input type="text" name="updatesubcatname" placeholder="Enter Category New Name" class="form-control"/><br/>
              <input type="submit" value="Change subCategory" name="btn_UpSubCate" class='btn btn-success'/>
          </form>
          <?php
          if(isset($_REQUEST['btn_UpSubCate']))
          {
              $subcatid = mysql_escape_string($_REQUEST['ProSubCatUpdate']);
              $updatesubcatname = mysql_escape_string($_REQUEST['updatesubcatname']);
              if(mysql_query("update `subcategory` set `uid`='$_SESSION[UID]' , `hid`='$_SESSION[hid]',`name`='$updatesubcatname' where id= $subcatid"))
              {
                  
                  echo "<script>alert('One SubCategory Updated');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              else 
              {
                  
                  echo "<script>alert('Error SubCategory Not updated.!');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
              }
              
          }
          ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

