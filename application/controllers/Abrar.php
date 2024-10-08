<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abrar extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    // $this->load->model('Offers');
    if (!isset($_SESSION['admin'])) {
      redirect('abrar');
    }
  }

	function index($slug = 'dashboard')
	{
		if ($slug) 
		{
			$data = array(
        'title'     => '', 
        'slug'      => ucfirst($slug),
        'variations' => $this->db->where('tour_id', 32)->get('package_variation')->result(),
        'packages'  => $this->tours->packages(),
        'about'     => $this->logics->get_about(),
        'whyus'     => $this->logics->get_whyus(),
        'tour'      => $this->db->get('tour')->row(),
			);
      $this->load->view('includes/header',$data);
      $this->load->view('includes/sidebar',$data);
			$this->load->view('abrar/'.$slug,$data);
			$this->load->view('includes/footer',$data);
		}
  }
  
  function removebooking($id='')
  {
      $this->db->where('session_id', $id)->delete('bookings');
      $this->db->where('session_id', $id)->delete('purchased_customers');
      $this->db->where('session_id', $id)->delete('payments');
      redirect($_SERVER['HTTP_REFERER']);
  }
  
  function addCoupon($id='')
  {
    $data = $this->input->post();
    
    // $data['products'] = implode(',',$this->input->post('products'));
    if ($id) 
    {
      // $this->updateOffers($id, $this->input->post('status'));
      if($data['status'] == 'Disable')
      {
          if ($this->db->where('id',$id)->update('coupon',$data)) 
          {
              
            $this->session->set_flashdata('success', 'Offer Updated');
          } 
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Worng');
          }
      }
      else
      {
          if ($this->db->where('id',$id)->update('coupon',$data)) 
          {
            $this->db->where('id !=',$id)->update('coupon',['status' => 'Disable']);
            $this->session->set_flashdata('success', 'Offer Updated');
          } 
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Worng');
          }
      }
      redirect('abrar/coupon-code');
    }
    else 
    {
        $data['date'] = date('Y-m-d');
        if($data['status'] == 'Disable')
        {
          if ($this->db->insert('coupon',$data)) 
          {
            $this->session->set_flashdata('success', 'Offer Inserted');
          } 
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Worng');
          }  
        }
        else
        {
           if ($this->db->insert('coupon',$data)) 
          {
              $this->db->where('id !=',$this->db->insert_id())->update('coupon',['status' => 'Disable']);
            $this->session->set_flashdata('success', 'Offer Inserted');
          } 
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Worng');
          } 
        }
      redirect('abrar/coupon-code');     
    }
  }


  function packages($id='')
  {
    if ($id) 
    {
      $data = $this->input->post();
      $data['sun'] = isset($_POST['sun'])?  $this->input->post('sun'): 0;
      $data['mon'] = isset($_POST['mon'])?  $this->input->post('mon'): 0;
      $data['tue'] = isset($_POST['tue'])?  $this->input->post('tue'): 0;
      $data['wed'] = isset($_POST['wed'])?  $this->input->post('wed'): 0;
      $data['thu'] = isset($_POST['thu'])?  $this->input->post('thu'): 0;
      $data['fri'] = isset($_POST['fri'])?  $this->input->post('fri'): 0;
      $data['sat'] = isset($_POST['sat'])?  $this->input->post('sat'): 0;
      $this->db->where('id', $id)->update('package_variation',$data);
      
      
      $this->db->where('variation_id', 'HOHOBT32_var'.$id)->update('hop_package',['currency' => $this->input->post('currency'),'variation' => $this->input->post('variation_name')]);
      $this->session->set_flashdata('success', 'Variation Updated');
      redirect('abrar/tour-pricing');
    }
    else {
      $data =$this->input->post();
      $data['date_add'] = date('Y-m-d');
// $this->db->insert('package_variation',$data)

      if ($this->db->insert('package_variation',$data)) 
      {
        $id = $this->db->insert_id();
        $var = 'HOHOBT32_var'.$id;
        $this->db->where('id', $id)->update('package_variation',['variation_id'=>$var]);
      }

      $passengers = array('ADULT','CHILD','FAMILY','INFANT','SENIOR','YOUTH');
      $calendars = $this->db->select('calendar_variation')->distinct()->where('tour_id' , 32)->get('hop_package')->result();
      foreach ($calendars as $cal) 
      {
          $packages = $this->db->where('calendar_variation', $cal->calendar_variation)->where('tour_id' , 32)->limit(6,0)->order_by('id DESC')->get('hop_package')->result_array();
        foreach ($packages as $package) {
        //   $this->db->insert('hop_package',['currency' => $data['currency'], 'tour_id'=>32, 'calendar_variation' => $cal->calendar_variation, 'tourist_type' => $value, 'variation_id' => $var,'variation' => $data['variation_name']]);
            unset($package['id']);
            $package['currency'] = $data['currency'];
            $package['variation_id'] = $var;
            $package['variation'] = $data['variation_name'];
            $package['date_add'] = date('Y-m-d');
            $this->db->insert('hop_package', $package);
        }
        // echo'<pre>';
        // print_r($packages);
      }
      $this->session->set_flashdata('success', 'Variation Inserted');
      redirect('abrar/tour-pricing');
        //  exit;
    }
  }
    
  function addPackage()
  {
    //   echo'<pre>';
    //   print_r($this->input->post());
      $data =$this->input->post();
      $data['date_add'] = date('Y-m-d');
      unset($data['tourist']);

      if ($this->db->insert('package_variation',$data)) 
      {
        $id = $this->db->insert_id();
        $var = 'HOHOBT32_var'.$id;
        $this->db->where('id', $id)->update('package_variation',['variation_id'=>$var]);
      }
      $data =$this->input->post();
      $calendars = $this->db->select('calendar_variation')->distinct()->where('tour_id' , 32)->get('hop_package')->result();
      foreach ($calendars as $cal) 
      {
          $cal = $this->db->where('calendar_variation', $cal->calendar_variation)->where('tour_id' , 32)->get('hop_package')->row();
        foreach ($data['tourist'] as $package) {
            
            $package['currency'] = $data['currency'];
            $package['tour_id'] = 32;
            $package['variation_id'] = $var;
            $package['date_from'] = $cal->date_from;
            $package['date_to'] = $cal->date_to;
            $package['calendar_variation'] = $cal->calendar_variation;
            $package['variation'] = $data['variation_name'];
            $package['date_add'] = date('Y-m-d');
            // echo'<pre>';
            // print_r($package);
            $this->db->insert('hop_package', $package);
        }
      }
    $this->session->set_flashdata('success', 'Variation Inserted');
    // exit;
    redirect('abrar/tour-pricing');
  }
  function remove_package($id)
  {
      $this->db->where('tour_id', 32)->where('variation_id', $id)->delete('package_variation');
      $this->db->where('tour_id', 32)->where('variation_id', $id)->delete('hop_package');
      $this->session->set_flashdata('success', 'Variation Removed');
      redirect($_SERVER['HTTP_REFERER']);
  }
  function remove_calendar($id)
  {
      $this->db->where('tour_id', 32)->where('calendar_variation', $id)->delete('hop_package');
      $this->session->set_flashdata('success', 'Calendar Removed');
      redirect($_SERVER['HTTP_REFERER']);
  }
  function about()
  {
    if ($this->logics->addAbout($this->input->post())) 
    {
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  function whyus($status='')
  {
    if ($status) 
    {
      $this->db->insert('why_us', $this->input->post());
    }
    else {
      foreach ($this->input->post('whyus') as $key => $value) 
      {
        $this->db->where('id', $key)->update('why_us', ['title' => $value]);
      }
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  function addTour()
  {
    if ($this->logics->set_tour($this->input->post())) 
    {
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  function gallery($location)
  {
    if ($location) 
    {
      if(!empty($_FILES['images']['name']))
      {
        $data['images'] = $this->do_upload('images');
      }
      $data['location'] = $location;
      if ($this->db->insert('gallery', $data)) 
      {
        $this->session->set_flashdata('success', 'Images Uploaded');
        redirect($_SERVER['HTTP_REFERER']);
      }
      else 
      {
        $this->session->set_flashdata('error', 'Something Went Wrong');
        redirect($_SERVER['HTTP_REFERER']);
      }
    }
  }
  
  function tour_routes($id='')
  {
      
      if($id)
      {
          $data = $this->input->post();
          if(!empty($_FILES['images']['name']))
          {
              $data['map'] = $this->do_upload('images');
          }
          if ($this->db->where('id',$id)->update('tour_routes', $data)) 
          {
            $this->session->set_flashdata('success', 'Route Uploaded');
            redirect($_SERVER['HTTP_REFERER']);
          }
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect($_SERVER['HTTP_REFERER']);
          }
      }
      else
      {
          $data = $this->input->post();
          $data['date_add'] = date('Y-m-d');
          if(!empty($_FILES['images']['name']))
          {
              $data['map'] = $this->do_upload('images');
          }
          if ($this->db->insert('tour_routes', $data)) 
          {
            $this->session->set_flashdata('success', 'Route Added');
            redirect($_SERVER['HTTP_REFERER']);
          }
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect($_SERVER['HTTP_REFERER']);
          }
      }
      
      
  }

  function similar_tours($id='')
  {
      
      if($id)
      {
          $data = $this->input->post();
          if(!empty($_FILES['images']['name']))
          {
              $data['image'] = $this->do_upload('images');
          }
          if ($this->db->where('id',$id)->update('similar_tours', $data)) 
          {
            $this->session->set_flashdata('success', 'Tour Updated');
            redirect('abrar/similar-tours');
          }
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect($_SERVER['HTTP_REFERER']);
          }
      }
      else
      {
          $data = $this->input->post();
          $data['date_add'] = date('Y-m-d');
          if(!empty($_FILES['images']['name']))
          {
              $data['image'] = $this->do_upload('images');
          }
          if ($this->db->insert('similar_tours', $data)) 
          {
            $this->session->set_flashdata('success', 'Tour Added');
            redirect('abrar/similar-tours');
          }
          else 
          {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect($_SERVER['HTTP_REFERER']);
          }
      }
      
      
  }

  public function do_upload($filename)
  {
    $config['upload_path']          = './dist/uploads/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 2048;
    
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload($filename))
    {
      $error = array('error' => $this->upload->display_errors());
      $this->session->set_flashdata('error', $this->upload->display_errors());
      redirect($_SERVER['HTTP_REFERER']);
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
      $config['image_library'] = 'gd2';
      $config['source_image'] = './dist/uploads/'.$this->upload->data('file_name');  
      $config['create_thumb'] = FALSE;  
      $config['maintain_ratio'] = TRUE;  
      $config['quality'] = '90%';  
      $config['width'] = 900;  
      $config['height'] = 1200; 
      $config['new_image'] = './dist/uploads/'.$this->upload->data('file_name');  
      $this->load->library('image_lib', $config);  
      $this->image_lib->resize();

      return $this->upload->data('file_name');
    }
  }

  function addCalendar($calendar_id='', $tour_id=32)
  {
    if ($calendar_id) {
      foreach ($this->input->post('variation') as $key => $var_id) 
      {
        // $this->db->insert('packages', ['blocked_date', $var_id['blocked_date']]);
        foreach ($var_id['tourist'] as $value) 
        {
          $data = array(
            'variation_id'    => $key,
            'tourist_type'    => $value['type'],
            'package_mrp'     => $value['mrp'],
            'package_discount'=> $value['discount'],
            'final_price'     => $value['final_price'],
            'age'             => $value['age'],
            'blocked_date'    => $var_id['blocked_date'],
            'date_from'      => $this->input->post('from'),
            'date_to'          => $this->input->post('to'),
          );
          // $this->db->insert('packages', $data);
          $this->db->where('tour_id', $tour_id)->where('variation_id', $key)->where('calendar_variation', $calendar_id)->where('tourist_type', $value['type'])->update('hop_package', $data);
        }
      }
      $this->session->set_flashdata('success', 'Calendar Updated');
    }
    else 
    {
      $calendar_id = $this->db->select_max('calendar_variation')->where('tour_id', $tour_id)->get('hop_package')->row()->calendar_variation;
      foreach ($this->input->post('variation') as $key => $var_id) 
      {
        // $this->db->insert('packages', ['blocked_date', $var_id['blocked_date']]);
        foreach ($var_id['tourist'] as $value) 
        {
          $data = array(
            'variation_id'      => $key,
            'variation'    => $var_id['variation'],
            'tourist_type'      => $value['type'],
            'package_mrp'       => $value['mrp'],
            'package_discount'  => $value['discount'],
            'final_price'       => $value['final_price'],
            'age'               => $value['age'],
            'calendar_variation'=> $calendar_id+1,
            'blocked_date'      => $var_id['blocked_date'],
            'date_add'              => date('Y-m-d'),
            'date_from'         => $this->input->post('from'),
            'date_to'           => $this->input->post('to'),
            'tour_id'           => 32
          );
          $this->db->insert('hop_package', $data);
        }
      }
      $this->session->set_flashdata('success', 'Calendar Added');
    }
    
    redirect('abrar/tour-pricing');
  }
  
  function admindetails($id='')
  {
    $this->db->update('admin', $this->input->post());
    $this->session->set_flashdata('success', 'Profile Updated');
    redirect('abrar/profile');
  }

  function testimonials($id='')
  
  {
    if ($id) 
    {
      $this->db->where('testimonial_id', $id)->update('testimonial', $this->input->post());
      $this->session->set_flashdata('success', 'Testimonial Updated');
    }
    else {
      $this->db->insert('testimonial', $this->input->post());
      $this->session->set_flashdata('success', 'Testimonial Inserted');
    }
    redirect('abrar/testimonials');
  }

  function remove($id='', $table='',$column='id')
  {
    if ($id && $table) {
      $this->db->delete($table, [$column => $id]);
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
  
  function changepassword()
  {
      if($this->db->where('password', md5($this->input->post('old')))->get('admin')->num_rows())
      {
          $this->db->update('admin', ['password' => md5($this->input->post('password'))]);
          $this->session->set_flashdata('success', 'Password changed');
        //   echo'asdf';
          redirect($_SERVER['HTTP_REFERER']);
      }
      else
      {
          $this->session->set_flashdata('error', 'Please enter the correct old password');
          redirect($_SERVER['HTTP_REFERER']);
      }
  }
}
