  <nav class="navbar px-lg-5 py-0 navbar-expand bg-white border-bottom shadow-lg flex-lg-nowrap flex-wrap" data-toggle="sticky-onscroll">
    <div class="col-lg-2 text-center">
      <a href="<?=base_url()?>"><img src="<?=base_url('dist/img/logo.png')?>" alt="" class="mw-100" height="60"></a>
    </div>
    <?php
     $promo = $this->db->where('status', 'Enable')->order_by('id DESC')->get('coupon')->row();
     if($promo){?>
    <div class="col-lg col-12 d-flex">
      <span class="m-auto border px-4 rounded-pill bg-navy blinking text-sm-xs-h"><b><?=$promo->promo?></b></span>
    </div>
    <?php }?>
    <ul class="col-lg-auto navbar-nav justify-content-center ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link text-lg dropdown-toggle text-dark px-2 text-sm-md" data-toggle="dropdown" href="#">
          <?php $currency_row = $this->db->where('position', $this->session->currency)->get('currencies')->row();?>
          <i class="fa text-sm-md <?=$currency_row->icon?>"></i>
          <?=$currency_row->code?>
        </a>
        <form name='updateCurrency' action="<?=base_url('welcome/updateCurrency')?>" method="POST" class="dropdown-menu dropdown-menu-right py-0" style="min-width:180px">
        <?php
        $active_currency = '';
        $currencies = $this->db->order_by('code ASC')->get('currencies')->result();
          foreach ($currencies as $currency) { 
            if ($currency->position == $this->session->currency) {
              $active_currency = 'active';
            }
            ?>
            <label for="<?=$currency->code?>"class="m-0 dropdown-item font-weight-normal <?=$active_currency?>">
            <input type="radio" name="currency" value="<?=$currency->position?>" class="d-none currency-input" id="<?=$currency->code?>">
              <?=$currency->currency?> 
              <span class="float-right"><i class="fa fa-sm <?=$currency->icon?>"></i></span> 
            </label>
          <div class="dropdown-divider my-0"></div>
          <?php $active_currency = ''; } ?>
        </form>
      </li>
      <li class="nav-item dropdown mr-2">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <img src="<?=base_url('dist/img/cart-black.png')?>" alt="" class="img-sm-h" width="20">
          <span class="badge badge-danger navbar-badge"><?=sizeof($this->cart->contents())?></span>
        </a>
        <?php if($this->cart->contents()){?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <?php 
          foreach ($this->cart->contents() as $tours) { 
          ?>

          <div class="px-3 py-2">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <b><?=$tours['name']?></b>
                </h3>
                <p class="text-sm text-secondary"><b>Travel Date: </b> <?=date('jS M, Y',strtotime($tours['traveling-date']))?></p>
                <p class="text-sm text-secondary"><b>Passangers: </b>
                <?php
                foreach ($tours['traveller'] as $key => $value) {
                  if ($value) {
                    if ($value > 1) {
                        if ($key == 'child') {
                          $key = 'children';
                        }
                        elseif ($key == 'family') {
                          $key = 'families';
                        }
                        else {
                          $key .= 's';
                        }
                        echo '<span class="comma-seperator">'.$value.' '.ucfirst($key).'</span> ';
                      }
                      else {
                        echo '<span class="comma-seperator">'.$value.' '.ucfirst($key).'</span> ';
                      }
                    }
                  }?></p>
                <p class="text-sm text-secondary"><b>Subtotal: </b>
                <span><?=currency_icon($this->session->currency)?>
              <?=convert_Currency($tours['subtotal'], convert_to($tours['currency']), convert_to($this->session->currency) );?></span>
                <a href="<?=base_url('Checkout/removeitem/'.$tours['rowid'])?>" class="float-right text-sm text-danger"><i class="fas fa-trash"></i></a>
                </p>
              </div>
            </div>
            <!-- Message End -->
          </div>
          <div class="dropdown-divider"></div>
          <?php } ?>
          <div class="dropdown-footer">
            <div class="row">
              <!-- <div class="col">
                <a href="<?=base_url()?>" class="btn btn-block btn-outline-success btn-sm"><i class="fa fa-arrow-left mr-2 fa-sm"></i>Add More</a>
              </div> -->
              <div class="col">
                <a href="checkout" class="btn btn-block btn-danger btn-sm">Checkout <i class="fa fa-arrow-right ml-2 fa-sm"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php } else{?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <div class="p-3">
            0 Items in your cart
          </div>
        </div>
                <?php } ?>
      </li>
      <?php if($this->session->guest) {?>
      <!--<li class="nav-item d-none d-md-inline-block">-->
      <!--  <a href="#" class="nav-link px-2 text-dark">-->
      <!--      <img src="<?=base_url('dist/img/user-black.png')?>" alt="" class="img-sm-h" width="20">-->
      <!--      <span class="d-inline-block ml-2">Guest</span>    -->
      <!--  </a>-->
      <!--</li>-->
      <li class="nav-item dropdown">
        <a class="nav-link text-dark" data-toggle="dropdown" href="#" aria-expanded="false">
          <img src="<?=base_url('dist/img/user-black.png')?>" alt="" class="img-sm-h" width="20">
          <span class="d-inline-block ml-2">Guest</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;min-width:150px">
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('logout')?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
      <?php }elseif($this->session->login) {?>
      <li class="nav-item dropdown">
        <a class="nav-link text-dark" data-toggle="dropdown" href="#" aria-expanded="false">
          <img src="<?=base_url('dist/img/user-black.png')?>" alt="" class="img-sm-h" width="20">
          <span class="d-inline-block ml-2">Account</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;min-width:150px">
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('account')?>" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>My Account
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('logout')?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
      <?php } else {?>
      <li class="nav-item">
        <a href="#login-modal" class="nav-link px-2 text-dark d-flex align-items-center" data-toggle="modal">
        <img src="<?=base_url('dist/img/user-black.png')?>" alt="" class="img-sm-h mr-2" width="20">
        <span class="d-inline-block">Login/Register</span>
        </a>
      </li>
      
      <?php } ?>
      
    </ul>
  </nav>
    