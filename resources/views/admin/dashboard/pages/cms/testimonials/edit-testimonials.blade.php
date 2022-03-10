@extends('admin.layouts.app-dashboard')
@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Testimonials</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript:;"><i class="ti ti-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"> Tables</li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Testimonials Table</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin row -->
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">Student Comments Form</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.cms.student.comments.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(count($getComments) > 0)
                                @foreach($getComments as $getC)
                                    @if($getC->customers_images != "" || $getC->customers_images != null)
                                        @php $change_path4 = str_replace('public','storage/app/public',$getC->customers_images); @endphp
                                        @php $img_path4 = '<img src="'.asset($change_path4).'" alt="no image" width="100px" />'; @endphp
                                    @else
                                        @php $img_path4 = '<img src='.asset("frontend/images/facebook-no-profile-picture-ic.jpg").' alt="no image" width="100px" />'; @endphp
                                    @endif
                                    @php $customer_id = $getC->id; @endphp
                                    @php $customer_name = $getC->customer_name; @endphp
                                    @php $customer_email = $getC->customer_email; @endphp
                                    @php $customer_post = $getC->customer_post; @endphp
                                    @php $customer_comment = $getC->customer_comment; @endphp
                                @endforeach
                            @endif
                            <input type="hidden" name="customer_id" value="{{ $customer_id }}" />
                            <div class="form-group">
                                <label for="student-name-id">Student Name</label>
                                <input type="text" class="form-control" name="customer_name" id="student-name-id" placeholder="Enter Student Name" value="{{ $customer_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user-email-id">Student Email</label>
                                <input type="email" class="form-control" id="user-email-id" placeholder="Enter Student Email" name="customer_email" value="{{ $customer_email }}"/>
                            </div>
                            <div class="form-group">
                                <label for="student-designation-id">Student Designation</label>
                                <input type="text" class="form-control" id="student-designation-id" placeholder="Enter Student Designation" name="customer_post"  value="{{ $customer_post }}" />
                            </div>
                            <div class="form-group">
                                <label for="customer-comments-id">Student Comments</label>
                                <textarea class="form-control" name="customer_comment" id="customer-comments-id" placeholder="Customer Comments"  rows=6 require><?php echo $customer_comment; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="customer-image-id">Student Image</label>
                                <input type="file" class="form-control" id="customer-image-id" name="customers_images" />
                            </div>
                            <div class="image-class">
                                <?php echo $img_path4; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
                        <!-- end row -->
    </div>
</div>

@endsection
@section('adminjsContent')

@endsection