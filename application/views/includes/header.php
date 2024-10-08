<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$about->title?></title>
  <meta name="description" content="<?=$about->metaDescription?>">
  <meta name="keywords" content="<?=$about->metaKeywords?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?=base_url()?>dist/css/crazymodifier.css">
  <!-- Slick Slider -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/slick/css/slick.css">
  <link rel="stylesheet" href="<?=base_url()?>plugins/slick/css/slick-theme.css">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('dist/img/')?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('dist/img/')?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('dist/img/')?>/favicon-16x16.png">
    <link rel="manifest" href="<?=base_url('dist/img/')?>/site.webmanifest">
  <!-- jQuery -->
  <script src="<?=base_url()?>plugins/jquery/jquery.min.js"></script>
  
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php if ($this->session->admin) { ?>
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/summernote/summernote-bs4.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/select2/css/select2.min.css">
  
  <?php } ?>
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
  <style>
  .slides-header,.slider-for,.slider-nav{
      /*overflow:hidden;*/
      display:flex;
  }
   .slides-header img,.slider-for img,.slider-nav img{
      width:100vw !important;
  }
  /*.slider-for>img:not(:first-of-type),.slider-nav>img:not(:first-of-type){display:none;}*/
   .slick-initialized .slick-slide:not(:first-of-type),
   .slider-for.slick-initialized .slick-slide:not(:first-of-type),
   .slider-nav.slick-initialized .slick-slide:not(:first-of-type)
   {
       display:block!important
   }
   .dropdown-item.active,.dropdown-item:active
   {
    background-color: #dc3545;
   }
   .font-1{
     font-family: 'Kaushan Script', cursive;
   }
    .slick-list,.slick-track{
      display:flex;
    }
    .slick-slide,.slick-slide *:focus{
      outline:none;
    }
    .bullet:before
    {
      content:"";
      width:15px;
      height:15px;
      border-radius:50%;
      background:inherit;
      position:absolute;
      left:0;
      top:50%;
      transform:translateY(-50%);
    }
    .form-control:focus
    {
      border-color:#bd2130;
    }
    ::-moz-selection { /* Code for Firefox */
      color:#ffffff ;
      background: #bd2130;
    }

    ::selection {
      color:#ffffff ;
      background: #bd2130;
    }
    .comma-seperator:not(:last-child):after
    {
      content:','
    }

    select 
    {
      -webkit-appearance: menulist-button !important;
    }
    option:hover{
      background-color:red !important;
    }
    .nav-pills .nav-link.active
    {
      background-color:#dc3545;
      color:white ;
    }
    #login-modal .nav-pills .nav-link.active
    {
      background-color:#dc3545;
      color:white !important;
    }
    .modal::-webkit-scrollbar {
  display: none;
}
.routes-tab.active:after
{
    content:'';
    position:absolute;
    width:16px;
    height:16px;
    background:inherit;
    bottom:-8px;
    transform:translateX(-50%)rotate(-45deg);
    left:50%;
}
.routes-tab
{
  position:relative;
  overflow:inherit;
}

/* Design system with CSS custom properties */

/*
  - Colors
  - Spacings
  - Font sizes
  - Radii
  - Borders
  - Shadows
  - Utilities
  (- Transitions)
*/

