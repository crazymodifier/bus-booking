<?php
include './vendor/autoload.php';

class Loginwithgoogle extends CI_Controller{
	
	public function signup(){
		redirect($this->link());
		
	}
	
	public function profile(){
		if($this->session->userdata('login') == true)
		{
			$data['profileData'] = $this->session->userdata('userProfile');
			$this->load->view('profile',$data);
		}
		else
		{
			redirect('');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->googleplus->revokeToken();
		redirect('');
	}

	function link()
  {
    $client = new Google_Client();
    $client->setApplicationName('Hop On Hop Off Barcelona');
    $client->setClientId('1056945436597-6lat6bv0qh6cv119d8a8o9fltdsbti3v.apps.googleusercontent.com');
    $client->setClientSecret('3Iy7aNLV5QFxfcgWIN3EvBq5');

    $client->setRedirectUri(base_url().'Welcome/loginwithgoogle');
    $client->addScope('email');
    $client->addScope('profile');
    return $client->createAuthUrl();
  }
}//class ends here
