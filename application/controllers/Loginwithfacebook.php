<?php
include './vendor/autoload.php';

class Loginwithfacebook extends CI_Controller{
	
	public function signup(){
		
		redirect($this->link());
	}
	

	function link()
  {
    $facebook = new \Facebook\Facebook([
      'app_id'      => '1347591572110034',
      'app_secret'     => '73bbcc93792e38ce6624b844b7194f5a',
      'default_graph_version'  => 'v8.0'
    ]);
    $facebook_output = '';
    $facebook_helper = $facebook->getRedirectLoginHelper();
    $facebook_permissions = ['email']; // Optional permissions
    $facebook_login_url = $facebook_helper->getLoginUrl(base_url().'welcome/loginwithfacebook', $facebook_permissions);
    return $facebook_login_url;
  }
}//class ends here
