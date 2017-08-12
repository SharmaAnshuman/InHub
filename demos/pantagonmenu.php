<html>
    <head>
        <style>
      BODY {
    
}
.hexagon {
    overflow: hidden;
    
    -webkit-transform: rotate(120deg);
       -moz-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
         -o-transform: rotate(120deg);
            transform: rotate(120deg);
    cursor: pointer;
    }
.hexagon-in1 {
    overflow: hidden;
    width: 100%;
    height: 100%;
    -webkit-transform: rotate(-60deg);
       -moz-transform: rotate(-60deg);
        -ms-transform: rotate(-60deg);
         -o-transform: rotate(-60deg);
            transform: rotate(-60deg);
    }
.hexagon-in2 {
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-position: 50%;
    background-color: #337ab7;
    
    -webkit-transform: rotate(-60deg);
       -moz-transform: rotate(-60deg);
        -ms-transform: rotate(-60deg);
         -o-transform: rotate(-60deg);
            transform: rotate(-60deg);
    }
.hexagon-in2 {
    background-color: #337ab7;
    }

.hexagon1 {
    width: 400px;
    height: 200px;
    margin: 0 0 0 -80px;
    }
.hexagon2 {
    width: 200px;
    height: 400px;
    margin: -80px 0 0 20px;
    }
.dodecagon {
    width: 200px;
    height: 200px;
    margin: -80px 0 0 20px;
    }

        </style>
        <script src="jquery-1.3.2.min.js"></script>
        <script>
            
/*            $("document").ready(function(){
                 $("#sub1").fadeOut();
                    $("#sub2").fadeOut();
                    $("#sub3").fadeOut();
                    $("#sub4").fadeOut();
                    $("#sub5").fadeOut();
                    $("#sub6").fadeOut();
                $("#maincat").mouseenter(function(){
                    $("#sub1").fadeIn();
                    $("#sub2").fadeIn();
                    $("#sub3").fadeIn();
                    $("#sub4").fadeIn();
                    $("#sub5").fadeIn();
                    $("#sub6").fadeIn();
                });
             $("#maincat").mouseleave(function(){
                    $("#sub1").fadeOut();
                    $("#sub2").fadeOut();
                    $("#sub3").fadeOut();
                    $("#sub4").fadeOut();
                    $("#sub5").fadeOut();
                    $("#sub6").fadeOut();
                });
            });*/
        </script>
    </head>
    <body>
    <center>
        
       <div class="hexagon hexagon1" style="height:104px;width: 187px;margin-top: 150px" id="maincat"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: 10px" id="sub1"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -161px;margin-left: 115px" id="sub2"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -217px;margin-left: 115px" id="sub3"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -160px;margin-left: -80px" id="sub4"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: -47px;margin-left: -275px" id="sub5"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
       <div class="hexagon hexagon1" style="height:104px;width:187px;margin-top: 10px;margin-left: -275px" id="sub6"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
       
<!--
<div class="hexagon hexagon1" style="height:60px" id="sub2"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
        <div class="hexagon hexagon1" style="height:60px" id="sub3"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
        <div class="hexagon hexagon1" style="height:60px" id="sub4"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
        <div class="hexagon hexagon1" style="height:60px" id="sub5"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
        <div class="hexagon hexagon1" style="height:60px" id="sub6"><div class="hexagon-in1"><div class="hexagon-in2"></div></div></div>
-->
    </center>
    </body>
</html>
