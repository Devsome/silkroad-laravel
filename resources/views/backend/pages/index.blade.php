@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('backend/pages.title') }}
            </h1>
        </div>
        <div class="row">
            <div class="ml-auto mr-3">
                <a href="{{ route('pages.create') }}" type="button" class="btn btn-primary">
                    {{ __('backend/pages.add') }}
                </a>
                <a href="{{ route('index-backend') }}" type="button" class="btn btn-secondary">
                    {{ __('backend/pages.back') }}
                </a>
            </div>
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="users" class="table table-striped table-hover dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('backend/pages.table.type') }}</th>
                            <th scope="col">{{ __('backend/pages.table.title') }}</th>
                            <th class="body" scope="col">{{ __('backend/pages.table.body') }}</th>
                            <th scope="col">{{ __('backend/pages.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pages as $page)
                            <tr>
                                <td>
                                    {{ $page->id }}
                                </td>
                                <td>
                                    {{ $page->type }}
                                </td>
                                <td>
                                    {{ $page->title }}
                                </td>
                                <td class="body">
                                    {{ \Illuminate\Support\Str::words(strip_tags($page->body), 5, $end='...') }}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-3">
                                            <a href="{{ route('pages.edit', $page->id) }}"
                                               class="btn btn-primary btn-circle btn-sm">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-danger btn-circle btn-sm"
                                                    onclick="DeleteData({{$page->id}})" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    {{ __('backend/pages.table.empty') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('theme::javascript')
    <script type="text/javascript">
        function DeleteData(id) {
            bootbox.confirm({
                title: 'Confirmation dialog',
                message: 'Are you sure that you want to delete this item?',
                buttons: {
                    confirm: {
                        label: 'Delete',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: 'Cancel',
                        className: 'btn-default'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        axios.delete("{{route('pages.destroy', '')}}/" + id)
                            .then(function (data) {
                                toastr.success("{{trans('backend/notification.form-submit.success')}}, the page will refresh after 2 seconds.");
                                /*refresh page*/
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            })
                            .catch(function (error) {
                                toastr.error("{{trans('backend/notification.form-submit.error')}}");
                            });
                    }
                }
            });
        }
    </script>
@endpush
