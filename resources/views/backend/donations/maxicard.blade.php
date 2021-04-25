@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/donations.method.title-maxicard') }}</h1>
        </div>
        <div class="container">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($method->active === 0)
                <div class="alert alert-danger" role="alert">
                    <p>{{ __('backend/donations.method.disabled') }}</p>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0">
                                {{ __('backend/donations.method.panel-title') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('method-maxicard-add-backend') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="name" class="col-form-label">
                                            {{ __('backend/donations.method.name') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               id="name" name="name"
                                               value="{{ $data['name'] ?? Request::old('name') }}">
                                        <small id="name" class="form-text text-muted">
                                            {{ __('backend/donations.method.name-help') }}
                                        </small>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="name" class="col-form-label">
                                            {{ __('backend/donations.method.description') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                               id="description" name="description"
                                               value="{{ $data['description'] ?? Request::old('description') }}">
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="number" class="col-form-label">
                                            {{ __('backend/donations.method.price') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                                               id="price" name="price"
                                               value="{{ $data['price'] ?? Request::old('price') }}">
                                        <small id="name" class="form-text text-muted">
                                            {{ __('backend/donations.method.price-help') }}
                                        </small>
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-4">
                                        <label for="number" class="col-form-label">
                                            {{ __('backend/donations.method.silk') }}
                                        </label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('silk') ? ' is-invalid' : '' }}"
                                               id="silk" name="silk"
                                               value="{{ $data['silk'] ?? Request::old('silk') }}">
                                        <small id="name" class="form-text text-muted">
                                            {{ __('backend/donations.method.silk-help') }}
                                        </small>
                                        @if ($errors->has('silk'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('silk') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 pb-5">
                                    <hr class="mt-2 mb-3">
                                    <div class="d-flex flex-wrap float-left">
                                        <button class="btn btn-style-1 btn-primary float-left" type="submit">
                                            {{ __('backend/donations.method.add') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                {!! $dataTable->table(['class' => 'table table-hover table-borderless table-striped dataTable w-100'], true) !!}
            </div>
            <div class="pt-5">
                {!! $logDataTable->table(['class' => 'table table-hover table-borderless table-striped dataTable w-100'], true) !!}
            </div>
        </div>
    </div>
    @include('modals.editData')
@endsection

@push('theme::javascript')
    {!! $dataTable->scripts() !!}
    {!! $logDataTable->scripts() !!}
    <script type="text/javascript">
        /*Delete data*/
        function deleteData(id) {
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
                        axios.delete("{{route('method-maxicard-destroy-backend', '')}}/" + id)
                            .then(function (data) {
                                toastr.success('The data has been deleted successfully.');
                                /*refresh table*/
                                $('#maxicard-prices_wrapper').find('.buttons-reload').click();
                            })
                            .catch(function (error) {
                                toastr.error('something went wrong please try again later!');
                            });
                    }
                }
            });
        }

        /*Edit data*/
        function editData(id) {
            /*Get data*/
            axios.get("{{route('maxicard-data-get-backend', '')}}/" + id)
                .then(function (data) {

                    /*Set data*/
                    data = data.data;

                    /*Set form*/
                    var updateDataForm = $("#updateDataForm");

                    /*Show form*/
                    updateDataForm.alpaca({
                        "schema": {
                            "type": "object",
                            "properties": {
                                "_token": {
                                    "type": "string",
                                    "hidden": true
                                },
                                "_method": {
                                    "type": "string",
                                    "hidden": true
                                },
                                "name": {
                                    "type": "string",
                                    "title": "name",
                                    "required": true
                                },
                                "description": {
                                    "type": "string",
                                    "title": "Description",
                                    "required": false
                                },
                                "price": {
                                    "type": "string",
                                    "title": "Price",
                                    "required": true
                                },
                                "silk": {
                                    "type": "string",
                                    "title": "Silk",
                                    "required": true
                                },
                            }
                        },
                        "data": {
                            "_token": "{{csrf_token()}}",
                            "_method": "PUT",
                            "name": data.maxicard.name,
                            "description": data.maxicard.description,
                            "price": data.maxicard.price,
                            "silk": data.maxicard.silk,
                        },
                        "options": {
                            "form": {
                                "attributes": {
                                    "action": "{{route('method-maxicard-edit-backend', '')}}/" + id,
                                    "method": "PUT",
                                    "enctype": "multipart/form-data",
                                },
                                "buttons": {
                                    "submit": {
                                        "title": "Update",
                                        "class": "btn btn-light",
                                        "click": function (e) {
                                            this.refreshValidationState(true);
                                            if (!this.isValid(true)) {
                                                this.focus();
                                                return;
                                            }

                                            var promise = this.ajaxSubmit();
                                            var value = this.getValue();

                                            promise.done(function (data) {
                                                toastr.success("The data has been updated successfully. <br>" + (data === 1 ? "" : (isJson(data) ? JSON.stringify(data) : data)));

                                                /*Empty form*/
                                                $('#updateDataForm').html('');

                                                /*Close modal*/
                                                $('#updateDataModal').modal('hide');
                                            });

                                            promise.fail(function (e) {
                                                /*Set error*/
                                                let errors = "";

                                                if (isJson(e.responseText) && JSON.parse(e.responseText).errors) {
                                                    $.each(JSON.parse(e.responseText).errors, function (index, value) {
                                                        errors += "-" + value + "<br>";
                                                    });
                                                } else {
                                                    errors = e.responseText;
                                                }

                                                toastr.error("Something went wrong please make sure that all data is correct! <br>" + errors);
                                            });

                                            promise.always(function () {
                                                /*refresh table*/
                                                $('#maxicard-prices_wrapper').find('.buttons-reload').click();

                                            });
                                        },
                                    },
                                }
                            },
                            "fields": {
                                "name": {
                                    "type": "text",
                                    "name": "name",
                                    "placeholder": "Name",
                                    "helper": "This field must be unique."
                                },
                                "description": {
                                    "type": "text",
                                    "name": "description",
                                    "placeholder": "Description",
                                },
                                "price": {
                                    "type": "text",
                                    "name": "price",
                                    "placeholder": "Price",
                                },
                                "silk": {
                                    "type": "text",
                                    "name": "silk",
                                    "placeholder": "Silk",
                                },
                            },
                        },
                        postRender: function (control) {
                            /*Update button*/
                            updateDataForm.find('button[data-key="submit"]').removeClass('btn-default').addClass('btn-primary');

                            /*Show modal*/
                            $('#updateDataModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        },
                        "focus": true,
                    });
                })
                .catch(function (error) {
                    toastr.error('something went wrong please try again later!');
                });
        }

    </script>
@endpush
