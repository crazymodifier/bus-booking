<main class="bg-light">
  <div class="container-fluid p-5">

    <div class="">
      <a href="" class="btn btn-danger"><i class="fa fa-shopping-cart mr-1"></i><span class="d-none d-md-inline">Choose a tour</span></a> <i class="fa fa-angle-right mx-2 fa-lg"></i>
      <a href="" class="btn btn-danger"><i class="fa fa-users mr-1"></i><span class="d-none d-md-inline">Passanger Information</span></a> <i class="fa fa-angle-right mx-2 fa-lg"></i>
      <a href="" class="btn border border-danger"><i class="fa fa-money-bill-alt mr-1"></i><span class="d-none d-md-inline">Payment</span></a> <i class="fa fa-angle-right mx-2 fa-lg"></i>
      <a href="" class="btn border border-danger"><i class="fa fa-receipt mr-1"></i><span class="d-none d-md-inline">Ticket Voucher</span></a>
    </div>
    <hr class="border-danger">
    <div class="row">
      <div class="col-md-8">
        <?php
        foreach ($this->cart->contents() as $tours) { 
          
          // $tour = $this->db->where('id' ,$tours['tour_id'])->get('tours_hop')->row();
          ?>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <a href="#"class="btn-link" data-toggle="collapse" data-target="#passenger" aria-expanded="true" aria-controls="passenger">
                  Passenger Information
                </a>
              </h5>
            </div>

            <div id="passenger" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <form action="">
                  <div class="form-group">
                    <input type="text" name="billing_name" placeholder="Enter Lead Passenger Name*" required class="form-control">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="billing_tel" placeholder="Enter Your Phone Number*" required class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="billing_email" placeholder="Enter Your Email Address*" required class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="billing_address" placeholder="Enter Address*" required class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="billing_pin" placeholder="Enter Pin/Zip Code*" required class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="billing_state" placeholder="Enter Address*" required class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="billing_country" placeholder="Enter Pin/Zip Code*" required class="form-control">
                      </div>
                    </div>
                  </div>

                  <label for="agreement" class="font-weight-normal"><input type="checkbox" name="agreement" id="agreement" required> I accept all terms and conditions.</label><br>
                  <button class="btn btn-success">Make Payment</button>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <a href="#"class="btn-link collapsed" data-toggle="collapse" data-target="#payment" aria-expanded="false" aria-controls="payment">
                  Make Payment
                </a>

              </h5>
            </div>
            <div id="payment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>

        <?php } ?>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h6 class="mt-n1 border-bottom"><b>Booking Summary</b></h6>
            <div class="float-right">
              <a href="" data-row="<?=$tours['rowid']?>" data-toggle="modal" data-target="#edit-cart" class="btn-outline-info btn btn-xs px-1"><i class="fa fa-pencil-alt fa-fw"></i></a>
              <a href="<?=base_url('Checkout/removeItem/'.$tours['rowid'])?>" class="btn-danger btn btn-xs px-1"><i class="fa fa-times fa-fw"></i></a>
            </div>
            <p class="mb-0 pr-3">
              <b>Selected Option: </b><i><?=$tours['name']?></i><br>
              <b>Traveling Date: </b> <?=date('Y-m-d',strtotime($tours['traveling-date']))?><br>
              <b>Passangers: </b>
              <?php
              foreach ($tours['traveller'] as $key => $value) {
                if ($value) {
                  echo '<span class="comma-seperator">'.$value.' '.$key.'</span> ';
                  }
                }?><br>
              <b>Subtotal: </b>
              <i class="fa fa-rupee-sign fa-sm"></i>
              <?=$this->cart->format_number($tours['subtotal']);?><br>
              
            </p>
            <hr>
            <h6 class="mt-n1"><b>Coupan Code</b></h6>
            <div class="input-group">
              <input type="text" class="form-control">
                <span class="input-group-append">
                  <button type="button" class="btn btn-danger">Apply Code</button>
                </span>
              </div>
              <h6 class="mb-0 mt-3">Apply HOHOSPL & get exciting discount!</h6>
          </div>
          <div class="card-footer">
              <dl class="d-flex justify-content-between mb-0">
                <dt>Total Cart Value</dt>
                <dd class="mb-0"><i class="fa fa-rupee-sign mr-1 fa-xs"></i><?=number_format($this->cart->total(),2)?></dd>
              </dl>
            </div>
        </div>
      </div>
    </div>
    <pre>
    </pre>
   </div>
</main>
 <div class="modal fade" id="edit-cart">
        <div class="modal-dialog modal-dialog-centered">
          <form class="modal-content p-3" action="Checkout/updateCart" method='POST'>
            <h4 class="text-warning">Select tour option</h4>
              <input type="hidden" name="rowid" value="" id="edit-cart-row">
              <?php 
              $packages = $this->tours->packages();
              $count = 1;
              foreach ($packages as $package) { 
                $count++;?>
              <div class="form-group">
                <input type="radio" name="package" class="mr-2" id="package-<?=$count?>" value="<?=$package->variation_id?>">
                <label for="package-<?=$count?>"><?=$package->variation_name?></label>
              </div>
              <?php } ?>
              <div class="form-group">
                <input required type="date" name="traveling-date" id="traveling-date" class="form-control">
              </div>
              <div class="row">
                <?php
                $tourist_type = array('infant','child','youth','adult','senior','family');
                foreach ($tourist_type as $person) {
                  $price = $this->tours->packages('',$person); 
                  if($price->age){
                  ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select name="traveller[<?=$person?>]" id="<?=$person?>" class="form-control">
                        <option value="0"><?=ucfirst($person)?> <?=$price->age?></option>
                        <?php
                        for ($i=1; $i < 11; $i++) { 
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                <?php } }?>
              </div>

              <div class="form-group">
                <button class="btn btn-lg btn-success btn-block">Book Now</button>
              </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      