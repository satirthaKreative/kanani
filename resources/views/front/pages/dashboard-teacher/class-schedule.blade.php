@extends('front.app-teacher')
@section('content')
            <div class="course-page message-page schedule ckl">
              <div class="row">
                <div class="col-6">
                  <h2>Schedule</h2>
                </div>
                <div class="col-6 text-right">
                  <!-- <a class="add" data-toggle="modal" data-target="#squarespaceModal">Add</a> -->
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <form action="">
                    <div class="form-group">
                      <label for="choose-a-course-id">Choose a course</label>
                      <select class="form-control" id="choose-a-course-id" name="choose_a_course_name" onchange="change_courses_for_share_zoom_fx()">
                        <option value="">Choose a course</option>
                      </select>
                    </div>
                  </form>
                </div>
                <div class="col-lg-6"></div>
                
                <div class="col-lg-12">
                    <div class="sec2">                   
                        <table>
                          <tbody id="class-schedule-assign-table-id">
                            <tr>
                              <th>Student Name</th>
                              <th>Course Name</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Zoom Link</th>
                              <th>Send Link</th>                      
                            </tr>

                            <!-- <tr>
                              <td colspan=6><center class="text-info"><i class="fa fa-spinner"></i> Load your course classes</center></td>
                            </tr> -->
                            <tr>
                              <td colspan=6>
                                <center class="text-warning"><i class="fa fa-envelope"></i> Please choose your course first</center>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div> 
                    </div> 
                  </div>              
            </div>
        </div>



    </div>
</div>

<div class="modal fade custom-md" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Send Zoom Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="">
          <label> Link</label>
          <input type="text" placeholder="zoommtg://zoom.us/join?confno=3930404545">
          <button type="button" class="btn sub">Send</button>
        </form>

      </div>
        
    </div>
  </div>
</div>


<!-- line modal -->
<div class="modal fade custom-md" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="lineModalLabel">My Modal</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
    </div>
    <div class="modal-body">
      <form>
          <div class="row">
          <div class=" col-lg-6">
            <label for="">Student name</label>
            <input type="text" placeholder="alex Zender">
          </div>
          <div class=" col-lg-6">
            <label for="">Student email</label>
            <input type="email" placeholder="alex@example.com">
          </div>
          <div class=" col-lg-6">
            <label>Couse name</label>
             <select>
               <option>ENG - 3054</option>
               <option>ENG - 3054</option>
               <option>ENG - 3054</option>
             </select>
          </div>
          <div class=" col-lg-6">
            <label>Couse roll type</label>
             <select>
               <option>Adult</option>
               <option>Teen</option>
               <option>Child</option>
             </select>
          </div>
           <div class=" col-lg-6">
            <label for="">Start time</label>
            <input type="time" placeholder="00:00">
          </div>
          <div class=" col-lg-6">
            <label>End time</label>
             <input type="time" placeholder="00:00">
          </div>
          <div class="col-lg-12">
            <label> Link</label>
          <input type="text" placeholder="zoommtg://zoom.us/join?confno=3930404545">
          </div>
        </div>
           <button type="button" class="btn sub">Send</button>
        </form>

    </div>
  </div>
  </div>
</div>

<!-- zoom link  -->
<div class="modal" id="class-schedule-zoom-links-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Zoom Link</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('satirtha.send-zoom-link-fx') }}" method="POST">
          @csrf
          <input type="hidden" id="table-name-id" name="table_name" value="" />
          <input type="hidden" id="zoom-name-id" name="zoom_id_name" value="" />
          <div class="form-group">
            <label for="zoom-link-id">Zoom Link</label>
            <textarea class="form-control" placeholder="Enter zoom link" name="zoom_links_name" id="zoom-link-id"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /zoom link -->
@endsection
@section('jsContent')
<script>
  $(function(){
    load_courses_fx();
  });

  function load_courses_fx(){
    $.ajax({
      url: "{{ route('satirtha.load-course-share-zoom-fx') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $("#choose-a-course-id").html(event.zoom_link_details);
      }, error: function(event){

      }
    });
  }

  function change_courses_for_share_zoom_fx(){
    var assign_course_tutor_id = $("#choose-a-course-id").val();
    $.ajax({
      url: "{{ route('satirtha.course-zoom-share-fx') }}",
      type: "GET",
      data: {course_id: assign_course_tutor_id},
      dataType: "json",
      success: function(event){
        $("#class-schedule-assign-table-id").html(event.total_booking_html);
      }, error: function(event){

      }
    });
  }

  function send_zoom_link(id, table_name){
    $("#class-schedule-zoom-links-id").modal('show');
    $("#table-name-id").val(table_name);
    $("#zoom-name-id").val(id);
  }
</script>
@endsection
