@extends('front.app-teacher')
@section('content')
<style>
    #btn-calender-submit{ 
        margin-top: 10px !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        line-height: 0px !important ;
        padding: 16px !important;
    }
    .my-account-page form {
        max-width: 1031px;
    }

    .fc-event-container > .fc-day-grid-event > .fc-content > .fc-title{
        color: #fff !important;
    }
    .fc-event-container > .fc-day-grid-event > .fc-content{
        background-color: #1a4568;
    }
    .fc-event-container > .fc-day-grid-event {
        background-color: #1a4568;
    }
    .fc-event-container {
        background-color: #1a4568;
    }
</style>
<div class="my-account-page teacher-account">
    <h2>Time schedule</h2>
        <!-- <form action="{{ route('satirtha.teacher-calender-day-date-submit') }}" method="GET" id="myform">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div id="arrName-calender-id">
                    
                    </div>
                    <label for="dateofbirth">Calender day's</label>
                    <div class="row">
                        <div class="col-lg-1">
                            <input type="checkbox" value="1" id="calendar_day1" name="monday_name" onclick="calender_days(1)"/>
                        </div>
                        <div class="col-lg-2">
                            <span>Monday</span>
                        </div>
                        <div class="col-lg-1">
                            <input type="checkbox" value="2" id="calendar_day2" name="tuesday_name" onclick="calender_days(2)"/>
                        </div>
                        <div class="col-lg-2">
                            <span>Tuesday</span>
                        </div>
                        <div class="col-lg-1">
                            <input type="checkbox" value="3" id="calendar_day3" name="wednesday_name" onclick="calender_days(3)"/> 
                        </div>
                        <div class="col-lg-2">
                            <span>Wednesday</span>
                        </div>
                        <div class="col-lg-1">
                            <input type="checkbox" value="4" id="calendar_day4" name="thursday_name" onclick="calender_days(4)"/> 
                        </div>
                        <div class="col-lg-2">
                            <span>Thursday</span>
                        </div>
                        <div class="col-lg-1">
                            <input type="checkbox" value="5" id="calendar_day5" name="friday_name" onclick="calender_days(5)"/> 
                        </div>
                        <div class="col-lg-2">
                            <span>Friday</span>
                        </div>
                        <div class="col-lg-1">
                            <input type="checkbox" value="6" id="calendar_day6" name="saturday_name" onclick="calender_days(6)"/> 
                        </div>
                        <div class="col-lg-2">
                            <span>Saturday</span>
                        </div>
                        <div class="col-lg-1">
                            <input type="checkbox" value="7" id="calendar_day7" name="sunday_name" onclick="calender_days(7)"/> 
                        </div>
                        <div class="col-lg-2">
                            <span>Sunday</span>
                        </div>
                    </div> 
                      
                    <div class="row" id="daywish-timeframe-id">

                    </div>
                </div>
                
                <div class="col-lg-12">
                    <input type="hidden" name="calender_count_name" id="calender-count-id" value="0">
                    <input type="submit" value="Submit">
                </div>
            </div>
        </form> -->
        <div class="panel panel-primary">
            <div class="panel-body">    
            <form action="{{ route('satirtha.teacher-calender-add') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @elseif (Session::has('warnning'))
                        <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
                    @endif
                </div>
                
                <input type="hidden" name="event_name" class="form-control" value="My Classes" Required/>
                <div class="col-xs-5 col-sm-5 col-md-4">
                    <div class="form-group">
                        <label for="available_date_name">Available Date:</label>
                        <div class="">
                            <input type="date" name="available_date_name" class="form-control" />
                            {!! $errors->first('available_date_name', '<p class="alert alert-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label for="start_time_name">Start Time:</label>
                        <div class="">
                            <input type="time" name="start_time_name" class="form-control" required/>
                            {!! $errors->first('start_time_name', '<p class="alert alert-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label for="end_time_name">End Time:</label>
                        <div class="">
                            <input type="time" name="end_time_name" class="form-control" required/>
                            {!! $errors->first('end_time_name', '<p class="alert alert-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="col-xs-1 col-sm-1 col-md-2 text-center"> &nbsp;<br/>
                    <input type="submit" value="Add Event" class="btn btn-primary btn-sm" id="btn-calender-submit">
                </div>
            </div>
            </form>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">My Classes</div>
            <div class="panel-body" >
                <?php echo  $calendar_details->calendar(); ?>
            </div>
        </div>
</div>
@endsection
@section('jsContent')
<!-- Scripts -->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

{!! $calendar_details->script() !!}
<script>
    // function calender_days(val_name){
    //     var count = $("#calender-count-id").val();
    //     if ($("#calendar_day"+val_name).prop('checked') == true){
    //         // day wish calender
    //         if($("#calendar_day"+val_name).val() == 1 || $("#calendar_day"+val_name).val() == '1'){
    //             var selected_day = "Monday";
    //         }else if($("#calendar_day"+val_name).val() == 2 || $("#calendar_day"+val_name).val() == '2'){
    //             var selected_day = "Tuesday";
    //         }else if($("#calendar_day"+val_name).val() == 3 || $("#calendar_day"+val_name).val() == '3'){
    //             var selected_day = "Wednesday";
    //         }else if($("#calendar_day"+val_name).val() == 4 || $("#calendar_day"+val_name).val() == '4'){
    //             var selected_day = "Thursday";
    //         }else if($("#calendar_day"+val_name).val() == 5 || $("#calendar_day"+val_name).val() == '5'){
    //             var selected_day = "Friday";
    //         }else if($("#calendar_day"+val_name).val() == 6 || $("#calendar_day"+val_name).val() == '6'){
    //             var selected_day = "Saturday";
    //         }else if($("#calendar_day"+val_name).val() == 7 || $("#calendar_day"+val_name).val() == '7'){
    //             var selected_day = "Sunday";
    //         }
    //         // day wish calender
    //         $("#arrName-calender-id").append("<input type='hidden' name='arrName[]' value='"+val_name+"' id='calendar-day-id"+val_name+"'/>");
    //         $("#daywish-timeframe-id").append('<div class="col-lg-12"><label for="daywish-timeframe" class="daywish-timeframe-class'+val_name+'">Available Timeframe On '+selected_day+'</label><input type="hidden" name="" /></div><div class="col-lg-6 daywish-timeframe-class'+val_name+'"><label for="">Start time</label><input type="time"  placeholder="00:00" name="start_time_name'+val_name+'"/></div><div class="col-lg-6 daywish-timeframe-class'+val_name+'"><label for="">End time</label><input type="time" placeholder="00:00" name="end_time_name'+val_name+'"></div>');
    //         count = parseInt(count)+1;
    //         $("#calender-count-id").val(count);
    //     }else if ($("#calendar_day"+val_name).prop('checked') == false){
    //         $("#calendar-day-id"+val_name).remove();
    //         $(".daywish-timeframe-class"+val_name).remove();
    //         count = parseInt(count)-1;
    //         $("#calender-count-id").val(count);
    //     }
    // }
</script>
@endsection