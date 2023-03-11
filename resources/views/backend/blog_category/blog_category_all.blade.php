@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Blog Category</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Blog Category</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Blog Category List</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Blog Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($serial = 1)

                                @foreach ($blogCategory as $item)
                                    <tr>
                                        <td>{{ $serial++ }}.</td>
                                        <td>{{ $item->blog_category }}</td>
                                        <td>
                                            <a blogCategoryInfo={{ $item }} class="btn btn-info sm editBtn"
                                                title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.blog.category', $item->id) }}"
                                                class="btn btn-danger sm delete" title="Delete Data"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add Blog Category</h4>
                        <form id="myForm" action="{{ route('store.blog.category') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Category Name</label>
                                <div class="form-group col-sm-10">
                                    <input type="text" name="blog_category" class="form-control">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- sample modal content -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('update.blog.category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Update Blog Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idd" name="id">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Blog Category Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="blog_category" id="blog_category" class="form-control">
                                @error('blog_category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    blog_category: {
                        required: true,
                        minlength: 2
                    },
                    // password: {
                    //     required: true,
                    //     minlength: 5
                    // },
                    // confirm_password: {
                    //     required: true,
                    //     minlength: 5,
                    //     equalTo: "#password"
                    // },
                    // email: {
                    //     required: true,
                    //     email: true
                    // },
                    agree: "required"
                },
                messages: {
                    blog_category: {
                        required: 'Please Enter Blog Category',
                    },
                    // password: {
                    //     required: " Please enter a password",
                    //     minlength: " Your password must be consist of at least 5 characters"
                    // },
                    // confirm_password: {
                    //     required: " Please enter a password",
                    //     minlength: " Your password must be consist of at least 5 characters",
                    //     equalTo: " Please enter the same password as above"
                    // },
                    agree: "Please accept our policy"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".editBtn").click(function() {
                var blogCategoryInfo = $(this).attr('blogCategoryInfo');
                var blogCategoryData = JSON.parse(blogCategoryInfo);
                console.log(blogCategoryData)
                $("#editModal").modal('show');
                $("#idd").val(blogCategoryData.id);
                $("#blog_category").val(blogCategoryData.blog_category);
            });
        });
    </script>
@endsection
