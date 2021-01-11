@extends('theme::layouts.app', ['alias' => 'AuctionHouse'])
@section('theme::title', __('seo.auctionshouse.add'))
@section('theme::sidebar')
    @include('theme::frontend.account.auctionsidebar', ['filter_type' => $filter])
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('auctionshouse.add.title') }}
                    </h1>

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="ml-auto mr-3">
                            <a href="{{ route('auctions-house') }}" type="button" class="btn btn-secondary">
                                {{ __('auctionshouse.add.back') }}
                            </a>
                        </div>
                    </div>

                    <div class="card mt-3 mb-3">
                        <form method="POST" action="{{ route('auctions-house-submit-add-item') }}">
                            @csrf
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ __('auctionshouse.add.form.web-inventory') }}
                                    <i class="inventorySpinner fas fa-circle-notch fa-1x fa-spin" hidden></i>
                                </h5>
                                <div class="row card-text" id="webInventory">
                                    @include('theme::frontend.account.webinventory.web-inventory', ['aItem' => $webInventory])
                                    @if($webInventory->count() === 0)
                                        <div class="col-12">
                                            {{ __('auctionshouse.add.form.no-item-help') }}
                                            <span>
                                                <a href="{{ route('web-inventory-index') }}">
                                                    {{ __('auctionshouse.add.form.no-item-help-href') }}
                                                </a>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="row card-text pt-4">
                                    <div class="col-12">
                                        <label class="col-form-label">
                                            {{ __('auctionshouse.add.form.selected-item') }}
                                        </label>
                                        <div class="row">
                                            <div class="col-12">
                                                <div id="selectedItemAuction" class="text-center">
                                                    <div class="empty-slot">
                                                        <div class="itemslot">
                                                            <div class="image">
                                                            </div>
                                                        </div>
                                                        <div class="itemInfo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- form -->
                                        <input type="hidden" name="serial64" id="serial64" value="">
                                        <div class="row pt-5 col-12">
                                            <label for="price" class="col-form-label">
                                                {{ __('auctionshouse.add.form.price') }}
                                            </label>
                                            <input type="number"
                                                   class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                                                   id="price" name="price"
                                                   value="{{ Request::old('price') }}" placeholder="">
                                            <small id="price" class="form-text text-muted">
                                                {{ __('auctionshouse.add.form.price_help') }}
                                            </small>
                                            @if ($errors->has('price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="row col-12">
                                            <label for="price_instead" class="col-form-label">
                                                {{ __('auctionshouse.add.form.price_instead') }}
                                            </label>
                                            <input type="number"
                                                   class="form-control {{ $errors->has('price_instead') ? ' is-invalid' : '' }}"
                                                   id="price_instead" name="price_instead"
                                                   value="{{ Request::old('price_instead') }}" placeholder="">
                                            <small id="price" class="form-text text-muted">
                                                {{ __('auctionshouse.add.form.price_instead_help') }}
                                            </small>
                                            @if ($errors->has('price_instead'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('price_instead') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="row col-12">
                                            <label for="until" class="col-form-label">
                                                {{ __('auctionshouse.add.form.until') }}
                                            </label>
                                            <input type="datetime-local"
                                                   class="form-control {{ $errors->has('until') ? ' is-invalid' : '' }}"
                                                   id="until" name="until"
                                                   value="" placeholder="">
                                            <small id="price" class="form-text text-muted">
                                                {{ __('auctionshouse.add.form.until_help') }}
                                            </small>
                                            @if ($errors->has('until'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('until') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="pt-3">
                                                    <button type="submit" id="buttonTransferItemToAuction"
                                                            class="btn btn-sm btn-primary" disabled>
                                                        {{ __('auctionshouse.add.form.submit-item') }}
                                                    </button>
                                                </div>
                                                <div class="pt-3">
                                                    @if(isset($auctionsHouseSettings->settings['gold_fees']))
                                                        <div class="text-center">
                                                            <p class="small text-danger">
                                                                {{ __('auctionshouse.add.form.gold-lost', [
                                                                'percent' => $auctionsHouseSettings->settings['gold_fees']
                                                                ]) }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form -->

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('theme::javascript')
    <script>
        $(document).ready(function () {
            let checkMarkWeb = null;
            $('#webInventory [id^=selectInventory]').on('click', function () {
                if (checkMarkWeb) {
                    checkMarkWeb.attr('hidden', true);
                }
                checkMarkWeb = $(this).find('.fa-check');
                $(this).find('.fa-check').removeAttr('hidden');

                $('#selectedItemAuction').html(
                    $(this).clone()
                ).find('.fa-check').attr('hidden', true);
                $('#serial64').val(
                    $('#selectedItemAuction').find('[id^=selectInventory]').data('serial64')
                );
                $('#buttonTransferItemToAuction').removeAttr('disabled');
            });
            $(document).tooltip({
                items: "[data-itemInfo], [title]",
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
        });
    </script>
@endpush
