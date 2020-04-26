<div class="col-12">
@forelse($aItem as $item)
    <div id="selectInventory-{{ $item['ItemID'] }}"
         data-serial64="{{ $item['Serial64'] }}" data-optlevel="{{ $item['OptLevel'] }}">
        <div class="itemslot">
            <div class="image"
                 @isset($item['imgpath'])
                 style="background:url('{{ $item['imgpath'] }}') no-repeat; background-size: 34px 34px;"
                 data-iteminfo="1" @endisset>
                <i class="fa fa-check" style="color: red;" hidden></i>
                <span class="qinfo">
                    @isset($item)
                        {{ $item['amount'] }}
                    @endisset
                </span>
                @isset($item['special'])
                    @if($item['special'])
                        <span class="plus"></span>
                    @endif
                @endisset
            </div>
        </div>
        <div class="itemInfo">
            @isset($item)
                {!! $item['data'] !!}
            @endisset
        </div>
    </div>
@empty
    {{ __('webinventory.no-items-inventory') }}
@endforelse
</div>
