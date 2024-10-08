  </div>

    <!-- ./wrapper -->  
    
    <!-- jQuery UI 1.11.4 -->
    <script src="<?=base_url()?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
      $('#date_from').datetimepicker({
        format: 'L',
        Default:true,
        defaultDate: new Date(),
      });
      $('#table_id').dataTable({
        "ordering": true,
        "sEcho": 1
        });
      $(function () {
        // Summernote
        $('.textarea').summernote()
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
    // $('.routes-tab:first').click().addClass('text-white').css({'background':$('.routes-tab:first').data('color') });
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
        defaultDate: new Date(),
        minDate : '<?=!empty($packages[0][0]->date_from) ? $packages[0][0]->date_from : ''?>',
        maxDate : '<?=!empty($packages[0][0]->date_to) ? $packages[0][0]->date_to : ''?>',
        // disabledDates: sessionStorage.getItem('blocked_date').split(','),
      });

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
        dataType: "JSON",
        success: function (response) 
        {
          console.log(response);
          $('#passengers').html('');
          $.each(response, function (indexInArray, valueOfElement) { 
            var data = '<div class="input-row"><h6 class="">'+  valueOfElement.tourist_type +' ('+valueOfElement.age+')</h6><div class="input"><button onclick="hello(this)" type="button" class="minus incrmt btn btn-outline-danger" aria-label="Decrease by one" disabled><span class=""><i class="fa fa-minus fa-xs"></i></span></button><div class="number dim">0</div><input type="hidden" name="traveller['+ valueOfElement.tourist_type +']]" class="numberInput"><button onclick="hello(this)" type="button" class="plus incrmt btn btn-danger" aria-label="Increase by one"><span class=""><i class="fa fa-plus fa-xs"></i></span></button></div></div>';
            $('#passengers').append(data);


          });
        }
      });
    }
  </script>
<script>
hello();
function hello(button)
{
  button.addEventListener("click", (event) => {
    // 1. Get the clicked element
    const element = event.currentTarget;
    // 2. Get the parent
    const parent = element.parentNode;
    // 3. Get the number (within the parent)
    const numberContainer = parent.querySelector(".number");
    const numberContainerInput = parent.querySelector(".numberInput");
    const number = parseFloat(numberContainer.textContent);
    // 4. Get the minus and plus buttons
    const increment = parent.querySelector(".plus");
    const decrement = parent.querySelector(".minus");
    // 5. Change the number based on click (either plus or minus)
    const newNumber = element.classList.contains("plus")
      ? number + 1
      : number - 1;
    numberContainer.textContent = newNumber;
    numberContainerInput.value = newNumber;
    // 6. Disable and enable buttons based on number value (and undim number)
    if (newNumber === minValue) {
      decrement.disabled = true;
      numberContainer.classList.add("dim");
      // Make sure the button won't get stuck in active state (Safari)
      element.blur();
    } else if (newNumber > minValue && newNumber < maxValue) {
      decrement.disabled = false;
      increment.disabled = false;
      numberContainer.classList.remove("dim");
    } else if (newNumber === maxValue) {
      increment.disabled = true;
      numberContainer.textContent = `${newNumber}+`;
      element.blur();
    }
  });
}

const buttons = document.querySelectorAll(".incrmt");
const minValue = 0;
const maxValue = 10;

buttons.forEach((button) => {
  button.addEventListener("click", (event) => {
    // 1. Get the clicked element
    const element = event.currentTarget;
    // 2. Get the parent
    const parent = element.parentNode;
    // 3. Get the number (within the parent)
    const numberContainer = parent.querySelector(".number");
    const numberContainerInput = parent.querySelector(".numberInput");
    const number = parseFloat(numberContainer.textContent);
    // 4. Get the minus and plus buttons
    const increment = parent.querySelector(".plus");
    const decrement = parent.querySelector(".minus");
    // 5. Change the number based on click (either plus or minus)
    const newNumber = element.classList.contains("plus")
      ? number + 1
      : number - 1;
    numberContainer.textContent = newNumber;
    numberContainerInput.value = newNumber;
    // 6. Disable and enable buttons based on number value (and undim number)
    if (newNumber === minValue) {
      decrement.disabled = true;
      numberContainer.classList.add("dim");
      // Make sure the button won't get stuck in active state (Safari)
      element.blur();
    } else if (newNumber > minValue && newNumber < maxValue) {
      decrement.disabled = false;
      increment.disabled = false;
      numberContainer.classList.remove("dim");
    } else if (newNumber === maxValue) {
      increment.disabled = true;
      numberContainer.textContent = `${newNumber}+`;
      element.blur();
    }
  });
});

</script>
  <?php if($this->session->login) { ?>
  <script>
  $('#login-modal').modal({backdrop: 'static', keyboard: true})  
  </script>
  <?php } ?>

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

$('.pricing-card').height($("#right-header").height() - $('.brand-text').height());
  </script>
  </body>
</html>
<?php 
