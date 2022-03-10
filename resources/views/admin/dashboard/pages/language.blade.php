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
                                        <h1>Native Language</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Language Table</li>
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
                                                    <a class="btn btn-success text-white" onclick="add_lang_modal_fx()">Add Language</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Languages</th>
                                                        <th>Entry date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($checkQuery as $ck)
                                                    <tr>
                                                        <td>{{ ucwords($ck->language_name) }}</td>
                                                        <td>{{ date('M d, Y',strtotime($ck->created_at)) }}</td>
                                                        <td>
                                                            <?php 
                                                                if($ck->language_state == "active"){
                                                                    $lang_state = "<b class='text-success'>Active</b>"; 
                                                                }else if($ck->language_state == "inactive"){
                                                                    $lang_state = "<b class='text-danger'>Inactive</b>"; 
                                                                }
                                                                echo $lang_state;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->language_state == "active"){
                                                                    $update_state = "inactive"; 
                                                                }else if($ck->language_state == "inactive"){
                                                                    $update_state = "active"; 
                                                                }
                                                            ?>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="lang_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="lang_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="lang_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Languages</th>
                                                        <th>Entry date</th>
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
<div class="modal" id="add-lang-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Language</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-language') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="lang-text-modal">Enter a language:</label>
                <input type="text" class="form-control" placeholder="Enter language" id="lang-text-modal" name="modal_lang_name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- The Edit language Modal -->
<div class="modal" id="edit-lang-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Language</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.update-language') }}" method="POST">
            @csrf
            <input type="hidden" name="edit_lang_hidden_id_name" id="edit-lang-name-hidden-id" value="" />
            <div class="form-group">
                <label for="edit-lang-text-modal">Enter a language:</label>
                <input type="text" class="form-control" placeholder="Enter language" id="edit-lang-text-modal" name="edit_modal_lang_name">
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
    function add_lang_modal_fx(){
        $("#add-lang-Modal").modal('show');
    }

    function lang_edit_fx(lang_val){
        $("#edit-lang-Modal").modal('show');
        $.ajax({
            url: "{{ route('admin.edit-language') }}",
            type: "GET",
            data: {id: lang_val},
            dataType: "json",
            success: function(event){
                $("#edit-lang-text-modal").val(event.lang_edit_language);
                $("#edit-lang-name-hidden-id").val(lang_val);
            }, error: function(event){

            }
        })
    }

    function lang_del_fx(lang_val){
        var x = confirm('Are you sure to delete this language?');
        if(x){
            $.ajax({
                url: "{{ route('admin.del-language') }}",
                type: "GET",
                data: {id: lang_val},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this language");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function lang_change_state_fx(lang_val,update_state){
        $.ajax({
            url: "{{ route('admin.change-status-language') }}",
            type: "GET",
            data: {id: lang_val, new_state: update_state},
            dataType: "json",
            success: function(event){
                if(event == "success"){
                    success_pass_alert_show_msg("Successfully update the status of this language");
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