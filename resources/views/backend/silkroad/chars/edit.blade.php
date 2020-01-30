@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/chars.title') }}</h1>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ $char->CharName16 }} [{{ $char->CharID }}]
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <h4 class="small font-weight-bold">
                                    {{ __('backend/chars.edit.health') }}
                                    <span class="float-right">{{ $char->HP }}</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                         style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>

                                <h4 class="small font-weight-bold">
                                    {{ __('backend/chars.edit.mana') }}
                                    <span class="float-right">{{ $char->MP }}</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>

                                <h4 class="small font-weight-bold">
                                    {{ __('backend/chars.edit.skillpoints') }}
                                    <span class="float-right">{{ $char->RemainSkillPoint }}</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                         style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>

                                <h4 class="small font-weight-bold">
                                    {{ __('backend/chars.edit.level') }}
                                    <span class="float-right">{{ $char->CurLevel }}</span>
                                </h4>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                         style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <img src="{{ asset('image/chars/') }}/{{ $char->RefObjID }}.gif"
                                     class="brand-item-image d-none d-md-block" width="100px"
                                     height="150px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('backend/chars.edit.equipment') }}
                    </div>
                    <div class="card-body">
                        <div class="container mt-2">
                            <div class="row">
                                @foreach($char->getEquipmentUser as $item)
                                    @php
                                        $refregObjCommon = $item->getRefObjCommon;
                                    @endphp
                                    <div class="col-4">
                                        <div class="image"
                                             style="background:url('{{
                                            asset('/image/icon/' .
                                            str_replace(['ddj', '\\'], ['PNG', '/'], $refregObjCommon->AssocFileIcon128))
                                        }}');">
                                            @if (strpos($refregObjCommon->NameStrID128, 'RARE') !== false)
                                                <img src="{{ asset('/image/sox.gif') }}" width="32" height="32" alt="Seal of X">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('backend/chars.edit.inventory') }}
                    </div>
                    <div class="card-body">
                        <div class="container mt-2">
                            <div class="row">
                                @foreach($char->getInventoryItemUser as $item)
                                    @php
                                        $refregObjCommon = $item->getRefObjCommon;
                                    @endphp
                                    <div class="col-3">
                                        <div class="image"
                                             style="background:url('{{
                                            asset('/image/icon/' .
                                            str_replace(['ddj', '\\'], ['PNG', '/'], $refregObjCommon->AssocFileIcon128))
                                         }}');">
                                            @if (strpos($refregObjCommon->NameStrID128, 'RARE') !== false)
                                                <img src="{{ asset('/image/sox.gif') }}" width="32" height="32" alt="Seal of X">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('css')
    <style>
        .image {
            width: 32px;
            height: 32px;
            margin: 3px;
            padding: 0;
            color: #fff;
        }
    </style>
@endpush
