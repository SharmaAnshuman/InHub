<?php
session_start();
if(isset($_SESSION["user"]))
{
    
}
else
{
    header("Location: index.php");
}
include './config/conn.php';
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
    $(document).ready(function()
    {
        $("#ProfilePic").click(function()
           {
               $("#profilePicModal").modal('show');
           });
           
           $("#CoverPic").click(function()
           {
               $("#coverPicModal").modal('show');
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
   
    
    </script>
  </head>
 <body style="background-image: url(images/business_background.jpg);background-repeat: no-repeat;background-attachment: fixed;" class="img-responsive">
        
            <?php
                include './include/header.php';
                $uq = mysql_query("select * from `login` where email='$_SESSION[user]'");
                $m = mysql_fetch_array($uq);
                
            ?>
          <br><br>
          <div class="col-md-12" style="margin-bottom: 10px">
            <!-- cover photo -->

              <div class="jumbotron container" style="height: 250px;padding:9px" id="uploadCoverPic" >
                  <img src="userPic/<?php echo $m["coverimg"]; ?>"  style="background-image:url(images/business_background.jpg);" height="100%" width="100%">
                  <h3><span class="glyphicon glyphicon-pencil pull-right" style="margin-top:-60px;margin-right: 10px;cursor: pointer" id="CoverPic">upload</span></h3>
                            <img src="userPic/<?php echo $m["profileimg"]; ?>" height="120px" width="120px" style="background-image:url(graphics/default-cover.png);margin-left: 10px;margin-top:-150px;border:none;box-shadow:0px 1px 5px 1px black" id="uploadProfilePic" />

                  <span class="glyphicon glyphicon-pencil" style="cursor: pointer;margin-left: 10px;padding-top: 5px;margin-left: -120px"id="ProfilePic">
                      <x style="">upload</x></span>
                  <br/>
              </div>

            </div>
            <br/>
      
      <?php
        $q = mysql_query("select * from `userinfo` where `uid` =(select `id` from `login` where `email` = '$_SESSION[user]')");
        if(mysql_num_rows($q)==0)
        {

                        ?>


                      <div class="container" style="margin-top: 30px">
                          <div class="row">

                               <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Personal Contact Info.
                                              <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M1">

                                          </span>
                                          </div>
                                      </div>
                                      <div class="panel panel-body">
                                          <div>
                                              <span class="glyphicon glyphicon-earphone"></span>
                                              <span style="margin-left: 20px" id="showMo">Mobile No.</span>
                                          </div>
                                          <div>
                                              <span class="glyphicon glyphicon-envelope" style="margin-top: 15px"></span>
                                              <span style="margin-left: 20px" id="showEmailAdd">Email Address</span> 
                                          </div>
                                           <div>
                                              <span class="glyphicon glyphicon-pushpin" style="margin-top: 15px"></span>
                                              <span style="margin-left: 20px" id="showAddress">Your Address

                                              </span> 
                                          </div>
                                      </div>

                                  </div>
                               </div>


                              <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Education
                                               <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M2">

                                          </span>
                                          </div>
                                      </div>
                                      <div class=" panel-body">
                                         <div class="disp">
                                             <b>College</b><br/>
                                             <span id="showclgnm">Your College Name...</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>
                                          <div class="disp">
                                              <small><x id="showcourseNM">Course</x>,<y id="showDt">starting to ending</y></small>
                                          </div>
					<div class="disp">
                                              <small id="showaboutCourse">Course information</small>
                                          </div>
                                      </div>

                                  </div>
                               </div>

                              <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Gender & Birthday
                                              <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M3">
                                          </div>
                                      </div>
                                      <div class=" panel-body">
                                          <div class="disp">
                                             <b>Gender</b><br/>
                                             <span id="showgen">Male</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>
                                          <div class="disp">
                                             <b>Birth Date</b><br/>
                                             <span id="showdob">10-06-1996</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>
                                      </div>
                                  </div>
                               </div>
                              <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Website/ Blog
                                              <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M4">
                                          </div>
                                      </div>
                                      <div class=" panel-body">
                                          <div class="disp">
                                             <b>Website</b><br/>
                                             <span  id="showwww"><a href="#">inhubs.com</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>

                                      </div>
                                  </div>
                               </div>
                          </div>
                      </div>
      
    <div id="M1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              Personal Contact Info. 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                <input  type="text" name="clg" class="form-control" placeholder="Mobile No." id="mobileNo" /><br/>
                 <input  type="text" name="clg" class="form-control" placeholder="Email Address" value="<?php echo $_SESSION["user"]; ?>"  id="emailAdd" readonly/><br/>
                 <textarea  class="form-control" placeholder="Address" id="PersonAdd"></textarea>
   
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_person_details" id="btn_person_details">
            </div>
        </div>
    </div>
   </div> 
     
     
     
      <!-- All Models -->
    <div id="M2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
             Education 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                 <input  type="text" name="clg" class="form-control" placeholder="Collage Name" id="clgNM"/><br/>
                 <input  type="text" name="clg" class="form-control" placeholder="Course" id="courseNM"/><br/>
                 <textarea  class="form-control" placeholder="Address" id="aboutCourse">About Course</textarea><br/>
                 <input type="date" class="form-control" id="CstartDate" placeholder="Starting Date"/><br/>
                 <input type="date" class="form-control" id="CEndDate" placeholder="Ending Date"/>
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_edu_save" id="btn_edu_save">
            </div>
        </div>
    </div>
   </div> 
      
      
      
       <!-- All Models -->
    <div id="M3" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              Gender & Birthday 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                Gender:
                <select class="form-control" id="gen">
                    <option>Male</option>
                    <option>Female</option>
                </select><br/>
                
                <input  type="date" name="clg" class="form-control" placeholder="Birthday of date" id="bod"/><br/>
   
   
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_bod_save" id="btn_bod_save">
            </div>
        </div>
    </div>
   </div> 
       
       
       
        <!-- All Models -->
    <div id="M4" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              Website/ Blog 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                 <input  type="text" name="clg" class="form-control" placeholder="www." id="M4_www"/><br/>
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_website_save" id="btn_website_save">
                
            </div>
        </div>
    </div>
   </div> 
      <?php
        }
        else
        {
            $a = mysql_fetch_array($q);

                        ?>


                      <div class="container" style="margin-top: 30px">
                          <div class="row">

                               <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Personal Contact Info.
                                              <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M1">

                                          </span>
                                          </div>
                                      </div>
                                      <div class="panel panel-body">
                                          <div>
                                              <span class="glyphicon glyphicon-earphone"></span>
                                              <span style="margin-left: 20px" id="showMo"><?php echo $a['mobile']; ?></span>
                                          </div>
                                          <div>
                                              <span class="glyphicon glyphicon-envelope" style="margin-top: 15px"></span>
                                              <span style="margin-left: 20px" id="showEmailAdd"><?php echo $a['emailaddress']; ?></span> 
                                          </div>
                                           <div>
                                              <span class="glyphicon glyphicon-pushpin" style="margin-top: 15px"></span>
                                              <span style="margin-left: 20px" id="showAddress"><?php echo $a['address']; ?>

                                              </span> 
                                          </div>
                                      </div>

                                  </div>
                               </div>


                              <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Education
                                               <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M2">

                                          </span>
                                          </div>
                                      </div>
                                      <div class=" panel-body">
                                         <div class="disp">
                                             <b>College</b><br/>
                                             <span id="showclgnm"><?php echo $a['clgnm']; ?>..</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>
                                          <div class="disp">
                                              <small><x id="showcourseNM"><?php echo $a['coursenm']; ?></x>,<y id="showDt"><?php echo $a['clgyear']; ?></y></small>
                                          </div>
                                        <div class="disp">
                                              <small id="showaboutCourse"><?php echo $a['courseabout']; ?></small>
                                          </div>
                                      </div>

                                  </div>
                               </div>

                              <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Gender & Birthday
                                              <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M3">
                                          </div>
                                      </div>
                                      <div class=" panel-body">
                                          <div class="disp">
                                             <b>Gender</b><br/>
                                             <span id="showgen"><?php echo $a['gender']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>
                                          <div class="disp">
                                             <b>Birth Date</b><br/>
                                             <span id="showdob"><?php echo $a['dob']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>
                                      </div>
                                  </div>
                               </div>
                              <div class="col-md-4">
                                  <div class="panel panel-primary" style="width: 300px">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Website/ Blog
                                              <span class="label label-primary glyphicon glyphicon-pencil pull-right" style="cursor: pointer;font-size: 16px" data-toggle="modal" data-target="#M4">
                                          </div>
                                      </div>
                                      <div class=" panel-body">
                                          <div class="disp">
                                             <b>Website</b><br/>
                                             <span id="showwww"><a href="<?php echo $a['website']; ?>"><?php echo $a['website']; ?></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          </div>

                                      </div>
                                  </div>
                               </div>
                          </div>
                      </div>
        
    <div id="M1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              Personal Contact Info. 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                <input  type="text" name="clg" class="form-control" placeholder="Mobile No." id="mobileNo" value="<?php echo $a["mobile"]; ?>"/><br/>
                 <input  type="text" name="clg" class="form-control" placeholder="Email Address" value="<?php echo $_SESSION["user"]; ?>"  id="emailAdd" readonly/><br/>
                 <textarea  class="form-control" placeholder="Address" id="PersonAdd"><?php echo $a["address"]; ?></textarea>
   
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_person_details" id="btn_person_details">
            </div>
        </div>
    </div>
   </div> 
     
     
     
      <!-- All Models -->
    <div id="M2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
             Education 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                 <input  type="text" name="clg" class="form-control" placeholder="Collage Name" id="clgNM"  value="<?php echo $a["clgnm"]; ?>"/><br/>
                 <input  type="text" name="clg" class="form-control" placeholder="Course" id="courseNM" value="<?php echo $a["coursenm"]; ?>"/><br/>
                 <textarea  class="form-control" placeholder="Address" id="aboutCourse"><?php echo $a["courseabout"]; ?></textarea><br/>
                 <input type="date" class="form-control" id="CstartDate" placeholder="Starting Date"/><br/>
                 <input type="date" class="form-control" id="CEndDate" placeholder="Ending Date"/>
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_edu_save" id="btn_edu_save">
            </div>
        </div>
    </div>
   </div> 
      
      
      
       <!-- All Models -->
    <div id="M3" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              Gender & Birthday 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                Gender:
                <select class="form-control" id="gen">
                    <option>Male</option>
                    <option>Female</option>
                </select><br/>
                
                <input  type="date" name="clg" class="form-control" placeholder="Birthday of date" id="bod" value="<?php echo $a["dob"]; ?>"/><br/>
   
   
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_bod_save" id="btn_bod_save">
            </div>
        </div>
    </div>
   </div> 
       
       
       
        <!-- All Models -->
    <div id="M4" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              Website/ Blog 
            </div>
            <div class="modal-body">
            <!-- BODy  -->
            <div style="display: inline">
                <input  type="text" name="clg" class="form-control" placeholder="www." id="M4_www" value="<?php echo $a["website"];?>"/><br/>
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_website_save" id="btn_website_save">
                
            </div>
        </div>
    </div>
   </div> 
      <?php
        }
      ?>
   
    
    
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