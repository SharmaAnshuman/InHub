    <!DOCTYPE HTML>
    <html>
    <head>
    <title>An example to draw an polygon</title>
    <script type="text/javascript">
        function drawPolygon() {
            var canvas = document.getElementById('canvasbox');
            if (canvas.getContext) {
                var objctx = canvas.getContext('2d');
               objctx.beginPath();
            objctx.moveTo(75, 50);
            objctx.lineTo(175, 50);
            objctx.lineTo(200, 75);
            objctx.lineTo(175, 100);
            objctx.lineTo(75, 100);
            objctx.lineTo(50, 75);
            
            objctx.closePath(); 
            objctx.fillStyle = "rgb(200,0,0)";
            objctx.fill();
            } else {
                alert('You need HTML5 compatible browser to see this demo.');
            }
        }
    </script>
    </head>
    <body onload="drawPolygon();">
       <canvas id="canvasbox"></canvas>
    </body>
    </html>