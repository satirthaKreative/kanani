<script type="text/javascript">
$(document).ready(function() {	
	$('#navigation nav').slimNav_sk78();		
	$(function() {
	// $('.chart').easyPieChart({
	// 	size: 85,
	// 	barColor: "#1a4568",
	// 	scaleLength: 0,
	// 	lineWidth: 7,
	// 	trackColor: "#90afc4",
	// 	lineCap: "circle",
	// 	animate: 2000,
	// });
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