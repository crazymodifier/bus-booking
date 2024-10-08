<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    // print_r($this->session->cart_contents);
  }

  function addToCart()
  {
    $data = $this->input->post();
    if($data['traveller']['adult']  or $data['traveller']['senior'] )
    {
        
        $day = strtolower(date('D', strtotime($data['traveling-date'])));
        $blocked = $this->db->where('variation_id', $data['package'])->get('package_variation')->row();
    
        $blocked_date = $this->tours->blocked_dates($this->input->post('package'));
        $data['traveling_date'] = date('d-m-Y', strtotime($data['traveling-date']));
        
        if (in_array($data['traveling_date'], $blocked_date)) {
          $this->session->set_flashdata('alert', 'Tour is not running on selected date. Kindly choose another date');
          redirect();
        }
        elseif(!$blocked->$day)
        {
          $this->session->set_flashdata('alert', 'Tour is not running on selected date. Kindly choose another date');
          redirect();
        }
        else 
        {
          $variation = $this->db->where('variation_id', $this->input->post('package'))->get('hop_package')->row();
          $cart = array(
            'id'      => uniqid(),
            'qty'     => 1,
            'price'   => $this->calculatPrice($data['traveller'], $data['package']),
            'name'    => $variation->variation,
            'currency'=>  $variation->currency
          );
          $val = array_merge($data , $cart);
          $this->cart->insert($val);
    
          // $this->db->insert('cart_backup',)
          $cartData['session_id'] = $this->session->session_data;
          $cartData['travelling_date'] = date('Y-m-d', strtotime($data['traveling_date']));
          $cartData['price'] = $cart['price'];
          $cartData['name'] =$cart['name'];
          $cartData['package'] = $data['package'];
          $cartData['subtotal'] =$this->cart->total();
          $cartData['checkout_date'] =date('Y-m-d');
          $cartData['row_id'] = $cart['id'];
          $cartData['currency'] = $cart['currency'];
    
          foreach ($data['traveller'] as $key => $value) {
            $cartData[$key] = $value;
          }
          
        //   echo'<pre>';
        //   print_r($cartData);exit;
          $this->db->insert('cart_backup', $cartData);
          redirect('checkout');
        }
    }
    else
    {
        $this->session->set_flashdata('alert', 'please select aleast one adult or senior');
        redirect();
    }
  }

  function updateCart($rowid = '')
	{
    $data = $this->input->post();
    $day = strtolower(date('D', strtotime($data['traveling-date'])));
    $blocked = $this->db->where('variation_id', $data['package'])->get('package_variation')->row();

    $blocked_date = $this->tours->blocked_dates($this->input->post('package'));
    $data['traveling_date'] = date('d-m-Y', strtotime($data['traveling-date']));

    if (in_array($data['traveling_date'], $blocked_date)) {
      $this->session->set_flashdata('alert', 'We are not working on this date');
      redirect('checkout');
    }
    elseif(!$blocked->$day)
    {
      $this->session->set_flashdata('alert', 'We are not working on this day');
      redirect('checkout');
    }
    else 
    {
      $variation = $this->db->where('variation_id', $this->input->post('package'))->get('hop_package')->row();
      $cart = array(
        'rowid'      => $rowid,
        'qty'     => 1,
        'price'   => $this->calculatPrice($data['traveller'], $data['package']),
        'name'    => $variation->variation,
        'currency'=>  $variation->currency
      );
      $val = array_merge($data , $cart);
      $this->cart->update($val);

      // $this->db->insert('cart_backup',)
      $cartData['session_id'] = $this->session->session_data;
      $cartData['travelling_date'] =date('Y-m-d',$data['traveling_date']);
      $cartData['price'] = $cart['price'];
      $cartData['name'] =$cart['name'];
      $cartData['package'] = $data['package'];
      $cartData['subtotal'] =$this->cart->total();
      $cartData['checkout_date'] =date('Y-m-d');
      $cartData['row_id'] = $cart['rowid'];
      $cartData['currency'] = $cart['currency'];

      foreach ($data['traveller'] as $key => $value) {
        $cartData[$key] = $value;
      }
      $this->db->insert('cart_backup', $cartData);
      redirect('checkout');

	}
}
	function destroyCart()
	{
		$this->cart->destroy();
		redirect('home');
  }
  
  function removeitem($rowid)
	{
    
    $this->db->where('row_id',$this->cart->get_item($rowid)['id'])->delete('cart_backup');
    $this->cart->remove($rowid);
    
		redirect($_SERVER['HTTP_REFERER']);
  }
  
  function calculatPrice($data,$variation)
  {
    $price = array();
    foreach ($data as $key => $value) {
      $package = $this->tours->hop_packages('',strtoupper($key),$variation);
      array_push($price, $package->final_price * $value);
    }
    return array_sum($price);
    
  }

  function checkout()
  {
    $data = $this->input->post();

    if (isset($_POST['ccavenue'])) 
    {
      
      $paymentData = array(
        'merchant_id' => '21231',
        'order_id' => '2131231',
        'amount' => '1231231',
        'currency' => 'INR',
        'redirect_url' => base_url('Checkout/response'),
        'cancel_url' => base_url('Checkout/cancel'),
        'language' =>'en',
        'billing_name' =>$this->input->post('name'),
        'billing_address' =>$this->input->post('billing')['address'],
        'billing_city' =>$this->input->post('billing')['city'],
        'billing_state' =>$this->input->post('billing')['state'],
        'billing_zip' =>$this->input->post('billing')['pin'],
        'billing_country' =>$this->input->post('billing')['country'],
        'billing_tel' =>$this->input->post('mobile'),
        'billing_email' =>$this->input->post('email'),
      );
      $billingDetails = array('billingDetails' => $paymentData, );
      $this->session->set_userdata($billingDetails);
      redirect('payment');
    }
    elseif (isset($_POST['paypal'])) 
    {
      $this->load->view('pages/ccavenue');
    }
  }

  function add_to_address()
  {
    if (isset($_POST['billing_email'])) 
    {
      $data = $this->input->post();
      $data['session_id'] = $this->session->session_data;
    //   $this->db->insert('backup_customers', $data);
    //   $this->session->set_userdata('customer_id', $this->db->insert_id());
      redirect('checkout?step=payment');
    //   $this->payment();
    //   $data['title'] = 'Checkout';
    //   $this->load->view('includes/header',$data);
    //   $this->load->view('includes/navbar',$data);
    //   $this->load->view('pages/checkout',$data);
    //   $this->load->view('includes/widgets',$data);
    //   $this->load->view('includes/footer',$data);
    }
    else 
    {
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  function payment($status='')
  {
    if($status == 'success')
    {
        foreach ($this->cart->contents() as $tour) {
          $data = array(
            'package'         => $tour['package'],
            'travelling_date' => date('Y-m-d',strtotime($tour['traveling_date'])),
            'price'           => $tour['price'] ,
            'subtotal'        => $tour['subtotal'],
            'name'            => $tour['name'],
            'customer_id'     => $this->session->customer_id,
            'session_id'      => $this->session->session_data,
            'checkout_date'   => date('Y-m-d'),
            'currency'        => $this->session->currency
          );  
          foreach ($tour['traveller'] as $key => $value) {
            $data[$key] = $value;
          }
          $this->db->insert('bookings', $data);
        }
    
        // $customer = $this->db->where('id', $this->session->customer_id)->get('backup_customers')->row_array();
        // unset($customer['agreement']);
        // $customer['customer_id'] = $customer->id;
        // $this->db->insert('purchased_customers', $customer);
        foreach ($this->cart->contents() as $key => $value) 
        {
          $this->db->where('row_id',$this->cart->get_item($key)['id'])->delete('cart_backup');
          $this->cart->remove($key);
        }
        
        $data = array(
            'order_id' => $this->input->get('order_id'),
            'tracking_id' => $this->input->get('tracking_id'),
            'order_status' => $this->input->get('order_status'),
            'payment_mode' => $this->input->get('payment_mode'),
            'currency' => $this->input->get('currency'),
            'amount' => $this->input->get('amount'),
            'offer_code' => $this->input->get('offer_code'),
            'trans_date' => date('Y-m-d'),
            'customer_id' => $this->session->customer_id,
            'session_id' => $this->session->session_data,
            );
        if($this->db->insert('payments', $data))
        {
            $last_id = $this->db->insert_id();
            $this->db->where('id',$last_id)->update('payments',['order_id' => 'HOHOBCN-'.$last_id]);
        }
        $this->session->set_userdata('coupon', false);
        $this->logics->booking_email($this->session->session_data);
        redirect('order_successful?id='.$this->session->session_data);
    }
    else
    {
        $data = array(
            'order_id' => $this->input->get('order_id'),
            'tracking_id' => $this->input->get('tracking_id'),
            'order_status' => $this->input->get('order_status'),
            'payment_mode' => $this->input->get('payment_mode'),
            'currency' => $this->input->get('currency'),
            'amount' => $this->input->get('amount'),
            'offer_code' => $this->input->get('offer_code'),
            'trans_date' => date('Y-m-d'),
            'customer_id' => $this->session->customer_id,
            'session_id' => $this->session->session_data,
            );
        if($this->db->insert('payments', $data))
        {
            $last_id = $this->db->insert_id();
            $this->db->where('id',$last_id)->update('payments',['order_id' => 'HOHOBCN-'.$last_id]);
        }
        $this->session->set_flashdata('alert', 'Payment '.ucfirst($status));
        redirect();
    }
  }
    
  
    
  function order($page='')
  {
    $this->load->view('pages/'.$page);
  }
  function cartContent()
  {
    $rowid = $_POST['rowid'];
    echo json_encode($this->cart->contents()[$rowid]);
    // echo $rowid;
  }
}
