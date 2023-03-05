@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Multi Image</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Multi Image</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Multi Image List</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach ($allMultiImage as $image)
                                    <tr>
                                        <td>{{ $serial++ }}.</td>
                                        <td><img src="{{ asset('upload/' . $image->image_path) }}" width="60px"
                                                height="50px" alt=""></td>
                                        <td>
                                            <a imageInfo="{{ $image }}"
                                                img_src="{{ asset('upload/' . $image->image_path) }}"
                                                class="btn btn-info sm editBtn" title="Edit Data"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.multi.image', $image->id) }}"
                                                class="btn btn-danger sm delete" title="Delete Data"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <!-- sample modal content -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('update.multi.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Update Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idd" name="id">
                        <div class="row mb-3">
                            <label for="multi_image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="multi_image"
                                    onchange="showImg.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img id="showImg" class="rounded avatar-lg" alt="image">
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
    <script>
        $(document).ready(function() {
            $(".editBtn").click(function() {
                var imageInfo = $(this).attr('imageInfo');
                var imageData = JSON.parse(imageInfo);
                var img_src = $(this).attr('img_src');
                $("#editModal").modal('show');
                $("#idd").val(imageData.id);
                $("#showImg").attr('src', img_src);
            });
        });
    </script>
@endsection
