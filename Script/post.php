
<?php
session_start();
include '../config/conn.php';
if(isset($_SESSION["user"]))
{
    if(isset($_REQUEST["post"]))
    {
        
$dt = date("Y-m-d H:i:s");

    if(isset($_FILES['postPic']))
    {
      $errors= array();
     for ($i = 0; $i < count($_FILES['postPic']['name']); $i++) 
     {
      $file_name = $_SESSION["UID"]."_".$_FILES['postPic']['name'][$i];
      $file_size = $_FILES['postPic']['size'][$i];
      $file_tmp = $_FILES['postPic']['tmp_name'][$i];
      $file_type = $_FILES['postPic']['type'][$i];
      $file_ext=strtolower(end(explode('.',$_FILES['postPic']['name'][$i])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"../PostImages/".$file_name);
        
         mysql_query("INSERT INTO `postimage` (`uid`,`postimg`) VALUES ('$_SESSION[UID]','$file_name')");
      }else{
          $file_name ="";
       //  print_r($errors);
      }
     }
   }

            $POST = mysql_escape_string($_REQUEST["post"]);
            $POSTTYPE = mysql_escape_string($_REQUEST["posttype"]);
            
            $your_url=mysql_escape_string($_REQUEST['ytlink']);
                                function get_youtube_id_from_url($url)
                                {
                                    if (stristr($url,'youtu.be/'))
                                        {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
                                    else 
                                        {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
                                }
            $ytlink = get_youtube_id_from_url($your_url);
            
                    
            if(mysql_query("INSERT INTO `posts`(`userid`, `post`, `dt`,`like`,`active`,`postimg`,`type`,`ytlink`) VALUES ('$_SESSION[UID]','$POST',CURRENT_TIMESTAMP,'0','1','$file_name','$POSTTYPE','$ytlink')"))
            {
                 $aq=  mysql_fetch_array(mysql_query("SELECT max(id) as `maxid` FROM `posts`"));
                 $mid=$aq['maxid'];
                 mysql_query("UPDATE `postimage` SET `postsid`=$mid WHERE `postsid`='0' and `uid`=$_SESSION[UID]");
                if(isset($_REQUEST["p"]))
                {header("Location: ../profile.php");}
                else 
                {header("Location: ../index.php");}
                
            }
            else
            {
                echo "Fails..";
            }

    }
    else if(isset($_REQUEST["bpost"]))
    {

    $dt = date("Y-m-d H:i:s");
    $hid=$_SESSION["hid"];
    $uid=$_SESSION["UID"];
    $POST = mysql_escape_string($_REQUEST["bpost"]);
          //  $POSTTYPE = mysql_escape_string($_REQUEST["posttype"]);
            
            if(mysql_query("INSERT INTO `posts`(`userid`, `post`, `dt`,`like`,`active`,`postimg`,`type`,`hid`) VALUES ('$_SESSION[UID]','$POST',CURRENT_TIMESTAMP,'0','1','','Business Deal','$hid')"))
            {
                header("Location: ../hub.php?hid=$hid");
            }
            else
            {
                echo "Fails..";
            }
    }
    
}
?>