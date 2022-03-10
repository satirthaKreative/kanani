@extends('front.app-student')
@section('content')
<style>
    .payable-price-dollar-class{
        /* position: absolute; margin-left: 1px; margin-top: 1px; */
    }
</style>
            <div class="my-account-page booking-page">
                <form action="{{ route('satirtha.submit-booking-from-student') }}" method="POST">
                    @csrf
                    <div class="row">
                       <div class="col-lg-8">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Course packages</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">2 Days a week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">3 Days a week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">5 Days a week</a>
                                </li> -->
                            </ul><!-- Tab panes -->
                       </div>
                       <div class="col-lg-4">
                            <div class="coursetype">
                                <label for="">Course type</label>
                                <select name="" id="">
                                    <option value="">English conversation course</option>
                                </select>
                            </div>
                       </div>
                    </div>

                   <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                             <table>
                                  <tr>
                                    <th>Time</th>
                                    <th>Course</th>
                                    <th>Lessons</th> 
                                    <th>Package</th> 
                                    <th>Price</th> 
                                    <th></th>                     
                                  </tr>
                                  @if(count($courseDBsubQuery) > 0)
                                  @php $i = 1; @endphp
                                  @foreach($courseDBsubQuery as $courseSubQ)
                                    <tr>
                                        <td>{{ $courseSubQ->times_in_minutes }} mins</td>
                                        <td>{{ ucwords($courseSubQ->topic_name) }} <br/><sub>{{ ucwords($courseSubQ->course_name) }}</sub></td>
                                        <td>{{ $courseSubQ->no_of_lessons }} <input type="hidden" name="package_no_of_lessons_name" id="package-no-of-lessons-id{{ $i }}" value="{{ $courseSubQ->no_of_lessons }}"/></td>
                                        <td>
                                            <select name="choose_a_package_name{{ $i }}" id="choose-a-package-id{{ $i }}" onchange="choose_package_fx({{ $i }},{{ $courseSubQ->id }})">
                                                <option value="">Choose a package</option>
                                                @foreach($role_wish_price_list as $coursePackQuery)
                                                    <option value="{{ $coursePackQuery->id }}">{{ $coursePackQuery->no_of_lessons_per_month	 }} lessons a month {{ $coursePackQuery->price_per_month }}$</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><a href="#" id="package-price-id{{ $i }}">$0.00</a><input type="hidden" name="package_price_hidden_name" id="package-hidden-price-id{{ $i }}" value="0" /></td>      
                                        <td>
                                            <div class="custom-radio">
                                                <input class="custom-radio__control" onclick="package_booking_radio_fx({{ $i }},{{ $courseSubQ->id }})" id="r{{ $i }}" name="custom-radio" type="radio" value="male">
                                                <label class="custom-radio__label" for="r{{ $i }}"></label>
                                            </div>
                                        </td>              
                                    </tr>
                                    @php $i++; @endphp
                                  @endforeach
                                  @else
                                    <tr>
                                        <td colspan=6>
                                            <center class="text-info"><i class="fa fa-times"></i> No course available</center>
                                        </td>
                                    </tr>
                                  @endif
                              </table>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel"></div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel"></div>
                        <div class="tab-pane" id="tabs-4" role="tabpanel"></div>
                      </div>
                    </div>                        
                   </div>
                   <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                                <input type="hidden" id="hidden-course-tbls-id" value="0" />
                                <input type="hidden" name="booking_no_of_lessons_hidden_name" id="booking-no-of-lessons-hidden-id">
                                <input type="hidden" name="booking_interval_hidden_time_name" id="booking-interval-hidden-time-id">
                                <input type="hidden" name="paypal_package_name" id="paypal-package-id" />
                                <input type="hidden" name="paypal_package_main_course_name" id="paypal-package-main-course-id" />
                                <input type="hidden" name="paypal_package_radio_name" id="paypal-package-radio-id" />
                                <input type="hidden" name="paypal_package_price_name" id="paypal-package-price-id" />
                                <input type="hidden" name="lessons_per_week_count_hidden_name" id="lessons-per-week-count-hidden-id" />
                                <input type="hidden" name="lessons_per_month_count_hidden_name" id="lessons-per-month-count-hidden-id" />
                                <input type="hidden" name="month_count_hidden_name" id="month-count-hidden-id" />
                                <div class="col-lg-12 booking-dates-for-count-class"></div>
                                <div class="col-lg-12">
                                    <label for="course-comment-id">Comment</label>
                                    <textarea name="course_comment_name" id="course-comment-id" placeholder="Your comment"></textarea> 
                                </div> 
                                <div class="col-lg-12">
                                    <label for="course-timezone-id">TimeZone</label>
                                    <select name="course_timezone_name" id="course-timezone-id">
                                        <option value="">Choose timezone</option>  
                                        @foreach($countryTimezoneQuery as $countryTime)
                                            <option value="{{ $countryTime->id }}">{{ ucwords($countryTime->TimeZone) }} ( {{ $countryTime->UTCoffset }} )</option>
                                        @endforeach
                                    </select> 
                                </div> 
                                <div class="col-lg-6">
                                    <label for="course-pay-tenure-id">Pay tenure</label>
                                    <select name="course_pay_tenure_name" onchange="choose_pay_tenure_fx()" id="course-pay-tenure-id" placeholder="Your pay tenure" required>
                                        <option value="1">Pay for one month</option>
                                        <option value="2">Pay for two month</option>
                                        <option value="full">Full Pay</option>
                                    </select> 
                                </div> 
                                <div class="col-lg-6">
                                    <label for="course-payable-price-id">Payable Price</label>
                                    ( <span class="payable-price-dollar-class">$</span> )<input type="text" readonly onkeydown="return false" name="course_payable_price_name" id="course-payable-price-id" placeholder="Your payable price for course" /> 
                                </div>                           
                                <div class="col-lg-4">
                                    <input type="submit" class="paypal" value="Paypal">
                                </div>
                                <div class="col-lg-4">
                                    <a href="#" class="cardbtn"><img src="{{ asset('frontend/studentDashboard/images/card.png') }}" alt="">Debit or Credit card</a>
                                </div>
                                <div class="col-lg-4">
                                    <a href="#" class="cancel_btn">Cancel</a>
                                </div>
                        </div>
                    </div>                        
                    </div>
                </form>
            </div>