:root {
  /* Blues */
  --color-blue-100: #f5faff;
  --color-blue-200: #b8dcff;
  --color-blue-300: #7ab8ff;
  --color-blue-400: #3d90ff;
  --color-blue-500: #0064fe;
  --color-blue-600: #0046d1;
  --color-blue-700: #002ba3;
  --color-blue-800: #001575;
  --color-blue-900: #000647;

  /* Greens */
  --color-green-100: #f0fcf5;
  --color-green-200: #b4eece;
  --color-green-300: #78e0a7;
  --color-green-400: #3cd180;
  --color-green-500: #00c159;
  --color-green-600: #009645;
  --color-green-700: #006a31;
  --color-green-800: #003f1d;
  --color-green-900: #001309;

  /* Grays */
  --color-gray-100: #f3f5f6;
  --color-gray-200: #d0d8dd;
  --color-gray-300: #aebac2;
  --color-gray-400: #8d9ca7;
  --color-gray-500: #6c7d8b;
  --color-gray-600: #576674;
  --color-gray-700: #424e5c;
  --color-gray-800: #2e3843;
  --color-gray-900: #1c212a;

  /* Neutrals */
  --color-white: white;
  --color-black: black;

  /* Misc */
  --color-border: var(--color-gray-200);

  /* Spacing */
  --space-0: 0;
  --space-1: 0.25rem;
  --space-2: 0.5rem;
  --space-3: 0.75rem;
  --space-4: 1rem;
  --space-5: 1.25rem;
  --space-6: 1.5rem;
  --space-7: 1.75rem;
  --space-8: 2rem;
  --space-10: 2.5rem;
  --space-12: 3rem;
  --space-16: 4rem;
  --space-20: 5rem;
  --space-24: 6rem;

  /* Font sizes */
  --text-sm: 0.875rem;
  --text-md: 1rem;
  --text-lg: 1.25rem;
  --text-xl: 1.5rem;

  /* Border radius */
  --radius: 6px;
  --round: 1000px;

  /* Borders */
  --border: 1px solid var(--color-border);

  /* Shadows */
  --shadow: 0px 2px 8px rgba(0, 0, 0, 0.06), 0px 1px 3px rgba(0, 0, 0, 0.05);
  --shadow-large: 0px 5px 18px rgba(0, 0, 0, 0.1),
    0px 1px 3px rgba(0, 0, 0, 0.05);
  --shadow-focus: 0 0 0 var(--space-1) var(--color-blue-200);

  /* Transition curves */
  --transition-curve: cubic-bezier(0.2, 0.7, 0.3, 1);
  --transition-curve-bounce: cubic-bezier(0.175, 0.885, 0.32, 1.275);

  /* Transition speeds */
  --transition-speed: 0.25s;
  --transition-speed-slow: 1s;

  /* Transition */
  --transition: all var(--transition-speed) var(--transition-curve);
  --transition-bounce: all var(--transition-speed)
    var(--transition-curve-bounce);

  /* Opacities */
  --opacity-25: 0.25;
  --opacity-50: 0.5;
  --opacity-75: 0.75;
  --opacity-100: 1;
}

.input-row {
  display: flex;
  padding: var(--space-1);
}
.input-row:last-child {
  border-bottom: 0;
}

.input {
  display: flex;
  align-items: center;
  margin-left: auto;
}
.incrmt {
  display: flex;
  justify-content: center;
  align-items: center;
  width:1.5rem;
  height:1.6rem;
  border-radius:50%;
}


