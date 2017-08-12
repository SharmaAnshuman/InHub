
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
      
      
      <?php
      include './config/conn.php';
      include './include/header.php';
         $a = mysql_real_escape_string($_REQUEST["state"]);
      ?>
      <br/><br/>
  <center><small><?php echo $a; ?> </small> Business's</center>
  <div class='container'>
       <div class="row">
      <?php
            $q1 = mysql_query("select * from `hub` where `state` = '$a' ");
            while($d1 = mysql_fetch_array($q1))
            {
      ?>
     
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <?php
        if($d1['hubimg']=="" || $d1['hubimg']==" " || $d1['hubimg']==null)
        {
            ?>
        <img src="images/logo/MYHubCoverPost.png" >
            <?php
        }
        else
        {
            ?>
        <img src="userPic/<?php echo $d1['hubimg'] ?>" >
            <?php
        }
        ?>
      <div class="caption">
          <h3><?php echo ucfirst($d1['name']) ?> </h3>
        <p><?php echo ucfirst($d1['cat']) ?></p>
        <p> <a href="viewhub.php?hid=<?php echo $d1['id'] ?>" class="btn btn-info">GoTo Hub</a></p>
      </div>
    </div>
  </div>

     
    <?php
            }
    ?>
  
  
  </div>
  </div>

  </body>
</html>
