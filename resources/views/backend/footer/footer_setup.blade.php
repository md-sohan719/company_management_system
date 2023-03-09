@extends('backend.master_layout')
@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Footer Page</h4>
                        <form action="{{ route('update.footer') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $footerInfo->id }}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="number" class="form-control"
                                        value="{{ $footerInfo->number }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_description" rows="5">{{ $footerInfo->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" class="form-control"
                                        value="{{ $footerInfo->address }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $footerInfo->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="text" name="facebook" class="form-control"
                                        value="{{ $footerInfo->facebook }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="text" name="twitter" class="form-control"
                                        value="{{ $footerInfo->twitter }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Copyright</label>
                                <div class="col-sm-10">
                                    <input type="text" name="copyright" class="form-control"
                                        value="{{ $footerInfo->copyright }}">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Footer">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
