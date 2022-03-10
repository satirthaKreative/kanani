@extends('front.app-student')

@section('content')

<div class="course-page">
  <div class="sec1">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="wrap">
          <div class="row align-items-center">
            <div class="col-lg-7 col-md-7 sec_1">
              <h4>Course Progress</h4>
              <p id="progress-classes-new-id"></p>
            </div>
            <div class="col-lg-5 col-md-5 sec_2">
              <div class="box" id="course-progress-classes-new-id">
                <div class="chart" data-percent="0" data-scale-color="#ffb400"><span>0%</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="wrap">
          <div class="row align-items-center">
            <div class="col-lg-7 col-md-7">
              <h4>Remaining Classes</h4>
            </div>
            <div class="col-lg-5 col-md-5">
              <div class="box" id="remain-classes-new-id">
                <div class="chart" data-percent="0" data-scale-color="#ffb400"><span>0</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="wrap">
          <div class="row align-items-center">
            <div class="col-lg-7 col-md-7">
              <h4>Attended Classes</h4>
            </div>
            <div class="col-lg-5 col-md-5">
              <div class="box" id="attend-classes-new-id">
                <div class="chart" data-percent="0" data-scale-color="#ffb400"><span>0</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="wrap">
          <div class="row align-items-center">
            <div class="col-lg-7 col-md-7">
              <h4>Cancelled Classes</h4>
              <p id="cancel-classes-new-id"></p>
            </div>
            <div class="col-lg-5 col-md-5">
              <div class="box">
                <div class="chart" data-percent="0" data-scale-color="#ffb400"><span>0</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="sec2">
    <div class="tb-top">
      <h2>Class Schedule</h2>
        @if(count($countFreeTrailCountQuery) == 0)
          <a class="gft" href="javascript:;" onclick="contact_teacher_modal_fx()"><img src="{{ asset('frontend/studentDashboard/images/kn-tr-logo.png') }}"> <span>Click here</span> To Get a free trial Class</a>
        @endif
      </div>
      <div class="table-responsive">
        <table class="courses-view">
          <tr>
            <th>No</th>
            <th>Date</th>
            <th>Main Course Name</th>
            <th>Course Name</th>
            <th>Unit</th>
            <th>Lesson</th>
            <th>Teacher</th>
            <th>Zoom link</th>
          </tr>
          <tr>
            <td colspan=9><span class="text-info"><center><i class="fa fa-spinner"></i> Loading booked courses</center></span></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
