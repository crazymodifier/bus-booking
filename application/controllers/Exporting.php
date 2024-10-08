<?php


class Exporting extends CI_Controller
{
  function export_exl()
  {
      
      // Original PHP code by Chirp Internet: www.chirp.com.au
      // Please acknowledge use of this code by including this header.

      

    //   $data = $this->db->where('email !=', '')->get('registration')->result_array();
      
        $data = [];
        $customers = $this->db->where('order_status', 'Success')->get('payments')->result();
        foreach ($customers as $customer) {
            $user = $this->db->where('session_id', $customer->session_id)->get('purchased_customers')->row();
            $tour = $this->db->where('session_id', $customer->session_id)->order_by('travelling_date ASC')->get('bookings')->row();
            
                $total = 0;
                $tourist = ['adult', 'child' , 'family', 'infant', 'senior', 'youth'];
                foreach ($tourist as $value) 
                {
                  $total += $tour->$value;
                }
                

            $booking = array(
                'Booking ID' => $customer->order_id,
                'Option Booked' => $tour->name,
                'Lead Passenger Name' => $user->billing_name,
                'Total Passengers' => $total,
                'Adult'     => $tour->adult, 
                'Child'     => $tour->child, 
                'Family'    => $tour->family,
                'Infant'    => $tour->infant, 
                'Senior'    => $tour->senior,  
                'Youth'     => $tour->youth,
                'Amount'    => $customer->amount,
                'Currency' => $customer->currency,
                'Booking Date' => date('d-m-Y',strtotime($tour->checkout_date)),
                'Travel Date' => date('d-m-Y',strtotime($tour->travelling_date))
                
                );
            array_push($data , $booking);
      } 
      function cleanData(&$str)
      {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
      }

      // file name for download
      $filename = "booking_data_" . date('dmY') . ".xls";

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");

      $flag = false;
      foreach($data as $row) {
        if(!$flag) {
          // display field/column names as first row
          echo implode("\t", array_keys($row)) . "\n";
          $flag = true;
        }
        array_walk($row, __NAMESPACE__ . '\cleanData');
        echo implode("\t", array_values($row)) . "\n";
      }

      exit;

  }
}
