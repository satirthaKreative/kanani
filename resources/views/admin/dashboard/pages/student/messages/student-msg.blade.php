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
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item">Tables</li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Students Table</li>
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
                            <!-- <div class="col-lg-12">
                                <span>
                                    <a class="btn btn-success text-white" onclick="add_tutor_modal_fx()">Add Student</a>
                                </span>
                            </div> -->
                        </div>
                        <div class="datatable-wrapper table-responsive student-table">
                            <table id="datatable" class="display compact table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Course Type</th>
                                        <th>Subject</th>
                                        <th>Messages</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($messageQuery as $msgCk)
                                        @if($count < 10)
                                            @php $countCal = "0".$count;@endphp
                                            @php $thread_id = "AH000".$countCal; @endphp
                                        @elseif($count < 100)
                                            @php $countCal = $count;@endphp
                                            @php $thread_id = "AH00".$countCal; @endphp
                                        @elseif($count < 1000)
                                            @php $countCal = $count;@endphp
                                            @php $thread_id = "AH0".$countCal; @endphp 
                                        @elseif($count < 10000)
                                            @php $countCal = $count;@endphp
                                            @php $thread_id = "AH".$countCal; @endphp
                                        @elseif($count < 100000)
                                            @php $countCal = $count;@endphp
                                            @php $thread_id = "A".$countCal; @endphp
                                        @elseif($count < 1000000)
                                            @php $countCal = $count;@endphp
                                            @php $thread_id = $countCal; @endphp
                                        @else
                                            @php $countCal = $count;@endphp
                                            @php $thread_id = $countCal; @endphp
                                        @endif
                                        <!-- String Length Count -->
                                        @php $msg_details = $msgCk->message_details;  @endphp
                                        @if(strlen($msgCk->message_details) > 100)
                                            @php $msg_details = substr($msgCk->message_details,0,99)."...";  @endphp
                                        @endif
                                        <tr>
                                            <td>{{ $thread_id }}</td>
                                            <td class="name">{{ ucwords($msgCk->first_name) }} {{ ucwords($msgCk->last_name) }}</td>
                                            <td>{{ ucwords($msgCk->course_name) }}</td>
                                            <td>{{ ucwords($msgCk->topic_name) }}</td>
                                            <td>{{ $msg_details }}</td>
                                            @php $subCount = 0 @endphp
                                            @foreach($studentMsgQuery as $studentMsgQ)
                                                @if($studentMsgQ->message_tbls ==  $msgCk->id)
                                                    @php $subCount = $subCount+1; @endphp
                                                @endif
                                            @endforeach
                                            <td class="cnt">
                                                <a href="{{ route('admin.student-admin-msg',base64_encode($msgCk->id)) }}" class="btn btn-info btn-sm">Reply</a> 
                                                <div class="notiofication-area"><i class="fas fa-bell"></i> <h4 id="unread-msg-id{{ $msgCk->id }}">{{ $subCount }} Unread</h4></div>
                                            </td>
                                        </tr>
                                        @php $count++ @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Course Type</th>
                                        <th>Subject</th>
                                        <th>Messages</th>
                                        <th>Reply</th>
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

@endsection