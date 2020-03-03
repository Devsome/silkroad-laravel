<div class="col-3 d-none d-md-block">
    <div class="card">
        <div class="card-body">
            <p class="font-weight-light p-2 font-weight-bold">{{ __('sidebar.information.title') }}.</p>
            <ul class="list-group list-unstyled small">
                <li>
                    <i class="fa fa-fw fa-desktop"></i> {{ __('sidebar.information.online') }}
                    <span class="pull-right text-primary">
                        {{ $SidebarProvider['count'] }} / {{ config('app.sro_max_server') }}
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-clock"></i> {{ __('sidebar.information.time') }}
                    <span class="pull-right text-primary">
                        <span class="currTime">00:00:00</span>
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fas fa-fw fa-check"></i> {{ __('sidebar.information.cap') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_cap') }}
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-flask"></i> {{ __('sidebar.information.exp-sp') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_exp') }}x
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-users"></i> {{ __('sidebar.information.party-exp') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_exp_party') }}x
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.information.gold') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_exp_gold') }}x
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-coins"></i> {{ __('sidebar.information.drop') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_exp_drop') }}x
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-star"></i> {{ __('sidebar.information.trade-goods') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_exp_job') }}x
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-exclamation"></i> {{ __('sidebar.information.ip-limit') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_ip_limit') }}
                    </span>
                </li>
                <li class="pb-1">
                    <i class="fa fa-fw fa-exclamation"></i> {{ __('sidebar.information.pc-limit') }}
                    <span class="pull-right text-primary">
                        {{ config('app.sro_hwid_limit') }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>
