<?php 
    session_start();
    include './config/conn.php';
     include './FBsrc/Facebook/autoload.php';
    if(isset($_SESSION["user"]))
    {
        header("Location: home.php");
    }
    else
    {
        if(isset($_REQUEST['key']))
        {
        $key = $_REQUEST['key'];
        $krow = mysql_query("select * from `login` where `fname`='$key'");
        $kc= mysql_num_rows($krow);
        if($kc==0)
        {
            
        }
        else
        {
            $karr =mysql_fetch_array($krow);
            header('Location: viewfriend.php?token='.$karr[id].'');
            die();
            
        }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: In Hubs ::</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyle.css" />
    <link href="mycss.css" rel="stylesheet">

    <script>
        var userNM = document.getElementById("");
    </script>
  </head>
  <body style="background-image: url(images/business_background.jpg)" class="img-responsive">

      <form method="POST">
          

          <?php
               include("./include/header.php");
          ?>

     
      <br/>
      <div class="container">
                    
           
          <div class="col-md-7"style="padding-left: 20px">
              
             <br/>
              <font class="text-justify" size="3">
              <center><h3>Be Start With inHub<small>s</small> </h3></center>
              <hr>
              Welcome to
Getit Infomedia Yellow Pages
. We have more than 25 years of experience in connecting buyers and sellers. Our business model is designed to assist business enquiry generation and conversion for our trusted and verified advertisers. We provide hot buying leads and easy access to useful local information. Join the fastest growing network of local business today and experience the best rates and service for your needs! 
              <img 
              </font>
          </div>
          <div class="col-md-4 col-md-offset-1"  style="padding: 20px;background-image: url(images/core1.png);">
              <div class="col-md-12">
                  <center>
                              <table class="">
                                  <tr>
                                      <td colspan="2">
                                          <div class="text-center" style="color: black;text-shadow:1px 2px 2px white"><h3>    Welcome into In-Hubs</h3></div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td  colspan="2">
                                  <center><div><!-- Join Pinterest to discover and save creative ideas--> Be start With In-Hubs </div></center>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td  colspan="2">
                                          <br/>
                                      </td>
                                  </tr>
                                  <tr> 
                                      <td><a class="btn btn-default">Just Visitor</a></td>
                                      <td align="right">  <a data-toggle="modal" class="btn btn-default" data-target="#login">Register</a></td>
                                    </tr>
                                  <tr>
                                      <td colspan="2">
                                          <hr>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                          <?php
                                            $fb = new Facebook\Facebook([
                                                'app_id' => '541930349301504',
                                                'app_secret' => 'eb43d69dfe71f19a7f0df711498854be',
                                                'default_graph_version' => 'v2.5',
                                              ]);
                                            $helper = $fb->getRedirectLoginHelper();
                                            $permissions = ['email', 'user_likes']; // optional
                                            if(isset($_SESSION["test"]))
                                            {
                                                try
                                                {
                                                    $response = $fb->get('/me?fields=id,name,email,picture',$_SESSION["test"]);
                                                }
                                                catch(Facebook\Exceptions\FacebookResponseException $e) 
                                                {
                                                    echo 'Graph returned an error: ' . $e->getMessage();
                                                }
                                                catch(Facebook\Exceptions\FacebookSDKException $e) 
                                                {
                                                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                                                }
                                                  $user = $response->getGraphUser();                                                  
                                                  $_SESSION["fb_pic"]=$user["picture"]["url"];
                                                  $_SESSION["fb_name"]=$user["name"];
                                                  $_SESSION["fb_email"]=$user["email"];
                                                  //header("Location: home.php");
                                            }
                                            else
                                            {
                                                  $loginUrl = $helper->getLoginUrl('http://localhost/bhub/fbcallback.php', $permissions);
                                                echo '<a href='.$loginUrl.' class="btn btn-primary col-md-12 col-sm-12  col-xs-12" >Login With Facebook</a>';
                                            }


                                            ?>
                                          
                                              <br/>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                          <br/>
                                           <div class="input-group col-md-12 col-sm-12  col-xs-12">
                                                <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-user"></i></small></span>
                                                <input type="text" class="form-control" placeholder="Username or Email"   name="username">
                                            </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                          <br/>
                                          <div class="input-group col-md-12 col-sm-12  col-xs-12">
                                                <span class="input-group-addon" style="background-color: #337ab7;color: white"><small><i class="glyphicon glyphicon-lock"></i></small></span>
                                                <input type="password" class="form-control" placeholder="Password"   name="password">
                                                
                                            </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <br/>
                                          <a href="">Forget Password.!</a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                          <br/>
                                  <center>
                                      <input type="submit" value="Login" class="btn btn-success btn-block"  name="btn_login">
                                  </center>
                                      </td>
                                  </tr>
                              </table>
          
                      
                  </center>
              </div>
          </div>
      
      

      </div>
      </form>
      
      <br/><br/>
  <center><small>State</small> </center>
  <div class='container'>
      <nav>
  <ul class="pagination">
      
  <li><a  href="viewBusiness.php?state=AndhraPradesh" >AndhraPradesh</a></li>
  <li><a  href="viewBusiness.php?state=ArunachalPradesh"  >Arunachal Pradesh</a></li>
  <li><a  href="viewBusiness.php?state=Assam"  >Assam</a></li>
  <li><a   href="viewBusiness.php?state=Bihar"  >Bihar</a></li>
  <li><a   href="viewBusiness.php?state=Chhattisgarh"  >Chhattisgarh</a></li>
  <li><a   href="viewBusiness.php?state=Delhi"  >Delhi</a></li>
  <li><a   href="viewBusiness.php?state=Goa"  >Goa</a></li>
  <li><a   href="viewBusiness.php?state=Gujarat"  >Gujarat</a></li>
  <li><a   href="viewBusiness.php?state=Haryana"  >Haryana</a></li>
  <li><a   href="viewBusiness.php?state=JammuKashmir"  >Jammu & Kashmir</a></li>
  <li><a   href="viewBusiness.php?state=Jharkhand"  >Jharkhand</a></li>
  <li><a   href="viewBusiness.php?state=Karnataka"  >Karnataka</a></li>
  <li><a   href="viewBusiness.php?state=Kerala"  >Kerala</a></li>
  <li><a   href="viewBusiness.php?state=MadhyaPradesh"  >Madhya Pradesh</a></li>
  <li><a   href="viewBusiness.php?state=Maharashtra"  >Maharashtra</a></li>
  <li><a   href="viewBusiness.php?state=HimachalPradesh"  >Himachal Pradesh</a></li>
  <li><a   href="viewBusiness.php?state=Manipur"  >Manipur</a></li>
  <li><a   href="viewBusiness.php?state=Meghalaya"  >Meghalaya</a></li>
  <li><a   href="viewBusiness.php?state=Mizoram"  >Mizoram</a></li>
  <li><a   href="viewBusiness.php?state=Nagaland"  >Nagaland</a></li>
  <li><a   href="viewBusiness.php?state=Orissa"  >Orissa</a></li>
  <li><a   href="viewBusiness.php?state=Punjab"  >Punjab</a></li>
 <li> <a   href="viewBusiness.php?state=Rajasthan"  >Rajasthan</a></li>
  <li><a   href="viewBusiness.php?state=Sikkim"  >Sikkim</a></li>
  <li><a   href="viewBusiness.php?state=TamilNadu"  >Tamil Nadu</a></li>
  <li><a   href="viewBusiness.php?state=Telangana"  >Telangana</a></li>
  <li><a   href="viewBusiness.php?state=Tripura"  >Tripura</a></li>
  <li><a   href="viewBusiness.php?state=UttarPradesh"  >Uttar Pradesh</a></li>
  <li><a   href="viewBusiness.php?state=Uttarakhand"  >Uttarakhand</a></li>
  <li><a   href="viewBusiness.php?state=WestBengal"  >West Bengal</a></li>
  
  
  </ul>
</nav>
      
  </div>

  <br/><br/>
  
      
      
      <?php include './models/register.php'; ?>
      <br/><br/><br/><br/><br/>
      <script src="js/jquery.min.js"></script>
      <?php include './js/myjs.php'; ?>
    <script src="js/bootstrap.min.js"></script>
  </body>  
</html>
<?php 
        if(isset($_REQUEST["btn_login"]))
        {
            $user =$_REQUEST["username"];
            $pass =$_REQUEST["password"];
            $row = mysql_query("select * from login where email='$user' and password='$pass' and active=1 ");
            $count= mysql_num_rows($row);
            if($count==1)        
            {
                $_SESSION["user"]=$user;
                $email = $_SESSION["user"];
                $row=mysql_query("select * from `login` where email='$email' and `password`='$pass' ");
                $arr=mysql_fetch_array($row);
                $_SESSION["UID"]=$arr["id"];
               
                //header("Location: home.php");               
                echo "<script>window.location='home.php'</script>";
            }
            else
            {
                echo "<script>alert('Username And Password not Found..!')</script>";
            }   
        }
        if(isset($_REQUEST["btn_visit"]))
        {
           //$_SESSION["user"]="GUSER";
           //echo "<script>window.location='home.php'</script>";
        }
        if(isset($_REQUEST["btn_register"]))
        {
            $fname = mysql_escape_string($_REQUEST["fname"]);
            $lname = mysql_escape_string($_REQUEST["lname"]);
            $user = mysql_escape_string($_REQUEST["regi_username"]);
            $pass = mysql_escape_string($_REQUEST["regi_password"]);
            $pass_confim=mysql_escape_string($_REQUEST["regi_password_confim"]);
            $cat  = $_REQUEST["catName"];
            if(mysql_query("INSERT INTO `login`(`email`, `password`, `active`,`fname`,`lname`,`profileimg`,`coverimg`,`cat`) VALUES ('$user','$pass',1,'$fname','$lname','Profile.png','Cover.png','$cat')"))
            {
                
                $_SESSION["user"]=$user;
                $email = $_SESSION["user"];
                $row=mysql_query("select * from `login` where email='$email' and `password`='$pass' ");
                $arr=mysql_fetch_array($row);
                $_SESSION["UID"]=$arr["id"];
                
                mysql_query("INSERT INTO `notification`(`uid`,`dt`) VALUES ('$_SESSION[UID]',CURRENT_TIMESTAMP)");
                if($_REQUEST["regi_phnno"]!="")
                {
                    $phnno = mysql_escape_string($_REQUEST["regi_phnno"]);
                    mysql_query("insert into `userinfo` (`uid`,`mobile`) values('$_SESSION[UID]','$phnno')");
                }
                else
                {
                mysql_query("insert into `userinfo` (`uid`) values('$_SESSION[UID]')");
                }
                echo "<script>window.location='home.php'</script>";   
            }
            else
            {
                echo "<script>alert('This Email Address Already Registerd..!')</script>";
            }   
        }      
?>