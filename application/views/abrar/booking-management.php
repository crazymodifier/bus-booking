    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <style>
          .custom-select
          {
            background:none;
          }
        </style>
        <div class="card">
          <!-- Left col -->
          <div class="card-header py-2">
            <h3 class="card-title">
              All Bookings
            </h3>
            <span class="card-tools"><a href="<?=base_url('Exporting/export_exl')?>" class="btn btn-xs btn-success px-2">Export</a></span>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table_id">
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
                        <td><?=date('d-m-Y',strtotime($tour->checkout_date))?></td>
                        <td><?=date('d-m-Y',strtotime($tour->travelling_date))?></td>
                        
                        <td><a href="javascript:void(0)" onclick="popup('../order_successful?id=<?=$customer->session_id?>')" class="btn btn-info btn-xs"><i class="fa fa-print"></i></a>
                            <a href="<?=base_url('Abrar/removebooking/'.$customer->session_id)?>" class="btn btn-danger remove-btn btn-xs"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
      
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
  
