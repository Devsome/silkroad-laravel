<div class="col-12">
@forelse($aItem as $item)
    <div id="selectInventory-{{ $item->item_id64 }}"
         data-serial64="{{ $item->serial64 }}" data-optlevel="{{ $item->optlevel }}">
        <div class="itemslot">
            <div class="image"
                 @isset($item->imgpath)
                 style="background:url('{{ $item['imgpath'] }}') no-repeat; background-size: 34px 34px;"
                 data-iteminfo="1" @endisset>
                <i class="fa fa-check" style="color: red; position: absolute" hidden></i>
                <span class="qinfo">
                    @if($item->amount > 0)
                        {{ $item->amount }}
                    @endisset
                </span>
                @isset($item->special)
                    @if($item->special)
                        <span class="plus"></span>
                    @endif
                @endisset
            </div>
        </div>
        <div class="itemInfo">
            @isset($item->data)
                {!! $item->data !!}
            @endisset
        </div>
    </div>
@empty
    {{ __('webinventory.no-items-inventory') }}
@endforelse
</div>
