  <?php
  if (empty($this->cart->contents())) 
  {
    redirect();
  }
  $this->session->set_userdata('currentPage', 'checkout');
  $grandtotal = $this->cart->total();
  $discount = '';
  
  if(isset($_POST['apply-coupon']))
  {
      $code = $this->input->post('code');
      $coupon = $this->db->where('code', $code)->get('coupon')->row();
      if($coupon)
      {
          if($coupon->status == 'Disable')
          {
              $this->session->set_flashdata('alert', 'Invalid Coupon Code');
              $this->session->set_userdata('coupon', false);
          }
          elseif($coupon->startDate > date('Y-m-d') OR $coupon->endDate < date('Y-m-d'))
          {
              $this->session->set_flashdata('alert', 'This coupon code has been expired');
              $this->session->set_userdata('coupon', false);
          }
          elseif($this->cart->total() == $coupon->amount)
          {
              $this->session->set_flashdata('alert', 'Please do booking greater than '.$coupon->amount);
              $this->session->set_userdata('coupon', false);
          }
          else
          {
            $this->session->set_userdata('coupon', $code);
          }
      }
      else
      {
        $this->session->set_flashdata('alert', 'Invalid Coupon Code');
        $this->session->set_userdata('coupon', false);
      }
    }
    
    if($this->session->coupon)
    {
        $coupon = $this->db->where('code', $this->session->coupon)->get('coupon')->row();
        if($coupon->type == 'Percentage')
        {
            $grandtotal = $this->cart->total() - ($this->cart->total()* $coupon->discount)/100;
        }
        elseif($coupon->type == 'Fixed Price')
        {
            $grandtotal = $this->cart->total() - $coupon->discount;
        }
        
        $discount =  ($this->cart->total()* $coupon->discount)/100;
    }
  ?>
  <main class="bg-light">
    <div class="container-fluid p-lg-5">
      <style>
        /* Global CSS, you probably don't need that */

  .clearfix:after {
      clear: both;
      content: "";
      display: block;
      height: 0;
  }
  /* .wrapper {
    display: table-cell;
    vertical-align: middle;
  } */
  /* Breadcrups CSS */

  .arrow-steps .step {
    font-size: 14px;
    text-align: center;
    color: #666;
    cursor: default;
    margin: 0 3px;
    padding: 5px 5px 5px 15px;
    min-width: 180px;
    float: left;
    position: relative;
    background-color: #d9e3f7;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none; 
    transition: background-color 0.2s ease;
  }

  .arrow-steps .step:after,
  .arrow-steps .step:before {
    content: " ";
    position: absolute;
    top: 0;
    right: -15px;
    width: 0;
    height: 0;
    border-top: 16px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid #d9e3f7;	
    z-index: 2;
    transition: border-color 0.2s ease;
  }

  .arrow-steps .step:before {
    right: auto;
    left: 0;
    border-left: 15px solid #fff;	
    z-index: 0;
  }

  .arrow-steps .step:first-child:before {
    border: none;
  }

  .arrow-steps .step:first-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
  }

  .arrow-steps .step span {
    position: relative;
  }

  .arrow-steps .step span:before {
    opacity: 0;
    content: "✔";
    position: absolute;
    left: -20px;
  }

  .arrow-steps .step.done span:before {
    opacity: 1;
    -webkit-transition: opacity 0.3s ease 0.5s;
    -moz-transition: opacity 0.3s ease 0.5s;
    -ms-transition: opacity 0.3s ease 0.5s;
    transition: opacity 0.3s ease 0.5s;
  }

  .arrow-steps .step.current {
    color: #fff;
    background-color: #23468c;
  }

  .arrow-steps .step.current:after {
    border-left: 15px solid #23468c;	
  }
      </style>
      <script>
        /**/

  jQuery( document ).ready(function() {
      
      var back =jQuery(".prev");
      var	next = jQuery(".next");
      var	steps = jQuery(".step");
      
      next.bind("click", function() { 
        jQuery.each( steps, function( i ) {
          if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done')) {
            jQuery(steps[i]).addClass('current');
            jQuery(steps[i - 1]).removeClass('current').addClass('done');
            return false;
          }
        })		
      });
      back.bind("click", function() { 
        jQuery.each( steps, function( i ) {
          if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current')) {
            jQuery(steps[i + 1]).removeClass('current');
            jQuery(steps[i]).removeClass('done').addClass('current');
            return false;
          }
        })		
      });

    })
   
      </script>
       <?php
    if($this->session->login)
    {
        $user = $this->db->where('id', $this->session->id)->get('customer')->row();
    }
    
    ?>
    
      <div class="wrapper d-none d-lg-block">
        <div class="arrow-steps clearfix">
          <div class="step done"> <span>Choose Options</span> </div>
          <?php if($this->session->guest){?>
          <div class="step done"> <span>Guest</span> </div>
          <?php } else {?>
          <div class="step done"> <span>Login/Register</span> </div>
          <?php } ?>
          <div class="step current" id="passenger-step"> <span>Passenger's Information</span> </div>
          <div class="step" id="payment-step"> <span>Payment</span> </div>
          <div class="step"> <span>Voucher</span> </div>
        </div>
        <hr class="border-danger">
      </div>
      
      <div class="row">
        <div class="col-lg-8 col-md-7 my-md-4  my-lg-0">
          
          <div id="accordion">
            <div class="card card-danger">
              <div class="card-header py-2" id="headingOne">
                <h5 class="mb-0">
                  <a href="#"class="btn-link" data-toggle="collapse" data-target="#passenger" aria-expanded="true" aria-controls="passenger">
                    Passenger's Information
                  </a>
                </h5>
              </div>
                <?php
                if(isset($_POST['billing_email']))
                {
                    $name = $this->input->post('billing_name');
                    $email = $this->input->post('billing_email');
                    $phone = $this->input->post('billing_tel');
                    $address = $this->input->post('billing_address');
                    $city = $this->input->post('billing_city');
                    $state =$this->input->post('billing_state');
                    $zip = $this->input->post('billing_zip');
                    $countryname = $this->input->post('billing_country');
                }
                else
                {
                    $name = isset($user->name) ? $user->name : '';
                    $email = isset($user->email) ? $user->email : '';
                    $phone = '';
                    $address = '';
                    $city = '';
                    $state = '';
                    $zip = '';
                    $countryname = '';
                }
                ?>
              <div id="passenger" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  <form action="#payment" method="POST" name="checkout-form">
                    <div class="form-group">
                      <input type="text" name="billing_name" placeholder="Enter Lead Passenger Name*" required class="form-control" value="<?=$name?>">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="billing_tel"  placeholder="Enter Your Phone Number*" required class="form-control" value="<?=$phone?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="email" name="billing_email" placeholder="Enter Your Email Address*" required class="form-control" value="<?=$email?>">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="text" name="billing_address" placeholder="Enter Address*" required class="form-control" value="<?=$address?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="billing_city" placeholder="City*" required class="form-control" value="<?=$city?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="billing_zip" placeholder="Enter Pin/Zip Code*" required class="form-control" value="<?=$zip?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="billing_state" placeholder="State*" required class="form-control" value="<?=$state?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <select name="billing_country" class="form-control" required>
                            <option>Select Your Country</option>
                            <?php $countries = $this->db->get('country')->result(); 
                                foreach($countries as $country){
                            ?>
                            <option <?=$$countryname == $country->countryName? 'selected':''?>><?=$country->countryName?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="tid" id="tid"  value="<?= time()?>" readonly="">
                    <input type="hidden" name="merchant_id" value="223470">
                    <input type="hidden" name="language" value="EN">
                    <input type="hidden" name="order_id" value="<?=time()?>">
                    <?php $cart_car = $this->cart->contents();?>
                    <input type="hidden" name="amount" value="<?=filter_var(convert_Currency($grandtotal, convert_to(reset($cart_car)['currency']), convert_to($this->session->currency) ), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);?>">
                    <input type="hidden" name="currency" value="<?=convert_to($this->session->currency)?>">
                    <input type="hidden" name="redirect_url" value="<?= base_url();?>ccavenue/ccavResponseHandler.php">
                    <input type="hidden" name="cancel_url" value="<?= base_url();?>ccavenue/ccavResponseHandler.php">
                    <input type="hidden" name="integration_type" value="iframe_normal">
                    <label for="agreement" class="font-weight-normal"><input type="checkbox" name="agreement" id="agreement" required> I accept all <a href="../terms-and-conditions" class="text-primary">terms and conditions</a>.</label>
                    <button name="checkout" class="btn btn-success float-right">Checkout Securely<i class="fa fa-sm ml-2 fa-arrow-right"></i></button>
                  </form>
                </div>
              </div>
            </div>
            <div class="card card-danger">
              <div class="card-header py-2" id="headingTwo">
                <h5 class="mb-0">
                  <a href="#"class="btn-link collapsed" data-toggle="collapse" data-target="#payment" aria-expanded="false" aria-controls="payment">
                    Make Secure Payment
                  </a>
                </h5>
              </div>
              <div id="payment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body d-flex">
                <?php
                    if (isset($_POST['checkout'])) 
                    {
                        $data = array(
                            'billing_name' => $this->input->post('billing_name'),
                            'billing_email' => $this->input->post('billing_email'),
                            'billing_tel' => $this->input->post('billing_tel'),
                            'billing_address' => $this->input->post('billing_address'),
                            'billing_city' => $this->input->post('billing_city'),
                            'billing_state' => $this->input->post('billing_state'),
                            'billing_zip' => $this->input->post('billing_zip'),
                            'billing_country' => $this->input->post('billing_country'),
                            );
                        
                        
                        if($this->db->where('session_id', $this->session->session_data)->get('purchased_customers')->num_rows())
                        {
                            $this->db->where('session_id', $this->session->session_data)->update('purchased_customers', $data);
                            $data['amount'] = $this->input->post('amount');
                            $data['currency'] = $this->input->post('currency');
                            $this->db->where('session_id', $this->session->session_data)->update('backup_customers', $data);
                        }
                        else
                        {
                            $data['session_id'] = $this->session->session_data;
                            $this->db->insert('purchased_customers', $data);
                            $data['amount'] = $this->input->post('amount');
                            $data['currency'] = $this->input->post('currency');
                            $this->db->insert('backup_customers', $data);
                        }
                        $this->session->set_userdata('customer_id', $this->db->insert_id());
                        require_once "./ccavenue/Crypto.php";
                        $merchant_data='';
                        $working_key = '1343ECAAB02A6AFAC46B515260B3064D';
                        $access_code = 'AVJB87GI77BH35BJHB';
                        foreach ($this->input->post() as $key => $value){
                    		$merchant_data.=$key.'='.$value.'&';
                    	}
                    	$encrypted_data=encrypt($merchant_data,$working_key); 
                    	$url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
                    	?>
                    	<iframe src="<?php echo $url?>" id="paymentFrame" width="767" class="m-auto" height="500" frameborder="0" scrolling="Yes" ></iframe> <?php
                    }     
                    ?>
                
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body py-1">
                <div class="row">
                    <div class="col-lg-6 text-lg-left text-center">
                        <b>Secure payment with:</b>
                        <div class="">
                            <img src="<?=base_url('dist/img')?>/visa.png" width="50" height="" title="Secure Payment" alt="Secure Payment" style="max-width:20%">
                            <img src="<?=base_url('dist/img')?>/mastercard.png" width="50" height="" title="Secure Payment" alt="Secure Payment" style="max-width:20%">
                            <img src="<?=base_url('dist/img')?>/mestro.png" width="50" height="" title="Secure Payment" alt="Secure Payment" style="max-width:20%">
                            <img src="<?=base_url('dist/img')?>/american-express.png" width="50" height="" title="Secure Payment" alt="Secure Payment" style="max-width:20%">
                        </div>
                        <small style="font-size:10px"><b>*We don't store any credit card information.</b></small>
                    </div>
                    <div class="col-lg-6 text-lg-right text-center">
                        <p class="text-sm mb-0">We use SSL encryption to keep your data secure.</p>
                        <div>
                            <img src="<?=base_url('dist/img')?>/SSL-PNG-Image-File.png" width="120" title="Secure Payment" alt="Secure Payment">
                            <img src="<?=base_url('dist/img')?>/3-512.png" width="50" title="Secure Payment" alt="Secure Payment">
                        </div>
                    </div>
                </div>
            </div>  
          </div>          
        </div>
        <div class="col-lg-4 col-md-5 order-lg-last order-first my-4 my-lg-0">
          <div class="card">
            <div class="card-body">
              <h6 class="mt-n1 border-bottom pb-1"><b>Booking Summary</b></h6>
              <?php
              foreach ($this->cart->contents() as $tours) { 
                // $tour = $this->db->where('id' ,$tours['tour_id'])->get('tours_hop')->row();
              ?>
              <style>p{margin-bottom:.25rem}</style>
              <div class="mb- text-sm">
                <div class=""><b class="float-left">Tour Name: </b><span class="text-hover-danger"><i><?=$tour->name?></i></span></div>
                <p class="mb-1"><b>Selected Option: </b><span class="text-hover-danger"><i><?=$tours['name']?></i></span></p>
                <p class="mb-1 justify-content-between d-flex"><b>Travel Date: </b> <?=date("jS M, Y", strtotime($tours['traveling-date']))?></p>
                <p class="mb-1 justify-content-between d-flex"><b>Passenger(s): </b>
                  <span>
                    <?php
                  

                    ksort($tours['traveller']);

                    foreach ($tours['traveller'] as $key => $value) {
                      if ($value) 
                      {
                        if ($value > 1) {
                          if ($key == 'child') {
                            $key = 'children';
                          }
                          elseif ($key == 'family') {
                            $key = 'families';
                          }
                          else {
                            $key .= 's';
                          }
                          echo '<span class="comma-seperator">'.$value.' '.ucfirst($key).'</span> ';
                        }
                        else {
                          echo '<span class="comma-seperator">'.$value.' '.ucfirst($key).'</span> ';
                        }
                      }
                    }?>
                  </span>
                </p>
                <p class="mb-1 justify-content-between d-flex"><b>Subtotal: </b>
                <span><?=currency_icon($this->session->currency)?>
                <?=convert_Currency($tours['subtotal'], convert_to($tours['currency']), convert_to($this->session->currency) );?></span></p>
              </div>
              <div class="row">
                <div class="col">
                  <a href="" data-row="<?=$tours['rowid']?>" data-toggle="modal" data-target="#edit-cart" class="btn-info btn-block btn btn-xs px-1 cart-edit-btn"><i class="fa fa-pencil-alt fa-fw"></i> Edit Details</a>
                </div>
                <div class="col">
                  <a href="<?=base_url('Checkout/removeItem/'.$tours['rowid'])?>" class="btn-danger btn btn-block btn-xs px-1"><i class="fa fa-times fa-fw"></i> Remove Item</a>
                </div>
              </div>
              <hr>
              <?php } 
              $cpn = $this->db->where('status', 'Enable')->get('coupon')->row();
              if($cpn) {
              ?>
              
              <h6 class="mt-n1"><b>Coupon Code</b></h6>
                <form action="" method="post">
                    <div class="input-group ">
                        <input type="text" name="code" class="form-control" required value="<?=$this->session->coupon?$this->session->coupon:''?>">
                        <span class="input-group-append">
                            <button type="submit" name="apply-coupon" class="btn btn-danger">Apply Code</button>
                        </span>
                    </div>
                </form>
                <?php if($this->session->coupon) {?>
                <small class="text-success">Coupon Code Applied</small>
                <?php } ?>
              <h6 class="mb-0 mt-3">Apply <b><?=$cpn->code?></b> & Get Additional Discount*!</h6>
              <?php } ?>
            </div>
            <div class="card-footer">
                <dl class="d-flex justify-content-between mb-0">
                  <dt>Total Cart Value</dt>
                  <dd class="mb-0"><?=currency_icon($this->session->currency)?>
                  <?=convert_Currency($this->cart->total(), convert_to($tours['currency']), convert_to($this->session->currency) );?>
                  </dd>
                </dl>
                <?php if($this->session->coupon){?>
                <dl class="d-flex justify-content-between mb-0">
                  <dt>Total Discount</dt>
                  <dd class="mb-0"><?=currency_icon($this->session->currency)?>
                  <?=convert_Currency($discount, convert_to($tours['currency']), convert_to($this->session->currency) );?>
                  </dd>
                </dl>
                <dl class="d-flex justify-content-between mb-0">
                  <dt>Grand Total</dt>
                  <dd class="mb-0"><?=currency_icon($this->session->currency)?>
                  <?=convert_Currency($grandtotal, convert_to($tours['currency']), convert_to($this->session->currency) );?>
                  </dd>
                </dl>
                <?php } ?>
              </div>
          </div>
          <!-- <a href="<?=base_url()?>" class="btn btn-primary btn-block"><i class="fa fa-sm mr-2 fa-arrow-left"></i> Add More Tours</a> -->
          <button type="button" class="d-none d-lg-block btn btn-success btn-block checkout-btn">Checkout Securely <i class="fa fa-sm ml-2 fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </main>
        <div class="modal fade" id="edit-cart">
          <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content p-3" action="Checkout/updateCart" method='POST' name="edit-cart">
              <h6 class="text-warning">Select Tour Option</h6>
              <?php 
              $count=0;
              foreach ($packages as $package) 
              { 
                $min_date = $package[0]->date_from;
                $max_date = $package[0]->date_to;
                $count++?>
              <div class="text-sm">
                <label for="package-<?=$count?>" class="font-weight-normal">
                  <input <?=$count==1?'checked':''?> type="radio" name="package" data-var_id="<?=$package[0]->variation_id?>" required class="mr-2" id="package-<?=$count?>" value="<?=$package[0]->variation_id?>">
                  <?=$package[0]->variation?>
                </label>
              </div>
              <?php } ?>
              <div class="form-group card bg-danger">
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input required type="text" name="traveling-date" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker">
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="card text-dark px-1" >
                <div class="card-body p-2">
                  <span><i class="fa fa-users mr-1 text-danger"></i>Select Passengers</span>
                </div>
              </div>
              <div class="card text-dark p-2 mt-n2 d-flex" id="passengers">
                
                </div>

                <div class="form-group">
                  <button class="btn btn-lg btn-success btn-block">Update</button>
                </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php if($this->session->login or $this->session->guest) { }else{?>
        <script>
  $('#login-modal').modal({backdrop: 'static', keyboard: true})  
  </script>
  <?php } ?>
  <script>
        $('input[name="billing_tel"]').keyup(function () {
        if (!this.value.match(/[0-9]/)) {
          this.value = this.value.replace(/[^0-9]/g, '');
        }
      });
      $('.checkout-btn').click(function(){
        $('button[name="checkout"]').click();  
      });
      
      if(location.href.includes("#payment", 0))
      {
          $('a[data-target="#payment"]').click();
          $('#passenger-step').addClass('done pl-5').removeClass('current');
          $('#payment-step').addClass('current').removeClass('done');
      }
      else
      {
          $('#payment-step').removeClass('current');
          $('#passenger-step').addClass('current').removeClass('done');
      }
      $('.cart-edit-btn').click(function(){
          $('form[name="edit-cart"]').attr('action', 'Checkout/updateCart/'+$(this).data('row'));
      })
  </script>