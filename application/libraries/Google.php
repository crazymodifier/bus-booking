<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include './vendor/autoload.php';
class Google 
{
  function data()
  {
    

    $client = new Google_Client();
    $client->setApplicationName('Hop On Off Hop Barcelona');
    $client->setClientId('1056945436597-6lat6bv0qh6cv119d8a8o9fltdsbti3v.apps.googleusercontent.com');
    $client->setClientSecret('3Iy7aNLV5QFxfcgWIN3EvBq5');

    $client->setRedirectUri(base_url().'Welcome/loginwithgoogle');
    $client->addScope('email');
    $client->addScope('profile');
    
    if (isset($_GET['code'])) 
    {
      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      $client->setAccessToken($token['access_token']);

      $_SESSION['access_token'] = $token['access_token'];

      $service = new Google_Service_Oauth2($client);
      $data = $service->userinfo->get();
      return $data;
    }
    else {
      redirect();
    }
  }

}
  
