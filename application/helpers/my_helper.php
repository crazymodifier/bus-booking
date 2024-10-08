<?php
function getDatesFromRange($start, $end, $format = 'd-m-Y')
{
  // Declare an empty array 
  $array = array(); 
  // Variable that store the date interval 
  // of period 1 day 
  $interval = new DateInterval('P1D'); 
  $realEnd = new DateTime($end); 
  $realEnd->add($interval); 
  $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
  // Use loop to store date into array 
  foreach($period as $date) { $array[] = $date->format($format);}
  
  // Return the array elements 
  return $array; 
}

function convert_Currency($amount, $from, $to)  
{
  $string=$from."_".$to;	 
  $url = "https://api.currencyconverterapi.com/api/v6/convert?q=$string&compact=ultra&apiKey=88f611d5-c8f3-4054-bea3-3eb85b449c54"; 
	$curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  $data = curl_exec($curl);
  $data = json_decode($data, true);
  $rate = $data[$string];
  $amount=number_format((float)$amount * $rate, 2);
  return $amount;
     
 }

function convert_to($variable)
{
  switch ($variable) {
    case 0:
      return 'USD';
      break;
    case 1:
      return 'GBP';
      break;
    case 2:
      return 'EUR';
      break;
    case 3:
      return 'AUD';
      break;
    case 4:
      return 'CAD';
      break;
    case 5:
      return 'SGD';
      break;
    case 6:
      return 'HKD';
      break;
    case 7:
      return 'AED';
      break;
    case 8:
      return 'INR';
      break;
    default:
      return 'USD';
      break;
  }
}
 
function currency_icon($variable)
{
  switch ($variable) {
    case 0:
      return 'US<i class="fa fa-dollar-sign fa-sm mr-1"></i>';
      break;
    case 1:
      return '<i class="fa fa-pound-sign fa-sm mr-1"></i>';
      break;
    case 2:
      return '<i class="fa fa-euro-sign fa-sm mr-1"></i>';
      break;
    case 3:
      return 'AU<i class="fa fa-dollar-sign fa-sm mr-1"></i>';
      break;
    case 4:
      return 'CA<i class="fa fa-dollar-sign fa-sm mr-1"></i>';
      break;
    case 5:
      return 'SG<i class="fa fa-dollar-sign fa-sm mr-1"></i>';
      break;
    case 6:
      return 'HK<i class="fa fa-dollar-sign fa-sm mr-1"></i>';
      break;
    case 7:
      return 'AED';
      break;
    case 8:
      return '<i class="fa fa-rupee-sign fa-sm mr-1"></i>';
      break;
    default:
      return 'US<i class="fa fa-dollar-sign fa-sm mr-1"></i>';
      break;
  }
}
function ratings($val)
{
  switch ($val) {
    case 5:
      $data = '<i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
      ';
      break;
    case 4:
      $data = '<i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-muted"></i>
      ';
      break;
    case 3:
      $data = '<i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-muted"></i>
        <i class="fa fa-star text-muted"></i>
      ';
      break;
    case 2:
      $data = '<i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-muted"></i>
        <i class="fa fa-star text-muted"></i>
        <i class="fa fa-star text-muted"></i>
      ';
      break;
    case 1:
      $data = '<i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-muted"></i>
        <i class="fa fa-star text-muted"></i>
        <i class="fa fa-star text-muted"></i>
        <i class="fa fa-star text-muted"></i>
      ';
      break;
    
    default:
      $data = '<i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
        <i class="fa fa-star text-warning"></i>
      ';
      break;
    
  }
  return $data;
}
function statusColor($status)
{
  switch ($status) {
    case 'pending':
      return 'warning';
      break;
    case 'delivered':
      return 'success';
      break;
    case 'packed':
      return 'info';
      break;
    case 'cancel':
      return 'danger';
      break;
    case 'shipped':
      return 'primary';
      break;
    default:
      return 'secondary';
      break;
  }
}
function copyrights($company = '', $company_url= '')
{
  return '
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="'.$company_url.'">'.$company.'</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developed By</b> <a href="http://crazymodifier.com">Crazy Modifier</a>
    </div>
  </footer>';
}
?>
