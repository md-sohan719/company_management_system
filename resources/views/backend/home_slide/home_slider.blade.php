@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Home Slide Page</h4>
                        <form action="{{ route('update.slider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $homeSlide->id }}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $homeSlide->title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="short_title" class="form-control"
                                        value="{{ $homeSlide->short_title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Video URL</label>
                                <div class="col-sm-10">
                                    <input type="text" name="video_url" class="form-control"
                                        value="{{ $homeSlide->video_url }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Slide Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="home_slide" class="form-control"
                                        onchange="showSlideImg.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showSlideImg" class="rounded avatar-lg"
                                        src="{{ !empty($homeSlide->home_slide) ? asset('upload/' . $homeSlide->home_slide) : asset('upload/no_image.jpg') }}"
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
