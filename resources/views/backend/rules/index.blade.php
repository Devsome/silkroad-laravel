@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/rules.title') }}</h1>

            @if($rules->count() === 0)
            <a href="{{ route('server-rules-show-add-backend') }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> {{ __('backend/rules.create') }}
            </a>
            @else
                <a href="{{ route('server-rules-edit-show-backend', ['id' => $rules->first()->id]) }}"
                   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> {{ __('backend/rules.edit') }}
                </a>
            @endif

        </div>
        <div class="row">
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="py-2">
                    @forelse($rules as $rule)
                        {!! $rule->body !!}
                    @empty
                        No rules created
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
