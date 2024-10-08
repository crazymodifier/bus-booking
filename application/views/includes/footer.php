  </div>

    <!-- ./wrapper -->  
    
    <!-- jQuery UI 1.11.4 -->
    <script src="<?=base_url()?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- daterangepicker -->
    <script src="<?=base_url()?>plugins/moment/moment.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?=base_url()?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <!-- Slick Slider -->
    <script src="<?=base_url()?>plugins/slick/js/slick.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?=base_url()?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?=base_url()?>plugins/toastr/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="<?=base_url()?>dist/js/adminlte.js"></script>
    <script src="<?=base_url()?>dist/js/crazymodifier.js"></script>
    <?php if ($this->session->admin) { ?>
    <!-- jsGrid -->
    <script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    
    
    <!-- Summernote -->
    <script src="<?=base_url()?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?=base_url()?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url()?>plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('.remove-btn').click(function(e)
        {
            if(confirm('Are you sure??') == false)
            {
                e.preventDefault();
            }
        })
      $('#date_from').datetimepicker({
        format: 'L',
        Default:true,
        defaultDate: new Date(),
      });
      $('#table_id, .table_id').dataTable({
        "ordering": true,
        "sEcho": 1
        });
      $(function () {
        // Summernote
        $('.textarea').summernote({toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'italic', 'underline', 'clear']],
    ['fontname', ['fontname']],
    ['fontsize',['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    ['help', ['help']]
  ],})
      })

      $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      <?php 
        if ($this->session->flashdata('success')) {
          echo"
          Toast.fire({
            icon: 'success',
            title: '".$this->session->flashdata('success')."'
          });";
        }elseif ($this->session->flashdata('error')) {
          echo"
          Toast.fire({
            icon: 'error',
            title: '".$this->session->flashdata('error')."'
          });";
        }?>
        });
        
    </script>
    <?php } if ($msg = $this->session->flashdata('alert')) { ?>
    <script>
      $("#alert-modal").modal();
      $("#alert-modal").find('.modal-title').html("<?=$msg?>");
    </script>
    <?php } ?>
    <script>
      $.LoadingOverlay("show");
      $(window).on('load', function()
      {
        $.LoadingOverlay("hide");
      })
    </script>
    <script>
    $('.my-tab .nav-link').click(function(){
      var parent = $(this).parent('.nav-item').siblings();
      $(parent).find('.nav-link').removeClass('active');
      $(this).addClass('active');
    })
    $('.routes-tab:first').click().addClass('text-white').css({'background':$('.routes-tab:first').data('color') });
    $('.routes-tab').click(function(){
      var color = $(this).data('color');
      
      $(this).css({'background': color }).addClass('text-white');
      $(this).parents('.nav-item').siblings().find('.routes-tab').css({'background':'none'}).removeClass('text-white');
    }) 
    function setValues(key, value)
    {
      sessionStorage.setItem(key, value);
    }

    $('.form-control').on('change', function(){
      setValues($(this).attr('name'), $(this).val());
    })

    function getValues(key)
    {
      return sessionStorage.getItem(key);
    }
    </script>
    <script type="text/javascript">
    $('form[name="booking-form"]').on('submit', function(){
      // return false;
      var adult = $('#adult');
      var senior = $('#senior');
      var family = $('#family');

     
      
      $('.numberInput').forEach(element => 
      {
        console.log('asdfasdf');
      });
      return false;

    });


      $('#reservationdate').datetimepicker(
      {
        
        format: 'L',
        Default:true,
        defaultDate: sessionStorage.getItem('travelling-date') ? sessionStorage.getItem('travelling-date') : new Date(),
        minDate : '<?=!empty($packages[0][0]->date_from) ? $packages[0][0]->date_from : ''?>',
        maxDate : '<?=!empty($packages[0][0]->date_to) ? $packages[0][0]->date_to : ''?>',
        // disabledDates: sessionStorage.getItem('blocked_date').split(','),
      });
      $("#reservationdate").on("change.datetimepicker", ({date, oldDate}) => 
      {
        sessionStorage.setItem('travelling-date', date);
        
      })
      $('input[name="travelling-date"]').val();
    $('.slick-slide > div').addClass('h-100');
    $('input[name="package"]').change(function(){
      passengers($(this));
    });

    passengers( $('input[name="package"]'));
    $('#selector').hide();
    $('#passenger').click(function()
    {
      $('#selector').slideToggle();
    })
    function passengers(variation)
    {
      $.ajax({
        type: "POST",
        url: "<?=base_url('welcome/variation_row_id')?>",
        data: {'variation':variation.data('var_id')},
        success: function (response) 
        {
          $("#passengers").html(response)
        }
      });
    }
  </script>

  <script>
    $('.discount').on('blur',function()
    {
      var type = $(this).closest('.row').find('.discount-type').val();
      var mrp = $(this).closest('.row').find('.mrp').val();
      var final_price = $(this).closest('.row').find('.final_price');
      if (type==1) 
      {
        final_price.val(mrp - $(this).val());
      }
      else
      {
        final_price.val(mrp - (mrp * $(this).val())/100);
      }
    })
  </script>

  <script>
  
$(".tour-details .nav-link").click(function (event) {

  // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {
    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;
    // $(hash).fadeIn(300);
    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top - 130
    }, 500, function () {

      // Add hash (#) to URL when done scrolling (default click behavior)
      // window.location.hash = hash;
    });
  } // End if
})

$('.pricing-card').height($("#right-header").height() - $('.booking-area .brand-text').height());
  </script>

  <script>
  // $('input[name="traveling-date"]').on('change', function(){
  //   console.log($(this).val());
  // })
    $('.inputs').on('change',function(){
      // console.log($(this).val());
      $.ajax({
        type: "post",
        url: "<?=base_url('welcome/set_sessions')?>",
        data: {'name' : $(this).attr('name'), 'value' : $(this).val()},
        success: function (response) {
          console.log('done');
        }
      });
    })
  </script>
  
  
<?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view') {?>
<script>
    $("checkbox").prop("disabled", true);
    $("input").prop("readonly", true);
    $("select").prop("disabled", true);
    
</script>
<?php } ?>
  </body>
</html>
<?php 
