@extends('theme::layouts.app', ['alias' => 'Account'])
@section('theme::title', __('seo.tickets.index'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar', ['account_alias'=>'Tickets'])
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('home.tickets.title') }}
                    </h1>

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row mb-5">
                        <div class="ml-auto mr-3">
                            <a href="{{ route('home-tickets-new') }}" type="button" class="btn btn-secondary">
                                {{ __('home.tickets.create-new') }}
                            </a>
                        </div>
                    </div>
                    {!! $dataTable->table(['class' => 'table table-hover table-bordered table-striped w-100'], true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('theme::javascript')
    {!! $dataTable->scripts() !!}
@endpush
