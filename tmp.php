<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
      <body style="background-color: #f5f5f5">
        
            <?php
                include './include/header.php';
            ?>
        <!-- cover photo -->
        <div class="jumbotron container" style="height: 250px;">
            
        </div>
        <!-- Profile photo -->
    <center>
        <div class="" style="margin-top: -150px">
            <img src="images/742493-awesome-science-wallpaper.jpg" class="img img-thumbnail" width="400" />
        </div>
    </center>
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
                            <span style="margin-left: 20px">910000000</span>
                        </div>
                        <div>
                            <span class="glyphicon glyphicon-envelope" style="margin-top: 15px"></span>
                            <span style="margin-left: 20px">xyz@gmail.com</span> 
                        </div>
                         <div>
                            <span class="glyphicon glyphicon-pushpin" style="margin-top: 15px"></span>
                            <span style="margin-left: 20px">your address
                                                            
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
                           <span>Kamani science College</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                        </div>
                        <div class="disp">
                            <small>BCA, 2011-2016</small>
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
                           <span>Male</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                        </div>
                        <div class="disp">
                           <b>Birth Date</b><br/>
                           <span>10-06-1996</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
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
                           <span><a href="#">inhubs.com</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
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
                 <input  type="text" name="clg" class="form-control" placeholder="Mobile No." /><br/>
                 <input  type="text" name="clg" class="form-control" placeholder="Email Address" /><br/>
                 <textarea  class="form-control" placeholder="Address">Address </textarea>
   
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_register">
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
                 <input  type="text" name="clg" class="form-control" placeholder="Collage Name" /><br/>
                 <input  type="text" name="clg" class="form-control" placeholder="Course" /><br/>
                 <textarea  class="form-control" placeholder="Address">About Course</textarea>
   
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_register">
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
                <select class="form-control">
                    <option>Male</option>
                    <option>Female</option>
                </select><br/>
                
                <input  type="date" name="clg" class="form-control" placeholder="Birthday of date" /><br/>
   
   
             </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
                <input type="submit" value="Done" class="btn btn-primary pull-right" name="btn_register">
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
    
    
    </body>
</html>