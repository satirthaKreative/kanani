@extends('front.app-student')
@section('content')
          <div class="course-page message-page">
                <div class="row">
                    <div class="col-lg-8">
                    <div class="sec2">                   
                       <table>
                          <tr>
                            <th>No</th>
                            <th>Subject</th>
                            <th>Total messages</th>
                            <th>Date</th>                        
                          </tr>
                          <tr>
                            <td>#1</td>
                            <td>Spken english lession 2</td>
                            <td>22 Messages</td>
                            <td>25/10/2021 - 11:20 AM</td>                       
                          </tr>
                          <tr>
                            <td>#2</td>
                            <td>Spken english lession 2</td>
                            <td>22 Messages</td>
                            <td>25/10/2021 - 11:20 AM</td>                       
                          </tr>
                          <tr>
                            <td>#3</td>
                            <td>Spken english lession 2</td>
                            <td>22 Messages</td>
                            <td>25/10/2021 - 11:20 AM</td>                       
                          </tr>
                          <tr>
                            <td>#4</td>
                            <td>Spken english lession 2</td>
                            <td>22 Messages</td>
                            <td>25/10/2021 - 11:20 AM</td>                       
                          </tr>
                          <tr>
                            <td>#5</td>
                            <td>Spken english lession 2</td>
                            <td>22 Messages</td>
                            <td>25/10/2021 - 11:20 AM</td>                       
                          </tr>
                          <tr>
                            <td>#6</td>
                            <td>Spken english lession 2</td>
                            <td>22 Messages</td>
                            <td>25/10/2021 - 11:20 AM</td>                       
                          </tr>                          
                      </table>
                     </div>                     
                    </div>
                    <div class="col-lg-4">
                        <div class="sec3">
                            <h2>Phasellus malesuada posuere purus</h2>
                            <a href="#">Got a Question?</a>
                            <a href="javascript: ;" onclick="contact_teacher_modal_fx()">Contact Teacher</a>
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
            <input type="text" class="form-control" name="avail_date_name" id="avail-date-id" onchange="avail_check()">
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
</script>
@endsection