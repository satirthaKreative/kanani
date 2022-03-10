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
                <div class="col-lg-12">
                    <div class="sec2">                   
                       <table>
                          <tbody id="assigned-schedule-id">
                            <tr>
                              <th>#</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Course</th>   
                              <th>Level</th>
                              <th>Unit</th>  
                              <th>Lesson</th>  
                              <th>Student Name</th>                    
                            </tr>
                            <tr>
                              <td colspan=8><center class="text-danger"><i class="fa fa-spinner"></i> Load your classes</center></td>
                            </tr>
                      </tbody></table>
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
@endsection
@section('jsContent')
<script>
  $(function(){
    load_schedule_fx();
  });

  function load_schedule_fx(){
    $.ajax({
      url: "{{ route('satirtha.load-schedule-data-fx') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $("#assigned-schedule-id").html(event);
      }, error: function(event){

      }
    })
  }
</script>
@endsection