<!-- The free trail class Modal -->
<div class="modal" id="free-trail-class-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Free Trail Class</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('satirtha.free-trail-class-booking') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="age-scale-id">Age:</label>
            <select class="form-control"  id="age-scale-id" name="age_scale_name" required>
              <option value="">Choose a age</option>
              @for($i = 2; $i < 81; $i++)
                @if($i < 10)
                  @php $age_limit = "0".$i; @endphp
                @else
                  @php $age_limit = $i; @endphp
                @endif
                <option value="{{ $i }}">{{ $age_limit }} years</option>
              @endfor
            </select>
          </div>
          <div class="form-group">
            <label for="english-learn-scale-id">English Level:</label>
            <select class="form-control"  id="english-learn-scale-id" name="english_learn_scale_name" required>
              <option value="">Choose a learning scale</option>
              @foreach($learningTypeQuery as $learningData)
                <option value="{{ $learningData->id }}">{{ $learningData->learning_scale_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="avail-date-id">Date:</label>
            <input type="text" autocomplete="off" class="form-control" onkeydown="return false" name="avail_date_name" id="avail-date-id" onchange="avail_check()">
          </div>
          <div class="form-group">
            <label for="avail-date-id">Time:</label>
            <select class="form-control" name="avail_date_time_name" id="avail-date-time-id">
                <option value="">Choose time</option>
            </select>
          </div>
          <div class="form-group">
            <label for="avail-date-id">TimeZone:</label>
            <select class="form-control" name="timezone_name" id="time-zone-id" required>
              <option value="">Choose timezone</option>  
              @foreach($countryTimezoneQuery as $countryTime)
                <option value="{{ $countryTime->id }}">{{ ucwords($countryTime->TimeZone) }} ( {{ $countryTime->UTCoffset }} )</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="leave-msg-id">Leave A Message:</label>
            <textarea class="form-control"  id="leave-msg-id" name="leave_msg_name" placeholder="Leave your message" rows="5" required></textarea>
          </div>
          <input type="hidden" name="hidden_interval_time_name" id="hidden-interval-time-name-id" value="0">
          <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- course rest pay -->
<!-- The Modal -->
<div class="modal" id="course-rest-pay-modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Course Rest Pay</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('satirtha.course-rest-pay-submit') }}" method="GET">
          @csrf
          <div class="form-group">
            <label for="course-rest-month-id">Course Rest Month:</label>
            <select class="form-control" onchange="rest_payment_month_change_fx()" required name="course_rest_month_name" placeholder="Enter course rest month" id="course-rest-month-id">
              <option value="">Choose a payment method</option>
            </select>
            <input type="hidden" id="course-month-total-pay-price-id" name="course_monthly_total_pay_price_name" value="0" />
            <input type="hidden" id="course-package-pay-price-id" name="course_package_pay_price_name" value="0" />
            <input type="hidden" id="course-lessons-monthly-count-id" name="course_monthly_lessons_name" value="0" />
            <input type="hidden" id="course-booking-tbl-id" name="course_booking_id_name" value="0" />
            <input type="hidden" id="course-booking-monthly-tbl-id" name="course_booking_monthly_id_name" value="0" />
          </div>
          <div class="satirtha-dashboard">
          <label for="course-payment-method-id">Payment Method:</label>
            <div class="form-check mb-15 pl-minus-20">
              <label class="form-check-label text-success ">
                <input type="radio" class="payment-method-check-input " name="payment_method" value="paypal">  Paypal Payment
              </label>
            </div>
            <div class="form-check disabled mb-15 pl-minus-20">
              <label class="form-check-label">
                <input type="radio" class="payment-method-check-input" name="payment_method" value="card" disabled>  Card Payment
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Pay</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </form>
      </div>
      <!-- Modal footer -->
      <!-- <div class="modal-footer"></div> -->
    </div>
  </div>
</div>
<!-- end of message modal -->
@endsection
@section('jsContent')
<script>
  $(function() {
      $.ajax({
        url: "{{ route('satirtha.show-message-calender') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          var disabledDates = event;
          $("#avail-date-id").datepicker({
              dateFormat: 'dd-mm-yy',
              defaultDate: -1,
              minDate: new Date(),
              maxDate: +29,
              firstDay: 1,
              changeMonth: true,
              changeYear: true,
              beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [disabledDates.indexOf(string) == -1]
              }
          });
        }, error: function(event){

        }
      })  
      // all courses
      all_course_fx(); 
  });
  function avail_check()
  {
    var avail_checked_date = $("#avail-date-id").val();
    $.ajax({
      url: "{{ route('satirtha.show-time-using-date') }}",
      type: "GET",
      data: {avail_checked_date: avail_checked_date},
      dataType: "json",
      success: function(event){
        $("#avail-date-time-id").html(event.whole_main_time);
        $("#hidden-interval-time-name-id").val(event.interval_time_of_date);
      }, error: function(event){

      }
    })
  }
  function contact_teacher_modal_fx()
  {
    $("#free-trail-class-modal").modal('show');
  }
  // all courses show
  function all_course_fx()
  {
    $.ajax({
      url: "{{ route('satirtha.show-all-courses') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $(".courses-view").html(event.all_course);
        $("#course-progress-classes-new-id").find(".chart").attr('data-percent',event.course_percentage);
        $("#course-progress-classes-new-id").find("span").html(event.course_percentage+"%");
        $("#remain-classes-new-id").find(".chart").attr('data-percent',event.remain_percentage);
        $("#remain-classes-new-id").find("span").html(event.remain_classes);
        $("#attend-classes-new-id").find(".chart").attr('data-percent',event.course_percentage);
        $("#attend-classes-new-id").find("span").html(event.attend_classes);
        $("#progress-classes-new-id").html(event.course_progress+"/"+event.attend_classes);
        load_chart_js_fx();
      }, error: function(event){

      }
    })
  }
  // course pending pay 
  function course_left_pay_fx(booking_tbl_id, monthly_booking_tbl_id)
  {
    $("#course-rest-pay-modal-id").modal('show');
    $.ajax({
      url: "{{ route('satirtha.rest-pay-course-view-modal') }}",
      type: "GET",
      data: {booking_tbl_id: booking_tbl_id, monthly_booking_tbl_id: monthly_booking_tbl_id},
      dataType: "json",
      success: function(response){
        $("#course-rest-month-id").html(response.months_count);
        $("#course-booking-tbl-id").val(booking_tbl_id);
        $("#course-booking-monthly-tbl-id").val(monthly_booking_tbl_id);
        $("#course-month-total-pay-price-id").val(response.base_monthly_package_price);
        $("#course-package-pay-price-id").val(response.base_monthly_package_price);
        $("#course-lessons-monthly-count-id").val(response.package_lessons_in_a_month)
      }, error: function(response){

      }
    });
  }
  // course rest month change with price 
  function rest_payment_month_change_fx()
  {
    var months_count = $("#course-rest-month-id").val();
    var package_price = $("#course-package-pay-price-id").val();
    $("#course-month-total-pay-price-id").val((parseInt(months_count)*parseInt(package_price)));
  }

  // load chart js
  function load_chart_js_fx(){
    $('.chart').easyPieChart({
      size: 85,
      barColor: "#1a4568",
      scaleLength: 0,
      lineWidth: 7,
      trackColor: "#90afc4",
      lineCap: "circle",
      animate: 2000,
    });
  }
</script>
@endsection