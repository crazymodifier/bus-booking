<?php

class Tours extends CI_Model
{
  function get_tours($id='')
  {
    if ($id) 
    {
      return $this->db->where('id',$id)->get('tours_hop')->row();
    }
    else
    {
      return $this->db->order_by('id','DESC')->get('tours_hop')->result();
    }
  }

  function variations($id='')
  {
    if ($id) 
    {
      return $this->db->where('id',$id)->get('variations')->row();
    }
    else
    {
      return $this->db->order_by('id','DESC')->get('variations')->result();
    }
  }

  function packages($id='', $tourist_type = '',$variation='', $date = '')
  {
    
    if ($id) 
    {
      return $this->db->where('id',$id)->get('packages')->row();
    }
    elseif ($tourist_type) {
      return $this->db->where('tourist_type',$tourist_type)->get('packages')->row();
    }
    elseif ($variation) {
      return $this->db->where('variation_id',$variation)->where('start_from <= ', $date)->where('end_to >= ', $date)->get('packages')->row();
    }
    elseif ($variation && $date) {
      return $this->db->where('variation_id',$variation)->where('tourist_type','infant')->where('start_from <= ', $date)->where('end_to >= ', $date)->get('packages')->limit(6,0)->result();
    }
    elseif ($tourist_type && $variation) {
      return $this->db->where('tourist_type',$tourist_type)->where('variation_id',$variation)->get('packages')->row();
    }
    else
    {
      return $this->db->group_by('variation_id')->where('tourist_type' , 'adult')->where('start_from <= ', $date)->where('end_to >= ', $date)->order_by('final_price','ASC')->get('packages')->result();
    }
  }

  function hop_packages($id='', $tourist_type = '',$variation='', $date ='', $tour_id= 32)
  {
    $today =date('y-m-d');
    if ($id) 
    {
      return $this->db->where('id',$id)->get('hop_package')->row();
    }
    elseif ($tourist_type && $variation) {
      return $this->db->where('variation_id', $variation)->where('tour_id', $tour_id)->where('tourist_type',$tourist_type)->where('date_to >= ', $today)->where('date_from <= ', $today)->get('hop_package')->row();
    }
    elseif ($tourist_type) {
      return $this->db->where('tourist_type',$tourist_type)->get('hop_package')->row();
    }
    elseif ($variation) {
      return $this->db->where('variation_id', $variation)->where('tour_id', $tour_id)->where('date_to >= ', $today)->where('date_from <= ', $today)->where('age!=', '')->order_by('date_to DESC, tourist_type ASC')->get('hop_package')->result();
    }
    elseif ($variation && $date) {
      return $this->db->where('variation_id',$variation)->where('tourist_type','infant')->where('date_from <= ', $date)->where('date_to >= ', $date)->get('hop_package')->limit(6,0)->result();
    }
    
    else
    {
      $count = 1;
			$varications = [];
			$variation_id = $this->db->distinct()->select('variation_id')->where('tourist_type' , 'ADULT')->where('tour_id', $tour_id)->order_by('final_price ASC')->get('hop_package')->result();
			
			foreach ($variation_id as $value) 
			{
				
				$varication = $this->db->where('variation_id', $value->variation_id)->where('tour_id', $tour_id)->where('age!=', '')->where('date_to >= ', $today)->where('date_from <= ', $today)->order_by('date_to DESC', 'age ASC')->get('hop_package')->result();
				array_push($varications, $varication);
				
			}
			return $varications;
    }
  }

  function calendars($id='',$tour_id=32)
  {
    if ($id) 
    {
      return $this->db->where('id',$id)->get('packages')->row();
    }
    else
    {
      return $this->db->group_by('calendar_variation')->where('tour_id', $tour_id)->where('tourist_type' , 'adult')->order_by('date_to','ASC')->get('hop_package')->result();
    }
  }


  function blocked_date($variation)
  {
    $today = date('Y-m-d');
    $calendar = $this->db->select_max('calendar_id')->where('variation_id',$variation)->where('date_from <= ', $today)->where('date_to >= ', $today)->get('packages')->row()->calendar_id;
    return $this->db->where('calendar_id', $calendar)->get('packages')->row()->blocked_date;
  }


  function blocked_dates($variation_id, $tour_id = 32)
	{
		// $blocked_date = $this->tours->blocked_date($id);
		
		$today = date('Y-m-d');
		$calendar = $this->db->select_max('calendar_variation')->where('variation_id',$variation_id)->where('date_from <= ', $today)->where('tour_id', $tour_id)->where('date_to >= ', $today)->get('hop_package')->row()->calendar_variation;

		$blocked_date = $this->db->where('calendar_variation', $calendar)->where('variation_id',$variation_id)->where('tour_id', $tour_id)->get('hop_package')->row()->blocked_date;
		$dates = [];
    
    $arr_date = explode(',', $blocked_date);
		
		$arr_date_length=count($arr_date);

		for($t=0;$t<$arr_date_length;$t++)
		{


			if (strpos($arr_date[$t],"To") !== false) 
			{
				$parts= explode(' To ', $arr_date[$t]);
				$from = str_replace(' ', '', $parts[0]);
        $to 	= str_replace(' ', '', $parts[1]);
        
				$blocked_date = getDatesFromRange($from,$to);
				foreach ($blocked_date as $date) {
					// $dates .= $date;
					array_push($dates, $date);
				}
			}
			else 
			{
				array_push($dates, str_replace(' ', '', $arr_date[$t]));
				// $dates .= $arr_date[$t];
			}
		}
		return  $dates;
		// $this->session->set_userdata('blocked_date' , $dates);

  }
}
