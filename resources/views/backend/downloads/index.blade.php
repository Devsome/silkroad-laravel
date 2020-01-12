@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/downloads.title') }}</h1>
        </div>
        <div class="row">
            <div class="container">
                {{ $downloads }}
            </div>
        </div>
    </div>
@endsection
