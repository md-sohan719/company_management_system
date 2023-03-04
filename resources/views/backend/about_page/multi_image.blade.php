@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">About Multi Image</h4>
                        <form action="{{ route('store.multi.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="multi_image[]" class="form-control"
                                        onchange="showSlideImg.src=window.URL.createObjectURL(this.files[0])" multiple>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showSlideImg" class="rounded avatar-lg"
                                        src="{{ asset('upload/no_image.jpg') }}" alt="image">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
