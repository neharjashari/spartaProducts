<?php
// FACEBOOK API
session_start();

require_once ('../php-graph-sdk-5.4/src/Facebook/autoload.php');

$fb = new Facebook\Facebook([
    'app_id' => '973380042843629',
    'app_secret' => 'f71563ddc29bbe8c22e8fb676224853b',
    'default_graph_version' => 'v2.10',
    ]);

$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
} 
catch(Facebook\Exceptions\FacebookResponseException $e) 
{
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} 
catch(Facebook\Exceptions\FacebookSDKException $e) 
{
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) 
{
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;

    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
}
// nese gjithcka ka shkuar ne rregull ktheje shfrytezuesin ne homepage
header("Location: ../home.php");
?>