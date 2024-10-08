
<main>
  <section class="position-relative">
    <div class="position-relative">
        <div class="slides-header">
          <?php 
    
          $banners =$this->db->where('location', 'banner')->get('gallery')->result();
    
          foreach ($banners as $img) {?>
            <img src="<?=base_url('dist/uploads/'.$img->images)?>" alt="" class="w-100 object-cover-center" style="min-height:600px;max-height:700px" >
            <img src="<?=base_url('dist/uploads/'.$img->images)?>" alt="" class="w-100 object-cover-center" style="min-height:600px;max-height:700px" >
          <?php }?>
        </div>
        <div class="text-center text-white brand-text d-block w-100 d-lg-none position-absolute center" style="text-shadow:0 0 4px black,0 0 4px black,0 0 4px black">
            <h2 class="font-1">Travel Made Simple</h2>
            <span class="font-1"><b>With</b></span>
            <h1 class="font-1 font-weight-bold mb-0">Hop On Hop Off Barcelona</h1>
        </div>
    </div>
    <!-- <div class="position-absolute right-0 top-0 bottom-0 left-0" style="background:#ff000088"></div> -->
    <div class="container-fluid px-lg-5 booking-area">

      <div class="row py-lg-5 py-2">
        <div class="col-lg-4 mb-2 mb-lg-0">
          <form class="rounded bg-dark" name="booking-form" action="<?=base_url('Checkout/addToCart')?>" method="POST">
            <div class="card-body">
              <h5><?=$tour->name?></h5>
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
                  <input <?=$count==1?'checked':''?> type="radio" name="package" data-var_id="<?=$package[0]->variation_id?>" required class="mr-2 inputs" id="package-<?=$count?>" value="<?=$package[0]->variation_id?>">
                  <?=$package[0]->variation?>
                </label>
              </div>
              <?php } ?>
              <div class="form-group card bg-danger">
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input required type="text" value="<?=!empty($this->session->userdata('traveling-date'))? $this->session->userdata('traveling-date') : ''?>" name="traveling-date" class="form-control inputs datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker">
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
                <?php
                //no uses
                foreach ($packages[0] as $price) 
                {
                  if($price->age){

                      if (strtolower($price->tourist_type) == 'adult') {
                        $class="order-1";
                      }
                      if (strtolower($price->tourist_type) == 'child') {
                        $class="order-2";
                      }
                      if (strtolower($price->tourist_type) == 'family') {
                        $class="order-3";
                      }
                      if (strtolower($price->tourist_type) == 'infant') {
                        $class="order-4";
                      }
                      if (strtolower($price->tourist_type) == 'senior') {
                        $class="order-5";
                      }
                      if (strtolower($price->tourist_type) == 'youth') {
                        $class="order-last";
                      }
                  ?>
                  <div class="input-row">
                    <h6 class=""><?=ucfirst(strtolower($price->tourist_type))?> (<?=$price->age?>)</h6>
                    <div class="input">
                      <button type="button" class="minus incrmt btn btn-outline-danger" aria-label="Decrease by one" disabled>
                        <i class="fa fa-minus" style="font-size:.5em"></i>
                      </button>
                      <div class="number dim">0</div>
                      <input type="hidden" value="0" id="<?=strtolower($price->tourist_type)?>" name="traveller[<?=strtolower($price->tourist_type)?>]" class="numberInput">
                      <button type="button" class="plus incrmt btn btn-danger" aria-label="Increase by one">
                        <i class="fa fa-plus" style="font-size:.5em"></i>
                      </button>
                    </div>
                  </div>
                <?php 
                echo form_hidden('row['.strtolower($price->tourist_type).']', $price->id);
                }
              }?>
              </div>
              <script id="passengers-code">
              </script>       
              <div class="form-group">
                <button class="btn btn-lg btn-success btn-block">Book Now</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-8 pl-lg-4" id="right-header">
          <div class="text-center text-white brand-text d-none d-lg-block" style="text-shadow:0 0 4px black,0 0 4px black,0 0 4px black">
            <h2 class="display-4 font-1">Travel Made Simple</h2>
            <span class="font-1"><b>With</b></span>
            <h1 class="display-3 font-1 font-weight-bold mb-0">Hop On Hop Off Barcelona</h1>
          </div>
          <div class="d-flex flex-column pricing-card">
            <div class="card text-light mb-0 mt-auto" style="background-color: #00000088;">
              <div class="card-body p-md-4 px-2 ">
                <div class="row mb-4 no-gutters ">
                  <div class="col-3 text-center d-flex order-first">
                    <h4 class="text-capitalize px-1 m-auto font-weight-bold text-sm-xs-h">Ticket Options</h4>
                  </div>
                  <?php 
                  $class = 3;
                  foreach (max($packages) as $package) { 
                      ?>
                    
                    <div class="col d-flex <?=strtolower($package->tourist_type)?> text-center">
                      <span class="m-auto">
                        <h6 class="text-capitalize mb-0 font-weight-bold text-sm-xs-h "><?=ucfirst(strtolower($package->tourist_type))?></h6>
                      </span>
                    </div>
                <?php }?>
                </div>
                  <?php 
                  $class = 3;
                  foreach ($packages as $option) { 
                    echo'<div class="row mt-4  no-gutters rounded font-weight-bold" style="background:#000040;">
                          <div class="col-3 px-1 text-center d-flex order-first py-2">
                            <h5 class="m-auto  text-sm-xs-h"><b>'.str_replace('City Sightseeing Barcelona - ','', $option[0]->variation).'</b></h5>
                          </div>';
                      foreach ($option as $package) { 
                        if (strtolower($package->tourist_type) == 'adult') {
                          $class="order-1";
                        }
                        if (strtolower($package->tourist_type) == 'child') {
                          $class="order-2";
                        }
                        if (strtolower($package->tourist_type) == 'family') {
                          $class="order-3";
                        }
                        if (strtolower($package->tourist_type) == 'infant') {
                          $class="order-4";
                        }
                        if (strtolower($package->tourist_type) == 'senior') {
                          $class="order-5";
                        }
                        if (strtolower($package->tourist_type) == 'youth') {
                          $class="order-last";
                        }
                      ?>
                    
                    <div class="col d-flex text-center <?=$class?> <?=strtolower($package->tourist_type)?>">
                      <?php 
                      if($package->age){
                      if(intval($package->package_discount)){?>
                      <span class="m-auto py-1">
                        <span class="text-warning text-sm-xs">
                          <del><?=currency_icon($this->session->currency)?>
                          <?=convert_Currency($package->package_mrp, convert_to($package->currency), convert_to($this->session->currency))?></del>
                        </span><br>
                        <span class="text-sm-xs <?=strtolower($package->tourist_type)?>-price" data-price="<?=convert_Currency($package->final_price, convert_to($package->currency), convert_to($this->session->currency))?>"><?=currency_icon($this->session->currency)?>
                          <?=convert_Currency($package->final_price, convert_to($package->currency), convert_to($this->session->currency))?>
                        </span>
                      </span>
                      <?php } else{ ?>
                       <span class="m-auto py-1">
                        <span class="text-sm-xs <?=strtolower($package->tourist_type)?>-price" data-price="<?=convert_Currency($package->final_price, convert_to($package->currency), convert_to($this->session->currency))?>"><?=currency_icon($this->session->currency)?>
                          <?=convert_Currency($package->final_price, convert_to($package->currency), convert_to($this->session->currency))?>
                        </span>
                      </span>
                      <?php } } else{?>
                      <span class="m-auto py-1">
                        <span class="text-sm-xs <?=strtolower($package->tourist_type)?>-price" data-price="-">&#45;
                        </span>
                      </span>
                      <?php } ?>
                    </div>
                  <?php }
                    $class = '' ;
                  echo '</div>';
                }?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="" style="background-image: url(<?=base_url('dist/img/bg.png')?>);background-repeat-x:repeat;background-size: 100% 100%;">
      <div class="container-fluid py-3 px-lg-5">
        <div class="slides-4 text-light pb-3 whyus">
          <?php foreach ($this->logics->whyUs() as $value) {
          echo "<div class='text-center'>
        <i class='fa fa-check-circle mr-1'></i>$value->title</div>";
          }?>
        </div>
        <div class="row border shadow-sm no-gutters">
          <div class="col-md-6 mb-4 mb-lg-0">
            <div class="slider-for bg-white">
              <?php
              $images = $this->db->where('location', 'tour')->get('gallery')->result();
                foreach ($images as $img) { ?>
                <img src="./dist/uploads/<?=$img->images?>" alt="" height="400" class="mw-100 img-sm-auto">
                <?php } ?>
            </div>
            <div class="slider-nav mb-4">
              <?php
              $images = $this->db->where('location', 'tour')->get('gallery')->result();
                foreach ($images as $img) { ?>
                <img src="./dist/uploads/<?=$img->images?>" alt="" class="mw-100 border p-1">
                <?php } ?>
            </div>
          </div>
          <div class="col-md-6 bg-light py-lg-4 px-lg-5 p-2">
            <?=$this->logics->aboutContent()->heading?>
            <?=$this->logics->aboutContent()->content?>
          </div>
        </div>
      </div>
    </section>

  <section>

  
  <section class="pb-4">
    <div class="container-fluid px-lg-5 d-none d-lg-block">
      <div class="mx-n2">
        <nav class="navbar navbar-expand tour-details" data-toggle="sticky-onscroll">
          <ul class="navbar-nav font-weight-bold nav-fill nav-pills my-tab w-100 justify-content-between">
            <li class="nav-item">
              <a href="#hightlights" class="nav-link active">Highlights</a>
            </li>
            <li class="nav-item">
              <a href="#overview" class="nav-link">Overview</a>
            </li>
            <li class="nav-item">
              <a href="#description" class="nav-link">Description</a>
            </li>
            <li class="nav-item">
              <a href="#schedule" class="nav-link">Schedule</a>
            </li>
            <li class="nav-item">
              <a href="#inclusions" class="nav-link">Inclusions</a>
            </li>
            <li class="nav-item">
              <a href="#exclusions" class="nav-link">Exclusions</a>
            </li>
            <li class="nav-item">
              <a href="#important-info" class="nav-link">Important Info</a>
            </li>
            <li class="nav-item">
              <a href="#cancellation-policy" class="nav-link">Cancellation Policy</a>
            </li>
            <li class="nav-item">
              <a href="#tour-routes" class="nav-link">Routes</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="container-fluid px-lg-5 mt-3">
      <?php if ($tour->highlights) { ?>
      <div id="hightlights" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Highlights
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->highlights?>
        </div>
      </div>
      <?php }if ($tour->overview) { ?>
      <div id="overview" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Overview
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->overview?>
        </div>
      </div>
      <?php }if ($tour->description) { ?>
      <div id="description" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Description
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->description?>
        </div>
      </div>
      <?php }if ($tour->schedule) { ?>
      <div id="schedule" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Schedule
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->schedule?>
        </div>
      </div>
      <?php }if ($tour->inclusion) { ?>
      <div id="inclusions" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Inclusions
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->inclusion?>
        </div>
      </div>
      <?php }if ($tour->exclusion) { ?>
      <div id="exclusions" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Exclusions
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->exclusion?>
        </div>
      </div>
      <?php }if ($tour->important) { ?>
      <div id="important-info" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Important Info
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->important?>
        </div>
      </div>
       <?php }if ($tour->cancellation) { ?>
      <div id="cancellation-policy" class="card  card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Cancellation Policy
          </h3>
        </div>
        <div class="card-body">
          <?=$tour->cancellation?>
        </div>
      </div>
      <?php } ?>
      <div id="tour-routes" class="card card-danger">
        <div class="card-header py-2">
          <h3 class="card-title font-weight-bold">
            Tour Routes
          </h3>
        </div>
        <div class="card-body">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            
            
            <?php
            
            $routes = $this->db->get('tour_routes')->result();
            
            foreach($routes as $route){ ?>
            <li class="nav-item font-weight-bold">
                <a class="rounded d-block px-2 py-1 routes-tab mr-1 mr-md-2" style="color:<?=$route->color?>;border:1px solid <?=$route->color?>" data-color="<?=$route->color?>" id="<?=$route->name?>-tab" data-toggle="pill" href="#<?=$route->name?>" role="tab" aria-controls="<?=$route->name?>" aria-selected="true"><i class="<?=$route->icon?> mr-1"></i><span class=""><?=$route->name?></span></a>
            </li>
            <?php }?>
          </ul>
          <div class="tab-content px-2" id="pills-tabContent">
              <?php
            
            $routes = $this->db->get('tour_routes')->result();
            
            foreach($routes as $route){ ?>
            <div class="tab-pane fade show" id="<?=$route->name?>" role="tabpanel" aria-labelledby="<?=$route->name?>-tab">
              <div class="row border rounded-pill mb-3 text-white" style="background:<?= $route->color?>">
                <div class="col-sm-4 text-center">
                  Schedule: <?=$route->schedule?>
                </div>
                <div class="col-sm-4 text-center">
                  Loop: <?=$route->loop_time?>
                </div>
                <div class="col-sm-4 text-center">
                  Frequency: <?=$route->frequency?>
                </div>
              </div>
              <div class="row">
                  <div class="col-lg-6">
                      <?=$route->content?>
                  </div>
                  <div class="col-lg-6">
                      <img src="<?=base_url('dist/uploads/'.$route->map)?>" class="w-100 object-cover-center" style="max-height:600px">
                  </div>
              </div>
            </div>
            <?php }?>  
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bg-white">
    <div class="container-fluid px-lg-5 p-4 py-lg-4 mx-lg-n2">
      <div class="text-center">
         <?php $smtour =$this->db->where('location', 'similar-tours')->get('headings')->row();?>
        <?=$smtour->heading?>
      </div>
        <div class='slides-4 my-4'>
            <?php
            $tours = $this->db->get('similar_tours')->result();
            foreach($tours as $tour){ ?>
            
            <div class="h-100 px-2">
                <a href="<?=$tour->url?>" class="card overflow-hidden text-dark">
                    <img src="<?=base_url('dist/uploads/').$tour->image?>" alt="<?=$tour->image?>" class="object-cover-center rounded-top hover-zoom" height="200">
                    <div class="card-body p-2">
                        <p class="card-text">
                            <b><?=$tour->title?></b><br>
                            <?php if($tour->activities) { ?>
                            <b>Total Activities: </b><?=$tour->activities?>
                            <?php } ?>
                        </p>
                    </div>
                </a>
            </div>
            
            <?php } ?>
            
            
        </div>
        <div class="text-center">
            <a href="<?=$smtour->url?>" class="btn btn-warning"><?=$smtour->button?></a>
        </div>
    </div>
  </section>
  <section class="" id="testimonials">
    <div class="container-fluid px-lg-5 py-4">
      <div class="text-center">
        <h2 class="mb-4"><?=$this->db->where('location', 'testimonial')->get('headings')->row()->heading;?></b></h2>
      </div>
      <div class="row">
        <div class="col-lg-5 border-right">
          <div class="">
            <div class="">
              <h4 class="mb-4"><b>Write a review</b></h4>
              <form action="<?=base_url('Welcome/testimonial')?>" method="post">
                <div class="form-group">
                  <input type="text" name='test_name' class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" name="test_email" class="form-control"  placeholder="Email">
                </div>
                <div class="form-group">
                  <textarea name="test_mes" id="" cols="30" rows="4"  placeholder="Comment" class="form-control"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                  <input type="hidden" name="test_dte" value="<?=date('Y-m-d')?>">
                  <div class="rating" data-rating="0">
                    <label>
                      <input type="radio" required name="test_rating" value="1">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="2">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="3">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>   
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="4">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                    <label>
                      <input type="radio" required name="test_rating" value="5">
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span class="icon hover-pop"><i class="fa fa-star" aria-hidden="true"></i></span>
                    </label>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-success">Submit Review</button>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-7 border-left px-4" id="testimonials">
          <div class="slides-1">
          <?php
          $testimonials = $this->logics->testimonial('',1);
          foreach ($testimonials as $test) {?>
          <div class="p-lg-3 h-100">
            <div class="card h-100 disbled bg-gradient-danger">
              <div class="card-body">
                <h4><?=ratings($test->test_rating)?></h4>
              <p><?=$test->test_mes?></p>
              <b><?=$test->test_name?></b><br>
              <span><?=date("jS M, Y", strtotime($test->test_dte))?></span>
              <span class="display-3 position-absolute right-1 bottom-1"><i style="opacity:.5" class="fa fa-quote-right"></i></span>
              </div>
            </div>
          </div>
          <?php } ?>
          
          </div>
        </div>
      </div>
    
    </div>
  </section>
  <section style="background:url(<?=base_url('dist/img/newsletter-banner.jpeg')?>) center / cover no-repeat fixed ">
    <div style="background-color: #00000088;color:white">
      <div class="container py-5 text-center">
        <h4>SUBSCRIBE FOR UPDATES & LATEST OFFERS</h4>
        <form action="<?=base_url('Welcome/subscribe')?>" class="col-lg-6 mx-auto mt-4" method="POST">
          <div class="form-group">
            <input type="email" name="email" id="sub_email" class="form-control rounded-pill p-4" placeholder="Email">
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-lg rounded-pill">Subscribe Now!</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>

<script>
    
    (function()
    {
        var psngr = ['adult','child','family','infant','senior','youth'];
        
            $.each(psngr, function(i){
                var cls = '.'+psngr[i]+'-price';
                
                var value = $("."+psngr[i]+"").find(""+cls+"").data('price');
                
                if(String(value) === String('-'))
                {
                    disble_price = true;
                }
                else
                {
                    disble_price = false;
                }
                // console.log(disble_price);
                if(disble_price == true)
                {
                    $("."+psngr[i]+"").remove();
                }
            });
            
    }())
    
</script>