@extends('admin.layouts.app-dashboard')
 
@section('content')
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-lg-flex flex-nowrap align-items-center">
                                    <div class="page-title mr-4 pr-4 border-right">
                                        <h1>Dashboard</h1>
                                    </div>
                                    <div class="breadcrumb-bar align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="{{ route('admin.home') }}"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    Dashboard
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Home</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                        </div>
                        <!-- Notification -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert border-0 alert-primary bg-gradient m-b-30 alert-dismissible fade show border-radius-none" role="alert">
                                    <strong>Hello Admin</strong>  Welcome to admin dashboard.
                                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="ti ti-close"></i>
                                    </button> -->
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-statistics">
                                    <div class="row no-gutters">
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20 border-lg-right border-bottom border-xxl-bottom-0">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Country</p>
                                                    <a class="mb-0 ml-auto font-weight-bold" href="#"><i class="ti ti-more-alt"></i> </a>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics7"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i><span id="total-country-count"> 00</span></h3>
                                                        <p>Total Country</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20 border-xxl-right border-bottom border-xxl-bottom-0">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Language</p>
                                                    <a class="mb-0 ml-auto font-weight-bold" href="#"><i class="ti ti-more-alt"></i> </a>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics8"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i> <span id="total-language-count"> 00</span></h3>
                                                        <p>Total Language</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Visitors</p>
                                                    <a class="mb-0 ml-auto font-weight-bold" href="#"><i class="ti ti-more-alt"></i> </a>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics9"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>00</h3>
                                                        <p>Total Visitors</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20">
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics10"></div>
                                                    </div>
                                                    <div class="statistics ml-sm-auto mt-4 mt-sm-0 pr-sm-5">
                                                        <ul class="list-style-none p-0">
                                                            <li class="d-flex py-1">
                                                                <span><i class="fa fa-circle text-primary pr-2"></i> Student Visits</span> <span class="pl-2 font-weight-bold">00</span></li>
                                                            <li class="d-flex py-1"><span><i class="fa fa-circle text-warning pr-2"></i> Teacher Visits</span> <span class="pl-2 font-weight-bold">00</span></li>
                                                            <li class="d-flex py-1"><span><i class="fa fa-circle text-info pr-2"></i> Guests Visits</span> <span class="pl-2 font-weight-bold">00</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        <!-- end row -->
                        <!-- event Modal -->
                        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="verticalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="verticalCenterTitle">Add New Event</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="modelemail">Event Name</label>
                                                <input type="email" class="form-control" id="modelemail">
                                            </div>
                                            <div class="form-group">
                                                <label>Choose Event Color</label>
                                                <select class="form-control">
                                                    <option>Primary</option>
                                                    <option>Warning</option>
                                                    <option>Success</option>
                                                    <option>Danger</option>
                                                </select>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end container-fluid -->
                </div>
@endsection
@section('adminjsContent')
<script>
    $(function(){
        load_country_dashboard_fx();
    });

    function load_country_dashboard_fx(){
        $.ajax({
            url: "{{ route('admin.count-country') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#total-country-count").html(event);
                load_language_dashboard_fx();
            }, error: function(event){

            }
        })
    }

    function load_language_dashboard_fx(){
        $.ajax({
            url: "{{ route('admin.count-language') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#total-language-count").html(event);
                load_language_dashboard_fx();
            }, error: function(event){

            }
        })
    }
</script>
@endsection