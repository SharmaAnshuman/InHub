<?php
    session_start();
    include './config/conn.php';
    
    $TMP = mysql_escape_string($_REQUEST['hid']);
    $UVIEWROW = mysql_query("select * from `hub` where `id`=$TMP");
    $userViews = mysql_fetch_array($UVIEWROW);
    if($userViews['hviews']===0)
    {
        mysql_query("update `hub` set `hviews`=1 where id=$TMP");
    }
    else
    {
        $Newtot = $userViews['hviews']+1;
        mysql_query("update `hub` set `hviews`=$Newtot where id=$TMP");
    }
    $hid=$_REQUEST["hid"];
    $uq = mysql_query("select * from `hub` where id=$hid");
    $m = mysql_fetch_array($uq);
    $uq1 = mysql_query("select * from `login` where id=$m[uid]");
    $m1 = mysql_fetch_array($uq1);
    if(isset($_SESSION["UID"]))
    {
        if($m1["id"]==$_SESSION["UID"])
        {
            header("Location: ./hub.php?hid=$_REQUEST[hid]");
        }
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
        $hidTOKEN = mysql_escape_string($_REQUEST['hid']);
            $TRow=  mysql_query("select * from `hub` where `id`=$hidTOKEN");
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
    function PlaceIt(ppp)
        {
            var mmm = $("#EnqMgs"+ppp).val();
            
            $.post("Script/enquiry.php",{pid:ppp,mgs:mmm},function(data){
                           
                      // window.location='viewhub.php?hid=<?php if(isset($_REQUEST["hid"])){ echo $_REQUEST["hid"]; }?>';  
                      location.reload();
            });
            
        }
        function delEnq(cidc,pidp)
        {
            var cid = cidc;
            var pid = pidp;
            $.post("Script/enqdrop.php",{enqid:cid,postid:pid},function(data)
            {
               //window.location='viewhub.php?hid=<?php if(isset($_REQUEST["hid"])){ echo $_REQUEST["hid"]; }?>';
               location.reload();
            });
        }
        function OrderIt(ppp,ppid)
        {
             alert("");     
             var mmm
             if(ppid!==0)
             {
                mmm = $("#qty"+ppid).val();
                
             }
             else
             {
                mmm = $("#qty").val();
             }
            window.location="BuyNow.php?prdct="+ppp+"&qty="+mmm;
            
        }
        function delOrd(cidc,pidp)
        {
          
            $.post("Script/orderdrop.php",{ordid:cidc,pid:pidp},function(data)
            {
               //window.location='viewhub.php?hid=<?php if(isset($_REQUEST["hid"])){ echo $_REQUEST["hid"]; }?>';
               location.reload();
            });
        }
        function delCart(cidc)
        {
            $.post("Script/CartItemDrop.php",{cid:cidc},function(data)
            {
               // window.location='friendhub.php?uid=<?php if(isset($_REQUEST["uid"])){ echo $_REQUEST["uid"]; }?>&hid=<?php if(isset($_REQUEST["hid"])){ echo $_REQUEST["hid"]; }?>&cartp=<?php if(isset($_REQUEST["cartp"])){ echo $_REQUEST["cartp"];} ?>';
            });
        }
    </script>
  </head>
  <body style="background-image: url(images/business_background.jpg); background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
     <?php
                
                include './include/header.php';
                
    ?>
      
      <div class="container-fluid"><br/><br/>
            <div class="col-md-8" style="margin-bottom: 10px">
                    <!-- cover photo -->
                    
                      <div class="jumbotron container" style="height: 250px; max-width:800px ;padding:1px;" id="uploadCoverPic" >
                          <?php
                          if($m["hubimg"]=="" || $m["hubimg"]==" "||$m["hubimg"]==null)
                          {
                              ?>
                          <img src="images/logo/MYHubCoverPost.png"  style="background-image:url(images/business_background.jpg);box-shadow:0px 1px 5px 1px #ffad33;border:none;" height="100%" width="100%">
                          <?php
                          }
                          else
                          {
                          ?>
                          <img src="userPic/<?php echo $m["hubimg"]; ?>"  style="background-image:url(images/business_background.jpg);box-shadow:0px 1px 5px 1px #ffad33;border:none;" height="100%" width="100%">
                          <?php
                          }
                          ?>
                          
                          
                        </div>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs" >
                <h3><?php echo ucfirst($m['name']); ?> 
                    <?php
                    if($m['autho']=="" || $m['autho']==" "||$m['autho']==null)
                    {}
                    else
                    {
                    ?>
                    <span class="glyphicon glyphicon-ok-sign" style="color:green" title="Authorised (<?= $m['autho'] ?>)"></span>
                    <?php
                    }
                    ?><br/><small  style="color:blue;font-weight: bolder">(<?php echo $m['cat'];?>)</small> </h3>
                <h4><small>Created by <a href="viewfriend.php?token=<?= $m1['id'] ?>"><?php echo ucfirst($m1['fname'])." ".ucfirst($m1['lname']); ?></a></small></h4>
              <h5>Visit Other Hub's<br/>
                  <?php
              $rowd = mysql_query("select * from `hub` where uid='$m1[id]' ");
              while($datahub= mysql_fetch_array($rowd))
              {
                  if($m1['id']!=$datahub['uid'])
                  {
                      ?>
                        <small><a style="color:blue;font-weight: bolder;text-decoration: none" ><?= $datahub['name'] ?></a></small> / 
                    <?php
                  }
                  else
                  {
                    ?>
                        <small><a style="color:blue;font-weight: bolder" href='viewhub.php?hid=<?= $datahub['id'] ?>'><?= $datahub['name'] ?></a></small> / 
                    <?php
                  }
              }
                  ?>
              </h5>
                <h5><span class='badge'>0</span> Order Done</h5><h5><span class='badge'><?= $userViews['hviews'] ?></span> Views</h5>
                 <?php
                                $COUNTqrow = mysql_query("select * from `product` where `hid`='$hid' ");
                                $totPRO = mysql_num_rows($COUNTqrow);
                ?>
                <h5><span class='badge'><?= $totPRO ?></span> Product's Available</h5>
            </div>
            </div>
      </div>
      
      <br/>
      
    
      <div class="col-md-3" style="overflow: auto">
           <center class='alert alert-info'>Business Post</center>
          <?php
          $row = mysql_query("select * from `posts` where `type`='Business Deal' and `userid`=$m[uid] and `hid`=$hid order by id desc");
          while($data=  mysql_fetch_array($row))
          {
              $row1=mysql_query("select * from `login` where id=$data[userid]");
              $udata = mysql_fetch_array($row1);
              ?>
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <a style="text-decoration: none;color: white" href="user.php?user=<?php echo $data["userid"];?>"><?php echo ucfirst($udata["fname"]); ?> </a>
                  <small class="pull-right"><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></small>
                  <small class="pull-left">
                      <div class="btn-group">
                         <!-- <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret" style="color: white"></span></a>
                          <ul class="dropdown-menu">
                              <li><a href="#" id="del<?php echo $data['id']; ?>">Delete This Post</a></li>
                              <script>
                                  $("#del<?php echo $data['id']; ?>").click(function()
                                  {
                                    window.location='deletepost.php?PID=<?php echo $data["id"]?>';
                                  });
                              </script>
                          </ul>-->
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
                            if($data["pid"]>0){
                                $qrow = mysql_query("select * from `product` where id=$data[pid]");
                                $pORdata=mysql_fetch_array($qrow);
                            ?>
                            <p><b>Name </b> <?= $pORdata["name"] ?></p>
                            <p><b>Rs </b><?=  $eno = number_format($pORdata["price"]); ?>/-</p>
                            
                            <p><b>Specification </b><br/><small> 
                                
                                
                                    <a data-toggle="collapse" style="text-decoration:none" data-target="#demo<?=$pORdata["id"] ?>"><?= substr($pORdata["descr"], 0,25)."..." ?></a>

                                <div id="demo<?=$pORdata["id"] ?>" class="collapse">
                                <?=$pORdata["descr"] ?>
                                </div>
                                    
                                    
                                
                                
                                </small></p>
                            <hr><?php } ?>
                            <po style="word-wrap: break-word"><small><?php echo $data["post"]; ?></small></po>
                            <?php 
                            if(isset($_SESSION["user"]))
                            { ?>
                                <div id="x1<?php echo $data['id']; ?>"  class="collapse">
                                         <hr>
                                         <!--<a ><span class="glyphicon glyphicon-arrow-up"> </span>Show All Comments</a>-->
                                         <div style="padding: 10px">
                                             <?php
                                              $rowEnq = mysql_query("SELECT `id`, `pid`, `uid`, `enquiry`, `dt` FROM `Enquiry` WHERE `pid`='$data[pid]' ");
                                              if(mysql_num_rows($rowEnq)==0)
                                              {
                                                  ?>
                                              <com>
                                                  <center>Be The First To Place Enquiry</center>
                                              </com>
                                              <?php

                                              }
                                              while ($EnqArr = mysql_fetch_array($rowEnq))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `login` WHERE `id`=$EnqArr[uid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com>
                                                       <p style="margin-bottom: -1px"><img src="userPic/<?php echo $UData['profileimg']; ?>" height="30px" width="30px" style="border-radius: 2em"> <br/><?php echo $UData['fname']; ?> <small><?php $date = date_create($EnqArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                                                            <?php if($_SESSION['UID']==$EnqArr['uid'])
                                                            {
                                                                ?><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delEnq('<?php echo $EnqArr['id']; ?>','<?php echo $EnqArr['pid']; ?>');"></span><?php
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
                                         <textarea class="form-control" id="EnqMgs<?php echo $data['pid']; ?>"></textarea>
                                         <button class='btn btn-sm btn-info' onclick="PlaceIt('<?php echo $data['pid']; ?>')">Place It</button>
                                      </div>
                            <?php 
                            } ?>
                            
                                    
                                </div>
                                <div class="panel-footer">
                                    <?php
                                    $RowTotEnq = mysql_query("SELECT count(*)as `totCom` FROM `enquiry` WHERE `pid`='$data[pid]'");
                                    $TotEnq = mysql_fetch_array($RowTotEnq);
                                    $RowTotOrd = mysql_query("SELECT count(*)as `totCom` FROM `order` WHERE `pid`='$data[pid]'");
                                    $TotOrd = mysql_fetch_array($RowTotOrd);
                                    ?>
                                    <button style="background-color: transparent;border: none" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Enquiry <span class="badge"><?php echo $TotEnq['totCom'];  ?></span></button>
                                    <button style="background-color: transparent;border: none" >Order <span class="badge"><?php echo $TotOrd['totCom'];  ?></span></button> 
                                    <?php
                                    if($data["ytlink"]=="" ||$data["ytlink"]==" "||$data==null)
                                    {

                                    }
                                    else 
                                    {
                                        ?><x style='cursor: pointer' data-toggle="modal" data-target="#myYT<?= $data["id"] ?>">Watch Video</x><span class="glyphicon glyphicon-film" style="cursor: pointer;margin-left: 3px" data-toggle="modal" data-target="#myYT<?= $data["id"] ?>"></span>
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
      
      
      <!-- Hub product -->

      <div class="row col-md-8">
                <center class='alert alert-info'>Products</center>      
     
         <?php
               $row = mysql_query("select * from `product` where `hid`='$hidTOKEN'");
               while($PdataAR = mysql_fetch_array($row))
               {
         ?>
          <div class="col-sm-3">
                <div class="panel " style="border-color:orange">
                    <div class="panel-heading">
                    </div>
                 <div class="panel-body img-hover">
                     <a href="viewproduct.php?p_id=<?= $PdataAR["id"];?>"><center>
                         
                             <?php
                             if($PdataAR["prdimg"]=="" || $PdataAR["prdimg"]==" "||$PdataAR["prdimg"]==null)
                            {
                                ?>
                                <img src="images/logo/MYHubCoverPost.png"  style="border:none;" height="100px" width="100px" class='img-hover'>
                                <?php
                            }
                            else
                            {
                                ?>
                                <img src="ProImg/<?php echo $PdataAR["prdimg"]; ?>"  style="border:none;" height="100px" width="100px" class='img-hover'>
                               <?php
                            }
                             ?>
                         
                         </center></a><br>
                     <div class="panel-heading"><small><?= $PdataAR['name'] ?></small></div>
                     <h4><small class="pull-left text-nowrap"><!--Price.16,200--></small> <small style="font-size: 15px;color:sandybrown" class="pull-right">Rs.<?= $PdataAR['price'] ?>/-</small></h4>
                 </div>
                    <div class="panel-footer" style="border-top:none;background-color: white;">              
                        <a data-toggle="modal" data-target="#cart<?= $PdataAR['id'] ?>" class="btn btn-default"><small><span class="glyphicon glyphicon-plus"></span>Add to Cart</small></a>
                        <a href="BuyNow.php?b=<?php echo $PdataAR["id"]; ?>" class="btn btn-default pull-right" style="background-color: black;color: white"><small>Buy</small></a>
                 </div>
             </div>
            </div>
                    <form action="cart.php">
                          <!-- Modal -->
                     <div id="cart<?= $PdataAR['id'] ?>" class="modal fade" role="dialog">
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
                                            <input type="hidden" id="pid" name="pid" value="<?php echo $PdataAR["id"]; ?>"> 
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
          <?php
               }
          ?>
      
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
              $rowToken=mysql_query("select * from `category` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]' and `name`='$cat' ");
              $cou = mysql_num_rows($rowToken);
              if($cou==1)
              {
                  echo "<script>alert('THIS CATEGORY ALREADY ADDED.!');</script>";
              }
              else
              {
                  if(mysql_query("INSERT INTO `category`(`uid`, `hid`, `name`) VALUES ('$_SESSION[UID]','$_SESSION[hid]','$cat')"))
                    {
                        echo "<script>alert('One Category Added');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
                    }
                    else 
                    {
                        echo "<script>alert('Error Category Not Added.!');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
                    }
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
              $rowToken=mysql_query("select * from `subcategory` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]' and `name`='$subcat' and `cid`='$maincat' ");
              $cou = mysql_num_rows($rowToken);
              if($cou==1)
              {
                  echo "<script>alert('THIS CATEGORY ALREADY ADDED.!');</script>";
              }
              else
              {
                    if(mysql_query("INSERT INTO `subcategory`(`cid`, `name`, `uid`, `hid`) VALUES ('$maincat','$subcat','$_SESSION[UID]','$_SESSION[hid]')"))
                    {
                        echo "<script>alert('One Sub-Category Added');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
                    }
                    else 
                    {
                        echo "<script>alert('Error Sub-Category Not Added.!');window.location='hub.php?uid=$_SESSION[UID]&hid=$_SESSION[hid]';</script>";
                    }
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
              <input type="text" name="proname" placeholder="Enter Product Name" class="form-control" required/><br/>
              <textarea name="proinfo" placeholder="Product Detail"  class="form-control" required></textarea><br/>
              <input type='number' name='proqty' placeholder='Qty'  class="form-control" required><br/>
              <select name="ProMainCat" class='form-control' id="ProMainCat" required placeholder='Select Category'>
               <?php
               echo "<option></option>";
                    $catRow = mysql_query("select * from `category` where `uid`='$_SESSION[UID]' and `hid`='$_SESSION[hid]'");
                    $cou1 = mysql_num_rows($catRow);
                    if($cou1==0)
                    {
                        echo "<option>Add Category</option>";
                    }
                    else 
                    {
                        while($MainCat = mysql_fetch_array($catRow))
                        {
                            echo "<option value='$MainCat[id]'>$MainCat[name]</option>";
                        }
                        
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
           <select id="ProSubCat" name="ProSubCat" class="form-control" required >
           </select><br/>
           <input type="number" name="proprice" placeholder="Product Amount" class="form-control" required/><br/>
              <input type="file" name="fileToUpload" required><br/>
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

