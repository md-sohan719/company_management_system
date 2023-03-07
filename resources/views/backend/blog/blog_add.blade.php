@extends('backend.master_layout')
@section('main_content')
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #b70000;
            font-weight: 700px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add Blog Page</h4>
                        <form action="{{ route('store.blog') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Category Name</label>
                                <div class="col-sm-10">
                                    <select name="blog_category_id" class="form-select">
                                        <option value="">select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->blog_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="blog_title" class="form-control">
                                    @error('blog_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Tags</label>
                                <div class="col-sm-10">
                                    <input type="text" name="blog_tags" class="form-control" value="home,tech"
                                        data-role="tagsinput">
                                    @error('blog_tags')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Description</label>
                                <div class="col-sm-10">
                                    <textarea name="blog_description" id="elm1"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="blog_image" class="form-control"
                                        onchange="showImage.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{ asset('upload/no_image.jpg') }}" id="showImage"
                                        alt="">
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
