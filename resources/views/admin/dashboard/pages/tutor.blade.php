@extends('admin.layouts.app-dashboard')
 
@section('content')
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Tutors</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="javascript:;"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    Tables
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Tutors Table</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- begin row -->
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <span>
                                                    <a class="btn btn-success text-white" onclick="add_tutor_modal_fx()">Add Tutor</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>User Name</th>
                                                        <th>User Email</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($checkQuery as $ck)
                                                    <tr>
                                                        <td>{{ ucwords($ck->first_name) }} {{ ucwords($ck->last_name) }}</td>
                                                        <td>{{ strtolower($ck->email) }}</td>
                                                        <td>
                                                            <?php 
                                                                if($ck->tutor_state == "active"){
                                                                    $coun_state = "<b class='text-success'>Active</b>"; 
                                                                }else if($ck->tutor_state == "inactive"){
                                                                    $coun_state = "<b class='text-danger'>Inactive</b>"; 
                                                                }
                                                                echo $coun_state;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->tutor_state == "active"){
                                                                    $update_state = "inactive"; 
                                                                }else if($ck->tutor_state == "inactive"){
                                                                    $update_state = "active"; 
                                                                }
                                                            ?>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="tutor_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="tutor_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="tutor_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>User Name</th>
                                                        <th>User Email</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>


<!-- The Add language Modal -->
<div class="modal" id="add-tutor-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Tutor</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-tutor') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="first-name-text-modal">Enter Your First Name:</label>
                <input type="text" required class="form-control" placeholder="Enter first name" id="first-name-text-modal" name="modal_first_name">
            </div>
            <div class="form-group">
                <label for="last-name-text-modal">Enter Your Last Name:</label>
                <input type="text" required class="form-control" placeholder="Enter last name" id="last-name-text-modal" name="modal_last_name">
            </div>
            <div class="form-group">
                <label for="email-text-modal">Enter Your Email:</label>
                <input type="email" required class="form-control" placeholder="Enter email " id="email-text-modal" name="modal_email_name">
            </div>
            <div class="form-group">
                <label for="password-text-modal">Enter Your Password:</label>
                <input type="text" readonly class="form-control" placeholder="Enter password" id="password-text-modal" name="modal_password_name" value="secret00"> 
                <sub class="text-danger">Password: secret00</sub>
            </div>
            <div class="form-group">
                <label for="file-text-modal">Choose Your Image:</label>
                <input type="file" class="form-control" placeholder="Enter file name " id="file-text-modal" name="modal_file_name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- The Edit language Modal -->
<div class="modal" id="edit-tutor-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Tutor</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.update-tutor') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="edit_tutor_hidden_id_name" id="edit-tutor-name-hidden-id" value="" />
            <div class="form-group">
                <label for="edit-first-name-text-modal">Enter Your First Name:</label>
                <input type="text" required class="form-control" placeholder="Enter first name" id="edit-first-name-text-modal" name="modal_first_name">
            </div>
            <div class="form-group">
                <label for="edit-last-name-text-modal">Enter Your Last Name:</label>
                <input type="text" required class="form-control" placeholder="Enter last name" id="edit-last-name-text-modal" name="modal_last_name">
            </div>
            <div class="form-group">
                <label for="edit-email-text-modal">Enter Your Email:</label>
                <input type="email" required class="form-control" placeholder="Enter email " id="edit-email-text-modal" name="modal_email_name">
            </div>
            <div class="form-group">
                <label for="password-text-modal">Enter Your Password:</label>
                <input type="text" readonly class="form-control" placeholder="Enter password" id="password-text-modal" name="modal_password_name" value="secret00"> 
                <sub class="text-danger">Password: secret00</sub>
            </div>
            <div class="form-group">
                <label for="file-text-modal">Choose Your Image:</label>
                <input type="file" class="form-control" placeholder="Enter file name " id="file-text-modal" name="modal_file_name">
            </div>
            <div class="img-edit-panel">

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('adminjsContent')
<script>
    function add_tutor_modal_fx(){
        $("#add-tutor-Modal").modal('show');
    }

    function tutor_edit_fx(lang_val){
        $("#edit-tutor-Modal").modal('show');
        $.ajax({
            url: "{{ route('admin.edit-tutor') }}",
            type: "GET",
            data: {id: lang_val},
            dataType: "json",
            success: function(event){
                $("#edit-tutor-name-hidden-id").val(lang_val);
                $("#edit-first-name-text-modal").val(event.first_name);
                $("#edit-last-name-text-modal").val(event.last_name);
                $("#edit-email-text-modal").val(event.email);
                $(".img-edit-panel").html(event.img_file);
            }, error: function(event){

            }
        })
    }

    function tutor_del_fx(lang_val){
        var x = confirm('Are you sure to delete this tutor?');
        if(x){
            $.ajax({
                url: "{{ route('admin.del-tutor') }}",
                type: "GET",
                data: {id: lang_val},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this tutor");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function tutor_change_state_fx(lang_val,update_state){
        $.ajax({
            url: "{{ route('admin.change-status-tutor') }}",
            type: "GET",
            data: {id: lang_val, new_state: update_state},
            dataType: "json",
            success: function(event){
                if(event == "success"){
                    success_pass_alert_show_msg("Successfully update the status of this tutor");
                    location.reload();
                }else if(event == "error"){
                    error_pass_alert_show_msg("Try again! Something went wrong");
                }
            }, error: function(event){

            }
        })
    }
</script>
@endsection