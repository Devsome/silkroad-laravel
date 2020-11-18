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
            </div>
            <div class="container mt-3">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card shadow mb-4">
                            <a href="#collapseNewType" class="d-block card-header py-3" data-toggle="collapse"
                               role="button" aria-expanded="true" aria-controls="collapseNewType">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    {{ __('backend/pages.form.new-type-title') }}
                                </h6>
                            </a>
                            <div class="collapse" id="collapseNewType">
                                <div class="card-body">
                                    <form action="{{ route('pages-create-type-backend') }}" class="form" method="POST">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <label for="new_type"
                                                       class="col-form-label">{{ __('backend/pages.form.new-type') }}</label>
                                                <input type="text"
                                                       class="form-control{{ $errors->has('new_type') ? ' is-invalid' : '' }}"
                                                       name="new_type" id="new_type" autocomplete="off"
                                                       aria-describedby="newTypeHelp" value="{{ old('new_type') }}">
                                                @if($errors->has('new_type'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('new_type') }}
                                                    </div>
                                                @endif
                                                <small id="newTypeHelp"
                                                       class="form-text text-muted">{{ __('backend/pages.form.new-type-help') }}</small>
                                            </div>
                                            <div class="col-6">
                                                <label for="slug"
                                                       class="col-form-label">{{ __('backend/pages.form.slug') }}</label>
                                                <input type="text"
                                                       class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}"
                                                       name="slug" id="slug" autocomplete="off"
                                                       aria-describedby="slugHelp" value="{{ old('slug') }}">
                                                @if($errors->has('slug'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('slug') }}
                                                    </div>
                                                @endif
                                                <small id="slugHelp"
                                                       class="form-text text-muted">{{ __('backend/pages.form.slug-help') }}</small>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <input class="btn btn-primary" type="submit"
                                                       value="{{ __('backend/pages.form.submit-type') }}">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card shadow mb-4">
                            <a href="#collapseType" class="d-block card-header py-3" data-toggle="collapse"
                               role="button" aria-expanded="true" aria-controls="collapseType">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    {{ __('backend/pages.form.type-title') }}
                                </h6>
                            </a>
                            <div class="collapse show" id="collapseType">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover dataTable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">
                                                        {{ __('backend/pages.table.title') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ __('backend/pages.table.slug') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ __('backend/pages.table.state') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ __('backend/pages.table.action') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($types as $type)
                                                <tr>
                                                    <td>
                                                        {{ $type->title }}
                                                    </td>
                                                    <td>
                                                        {{ $type->slug }}
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="typeSwitch custom-control-input"
                                                                   name="state-{{$type->id}}" id="state-{{$type->id}}"
                                                                   data-id="{{ $type->id }}"
                                                                @if($type->state === \App\Pages::PAGE_ACTIVE) checked @endif>
                                                            <label id="stateLabel-{{$type->id}}" class="custom-control-label"
                                                                   for="state-{{$type->id}}">
                                                                {{ ucfirst($type->state) }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <button class="btn btn-danger btn-circle btn-sm"
                                                                        style="cursor: pointer">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card shadow mb-4">
                            <a href="#collapsePages" class="d-block card-header py-3" data-toggle="collapse"
                               role="button" aria-expanded="true" aria-controls="collapsePages">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    {{ __('backend/pages.pages-title') }}
                                </h6>
                            </a>
                            <div class="collapse show" id="collapsePages">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover dataTable">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">
                                                    {{ __('backend/pages.table.title') }}
                                                </th>
                                                <th scope="col">
                                                    {{ __('backend/pages.table.page') }}
                                                </th>
                                                <th class="body" scope="col">
                                                    {{ __('backend/pages.table.body') }}
                                                </th>
                                                <th scope="col">
                                                    {{ __('backend/pages.table.action') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($pages as $page)
                                                <tr>
                                                    <td>
                                                        {{ $page->title }}
                                                    </td>
                                                    <td>
                                                        {{ $page->getPages->title }}
                                                    </td>
                                                    <td class="body">
                                                        {{ \Illuminate\Support\Str::words(strip_tags($page->body), 5, $end = '...') }}
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
                                                    <td colspan="5">
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
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('theme::javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.typeSwitch').change(function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let typeId = $(this).data('id');
                let stateLabel = $('#stateLabel-' + typeId);

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('pages-toggle-type-backend') }}',
                    data: {'status': status, 'type_id': typeId},
                    success: function (data) {
                        stateLabel.text(data.state);
                    }
                });
            });
        });
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
                                setTimeout(function () {
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
