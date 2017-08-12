<?php
session_start();
if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
{
    include '../config/conn.php';
    $fromId= $_REQUEST["from"];
    $row = mysql_query("select * from `msg` where `from`='$fromId' and `to`='$_SESSION[UID]' or `from`='$_SESSION[UID]' and `to`='$fromId'");
    
    mysql_query("update `msg` set `status`='read' where `from`='$fromId' and `to`='$_SESSION[UID]'");
    
    $rows_uname=mysql_query("select * from `login` where id=$fromId");
    $userdata = mysql_fetch_array($rows_uname);
    
    
     
         ?>
            <div class="panel panel-default">
                <div class='panel-heading'><a href="user.php?user=<?php echo $userdata['id']; ?>"><?php echo $userdata['name']; ?></a> <span class="pull-right"><small onclick="$('#Firends').show();$('#inbox').hide();">Show Friend's Chat</small></span></div>
                  </div>
                  
              <div class="panel-body" style="height:270px;overflow-y: scroll">
            
            <?php
    
    while($arry= mysql_fetch_array($row))
    {
        if($arry['to']==$_SESSION["UID"])
        {
            
            ?>    


                <me class='pull-left' style='margin-top: 5px;padding: 3px;border-radius:2px;width: 100%;padding:6px 7px 8px 9px'>
                      
                      <msg class="pull-left"  style="word-break: break-all">
                          <a class="pull-left">
                              <small style="font-size: 10px"><?php  $date = date_create($arry['dt']); echo date_format($date, 'H:i a'); ?></small>
                          </a>
                          <br/>
                          <?php echo $arry['message']; ?>
                      </msg>

                  </me><br/>
            <?php
            
        }
        else
        {
            ?>
                  <you class='pull-right' style='margin-top: 5px;padding: 3px;border-radius:2px;width: 100%;padding:6px 7px 8px 9px'>
                      
                      <msg class="pull-right" style="word-break: break-all">
                          <a class="pull-right">
                              <small style="font-size: 10px"><?php  $date = date_create($arry['dt']); echo date_format($date, 'H:i a'); ?></small>
                          </a>
                          <br/>
                          <?php echo $arry['message']; ?>
                      </msg>

                  </you><br/>
            
            <?php
        }
        
        
       
    }
    ?>
                    </div>
              <br/>
              
              <div class="panel-footer" >
                  Send Message.
                  <textarea class="form-control" id="txtChat"></textarea>
                  <button class='btn btn-success' id='sendMsg'>Send</button>
                  <script>
                      $("#sendMsg").click(function()
                      {
                          var msg1 = $("#txtChat").val();
                          $.post("Script/send.php",{to:"<?php echo $_REQUEST["from"]; ?>",msg:msg1},function(data)
                          {
                               location.reload();
                          });
                      });
                  </script>
              </div>
              <br/>
                  
                  <?php
    
    
}
else
{
  echo "Oops.. Message Not Found..!";
}
  
?>