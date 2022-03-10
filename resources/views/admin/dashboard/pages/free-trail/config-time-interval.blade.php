@extends('admin.layouts.app-dashboard')
@section('content')
                <div class="app-main" id="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 m-b-30">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <span>
                                                    @if(count($configQuery) > 0)
                                                        @php $configHead = "Update Free Trail"; @endphp
                                                    @else
                                                        @php $configHead = "Add Free Trail"; @endphp
                                                    @endif
                                                    <a class="btn btn-success text-white" onclick="add_free_trail_modal_fx()">{{ $configHead }}</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Time Interval</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($configQuery as $ck)
                                                    <tr>
                                                        @if($ck->config_time_hrs_interval > 0)
                                                            @if($ck->config_time_mins_interval > 0)
                                                                <td class="text-bold text-danger">{{ ($ck->config_time_hrs_interval) }} hrs {{ $ck->config_time_mins_interval }} mins</td>
                                                            @else
                                                                <td class="text-bold text-danger">{{ ($ck->config_time_hrs_interval) }} hrs</td>
                                                            @endif
                                                        @else 
                                                            <td class="text-bold text-danger">{{ $ck->config_time_mins_interval }} mins</td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Time Interval</th>
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
<div class="modal" id="add-time-interval-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Time Interval</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        @if(count($configQuery) > 0)
        @foreach($configQuery as $ck)
            @php $time_hr = $ck->config_time_hrs_interval @endphp
            @php $time_min = $ck->config_time_mins_interval @endphp
        @endforeach
        <form action="{{ route('admin.add-config-free-trail') }}" method="POST">
        @php $configId = 1; @endphp
        @else
            @php $time_hr = 0 @endphp
            @php $time_min = 0 @endphp
        <form action="{{ route('admin.add-config-free-trail') }}" method="POST">
        @php $configId = 0; @endphp
        @endif
            @csrf
            <input type="hidden" name="config_hidden_time_interval_name" id="config-hidden-time-interval-id" value="{{ $configId }}">
            <div class="form-group">
                <label for="time-interval-hrs-id">Time Interval (hrs):</label>
                <input type="number" min=0 max=5 class="form-control" placeholder="in hours" id="time-interval-hrs-id" name="modal_hrs_time_interval_name" value="{{ $time_hr }}">
            </div>
            <div class="form-group">
                <label for="time-interval-mins-id">Time Interval (mins):</label>
                <input type="number" min=0 max=59 class="form-control" placeholder="in minuts" id="time-interval-mins-id" name="modal_mins_time_interval_name" value="{{ $time_min }}">
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
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
    function add_free_trail_modal_fx(){
        $("#add-time-interval-Modal").modal('show');
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