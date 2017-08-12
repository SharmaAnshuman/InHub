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
  </head>
  <body>
          <?php
          session_start();
                include("./include/header.php");
                              include './config/conn.php';
          ?>
      <br/>
      <?php
       if(isset($_REQUEST['tok']))
       {
           $row = mysql_query("select * from `uncomm` where email='$_SESSION[email]' and mobile='$_SESSION[mobile]' ");
           while($data = mysql_fetch_array($row))
           {
               mysql_query("select * from `unreplay`");
           }

       }
       else 
       {
       
       ?>
      <div class='container col-md-offset-1 col-md-5'>
            <form>
                <input type="email" name="email" placeholder="Email Address" class="form-control">
                <input type="mobile" name="mobile" placeholder="Mobile"  class="form-control">
                <input type="submit" class="btn btn-default" value="View Respone">
            </form>
          <?php
        
                      if( (isset($_REQUEST['email'])) && (isset($_REQUEST['mobile'])) )
                      {
                        $_SESSION['mobile'] = mysql_real_escape_string($_REQUEST['mobile']);
                        $_SESSION['email'] = mysql_real_escape_string($_REQUEST['email']);
                        $row = mysql_query("select * from `uncomm` where email='$_SESSION[email]' and mobile='$_SESSION[mobile]'");
                        
                        $tot = mysql_num_rows($row);
                        if($tot == 0)
                        {
                            echo "<h1>Check Data You Have Enterd..</h1>";
                        }
                        else
                        {
                            header("Location: viewReplay.php?tok=pass");
                        }
                      }
          
          ?>
      </div>
      <?php
       }
      ?>
  </body>
</html>
