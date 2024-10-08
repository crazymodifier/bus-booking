<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//   include './vendor/autoload.php';
class Welcome extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		if (!isset($this->session->currency)) 
		{
			$this->updateCurrency();
		}
		if(!isset($this->session->session_data))
		{
			$this->session->set_userdata('session_data', rand(1000000000, 9999999999));
		}
	}
	public function index($slug = 'home')
	{
		$pages = array('home', 'abrar','checkout','registration','order_successful','contact','about','terms-and-conditions','privacy-policy','review-policy','terms-of-use','account');
		if (in_array($slug, $pages)) 
		{
			
			if($slug == 'order_successful')
			{
			    $data = array(
    				'about'     => $this->logics->get_about(),
    				'tour'			=> $this->db->get('tour')->row(),
    				'variations' => $this->tours->variations(),
    				'packages'  => $this->logics->tourPackage(32),
    				'admindata'     => $this->db->get('admin')->row(),
    			);
    			$this->load->view('includes/header',$data);
    			$this->load->view('pages/'.$slug,$data);
    			$this->load->view('includes/footer',$data);
			}
			else
			{
			    $data = array(
    				'about'     => $this->logics->get_about(),
    				'tour'			=> $this->db->get('tour')->row(),
    				'variations' => $this->tours->variations(),
    				'packages'  => $this->logics->tourPackage(32),
    				'admindata'     => $this->db->get('admin')->row(),
    			);
    			$this->load->view('includes/header',$data);
    			$this->load->view('includes/navbar',$data);
    			$this->load->view('pages/'.$slug,$data);
    			$this->load->view('includes/widgets',$data);
    			$this->load->view('includes/footer',$data);
			}
		}
		else 
		{
		    show_404();
		}
	}

	function variation_row_id()
	{
		$var = $this->input->post('variation');
		$data = $this->tours->hop_packages('','',$var,'',32);
		$output = '';
		foreach ($data as $price) 
		{
			
			$output .= '<div class="input-row">';
			$output .= '<h6 class="">'.ucfirst(strtolower($price->tourist_type)).' ('.$price->age.' yrs)</h6>';
			$output .= '<div class="input">
                      <button type="button" class="minus incrmt btn btn-outline-danger" aria-label="Decrease by one" disabled>
                        <i class="fa fa-minus" style="font-size:.5em"></i>
                      </button>
                      <div class="number dim">0</div>';
			$output .= '<input type="hidden" value="0" id="'.strtolower($price->tourist_type).'" name="traveller['.strtolower($price->tourist_type).']" class="numberInput">';
			$output .= '<button type="button" class="plus incrmt btn btn-danger" aria-label="Increase by one">
                        <i class="fa fa-plus" style="font-size:.5em"></i>
                      </button>
                    </div>
                  </div>';

			$output .= form_hidden('row['.strtolower($price->tourist_type).']', $price->id);
                    
                      
                      
		}

		$output .= '<script>
			var buttons = document.querySelectorAll(".incrmt");
			var minValue = 0;
			var maxValue = 10;

			buttons.forEach((button) => {
				button.addEventListener("click", (event) => {
					// 1. Get the clicked element
					const element = event.currentTarget;
					// 2. Get the parent
					const parent = element.parentNode;
					// 3. Get the number (within the parent)
					const numberContainer = parent.querySelector(".number");
					const numberContainerInput = parent.querySelector(".numberInput");
					const number = parseFloat(numberContainer.textContent);
					// 4. Get the minus and plus buttons
					const increment = parent.querySelector(".plus");
					const decrement = parent.querySelector(".minus");
					// 5. Change the number based on click (either plus or minus)
					const newNumber = element.classList.contains("plus")
						? number + 1
						: number - 1;
					numberContainer.textContent = newNumber;
					numberContainerInput.value = newNumber;
					// 6. Disable and enable buttons based on number value (and undim number)
					if (newNumber === minValue) {
						decrement.disabled = true;
						numberContainer.classList.add("dim");
						// Make sure the button won\'t get stuck in active state (Safari)
						element.blur();
					} else if (newNumber > minValue && newNumber < maxValue) {
						decrement.disabled = false;
						increment.disabled = false;
						numberContainer.classList.remove("dim");
					} else if (newNumber === maxValue) {
						increment.disabled = true;
						numberContainer.textContent = `${newNumber}+`;
						element.blur();
					}
				});
			});

			</script>';

		echo $output;
	}

	function set_sessions($guest='')
	{
		if($guest)
		{
		    $this->session->set_userdata('guest', 'Guest');
		    redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
		    $this->session->set_userdata($_POST['name'], $_POST['value']);
		    echo'ok';
		}
	}

	function logout()
	{
	    session_destroy();
		redirect();
	}


	function login()
	{
	    $data = $this->input->post();
		$user = $this->db->where('status', 1)->where('email', $data['email'])->where('password', md5($data['password']))->get('customer')->row();
		if ($user) 
		{
			$this->session->set_userdata($data);
			$this->session->set_userdata('id', $user->id);
			$this->session->set_userdata('login', true);
			redirect($_SERVER['HTTP_REFERER']);
		}
		else {
			$this->session->set_flashdata('alert', ' Invalid Credentials');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function updateCurrency()
	{
		
        
        if(isset($_POST['currency']))
        {
            $this->session->set_userdata('currency', $this->input->post('currency'));
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $user_ip = getenv('REMOTE_ADDR');
            $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
            $geo["geoplugin_currencyCode"];
            if(!empty($geo["geoplugin_currencyCode"]))
            {
                if($geo["geoplugin_currencyCode"]=="USD" || $geo["geoplugin_currencyCode"]=="INR" || $geo["geoplugin_currencyCode"]=="AUD" || $geo["geoplugin_currencyCode"]=="SGD" || $geo["geoplugin_currencyCode"]=="HKD" || $geo["geoplugin_currencyCode"]=="EUR" || $geo["geoplugin_currencyCode"]=="GBP")
                {
                    $_SESSION['curreny_type'] =$geo["geoplugin_currencyCode"];
                    $ctype1="background:#d90303; color: white;";
                    if($geo["geoplugin_currencyCode"]=="USD")
                    {
                        $currency_session=0;
                    }
                    elseif($geo["geoplugin_currencyCode"]=="GBP")
                    {
                        $currency_session=1;
                    }
                    elseif($geo["geoplugin_currencyCode"]=="AUD")
                    {
                        $currency_session=3;
                    }
                    elseif($geo["geoplugin_currencyCode"]=="SGD")
                    {
                        $currency_session=5;
                    }
                    elseif($geo["geoplugin_currencyCode"]=="HKD")
                    {
                        $currency_session=6;
                    }
                    elseif($geo["geoplugin_currencyCode"]=="INR")
                    {
                        $currency_session=8;
                    }
                    elseif($geo["geoplugin_currencyCode"]=="EUR")
                    {
                        $currency_session=2;
                    }
                    elseif($geo["geoplugin_currencyCode"]=="CAD")
                    {
                        $currency_session=4;
                    }
                    $this->session->set_userdata('currency', $currency_session);
                }
            }
        }
		
	}

	function subscribe()
	{
		if(isset($_POST['email']) && !empty($_POST['email']))
		{
			if ($this->db->where('email', $this->input->post('email'))->get('subscribers')->num_rows()) {
				$this->session->set_flashdata('alert', 'You are already subscribed');
				redirect();
			}
			else {
				$this->db->insert('subscribers', $this->input->post());
				$this->session->set_flashdata('alert', 'Thank you for our subcription');
				redirect();
			}
		}
	}
	
	function testimonial()
	{
		if(isset($_POST['test_email']))
		{
			$this->db->insert('testimonial', $this->input->post());
			$this->session->set_flashdata('alert', 'Thanks! for your most valuable review.');
			redirect();
		}
		else {
			redirect();
		}
	}

	function registration()
	{
		if (isset($_POST['email'])) 
		{
		    if($this->input->post('password') == $this->input->post('repassword'))
		    {
		        $this->logics->registration($this->input->post());
		    }
			else 
			{
			    $this->session->set_flashdata('alert', 'Please enter the correct password');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
		    redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function loginwithfacebook()
	{
	  
	    $data = $this->facebook->data();
			$inputs = array(
				'email' => !empty($data['email'])?$data['email']:'',
				'name'	=> $data['name'],
				'password' => $data['id'],
				// 'id'    => $data['id']
			);
			$user = $this->db->where('password', md5($inputs['password']))->get('customer')->row();
			if ($user) 
			{
			    $this->session->set_userdata($inputs);
			    $this->session->set_userdata('id', $user->id);
			    $this->session->set_userdata('login', true);
			    if($this->session->currentPage)
			    {
			        redirect($this->session->currentPage);
			    }else
			    {
			        redirect();
			    }
			}
		else 
		{
		    $this->db->insert('customer', ['email' => $inputs['email'] , 'password' => md5($inputs['password']), 'name' => $inputs['name'], 'date_add' => date('Y-m-d'), 'status' => 1]);
		    $this->session->set_userdata($inputs);
			$this->session->set_userdata('id', $this->db->insert_id());
			$this->session->set_userdata('login', true);
			if($this->session->currentPage)
			{
			    redirect($this->session->currentPage);
			}else
			{
			    redirect();
			}
		}
	}

	function loginwithgoogle()
	{
		$data = $this->google->data();
			$inputs = array(
				'email' => !empty($data['email'])?$data['email']:'',
				'name'	=> $data['name'],
				'password' => $data['id'],
				// 'id'    => $data['id']
			);
			$user = $this->db->where('password', md5($inputs['password']))->get('customer')->row();
		if ($user) 
		{
			$this->session->set_userdata($inputs);
			$this->session->set_userdata('id', $user->id);
			$this->session->set_userdata('login', true);
			if($this->session->currentPage)
			{
			    redirect($this->session->currentPage);
			}else
			{
			    redirect();
			}
			
		}
		else 
		{
		    $this->db->insert('customer', ['email' => $inputs['email'] , 'password' => md5($inputs['password']), 'name' => $inputs['name'], 'date_add' => date('Y-m-d'), 'status' => 1]);
		    $this->session->set_userdata($inputs);
			$this->session->set_userdata('id', $this->db->insert_id());
			$this->session->set_userdata('login', true);
			if($this->session->currentPage)
			{
			    redirect($this->session->currentPage);
			}else
			{
			    redirect();
			}
		}
	}
	
	function con_guest()
	{
	    $this->session->set_userdata('guest','Guest');
	    redirect($_SERVER['HTTP_REFERER']);;
	}
	
	function sendquery()
	{
	    $admin = $this->db->get('admin')->row();
	    $data = $this->input->post();
	    $this->load->library('email');
					$config['mailtype'] = 'html';
				    $this->email->initialize($config);
					$this->email->from($admin->email, $admin->webname);
					$this->email->to($data['email']);
					$this->email->bcc($admin->email);
					$this->email->subject('Query');
					$message = 
						'Dear '.$data['name'].',<br><br>
						<b>Subject: </b>'.$data['subject'].'<br>
						<b>Message: </b>'.$data['message'].'
						<br><br><br>
						Best regards, <br>
						Hop On Hop Barcelona <br>'.base_url();	
					$this->email->message($message);
					if ($this->email->send()) {
					    
						$this->session->set_flashdata('alert', 'Thank you for contacting with us. We will revert to you soon');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else
					{
					    $this->session->set_flashdata('alert', 'Something went wrong');
					    redirect();
					}
	}
}
