@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/images.title-create') }}</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/images.create') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="container">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('images-create-backend') }}" class="form"
                                  enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" name="image_id" class="custom-file-input @error('image_id') is-invalid @enderror"
                                                       id="image_id">
                                                <label class="custom-file-label"
                                                       for="image_id">{{ __('backend/images.image') }}
                                                </label>
                                                @if($errors->has('image_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('image_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="col-6">
                                                <div class="container-fluid mt-3">
                                                    <img src="" id="img-tag" width="200px"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <select class="form-control" name="model" id="model"
                                                    aria-describedby="modelHelper">
                                                @foreach($models as $image)
                                                    <option value="{{ $image }}">{{ $image }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-primary" type="submit"
                                               value="{{ __('backend/images.submit') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
