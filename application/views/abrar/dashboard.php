
    <?php $orders = $this->db->where('order_status', 'Success')->get('payments')->result(); 
    
        $total = 0;
        foreach ($orders as $order)
        {
            $total += convert_Currency($order->amount, $order->currency, 'EUR');
        }
    ?>
    <style>
          .custom-select
          {
            background:none;
          }
        </style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=sizeof($orders)?></h3>

                <p>Total Bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fa fa-euro-sign fa-sm mr-2"></i><?=$total?></h3>

                <p>Total Sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$this->db->get('customer')->num_rows()?></h3>

                <p>Total Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
        </div>
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Latest Bookings
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="table-responsive card-body">
                <table class="table table-striped table-bordered table-hover table_id" id="table_id">
                  <thead>
                    <tr>
                      <th>Booking ID</th>
                      <th>Options Booked</th>
                      <th>Lead Passenger Name</th>
                      <th>Total Passangers</th>
                      <th>Amount</th>
                      <th>Booking Date</th>
                      <th>Travel Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $customers = $this->db->where('order_status', 'Success')->get('payments')->result();
                    foreach ($customers as $customer) {
                        $user = $this->db->where('session_id', $customer->session_id)->get('purchased_customers')->row();
                        $tour = $this->db->where('session_id', $customer->session_id)->order_by('travelling_date ASC')->get('bookings')->row();
                    ?>
                      <tr>
                        <td><?=$customer->order_id?></td>
                        
                        <td><?=$tour->name?></td>
                        <td><?=$user->billing_name?></td>
                        <td class="text-sm">
                            <?php 
                            $total = 0;
                            $tourist = ['adult', 'child' , 'family', 'infant', 'senior', 'youth'];
                            foreach ($tourist as $value) 
                            {
                              $total += $tour->$value;
                            }
                            echo''.$total.' Passengers<br>';
                            echo '(';
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
                            echo ')';
                          ?>
                        </td>
                        <td><?=$customer->amount?> <small>(<?=$customer->currency?>)</small></td>
                        <td><?=date('d-m-Y', strtotime($tour->checkout_date))?></td>
                        <td><?=date('d-m-Y', strtotime($tour->travelling_date))?></td>
                        
                        <td><a href="javascript:void(0)" onclick="popup('../order_successful?id=<?=$customer->session_id?>')" class="btn btn-info btn-xs"><i class="fa fa-print"></i></a>
                            <a href="<?=base_url('Abrar/removebooking/'.$customer->session_id)?>" class="btn btn-danger remove-btn btn-xs"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
               <div class="card-footer text-center">
                <a href="booking-management" class="uppercase">View All Bookings</a>
              </div>
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-12 connectedSortable">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-user-plus mr-1"></i>
                  New Customers
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table_id">
                      <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Customer Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th width="12%">Date Added</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $count = 1;
                        $customers = $this->db->order_by('id desc')->get('customer')->result();
                        foreach ($customers as $customer) {?>
                          <tr>
                            <td><?=$count++?></td>
                            <td><?=$customer->name?></td>
                            <td><?=$customer->email?></td>
                            <td><?=$customer->status ? '<span class="badge badge-success">Verified</span>':'<span class="badge badge-warning">Pending</span>'?></td>
                            <td><?=date('d-m-Y', strtotime($customer->date_add))?></td>
                            <td><a href="<?=base_url('Abrar/remove/'.$customer->id.'/customer')?>" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.container-fluid -->
  <?=copyrights()?>
  <!-- /.content -->
  <script>
    function popup(url) 
    {
        var width  = 1000;
        var height =700;
        var left   = (screen.width  - width)/2;
        var top    = (screen.height - height)/2;
        //var left   = 0;
        // var top    = 0;
        var params = 'width='+width+', height='+height;
        params += ', top='+top+', left='+left;
        params += ', directories=no';
        params += ', location=no';
        params += ', menubar=no';
        params += ', resizable=no';
        params += ', scrollbars=yes';
        params += ', status=no';
        params += ', toolbar=no';
        newwin=window.open(url,'windowname5', params);
        if (window.focus) {newwin.focus()}
        return false;
    }

  </script>