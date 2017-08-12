<?php
        session_start();
        include_once './config/conn.php';
?>
<html>
    <head>
        <title>
            Main Page
        </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>
    <?php
        if(isset($_REQUEST['cat'])){
            $cat=$_REQUEST['cat'];
            if($cat=="Arts"){
               $img="abstract-art-colorful.jpg";
               
            }elseif ($cat=="Science") {
                $img="dna-6.jpg";
            }elseif ($cat=="Commerce") {
                $img="ecommerce1.jpg";
            }
        }
    ?>
    
   
    <body style="background-image:url(images/<?php echo $img; ?>)">
        

            <?php
                include 'include/header.php';
            ?> 

        <div class="container col-md-6 col-md-offset-3" style="margin-top: 30px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        Personal Detail
                    </div>
                </div>
                <div class="container panel-body" style="padding-left: 50px">
            <div class="row">
            <div class="col-md-6">
                <form method="post" >
                <div class="input-group" style="margin-top: 20px">
                  <span class="input-group-addon" id="sizing-addon3"><small>First Name</small></span>
                  <input type="text" class="form-control"  name="fname">
                </div>
                
                <div class="input-group" style="margin-top: 20px">
                  <span class="input-group-addon" id="sizing-addon3"><small>Last Name</small></span>
                  <input type="text" class="form-control"  name="lname">
                </div>
                
                 <div class="input-group" style="margin-top: 20px">
                  <span class="input-group-addon" id="sizing-addon3"><small>Brith Of Date</small></span>
                  <input type="date" class="form-control"  name="dob" placeholder="YYYY-MM-DD">
                </div>
                
                 <div class="input-group" style="margin-top: 20px">
                     <span class="input-group-addon" id="sizing-addon3" style="border-right:1px solid #999">Gender</span>
                  <div style="border: 2px solid #eeeeee;padding: 3px">
                  <input type="radio" name="gender" value="male" style="margin-left: 10px"  /> Male
                  <input type="radio" name="gender" value="female"/> Female</div>
                </div>
                <div align="center" style="margin-top: 20px">
                    <input type="submit" name="sub" value="Submit" class="btn btn-primary" />
                </div>
                    </form>
            </div>
           
            </div>
            <br/>
            
        </div>
            </div>
        </div>
        
        
    </body>
    <?php

    
 if(isset($_SESSION["user"]))
 {
     if(isset($_REQUEST["cat"]))
     {
        if(isset($_POST['sub']))
        {
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $dob=$_POST['dob'];
            $gender=$_POST['gender'];
            
            $c_user=$_SESSION['user'];
            $cat = $_REQUEST["cat"];
            mysql_query("UPDATE login set fname='$fname',lname='$lname',dob='$dob',gender='$gender',`cat`='$cat' where email='$c_user'")or die("not inserted....");
            echo "<script>window.location='home.php'</script>";
      

        }
              
     }
 }
  
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>