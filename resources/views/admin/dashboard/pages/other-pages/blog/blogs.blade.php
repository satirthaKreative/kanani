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
                                        <h1>Blogs</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Blog Details</li>
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
                                                    
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Blog Name</th>
                                                        <th>Blog Details</th>
                                                        <th>Author Name</th>
                                                        <th>Author Quote</th>
                                                        <th>Blog Images</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($iQuery) > 0)
                                                        @foreach($iQuery as $iQ)
                                                            @php $change_path3 = str_replace('public','storage/app/public',$iQ->blog_imgs); @endphp
                                                            @php $img_path3 = '<img src="'.asset($change_path3).'" alt="no image" width="100px" />'; @endphp
                                                            <tr>
                                                                <td>{{ $iQ->blog_name }}</td>
                                                                <td>{{ $iQ->blog_details }}</td>
                                                                <td>{{ $iQ->author_name }}</td>
                                                                <td>{{ $iQ->author_quote }}</td>
                                                                <td><?php echo $img_path3; ?></td>
                                                                <td><a href="javascript:;" class="text-danger" onclick="del_blog_fx({{ $iQ->id }})"><i class="fa fa-trash"></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan=6 class="text-danger"><center><i class="fa fa-times"></i> No Blogs</center></td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Blog Name</th>
                                                        <th>Blog Details</th>
                                                        <th>Author Name</th>
                                                        <th>Author Quote</th>
                                                        <th>Blog Images</th>
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
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Blog Details Form</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.cms.blog.submit') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="blog-heading-id">Blog Heading</label>
                                                <textarea class="form-control" name="blog_name" id="blog-heading-id" placeholder="Enter Blog Heading" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="blog-description-id">Blog Descriptions</label>
                                                <textarea class="form-control" id="blog-description-id"  placeholder="Enter Blog Descriptions" name="blog_description" rows=6 required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="blog-image-id">Blog Image</label>
                                                <input type="file" class="form-control" name="blog_image" id="blog-image-id" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="author-name-id">Author Name</label>
                                                <input type="text" class="form-control" name="author_name" id="author-name-id" placeholder="Enter Author Name" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="author-quote-id">Author Quote</label>
                                                <textarea class="form-control" name="author_quote" id="author-quote-id" placeholder="Enter Author Quote" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="author-image-id">Author Image</label>
                                                <input type="file" class="form-control" name="author_img" id="author-image-id" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="author-fb-name-id">Author Facebook Link</label>
                                                <input type="text" class="form-control" name="fb_link" id="author-fb-name-id" placeholder="Enter Author Facebook link" value="" >
                                            </div>
                                            <div class="form-group">
                                                <label for="author-insta-name-id">Author Instagram Link</label>
                                                <input type="text" class="form-control" name="insta_link" id="author-insta-name-id" placeholder="Enter Author Instagram link" value="" >
                                            </div>
                                            <div class="form-group">
                                                <label for="author-twitter-name-id">Author Twitter Link</label>
                                                <input type="text" class="form-control" name="tw_link" id="author-twitter-name-id" placeholder="Enter Author twitter link" value="" >
                                            </div>
                                            <div class="form-group">
                                                <label for="author-youtube-name-id">Author Youtube Link</label>
                                                <input type="text" class="form-control" name="yt_link" id="author-youtube-name-id" placeholder="Enter Author Youtube link" value="" >
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
<script>
    CKEDITOR.replace('blog_description')
    CKEDITOR.replace('author_quote')

    $(function(){
        del_blog_fx(id);
    });

    function del_blog_fx(id){
        $.ajax({
            url: "{{ route('admin.blogs-del') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                if(event == "success"){
                    success_pass_alert_show_msg("Successfully delete blog");
                    location.reload();
                }else if(event == "error"){
                    error_pass_alert_show_msg("Something went wrong! Try again");
                }
            }, error: function(event){

            }
        })
    }
</script>
@endsection