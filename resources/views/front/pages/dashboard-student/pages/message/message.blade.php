@extends('front.app-student')

@section('content')

<div class="course-page message-page">

  <div class="row">

    <div class="col-lg-8">

      <div class="sec2">                   
        <div class="table-responsive">                   

          <table id="message-table">

            <tr>

              <th>No</th>

              <th>Subject</th>

              <th>Total messages</th>

              <th>Date</th> 

              <th>View</th>                       

            </tr>

            <tr>

              <td colspan=5 class="text-info"><center><i class="fa fa-spinner"></i> Loading messages</center></td>

            </tr>                         

          </table>

        </div>                     
      </div>                     

    </div>

    <div class="col-lg-4">

      <div class="sec3">

        <h2>Contact Messages</h2>

        <a href="javascript:;" onclick="admin_got_A_question_fx()">Got a Question?</a>

        <a href="javascript:;" onclick="teacher_got_A_question_fx()">Contact Teacher</a>

      </div>

    </div>

    <div class="col-lg-8">

      <h5>Message Teacher</h5>

      <div class="sec2">                   
        <div class="table-responsive">                   

          <table id="message-tutor-table-id">

            <tr>

              <th>Subject</th>

              <th>Receiver</th>

              <th>Total messages</th>

              <th>Date</th> 

              <th>View</th>                       

            </tr>

            <tr>

              <td colspan=5 class="text-info"><center><i class="fa fa-spinner"></i> Loading messages</center></td>

            </tr>                         

          </table>

        </div>                     
      </div>                     

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

            <input type="text" class="form-control" onkeydown="return false" name="avail_date_name" id="avail-date-id" onchange="avail_check()">

          </div>

          <div class="form-group">

            <label for="avail-date-id">Time:</label>

            <select class="form-control" name="avail_date_time_name" id="avail-date-time-id">

                <option value="">Choose time</option>

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

<!-- end of message modal -->

<!-- Message Model -->

<div class="modal" id="message-trail-student-send-panel">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Message Portal</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>



      <!-- Modal body -->

      <div class="modal-body">

        <form action="{{ route('satirtha.message-submit') }}" method="POST">

          @csrf

          <input type="hidden" name="message_to_usertype_name" id="message-to-usertype-id" value="admin" />

          <div class="form-group">

            <label for="subject-message-id">Subject:</label>

            <select class="form-control" name="subject_name" placeholder="Enter your subject"  id="subject-message-id">

              <!-- subject message details -->

            </select>

          </div>

          <div class="form-group">

            <label for="subject-message-details-id">Your Query / Message:</label>

            <textarea class="form-control" name="subject_message_name" rows=7 placeholder="Enter your query / message" id="subject-message-details-id"></textarea>

          </div>

          <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </form>

      </div>



      <!-- Modal footer -->

      <!-- <div class="modal-footer"></div> -->



    </div>

  </div>

</div>

<!-- /Message Model -->

<div class="modal" id="message-admin-student-send-panel">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Message Portal</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>



      <!-- Modal body -->

      <div class="modal-body">

          <div class="row">

            <div class="col-lg-12">

                <div class="card card-statistics">

                   <div class="card-body">

                        <div class="row mb-3">

                            <!-- <div class="col-lg-12">

                                <span>

                                    <a class="btn btn-success text-white" onclick="add_tutor_modal_fx()">Add Student</a>

                                </span>

                            </div> -->

                        </div>

                        <div class="datatable-wrapper table-responsive">

                            <table class="display compact table table-striped table-bordered">

                                <tbody>

                                    <tr>

                                        <th>Reply</th>

                                    </tr>

                                    <tr>

                                        <td>

                                            <form>

                                                <input type="hidden" name="msg_tbl_id_name" id="msg-tbl-id" value=""/>

                                                <textarea cols=55 required rows=10 name="student_admin_msg_name" id="student-admin-msg-id"></textarea>

                                                <br/>

                                                <input type="button" onclick="message_submit_fx()" class="btn btn-success" name="student_admin_message_submit" value="Submit" />

                                            </form>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                            <table id="datatable" class="display compact table table-striped table-bordered">

                                <thead>

                                    <tr>

                                        <th>Name</th>

                                        <th>Messages</th>

                                    </tr>

                                </thead>

                                <tbody id="message-submit-section">



                                </tbody>

                                <tfoot>

                                    <tr>

                                        <th>Name</th>

                                        <th>Messages</th>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

          </div>

      </div>



      <!-- Modal footer -->

      <!-- <div class="modal-footer"></div> -->



    </div>

  </div>

</div>



<!-- Student Message Model -->

<div class="modal" id="student-to-teacher-message-id">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Student Message Portal</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

      <div class="modal-body">

        <form action="{{ route('satirtha.student-to-teacher-message-submit') }}" method="POST">

          @csrf

          <input type="hidden" name="message_to_usertype_name" id="teacher-message-to-usertype-id" value="teacher" />

          <div class="form-group">

            <label for="subject-message-id">Course With Teacher:</label>

            <select class="form-control" name="subject_name" placeholder="Enter your subject"  id="teacher-subject-message-id">

              <!-- subject message details -->

            </select>

          </div>

          <div class="form-group">

            <label for="subject-message-details-id">Your Query / Message:</label>

            <textarea class="form-control" name="subject_message_name" rows=7 placeholder="Enter your query / message" id="subject-message-details-id"></textarea>

          </div>

          <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </form>

      </div>

    </div>

  </div>

</div>

<!-- /Student Message Model -->

