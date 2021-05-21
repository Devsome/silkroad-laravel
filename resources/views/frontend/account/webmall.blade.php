@extends('theme::layouts.app', ['alias' => 'Account'])
@section('theme::title', __('seo.web-mall'))
@section('theme::sidebar')
    @include('theme::frontend.account.sidebar', ['account_alias'=>'WebMall'])
@endsection
@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <form method="post" action="{{route('webmall.filter')}}">
                @csrf
                <div class="form-group">
                    <div class="row m-0">
                        <label for="race" class="col-form-label">{{__('webmall/webmall.race')}}&nbsp;</label>
                        <div class="col-md-11">
                            <select name="race" id="race" class="form-control @error('race') is-invalid @enderror">
                                <optgroup label="{{__('webmall/webmall.raceDesc')}}">
                                    <option
                                        {{ (old('race') == 0) ? "selected" : "" }} value="0">{{__('webmall/webmall.all')}}</option>
                                    <option {{ (old('race') == 1) ? "selected" : "" }} value="1">Chinese</option>
                                    <option {{ (old('race') == 2) ? "selected" : "" }} value="2">European</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    @error('race')
                    <div class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="row m-0">
                        <label for="filter" class="col-form-label">{{__('webmall/webmall.filter')}}</label>
                        <div class="col-md-11">
                            <select name="filter" id="filter"
                                    class="form-control @error('filter') is-invalid @enderror">
                                <optgroup label="{{__('webmall/webmall.filterDesc')}}">
                                    <option {{ (old('filter') === 'All') ? "selected" : "" }} value="All">All</option>
                                    <option {{ (old('filter') === 'Garment') ? "selected" : "" }} value="Garment">
                                        Garment
                                    </option>
                                    <option {{ (old('filter') === 'Protector') ? "selected" : "" }} value="Protector">
                                        Protector
                                    </option>
                                    <option {{ (old('filter') === 'Armor') ? "selected" : "" }} value="Armor">Armor
                                    </option>
                                    <option {{ (old('filter') === 'Robe') ? "selected" : "" }} value="Robe">Robe
                                    </option>
                                    <option
                                        {{ (old('filter') === 'Light_Armor') ? "selected" : "" }} value="Light_Armor">
                                        Light Armor
                                    </option>
                                    <option
                                        {{ (old('filter') === 'Heavy_Armor') ? "selected" : "" }} value="Heavy_Armor">
                                        Heavy Armor
                                    </option>
                                    <option {{ (old('filter') === 'Accessory') ? "selected" : "" }} value="Accessory">
                                        Accessory
                                    </option>
                                    <option {{ (old('filter') === 'Weapon') ? "selected" : "" }} value="Weapon">
                                        Weapon
                                    </option>
                                    <option {{ (old('filter') === 'Shield') ? "selected" : "" }} value="Shield">
                                        Shield
                                    </option>
                                    <option {{ (old('filter') === 'Avatars') ? "selected" : "" }} value="Avatars">
                                        Avatars
                                    </option>
                                    <option {{ (old('filter') === 'Devils') ? "selected" : "" }} value="Devils">
                                        Devils
                                    </option>
                                    <option {{ (old('filter') === 'PETS') ? "selected" : "" }} value="PETS">
                                        Pets
                                    </option>
                                    <option {{ (old('filter') === 'Scrolls') ? "selected" : "" }} value="Scrolls">
                                        Scrolls
                                    </option>
                                    <option {{ (old('filter') === 'Coins') ? "selected" : "" }} value="Coins">Coins
                                    </option>
                                    <option {{ (old('filter') === 'Elixirs') ? "selected" : "" }} value="Elixirs">
                                        Elixirs
                                    </option>
                                    <option {{ (old('filter') === 'Stones') ? "selected" : "" }} value="Stones">
                                        Stones
                                    </option>
                                    <option {{ (old('filter') === 'FTW') ? "selected" : "" }} value="FTW">FTW</option>
                                    <option {{ (old('filter') === 'ETC') ? "selected" : "" }} value="ETC">ETC</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    @error('filter')
                    <div class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__('webmall/webmall.search')}}</button>
                </div>
            </form>
            <div class="card">
                <div class="card-header">
                    <p class="mb-0">{{ __('webmall/webmall.title') }}</p>
                </div>
                <div class="card-body">
                    <div class="row web-mall">
                        @forelse($webmall as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body p-2">
                                        {!! $item->tooltip !!}
                                        <div class="d-block">
                                            <p class="mb-0"
                                               style="font-size: 0.85rem">{{ __('webmall/webmall.itemname') }}{{$item->item_name}}</p>
                                            <p class="mb-0"
                                               style="font-size: 0.85rem">{{ __('webmall/webmall.gender') }}{{($item->gender == 0) ? "Female" : (($item->gender == 1) ? "Male" : "Not Specified")}}</p>
                                            <p class="mb-0"
                                               style="font-size: 0.85rem">{{ __('webmall/webmall.silkprice') }}{{$item->silk_price}} {{ config('siteSettings.sro_silk_name', 'Silk') }}</p>
                                            <p class="mb-0"
                                               style="font-size: 0.85rem">{{ __('webmall/webmall.itemquantity') }}{{$item->item_quantity}}</p>
                                            <p class="mb-0"
                                               style="font-size: 0.85rem">{{ __('webmall/webmall.itemplus') }}{{$item->item_plus}}</p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary"
                                                onclick="purchaseItem({{$item->id}})">{{__('webmall/webmall.purchase')}}</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                {{__('webmall/webmall.empty')}}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('theme::javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            itemInfo();

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

        /**
         *
         * @param id
         */
        function purchaseItem(id) {
            bootbox.confirm({
                title: "{{__('bootbox.confirm.title')}}",
                message: "{{__('bootbox.confirm.message')}}",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i> {{__('bootbox.confirm.buttons.cancel')}}"
                    },
                    confirm: {
                        label: "<i class='fa fa-check'></i> {{__('bootbox.confirm.buttons.submit')}}"
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        axios.post("{{route('webmall.purchase', '')}}/" + id)
                            .then(function (data) {
                                toastr.success("The item has been purchased successfully.");
                            })
                            .catch(function (error) {
                                let errors = [];
                                console.log(error.response.data);
                                console.log(error.response);
                                if (isJson(error.response.data) && JSON.parse(error.response.data)) {
                                    $.each(JSON.parse(error.response.data), function (index, value) {
                                        errors += "-" + value + "<br>";
                                    });
                                } else {
                                    errors = error.response.data;
                                }
                                toastr.error(errors).css("width", "500px");
                            });
                    }
                }
            });
        }
    </script>
@endpush
