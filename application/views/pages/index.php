




<main>
    <section style="background-position:center;background-image: url(<?=base_url('dist/img/photo4.jpg')?>)">
      <div class="container">
        <div class="row py-6">
          <div class="col-md-6">
            <div class="card mr-md-2 text-light" style="background-color: #00000088">
              <div class="card-body p-md-4">
                <form action="Checkout/addToCart" method="POST">
                  <input type="hidden" name="tour_id" value="32">
                  <h3 class="mb-3 text-warning">Select Tour Option</h3>
                  <?php foreach ($options as $option) { 
                    $date_to = $option[0]->date_to;
                    $calendar_variation = $option[0]->calendar_variation;
                    ?>
                  <input type="hidden" name="calendar_variation" value="<?=$calendar_variation?>">
                  <div class="form-group">
                    <input type="radio" name="variation" id="<?=$option[0]->variation?>" class="" required="" value="<?=$option[0]->variation_id?>">
                    <label for="<?=$option[0]->variation?>"><?=$option[0]->variation?></label>
                  </div>
                  <?php } ?>
                  <div class="form-group">
                    <label>Travel Date</label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control" min="<?=date('Y-m-d')?>" max="<?=$date_to?>" required="" placeholder="Choose Your City">
                  </div>
                  <div class="row">
                    <?php 
                      foreach ($options[0] as $package) { 
                        ?>
                      <div class="col-md-6">
                        <div class="form-group">
                          <select name="<?=strtolower($package->tourist_type)?>" id="<?= $package->tourist_type?>" class="form-control">
                            <option value="" selected>
                              <?= $package->tourist_type != 'FAMILY' ? ucfirst(strtolower($package->tourist_type)).' '.$package->age. 'yrs' : ucfirst(strtolower($package->tourist_type)).' '.$package->age ?></option>
                              <?php for ($i=1; $i < 11; $i++) { 
                                echo"<option value='$i'>$i</option>";
                              } ?>
                          </select>
                        </div>
                      </div>
                    <?php } ?>
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="Book Now">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-auto">
            <div class="card ml-md-2 text-light" style="background-color: #00000088">
              <div class="card-body p-md-4">
                <div class="row">
                  <?php 
                  $class = 3;
                  foreach ($options as $option) { 
                    foreach ($option as $package) { 
                      if(sizeof($option) > 4) $class = 4;
                      ?>
                    <div class="col-12 col-md-<?=$class?> text-center">
                      <h5 class="text-capitalize mb-0"><?=ucfirst(strtolower($package->tourist_type))?></h5>
                      <p class="mb-0"><i class="fa fa-rupee-sign fa-sm mr-1"></i><?=number_format($package->final_price,2)?></p>
                    </div>
                  <?php } }?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="" style="background-image: url(<?=base_url('assets/images/bg.png')?>);background-repeat-x:repeat;background-size: 100% 100%;">
      <div class="container py-3">
        <div class="row text-light">
          <?php foreach ($this->Logics->whyUs() as $value) {
          echo "<div class='col-md-3 col-6 mb-3'>
        <i class='fa fa-check-circle mr-1'></i>$value->title</div>";
          }?>
        </div>
        <div class="row border shadow-sm mx-0">
          <div class="col-md-6 mb-3">Hassle Free Booking!</div>
          <div class="col-md-6 mb-3 bg-light p-5">
            <h2><?=$this->Logics->aboutContent()->heading2?></h2>
            <p><?=$this->Logics->aboutContent()->content?></p>
          </div>
        </div>
      </div>
    </section>

    <pre>
      <?php print_r($options) ?>
    </pre>
  </main>