<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php


	session_start();
        include './src/Facebook/autoload.php';
        
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
              echo "<img src='".$user["picture"]["url"]."'/><br/>";
              echo $user["name"]."<br/>";
              echo $user["email"]."<br/>";
}
else
{
      $loginUrl = $helper->getLoginUrl('fbcallback.php', $permissions);
    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}


?><br/>
<a href="logout.php">Logout</a>


    </body>
</html>
