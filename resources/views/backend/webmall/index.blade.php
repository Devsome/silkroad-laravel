@extends('theme::backend.layouts.app')

@section('theme::backend-content')
    @include('theme::backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Web Mall</h1>
        </div>
        <div class="row">
            <div class="container">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="add_item_button">Add Item</button>
                </div>
                {!! $dataTable->table(['class' => 'table table-hover table-bordered table-striped'], true) !!}
            </div>
        </div>
    </div>
    @include('backend.webmall.modal')
@endsection

@push('theme::javascript')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(document).ready(function () {
            itemInfo();
            /*Set form*/
            $('#add_item_button').click(function () {
                var AddItemForm = $("#AddDataForm");

                /*Show form*/
                AddItemForm.alpaca({
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
                            "item_code": {
                                "type": "string",
                                "title": "{{__('webmall/webmall.backend.modal.itemcode')}}",
                                "required": true
                            },
                            "item_quantity": {
                                "type": "number",
                                "title": "{{__('webmall/webmall.backend.modal.amount')}}",
                                "minimum": 1,
                                "required": true
                            },
                            "silk_price": {
                                "type": "number",
                                "title": "{{__('webmall/webmall.backend.modal.price')}}",
                                "minimum": 0,
                                "required": true
                            },
                            "item_plus": {
                                "type": "number",
                                "title": "{{__('webmall/webmall.backend.modal.plus')}}",
                                "minimum": 0,
                                "required": true
                            },
                        }
                    },
                    "data": {
                        "_token": "{{csrf_token()}}",
                        "_method": "POST",
                        "item_quantity": 1,
                        "silk_price": 0,
                        "item_plus": 0,
                    },
                    "options": {
                        "form": {
                            "attributes": {
                                "action": "{{route('web-mall.store')}}",
                                "method": "POST",
                                "enctype": "multipart/form-data",
                            },
                            "buttons": {
                                "submit": {
                                    "title": "{{__('webmall/webmall.backend.modal.submit')}}",
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
                                            toastr.success("The data has been added successfully. <br>" + (data === 1 ? "" : (isJson(data) ? JSON.stringify(data) : data)));

                                            /*Empty form*/
                                            $('#AddDataForm').html('');

                                            /*Close modal*/
                                            $('#AddItemModal').modal('hide');
                                        });

                                        promise.fail(function (e) {
                                            /*Set error*/
                                            errors = "";

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
                                            $('#dataTableBuilder_wrapper').find('.buttons-reload').click();

                                            /*console.log(JSON.stringify(value, null, " "));*/
                                        });
                                    },
                                },
                            }
                        },
                        "fields": {
                            "item_code": {
                                "type": "text",
                                "name": "item_code",
                                "placeholder": "{{__('webmall/webmall.backend.modal.itemcodeDesc')}}",
                                "helper": "{{__('webmall/webmall.backend.modal.itemcodeHelper')}}"
                            },
                            "item_quantity": {
                                "type": "number",
                                "name": "item_quantity",
                                "min": 0,
                                "placeholder": "{{__('webmall/webmall.backend.modal.amountDesc')}}",
                                "helper": "{{__('webmall/webmall.backend.modal.amountHelper')}}"
                            },
                            "silk_price": {
                                "type": "number",
                                "name": "silk_price",
                                "min": 0,
                                "placeholder": "{{__('webmall/webmall.backend.modal.priceDesc')}}",
                                "helper": "{{__('webmall/webmall.backend.modal.priceHelper')}}"
                            },
                            "item_plus": {
                                "type": "number",
                                "name": "item_plus",
                                "min": 0,
                                "placeholder": "{{__('webmall/webmall.backend.modal.plusDesc')}}",
                                "helper": "{{__('webmall/webmall.backend.modal.plusHelper')}}"
                            },
                        },
                    },
                    postRender: function (control) {
                        /*Update button*/
                        AddItemForm.find('button[data-key="submit"]').removeClass('btn-default').addClass('btn-primary');

                        /*Show modal*/
                        $('#AddItemModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    },
                    "focus": true,
                });
            })

            function itemInfo() {
                $(document).tooltip({
                    items: "[data-itemInfo]",
                    position: {my: "left+5 center", at: "right center"},
                    content: function () {
                        let element = jQuery(this);
                        if (jQuery(this).prop("tagName").toUpperCase() === 'IFRAME') {
                            return;
                        }
                        if (element.is("[data-itemInfo]")) {
                            if (element.parent().parent().find('.itemInfo').html() === '') {
                                return;
                            }
                            return element.parent().parent().find('.itemInfo').html();
                        }
                        if (element.is("[title]")) {
                            return element.attr("title");
                        }
                    },
                    close: function (event, ui) {
                        $(".ui-helper-hidden-accessible").remove();
                    }
                });
            }
        });

        function DeleteData(id) {
            bootbox.confirm({
                title: "{{__('bootbox.delete.title')}}",
                message: "{{__('bootbox.delete.message')}}",
                buttons: {
                    confirm: {
                        label: "{{ __('bootbox.delete.buttons.submit') }}",
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: "{{ __('bootbox.delete.buttons.cancel') }}",
                        className: 'btn-default'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        axios.delete("{{route('web-mall.destroy', '')}}/" + id)
                            .then(function (data) {
                                toastr.success("The item has been deleted successfully.");
                                /*refresh table*/
                                $('#dataTableBuilder_wrapper').find('.buttons-reload').click();
                            })
                            .catch(function (error) {
                                toastr.error("Couldn't delete the item.");
                            });
                    }
                }
            });
        }
    </script>
@endpush
