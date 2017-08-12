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
$loginUrl = $helper->getLoginUrl('http://localhost/', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

?><br/>
<a href="logout.php">Logout</a>

    </body>
</html>
