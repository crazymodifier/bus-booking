$(".edit-cart").click(function () {
  var rowid = $(this).data('row');
  $.ajax({
    type: "POST",
    url: "<?=base_url('Checkout/cartContent')?>",
    data: { rowid: rowid },
    dataType: "JSON",
    success: function (response) {
    //   $('#traveling-date').val(response.id);
    //   $('#edit-cart-row').val(response.rowid);
    //   $.each(response.traveller, function (key, value) {
    //     $('#' + key).val(value);
    //   });
    console.log(response);
    }
  });

});
    //File uploading
    $(".file-upload").on('change', function () {
        for (let i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $('#image').html('<img src="'+ e.target.result+'" alt="Front Image" class="w-100">');
            };
            reader.readAsDataURL(this.files[i]);
        }
    });    
$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  lazyLoad: 'ondemand',
  fade: true,
  autoplay: true,
  autoplaySpeed: 2000,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: true,
  lazyLoad: 'ondemand',
  autoplay: true,
  autoplaySpeed: 2000,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
      }
    }
  ]
});
$('.currency-input').change(function () {
  $("form[name='updateCurrency']").submit();
});

$('.slides-4').slick({
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  arrows: true,
  autoplay: true,
  lazyLoad: 'ondemand',
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    }
  ]
});


$('.slides-1').slick({
  infinite: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade:true,
  autoplay: true,
  autoplaySpeed: 5000,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    }
  ]
});
$('.slides-header').slick({
  infinite: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  autoplay: true,
  autoplaySpeed: 5000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    }
  ]
});
$('input[name="mobile"]').keyup(function () {
  if (!this.value.match(/[0-9]/)) {
    this.value = this.value.replace(/[^0-9]/g, '');
  }
});

$(function () {
  setNavigation();
});

function setNavigation() {
  var path = window.location.href;
  $("nav a").each(function () {

    var href = $(this).attr('href');

    path = path.substring(0, (path.indexOf("#") == -1) ? path.length : path.indexOf("#"));
    path = path.substring(0, (path.indexOf("?") == -1) ? path.length : path.indexOf("?"));
    if (path === decodeURIComponent(href)) {
      $(this).addClass('active');
    }
    path = window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1);
    if (path === decodeURIComponent(href)) {
      $(this).addClass('active');
    }
  });

};
$(".fileUpload").on('change', function () {
  for (let i = 0; i < this.files.length; i++) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image').html('<img src="' + e.target.result + '" alt="Front Image" class="object-cover-center w-100">');

    };
    reader.readAsDataURL(this.files[i]);
  }
});
// Rippel Effect
(function (window, $) {

  $(function () {

    $('.btn, .nav-link').on('mousedown', function (event) {

      var $btn = $(this),
        $div = $('<div/>'),
        btnOffset = $btn.offset(),
        xPos = event.pageX - btnOffset.left,
        yPos = event.pageY - btnOffset.top;

      $div.addClass('ripple-effect');
      $div
        .css({
          width: '10px',
          height: '10px',
          top: yPos - ($div.height() / 2),
          left: xPos - ($div.width() / 2),
          background: $btn.data("ripple-color") ? $btn.data("ripple-color") : '#FFFFFF99'
        });
      $btn.append($div);
      window.setTimeout(function () {
        $div.remove();
      }, 600);

    });

  });

})(window, jQuery);

// Sticky Element
// Custom function which toggles between sticky class (is-sticky)
var stickyToggle = function (sticky, stickyWrapper, scrollElement) {
  var stickyHeight = sticky.outerHeight();
  var stickyTop = stickyWrapper.offset().top;
  if (scrollElement.scrollTop() >= stickyTop) {
    stickyWrapper.height(stickyHeight);
    sticky.addClass("is-sticky");
  }
  else {
    sticky.removeClass("is-sticky");
    stickyWrapper.height('20px');
  }
};

// Find all data-toggle="sticky-onscroll" elements
$('[data-toggle="sticky-onscroll"]').each(function () {
  var sticky = $(this);
  var stickyWrapper = $('<div>').addClass('sticky-wrapper'); // insert hidden element to maintain actual top offset on page
  sticky.before(stickyWrapper);
  sticky.addClass('sticky');

  // Scroll & resize events
  $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function () {
    stickyToggle(sticky, stickyWrapper, $(this));
    stickyToggle(sticky, stickyWrapper, $(window));
  });

  // On page load
  stickyToggle(sticky, stickyWrapper, $(window));
});

