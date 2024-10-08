<?php  

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Logics extends CI_Model
	{
		function aboutContent()
		{
			return $this->db->get('about')->row();
		}

		function whyUs()
		{
			return $this->db->get('why_us')->result();
		}

		function output_md5($data, $table, $column)
		{
			$result = $this->db->select($column)->get($table)->result();

			foreach ($result as $val) 
			{
				if (md5($val->$column) == $data) 
				{
					return $val->$column;
				}
			}
		}
	
		function tourPackage($tour_id)
		{
			$count = 1;
			$varications = [];
			$variation_id = $this->db->distinct()->select('variation_id')->where('tourist_type' , 'ADULT')->where('tour_id', $tour_id)->order_by('final_price ASC')->get('hop_package')->result();
			
			foreach ($variation_id as $value) 
			{
				$today =date('y-m-d');
				$varication = $this->db->where('variation_id', $value->variation_id)->where('tour_id', $tour_id)->where('date_to >= ', $today)->where('date_from <= ', $today)->order_by('date_to DESC , tourist_type ASC')->get('hop_package')->result();
				array_push($varications, $varication);
			}
			return $varications;
		}

		function variations($id = 32)
		{
			$variation_id = $this->db->distinct()->select('variation_id')->where('tourist_type' , 'ADULT')->where('tour_id', $id)->order_by('final_price ASC')->get('hop_package')->result();

			return $variation_id;
		}

		function calendarVariation()
		{
			$today = date('Y-m-d');
			$variation = $this->db->distinct()->select('calendar_variation')->where('tour_id', 32)->where('date_to >= ', $today)->get('hop_package')->result();
			return $variation;
		}

		function tourPrice($variation_id='',$tourist_type='')
		{
			$today = date('y-m-d');
			$varication = $this->db
				->where('variation_id', $variation_id)
				->where('tour_id', 32)
				->where('age!=', '')
				->where('tourist_type', $tourist_type)
				->where('date_to >= ', $today)
				->where('date_from <= ', $today)
				->order_by('tourist_type ASC')
				->get('hop_package')->row();
			return $varication;
		}
		function addAbout($data)
		{
			if ($this->db->get('about')->num_rows()) 
			{
				return $this->db->update('about', $data);
			}
			else 
			{
				return $this->db->insert('about',$data);
			}
		}

		function get_about()
		{
			return $this->db->get('about')->row();
		}

		function set_whyus($data='')
		{
			if ($this->db->get('whyus')->num_rows()) 
			{
				return $this->db->update('whyus', $data);
			}
			else 
			{
				return $this->db->insert('whyus',$data);
			}
		}

		function get_whyus()
		{
			return $this->db->get('whyus')->row();
		}

		function set_tour($data='')
		{
			if ($this->db->get('tour')->num_rows()) 
			{
				return $this->db->update('tour', $data);
			}
			else 
			{
				return $this->db->insert('tour',$data);
			}
		}

		function testimonial($id='',$status='')
		{
			if ($id) 
			{
				$this->db->get('testimonial')->row();
			}
			elseif ($status) 
			{
				return $this->db->where('status', $status)->get('testimonial')->result();
			}
			else {
				return $this->db->get('testimonial')->result();
			}
		}

		function registration($data)
		{
			$data['date_add'] = date('Y-m-d');
			$admin = $this->db->get('admin')->row();
			if ($this->db->where('email', $data['email'])->get('customer')->num_rows()) 
			{
				$this->session->set_flashdata('alert', 'You are already registered, Please check your email and verify now');
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
			 //   $this->db->insert('customer', $data)
				if ($this->db->insert('customer', ['email' => $data['email'] , 'name' => $data['name'] , 'password' => md5($data['password']), 'date_add' => date('Y-m-d')])) 
				{
				    
					$this->load->library('email');
					$config['mailtype'] = 'html';
				    $this->email->initialize($config);
					$this->email->from($admin->email, $admin->webname);
					$this->email->to($data['email']);
					$this->email->subject('Email Verification');
					$message = 
						'Dear '.$data['name'].',<br><br>
						You have successfully registered and thanks for joining as a member in our website. <br><br>
						To successfully complete your Registration, You need to verify your Email address: '.$data['email'].'. So, Please click or copy below link in the browser address bar. <br><br>
						<b>Verification Link:</b> <a href="'.base_url('registration?id=').md5($data['email']).'&pass='.md5($data['password']).'&data='.md5(uniqid()).'&action=verify-email'.'">'.base_url('registration?id=').md5($data['email']).'&pass='.md5($data['password']).'&data='.md5(uniqid()).'&action=verify-email'.'</a> <br><br>
						Please note - after Email verification your Customer Account will be created. Email us at: support@hop-on-hop-off-bus-tours.com If you are facing any issue regarding verification. <br>
						Thanks for Choosing Hop On Hop Bus Tours and we hope to see you soon. <br><br><br>
						Best regards, <br>
						Hop On Hop Barcelona <br>'.base_url();	
					$this->email->message($message);
					if ($this->email->send()) {
					    
						redirect('registration?id='.md5($data['email']));
					}
					else
					{
					    $this->session->set_flashdata('alert', 'Something went wrong');
					    redirect();
					}
				}
			}
		}

		function booking_email($email='')
		{
			$admin = $this->db->get('admin')->row();
			$user = $this->db->where('session_id', $email)->get('purchased_customers')->row();
			$bookings = $this->db->where('session_id', $email)->get('bookings')->result();
			$payment = $this->db->where('order_status', 'Success')->where('session_id', $email)->get('payments')->row();
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($admin->email, $admin->webname);
			$this->email->to($user->billing_email);
				$this->email->bcc($admin->email);
			$this->email->subject('New booking for Hop On Off Barcelona | Entry Ticket');
			$message ='
			    <table style="width:600px;text-align:left">
			        <tr>
                      <td colspan="2" style="text-align:center"><img src="'.base_url().'dist/img/logo.png" height="70"></td>
                    </tr>
                    <tr>
                      <th colspan="2"><h4>Dear '.$user->billing_name.',</h4></th>
                    </tr>
                    <tr>
                      <td>Thank you for Booking with us. Here the details of your booking.</td>
                      <td style="text-aligh:right"><a href="'.base_url('order_successful?id=').$payment->session_id.'" style="padding:10px 20px; color:white; background-color:red:">Voucher</a></td>
                    </tr>
                </table>
			';
			
			$message .= '
    			<table border="1" style="border:1px solid #ccc; border-collapse:collapse;width:600px;text-align:left">
                <tr>
                  <th width="40%" style="padding:10px">Reference Number:</th>
                  <td width="60%" style="padding:10px">'.$payment->order_id.'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Customer Name</th>
                  <td style="padding:10px">'.$user->billing_name.'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Customer Phone:</th>
                  <td style="padding:10px">'.$user->billing_tel.'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Customer Email:</th>
                  <td style="padding:10px">'.$user->billing_email.'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Customer Address:</th>
                  <td style="padding:10px">'.(!empty($user->billing_address) ? $user->billing_address.', ' : ''). (!empty($user->billing_city) ? $user->billing_city.', ' : '').(!empty($user->billing_state) ? $user->billing_state.', ' : '').(!empty($user->billing_zip) ? $user->billing_zip.', ' : '').(!empty($user->billing_country) ? $user->billing_country: '').'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Payment Method</th>
                  <td style="padding:10px">'.$payment->payment_mode.'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Payment Status</th>
                  <td style="padding:10px">'.$payment->order_status.'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Transaction ID</th>
                  <td style="padding:10px">'.$payment->tracking_id.'</td>
                </tr>
                <tr>
                  <th style="padding:10px">Payment Date</th>
                  <td style="padding:10px">'.$payment->trans_date.'</td>
                </tr>
                <tr>
                  <th style="padding:10px"></th><td style="padding:10px">';
            
            foreach($bookings as $tour)
            {
                $message .= 'Package Type: <b>'.$tour->name.'</b><br>';
                $total = 0;
                $tourist = ['adult', 'child' , 'family', 'infant', 'senior', 'youth'];
                foreach ($tourist as $value) 
                {
                  $total += $tour->$value;
                }
                // $message .= $total.' Passengers <br> (';
                foreach ($tourist as $value) {
                  if ($tour->$value) 
                  {
                    if ($tour->$value > 1) 
                    {
                      if ($value == 'child') 
                      {
                        $key = 'children';
                      }
                      elseif ($value == 'family') 
                      {
                        $key = 'families';
                      }
                      else 
                      {
                        $key = $value.'s';
                      }
                      $message .= ucfirst($key).': <b>'. $tour->$value.'</b><br>';
                    }
                    else 
                    {
                      $message .= ucfirst($value).': <b>'. $tour->$value.'</b><br>';
                    }
                  }
                }
            }        
                  
            $message .='</td>   
                </tr>
                <tr>
                  <th style="padding:10px">Total Amount Paid ('.$payment->currency.'):</th>
                  <td style="padding:10px">'.$payment->amount.'</td>
                </tr>
              </table>
              <br><br><br>
						Best regards, <br>
						Hop On Hop Barcelona <br>'.base_url();	
		    $this->email->message($message);
		   $this->email->send();
		}
	}

?>