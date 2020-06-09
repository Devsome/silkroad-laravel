@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/auctionshouse.title') }}</h1>
        </div>
        <div class="row">
            <div class="container">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    <div class="row">
                        <div class="ml-auto mr-3">
                            <a href="{{ route('auctionshouse-log-backend') }}" type="button" class="btn btn-secondary">
                                {{ __('backend/auctionshouse.log-btn') }}
                            </a>
                        </div>
                    </div>

                <form method="POST" action="{{ route('auctionshouse-settings-update-backend') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @include('backend.auctionshouse.form', [
                        'data' => $settings->settings ?? [''],
                        ])
                </form>
            </div>
        </div>
    </div>
@endsection
