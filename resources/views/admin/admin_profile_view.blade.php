@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="text-center mt-2">
                        <img class="rounded-circle avatar-xl"
                            src="{{ !empty($adminData->profile_image) ? asset('upload/' . $adminData->profile_image) : asset('backend/assets/images/users/user.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Name : {{ $adminData->name }}</h4>
                        <hr>
                        <h4 class="card-title">Email : {{ $adminData->email }}</h4>
                        <hr>
                        <a class="btn btn-info btn-rounded waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#editModal">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sample modal content -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Name" name="name"
                                    value="{{ $adminData->name }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="Email" name="email"
                                    value="{{ $adminData->email }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="profile_image"
                                    onchange="showAdminImg.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="profile_image" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img id="showAdminImg" class="rounded avatar-lg"
                                    src="{{ !empty($adminData->profile_image) ? asset('upload/' . $adminData->profile_image) : asset('backend/assets/images/users/user.png') }}"
                                    alt="image">
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
@endsection
