<?php
// define('DB_SERVER','sql368.main-hosting.eu');
// define('DB_USER','u332279078_hohobt'); hoponhop_barcelona
// define('DB_PASS' ,'UYdQosQ8!Xi');
// define('DB_NAME','u332279078_hohobt');

define('DB_SERVER','localhost');
define('DB_USER','hoponhop_barcelona'); 
define('DB_PASS' ,'hoponhop_barcelona');
define('DB_NAME','hoponhop_barcelona');
  $con= mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME );
  // Check connection
  if (!$con)
  {
    echo "Failed to connect to MySQL";
  }

  $record_tour = mysqli_query($con, 'SELECT * FROM tours_hop WHERE city_id = 00056');

  if(@mysqli_num_rows($record_tour)>0)
  {
    $count = 1;
    while($row_city=mysqli_fetch_object($record_tour))
    {
      $display=$row_city->display;
      $tour_feature=$row_city->tour_feature;
      $city_id=$row_city->city_id;	
      $tour_id=$row_city->id;
      mysqli_query($con, "UPDATE hop_package SET `city_id` = $city_id WHERE tour_id='$tour_id'");
      if($display==1)
      {
        $sql_currency="select * from hop_package WHERE tour_id='$tour_id'";
        $record_currency=mysqli_query($con,$sql_currency);
        if(@mysqli_num_rows($record_currency)>0)
        {
          if($row_currency=mysqli_fetch_object($record_currency))
          {
            $currency=$row_currency->currency;
            $blocked_date=$row_currency->blocked_date;
          }
        }
				// 	hiding date tours
				$hide = '';
        if($blocked_date!="")
        {
          $arr_date = explode(',', $blocked_date);
          $arr_date_length=count($arr_date);
          $entire_block=0;
          for($t=0;$t<=$arr_date_length;$t++)
          {
            if (strpos($arr_date[$t],"To") !== false) 
            {
              $parts= explode('To', $arr_date[$t]);
              $one1 = $parts[0];
              $two1 = $parts[1];
              
              $one1=str_replace(' ', '', $one1);
              $two1=str_replace(' ', '', $two1);

              if(strtotime($date) >= strtotime($one1) && strtotime($date) <= strtotime($two1))
              {
                $entire_block=1;
                break;
              }
            }
            else
            {
              $one1="";    
              $two1=""; 
              for($k=0;$k<$arr_date_length;$k++)
              {
                $arr_date1=$arr_date[$k];
                $arr_date1=str_replace(' ', '', $arr_date1);
                if($date==$arr_date1)
                {
                  $hide = 'd-non';
                }
              }
            }	
          }
        }
								    
				$sql_discount="select * from hop_package WHERE tour_id='$tour_id' AND tourist_type='ADULT'";
				$record_discount=mysqli_query($con,$sql_discount);
        if(@mysqli_num_rows($record_discount)>0)
        {
          if($row_discount=mysqli_fetch_object($record_discount))
          {
            //$currency=$row_discount->currency;
            $package_discount=$row_discount->package_discount;
          }
				}
        if($package_discount>0){}
        else
        {
          $sql_discount="select * from hop_package WHERE tour_id='$tour_id' AND tourist_type='FAMILY'";
          $record_discount=mysqli_query($con,$sql_discount);
          if(@mysqli_num_rows($record_discount)>0)
          {
            if($row_discount=mysqli_fetch_object($record_discount))
            {
              //$currency=$row_discount->currency;
              $package_discount=$row_discount->package_discount;
            }
          }
				}
				$color="";
        $today=date('Y-m-d');
        if($package_discount>0)
        {
          $color="color:red";
          $variation_status=0;
          $sql_price=mysqli_query($con, "SELECT MIN(package_mrp) AS min FROM hop_package AS hp inner join package_variation AS pv ON hp.variation_id=pv.variation_id WHERE hp.tour_id='$tour_id' AND hp.tourist_type='ADULT' AND hp.date_to >= '$today' AND hp.date_from <= '$today' AND pv.status='$variation_status'");
          $row_price = mysqli_fetch_array( $sql_price );
          $final_price = $row_price['min'];
          
          $sql_price1=mysqli_query($con, "SELECT MIN(final_price) AS min FROM hop_package AS hp inner join package_variation AS pv ON hp.variation_id=pv.variation_id WHERE hp.tour_id='$tour_id' AND hp.tourist_type='ADULT' AND hp.date_to >= '$today' AND hp.date_from <= '$today' AND pv.status='$variation_status'");
          
          $row_price1 = mysqli_fetch_array( $sql_price1 );
          $dis_price = $row_price1['min'];
        }
        else
        {
          $sql_price=mysqli_query($con, "SELECT MIN(final_price) AS min FROM hop_package AS hp inner join package_variation AS pv ON hp.variation_id=pv.variation_id WHERE hp.tour_id='$tour_id' AND hp.tourist_type='ADULT' AND hp.date_to >= '$today' AND hp.date_from <= '$today' AND pv.status='$variation_status'");
          $row_price = mysqli_fetch_array( $sql_price );
          $final_price = $row_price['min'];
        }
          mysqli_query($con, "UPDATE tours_hop SET tourPrice = $dis_price WHERE id = $tour_id");
        ?>
				<div class="h-100 px-2">
          <a href="tour-<?php echo $row_city->tour_url;?>" class="card">
            <img src="http://hop-on-hop-off-bus-tours.com/uploaded/<?php echo $row_city->img?>" alt="<?php echo $row_city->name?>" class="object-cover-center sm-h-100 rounded-top w-100" height="220" />
            <div class="card-body">
              <h6><?=$row_city->name?></h6>
                <?php $row_city->ratings?>
                <p class="text-secondary card-text"><?php echo $row_city->short_desc;?></p>
            </div>
          </a>
        </div>
			<?php
			}
		}
	}





