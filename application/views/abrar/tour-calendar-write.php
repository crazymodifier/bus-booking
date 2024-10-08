    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->

        <?php
        if(isset($_GET['id']))
        {
        $calendar = $this->db->where('tour_id', 32)->where('calendar_variation', $_GET['id'])->get('hop_package')->result();
    
        echo form_open_multipart( 'Abrar/addCalendar/'.$_GET['id'], ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Package Details
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <div class="card card-danger card-outline">
              <div class="card-header bg-light">
                <h3 class="card-title"></h3>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                          $calendar_id = $this->db->where('tour_id', 32)->where('calendar_variation', $_GET['id']-1)->get('hop_package')->row();
                          ?>
                      <div class="form-group">
                        <label for="from">From</label>
                        <input type="date" name="from" id="from" min="<?=$calendar_id->date_to?>" class="form-control" value="<?=$calendar[0]->date_from?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="to">To</label>
                        <input type="date" name="to" id="to" min="<?=$calendar_id->date_to?>" class="form-control" value="<?=$calendar[0]->date_to?>">
                      </div>
                    </div>
                    
                </div>

                <?php
                $count = 0;
                //$person = 'adult';
                foreach ($variations as $variation) { 
                  $count++;
                  $passengers = $this->db->where('calendar_variation', $_GET['id'])->where('variation_id', $variation->variation_id)->order_by('tourist_type ASC')->get('hop_package')->result();
                ?>
                
                <div class="callout callout-danger p-2">
                  <h5 class="mb-0"><b>Variation Name: </b><?=$variation->variation_name?></h5>
                </div>
                <div class="form-group">
                  <label for="blocked_date">Block Dates</label>
                  <input type="text" name="variation[<?=$variation->variation_id?>][blocked_date]" id="blocked_date-<?=$count?>" class="form-control" value="<?=$passengers[0]->blocked_date?>">
                </div>
                <?php foreach ($passengers as $person) { ?>
                <div class="card card-outline card-warning">
                  <div class="card-header">
                    <h3 class="card-title">
                      <?=$person->tourist_type?>
                      <input type="hidden" name="variation[<?=$variation->variation_id?>][tourist][<?=$person->tourist_type?>][type]" value="<?=$person->tourist_type?>">
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person->tourist_type?>-age">Age</label>
                          <input type="text" value="<?=$person->age?>" name="variation[<?=$variation->variation_id?>][tourist][<?=$person->tourist_type?>][age]" id="<?=$person->tourist_type?>-age-<?=$count?>" <?=$person->tourist_type == 'ADULT'? 'required' :'' ?> class="form-control">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person->tourist_type?>-mrp">MRP</label>
                          <input type="text" value="<?=$person->package_mrp?>" name="variation[<?=$variation->variation_id?>][tourist][<?=$person->tourist_type?>][mrp]" id="<?=$person->tourist_type?>-mrp-<?=$count?>" class="form-control mrp">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label>Discount Type</label>
                          <!-- <input type="text" value="<?=$person->package_discount?>" name="variation[<?=$variation->variation_id?>][tourist][<?=$person->tourist_type?>][discount]" id="<?=$person->tourist_type?>-discount" class="form-control"> -->
                          <select name="" id="<?=$person->tourist_type?>-discount-type-<?=$count?>" class="form-control discount-type">
                            <option value="0">Percentage</option>
                            <option value="1">Fixed</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person->tourist_type?>-discount">Discount</label>
                          <input type="text" value="<?=$person->package_discount?>" name="variation[<?=$variation->variation_id?>][tourist][<?=$person->tourist_type?>][discount]" id="<?=$person->tourist_type?>-discount-<?=$count?>" class="form-control discount">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person->tourist_type?>-final_price">Final Price</label>
                          <input type="text" value="<?=$person->final_price?>" name="variation[<?=$variation->variation_id?>][tourist][<?=$person->tourist_type?>][final_price]" id="<?=$person->tourist_type?>-final_price-<?=$count?>" class="form-control final_price">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } } ?>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Update Information</button>
          </div>
        </form>
        <?php } else {?>
        <!-- Main row -->

        <?php
    
        echo form_open_multipart( 'Abrar/addCalendar', ['class'=>'card']);?>
          <!-- Left col -->
          <div class="card-header">
            <h3 class="card-title">
              Package Details
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <div class="card card-danger card-outline">
              <div class="card-header bg-light">
                <h3 class="card-title"></h3>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <?php
                          $calendar_id = $this->db->where('tour_id', 32)->order_by('calendar_variation DESC')->get('hop_package')->row();
                          ?>
                        <label for="from">From</label>
                        <input type="date" name="from" min="<?=$calendar_id->date_to?>" value="<?=$calendar_id->date_to?>" id="from" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="to">To</label>
                        <input type="date" name="to" min="<?=$calendar_id->date_to?>" id="to" class="form-control">
                      </div>
                    </div>
                </div>
                
                <?php
                $count = 0;
                //$person = 'adult';
                foreach ($variations as $variation) { 
                  $count++;
                  $passengers = array('ADULT','CHILD','FAMILY','INFANT','SENIOR','YOUTH');
                ?>
                
                <div class="callout callout-danger p-2">
                  <h5 class="mb-0"><b>Variation Name: </b><?=$variation->variation_name?></h5>
                  <input type="hidden" name="variation[<?=$variation->variation_id?>][variation]" value="<?=$variation->variation_name?>">
                </div>
                <div class="form-group">
                  <label for="blocked_date">Block Dates</label>
                  <input type="text" name="variation[<?=$variation->variation_id?>][blocked_date]" id="blocked_date-<?=$count?>" class="form-control">
                </div>
                <?php foreach ($passengers as $person) { ?>
                <div class="card card-outline card-warning">
                  <div class="card-header">
                    <h3 class="card-title">
                      <?=$person?>
                      <input type="hidden" name="variation[<?=$variation->variation_id?>][tourist][<?=$person?>][type]" value="<?=$person?>">
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-age">Age</label>
                          <input type="text" name="variation[<?=$variation->variation_id?>][tourist][<?=$person?>][age]" id="<?=$person?>-age-<?=$count?>" <?=$person == 'ADULT'? 'required' :'' ?> class="form-control">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-mrp">MRP</label>
                          <input type="text" name="variation[<?=$variation->variation_id?>][tourist][<?=$person?>][mrp]" id="<?=$person?>-mrp-<?=$count?>" class="form-control mrp">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label>Discount Type</label>
                          <!-- <input type="text" value="<?=$person->package_discount?>" name="variation[<?=$variation->variation_id?>][tourist][<?=$person?>][discount]" id="<?=$person?>-discount" class="form-control"> -->
                          <select name="" id="<?=$person?>-discount-type-<?=$count?>" class="form-control discount-type">
                            <option value="0">Percentage</option>
                            <option value="1">Fixed</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-discount">Discount</label>
                          <input type="text" name="variation[<?=$variation->variation_id?>][tourist][<?=$person?>][discount]" id="<?=$person?>-discount-<?=$count?>" class="form-control discount">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-final_price">Final Price</label>
                          <input type="text" name="variation[<?=$variation->variation_id?>][tourist][<?=$person?>][final_price]" id="<?=$person?>-final_price-<?=$count?>" class="form-control final_price">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } } ?>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Add Calendar</button>
          </div>
        </form>
                  <?php } ?>
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
