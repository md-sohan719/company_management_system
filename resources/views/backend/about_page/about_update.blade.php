@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">About Page</h4>
                        <form action="{{ route('update.about') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $aboutPage->id }}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $aboutPage->title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="short_title" class="form-control"
                                        value="{{ $aboutPage->short_title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_description" rows="5">{{ $aboutPage->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">
                                    <textarea name="long_description" id="elm1">{{ $aboutPage->long_description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">About Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="about_image" class="form-control"
                                        onchange="showAboutImg.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showAboutImg" class="rounded avatar-lg"
                                        src="{{ !empty($aboutPage->about_image) ? asset('upload/' . $aboutPage->about_image) : asset('upload/no_image.jpg') }}"
                                        alt="image">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Slide">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