<div class="modal" id="message-tutor-student-send-panel">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Message Portal</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>



      <!-- Modal body -->

      <div class="modal-body">

          <div class="row">

            <div class="col-lg-12">

                <div class="card card-statistics">

                   <div class="card-body">

                        <div class="row mb-3">

                            <!-- <div class="col-lg-12">

                                <span>

                                    <a class="btn btn-success text-white" onclick="add_tutor_modal_fx()">Add Student</a>

                                </span>

                            </div> -->

                        </div>

                        <div class="datatable-wrapper table-responsive">

                            <table class="display compact table table-striped table-bordered">

                                <tbody>

                                    <tr>

                                        <th>Reply</th>

                                    </tr>

                                    <tr>

                                        <td>

                                            <form>

                                                <input type="hidden" name="msg_tbl_id_name" id="tutor-msg-tbl-id" value=""/>

                                                <textarea cols=55 required rows=10 name="tutor_student_admin_msg_name" id="tutor-student-admin-msg-id"></textarea>

                                                <br/>

                                                <input type="button" onclick="tutor_message_submit_fx()" class="btn btn-success" name="student_admin_message_submit" value="Submit" />

                                            </form>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                            <table id="datatable" class="display compact table table-striped table-bordered">

                                <thead>

                                    <tr>

                                        <th>Name</th>

                                        <th>Messages</th>

                                    </tr>

                                </thead>

                                <tbody id="tutor-message-submit-section">



                                </tbody>

                                <tfoot>

                                    <tr>

                                        <th>Name</th>

                                        <th>Messages</th>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

          </div>

      </div>



      <!-- Modal footer -->

      <!-- <div class="modal-footer"></div> -->



    </div>

  </div>

</div>

@endsection

@section('jsContent')

<script>



    $(function(){

      load_teacher_message_fx();

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

      });

      checking_total_message_fx(); 

    })



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



  /* Message */

  function admin_got_A_question_fx()

  {

    $("#message-trail-student-send-panel").modal('show');

    $.ajax({

      url: "{{ route('satirtha.message-trail-student-subject-choose') }}",

      type: "GET",

      dataType: "json",

      success: function(event){

        $("#subject-message-id").html(event.subject_html);

      }, error: function(event){



      }

    })

  }

  /* checking messages */

  function checking_total_message_fx()

  {

    $.ajax({

      url: "{{ route('satirtha.checking-total-message-fx') }}",

      type: "GET",

      dataType: "json",

      success: function(response){

        $("#message-table").html(response.msg_html);

      }, error: function(response){



      }

    })

  }

  /* End Message */

  function total_count_panel_fx(id){

    $("#message-admin-student-send-panel").modal('show');

    $.ajax({

      url: "{{ route('satirtha.student-admin-msg-fx') }}",

      type: "GET",

      data: {id: id},

      dataType: "json",

      success: function(event){

        $("#message-submit-section").html(event.student_admin_html);

        $("#msg-tbl-id").val(event.student_admin_primary_id);

      }, error: function(event){



      }

    })

  }



  function message_submit_fx(){

    var msg_tbl_id = $("#msg-tbl-id").val();

    var message_des = $("#student-admin-msg-id").val();

    $.ajax({

      url: "{{ route('satirtha.student-admin-msg-submitting-fx') }}",

      type: "GET",

      data: {msg_tbl_id: msg_tbl_id, message_des: message_des},

      dataType: "json",

      success: function(event){

                    if(event == "success"){

                        success_pass_alert_show_msg("Successfully message sent ");

                        total_count_panel_fx(msg_tbl_id);

                        $("#student-admin-msg-id").val("");

                    }else if(event == "error"){

                        error_pass_alert_show_msg("Try again! Something went wrong");

                    }

      }, error: function(event){



      }

    })

  }



  function teacher_got_A_question_fx(){

    $("#student-to-teacher-message-id").modal('show');

    $.ajax({

      url: "{{ route('satirtha.message-contact-student-teacher-course') }}",

      type: "GET",

      dataType: "json",

      success: function(event){

        $("#teacher-subject-message-id").html(event);

      }, error: function(event){



      }

    });

  }



  function load_teacher_message_fx(){

    $.ajax({

      url: "{{ route('satirtha.load-teacher-message-fx') }}",

      type: "GET",

      dataType: "json",

      success: function(response){

        $("#message-tutor-table-id").html(response.inbox_msg);

      }, error: function(response){



      }

    });

  }



  function send_message_student_to_teacher(id){

    $("#message-tutor-student-send-panel").modal('show');

    $("#tutor-msg-tbl-id").val(id);

    load_all_sub_msg_fx(id);

    

  }



  function load_all_sub_msg_fx(id){

    $.ajax({

      url: "{{ route('satirtha.get-teacher-message-fx') }}",

      type: "GET",

      data: {id: id},

      dataType: "json",

      success: function(response){

        $("#tutor-message-submit-section").html(response);

      }, error: function(response){



      }

    })

  }



  function tutor_message_submit_fx(){

    var tutor_msg_id = $("#tutor-msg-tbl-id").val();

    var tutor_student_msg = $("#tutor-student-admin-msg-id").val();



    $.ajax({

      url: "{{ route('satirtha.send-message-teacher-submit') }}",

      type: "GET",

      data: {tutor_msg_id: tutor_msg_id, tutor_student_msg: tutor_student_msg},

      dataType: "json",

      success: function(event){

        if(event == "success"){

          load_all_sub_msg_fx(tutor_msg_id);

        }else if(event == "error"){

          

        }

      }, error: function(event){



      }

    })

  }

</script>

@endsection