if(isset($_POST['fetchData']))
{
    // Filter By Category
    if(isset($_POST['city_id']))
    
    {
       
        $city_id = $_POST['city_id'];
        $date = isset($_POST['date'])?$_POST['date']:date("Y:m:d");
        $sql_tour = 'SELECT * FROM tours_hop WHERE city_id LIKE "%'.sprintf('%05d',$city_id).'%"';
        if(isset($_POST['rat']))
        {
            $rat_filter  = implode("','",$_POST['rat']);
            $sql_tour.=" AND ratings IN('".$rat_filter."')";
        }
        
        if(isset($_POST['cat']))
        {
            $cat_filter  = implode("','",$_POST['cat']);
            $sql_tour.=" AND ( category LIKE '%0%'";
            
            foreach($_POST['cat'] as $cat)
            {
                $sql_tour.=" OR category LIKE '%".$cat."%'";
            }
            $sql_tour.=")";
            // exit;
        }
        if(isset($_POST['price']))
        {
            
            $cat_filter  = $_POST['price'];
            $sql_tour.=" ORDER BY CAST(tourPrice AS DECIMAL(12,2)) $cat_filter";
        }
        // if($date)
        // {
        //     $date  = implode("','",$date);
        //     $sql_tour.=" AND blockDate NOT IN('".$date."')";
        // }
        
		            $record_tour=mysqli_query($con,$sql_tour);
		            if(@mysqli_num_rows($record_tour)>0)
		            {
		                $count = 1;
					    while($row_city=mysqli_fetch_object($record_tour))
					    {
						    $display=$row_city->display;
						    $tour_feature=$row_city->tour_feature;
						    $city_id=$row_city->city_id;	
						    $tour_id=$row_city->id;
						    mysqli_query($con, "UPDATE hop_package SET `city_id` = $city_id WHERE tour_id='$tour_id'");
						    if($display==1){
						        
								$sql_currency="select * from hop_package WHERE tour_id='$tour_id'";
								$record_currency=mysqli_query($con,$sql_currency);
								if(@mysqli_num_rows($record_currency)>0)
								{
								    if($row_currency=mysqli_fetch_object($record_currency))
								    {
								        $currency=$row_currency->currency;
								        $blocked_date=$row_currency->blocked_date;}
									}
								    // 	hiding date tours
								    $hide = '';
								    if($blocked_date!="")
								    {										
                                        $arr_date = explode(',', $blocked_date);
                                        $arr_date_length=count($arr_date);
                                        
                                        $entire_block=0;
                                        for($t=0;$t<=$arr_date_length;$t++)
                                        {
                                             
                                            if (strpos($arr_date[$t],"To") !== false) 
                                            {
                                              $parts= explode('To', $arr_date[$t]);
                                              $one1 = $parts[0];
                                              $two1 = $parts[1];
                                            	
                                              $one1=str_replace(' ', '', $one1);
                                              $two1=str_replace(' ', '', $two1);
                                            
                                            	
                                                if(strtotime($date) >= strtotime($one1) && strtotime($date) <= strtotime($two1))
                                                {
                                                    $entire_block=1;
                                                    break;
                                            	}
                                            }
                                            else
                                            {
                                                $one1="";    
                                                $two1=""; 
                                                for($k=0;$k<$arr_date_length;$k++)
                                                {
                                                    $arr_date1=$arr_date[$k];
                                                    $arr_date1=str_replace(' ', '', $arr_date1);
                                                    if($date==$arr_date1)
                                                    {
                                                        $hide = 'd-non';
                                                    }
                                                     
                                                }
                                               
                                            }	
                                        }
                                    }
								    
									$sql_discount="select * from hop_package WHERE tour_id='$tour_id' AND tourist_type='ADULT'";
									$record_discount=mysqli_query($con,$sql_discount);
									if(@mysqli_num_rows($record_discount)>0){
									    if($row_discount=mysqli_fetch_object($record_discount)){
									        //$currency=$row_discount->currency;
									        $package_discount=$row_discount->package_discount;
									    }
									}
									if($package_discount>0){
									 
									}else{
									    $sql_discount="select * from hop_package WHERE tour_id='$tour_id' AND tourist_type='FAMILY'";
									    $record_discount=mysqli_query($con,$sql_discount);
									    if(@mysqli_num_rows($record_discount)>0){
									        if($row_discount=mysqli_fetch_object($record_discount)){
									            //$currency=$row_discount->currency;
											    $package_discount=$row_discount->package_discount;
											}
                                        }
									    
									}
								 	$color="";
								 	$today=date('Y-m-d');
								 	if($package_discount>0){
								 	    $color="color:red";
								 	    $variation_status=0;
								 	    $sql_price=mysqli_query($con, "SELECT MIN(package_mrp) AS min FROM hop_package AS hp inner join package_variation AS pv ON hp.variation_id=pv.variation_id WHERE hp.tour_id='$tour_id' AND hp.tourist_type='ADULT' AND hp.date_to >= '$today' AND hp.date_from <= '$today' AND pv.status='$variation_status'");
								 	    $row_price = mysqli_fetch_array( $sql_price );
								 	    $final_price = $row_price['min'];
								 	    $sql_price1=mysqli_query($con, "SELECT MIN(final_price) AS min FROM hop_package AS hp inner join package_variation AS pv ON hp.variation_id=pv.variation_id WHERE hp.tour_id='$tour_id' AND hp.tourist_type='ADULT' AND hp.date_to >= '$today' AND hp.date_from <= '$today' AND pv.status='$variation_status'");
								 	    $row_price1 = mysqli_fetch_array( $sql_price1 );
								 	    $dis_price = $row_price1['min'];
								 	}else{
									    $sql_price=mysqli_query($con, "SELECT MIN(final_price) AS min FROM hop_package AS hp inner join package_variation AS pv ON hp.variation_id=pv.variation_id WHERE hp.tour_id='$tour_id' AND hp.tourist_type='ADULT' AND hp.date_to >= '$today' AND hp.date_from <= '$today' AND pv.status='$variation_status'");
									    $row_price = mysqli_fetch_array( $sql_price );
									    $final_price = $row_price['min'];
								 	}
								 	mysqli_query($con, "UPDATE tours_hop SET tourPrice = $dis_price WHERE id = $tour_id");

									?>
									<a href="tour-<?php echo $row_city->tour_url;?>" class="product-<?=$count++?> d-none card mb-4 shadow text-dark fadeInUp wow <?=$hide?>">
									    <div class="row no-gutters p-relative">
									    	<div class="col-lg-4" style="line-height:0;">
									    		<img src="uploaded/<?php echo $row_city->img?>" alt="<?php echo $row_city->name?>" class="object-cover-center sm-h-100 rounded w-100" height="220" />
									    	</div>
									    	<div class="col-lg-8 card border-0 p-3">
									    	    <div class="card-body p-0">
									    		    <h4><?=$row_city->name?></h4>
    												<?php ratings($row_city->ratings);?>
    												<p class="text-secondary margin9"><?php echo $row_city->short_desc;?></p>
    												
    											</div>
												<div class="row mt-2">
													
													<span class="col-12">
													    <b>Duration: </b><span class="text-muted"><?= $row_city->duration;?></span>
													    <span class="btn btn-primary btn-sm rounded float-right d-none m-1 d-md-inline-block">Book Now</span>
													    <br>
													<?php
													if($package_discount>0){ ?>
													<span class="mr-2" style=" <?php echo $color;?>">
													    <small><b>From </b></small>
													    <b style="text-decoration: line-through;">
													<?php }else{ ?>
													<span><small><b>From </b></small>
    													<b>
        													<?php }
        													if(isset($_POST['curreny_type'])){
        													    if($currency==0){	
        													        $from="USD";
        													    }else if($currency==1){
        													        $from="GBP";
        													    }else if($currency==2){
        													        $from="EUR";
        													    }else if($currency==3){
        													        $from="AUD";
        													        
        													    }else if($currency==4){
        													        $from="CAD";	
        													        
        													    }else if($currency==5){
        													        $from="SGD";
        													        
        													    }else if($currency==6){
        													        $from="HKD";	
        													        
        													    }else if($currency==7){
        													        $from="AED";	
        													        
        													    }else if($currency==8){
        													        $from="INR";
        													        
        													    }
        													    
        													}else{
        													    if($currency==0){	
        													        $from="USD";
        													    }else if($currency==1){
        													        $from="GBP";
        													    }else if($currency==2){
        													        $from="EUR";
        													    }else if($currency==3){
        													        $from="AUD";
        													        
        													    }else if($currency==4){
        													        $from="CAD";	
        													        
        													    }else if($currency==5){
        													        $from="SGD";
        													        
        													    }else if($currency==6){
        													        $from="HKD";	
        													        
        													    }else if($currency==7){
        													        $from="AED";	
        													        
        													    }else if($currency==8){
        													        $from="INR";
        													        
        													    }
        													    
        													}
        													if($currency_session==0){ ?>
        													    US <i class="fa fa-sm fa-dollar"></i> 
        													    <?php echo convert_Currency($final_price, $from, $to);?>
        													<?php }else if($currency_session==1){?>
                                    						    <i class="fa fa-sm fa-gbp"></i> 
                                    						    <?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php }else if($currency_session==2){ ?>
                                    						    <i class="fa fa-sm fa-euro"></i> 
                                    						    <?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php }else if($currency_session==3){ ?>
                                    						    AU<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php }else if($currency_session==4){?>
                                    						    CA<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php }else if($currency_session==5){ ?>
                                    						    SG<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php }else if($currency_session==6){ ?>
                                    						    HK<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php }else if($currency_session==7){ ?>
                                    						    AE<?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php }else if($currency_session==8){ ?>
                                    						    <i class="fa fa-sm fa-rupee"></i> 
                                    						    <?php echo convert_Currency($final_price, $from, $to);?>
                                    						<?php } ?>
                                						</b> 
    					
                                                        <?php if($package_discount==0){ ?>	
                                                            <small><b>Onwards</b></small> 
                                                        <?php } ?>
                                                    </span>
                                                    <?php   if($package_discount>0){ ?>						
						                            <span class=""><b>
                                                        <?php
                                                            if(isset($_POST['curreny_type'])){
        													    if($currency==0){	
        													        $from="USD";
        													    }else if($currency==1){
        													        $from="GBP";
        													    }else if($currency==2){
        													        $from="EUR";
        													    }else if($currency==3){
        													        $from="AUD";
        													        
        													    }else if($currency==4){
        													        $from="CAD";													        
        													    }else if($currency==5){
        													        $from="SGD";
        													        
        													    }else if($currency==6){
        													        $from="HKD";	
        													        
        													    }else if($currency==7){
        													        $from="AED";	
        													        
        													    }else if($currency==8){
        													        $from="INR";
        													        
        													    }
        													    
        													}else{
        													    if($currency==0){	
        													        $from="USD";
        													    }else if($currency==1){
        													        $from="GBP";
        													    }else if($currency==2){
        													        $from="EUR";
        													    }else if($currency==3){
        													        $from="AUD";
        													        
        													    }else if($currency==4){
        													        $from="CAD";	
        													        
        													    }else if($currency==5){
        													        $from="SGD";
        													        
        													    }else if($currency==6){
        													        $from="HKD";	
        													        
        													    }else if($currency==7){
        													        $from="AED";	
        													        
        													    }else if($currency==8){
        													        $from="INR";
        													        
        													    }
        													    
        													}
        													if($currency_session==0){ ?>
        													    US <i class="fa fa-sm fa-dollar"></i> 
        													    <?php echo convert_Currency($dis_price, $from, $to);?>
        													<?php }else if($currency_session==1){?>
                                    						    <i class="fa fa-sm fa-gbp"></i> 
                                    						    <?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php }else if($currency_session==2){ ?>
                                    						    <i class="fa fa-sm fa-euro"></i> 
                                    						    <?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php }else if($currency_session==3){ ?>
                                    						    AU<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php }else if($currency_session==4){?>
                                    						    CA<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php }else if($currency_session==5){ ?>
                                    						    SG<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php }else if($currency_session==6){ ?>
                                    						    HK<i class="fa fa-sm fa-dollar"></i> 
                                    						    <?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php }else if($currency_session==7){ ?>
                                    						    AE<?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php }else if($currency_session==8){ ?>
                                    						    <i class="fa fa-sm fa-rupee"></i> 
                                    						    <?php echo convert_Currency($dis_price, $from, $to);?>
                                    						<?php } ?>
                                						</b> <small><b>Onwards</b></small></span>
                                						<?php } ?>
                                						
                                					</span> 
                                					<div class="col-12">
                                					     <span class="btn btn-primary btn-sm rounded mt-2 d-block d-md-none">Book Now</span>
                                					</div>
												</div>
									    	</div>
										</div>
									</a>
						
							<?php
							}
						}
					}
					else
					{
					   echo("<h2 class='p-absolute center-x'>No Tours Found</h2>");
					   //echo(mysqli_error($con));
					   //echo($sql_tour);
					}
    }
}

?>
