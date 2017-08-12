<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/hexagone.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script>
        var tocken=0;
        var tocken1=0;
        var tocken2=0;
        var p3;
        function hide_sub()
        {
              $("#a1_f3").css("visibility","hidden"); 
              $("#a2").css("visibility","hidden");
              $("#a3_b1").css("visibility","hidden");
              $("#b2").css("visibility","hidden");
              $("#b3_c1").css("visibility","hidden");
              $("#c2").css("visibility","hidden");
              $("#d1_c3").css("visibility","hidden");
              $("#d2").css("visibility","hidden");
              $("#e1_d3").css("visibility","hidden");
              $("#e2").css("visibility","hidden");
              $("#f1_e3").css("visibility","hidden");
              $("#f2").css("visibility","hidden");
        }
        
          $("document").ready(function()
          {
              hide_sub();
              
              $("#a").mouseenter(function()
              {
                  if(tocken==0)
                  {
                   //a1_f3 a2 a3_b1   SHOW
                   $("#a1_f3").css("visibility","visible"); 
                   $("#a2").css("visibility","visible");
                   $("#a3_b1").css("visibility","visible");
                   // a_TO_F center HIDE
                    $("#center").css("opacity","0.5");
                    $("#a").css("opacity","0.5");
                    $("#b").css("opacity","0.5");
                    $("#c").css("opacity","0.5");
                    $("#d").css("opacity","0.5");
                    $("#e").css("opacity","0.5");
                    $("#f").css("opacity","0.5");
                     tocken=1; 
                }
                else
                {
                   $("#a1_f3").css("visibility","hidden"); 
                   $("#a2").css("visibility","hidden");
                   $("#a3_b1").css("visibility","hidden");
                    
                    $("#center").css("opacity","1");
                    $("#a").css("opacity","1");
                    $("#b").css("opacity","1");
                    $("#c").css("opacity","1");
                    $("#d").css("opacity","1");
                    $("#e").css("opacity","1");
                    $("#f").css("opacity","1");
                    tocken=0;
                }
                 
              });
              
             
              
              $("#c").mouseenter(function()
              {
                  
                  if(tocken2==0)
                  {
                   //b3_c1 c2 d1_c3  SHOW
                   $("#b3_c1").css("visibility","visible"); 
                   $("#c2").css("visibility","visible");
                   $("#d1_c3").css("visibility","visible");
                   // a_TO_F center HIDE
                    $("#center").css("opacity","0.5");
                    $("#a").css("opacity","0.5");
                    $("#b").css("opacity","0.5");
                    $("#c").css("opacity","0.5");
                    $("#d").css("opacity","0.5");
                    $("#e").css("opacity","0.5");
                    $("#f").css("opacity","0.5");
                     tocken2=1; 
                }
                else
                {
                   $("#b3_c1").css("visibility","hidden"); 
                   $("#c2").css("visibility","hidden");
                   $("#d1_c3").css("visibility","hidden");
                    
                    
                    $("#center").css("opacity","1");
                    $("#a").css("opacity","1");
                    $("#b").css("opacity","1");
                    $("#c").css("opacity","1");
                    $("#d").css("opacity","1");
                    $("#e").css("opacity","1");
                    $("#f").css("opacity","1");
                    tocken2=0;
                }
                 
              });
              // for center start
              $("#center").mouseenter(function(){
                  $("#f").text("Corporrate");
                  $("#b").text("Employee");
                  $("#d").text("Self");
                  
              });
              $("#center").mouseleave(function(){
                  $("#f").text("Who");
                  $("#b").text("Are");
                  $("#d").text("You?");
                  
              });
            // over 
              
            $("#e").mouseenter(function()
              {
                  
                  if(tocken1==0)
                  {
                   //b3_c1 c2 d1_c3  SHOW
                   $("#f1_e3").css("visibility","visible"); 
                   $("#e2").css("visibility","visible");
                   $("#e1_d3").css("visibility","visible");
                   // a_TO_F center HIDE
                    $("#center").css("opacity","0.5");
                    $("#a").css("opacity","0.5");
                    $("#b").css("opacity","0.5");
                    $("#c").css("opacity","0.5");
                    $("#d").css("opacity","0.5");
                    $("#e").css("opacity","0.5");
                    $("#f").css("opacity","0.5");
                     tocken1=1; 
                }
                else
                {
                  $("#f1_e3").css("visibility","hidden"); 
                   $("#e2").css("visibility","hidden");
                   $("#e1_d3").css("visibility","hidden");
                    
                    
                    $("#center").css("opacity","1");
                    $("#a").css("opacity","1");
                    $("#b").css("opacity","1");
                    $("#c").css("opacity","1");
                    $("#d").css("opacity","1");
                    $("#e").css("opacity","1");
                    $("#f").css("opacity","1");
                    tocken1=0;
                }
                 
              });
              
             
             $("#a1_f3").click(function()
             {
                    p3 = "Science";
                    $("#a1_f3").addClass("glyphicon");
                    $("#a1_f3").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
                    
             
             }); 
                 
             
             $("#a2").click(function()
             {
                    p3 = "Arts";
                    $("#a2").addClass("glyphicon");
                    $("#a2").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
             
             }); 
             
             
             
             $("#a3_b1").click(function()
             {
             
                    p3 = "Commerce";
                    $("#a3_b1").addClass("glyphicon");
                    $("#a3_b1").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
                    
             }); 
             
             
             $("#b3_c1").click(function()
             {
                    p3 = "HouseWorker";
                    $("#b3_c1").addClass("glyphicon");
                    $("#b3_c1").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
             
             }); 
             
             
             $("#c2").click(function()
             {
                    p3 = "Politicians";
                    $("#c2").addClass("glyphicon");
                    $("#c2").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
             
             }); 
             
             $("#d1_c3").click(function()
             {
                    p3 = "SocialActivity";
                    $("#d1_c3").addClass("glyphicon");
                    $("#d1_c3").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
             
             }); 
             
             $("#e1_d3").click(function()
             {
                    p3 = "OtherEmp";
                    $("#e1_d3").addClass("glyphicon");
                    $("#e1_d3").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
             
             }); 
             
             $("#e2").click(function()
             {
                    p3 = "CropEmp";
                    $("#e2").addClass("glyphicon");
                    $("#e2").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
             
             }); 
           
             $("#f1_e3").click(function()
             {
                    p3 = "GovEmp";
                    $("#f1_e3").addClass("glyphicon");
                    $("#f1_e3").addClass("glyphicon-ok");
                    window.location="mainpage.php?cat="+p3;
             }); 
             
             
          });
        
    </script>
  </head>
  <body style="background-image: url(images/business_background.jpg)">
      
      <?php include './include/header.php';?>
      
      <div>
          <center>Welcome <?php echo $_SESSION["user"]; ?></center>
      </div>
          <center>
        
       <div class="hexagon hexagon1" style="height:104px;width: 187px;margin-top: 250px" ><div class="hexagon-in1"><div class="hexagon-in2" id="center" style="padding-top: 35px;color: white;font-size: 20px">Business</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: 10px"><div class="hexagon-in1"><div  id="d" class="hexagon-in2" style="padding-top: 35px;color: white;font-size: 20px;background-color:#2b542c">You..!</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -161px;margin-left: 115px"><div class="hexagon-in1"><div  id="c" class="hexagon-in2" style="padding-top: 35px;color: white;">Social</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -217px;margin-left: 115px" ><div class="hexagon-in1"><div id="b" class="hexagon-in2" style="padding-top: 35px;color: white;background-color:#2b542c ;">Are</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -160px;margin-left: -80px" ><div class="hexagon-in1"><div id="a" class="hexagon-in2" style="padding-top: 35px;color: white">Profession</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -47px;margin-left: -275px"><div class="hexagon-in1"><div  id="f" class="hexagon-in2" style="padding-top: 35px;color: white;background-color:#2b542c">Who</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: 10px;margin-left: -275px"><div class="hexagon-in1"><div  id="e" class="hexagon-in2" style="padding-top: 35px;color: white">Employee</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: 10px;margin-left: -275px" ><div class="hexagon-in1"><div id="e1_d3" class="hexagon-in2" style="padding-top: 35px;color: white">Other Emp.</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -50px;margin-left: -80x" ><div class="hexagon-in1"><div id="d2" class="hexagon-in2" style="padding-top: 35px;color: white">D-2</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -160px;margin-left: 110px" ><div class="hexagon-in1"><div id="d1_c3" class="hexagon-in2" style="padding-top: 35px;color: white">Social <br/> Activity</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -159px;margin-left: 305px" ><div class="hexagon-in1"><div id="c2" class="hexagon-in2" style="padding-top: 35px;color: white">Politicians</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -220px;margin-left: 310px"><div class="hexagon-in1"><div  id="b3_c1" class="hexagon-in2" style="padding-top: 35px;color: white">House<br/>Worker</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -215px;margin-left: 310px" ><div class="hexagon-in1"><div id="b2" class="hexagon-in2" style="padding-top: 35px;color: white">B-2</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -160px;margin-left: 120px"><div class="hexagon-in1"><div id="a3_b1" class="hexagon-in2" style="padding-top: 35px;color: white">Commerce</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -162px;margin-left: -75px"><div class="hexagon-in1"><div  id="a2" class="hexagon-in2" style="padding-top: 35px;color: white">Art's</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -50px;margin-left: -275px"><div class="hexagon-in1"><div  id="a1_f3" class="hexagon-in2" style="padding-top: 35px;color: white">Science</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -45px;margin-left: -465px"><div class="hexagon-in1"><div  id="f2" class="hexagon-in2" style="padding-top: 35px;color: white">F-2</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: 8px;margin-left: -465px"><div class="hexagon-in1"><div  id="f1_e3" class="hexagon-in2" style="padding-top: 35px;color: white">Gov. Emp</div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: 8px;margin-left: -465px"><div class="hexagon-in1"><div  id="e2" class="hexagon-in2" style="padding-top: 35px;color: white">Crop. Emp.</div></div></div>
       <br/><br/>
    
        </center>
     

    <script src="js/bootstrap.min.js"></script>
  </body>
  
</html>