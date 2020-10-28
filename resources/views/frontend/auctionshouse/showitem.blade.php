@extends('theme::layouts.app')
@section('theme::title', __('seo.auctionshouse.showitem', ['name' => $item->getItemInformation->name]))
@section('theme::sidebar')
    @include('theme::frontend.account.auctionsidebar')
@endsection

@section('theme::content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('auctionshouse.showitem.title', ['name' => $item->getItemInformation->name]) }}
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

                    <div class="row pt-3">
                        <div class="col-md-2">
                            <div id="selectInventory">
                                <div class="itemslot">
                                    <div class="image"
                                         style="background:url('{{ $item->getItemInformation->imgpath }}')
                                                 no-repeat; background-size: 34px 34px;"
                                         data-iteminfo="1">
                                                    <span class="qinfo">
                                                        @if($item->getItemInformation->amount > 0)
                                                            {{ $item->getItemInformation->amount }}
                                                        @endisset
                                                    </span>
                                        @isset($item->getItemInformation->special)
                                            @if($item->getItemInformation->special)
                                                <span class="plus"></span>
                                            @endif
                                        @endisset
                                    </div>
                                </div>
                                <div class="itemInfo">
                                    @isset($item->getItemInformation->data)
                                        {!! $item->getItemInformation->data !!}
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <ul class="steps">
                                @if($item->until < \Carbon\Carbon::now())
                                    <li class="list-item">
                                        <h5 class="text-danger">
                                            {{ __('auctionshouse.showitem.expired') }}
                                        </h5>
                                    </li>
                                @endif
                                <li class="list-item">
                                    <h4 class="step-title">
                                        {{ __('auctionshouse.showitem.npc_price') }}
                                    </h4>
                                    <div class="step-content helper pl20">
                                        {{ number_format($item->getItemInformation->npc_price, 0, ',', '.') }}
                                        {{ __('auctionshouse.showitem.gold') }}
                                    </div>
                                </li>

                                <li class="list-item">
                                    <h4 class="step-title">
                                        {{ __('auctionshouse.showitem.bid') }}
                                        @if($item->bids > 0)
                                            <span class="small">
                                                {{ __('auctionshouse.showitem.current_bids', [
                                                    'amount' => $item->bids
                                                ]) }}
                                            </span>
                                        @endif
                                        @if($item->current_bid_user_id === Auth::user()->id)
                                            <span class="small text-primary">
                                                {{ __('auctionshouse.showitem.highest-user') }}
                                            </span>
                                        @endif
                                    </h4>
                                    <div class="step-content helper pl20">
                                        {{ number_format($item->price, 0, ',', '.') }}
                                        {{ __('auctionshouse.showitem.gold') }}
                                    </div>

                                </li>

                                <li class="list-item">
                                    <h4 class="step-title">
                                        {{ __('auctionshouse.showitem.price_instead') }}
                                    </h4>
                                    <div class="step-content helper pl20">
                                        {{ number_format($item->price_instead, 0, ',', '.') }}
                                        {{ __('auctionshouse.showitem.gold') }}
                                    </div>
                                </li>

                                <li class="list-item">
                                    <h4 class="step-title">
                                        {{ __('auctionshouse.showitem.until') }}
                                    </h4>
                                    <div class="step-content helper pl20">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->until)->diffForHumans() }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if($item->user_id === Auth::user()->id)
                        <div class="col-12">
                            {{ __('auctionshouse.showitem.own-item') }}
                        </div>
                    @else
                        @if($item->current_bid_user_id !== Auth::user()->id)
                            <div class="col-12">
                                <form class="form form-inline" method="POST"
                                action="{{ route('auctions-house-bid-item', ['id' => $item->id]) }}">
                                  @csrf
                                    <label for="auctionBidPrice" class="col-auto col-form-label">
                                        {{ __('auctionshouse.showitem.bid_price') }}
                                    </label>
                                    <input type="text" class="form-control mb-2 mr-sm-2"
                                           id="auctionBidPrice" name="auctionBidPrice" value="{{ $item->price + 1 }}">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        {{ __('auctionshouse.showitem.bid') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                        <hr>
                        @if($item->price_instead !== 0)
                            <div class="col-12">
                                <form class="form form-inline" method="POST"
                                      action="{{ route('auctions-house-buy-item-now', ['id' => $item->id]) }}">
                                    @csrf
                                    <label for="auctionBidPrice" class="col-auto col-form-label">
                                        {{ __('auctionshouse.showitem.buy_now_text') }}
                                    </label>
                                    <button type="submit" class="btn btn-primary mb-2"
                                    @if($item->price_instead === 0) disabled @endif>
                                        {{ __('auctionshouse.showitem.buy_now') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('theme::javascript')
    <script>
        $(document).ready(function () {
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
