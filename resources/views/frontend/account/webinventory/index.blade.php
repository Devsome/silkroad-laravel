@extends('layouts.app')

@section('sidebar')
    @include('frontend.account.sidebar')
@endsection

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>
                        {{ __('webinventory.title') }}
                    </h1>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ __('webinventory.select-character') }}
                                    </h5>
                                    <p class="card-text">
                                    <div class="form-group">
                                        <label for="selectedCharacter">
                                            {{ __('webinventory.charname') }}
                                        </label>
                                        <select class="form-control" id="selectedCharacter">
                                            @forelse($account->getTbUser->getShardUser as $character)
                                                <option value="{{ $character->CharID }}">
                                                    {{ $character->CharName16 }}
                                                </option>
                                            @empty
                                                <option value="null">
                                                    {{ __('webinventory.charname-empty') }}
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    </p>
                                    <button class="btn btn-primary btn-sm card-link" id="selectCharacter">
                                        {{ __('webinventory.submit-select-character') }}
                                    </button>
                                    <div id="selectedCharacterState" class="pt-2 small"></div>
                                </div>
                            </div>
                            <div class="card mt-3 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ __('webinventory.gold-transfer') }}
                                    </h5>
                                    <div class="row card-text">
                                        <div class="col-12">
                                            <label for="goldAmountGameWeb" class="col-form-label">
                                                {{ __('webinventory.gold-game-to-web') }}
                                            </label>
                                            <div class="form-inline">
                                                <div class="input-group">
                                                    <input type="number"
                                                           class="form-control form-control-sm mb-2 mr-sm-2"
                                                           id="goldAmountGameWeb" max="1">
                                                    <button type="button" id="buttonGoldAmountGameWeb"
                                                            class="btn btn-sm btn-primary mb-2" disabled>
                                                        {{ __('webinventory.submit-gold-transfer') }}
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="goldAmountGameWebState" class="pt-2"></div>

                                            <label for="goldAmountWebGame" class="col-form-label">
                                                {{ __('webinventory.gold-web-to-game') }}
                                            </label>
                                            <div class="form-inline">
                                                <div class="input-group">
                                                    <input type="number"
                                                           class="form-control form-control-sm mb-2 mr-sm-2"
                                                           id="goldAmountWebGame">
                                                    <button type="button" id="buttonGoldAmountWebGame"
                                                            class="btn btn-sm btn-primary mb-2" disabled>
                                                        {{ __('webinventory.submit-gold-transfer') }}
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="goldAmountWebGameState" class="pt-2"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ __('webinventory.ingame-inventory') }}
                                        <i class="inventorySpinner fas fa-circle-notch fa-1x fa-spin" hidden></i>
                                    </h5>
                                    <div class="row card-text">
                                        <div class="col-12">{{ __('webinventory.gold-amount-inventory') }} <span
                                                    id="inventoryGold"></span></div>
                                    </div>
                                    <div class="row card-text" id="inventory">
                                        <span class="col-12 small text-black-50">
                                            {{ __('webinventory.inventory-select-character') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ __('webinventory.selected-item') }}
                                    </h5>
                                    <div class="row card-text">
                                        <div class="col-12" id="selectedItem">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="{{ asset('js/webinventory.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let characterId = null;

            $('#selectCharacter').on('click', function () {
                $('.inventorySpinner').removeAttr('hidden');
                selectCharacterWebInventory(
                    $(this),
                    '{{ route('web-i-select-character') }}',
                    '{{csrf_token()}}'
                );
            });

            $('#buttonGoldAmountWebGame').on('click', function () {
                updateGold(
                    $('#goldAmountWebGame'),
                    $(this),
                    'webgame',
                    $('#goldAmountWebGameState'),
                    '{{ route('web-i-update-gold') }}',
                    '{{csrf_token()}}'
                );
            });

            $('#buttonGoldAmountGameWeb').on('click', function () {
                updateGold(
                    $('#goldAmountGameWeb'),
                    $(this),
                    'gameweb',
                    $('#goldAmountGameWebState'),
                    '{{ route('web-i-update-gold') }}',
                    '{{csrf_token()}}'
                );
            });
        });
    </script>
@endpush
