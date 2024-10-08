<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include './vendor/autoload.php';
class Facebook 
{
  function data()
  {
    $facebook = new \Facebook\Facebook([
      'app_id'      => '1347591572110034',
      'app_secret'     => '73bbcc93792e38ce6624b844b7194f5a',
      'default_graph_version'  => 'v8.0'
    ]);
    $facebook_output = '';
    $facebook_helper = $facebook->getRedirectLoginHelper();
	// Call Facebook API
	if(isset($_GET['code']))
	{
	    unset($_SESSION['fb_access_token']);
		if(isset($_SESSION['fb_access_token']))
		{
		    $access_token = $_SESSION['fb_access_token'];
		}
		else
		{
			$access_token = $facebook_helper->getAccessToken();
			$_SESSION['fb_access_token'] = $access_token;
			$facebook->setDefaultAccessToken($_SESSION['fb_access_token']);
		    
		}
    
        $graph_response = $facebook->get("/me?fields=name,email", $access_token);

		$data = $graph_response->getGraphUser();
		return $data;
    }
    else {
      redirect();
    }
  }

}
  
