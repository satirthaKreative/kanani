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
                                        <h1>Free Trail</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Free Trail Table</li>
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
                                                    <a class="btn btn-success text-white" onclick="add_free_trail_modal_fx()">Add Free Trail</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Available Date</th>
                                                        <th>Available Time</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($trailQuery as $ck)
                                                    <tr>
                                                        <td>{{ $ck->teachers_date }}</td>
                                                        <td>{{ date('H:i',strtotime($ck->avail_from_time)) }} -- {{ date('H:i',strtotime($ck->avail_to_time)) }} </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->teachers_avail == "active"){
                                                                    $coun_state = "<b class='text-success'>Active</b>"; 
                                                                }else if($ck->teachers_avail == "inactive"){
                                                                    $coun_state = "<b class='text-danger'>Inactive</b>"; 
                                                                }
                                                                echo $coun_state;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->teachers_avail == "active"){
                                                                    $update_state = "inactive"; 
                                                                }else if($ck->teachers_avail == "inactive"){
                                                                    $update_state = "active"; 
                                                                }
                                                            ?>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="config_free_trail_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="config_free_trail_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="config_free_trail_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Available Date</th>
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


<!-- The Add free trail Modal -->
<div class="modal" id="add-free-trail-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Free Trail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-admin-free-trail') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="available-date-id">Available Date:</label>
                <input type="date" class="form-control" placeholder="available date" id="available-date-id" name="avail_date_name" />
            </div>
            <div class="form-group">
                <label for="available-date-id">TimeZone:</label>
                <select class="form-control" name="timezone_name" id="time-zone-id" required>
                    <option value="">Choose timezone</option>  
                    @foreach($countryTimezoneQuery as $countryTime)
                        <option value="{{ $countryTime->id }}">{{ ucwords($countryTime->TimeZone) }} ( {{ $countryTime->UTCoffset }} )</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="avail-from-time-id">Available From Time:</label>
                <input type="time" class="form-control" id="avail-from-time-id" name="avail_from_time_name" />
            </div>
            <div class="form-group">
                <label for="avail-to-time-id">Available To Time:</label>
                <input type="time" class="form-control" id="avail-to-time-id" name="avail_to_time_name" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /The Add free trail Modal -->
<!-- The edit free trail Modal -->
<div class="modal" id="edit-free-trail-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Free Trail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.update-admin-free-trail') }}" method="POST">
            @csrf
            <input type="hidden" name="free_trail_hidden_name" id="free-trail-hidden-id" value="0">
            <div class="form-group">
                <label for="edit-available-date-id">Available Date:</label>
                <input type="date" class="form-control" placeholder="available date" id="edit-available-date-id" name="avail_date_name" />
            </div>
            <div class="form-group">
                <label for="available-date-id">Timezone:</label>
                <select class="form-control" name="timezone_name" id="edit-time-zone-id" required>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="edit-avail-from-time-id">Available From Time:</label>
                <input type="time" class="form-control" id="edit-avail-from-time-id" name="avail_from_time_name" />
            </div>
            <div class="form-group">
                <label for="edit-avail-to-time-id">Available To Time:</label>
                <input type="time" class="form-control" id="edit-avail-to-time-id" name="avail_to_time_name" />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /The edit free trail Modal -->
@endsection
@section('adminjsContent')
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
    function add_free_trail_modal_fx(){
        $("#add-free-trail-modal").modal('show');
    }

    function from_free_trail_fx(){
        alert($("#avail-from-time-id").val());
    }

    function config_free_trail_edit_fx(lang_val){
        $("#edit-free-trail-modal").modal('show');
        $.ajax({
            url: "{{ route('admin.edit-admin-free-trail') }}",
            type: "GET",
            data: {id: lang_val},
            dataType: "json",
            success: function(event){
                $("#free-trail-hidden-id").val(lang_val);
                $("#edit-available-date-id").val(event.avail_date);
                $("#edit-avail-from-time-id").val(event.avail_from);
                $("#edit-avail-to-time-id").val(event.avail_to);
                $("#edit-time-zone-id").html(event.avail_timezone);
            }, error: function(event){

            }
        })
    }

    function config_free_trail_del_fx(lang_val){
        var x = confirm('Are you sure to delete this?');
        if(x){
            $.ajax({
                url: "{{ route('admin.del-admin-free-trail') }}",
                type: "GET",
                data: {id: lang_val},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this ");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function config_free_trail_change_state_fx(lang_val,update_state){
        $.ajax({
            url: "{{ route('admin.change-admin-free-trail') }}",
            type: "GET",
            data: {id: lang_val, new_state: update_state},
            dataType: "json",
            success: function(event){
                if(event == "success"){
                    success_pass_alert_show_msg("Successfully update the status");
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