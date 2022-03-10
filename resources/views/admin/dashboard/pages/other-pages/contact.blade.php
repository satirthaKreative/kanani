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
                                        <h1>Contact</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Contact Table</li>
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
                                                    @if(count($contactQuery) > 0)
                                                    @foreach($contactQuery as $ckQ)
                                                        @php $contactId = $ckQ->id @endphp
                                                    @endforeach
                                                    <a class="btn btn-success text-white" onclick="contact_edit_fx({{ $contactId }})">Edit Contact</a>
                                                    @else
                                                    <a class="btn btn-success text-white" onclick="add_contact_modal_fx()">Add Contact</a>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Quote</th>
                                                        <th>Short description</th>
                                                        <th>Contacts</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($contactQuery as $ck)
                                                    <tr>
                                                        <td>{{ $ck->quote_name }}</td>
                                                        <td>{{ $ck->short_description }} </td>
                                                        <td>Contact Number: <b>{{ $ck->contact_number }}</b> <br /> Contact Email: <b>{{ $ck->contact_email }}</b> </td>
                                                        <td>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="contact_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="contact_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Quote</th>
                                                        <th>Short description</th>
                                                        <th>Contacts</th>
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


<!-- The Add free trail Modal -->
<div class="modal" id="add-contact-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Contact Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-or-update-contact') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="contact-quote-id">Quote:</label>
                <textarea class="form-control" rows=3 placeholder="Contact Quote" id="contact-quote-id" name="contact_quote_name" ></textarea>
            </div>
            <div class="form-group">
                <label for="contact-short-description-id">Short Description:</label>
                <textarea class="form-control" rows=5 placeholder="Contact Short Description" id="contact-short-description-id" name="contact_short_description_name" ></textarea>
            </div>
            <div class="form-group">
                <label for="contact-number-id">Contact Number:</label>
                <input type="number" min=0 class="form-control" id="contact-number-id" placeholder="Contact Number" name="contact_number_name" />
            </div>
            <div class="form-group">
                <label for="contact-email-id">Contact Email:</label>
                <input type="text" class="form-control" id="contact-email-id" placeholder="Contact Email" name="contact_email_name" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /The Add free trail Modal -->
<!-- The edit free trail Modal -->
<div class="modal" id="edit-contact-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Contact</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-or-update-contact') }}" method="POST">
            @csrf
            <input type="hidden" name="contact_hidden_name" id="contact-hidden-id" value="0">
            <div class="form-group">
                <label for="edit-contact-quote-id">Quote:</label>
                <textarea class="form-control" rows=3 placeholder="Contact Quote" id="edit-contact-quote-id" name="contact_quote_name" ></textarea>
            </div>
            <div class="form-group">
                <label for="edit-contact-short-description-id">Short Description:</label>
                <textarea class="form-control" rows="5" placeholder="Contact Short Description" id="edit-contact-short-description-id" name="contact_short_description_name" ></textarea>
            </div>
            <div class="form-group">
                <label for="edit-contact-number-id">Contact Number:</label>
                <input type="number" min=0 class="form-control" id="edit-contact-number-id" placeholder="Contact Number" name="contact_number_name" />
            </div>
            <div class="form-group">
                <label for="edit-contact-email-id">Contact Email:</label>
                <input type="text" class="form-control" id="edit-contact-email-id" placeholder="Contact Email" name="contact_email_name" />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /The edit free trail Modal -->
@endsection
@section('adminjsContent')
<script>
    function add_contact_modal_fx(){
        $("#add-contact-modal").modal('show');
    }

    function contact_edit_fx(lang_val){
        $("#edit-contact-modal").modal('show');
        $.ajax({
            url: "{{ route('admin.edit-contact') }}",
            type: "GET",
            data: {id: lang_val},
            dataType: "json",
            success: function(event){
                $("#contact-hidden-id").val(lang_val);
                $("#edit-contact-quote-id").val(event.quote_name);
                $("#edit-contact-short-description-id").val(event.short_description);
                $("#edit-contact-number-id").val(event.contact_number);
                $("#edit-contact-email-id").val(event.contact_email);
            }, error: function(event){

            }
        })
    }

    function contact_del_fx(lang_val){
        var x = confirm('Are you sure to delete this?');
        if(x){
            $.ajax({
                url: "{{ route('admin.del-contact') }}",
                type: "GET",
                data: {id: lang_val},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this ");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }
</script>
@endsection