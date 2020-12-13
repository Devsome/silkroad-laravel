@extends('theme::layouts.app', ['alias' => 'Notifications'])
@section('theme::title', __('seo.notification'))
@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('notification.page.title') }}
                    </h1>

                    @if ($message = Session::get('success'))
                        <div class="py-3 mt-2">
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        </div>
                    @endif
                    @if ($error = Session::get('error'))
                        <div class="py-3 mt-2">
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $error }}</strong>
                            </div>
                        </div>
                    @endif

                    @if($notifications->count() > 1)
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('notification-mark-all') }}">
                                    {{ __('notification.page.mark-all') }}
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="users" class="table table-striped table-hover dataTable">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{ __('notification.page.table.key') }}</th>
                                <th scope="col">{{ __('notification.page.table.url') }}</th>
                                <th scope="col">{{ __('notification.page.table.send-at') }}</th>
                                <th scope="col">{{ __('notification.page.table.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($notifications as $notification)
                                <tr>
                                    <td>
                                        {{ $notification->key }}
                                    </td>
                                    <td>
                                        @if($notification->url)
                                            <a href="{{ $notification->url }}">
                                                {{ __('notification.page.url') }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('notification-mark-as-read', ['id' => $notification->id]) }}">
                                            {{ __('notification.page.mark') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        {{ __('notification.page.empty') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
