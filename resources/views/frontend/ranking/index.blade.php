@extends('layouts.app')

@section('content')
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>{{ __('ranking.title') }}</h1>

                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 2%">{{ __('ranking.table.rank') }}</th>
                            <th scope="col" style="width: 15%">{{ __('ranking.table.charname') }}</th>
                            <th scope="col" style="width: 15%">{{ __('ranking.table.guild') }}</th>
                            <th scope="col" style="width: 15%">{{ __('ranking.table.level') }}</th>
                            <th scope="col" style="width: 15%">{{ __('ranking.table.itempoints') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $player)
                            <tr class="live-search-list">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('image/chars/') }}/{{ $player->RefObjID }}.gif"
                                         class="img-fluid" width="16" height="16" alt="#">
                                    <a href="#">{{ $player->CharName16 }}</a>
                                </td>
                                <td>
                                    <a href="#">{{ $player->getGuildUser ? $player->getGuildUser->Name : '' }}</a>
                                </td>
                                <td>
                                   {{ $player->CurLevel }}
                                </td>
                                <td>{{ $player->ItemPoints }}</td>
                            </tr>
                        @empty
                            <tr>
                                <th>{{ __('ranking.no-player') }}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