.number {
  font-size: var(--text-lg);
  min-width: var(--space-12);
  text-align: center;
}
.icon {
  user-select: none;
}
.dim {
  color: var(--color-gray-400);
}
.rating {
      display: inline-block;
      position: relative;
      height: 50px;
      line-height: 35px;
      font-size: 22px;
    }
    
    .rating label {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      cursor: pointer;
    }
    
    .rating label:last-child {
      position: static;
    }
    
    .rating label:nth-child(1) {
      z-index: 5;
    }
    
    .rating label:nth-child(2) {
      z-index: 4;
    }
    
    .rating label:nth-child(3) {
      z-index: 3;
    }
    
    .rating label:nth-child(4) {
      z-index: 2;
    }
    
    .rating label:nth-child(5) {
      z-index: 1;
    }
    
    .rating label input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }
    
    .rating label .icon {
      float: left;
      color: transparent;
    }
    
    .rating label:last-child .icon {
      color: #000;
    }
    
    .rating:not(:hover) label input:checked ~ .icon,
    .rating:hover label:hover input ~ .icon {
      color: #ffc107!important;
    }
    
    .rating label input:focus:not(:checked) ~ .icon:last-child {
      color: #000;
      text-shadow: 0 0 5px #09f;
    }
    html {
  scroll-behavior: smooth;
}
.tour-details.sticky.is-sticky {
    top: 61px;
    padding: .7rem 3rem;
    background: white;
    z-index: 999;
    border-bottom: 1px solid #ccc;}
    span.close.cm-close-modal {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 1.5rem;
    height: 1.5rem;
    border: 2px solid;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    background:white;
    opacity:1;
}
.blinking b{
  color:yellow !important;
  animation:blinking 2s infinite ease-in-out;
}
@keyframes blinking{
  0%
  {
    opacity:0;
  }
  50%
  {
    opacity:1;
  }
}
.slick-prev, .slick-next {
  z-index:2;
}
/*.slick-prev {*/
/*  left:40%;*/
/*}*/
/*.slick-next {*/
/*  right:40%;*/
/*}*/
.slick-prev:before, .slick-next:before {
  color:red;
  font-size:24px;
}
.whyus .slick-prev,.whyus .slick-next
{
    display:none !important;
}
@media(min-width:1023px)
    {
        .booking-area{
            position:absolute;
            top:50%;
            transform:translateY(-50%);
        }
    }
    @media(max-width:767px)
    {
        .slides-header img
        {
            height:auto !important;
        }
        .pricing-card
        {
            height:auto !important;
        }
        #testimonials .slick-prev,#testimonials .slick-next {
            padding-top:1rem;
        }
        .slider-nav .slick-prev,.slider-nav .slick-next {
            padding-top:1rem;
        }
    }
    @media(max-width:576px)
    {
        .text-sm-xs
        {
            font-size:10px !important;
        }
        .text-sm-md
        {
            font-size:1rem !important;
        }
        .text-sm-xs-h
        {
            font-size:.75rem;
        }
        .img-sm-h
        {
            width:15px;
        }
        .img-sm-auto
        {
           height:auto !important;
        }
        .pricing-card .card-body
        {
            overflow-x:auto;
        }
        .pricing-card .row{
            width:600px;
        }
        h1,h2{
            font-size:1.5rem;
        }
    }
  </style>
</head>
<body class="hold-transition layout-fixed bg-light layout-navbar-fixed">
      <div class="modal fade" id="login-modal">
        <div class="modal-dialog modal-dialog-centered px-md-5">
         
          <div class="modal-content">
            <div class="py-3 px-5 position-relative">
              <div class="position-absolute w-75" style="top:-50%;left:auto;right:auto">
                <ul class="nav nav-pills nav-fill pill-danger" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item bg-white rounded border m-1 border-danger">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Login</a>
                  </li>
                  <li class="nav-item bg-white rounded border m-1 border-danger">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Register</a>
                  </li>
                </ul>
              </div>
              <span type="button" class="close cm-close-modal" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times" style="font-size:14px"></i>
              </span>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="<?=base_url('Welcome/login')?>" method="post">
                      <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-8">
                          <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                              Remember Me
                            </label>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                          <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>

                    <div class="social-auth-links text-center mb-3">
                      <p class="my-1">- or -</p>
                      <a href="<?=base_url('Loginwithfacebook/signup/')?>" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                      </a>
                      <a href="<?=base_url('Loginwithgoogle/signup/')?>" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i> Sign in using Google
                      </a>
                      <p class="my-1">- or -</p>
                      <a href="<?=base_url('welcome/con_guest')?>" class="btn btn-block btn-success">
                      <span aria-hidden="true"><i class="fa fa-users mr-2"></i> Continue as guest</span></a>
                    </div>
                    <!-- /.social-auth-links -->
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <p class="login-box-msg">Register a new membership</p>

                    <form action="<?=base_url('welcome/registration')?>" method="post">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-8">
                          <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="1" required>
                            <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                            </label>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                          <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>

                    <div class="social-auth-links text-center">
                      <p>- OR -</p>
                      <a href="<?=base_url('Loginwithfacebook/signup/')?>" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                      </a>
                      <a href="<?=base_url('Loginwithgoogle/signup/')?>" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i>
                        Sign up using Google
                      </a>
                    </div>
                  </div>
                </div>
              

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <div class="wrapper">