@extends('admin.layouts.app-dashboard')
@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Students</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                    <input type="hidden" name="student_admin_main_msg_id_name" id="student-admin-main-msg-id" value="@foreach($messageQuery as $msgCk) @php echo $msgCk->id; @endphp @endforeach" />
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item">Tables</li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Message Table</li>
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
                                    <a class="btn btn-success text-white" href="{{ route('admin.student-message') }}"><i class="fa fa-undo"></i> Back To Previous Page</a>
                                </span>
                            </div>
                        </div>
                        <div class="datatable-wrapper table-responsive">
                            <table class="display compact table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Reply</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <form action="{{ route('admin.submit-admin-student-msg') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="msg_tbl_id_name" id="msg-tbl-id" value="@foreach($messageQuery as $msgCk)@php echo $msgCk->id; @endphp@endforeach" />
                                                <textarea cols=100 required rows=10 name="student_admin_msg_name" id="student-admin-msg-id"></textarea>
                                                <br/>
                                                <input type="submit" class="btn btn-success" name="student_admin_message_submit" value="Submit" />
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table id="datatable" class="display compact table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Messages</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = "#"; @endphp
                                    @foreach($subMessageQuery as $subMsgCk)
                                        @php $sub_msg_details = $subMsgCk->messages;  @endphp
                                        @php $user_check = $subMsgCk->user_ids;  @endphp
                                        @if($user_check == 0 || $user_check == "0")
                                            @php $user_type = "Admin"; @endphp
                                        @else
                                            @foreach($messageQuery as $msgCk)
                                                @php $user_type = $msgCk->first_name." ".$msgCk->last_name; @endphp
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ ucwords($user_type) }}</td>
                                            <td>{{ $sub_msg_details }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($messageQuery as $msgCk)
                                        @php $msg_details = $msgCk->message_details;  @endphp
                                        <tr>
                                            <td>#</td>
                                            <td>{{ ucwords($msgCk->first_name) }} {{ ucwords($msgCk->last_name) }}</td>
                                            <td>{{ $msg_details }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
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
</div>
@endsection
@section('adminjsContent')
<script>
$(function(){
    load_unseen_to_seen_fx();
});

function load_unseen_to_seen_fx(){
    var msg_id = $("#student-admin-main-msg-id").val();
    $.ajax({
        url: "{{ route('admin.student-message-unseen-seen') }}",
        type: "GET",
        data: {msg_id: msg_id},
        dataType: "json",
        success: function(event){

        }, error: function(event){

        }
    })
}
</script>
@endsection