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
                                        <h1>Choose Us</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Choose Us Details</li>
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
                                            <h4 class="card-title">Choose Us Details Form</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.cms.choose-us.submit') }}" method="POST" enctype="multipart/form-data">
                                            @if(count($chooseQuery) > 0)
                                                @foreach($chooseQuery as $chooseUsData)
                                                    @php $change_path1 = str_replace('public','storage/app/public',$chooseUsData->paragraph1_img); @endphp
                                                    @php $img_path1 = '<img src="'.asset($change_path1).'" alt="no image" width="100px" />'; @endphp
                                                    @php $change_path2 = str_replace('public','storage/app/public',$chooseUsData->paragraph2_img); @endphp
                                                    @php $img_path2 = '<img src="'.asset($change_path2).'" alt="no image" width="100px" />'; @endphp
                                                    @php $change_path3 = str_replace('public','storage/app/public',$chooseUsData->paragraph3_img); @endphp
                                                    @php $img_path3 = '<img src="'.asset($change_path3).'" alt="no image" width="100px" />'; @endphp

                                                    @php $change_path4 = str_replace('public','storage/app/public',$chooseUsData->section1_img); @endphp
                                                    @php $img_path4 = '<img src="'.asset($change_path4).'" alt="no image" width="100px" />'; @endphp
                                                    @php $change_path5 = str_replace('public','storage/app/public',$chooseUsData->section2_img); @endphp
                                                    @php $img_path5 = '<img src="'.asset($change_path5).'" alt="no image" width="100px" />'; @endphp
                                                    @php $change_path6 = str_replace('public','storage/app/public',$chooseUsData->section3_img); @endphp
                                                    @php $img_path6 = '<img src="'.asset($change_path6).'" alt="no image" width="100px" />'; @endphp
                                                    @php $change_path7 = str_replace('public','storage/app/public',$chooseUsData->section4_img); @endphp
                                                    @php $img_path7 = '<img src="'.asset($change_path7).'" alt="no image" width="100px" />'; @endphp
                                                    @php $change_path8 = str_replace('public','storage/app/public',$chooseUsData->section5_img); @endphp
                                                    @php $img_path8 = '<img src="'.asset($change_path8).'" alt="no image" width="100px" />'; @endphp
                                                    @php $heading1_name = $chooseUsData->heading1_name;  @endphp
                                                    @php $paragraph1_name = $chooseUsData->paragraph1_name; @endphp
                                                    @php $author_name = $chooseUsData->author_name; @endphp
                                                    @php $heading2_name = $chooseUsData->heading2_name; @endphp
                                                    @php $paragraph2_name = $chooseUsData->paragraph2_name; @endphp
                                                    @php $heading3_name = $chooseUsData->heading3_name; @endphp
                                                    @php $paragraph3_name = $chooseUsData->paragraph3_name; @endphp
                                                    @php $section1_heading_name = $chooseUsData->section1_name; @endphp
                                                    @php $section1_paragraph_name = $chooseUsData->section1_paragraph; @endphp
                                                    @php $section2_heading_name = $chooseUsData->section2_name; @endphp
                                                    @php $section2_paragraph_name = $chooseUsData->section2_paragraph; @endphp
                                                    @php $section3_heading_name = $chooseUsData->section3_name; @endphp
                                                    @php $section3_paragraph_name = $chooseUsData->section3_paragraph; @endphp
                                                    @php $section4_heading_name = $chooseUsData->section4_name; @endphp
                                                    @php $section4_paragraph_name = $chooseUsData->section4_paragraph; @endphp
                                                    @php $section5_heading_name = $chooseUsData->section5_name; @endphp
                                                    @php $section5_paragraph_name = $chooseUsData->section5_paragraph; @endphp
                                                    @php $img1 = $img_path1; @endphp
                                                    @php $img2 = $img_path2; @endphp
                                                    @php $img3 = $img_path3; @endphp
                                                    @php $img4 = $img_path4; @endphp
                                                    @php $img5 = $img_path5; @endphp
                                                    @php $img6 = $img_path6; @endphp
                                                    @php $img7 = $img_path7; @endphp
                                                    @php $img8 = $img_path8; @endphp
                                                @endforeach
                                            @else
                                                    @php $heading1_name = "";  @endphp
                                                    @php $paragraph1_name = ""; @endphp
                                                    @php $author_name = ""; @endphp
                                                    @php $heading2_name = ""; @endphp
                                                    @php $paragraph2_name = ""; @endphp
                                                    @php $heading3_name = ""; @endphp
                                                    @php $paragraph3_name = ""; @endphp
                                                    @php $section1_heading_name = ""; @endphp
                                                    @php $section1_paragraph_name = ""; @endphp
                                                    @php $section2_heading_name = ""; @endphp
                                                    @php $section2_paragraph_name = ""; @endphp
                                                    @php $section3_heading_name = ""; @endphp
                                                    @php $section3_paragraph_name = ""; @endphp
                                                    @php $section4_heading_name = ""; @endphp
                                                    @php $section4_paragraph_name = ""; @endphp
                                                    @php $section5_heading_name = ""; @endphp
                                                    @php $section5_paragraph_name = ""; @endphp
                                                    @php $img1 = ""; @endphp
                                                    @php $img2 = ""; @endphp
                                                    @php $img3 = ""; @endphp
                                                    @php $img4 = ""; @endphp
                                                    @php $img5 = ""; @endphp
                                                    @php $img6 = ""; @endphp
                                                    @php $img7 = ""; @endphp
                                                    @php $img8 = ""; @endphp
                                            @endif
                                            @csrf
                                            <div class="form-group">
                                                <label for="heading-id1">"Choose Us" Heading 1</label>
                                                <input type="text" class="form-control" name="heading_name1" id="heading-id1" placeholder="Choose Us Heading" value="{{ $heading1_name }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="paragraph-heading-id1">Paragraph 1</label>
                                                <textarea class="form-control" id="paragraph-heading-id1" aria-describedby="emailHelp" placeholder="Paragraph" name="paragraph_heading1" required><?php echo $paragraph1_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="image-id1">"Choose Us" image1</label>
                                                <input type="file" class="form-control" name="image_name1" id="image-id1"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img1; ?>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="author-name-id">Author Name</label> -->
                                                <input type="hidden" class="form-control" name="author_name" id="author-name-id" placeholder="Author Name" value="{{ $author_name }}" required>
                                            <!-- </div> -->
                                            <div class="form-group">
                                                <label for="heading-id2">"Why Choose Us" heading 2</label>
                                                <input type="text" class="form-control" name="heading_name2" id="heading-id2" placeholder="Instagram Link" value="Why Choose Us" value="{{ $heading2_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="paragraph-heading-id2">Paragraph 2</label>
                                                <textarea class="form-control" name="paragraph_heading2" id="paragraph-heading-id2" placeholder="Footer Content"  rows=6 required><?php echo $paragraph2_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="image-id2">"Why Choose Us" image2</label>
                                                <input type="file" class="form-control" name="image_name2" id="image-id2"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img2; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="heading-id3">"Benefits of Learning English" Heading 3</label>
                                                <input type="text" class="form-control" name="heading_name3" id="heading-id3" placeholder="Twitter Link" value="{{ $heading3_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-youtube-id">"Benefits of Learning English" Description</label>
                                                <textarea class="form-control" name="paragraph_heading3" id="cms-footer-content-id" placeholder="Footer Content"  rows=6 required><?php echo $paragraph3_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="image-id3">"Benefits of Learning English" image3</label>
                                                <input type="file" class="form-control" name="image_name3" id="image-id3"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img3; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="section-learning-heading1-id">"Benefits of Learning English" Section1 Heading </label>
                                                <input type="text" class="form-control" name="section1_heading" id="section-learning-heading1-id" placeholder="Twitter Link" value="{{ $section1_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-youtube-id">"Benefits of Learning English" Section1 Paragraph</label>
                                                <textarea class="form-control" name="section1_paragraph" id="section-learning-paragraph1-id" placeholder="Footer Content"  rows=6 required><?php echo $section1_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="section1-image-id">"Benefits of Learning English" image1</label>
                                                <input type="file" class="form-control" name="image_name4" id="section1-image-id"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img4; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="section-learning-heading2-id">"Benefits of Learning English" Section2 Heading </label>
                                                <input type="text" class="form-control" name="section2_heading" id="section-learning-heading2-id" placeholder="Twitter Link" value="{{ $section2_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-youtube-id">"Benefits of Learning English" Section2 Paragraph</label>
                                                <textarea class="form-control" name="section2_paragraph" id="section-learning-paragraph2-id" placeholder="Section Paragraph"  rows=6 required><?php echo $section2_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="section2-image-id">"Benefits of Learning English" image2</label>
                                                <input type="file" class="form-control" name="image_name5" id="section2-image-id"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img5; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-twitter-id">"Benefits of Learning English" Section3 Heading </label>
                                                <input type="text" class="form-control" name="section3_heading" id="section-learning-heading3-id" placeholder="Section Heading" value="{{ $section3_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cms-youtube-id">"Benefits of Learning English" Section3 Paragraph</label>
                                                <textarea class="form-control" name="section3_paragraph" id="section-learning-paragraph3-id" placeholder="Section Paragraph"  rows=6 required><?php echo $section3_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="section3-image-id">"Benefits of Learning English" image3</label>
                                                <input type="file" class="form-control" name="image_name6" id="section3-image-id"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img6; ?>
                                            </div>
                                            <!-- 4th image panel -->
                                            <div class="form-group">
                                                <label for="section-learning-heading4-id">"Benefits of Learning English" Section4 Heading </label>
                                                <input type="text" class="form-control" name="section4_heading" id="section-learning-heading4-id" placeholder="Section Heading" value="{{ $section4_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="section-learning-paragraph4-id">"Benefits of Learning English" Section4 Paragraph</label>
                                                <textarea class="form-control" name="section4_paragraph" id="section-learning-paragraph4-id" placeholder="Section Paragraph"  rows=6 required><?php echo $section4_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="section4-image-id">"Benefits of Learning English" image4</label>
                                                <input type="file" class="form-control" name="image_name7" id="section4-image-id"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img7; ?>
                                            </div>
                                            <!-- 5th image panel -->
                                            <div class="form-group">
                                                <label for="section-learning-heading5-id">"Benefits of Learning English" Section5 Heading </label>
                                                <input type="text" class="form-control" name="section5_heading" id="section-learning-heading5-id" placeholder="Section Heading" value="{{ $section5_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="section-learning-paragraph5-id">"Benefits of Learning English" Section5 Paragraph</label>
                                                <textarea class="form-control" name="section5_paragraph" id="section-learning-paragraph5-id" placeholder="Section Paragraph"  rows=6 required><?php echo $section5_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="section5-image-id">"Benefits of Learning English" image5</label>
                                                <input type="file" class="form-control" name="image_name8" id="section5-image-id"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img8; ?>
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
    CKEDITOR.replace( 'paragraph_heading1' );
    CKEDITOR.replace( 'paragraph_heading2' );
    CKEDITOR.replace( 'paragraph_heading3' );
    
    CKEDITOR.replace( 'section1_paragraph' );
    CKEDITOR.replace( 'section2_paragraph' );
    CKEDITOR.replace( 'section3_paragraph' );
    CKEDITOR.replace( 'section4_paragraph' );
    CKEDITOR.replace( 'section5_paragraph' );
</script>
@endsection