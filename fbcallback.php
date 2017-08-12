<?php
	session_start();
        include './FBsrc/Facebook/autoload.php';
        
        $fb = new Facebook\Facebook([
            'app_id' => '541930349301504',
            'app_secret' => 'eb43d69dfe71f19a7f0df711498854be',
            'default_graph_version' => 'v2.5',
          ]);


	

$helper = $fb->getRedirectLoginHelper();


try 
{
  $accessToken = $helper->getAccessToken();
  echo $accessToken;
  
  $_SESSION["test"]= (string) $accessToken;
  header("Location: index.php");
} catch(Facebook\Exceptions\FacebookResponseException $e) 
{
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
?>