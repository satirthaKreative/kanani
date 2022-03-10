<!--  <a href="#0" class="cd-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>     -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slimNav_sk78.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(function(){
  load_footer_and_contact_details_fx();
});
// footer & contact details
  function load_footer_and_contact_details_fx(){
    $.ajax({
      url: "{{ route('satirtha.load-footer-and-contact-details-fx') }}",
      type: "GET",
      dataType: "json",
      success: function(eventResponse){
        $(".footer-email-address-class").html('<a href="mailto:'+eventResponse.email_address+'"><i class="fas fa-envelope"></i> '+eventResponse.email_address+'</a>');
        $(".footer-contact-number-class").html('<a href="tel:'+eventResponse.contact_number+'"><i class="fas fa-phone-alt"></i> '+eventResponse.contact_number+'</a>');
        $(".footer-facebook-class").html('<a href="'+eventResponse.cms_facebook+'" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>');
        $(".footer-instagram-class").html('<a href="'+eventResponse.cms_instagram+'" target="_blank"><i class="fab fa-instagram"></i> instagram</a>');
        $(".footer-twitter-class").html('<a href="'+eventResponse.cms_twitter+'" target="_blank"><i class="fab fa-twitter"></i> twitter</a>');
        $(".footer-youtube-class").html('<a href="'+eventResponse.cms_youtube+'" target="_blank"><i class="fab fa-youtube"></i>youtube</a>');
        $(".footer-copyright-class").html(eventResponse.cms_copyright);
        $(".cms-footer-heading-class").html(eventResponse.cms_footer_head);
        $(".cms-footer-content-class").html(eventResponse.cms_footer_content);
      }, error: function(eventResponse){

      }
    })
  }
$(document).ready(function() {	
	$('#navigation nav').slimNav_sk78();		
	var owl = $('.students-say');
	owl.owlCarousel({
	autoPlay: 4000, //Set AutoPlay to 3 seconds
	items:1,	
	nav:true,  
	dots:false,
	loop:false,
	autoplay:true,
	smartSpeed:1500,
	autoplayTimeout:4000,
	});
	$('.accordion').find('.accordion-toggle').click(function() {
		$(this).next().slideToggle('600');
		$(".accordion-content").not($(this).next()).slideUp('600');
	});
	$('.accordion-toggle').on('click', function() {
		$(this).toggleClass('active').siblings().removeClass('active');
	});
});
</script>
@if(Session::has('success_msg'))
<script>
    swal({
      title: "Successful!",
      text: "{{ Session::get('success_msg') }}",
      icon: "success",
      button: false,
      timer: 3000
    });
</script>
@endif
<!-- error alert -->
@if(Session::has('error_msg'))
<script>
    swal({
      title: "Error!",
      text: "{{ Session::get('error_msg') }}",
      icon: "error",
      button: false,
      timer: 3000
    });
</script>
@endif

<script>
  // success msg
  function success_pass_alert_show_msg(alert_main_msg)
  {
    swal({
      title: "Successful!",
      text: alert_main_msg,
      icon: "success",
      button: false,
      timer: 3000
    });
  }
  // unique visitor
  function count_alert_unique_visitor(today_count, total_count, today_c, total_c)
  {
    var tStatus = "success";
    if(parseInt(today_c) == parseInt(0))
    {
      tStatus = "warning";
    }
    swal({
      title: today_count,
      text: total_count,
      icon: tStatus,
      button: "Ok",
      // timer: 3000
    });
  }
  // error msg
  function error_pass_alert_show_msg(alert_main_msg)
  {
    swal({
      title: "Error!",
      text: alert_main_msg,
      icon: "error",
      button: false,
      timer: 3000
    });
  }
  
</script>