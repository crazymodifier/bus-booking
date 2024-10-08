    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        
        <?php if(isset($_GET['action']) && $_GET['action'] == 'add-package')
        {
          echo form_open_multipart( 'Abrar/addPackage', ['class'=>'card']);?>
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
                <h3 class="card-title">Package Variation Information</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="variation[name]">Package Variation Name</label>
                  <input type="hidden" name="tour_id" value="32">
                  <!--<input type="text" name="variation[name]" id="variation[name]" class="form-control" value="" placeholder="Package Variation Name">-->
                  <input required type="text" name="variation_name" class="form-control" placeholder="Enter Variation Name" value="<?=isset($variation)?$variation->variation_name:''?>">
                </div>
                <div class="form-group">
              <label for="currency">Tour Currency</label>
              <select required name="currency" id="currency" class="form-control">
                <option value="0">US Dollar</option>
                <option value="2">EURO</option>
                <option value="1">British Pound</option>
                <option value="3">Australian Dollar</option>
                <option value="5">Singapore Dollar</option>
                <option value="4">Canadian Dollar</option>
                <option value="6">Hong Kong Dollar</option>
                <option value="8">Indian Rupees</option>
              </select>
            </div>
                <div class="row">
                  <div class="col-lg">
                    <label for="sun" class="">
                      <input type="checkbox" value="1" name="sun" id="sun" class="mr-2">
                      Sunday
                    </label>
                  </div>
                  <div class="col-lg">
                    <label for="mon" class="">
                      <input type="checkbox" value="1" name="mon" id="mon" class="mr-2">
                      Monday
                    </label>
                  </div>
                  <div class="col-lg">
                    <label for="tue" class="">
                      <input type="checkbox" value="1" name="tue" id="tue" class="mr-2">
                      Tuesday
                    </label>
                  </div>
                  <div class="col-lg">
                    <label for="wed" class="">
                      <input type="checkbox" value="1" name="wed" id="wed" class="mr-2">
                      Wednesday
                    </label>
                  </div>
                  <div class="col-lg">
                    <label for="thu" class="">
                      <input type="checkbox" value="1" name="thu" id="thu" class="mr-2">
                      Thursday
                    </label>
                  </div>
                  <div class="col-lg">
                    <label for="fri" class="">
                      <input type="checkbox" value="1" name="fri" id="fri" class="mr-2">
                      Friday
                    </label>
                  </div>
                  <div class="col-lg">
                    <label for="sat" class="">
                      <input type="checkbox" value="1" name="sat" id="sat" class="mr-2">
                      Saturday
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-danger card-outline">
              <div class="card-header bg-light">
                <h3 class="card-title">Calander</h3>
              </div>
              <div class="card-body">
                <?php
                $count = 1;
                  $tourist_type = array('ADULT','CHILD','INFANT','FAMILY','SENIOR','YOUTH');
                  foreach ($tourist_type as $person) {?>
                <div class="card card-outline card-warning">
                  <div class="card-header">
                    <h3 class="card-title">
                      <?=ucfirst($person)?>
                      <input type="hidden" name="tourist[<?=$person?>][tourist_type]" value="<?=$person?>">
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-age">Age</label>
                          <input type="text" name="tourist[<?=$person?>][age]" <?=$person=='ADULT'?'required':''?> id="<?=$person?>-age" class="form-control">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-mrp">MRP</label>
                          <input type="text" name="tourist[<?=$person?>][package_mrp]" id="<?=$person?>-mrp" class="form-control mrp">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label>Discount Type</label>
                          <select name="" id="<?=$person?>-discount-type-<?=$count?>" class="form-control discount-type">
                            <option value="0">Percentage</option>
                            <option value="1">Fixed</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-discount">Discount</label>
                          <input type="text" name="tourist[<?=$person?>][package_discount]" id="<?=$person?>-discount" class="form-control discount">
                        </div>
                      </div>
                      <div class="col-md col-12">
                        <div class="form-group">
                          <label for="<?=$person?>-final_price">Final Price</label>
                          <input type="text" name="tourist[<?=$person?>][final_price]" id="<?=$person?>-final_price" class="form-control final_price">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                  <?php $count++; } ?>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>

        <?php } else { ?>
        <div class="card">
          <!-- Left col -->
          <div class="card-header card-outline card-orange">
            <h3 class="card-title">
              All Packages
            </h3>
            <!--<div class="card-tools">-->
            <!--  <a href="tour-pricing?action=add-package" class="btn btn-xs btn-success px-2">Add New</a>-->
            <!--</div>-->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="card card-success card-outline">
              <div class="card-header py-2">
                <h3 class="card-title">
                  Package Variation
                </h3>
                <div class="card-tools">
                  <a href="tour-pricing?action=add-package" class="btn btn-xs btn-success px-2">Add New</a>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped mb-0 table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="5%">S.No</th>
                        <th>Variation Name</th>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $count = 1;
                      
                      foreach ($variations as $package) { ?>
                        <tr>
                          <td><?=$count++?></td>
                          <td><?=$package->variation_name?></td>
                          <td><?=$package->sun?'Active':'Deactive'?></td>
                          <td><?=$package->mon?'Active':'Deactive'?></td>
                          <td><?=$package->tue?'Active':'Deactive'?></td>
                          <td><?=$package->wed?'Active':'Deactive'?></td>
                          <td><?=$package->thu?'Active':'Deactive'?></td>
                          <td><?=$package->fri?'Active':'Deactive'?></td>
                          <td><?=$package->sat?'Active':'Deactive'?></td>
                          <td>
                            <a href="tour-packages?id=<?=$package->id?>&action=view" class="btn btn-warning btn-sm"><i class="fa-sm fa fa-eye fa-fw"></i></a>
                            <a href="tour-packages?id=<?=$package->id?>" class="btn btn-info btn-sm"><i class="fa-sm fa fa-pen fa-fw"></i></a>
                            <a href="<?=base_url('Abrar/remove_package/'.$package->variation_id)?>" class="btn btn-danger btn-sm remove-btn"><i class="fa-sm fa fa-trash fa-fw"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card card-success card-outline">
              <div class="card-header py-2">
                <h3 class="card-title">
                  Package Season
                </h3>
                <div class="card-tools">
                  <a href="tour-calendar-write" class="btn btn-xs btn-success px-2">Add New</a>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped mb-0 table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="5%">S.No</th>
                        <th width="">Date</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = 1;
                      $calendars = $this->tours->calendars();
                      foreach ($calendars as $calendar) { ?>
                        <tr>
                          <td><?=$count++?></td>
                          <td>
                            Form 
                            <span class="badge badge-success">
                            <?=date('d-m-Y', strtotime($calendar->date_from))?></span>
                            To
                            <span class="badge badge-danger">
                            <?=date('d-m-Y', strtotime($calendar->date_to))?></span>
                          </td>
                          <td>
                            <a href="tour-calendar-write?id=<?=$calendar->calendar_variation?>&action=view" class="btn btn-warning btn-sm"><i class="fa-sm fa fa-eye fa-fw"></i></a>
                            <a href="tour-calendar-write?id=<?=$calendar->calendar_variation?>" class="btn btn-info btn-sm"><i class="fa-sm fa fa-pen fa-fw"></i></a>
                            <a href="<?=base_url('Abrar/remove_calendar/'.$calendar->calendar_variation)?>" class="btn btn-danger btn-sm"><i class="fa-sm fa fa-trash fa-fw"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>
      
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  