@endsection
@section('jsContent')
<script>
    $(function(){
        course_start_date_class_fx();
        $.ajax({
            url: "{{ route('satirtha.price-list-for-booking') }}",
            type: "GET",
            dataType: "json",
            success: function(event){

            }, error: function(event){

            }
        });
    });

    function available_booking_date_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.show-student-available-calender') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
            console.log(event);
            var disabledDates = event;
            $(".course-start-date-class").datepicker({
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

            available_tenure_fx();
            }, error: function(event){

            }
        })  
    }

    function course_start_date_class_fx()
    {
        $(".course-start-date-class").datepicker({
            dateFormat: 'dd-mm-yy',
            defaultDate: -1,
            minDate: new Date(),
        });
    }

    function package_booking_radio_fx(i_val, course_id)
    {
        var choose_pack_id = $("#choose-a-package-id"+i_val).val();
        $("#paypal-package-price-id").val($("#package-hidden-price-id"+i_val).val());
        $("#course-payable-price-id").val($("#package-hidden-price-id"+i_val).val());
        $("#paypal-package-radio-id").val(1);
        $.ajax({
            url: "{{ route('satirtha.package-checking-for-days') }}",
            type: "GET",
            data: {choose_pack_id: choose_pack_id},
            dataType: "json",
            success: function(event){
                $(".booking-dates-for-count-class").html(event.package_for_days);
                $("#lessons-per-week-count-hidden-id").val(event.lessons_per_Week_name);
                $("#lessons-per-month-count-hidden-id").val(event.no_of_lessons_per_month);
                $("#paypal-package-main-course-id").val(course_id);
                $("#booking-no-of-lessons-hidden-id").val($("#package-no-of-lessons-id"+i_val).val());
                // course_start_date_class_fx();
                available_booking_date_fx();
            }, error: function(event){

            }
        });
        if(choose_pack_id == "" || choose_pack_id == null)
        {
            $("#paypal-package-radio-id").val(0);
            error_pass_alert_show_msg("Please choose a package first");
            $("#paypal-package-price-id").val(0);
            $("#package-price-id"+i_val).html("0.00"+"$");
            $("#package-hidden-price-id"+i_val).val(0);
            $("#course-payable-price-id").val(0);
            $("#r"+i_val).prop('checked',false);
            $("#booking-no-of-lessons-hidden-id").val(0);
        }
    }

    function choose_package_fx(id, course_id)
    {
        $("#hidden-course-tbls-id").val(course_id);
        var choose_package = $("#choose-a-package-id"+id).val();
        // $("#paypal-package-price-id").val($("#package-hidden-price-id"+id).val());
        $.ajax({
            url: "{{ route('satirtha.package-checking-for-days') }}",
            type: "GET",
            data: {choose_pack_id: choose_package},
            dataType: "json",
            success: function(event){
                $(".booking-dates-for-count-class").html(event.package_for_days);
                $("#lessons-per-week-count-hidden-id").val(event.lessons_per_Week_name);
                $("#lessons-per-month-count-hidden-id").val(event.no_of_lessons_per_month);
                $("#paypal-package-main-course-id").val(course_id);
                // course_start_date_class_fx();
                available_booking_date_fx();
            }, error: function(event){

            }
        });
        if(choose_package == "" || choose_package == null)
        {
            $("#paypal-package-radio-id").val(0);
            $("#paypal-package-price-id").val(0);
            $("#package-price-id"+id).html("$"+"0.00");
            $("#package-hidden-price-id"+i_val).val(0);
            $("#course-payable-price-id").val(0);
            $("#r"+id).prop('checked',false);
            $("#booking-no-of-lessons-hidden-id").val(0);
        }
        $("#paypal-package-id").val(choose_package);
        $.ajax({
            url: "{{ route('satirtha.change-package-for-booking-slot') }}",
            type: "GET",
            data: {id: choose_package, course_id: course_id},
            dataType: "json",
            success: function(event){
                $("#paypal-package-radio-id").val(1);
                $("#package-price-id"+id).html("$"+event);
                $("#paypal-package-price-id").val(event);
                $("#package-hidden-price-id"+id).val(event);
                $("#course-payable-price-id").val(event);
                $("#booking-no-of-lessons-hidden-id").val($("#package-no-of-lessons-id"+id).val());
            }, error: function(event){

            }
        });
    }

    function course_class_start_time_fx(i_val)
    {
        var course_start_time = $("#course-class-start-time-id"+i_val).val();
        $.ajax({
            url: "{{ route('satirtha.get-end-client-choose-time') }}",
            type: "GET",
            data: {course_start_time: course_start_time},
            dataType: "json",
            success: function(event){
                $("#course-class-end-time-id"+i_val).val(event);
            }, error: function(event){

            }
        })
    }

    function avail_check(i_val)
    {
        var avail_checked_date = $("#course-start-date-id"+i_val).val();
        $.ajax({
            url: "{{ route('satirtha.show-student-available-calender-time-checked-date') }}",
            type: "GET",
            data: {avail_checked_date: avail_checked_date},
            dataType: "json",
            success: function(event){
                $("#avail-date-time-id"+i_val).html(event.whole_main_time);
                $("#booking-interval-hidden-time-id").val(event.interval_time_of_date);
            }, error: function(event){

            }
        })
    }

    function booking_class_previous_time_found_fx(i_val){
        var avail_time = $("#avail-date-time-id"+i_val).val();
        var interval_time = $("#booking-interval-hidden-time-id").val();
        $.ajax({
            url: "{{ route('satirtha.booking-class-previous-time-found') }}",
            type: "GET",
            data: { avail_time: avail_time, interval_time: interval_time },
            dataType: "json",
            success: function(event){
                $("#course-class-start-time-id"+i_val).val(event);
            }, error: function(event){

            }
        });
    }

    function choose_pay_tenure_fx(){
        var payable_month = $("#course-pay-tenure-id").val();
        var payable_price = $("#paypal-package-price-id").val();
        var total_no_of_months = $("#month-count-hidden-id").val();
        var course_hidden_id = $("#hidden-course-tbls-id").val();
        if(payable_month == "full"){
            $.ajax({
                url: "{{ route('satirtha.full-pay-tenure-checking') }}",
                type: "GET",
                data: {course_hidden_id: course_hidden_id},
                dataType: "json",
                success:function(event){
                    if(event == 0){
                        var total_paypable_price = parseFloat(payable_price) * total_no_of_months;
                        $("#course-payable-price-id").val(total_paypable_price);
                    }else{
                        var total_paypable_price = event;
                        $("#course-payable-price-id").val(total_paypable_price);
                    }
                }, error: function(event){

                }
            });
        }else{
            var total_paypable_price = parseFloat(payable_price) * payable_month;
            $("#course-payable-price-id").val(total_paypable_price);
        }
        
    }

    function available_tenure_fx(){
        var total_no_of_lessons = $("#booking-no-of-lessons-hidden-id").val();
        var no_of_lessons_in_month = $("#lessons-per-month-count-hidden-id").val();
        $.ajax({
            url: "{{ route('satirtha.booking-available-tenure') }}",
            type: "GET",
            data: {total_no_of_lessons: total_no_of_lessons, no_of_lessons_in_month: no_of_lessons_in_month},
            dataType: "json",
            success: function(event){
                $("#course-pay-tenure-id").html(event.tenure_time);
                $("#month-count-hidden-id").val(event.no_of_months);
            }, error: function(event){

            }
        });
    }
</script>
@endsection