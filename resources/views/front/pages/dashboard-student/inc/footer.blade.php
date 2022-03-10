<script src="{{ asset('frontend/studentDashboard/js/jquery.min.js') }}"></script>

<script src="{{ asset('frontend/studentDashboard/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('frontend/studentDashboard/js/owl.carousel.js') }}"></script>

<script src="{{ asset('frontend/studentDashboard/js/jquery.slimNav_sk78.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script>

    // $(document).ready(function() {
      // $("a.nav-line").on("click", function () {
      //     $(".side-bar").toggleClass("open");
      // });

      	$("a.nav-line").click(function(){
          $(".col-lg-3 .side-bar").toggleClass("open");
        });
        
	      $(".side-bar .close").click(function(){
		      $(".col-lg-3 .side-bar").removeClass("open");    
		    });
    // });
</script>