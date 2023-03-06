@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Portfolio Edit Page</h4>
                        <form action="{{ route('update.portfolio') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $portfolio->id }}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Portfolio Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="portfolio_name" class="form-control"
                                        value="{{ $portfolio->portfolio_name }}">
                                    @error('portfolio_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Portfolio Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="portfolio_title" class="form-control"
                                        value="{{ $portfolio->portfolio_title }}">
                                    @error('portfolio_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Portfolio Description</label>
                                <div class="col-sm-10">
                                    <textarea name="portfolio_description" id="elm1">{{ $portfolio->portfolio_description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Portfolio Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="portfolio_image" class="form-control"
                                        onchange="showPortfolioImg.src=window.URL.createObjectURL(this.files[0])">
                                    @error('portfolio_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showPortfolioImg" class="rounded avatar-lg"
                                        src="{{ !empty($portfolio->portfolio_image) ? asset('upload/' . $portfolio->portfolio_image) : asset('upload/no_image.jpg') }}"
                                        alt="image">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
