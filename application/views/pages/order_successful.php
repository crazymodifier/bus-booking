<!DOCTYPE html>


<html>
  <html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Order Successfull</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
  <style>
    .comma-seperator:not(:last-child):after
    {
      content:','
    }
    @media print {
        @page { margin: 0; }
        section{ page-break-after: always; }
    }
  </style>
<body>
  <?php
  $this->session->unset_userdata('session_data');
  $this->session->unset_userdata('customer_id');
  if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

  }
  else {
    redirect();
  }

  $booking = $this->db->where('session_id', $id)->get('bookings')->result();
  $customers = $this->db->where('session_id', $id)->get('purchased_customers')->row();
  
  ?>
  <article class="wrapper">
    <!-- Main content -->
    <?php foreach ($booking as $tour) { 
      // $package  = $this->db->where('variation_id', $tour->package)->where('tourist_type', 'ADULT')->get('hop_package')->row();
      $package = $this->db->get('tour')->row();
      ?>
      <article class="container py-5">
        <section class="border border-danger p-4 h-100">
          <div class="text-center">
            <img src="<?=base_url('dist/img/logo.png')?>" alt="" height="70">
          </div>
          <div>
            <p>This is your e-ticket for:</p>
            <p><b>Tour Name: </b> <?=$package->name?></p>
            <p><b>Option booked: </b> <?=$tour->name?></p>
            <p></p>

            <h6 class="font-weight-bold"><u>Booking Confirmation</u></h6>
            <p>
              <b>Lead Visitors Name: </b> <?=$customers->billing_name?><br>
              <b>Date of Visit: </b> <?=date("jS M, Y", strtotime($tour->travelling_date))?><br>
            </p>

            <p>Please print and bring e-ticket with you to redeem your booking. Your voucher is redeemable upto 3 months after the date of visit stated above</p>
          </div>
          <div class="border-danger border-top">
            <div class="py-3 text-center">
              <?php 
                $total = 0;
                $tourist = ['adult', 'child' , 'family', 'infant', 'senior', 'youth'];
                foreach ($tourist as $value) 
                {
                  $total += $tour->$value;
                }
                echo'<h5><b>'.$total.' Passengers</b></h5>';
                echo '<b> (';
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
                      echo '<span class="comma-seperator">'.$tour->$value.' '.ucfirst($key).'</span> ';
                    }
                    else 
                    {
                      echo '<span class="comma-seperator">'.$tour->$value.' '.ucfirst($value).'</span> ';
                    }
                  }
                }
                echo '</b> )';
              ?>
              
            </div>
          </div>
          <div class="border-danger border-top">
            <div class="py-3">
              <h5>Tour Schedule:</h5>
              <?=$package->schedule?>
            </div>
          </div>
          <div class="border-danger border-top">
            <div class="py-3">
              <h5>Important Info:</h5>
              <div class="pl-4">
                <?=$package->important?>
                <?=$package->cancellation?>
              </div>
            </div>
          </div>
          <div class="border-danger border-top">
            <div class="py-3">
              <h5>How to exchange your E-ticket:</h5>
              <p class="pl-4">Please present your E-ticket to the staff on duty to receive your vaild ticket.</p>
              <h5>Terms & Conditions:</h5>
              <p class="pl-4">This E-ticket is valid for redemtion only by the person(s) above. It is not transferable, has no cash value and may be redeemed only once. <br>
              Treat this E-ticket like cash. You must present this E-ticket to redeem your purchase. It must be redeemed within the valid period shown above. Misuse of this E-ticket is a criminal offence. The purchaser is responsible for any misuse of this voucher.</p>
            </div>
          </div>
          <div class="border-danger border-top">
            <div class="py-3 text-center">
              Powerd by <br>
              <a href="<?=base_url()?>" style="display:block;"><img src="<?=base_url('dist/img/sightseeinggo.png')?>" style="max-width:245px;" class="img-responsive" alt="Hop-On, Hop-Off Barcelona"> </a> <br>
              <b><a href="<?=base_url()?>" class="text-danger"><?=base_url()?></a></b> <br>
              <u class="text-sm">Local Tour Operator's Details</u> <br>
              <span class="text-sm">Via Londra, 5/7 (Zona industriale Bomba) - 52022 Cavriglia (At) <br> Contact No. - +39 055 961237</span>
            </div>
          </div>
        </section>
      </article>
    <?php } ?>
    <!-- /.content -->
  </article>
  <!-- ./wrapper -->

  <script type="text/javascript"> 
    window.addEventListener("load", window.print());
  </script>


</body>
</html>