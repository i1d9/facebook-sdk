<?php

/*

I installed Facebook PHP SDK using this command:
    composer require facebook/graph-sdk

Reference link: https://github.com/facebookarchive/php-graph-sdk

*/
require_once __DIR__ . '/vendor/autoload.php';

/*
The app secret and App ID can be found at the URL below:
https://developers.facebook.com/apps/appID/settings/basic/
*/
$appSecret = "";
$appId = "";

/*
The user access token can be found at the URL below:
https://developers.facebook.com/tools/explorer/

Live Credentials may be different
*/
$userAccessToken = "";

/*
The page ID can be found at the URL below:

https://web.facebook.com/{PAGE_NAME}-{PAGE_ID}/?ref=pages_you_manage

*/
$pageId = "";


$fb = new Facebook\Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.5'
]);


$longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);

$fb->setDefaultAccessToken($longLivedToken);

$response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])->getDecodedBody();

$foreverPageAccessToken = $response['access_token'];

$fb->setDefaultAccessToken($foreverPageAccessToken);






function makePost($data,$accessToken){


    /*
    $data = [

        'link' => 'www.example.com',
        'message' => 'User provided message',

    ];

    Link should only be used when sharing links

    Link field is optional.

    */
    $fb = $GLOBALS['fb'];
      try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/me/feed', $data, $accessToken);
        echo "Success";
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
}





  

function makeImagePost($data,$accessToken){


    /*
    $data = [
        'message' => 'Testing Image Upload',
        'source' => $fb->fileToUpload('https://firebasestorage.googleapis.com/v0/b/naylan-hyp.appspot.com/o/Products%2FAdidas%20Yeezy%20Boost%20350%20V2%20Natural.png?alt=media&token=8bc43ab3-a62c-4e31-a969-fdff1ce007b6'),
    ];

    The fileToUpload function in the source field MUST be a valid URL. e.g "https://yourdomain.com/yourdirectory/imagenamewithextension" 

    */

    
    $fb = $GLOBALS['fb'];


      
      try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/me/photos', $data, $accessToken);
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }


}


function makeVideoPost($pathToVideo,$data,$accessToken){


    $fb = $GLOBALS['fb'];
    /*

    $data = [
        'title' => 'Video Title',
        'description' => 'Video Description',
      ];


    */
      
      try {
        $response = $fb->uploadVideo('me', $pathToVideo, $data, $accessToken);
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
      
}


/*

//Tested Image Upload using the following values

$data = [
    'message' => 'Testing Image Upload',
    'source' => $fb->fileToUpload('http://localhost/uploads/1.png'),
];
makeImagePost($data,$foreverPageAccessToken);
*/



/*

Tested Normal using the following values

$data = [
    'link' => 'https://github.com/0yah',
    'message' => 'User provided message',
];
makePost($data,$foreverPageAccessToken);

*/


?>