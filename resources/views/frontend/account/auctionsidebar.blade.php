<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 d-none d-lg-block">

    <p class="font-weight-light pt-2 pb-2 font-weight-bold">
        {{ __('auctionshouse.sidebar.filter') }}
    </p>

    <div class="list-group small">
        <a href="#" class="list-group-item list-group-item-action">
            {{ __('auctionshouse.sidebar.weapon') }}
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            {{ __('auctionshouse.sidebar.equipment') }}
        </a>
    </div>

    <p class="font-weight-light pt-4 font-weight-bold">
        {{ __('sidebar.home.currency') }}
    </p>
    <ul class="list-group list-unstyled small">
        <li class="pb-1">
            <div class="float-left">
                <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.home.web-inventory-gold') }}
            </div>
            <div class="float-right">
                {{ number_format($GoldProvider['web_inventory_gold'], 0, ',', '.') }}
            </div>
        </li>
    </ul>

</div>
