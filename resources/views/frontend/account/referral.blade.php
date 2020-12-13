@extends('theme::layouts.app', ['alias' => 'Account'])
@section('theme::title', __('seo.referral'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar', ['account_alias'=>'Referral'])
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="col-md-12">
                    {{ __('home.ref.title') }}
                </h1>

                <div class="col-md-12">
                    <h3>
                        {{ __('home.ref.signature') }}
                    </h3>
                    @if($signature)
                        <code class="mb-4">
                            [URL={{ url("/register?r={$account->reflink}") }}]<br>
                            [IMG]{{ Storage::disk('images')->url($signature) }}[/IMG]<br>
                            [/URL]<br><br>
                        </code>
                        @else
                        <p class="py-2">
                            {{ __('home.ref.no-signature') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-12">
                    <h2>
                        {{ __('home.ref.your-ref') }}
                    </h2>
                    {!! $dataTable->table(['class' => 'table table-hover table-bordered table-striped w-100'], true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('theme::javascript')
    {!! $dataTable->scripts() !!}
@endpush
