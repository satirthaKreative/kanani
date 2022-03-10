@extends('admin.layouts.app-dashboard')
@section('content')
<style>
    td.linebreak p {
        /* width: 50%; */
        max-width: 80%;
        word-wrap: break-word;
        white-space: pre-wrap;
    }

    tbody>tr>th{
        width: 20%;
    }

    .single-available-tbl>.table-bordered{
        border: 5px solid #9da3aa;
    }
</style>
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Booking Details</h1>
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
                                <li class="breadcrumb-item active text-primary" aria-current="page">Student Booking Details</li>
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
                                    <a class="btn btn-success text-white" href="{{ route('admin.student-booking') }}">All Bookings</a>
                                </span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan=2><center>View Booking Details Table</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($getQuery) > 0)
                                        @foreach($getQuery as $gQuery)
                                            <tr>
                                                <th>Student Name</th>
                                                <td>{{ $gQuery->first_name }} {{ $gQuery->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Student Email</th>
                                                <td>{{ $gQuery->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Main Course Name</th>
                                                <td>{{ ucwords($gQuery->main_course_name) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Course Name</th>
                                                <td>{{ ucwords($gQuery->course_name) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Topic Name</th>
                                                <td>{{ ucwords($gQuery->topic_name) }}</td>
                                            </tr>
                                            <tr>
                                                <th>No. of Units</th>
                                                <td>{{ $gQuery->no_of_units }}</td>
                                            </tr>
                                            <tr>
                                                <th>No. of lessons</th>
                                                <td>{{ $gQuery->no_of_lessons }}</td>
                                            </tr>
                                            <tr>
                                                <th>No. of Lessons / month</th>
                                                <td>{{ $gQuery->no_of_lessons_per_month }}</td>
                                            </tr>
                                            <tr>
                                                <th>Package Price</th>
                                                <td>$ {{ $gQuery->paypal_package_price_name }} / month</td>
                                            </tr>
                                            <tr>
                                                <th>Additional Details</th>
                                                <td class="linebreak"><p>{{ $gQuery->course_comment_name }}<p></td>
                                            </tr>
                                            
                                            @foreach($getMonthlyBookingQuery as $getMonthBookQ)
                                            <tr>
                                                <th>Total Course</th>
                                                <td>{{  $getMonthBookQ->total_months  }} months</td>
                                            </tr>
                                            <tr>
                                                <th>Booking for</th>
                                                <td>{{ (($getMonthBookQ->total_months)-($getMonthBookQ->left_months)) }} months</td>
                                            </tr>
                                            <tr>
                                                <th>Total Course Price</th>
                                                <td>{{  $getMonthBookQ->total_payable_amount  }} $</td>
                                            </tr>
                                            <tr>
                                                <th>Course Paid Price</th>
                                                <td>{{ $getMonthBookQ->paid_amount }} $</td>
                                            </tr>
                                            <tr>
                                                <th>Course Pending Price</th>
                                                <td>{{ $getMonthBookQ->pending_amount }} $</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th>Available Dates for Classes</th>
                                                <td class="single-available-tbl">
                                                   <table class="table table-info table-striped table-bordered">
                                                        <tr><th colspan=2><center>Available Date & Time Table</center></th></tr>
                                                        <tr>
                                                            <th>Available Date</th>
                                                            <th>Available Timing</th>
                                                        </tr>
                                                        @foreach($getBookingQuery as $getBookQ)
                                                        <tr>
                                                            <td>{{ date('M d,y',strtotime($getBookQ->student_booking_date)) }}</td>
                                                            <td>{{ date('H:i',strtotime($getBookQ->course_class_start_time_name)) }} - {{ date('H:i',strtotime($getBookQ->course_class_end_time_name)) }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @foreach($getMultiBookingQuery as $getMultiBookQ)
                                                        <tr>
                                                            <td>{{ date('M d,y',strtotime($getMultiBookQ->student_booking_date)) }}</td>
                                                            <td>{{ date('H:i',strtotime($getMultiBookQ->course_class_start_time_name)) }} - {{ date('H:i',strtotime($getMultiBookQ->course_class_end_time_name)) }}</td>
                                                        </tr>
                                                        @endforeach
                                                   </table> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan=2 class="text-info"><i class="fa fa-spinner"></i> Loading your booking details</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    
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