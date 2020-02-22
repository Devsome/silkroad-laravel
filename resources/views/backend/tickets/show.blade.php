@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/tickets.show.title') }}</h1>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Ticket conversation
                        </h6>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>{{ __('backend/notification.form-submit.error-title') }}</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                        <tr>
                                            <td>From Account Id</td>
                                            <td>{{ $ticket->getUserName->silkroad_id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $ticket->getUserName->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>email</td>
                                            <td>{{ $ticket->getUserName->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Created at</td>
                                            <td>{{ $ticket->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td>{{ $ticket->getCategoryName->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Priority</td>
                                            <td class="text-{{ $ticket->getPriorityName->color }}">{{ $ticket->getPriorityName->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td class="text-{{ $ticket->getStatusName->color }}">{{ $ticket->getStatusName->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>debug</td>
                                            <td>--</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold">
                                                Actions
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            Set priority
                                            <br>
                                            Set state
                                            <br>
                                            Assign to user
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                            Recent answer
                        <hr>
                        <form method="POST" action="#">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="body" class="col-form-label">
                                        {{ __('backend/news.form.body') }}
                                    </label>
                                    <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                              name="body" id="body" rows="6">{{ old('body') }}</textarea>
                                </div>
                            </div>

                            <input class="btn btn-primary" type="submit" value="Absenden!?">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#body').summernote({
                placeholder: '{{ __('backend/news.form.body-placeholder') }}',
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
