@extends('front.app-teacher')
@section('content')
<style>
  .tutor-compose-class > a{
    margin-left: 10px;
    background-color: #1A4568;
    color: #ffffff;
    border: 1px solid #1A4568;
    border-radius: 0px !important;
  }
</style>
            <div class="course-page message-page teacher-massege">
              <div class="row">
                <div class="col-6 align-items-center d-flex tutor-compose-class">
                  <h2>Messages</h2>
                  <a class="btn btn-info btn-sm" href="javascript:;" onclick="compose_modal_fx()">Compose</a>
                </div>
                <div class="col-6 align-items-center d-flex justify-content-end">
                  <div class="pto">
                    <a href="#"><</a> <span>1 - 50  pages </span> <a href="#">></a>
                  </div>
                  <div class="ms-tbox">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">All</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Sent</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Inbox</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="sec2">  
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">                 
                      <table>
                          <tbody id="all-inbox-message-table-id">
                              <tr>
                                <td colspan=4 class="text-info"><center><i class="fa fa-spinner"></i> load your all messages</center></td>                        
                              </tr>  
                          </tbody>                      
                      </table>
                    </div> 
                    <div class="tab-pane" id="tabs-2" role="tabpanel">                 
                      <table>
                         <tbody id="sent-message-table-id">
                              <tr>
                                <td colspan=4 class="text-info"><center><i class="fa fa-spinner"></i> load your sent message</center></td>                        
                              </tr>  
                          </tbody>                      
                      </table>
                     </div> 
                     <div class="tab-pane" id="tabs-3" role="tabpanel">                 
                      <table>
                          <tbody id="inbox-message-table-id">
                              <tr>
                                <td colspan=4 class="text-info"><center><i class="fa fa-spinner"></i> load your inbox message</center></td>                        
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


<!-- The Message Modal -->
<div class="modal" id="messageModalId">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Message Modal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('satirtha.tutor-course-submit-fx') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="student-course-name-id">Choose Student With Course Name:</label>
            <select class="form-control" id="student-course-name-id" name="student_course_name">
              <option value="">Choose a student name & course name </option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-name-id">Messages:</label>
            <textarea class="form-control" id="message-name-id" name="message_name" rows=5></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
                                                <input type="button" onclick="tutor_student_message_submit_fx()" class="btn btn-success" name="student_admin_message_submit" value="Submit" />
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
    load_message_fx();
  });
  function compose_modal_fx(){
    $("#messageModalId").modal('show');
  }

  function load_sent_message_fx(){
    $.ajax({
      url: "{{ route('satirtha.load-sent-message-fx') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $("#sent-message-table-id").html(event.tutor_msg);
        load_inbox_message_fx();
      }, error: function(event){

      }
    })
  }

  function load_message_fx(){
    $.ajax({
      url: "{{ route('satirtha.tutor-message-assign-course-tutor') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $("#student-course-name-id").html(event);
        load_sent_message_fx();
      }, error: function(event){

      }
    })
  }

  function load_inbox_message_fx(){
    $.ajax({
      url: "{{ route('satirtha.load-inbox-message-fx') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $("#inbox-message-table-id").html(event.inbox_msg);
        load_all_message_list_fx();
      }, error: function(event){

      }
    });
  }

  function load_all_message_list_fx(){
    $.ajax({
      url: "{{ route('satirtha.load-all-message-fx') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $("#all-inbox-message-table-id").html(event.inbox_msg);
      }, error: function(event){

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
      url: "{{ route('satirtha.get-teacher-student-message-fx') }}",
      type: "GET",
      data: {id: id},
      dataType: "json",
      success: function(response){
        $("#tutor-message-submit-section").html(response);
      }, error: function(response){

      }
    })
  }

  function load_all_sub_msg_fx(id){
    $.ajax({
      url: "{{ route('satirtha.get-teacher-student-message-fx') }}",
      type: "GET",
      data: {id: id},
      dataType: "json",
      success: function(response){
        $("#tutor-message-submit-section").html(response);
      }, error: function(response){

      }
    })
  }

  function tutor_student_message_submit_fx(){
    var tutor_msg_id = $("#tutor-msg-tbl-id").val();
    var tutor_student_msg = $("#tutor-student-admin-msg-id").val();

    $.ajax({
      url: "{{ route('satirtha.send-message-teacher-student-submit') }}",
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