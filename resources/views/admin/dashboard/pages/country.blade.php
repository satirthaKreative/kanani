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
                                        <h1>Country</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Country Table</li>
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
                                                    <a class="btn btn-success text-white" onclick="add_country_modal_fx()">Add Country</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Country</th>
                                                        <th>Country Code</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($checkQuery as $ck)
                                                    <tr>
                                                        <td>{{ ucwords($ck->country_name) }}</td>
                                                        <td>{{ ucwords($ck->country_code) }}</td>
                                                        <td>
                                                            <?php 
                                                                if($ck->country_state == "active"){
                                                                    $coun_state = "<b class='text-success'>Active</b>"; 
                                                                }else if($ck->country_state == "inactive"){
                                                                    $coun_state = "<b class='text-danger'>Inactive</b>"; 
                                                                }
                                                                echo $coun_state;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->country_state == "active"){
                                                                    $update_state = "inactive"; 
                                                                }else if($ck->country_state == "inactive"){
                                                                    $update_state = "active"; 
                                                                }
                                                            ?>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="country_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="country_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="country_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Country</th>
                                                        <th>Country Code</th>
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
<div class="modal" id="add-country-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Country</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-country') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="country-text-modal">Enter a country:</label>
                <input type="text" class="form-control" placeholder="Enter country" id="country-text-modal" name="modal_country_name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- The Edit language Modal -->
<div class="modal" id="edit-country-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Country</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.update-country') }}" method="POST">
            @csrf
            <input type="hidden" name="edit_country_hidden_id_name" id="edit-country-name-hidden-id" value="" />
            <div class="form-group">
                <label for="edit-country-text-modal">Enter a country:</label>
                <input type="text" class="form-control" placeholder="Enter country" id="edit-country-text-modal" name="edit_modal_country_name">
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
    function add_country_modal_fx(){
        $("#add-country-Modal").modal('show');
    }

    function country_edit_fx(lang_val){
        $("#edit-country-Modal").modal('show');
        $.ajax({
            url: "{{ route('admin.edit-country') }}",
            type: "GET",
            data: {id: lang_val},
            dataType: "json",
            success: function(event){
                $("#edit-country-text-modal").val(event.edit_country);
                $("#edit-country-name-hidden-id").val(lang_val);
            }, error: function(event){

            }
        })
    }

    function country_del_fx(lang_val){
        var x = confirm('Are you sure to delete this country?');
        if(x){
            $.ajax({
                url: "{{ route('admin.del-country') }}",
                type: "GET",
                data: {id: lang_val},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this country");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function country_change_state_fx(lang_val,update_state){
        $.ajax({
            url: "{{ route('admin.change-status-country') }}",
            type: "GET",
            data: {id: lang_val, new_state: update_state},
            dataType: "json",
            success: function(event){
                if(event == "success"){
                    success_pass_alert_show_msg("Successfully update the status of this country");
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