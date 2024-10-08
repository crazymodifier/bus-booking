    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->

        <pre>
        <?php
        print_r($this->db->where('tour_id', 32)->where('calendar_variation', $_GET['id'])->get('hop_package')->result());
        echo'</pre>';
    
        echo form_open_multipart( 'Admin/addCalendar', ['class'=>'card']);?>
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
                        <label for="from">From</label>
                        <input type="date" name="from" id="from" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="to">To</label>
                        <input type="date" name="to" id="to" class="form-control">
                      </div>
                    </div>
                </div>
                <?php
                $count = 1;
                
                foreach ($variations as $variation) { ?>
                <b>Variation Name: </b><?=$variation->variation_name?>
                <div class="form-group">
                  <label for="blocked_date">Block Dates</label>
                  <input type="text" name="variation[<?='HOHOBCN-VAR-'.$variation->id?>][blocked_date]" id="blocked_date" class="form-control">
                </div>
                <?php
                  $tourist_type = array('infant','child','youth','adult','senior','family');
                  foreach ($tourist_type as $person) {?>
                
                <div class="card card-outline card-warning">
                  <div class="card-header">
                    <h3 class="card-title">
                      <?=ucfirst($person)?>
                      <input type="hidden" name="variation[<?='HOHOBCN-VAR-'.$variation->id?>][tourist][<?=$person?>][type]" value="<?=$person?>">
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-age">Age</label>
                          <input type="text" name="variation[<?='HOHOBCN-VAR-'.$variation->id?>][tourist][<?=$person?>][age]" id="<?=$person?>-age" class="form-control">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-mrp">MRP</label>
                          <input type="text" name="variation[<?='HOHOBCN-VAR-'.$variation->id?>][tourist][<?=$person?>][mrp]" id="<?=$person?>-mrp" class="form-control">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-discount">Discount</label>
                          <input type="text" name="variation[<?='HOHOBCN-VAR-'.$variation->id?>][tourist][<?=$person?>][discount]" id="<?=$person?>-discount" class="form-control">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-final_price">Final Price</label>
                          <input type="text" name="variation[<?='HOHOBCN-VAR-'.$variation->id?>][tourist][<?=$person?>][final_price]" id="<?=$person?>-final_price" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                  <?php } $count++;} ?>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success"><?=isset($_GET['page'])? 'Update':'Add'?> Page</button>
          </div>
        </form>
        
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
