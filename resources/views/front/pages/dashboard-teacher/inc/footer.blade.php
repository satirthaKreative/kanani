<!--  <a href="#0" class="cd-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>     -->
<script src="{{ asset('frontend/teacherDashboard/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/teacherDashboard/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/teacherDashboard/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/teacherDashboard/js/jquery.slimNav_sk78.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	$('#navigation nav').slimNav_sk78();		
	$(function() {
	$('.chart').easyPieChart({
		size: 85,
		barColor: "#1a4568",
		scaleLength: 0,
		lineWidth: 7,
		trackColor: "#90afc4",
		lineCap: "circle",
		animate: 2000,
	});
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