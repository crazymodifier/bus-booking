<main>
    <!--$account->id-->
    <?php
    $account = $this->db->where('email', $this->session->email)->or_where('password', md5($this->session->password))->get('customer')->row();
   
    ?>
    <div class="container py-lg-5 p-2">
        <div class="row">
            <div class="col-lg-3">
                <img class="w-100" src="<?=base_url('dist/img/profilepic.jpeg')?>">
                <p class="mt-3"><b>Name:</b> <?=$account->name?> <br> <b>Email:</b> <?=$account->email?></p>
            </div>
            <div class="col-lg-9">
                
                <ul class="nav nav-pills nav-fill mb-3" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active border" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upcoming Tours</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link border" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">All Tours</a>
                  </li>
                </ul>
                <div class="bg-white">
                    <div class=>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                              <div class="table-responsive">
                                  <table class="table table-bordered mb-0">
                                      <thead>
                                          <tr>
                                              <th>S. No.</th>
                                              <th>Tour Name</th>
                                              <th>Booking Date</th>
                                              <th>Travel Date</th>
                                              <th>Passangers</th>
                                              <th>Voucher</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                         $count=1;
                                         $bookings = $this->db->where('customer_id', $account->id)->where('travelling_date >=', date('Y-m-d'))->get('bookings')->result();
                                         if($bookings)
                                         {
                                             foreach($bookings as $tour)
                                             {?>
                                                <tr>
                                                  <td><?=$count++?></td>
                                                  <td><?=$tour->name?></td>
                                                  <td><?=$tour->travelling_date?></td>
                                                  <td><?=$tour->travelling_date?></td>
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
                                                  <td><a href="javascript:void(0)" onclick="popup('../order_successfull?id=5356033818')" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></a></td>
                                              </tr> <?php
                                             }
                                         }else {
                                        ?>
                                        <tr><td colspan="6">No tour found</td></tr>
                                        <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="table-responsive">
                                  <table class="table table-bordered mb-0">
                                      <thead>
                                          <tr>
                                              <th>S. No.</th>
                                              <th>Tour Name</th>
                                              <th>Booking Date</th>
                                              <th>Travel Date</th>
                                              <th>Passangers</th>
                                              <th>Voucher</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                         $count=1;
                                         $bookings = $this->db->where('customer_id', $account->id)->get('bookings')->result();
                                         if($bookings)
                                         {
                                             foreach($bookings as $tour)
                                             {?>
                                                <tr>
                                                  <td><?=$count++?></td>
                                                  <td><?=$tour->name?></td>
                                                  <td><?=$tour->travelling_date?></td>
                                                  <td><?=$tour->travelling_date?></td>
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
                                                  <td><a href="javascript:void(0)" onclick="popup('../order_successfull?id=<?=$tour->session_id?>')" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></a></td>
                                              </tr> <?php
                                             }
                                         }else {
                                        ?>
                                        <tr><td colspan="6">No tour found</td></tr>
                                        <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><script>
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
</main>