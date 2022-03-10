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
                                        <h1>Contact Details</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="{{ route('admin.home') }}"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    Forms
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Contact Details</li>
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
                            <div class="col-xl-8">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Contact Details Form</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.cms.contact-details.submit') }}" method="POST">
                                            @if(count($getCMSquery) > 0)
                                                @foreach($getCMSquery as $adminQ)
                                                    @php $contact_phone = $adminQ->cms_phone_number; @endphp
                                                    @php $contact_email = $adminQ->cms_email_address; @endphp
                                                    @php $cms_facebook = $adminQ->cms_facebook; @endphp
                                                    @php $cms_instagram = $adminQ->cms_instagram; @endphp
                                                    @php $cms_twitter = $adminQ->cms_twitter; @endphp
                                                    @php $cms_youtube = $adminQ->cms_youtube; @endphp
                                                    @php $cms_copyright = $adminQ->cms_copyright; @endphp
                                                    @php $cms_footer_heading = $adminQ->cms_footer_heading; @endphp
                                                    @php $cms_footer_content = $adminQ->cms_footer_content; @endphp
                                                @endforeach
                                            @else
                                                @php $contact_phone = ""; @endphp
                                                @php $contact_email = ""; @endphp
                                                @php $cms_facebook = ""; @endphp
                                                @php $cms_instagram = ""; @endphp
                                                @php $cms_twitter = ""; @endphp
                                                @php $cms_youtube = ""; @endphp
                                                @php $cms_copyright = ""; @endphp
                                                @php $cms_footer_heading = ""; @endphp
                                                @php $cms_footer_content = ""; @endphp
                                            @endif
                                            @csrf
                                            <div class="form-group">
                                                <label for="user-name-id">Contact Number</label>
                                                <input type="text" class="form-control" name="user_name" id="user-name-id" placeholder="Enter Contact Number" value="{{ $contact_phone }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="user-email-id">Contact Email</label>
                                                <input type="text" class="form-control" id="user-email-id" aria-describedby="emailHelp" placeholder="Enter Contact Email" name="user_email" value="{{ $contact_email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-facebook-id">Facebook Link</label>
                                                <input type="text" class="form-control" name="cms_facebook" id="cms-facebook-id" placeholder="Facebook Link" value="{{ $cms_facebook }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-instagram-id">Instagram Link</label>
                                                <input type="text" class="form-control" name="cms_instagram" id="cms-instagram-id" placeholder="Instagram Link" value="{{ $cms_instagram }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-twitter-id">Twitter Link</label>
                                                <input type="text" class="form-control" name="cms_twitter" id="cms-twitter-id" placeholder="Twitter Link" value="{{ $cms_twitter }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-youtube-id">Youtube Link</label>
                                                <input type="text" class="form-control" name="cms_youtube" id="cms-youtube-id" placeholder="Youtube Link" value="{{ $cms_youtube }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-footer-heading-id">Footer Heading</label>
                                                <textarea class="form-control" name="cms_footer_heading" id="cms-footer-heading-id" placeholder="Footer Heading"  rows=6 required>{{ $cms_footer_heading }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-footer-content-id">Footer Content</label>
                                                <textarea class="form-control" name="cms_footer_content" id="cms-footer-content-id" placeholder="Footer Content"  rows=6 required>{{ $cms_footer_content }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-copyright-id">Copyright Section</label>
                                                <input type="text" class="form-control" name="cms_copyright" id="cms-copyright-id" placeholder="Copyright Section" value="{{ $cms_copyright }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>
@endsection
@section('adminjsContent')

@endsection